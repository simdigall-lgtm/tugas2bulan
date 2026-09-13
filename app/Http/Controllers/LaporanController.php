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
        // Dynamic date boundaries capped strictly at today (tanggal sekarang)
        $now = now();
        $currentYear = (int) $now->year;
        $currentMonth = (int) $now->month;
        $currentMonthStart = $now->copy()->startOfMonth()->toDateString();
        $currentMonthEnd = $now->copy()->endOfMonth()->toDateString();
        $todayDate = $now->toDateString();

        $earliestDate = "{$currentYear}-01-01";
        // Sesuaikan dengan hari/tanggal sekarang, jangan akhir bulan
        $latestAllowedDate = $todayDate;
        $latestDate = $todayDate;

        // Support Quick Range Parameter (today, month, quarter, year)
        $range = $request->input('range');
        if ($range === 'today') {
            $startDate = $todayDate;
            $endDate = $todayDate;
        } elseif ($range === 'month') {
            $startDate = $currentMonthStart;
            $endDate = $todayDate;
        } elseif ($range === 'quarter') {
            $startDate = $now->copy()->firstOfQuarter()->toDateString();
            $endDate = $todayDate;
        } elseif ($range === 'year') {
            $startDate = $earliestDate;
            $endDate = $todayDate;
        } else {
            $startDate = $request->input('start_date', $earliestDate);
            $endDate = $request->input('end_date', $todayDate);
        }

        // Sanitize to not exceed bounds (never allow dates past today)
        if ($startDate < $earliestDate) {
            $startDate = $earliestDate;
        }
        if ($endDate > $latestAllowedDate) {
            $endDate = $latestAllowedDate;
        }
        if ($startDate > $endDate) {
            $startDate = $endDate;
        }

        // Determine active range tag for UI highlight
        $activeRange = 'custom';
        if ($startDate === $todayDate && $endDate === $todayDate) {
            $activeRange = 'today';
        } elseif ($startDate === $currentMonthStart && $endDate === $todayDate) {
            $activeRange = 'month';
        } elseif ($startDate === $now->copy()->firstOfQuarter()->toDateString() && $endDate === $todayDate) {
            $activeRange = 'quarter';
        } elseif ($startDate === $earliestDate && $endDate === $todayDate) {
            $activeRange = 'year';
        }

        $pesanansQuery = Pesanan::query();
        if ($startDate) {
            $pesanansQuery->whereDate('tanggal_pesan', '>=', $startDate);
        }
        if ($endDate) {
            $pesanansQuery->whereDate('tanggal_pesan', '<=', $endDate);
        }

        $pesanans = $pesanansQuery->orderBy('tanggal_pesan', 'desc')->orderBy('id', 'desc')->get();

        // Core business metrics within filtered period
        $totalTransaksi = $pesanans->count();
        $totalPendapatan = (float) $pesanans->sum('total_harga');
        $totalPelanggan = Pelanggan::count();
        $rataRataTransaksi = $totalTransaksi > 0 ? round($totalPendapatan / $totalTransaksi) : 0;

        // Unpaid / Piutang calculation
        $totalPiutang = 0;
        $totalBelumLunasCount = 0;
        foreach ($pesanans as $p) {
            $isLunas = strtolower($p->status_pembayaran ?? '') === 'lunas';
            if (!$isLunas) {
                $totalBelumLunasCount++;
                $sisa = floatval($p->sisa_bayar ?? 0);
                if ($sisa > 0) {
                    $totalPiutang += $sisa;
                } else {
                    $totalPiutang += floatval($p->total_harga ?? 0);
                }
            }
        }

        // Total Produk / Item Terjual (volume/kuantitas)
        $totalProdukTerjual = 0;
        foreach ($pesanans as $p) {
            if (!empty($p->detail_items) && is_array($p->detail_items)) {
                foreach ($p->detail_items as $it) {
                    $totalProdukTerjual += intval($it['qty'] ?? 1);
                }
            } else {
                if (preg_match('/^(\d+)/', trim($p->jumlah_ukuran ?? ''), $m)) {
                    $totalProdukTerjual += intval($m[1]);
                } else {
                    $totalProdukTerjual += 1;
                }
            }
        }

        // Growth rate comparison against previous equivalent period
        $startTs = strtotime($startDate);
        $endTs = strtotime($endDate);
        $diffDays = max(1, round(($endTs - $startTs) / 86400) + 1);

        $prevEndDate = date('Y-m-d', strtotime($startDate . ' -1 day'));
        $prevStartDate = date('Y-m-d', strtotime($prevEndDate . " -" . ($diffDays - 1) . " days"));

        $prevOrders = Pesanan::whereDate('tanggal_pesan', '>=', $prevStartDate)
            ->whereDate('tanggal_pesan', '<=', $prevEndDate)
            ->get();

        $prevRevenue = (float) $prevOrders->sum('total_harga');
        $prevOrdersCount = $prevOrders->count();
        $prevAov = $prevOrdersCount > 0 ? round($prevRevenue / $prevOrdersCount) : 0;
        $growthLabel = 'vs periode lalu';

        // If filtering broad year and previous period (2025) has no records,
        // compare latest active month vs previous month for meaningful insights
        if ($prevRevenue == 0 && $prevOrdersCount == 0 && $diffDays > 60) {
            $latestMonthOrder = $pesanans->first();
            if ($latestMonthOrder && $latestMonthOrder->tanggal_pesan) {
                $mDate = strtotime($latestMonthOrder->tanggal_pesan);
                $m = (int) date('n', $mDate);
                $y = (int) date('Y', $mDate);
                $prevM = $m - 1;
                $prevY = $y;
                if ($prevM < 1) { $prevM = 12; $prevY--; }

                $curMonthRev = (float) Pesanan::whereYear('tanggal_pesan', $y)->whereMonth('tanggal_pesan', $m)->sum('total_harga');
                $prevMonthRev = (float) Pesanan::whereYear('tanggal_pesan', $prevY)->whereMonth('tanggal_pesan', $prevM)->sum('total_harga');
                $curMonthCount = Pesanan::whereYear('tanggal_pesan', $y)->whereMonth('tanggal_pesan', $m)->count();
                $prevMonthCount = Pesanan::whereYear('tanggal_pesan', $prevY)->whereMonth('tanggal_pesan', $prevM)->count();

                if ($prevMonthRev > 0) {
                    $prevRevenue = $prevMonthRev;
                    $prevOrdersCount = $prevMonthCount;
                    $prevAov = $prevMonthCount > 0 ? round($prevMonthRev / $prevMonthCount) : 0;
                    $totalPendapatanForGrowth = $curMonthRev;
                    $totalTransaksiForGrowth = $curMonthCount;
                    $rataRataTransaksiForGrowth = $curMonthCount > 0 ? round($curMonthRev / $curMonthCount) : 0;
                    $growthLabel = 'vs bulan lalu';
                }
            }
        } else {
            $totalPendapatanForGrowth = $totalPendapatan;
            $totalTransaksiForGrowth = $totalTransaksi;
            $rataRataTransaksiForGrowth = $rataRataTransaksi;
        }

        if ($prevRevenue > 0) {
            $growthPendapatan = round((($totalPendapatanForGrowth - $prevRevenue) / $prevRevenue) * 100, 1);
        } else {
            $growthPendapatan = $totalPendapatan > 0 ? 100.0 : 0.0;
        }

        if ($prevOrdersCount > 0) {
            $growthPesanan = round((($totalTransaksiForGrowth - $prevOrdersCount) / $prevOrdersCount) * 100, 1);
        } else {
            $growthPesanan = $totalTransaksi > 0 ? 100.0 : 0.0;
        }

        if ($prevAov > 0) {
            $growthAov = round((($rataRataTransaksiForGrowth - $prevAov) / $prevAov) * 100, 1);
        } else {
            $growthAov = 0.0;
        }

        $pesananSelesai = $pesanans;

        // Monthly Trend from filtered orders (Sorted Chronologically)
        $monthlyTrendMap = [];
        $monthNamesIndo = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        // Pre-populate months in the current view range strictly up to current month ($currentMonth)
        $startCarbon = \Carbon\Carbon::parse($startDate);
        $endCarbon = \Carbon\Carbon::parse($endDate);
        if ($startCarbon->year == $currentYear && $endCarbon->year == $currentYear) {
            $startM = (int) $startCarbon->month;
            $endM = min((int) $endCarbon->month, $currentMonth);
            for ($m = $startM; $m <= $endM; $m++) {
                $k = sprintf('%04d-%02d', $currentYear, $m);
                $shortLabel = $monthNamesIndo[$m] ?? date('M', mktime(0, 0, 0, $m, 1));
                $monthlyTrendMap[$k] = [
                    'label' => $shortLabel,
                    'full_label' => $shortLabel . ' ' . $currentYear,
                    'total' => 0
                ];
            }
        }

        foreach ($pesanans as $p) {
            if (!$p->tanggal_pesan) continue;
            $time = strtotime($p->tanggal_pesan);
            $y = date('Y', $time);
            $mNum = (int) date('n', $time);
            $key = date('Y-m', $time);
            $shortLabel = $monthNamesIndo[$mNum] ?? date('M', $time);
            $fullLabel = $shortLabel . ' ' . $y;

            if (!isset($monthlyTrendMap[$key])) {
                $monthlyTrendMap[$key] = [
                    'label' => $shortLabel,
                    'full_label' => $fullLabel,
                    'total' => 0
                ];
            }
            $monthlyTrendMap[$key]['total'] += (float) $p->total_harga;
        }

        // Sort keys ascending chronologically
        ksort($monthlyTrendMap);

        if (empty($monthlyTrendMap)) {
            $trendLabels = [];
            $trendFullLabels = [];
            $trendValues = [];
            for ($m = 1; $m <= $currentMonth; $m++) {
                $lbl = $monthNamesIndo[$m] ?? 'Bln ' . $m;
                $trendLabels[] = $lbl;
                $trendFullLabels[] = $lbl . ' ' . $currentYear;
                $trendValues[] = 0;
            }
        } else {
            $trendLabels = array_column($monthlyTrendMap, 'label');
            $trendFullLabels = array_column($monthlyTrendMap, 'full_label');
            $trendValues = array_column($monthlyTrendMap, 'total');
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
            'rataRataTransaksi',
            'totalPiutang',
            'totalBelumLunasCount',
            'totalProdukTerjual',
            'growthPendapatan',
            'growthPesanan',
            'growthAov',
            'growthLabel',
            'activeRange',
            'pesananSelesai',
            'earliestDate',
            'latestDate',
            'latestAllowedDate',
            'startDate',
            'endDate',
            'currentYear',
            'currentMonth',
            'monthNamesIndo',
            'trendLabels',
            'trendFullLabels',
            'trendValues',
            'shareLabels',
            'sharePercentages'
        ));
    }
}
