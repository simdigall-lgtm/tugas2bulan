<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Set 2026 date boundaries
        $earliestDate = '2026-01-01';
        $latestDate = '2026-12-31';

        $startDate = $request->input('start_date', '2026-01-01');
        $endDate = $request->input('end_date', '2026-12-31');

        // Sanitize to not exceed bounds
        if ($startDate < $earliestDate) {
            $startDate = $earliestDate;
        }
        if ($endDate > $latestDate) {
            $endDate = $latestDate;
        }

        $pesanansQuery = Pesanan::query();
        if ($startDate) {
            $pesanansQuery->whereDate('tanggal_pesan', '>=', $startDate);
        }
        if ($endDate) {
            $pesanansQuery->whereDate('tanggal_pesan', '<=', $endDate);
        }

        $pesanans = $pesanansQuery->orderBy('tanggal_pesan', 'desc')->orderBy('id', 'desc')->get();

        // Calculate real stats within period
        $totalTransaksi = $pesanans->count();
        $totalPendapatan = (float) $pesanans->sum('total_harga');
        $totalPelanggan = Pelanggan::count();
        $pesananSelesai = $pesanans;

        // Monthly Trend from filtered orders
        $monthlyTrendMap = [];
        foreach ($pesanans as $p) {
            if (!$p->tanggal_pesan) continue;
            $m = date('M Y', strtotime($p->tanggal_pesan));
            if (!isset($monthlyTrendMap[$m])) {
                $monthlyTrendMap[$m] = 0;
            }
            $monthlyTrendMap[$m] += (float) $p->total_harga;
        }

        if (empty($monthlyTrendMap)) {
            $trendLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
            $trendValues = array_fill(0, 12, 0);
        } else {
            $trendLabels = array_keys($monthlyTrendMap);
            $trendValues = array_values($monthlyTrendMap);
        }

        // Product Revenue Contribution
        $productShareMap = [];
        $totalRev = max(1, $totalPendapatan);
        foreach ($pesanans as $p) {
            $prod = $p->nama_produk ?: 'Lainnya';
            if (!isset($productShareMap[$prod])) {
                $productShareMap[$prod] = 0;
            }
            $productShareMap[$prod] += (float) $p->total_harga;
        }
        arsort($productShareMap);
        $shareLabels = array_slice(array_keys($productShareMap), 0, 6);
        $sharePercentages = [];
        foreach ($shareLabels as $lbl) {
            $sharePercentages[] = round(($productShareMap[$lbl] / $totalRev) * 100, 1);
        }

        if (empty($shareLabels)) {
            $shareLabels = ['Banner/Spanduk', 'Brosur', 'Kartu Nama', 'Stiker', 'Dokumen'];
            $sharePercentages = [0, 0, 0, 0, 0];
        }

        return view('laporan', compact(
            'pesanans',
            'totalPendapatan',
            'totalTransaksi',
            'totalPelanggan',
            'pesananSelesai',
            'earliestDate',
            'latestDate',
            'startDate',
            'endDate',
            'trendLabels',
            'trendValues',
            'shareLabels',
            'sharePercentages'
        ));
    }
}
