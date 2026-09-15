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

        $monthNamesIndo = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        // Check view granularities
        $isSingleDayView = ($startDate === $endDate);
        $startCarbon = \Carbon\Carbon::parse($startDate);
        $endCarbon = \Carbon\Carbon::parse($endDate);
        $diffDays = $startCarbon->diffInDays($endCarbon);

        if ($isSingleDayView) {
            // 1. Hourly Trend for Single Day (Hari Ini): Waktu Lokal WIB (Asia/Jakarta)
            $hourlyBuckets = [
                '08:00' => '08:00',
                '10:00' => '10:00',
                '12:00' => '12:00',
                '14:00' => '14:00',
                '16:00' => '16:00',
                '18:00' => '18:00',
                '20:00' => '20:00',
                '22:00' => '22:00',
            ];
            $todayHoursMap = [];
            foreach ($hourlyBuckets as $k => $label) {
                $todayHoursMap[$k] = [
                    'label' => $label,
                    'full_label' => "Pukul {$label} WIB (" . date('d M Y', strtotime($startDate)) . ")",
                    'total' => 0
                ];
            }

            foreach ($pesanans as $p) {
                // Pastikan created_at dikonversi ke WIB (Asia/Jakarta) agar selaras dengan jam navbar
                if ($p->created_at) {
                    $timeWib = $p->created_at->copy()->setTimezone('Asia/Jakarta');
                    $h = (int) $timeWib->format('H');
                } else {
                    $h = 12;
                }

                if ($h < 9) $slot = '08:00';
                elseif ($h < 11) $slot = '10:00';
                elseif ($h < 13) $slot = '12:00';
                elseif ($h < 15) $slot = '14:00';
                elseif ($h < 17) $slot = '16:00';
                elseif ($h < 19) $slot = '18:00';
                elseif ($h < 21) $slot = '20:00';
                else $slot = '22:00';

                $todayHoursMap[$slot]['total'] += (float) $p->total_harga;
            }

            $trendLabels = array_column($todayHoursMap, 'label');
            $trendFullLabels = array_column($todayHoursMap, 'full_label');
            $trendValues = array_column($todayHoursMap, 'total');
        } elseif ($diffDays <= 31) {
            // 2. Daily Trend for 1 Month or Range <= 31 Days (Bulan Ini): Harian
            $dailyTrendMap = [];
            $curr = $startCarbon->copy();
            while ($curr->lte($endCarbon)) {
                $dStr = $curr->toDateString();
                $shortLabel = $curr->format('d M');
                $mIndo = $monthNamesIndo[(int)$curr->format('n')] ?? $curr->format('M');
                $fullLabel = $curr->format('j') . ' ' . $mIndo . ' ' . $curr->format('Y');
                $dailyTrendMap[$dStr] = [
                    'label' => $shortLabel,
                    'full_label' => $fullLabel,
                    'total' => 0
                ];
                $curr->addDay();
            }

            foreach ($pesanans as $p) {
                if (!$p->tanggal_pesan) continue;
                $dStr = date('Y-m-d', strtotime($p->tanggal_pesan));
                if (isset($dailyTrendMap[$dStr])) {
                    $dailyTrendMap[$dStr]['total'] += (float) $p->total_harga;
                }
            }

            $trendLabels = array_column($dailyTrendMap, 'label');
            $trendFullLabels = array_column($dailyTrendMap, 'full_label');
            $trendValues = array_column($dailyTrendMap, 'total');
        } else {
            // 3. Monthly Trend for Ranges > 31 Days (Kuartal, Tahun Ini): Bulanan
            $monthlyTrendMap = [];

            // Pre-populate months in the current view range strictly up to current month ($currentMonth)
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
        }

        // Product Revenue Contribution
        $productShareMap = [];
        $totalRev = max(1, $totalPendapatan);
        foreach ($pesanans as $p) {
            $rawProd = $p->nama_produk ?: 'Lainnya';
            $prod = trim(preg_replace('/\s*\(\+.*?\)/i', '', $rawProd));
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
