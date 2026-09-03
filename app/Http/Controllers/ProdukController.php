<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::orderBy('id', 'desc')->get();
        return view('produk', compact('produks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0|max:1000000',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $validated['status'] = $validated['status'] ?? 'Tersedia';

        $lastId = Produk::max('id') + 1;
        $validated['kode_produk'] = 'PRD-' . str_pad($lastId, 3, '0', STR_PAD_LEFT);

        $produk = Produk::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan!', 'data' => $produk]);
        }

        return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0|max:1000000',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $validated['status'] = $validated['status'] ?? 'Tersedia';

        $produk->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Data produk berhasil diperbarui!', 'data' => $produk]);
        }

        return redirect()->route('produk')->with('success', 'Data produk berhasil diperbarui!');
    }

    public function destroy(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus!']);
        }

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus!');
    }
}
