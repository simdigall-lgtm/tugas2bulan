<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::orderBy('id', 'desc')->get();

        // Dynamically calculate total_pesanan for each customer based on actual orders
        foreach ($pelanggans as $pelanggan) {
            $orderCount = \App\Models\Pesanan::where('nama_pelanggan', $pelanggan->nama)->count();
            if ($orderCount > 0 && $pelanggan->total_pesanan != $orderCount) {
                $pelanggan->total_pesanan = $orderCount;
                $pelanggan->save();
            }
        }

        $defaultCities = [
            'Bandung', 'Batam', 'Bekasi', 'Bogor', 'Denpasar', 
            'Depok', 'Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Barat', 'Jakarta Timur', 'Jakarta Utara',
            'Makassar', 'Malang', 'Medan', 'Palembang', 'Semarang', 
            'Solo', 'Surabaya', 'Tangerang', 'Yogyakarta'
        ];

        $dbCities = $pelanggans->pluck('alamat')
            ->filter()
            ->map(function($address) {
                return trim(explode(',', $address)[0]);
            })
            ->filter()
            ->toArray();

        $allAvailableCities = array_values(array_unique(array_merge($defaultCities, $dbCities)));
        sort($allAvailableCities);

        return view('pelanggan', compact('pelanggans', 'allAvailableCities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:50',
            'alamat' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $validated['status'] = $validated['status'] ?? 'Aktif';

        $lastId = Pelanggan::max('id') + 1;
        $validated['kode_pelanggan'] = 'CUST-' . str_pad($lastId, 3, '0', STR_PAD_LEFT);
        $validated['tanggal_daftar'] = now()->toDateString();
        $validated['total_pesanan'] = 0;

        $pelanggan = Pelanggan::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Pelanggan berhasil ditambahkan!', 'data' => $pelanggan]);
        }

        return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:50',
            'alamat' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $validated['status'] = $validated['status'] ?? 'Aktif';

        $pelanggan->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Data pelanggan berhasil diperbarui!', 'data' => $pelanggan]);
        }

        return redirect()->route('pelanggan')->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function destroy(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Pelanggan berhasil dihapus!']);
        }

        return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
