<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPesanan = Pesanan::count();
        $totalPendapatan = Pembayaran::where('status', 'Lunas')->sum('jumlah');
        if ($totalPendapatan == 0) {
            $totalPendapatan = Pesanan::sum('total_harga');
        }
        $totalPelanggan = Pelanggan::count();
        $totalProduk = Produk::count();

        $pesananTerbaru = Pesanan::orderBy('id', 'desc')->take(5)->get();
        $pembayaranTerbaru = Pembayaran::orderBy('id', 'desc')->take(5)->get();

        // Real Sales Data for 2026 monthly
        $monthlyRevenue = [];
        $monthlyTarget = [];
        for ($m = 1; $m <= 12; $m++) {
            $rev = (float) Pesanan::whereYear('tanggal_pesan', 2026)
                ->whereMonth('tanggal_pesan', $m)
                ->sum('total_harga');
            $monthlyRevenue[] = $rev;
            $monthlyTarget[] = $rev > 0 ? (float) ($rev * 1.15) : 0;
        }

        // If 2026 total is zero, calculate across all data
        if (array_sum($monthlyRevenue) == 0) {
            for ($m = 1; $m <= 12; $m++) {
                $rev = (float) Pesanan::whereMonth('tanggal_pesan', $m)->sum('total_harga');
                $monthlyRevenue[$m - 1] = $rev;
                $monthlyTarget[$m - 1] = $rev > 0 ? (float) ($rev * 1.15) : 0;
            }
        }

        // Real Sales by Category / Product
        $categorySales = Pesanan::select('nama_produk', DB::raw('count(*) as total_orders'), DB::raw('sum(total_harga) as total_nominal'))
            ->groupBy('nama_produk')
            ->orderByDesc('total_orders')
            ->take(5)
            ->get();

        $categoryLabels = $categorySales->pluck('nama_produk')->toArray();
        $categoryCounts = $categorySales->pluck('total_orders')->toArray();

        if (empty($categoryLabels)) {
            $categoryLabels = ['Banner/Spanduk', 'Brosur', 'Kartu Nama', 'Stiker', 'Buku/Kalender'];
            $categoryCounts = [0, 0, 0, 0, 0];
        }

        return view('dashboard', compact(
            'totalPesanan',
            'totalPendapatan',
            'totalPelanggan',
            'totalProduk',
            'pesananTerbaru',
            'pembayaranTerbaru',
            'monthlyRevenue',
            'monthlyTarget',
            'categoryLabels',
            'categoryCounts'
        ));
    }
}
