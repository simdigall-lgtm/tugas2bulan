<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\Pelanggan;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPesanan = Pesanan::count();
        $totalPendapatan = Pembayaran::where('status', 'Lunas')->sum('jumlah');
        $totalPelanggan = Pelanggan::count();
        $totalProduk = Produk::count();

        $pesananTerbaru = Pesanan::orderBy('id', 'desc')->take(5)->get();
        $pembayaranTerbaru = Pembayaran::orderBy('id', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalPesanan',
            'totalPendapatan',
            'totalPelanggan',
            'totalProduk',
            'pesananTerbaru',
            'pembayaranTerbaru'
        ));
    }
}
