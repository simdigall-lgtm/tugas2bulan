<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::orderBy('id', 'desc')->get();
        $pelanggans = \App\Models\Pelanggan::orderBy('nama', 'asc')->get();
        $produks = \App\Models\Produk::orderBy('nama_produk', 'asc')->get();
        return view('pesanan', compact('pesanans', 'pelanggans', 'produks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'jumlah_ukuran' => 'nullable|string|max:255',
            'total_harga' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        // Check product stock availability
        $produk = \App\Models\Produk::where('nama_produk', $validated['nama_produk'])->first();
        $requestedQty = intval($request->input('jumlah_val', 1));

        if ($produk) {
            if ($produk->stok <= 0) {
                return back()->withInput()->with('error', "Stok untuk produk '{$produk->nama_produk}' sedang HABIS!");
            }
            if ($requestedQty > $produk->stok) {
                return back()->withInput()->with('error', "Jumlah pesanan ({$requestedQty}) melebihi stok yang tersedia ({$produk->stok})!");
            }
        }

        if (empty($validated['jumlah_ukuran']) || $request->filled('jumlah_val')) {
            $jumlahVal = $request->input('jumlah_val', $request->input('jumlah', '1'));
            $jumlahUnit = $request->input('jumlah_unit', 'Pcs');
            $ukuranVal = trim($request->input('ukuran_val', $request->input('ukuran', '')));
            $formattedUkuran = !empty($ukuranVal) ? " ({$ukuranVal})" : '';
            $validated['jumlah_ukuran'] = "{$jumlahVal} {$jumlahUnit}{$formattedUkuran}";
        }

        if (empty($validated['jumlah_ukuran'])) {
            $validated['jumlah_ukuran'] = '-';
        }

        $lastId = Pesanan::max('id') + 1;
        $year = date('Y');
        $validated['kode_pesanan'] = "ORD-{$year}-" . str_pad($lastId, 3, '0', STR_PAD_LEFT);
        $validated['tanggal_pesan'] = now()->toDateString();

        Pesanan::create($validated);

        // Decrement product stock upon successful order creation
        if ($produk && $requestedQty > 0) {
            $produk->decrement('stok', min($requestedQty, $produk->stok));
        }

        // Auto sync with Pelanggan table: increment total_pesanan or create customer record if missing
        $pelanggan = \App\Models\Pelanggan::where('nama', $validated['nama_pelanggan'])->first();
        if ($pelanggan) {
            $pelanggan->increment('total_pesanan');
        } else {
            $nextCusId = \App\Models\Pelanggan::max('id') + 1;
            \App\Models\Pelanggan::create([
                'kode_pelanggan' => 'CUST-' . str_pad($nextCusId, 3, '0', STR_PAD_LEFT),
                'nama' => $validated['nama_pelanggan'],
                'email' => strtolower(str_replace(' ', '', $validated['nama_pelanggan'])) . '@gmail.com',
                'no_hp' => '+62 812-' . rand(1000, 9999) . '-' . rand(1000, 9999),
                'alamat' => 'Jakarta, DKI Jakarta',
                'total_pesanan' => 1,
                'tanggal_daftar' => now()->toDateString(),
                'status' => 'Aktif',
            ]);
        }

        return redirect()->route('pesanan')->with('success', 'Pesanan baru berhasil dibuat!');
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        if (strtolower($pesanan->status ?? '') === 'selesai') {
            return redirect()->route('pesanan')->with('error', 'Pesanan yang sudah berstatus Selesai tidak dapat diedit lagi!');
        }

        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'jumlah_ukuran' => 'nullable|string|max:255',
            'total_harga' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        if (empty($validated['jumlah_ukuran']) || $request->filled('jumlah_val')) {
            $jumlahVal = $request->input('jumlah_val', $request->input('jumlah', '1'));
            $jumlahUnit = $request->input('jumlah_unit', 'Pcs');
            $ukuranVal = trim($request->input('ukuran_val', $request->input('ukuran', '')));
            $formattedUkuran = !empty($ukuranVal) ? " ({$ukuranVal})" : '';
            $validated['jumlah_ukuran'] = "{$jumlahVal} {$jumlahUnit}{$formattedUkuran}";
        }

        $pesanan->update($validated);

        return redirect()->route('pesanan')->with('success', 'Data pesanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dihapus!');
    }
}
