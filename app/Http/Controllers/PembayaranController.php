<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pesanan;

class PembayaranController extends Controller
{
    private function isKasir()
    {
        $sessionUser = session('user');
        $currentLoggedUser = null;
        if (session()->has('user_id')) {
            $currentLoggedUser = \App\Models\User::find(session('user_id'));
        }
        if (!$currentLoggedUser && $sessionUser) {
            $currentLoggedUser = \App\Models\User::where('name', $sessionUser)->orWhere('email', $sessionUser)->first();
        }
        $name = $currentLoggedUser ? $currentLoggedUser->name : $sessionUser;
        $email = $currentLoggedUser ? $currentLoggedUser->email : '';
        return (strtolower($name ?? '') === 'kasir' || str_contains(strtolower($email ?? ''), 'kasir'));
    }

    public function index()
    {
        $pembayarans = Pembayaran::orderBy('id', 'desc')->get();
        $pesanans = Pesanan::orderBy('id', 'desc')->get();

        // Ambil mapping total nominal yang sudah terbayar untuk setiap pesanan
        $paidByOrder = Pembayaran::groupBy('kode_pesanan')
            ->selectRaw('kode_pesanan, sum(jumlah) as total_dibayar')
            ->pluck('total_dibayar', 'kode_pesanan')
            ->toArray();

        // Ambil daftar kode_pesanan yang benar-benar sudah LUNAS (sisa <= 0 atau status Lunas)
        $lunasOrderCodes = Pesanan::whereRaw('LOWER(status_pembayaran) = ?', ['lunas'])
            ->orWhere('sisa_bayar', '<=', 0)
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

        // Hitung total yang sudah dibayar sebelumnya untuk pesanan ini
        $previousPaid = Pembayaran::where('kode_pesanan', $validated['kode_pesanan'])->sum('jumlah');
        $targetHarga = floatval($pesanan->total_harga);
        $remainingBeforeThis = max(0, $targetHarga - $previousPaid);

        // Cek apakah pesanan ini memang sudah LUNAS
        if ($remainingBeforeThis <= 0 || strtolower($pesanan->status_pembayaran ?? '') === 'lunas') {
            return back()->withInput()->with('error', "Pesanan {$validated['kode_pesanan']} sudah LUNAS! Tidak ada sisa tagihan yang perlu dibayar.");
        }

        $metode = $request->input('metode_pembayaran') ?? $request->input('metode', 'Tunai');
        $tanggal = $request->input('tanggal_bayar') ?? $request->input('tanggal', now()->toDateString());
        $inputJumlah = floatval($validated['jumlah']);

        // Cegah pembayaran melebihi sisa tagihan
        if ($inputJumlah > $remainingBeforeThis) {
            return back()->withInput()->with('error', "Gagal: Jumlah bayar (Rp " . number_format($inputJumlah, 0, ',', '.') . ") melebihi sisa tagihan pesanan (Rp " . number_format($remainingBeforeThis, 0, ',', '.') . ")!");
        }

        $uangDiterima = $request->filled('uang_diterima') ? floatval($request->input('uang_diterima')) : $inputJumlah;

        // Validasi Tunai: Uang kasir yang diterima tidak boleh kurang dari jumlah yang disetorkan
        if ($metode === 'Tunai' && $uangDiterima < $inputJumlah) {
            return back()->withInput()->with('error', "Gagal: Uang fisik yang diterima (Rp " . number_format($uangDiterima, 0, ',', '.') . ") kurang dari jumlah pembayaran yang dicatat (Rp " . number_format($inputJumlah, 0, ',', '.') . ")! Jika pelanggan membayar DP sebesar Rp " . number_format($uangDiterima, 0, ',', '.') . ", ubah nilai pada kolom 'Jumlah Bayar Masuk'.");
        }

        $kembalian = max(0, $uangDiterima - $inputJumlah);

        // LOGIKA BISNIS 1: Tanggal pembayaran tidak boleh mendahului tanggal pemesanan
        if (!empty($pesanan->tanggal_pesan) && $tanggal < $pesanan->tanggal_pesan) {
            $tglPesanFmt = date('d M Y', strtotime($pesanan->tanggal_pesan));
            return back()->withInput()->with('error', 'Gagal menyimpan: Tanggal pembayaran (' . date('d M Y', strtotime($tanggal)) . ') tidak boleh sebelum tanggal pemesanan (' . $tglPesanFmt . ')!');
        }

        // LOGIKA BISNIS 2: Hitung akumulasi pembayaran dan sisa tagihan
        $totalBayarAkumulasi = $previousPaid + $inputJumlah;
        $sisaBayar = max(0, $targetHarga - $totalBayarAkumulasi);

        if ($sisaBayar > 0) {
            $statusOtomatis = 'DP (Uang Muka)';
            $pesananStatusBayar = 'DP';
        } else {
            $statusOtomatis = 'Lunas';
            $pesananStatusBayar = 'Lunas';
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
            'uang_diterima' => $uangDiterima,
            'kembalian' => $kembalian,
        ];

        Pembayaran::create($pembayaranData);

        // Update status pembayaran & sisa bayar di pesanan terkait
        $pesanan->update([
            'status_pembayaran' => $pesananStatusBayar,
            'sisa_bayar' => $sisaBayar,
        ]);

        $statusMsg = $sisaBayar > 0 
            ? "Status: DP (Sisa Tagihan: Rp " . number_format($sisaBayar, 0, ',', '.') . ")" 
            : "Status: LUNAS (Tagihan Selesai)";

        return redirect()->route('pembayaran')->with('success', "Pembayaran untuk {$validated['kode_pesanan']} berhasil dicatat! {$statusMsg}" . ($kembalian > 0 ? " (Kembalian: Rp " . number_format($kembalian, 0, ',', '.') . ")" : ''));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if (strtolower($pembayaran->status) === 'lunas') {
            return back()->with('error', 'Pembayaran berstatus LUNAS telah terkunci dan tidak dapat diubah lagi!');
        }

        $metode = $request->input('metode_pembayaran') ?? $request->input('metode', $pembayaran->metode);
        $jumlah = floatval($request->input('jumlah', $pembayaran->jumlah));

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

        if ($pesanan) {
            $pesanan->update([
                'status_pembayaran' => $status,
                'sisa_bayar' => max(0, $targetHarga - $jumlah),
            ]);
        }

        return redirect()->route('pembayaran')->with('success', 'Status pembayaran berhasil diperbarui menjadi ' . $status . '!');
    }

    public function destroy($id)
    {
        if ($this->isKasir()) {
            return back()->with('error', 'Akses ditolak! Akun Kasir tidak memiliki wewenang untuk menghapus catatan transaksi pembayaran. Silakan hubungi Administrator.');
        }

        $pembayaran = Pembayaran::findOrFail($id);

        if (strtolower($pembayaran->status) === 'lunas') {
            return back()->with('error', 'Pembayaran berstatus LUNAS telah terkunci dan tidak dapat dihapus!');
        }

        $pembayaran->delete();

        return redirect()->route('pembayaran')->with('success', 'Data pembayaran berhasil dihapus!');
    }
}
