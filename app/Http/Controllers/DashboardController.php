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

        // Dynamic month-over-month context
        $now = now();
        $thisMonth = (int) $now->month;
        $thisYear = (int) $now->year;

        $monthNamesIndo = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agt',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        // Realistic strategic monthly target baseline for performance tracking
        $baseTargets = [
            1 => 6000000,   // Jan: Rp 6 Jt
            2 => 8000000,   // Feb: Rp 8 Jt
            3 => 10000000,  // Mar: Rp 10 Jt
            4 => 11000000,  // Apr: Rp 11 Jt
            5 => 14000000,  // Mei: Rp 14 Jt
            6 => 16500000,  // Jun: Rp 16.5 Jt
            7 => 20000000,  // Jul: Rp 20 Jt
            8 => 32000000,  // Agt: Rp 32 Jt
            9 => 30000000,  // Sep: Rp 30 Jt
            10 => 33000000, // Okt: Rp 33 Jt
            11 => 36000000, // Nov: Rp 36 Jt
            12 => 40000000, // Des: Rp 40 Jt
        ];

        // Real Sales Data for current year, only up to the current month ($thisMonth)
        // Automatically adds new months as time progresses
        $monthlyLabels = [];
        $monthlyRevenue = [];
        $monthlyTarget = [];
        for ($m = 1; $m <= $thisMonth; $m++) {
            $monthlyLabels[] = $monthNamesIndo[$m] ?? date('M', mktime(0, 0, 0, $m, 1));
            $rev = (float) Pesanan::whereYear('tanggal_pesan', $thisYear)
                ->whereMonth('tanggal_pesan', $m)
                ->sum('total_harga');
            $monthlyRevenue[] = $rev;
            $monthlyTarget[] = (float) ($baseTargets[$m] ?? ($rev > 0 ? $rev * 1.1 : 0));
        }

        // If current year total is zero, calculate across all data but still cap at $thisMonth
        if (array_sum($monthlyRevenue) == 0) {
            $monthlyRevenue = [];
            $monthlyTarget = [];
            for ($m = 1; $m <= $thisMonth; $m++) {
                $rev = (float) Pesanan::whereMonth('tanggal_pesan', $m)->sum('total_harga');
                $monthlyRevenue[] = $rev;
                $monthlyTarget[] = (float) ($baseTargets[$m] ?? ($rev > 0 ? $rev * 1.1 : 0));
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

        // Dynamic month-over-month comparison metrics
        $prevDate = $now->copy()->subMonth();
        $prevMonth = $prevDate->month;
        $prevYear = $prevDate->year;

        // 1. Pesanan Growth
        $pesananThisMonth = Pesanan::whereYear('tanggal_pesan', $thisYear)->whereMonth('tanggal_pesan', $thisMonth)->count();
        $pesananPrevMonth = Pesanan::whereYear('tanggal_pesan', $prevYear)->whereMonth('tanggal_pesan', $prevMonth)->count();
        if ($pesananPrevMonth > 0) {
            $growthPesanan = round((($pesananThisMonth - $pesananPrevMonth) / $pesananPrevMonth) * 100, 1);
        } else {
            $growthPesanan = $pesananThisMonth > 0 ? 100.0 : 0.0;
        }

        // 2. Pendapatan Growth
        $revThisMonth = (float) Pembayaran::where('status', 'Lunas')->whereYear('tanggal', $thisYear)->whereMonth('tanggal', $thisMonth)->sum('jumlah');
        if ($revThisMonth == 0) {
            $revThisMonth = (float) Pesanan::whereYear('tanggal_pesan', $thisYear)->whereMonth('tanggal_pesan', $thisMonth)->sum('total_harga');
        }
        $revPrevMonth = (float) Pembayaran::where('status', 'Lunas')->whereYear('tanggal', $prevYear)->whereMonth('tanggal', $prevMonth)->sum('jumlah');
        if ($revPrevMonth == 0) {
            $revPrevMonth = (float) Pesanan::whereYear('tanggal_pesan', $prevYear)->whereMonth('tanggal_pesan', $prevMonth)->sum('total_harga');
        }
        if ($revPrevMonth > 0) {
            $growthPendapatan = round((($revThisMonth - $revPrevMonth) / $revPrevMonth) * 100, 1);
        } else {
            $growthPendapatan = $revThisMonth > 0 ? 100.0 : 0.0;
        }

        // 3. Pelanggan Growth
        $pelangganThisMonth = Pelanggan::whereMonth('tanggal_daftar', $thisMonth)->count();
        $pelangganPrevMonth = Pelanggan::whereMonth('tanggal_daftar', $prevMonth)->count();
        if ($pelangganPrevMonth > 0) {
            $growthPelanggan = round((($pelangganThisMonth - $pelangganPrevMonth) / $pelangganPrevMonth) * 100, 1);
        } else {
            $growthPelanggan = $pelangganThisMonth > 0 ? 100.0 : 0.0;
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
            'monthlyLabels',
            'thisMonth',
            'thisYear',
            'monthNamesIndo',
            'categoryLabels',
            'categoryCounts',
            'growthPesanan',
            'growthPendapatan',
            'growthPelanggan'
        ));
    }
}
