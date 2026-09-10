<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pesanan;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::orderBy('id', 'desc')->get();
        $pesanans = Pesanan::orderBy('id', 'desc')->get();

        // Ambil mapping total nominal yang sudah terbayar untuk setiap pesanan
        $paidByOrder = Pembayaran::groupBy('kode_pesanan')
            ->selectRaw('kode_pesanan, sum(jumlah) as total_dibayar')
            ->pluck('total_dibayar', 'kode_pesanan')
            ->toArray();

        // Ambil daftar kode_pesanan yang sudah memiliki status LUNAS
        $lunasOrderCodes = Pembayaran::whereRaw('LOWER(status) = ?', ['lunas'])
            ->pluck('kode_pesanan')
            ->toArray();

        return view('pembayaran', compact('pembayarans', 'pesanans', 'lunasOrderCodes', 'paidByOrder'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_pesanan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:1',
        ], [
            'jumlah.min' => 'Jumlah bayar minimal adalah Rp 1.',
            'jumlah.required' => 'Jumlah bayar wajib diisi.',
            'kode_pesanan.required' => 'Pesanan wajib dipilih.',
        ]);

        $pesanan = Pesanan::where('kode_pesanan', $validated['kode_pesanan'])->first();
        if (!$pesanan) {
            return back()->withInput()->with('error', 'Data pesanan tidak ditemukan di database!');
        }

        // Cek apakah pesanan ini sudah berstatus Selesai / LUNAS
        $isPesananSelesai = strtolower($pesanan->status ?? '') === 'selesai' || strtolower($pesanan->status ?? '') === 'lunas';
        $alreadyLunas = Pembayaran::where('kode_pesanan', $validated['kode_pesanan'])
            ->whereRaw('LOWER(status) = ?', ['lunas'])
            ->exists();

        if ($alreadyLunas || $isPesananSelesai) {
            return back()->withInput()->with('error', 'Pesanan ' . $validated['kode_pesanan'] . ' sudah LUNAS / Selesai! Tidak dapat menambah pembayaran baru.');
        }

        $metode = $request->input('metode_pembayaran') ?? $request->input('metode', 'Transfer Bank');
        $tanggal = $request->input('tanggal_bayar') ?? $request->input('tanggal', now()->toDateString());
        $inputJumlah = floatval($validated['jumlah']);

        // LOGIKA BISNIS 1: Tanggal pembayaran tidak boleh mendahului tanggal pemesanan
        if (!empty($pesanan->tanggal_pesan) && $tanggal < $pesanan->tanggal_pesan) {
            $tglPesanFmt = date('d M Y', strtotime($pesanan->tanggal_pesan));
            return back()->withInput()->with('error', 'Gagal menyimpan: Tanggal pembayaran (' . date('d M Y', strtotime($tanggal)) . ') tidak boleh sebelum tanggal pemesanan (' . $tglPesanFmt . ')!');
        }

        // LOGIKA BISNIS 2: Tanggal pembayaran tidak boleh melebihi hari ini (masa depan)
        if ($tanggal > date('Y-m-d')) {
            return back()->withInput()->with('error', 'Gagal menyimpan: Tanggal pembayaran tidak boleh di masa depan (maksimal hari ini, ' . date('d M Y') . ')!');
        }

        // LOGIKA BISNIS 3: Hitung akumulasi pembayaran dan sisa tagihan
        $previousPaid = Pembayaran::where('kode_pesanan', $validated['kode_pesanan'])->sum('jumlah');
        $targetHarga = floatval($pesanan->total_harga);
        $totalBayarAkumulasi = $previousPaid + $inputJumlah;

        // Logika Otomatis: Jika akumulasi terbayar >= total harga pesanan -> Lunas, jika kurang -> Belum Lunas
        if ($targetHarga > 0 && $totalBayarAkumulasi < $targetHarga) {
            $statusOtomatis = 'Belum Lunas';
        } else {
            $statusOtomatis = 'Lunas';
        }

        // Cek apakah pesanan ini sudah memiliki catatan pembayaran sebelumnya (update jika belum lunas)
        $existingPayment = Pembayaran::where('kode_pesanan', $validated['kode_pesanan'])->first();

        if ($existingPayment) {
            if (strtolower($existingPayment->status) === 'lunas') {
                return back()->withInput()->with('error', 'Pesanan ' . $validated['kode_pesanan'] . ' sudah LUNAS! Tidak dapat menambah pembayaran baru.');
            }

            $existingPayment->update([
                'metode' => $metode,
                'jumlah' => $inputJumlah,
                'status' => $statusOtomatis,
                'tanggal' => $tanggal,
            ]);

            if ($statusOtomatis === 'Lunas') {
                $pesanan->update(['status' => 'Selesai']);
            }

            return redirect()->route('pembayaran')->with('success', 'Data pembayaran untuk ' . $validated['kode_pesanan'] . ' berhasil diperbarui (Status: ' . $statusOtomatis . ')!');
        }

        $lastId = Pembayaran::max('id') + 1;
        $year = date('Y');

        $pembayaranData = [
            'kode_pembayaran' => "PAY-{$year}-" . str_pad($lastId, 3, '0', STR_PAD_LEFT),
            'kode_pesanan' => $validated['kode_pesanan'],
            'metode' => $metode,
            'jumlah' => $inputJumlah,
            'status' => $statusOtomatis,
            'tanggal' => $tanggal,
        ];

        Pembayaran::create($pembayaranData);

        // Jika status Lunas, otomatis perbarui status pesanan terkait menjadi Selesai
        if ($statusOtomatis === 'Lunas') {
            $pesanan->update(['status' => 'Selesai']);
        }

        return redirect()->route('pembayaran')->with('success', 'Pembayaran berhasil dicatat dengan status: ' . $statusOtomatis . '!');
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        // Pembayaran yang sudah Lunas tidak dapat diubah
        if (strtolower($pembayaran->status) === 'lunas') {
            return back()->with('error', 'Pembayaran berstatus LUNAS telah terkunci dan tidak dapat diubah lagi!');
        }

        $metode = $request->input('metode_pembayaran') ?? $request->input('metode', $pembayaran->metode);
        $jumlah = floatval($request->input('jumlah', $pembayaran->jumlah));

        // Ambil data pesanan untuk mengecek total harga
        $pesanan = Pesanan::where('kode_pesanan', $pembayaran->kode_pesanan)->first();
        $targetHarga = $pesanan ? floatval($pesanan->total_harga) : 0;

        if ($targetHarga > 0 && $jumlah < $targetHarga) {
            $status = 'Belum Lunas';
        } else {
            $status = 'Lunas';
        }

        $pembayaran->update([
            'metode' => $metode,
            'jumlah' => $jumlah,
            'status' => $status,
        ]);

        if ($status === 'Lunas') {
            Pesanan::where('kode_pesanan', $pembayaran->kode_pesanan)->update(['status' => 'Selesai']);
        }

        return redirect()->route('pembayaran')->with('success', 'Status pembayaran berhasil diperbarui menjadi ' . $status . '!');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        // Pembayaran yang sudah Lunas tidak dapat dihapus
        if (strtolower($pembayaran->status) === 'lunas') {
            return back()->with('error', 'Pembayaran berstatus LUNAS telah terkunci dan tidak dapat dihapus!');
        }

        $pembayaran->delete();

        return redirect()->route('pembayaran')->with('success', 'Data pembayaran berhasil dihapus!');
    }
}
