<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan & Statistik - CV Prima Grafika</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',-apple-system,BlinkMacSystemFont,sans-serif; }
        body { background-color:#F8FAFC; color:#1E293B; display:flex; min-height:100vh; }

        .sidebar { width:250px; background:#FFFFFF; border-right:1px solid #E2E8F0; display:flex; flex-direction:column; justify-content:space-between; position:fixed; top:0; bottom:0; left:0; z-index:100; }
        .sidebar-brand { padding:24px 20px 20px 24px; }
        .brand-name { font-size:19px; font-weight:800; color:#1E3A8A; letter-spacing:-0.3px; }
        .brand-tag { font-size:12px; font-weight:500; color:#64748B; margin-top:2px; }
        .sidebar-menu { padding:12px 14px; display:flex; flex-direction:column; gap:4px; flex:1; }
        .menu-item { display:flex; align-items:center; gap:12px; padding:11px 16px; border-radius:8px; color:#475569; text-decoration:none; font-size:14px; font-weight:600; transition:all 0.2s ease; }
        .menu-item:hover { background-color:#F1F5F9; color:#1E3A8A; }
        .menu-item.active { background-color:#EEF2FF; color:#1E3A8A; font-weight:700; }
        .menu-item i { font-size:16px; width:20px; text-align:center; }
        .sidebar-bottom { padding:16px 14px 20px; border-top:1px dashed #E2E8F0; display:flex; flex-direction:column; gap:4px; }

        .main-wrapper { margin-left:250px; flex:1; display:flex; flex-direction:column; min-width:0; }
        .topbar { height:68px; background:#FFFFFF; border-bottom:1px solid #E2E8F0; display:flex; align-items:center; justify-content:space-between; padding:0 32px; position:sticky; top:0; z-index:90; }
        .search-container { position:relative; width:340px; }
        .search-icon { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#94A3B8; font-size:14px; }
        .search-input { width:100%; background:#F1F5F9; border:1px solid transparent; border-radius:8px; padding:9px 14px 9px 38px; font-size:13.5px; color:#1E293B; outline:none; }
        .topbar-right { display:flex; align-items:center; gap:20px; }
        .icon-btn { background:none; border:none; color:#64748B; font-size:17px; cursor:pointer; padding:6px; border-radius:50%; }
        .avatar-img { width:36px; height:36px; border-radius:50%; object-fit:cover; border:1.5px solid #E2E8F0; }

        .content-body { padding:32px; flex:1; }

        .page-header-row { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
        .page-title { font-size:26px; font-weight:800; color:#0F172A; letter-spacing:-0.5px; }
        .page-subtitle { font-size:14px; color:#64748B; margin-top:4px; }
        .header-actions { display:flex; gap:12px; }

        .btn-export { display:flex; align-items:center; gap:8px; padding:10px 18px; border-radius:8px; font-size:13.5px; font-weight:700; cursor:pointer; border:1.5px solid #CBD5E1; background:#FFFFFF; color:#334155; transition:all 0.2s ease; }
        .btn-export:hover { background:#F1F5F9; }
        .btn-export.primary { background:#1B3B6F; border-color:#1B3B6F; color:#FFFFFF; }
        .btn-export.primary:hover { background:#142F5B; }

        /* Filter Date Bar */
        .filter-card { background:#FFFFFF; border:1px solid #E2E8F0; border-radius:12px; padding:20px 24px; margin-bottom:24px; display:flex; align-items:flex-end; gap:16px; }
        .filter-card .form-group { flex:1; }
        .filter-card label { display:block; font-size:12.5px; font-weight:700; color:#334155; margin-bottom:6px; }
        .filter-card input { width:100%; border:1px solid #CBD5E1; border-radius:8px; padding:9px 14px; font-size:13.5px; color:#0F172A; outline:none; }
        .btn-filter { background:#1B3B6F; color:#FFFFFF; border:none; padding:10px 24px; border-radius:8px; font-weight:700; font-size:13.5px; cursor:pointer; white-space:nowrap; }

        /* Stat Cards */
        .stats-row { display:grid; grid-template-columns:repeat(3, 1fr); gap:20px; margin-bottom:24px; }
        .stat-card { background:#FFFFFF; border:1px solid #E2E8F0; border-radius:12px; padding:20px 24px; display:flex; align-items:center; gap:16px; }
        .stat-icon { width:48px; height:48px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
        .stat-icon.blue { background:#DBEAFE; color:#1D4ED8; }
        .stat-icon.green { background:#DCFCE7; color:#15803D; }
        .stat-icon.purple { background:#EDE9FE; color:#7C3AED; }
        .stat-label { font-size:11px; font-weight:700; color:#64748B; text-transform:uppercase; letter-spacing:0.5px; }
        .stat-value { font-size:24px; font-weight:800; color:#0F172A; margin-top:4px; letter-spacing:-0.5px; }

        /* Laporan Charts Layout */
        .card { background:#FFFFFF; border:1px solid #E2E8F0; border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,0.02); }
        .card-title { font-size:16px; font-weight:800; color:#0F172A; margin-bottom:16px; }
        .charts-row-laporan { display:grid; grid-template-columns:1.6fr 1fr; gap:24px; margin-bottom:24px; }
        .chart-container-laporan { position:relative; height:260px; width:100%; }

        /* Table */
        .card-header-row { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
        .card-link { font-size:13px; font-weight:700; color:#1E3A8A; text-decoration:none; }
        .custom-table { width:100%; border-collapse:collapse; text-align:left; }
        .custom-table th { background:#FFFFFF; padding:11px 14px; font-size:11px; font-weight:700; color:#64748B; text-transform:uppercase; letter-spacing:0.5px; border-bottom:1px solid #E2E8F0; }
        .custom-table td { padding:14px; font-size:13px; color:#334155; border-bottom:1px solid #F1F5F9; font-weight:500; vertical-align:middle; }
        .custom-table tr:last-child td { border-bottom:none; }
        .inv-code { color:#1E3A8A; font-weight:700; white-space:nowrap; }

        .status-badge { display:inline-flex; align-items:center; justify-content:center; padding:4px 10px; border-radius:12px; font-size:11px; font-weight:700; white-space:nowrap; }
        .status-selesai { background:#DCFCE7; color:#16A34A; }
        .status-proses { background:#FEF3C7; color:#D97706; }
        .status-desain { background:#DBEAFE; color:#1D4ED8; }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .page-header-row { flex-direction: column; align-items: flex-start; gap: 16px; }
            .header-actions { width: 100%; flex-direction: column; }
            .header-actions button { width: 100%; justify-content: center; }
            .filter-card { flex-direction: column; align-items: stretch; gap: 12px; }
            .stats-row { grid-template-columns: 1fr; }
            .charts-row-laporan { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    @include('layouts.sidebar')

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        @include('layouts.topbar')

        <main class="content-body">
            <!-- Page Header -->
            <div class="page-header-row">
                <div>
                    <h1 class="page-title">Laporan & Statistik</h1>
                    <p class="page-subtitle">Ringkasan performa dan transaksi percetakan.</p>
                </div>
                <div class="header-actions">
                    <button class="btn-export"><i class="fa-regular fa-file-pdf"></i> Cetak PDF</button>
                    <button class="btn-export primary"><i class="fa-regular fa-file-excel"></i> Export Excel</button>
                </div>
            </div>

            <!-- Date Range Filter -->
            <div class="filter-card">
                <div class="form-group">
                    <label>Tanggal Awal</label>
                    <input type="date" value="2023-10-01">
                </div>
                <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <input type="date" value="2023-10-31">
                </div>
                <button class="btn-filter">Tampilkan</button>
            </div>

            <!-- Stat Cards -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fa-solid fa-file-invoice"></i></div>
                    <div>
                        <div class="stat-label">TOTAL PESANAN</div>
                        <div class="stat-value">1,248</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fa-solid fa-money-bill-trend-up"></i></div>
                    <div>
                        <div class="stat-label">TOTAL PENDAPATAN</div>
                        <div class="stat-value">Rp 48,5 jt</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon purple"><i class="fa-solid fa-users"></i></div>
                    <div>
                        <div class="stat-label">TOTAL PELANGGAN</div>
                        <div class="stat-value">342</div>
                    </div>
                </div>
            </div>

            <!-- Charts Row: Monthly Performance + Category Revenue -->
            <div class="charts-row-laporan">
                <!-- Pendapatan & Profit Line Chart -->
                <div class="card">
                    <h2 class="card-title">Tren Pendapatan & Laba Bersih (2024)</h2>
                    <div class="chart-container-laporan">
                        <canvas id="laporanTrendChart"></canvas>
                    </div>
                </div>

                <!-- Product Revenue Doughnut Chart -->
                <div class="card">
                    <h2 class="card-title">Kontribusi Omzet Produk</h2>
                    <div class="chart-container-laporan">
                        <canvas id="laporanShareChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Detail Transaksi Table -->
            <div class="card">
                <div class="card-header-row">
                    <h2 class="card-title" style="margin-bottom:0;">Detail Transaksi Terbaru</h2>
                    <a href="{{ route('pesanan') }}" class="card-link">Lihat Semua Pesanan</a>
                </div>

                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>NO. FAKTUR</th>
                                <th>PELANGGAN</th>
                                <th>TANGGAL SELESAI</th>
                                <th>PRODUK</th>
                                <th>NILAI TRANSAKSI</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="inv-code">INV/23/10/085</td>
                                <td>PT. Mega Bangun</td>
                                <td>24 Okt 2023</td>
                                <td>Cetak Biru (A0)</td>
                                <td>Rp 1.250.000</td>
                                <td><span class="status-badge status-selesai">Selesai</span></td>
                            </tr>
                            <tr>
                                <td class="inv-code">INV/23/10/084</td>
                                <td>Dinas Pendidikan</td>
                                <td>24 Okt 2023</td>
                                <td>Buku Panduan 50hlm</td>
                                <td>Rp 12.500.000</td>
                                <td><span class="status-badge status-proses">Proses Jilid</span></td>
                            </tr>
                            <tr>
                                <td class="inv-code">INV/23/10/083</td>
                                <td>Toko Makmur Jaya</td>
                                <td>23 Okt 2023</td>
                                <td>Brosur Promosi</td>
                                <td>Rp 850.000</td>
                                <td><span class="status-badge status-selesai">Selesai</span></td>
                            </tr>
                            <tr>
                                <td class="inv-code">INV/23/10/082</td>
                                <td>CV. Karya Cipta</td>
                                <td>22 Okt 2023</td>
                                <td>Spanduk 3x1m</td>
                                <td>Rp 150.000</td>
                                <td><span class="status-badge status-desain">Proses Desain</span></td>
                            </tr>
                            <tr>
                                <td class="inv-code">INV/23/10/081</td>
                                <td>Rumah Sakit Bunda</td>
                                <td>21 Okt 2023</td>
                                <td>Form Rekam Medis</td>
                                <td>Rp 3.400.000</td>
                                <td><span class="status-badge status-selesai">Selesai</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Chart.js Scripts Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
            Chart.defaults.color = '#64748B';

            // 1. Laporan Trend Line Chart
            const ctxTrend = document.getElementById('laporanTrendChart').getContext('2d');
            const gradientBlue = ctxTrend.createLinearGradient(0, 0, 0, 250);
            gradientBlue.addColorStop(0, 'rgba(30, 58, 138, 0.15)');
            gradientBlue.addColorStop(1, 'rgba(30, 58, 138, 0.0)');

            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Pendapatan Kotor (Jt)',
                        data: [28, 35, 30, 42, 38, 55, 62, 58, 70, 78, 85, 98],
                        borderColor: '#1E3A8A',
                        backgroundColor: gradientBlue,
                        fill: true,
                        tension: 0.35,
                        borderWidth: 3
                    }, {
                        label: 'Laba Bersih (Jt)',
                        data: [12, 16, 14, 20, 18, 26, 30, 27, 34, 38, 42, 50],
                        borderColor: '#2563EB',
                        backgroundColor: 'transparent',
                        borderDash: [5, 5],
                        tension: 0.35,
                        borderWidth: 2.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', align: 'end', labels: { usePointStyle: true, font: { weight: '600' } } },
                        tooltip: { backgroundColor: '#0F172A', padding: 12 }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            grid: { color: '#F1F5F9' },
                            ticks: { callback: function(val) { return 'Rp ' + val + 'M'; } }
                        }
                    }
                }
            });

            // 2. Laporan Share Bar Chart
            const ctxShare = document.getElementById('laporanShareChart').getContext('2d');
            new Chart(ctxShare, {
                type: 'bar',
                data: {
                    labels: ['Digital', 'Offset', 'Large Format', 'Sablon'],
                    datasets: [{
                        label: 'Persentase Omzet (%)',
                        data: [42, 28, 18, 12],
                        backgroundColor: ['#1E3A8A', '#2563EB', '#3B82F6', '#60A5FA'],
                        borderRadius: 8,
                        barThickness: 24
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { backgroundColor: '#0F172A', padding: 12 }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            grid: { color: '#F1F5F9' },
                            ticks: { callback: function(val) { return val + '%'; } }
                        }
                    }
                }
            });
        });
    </script>
    @include('layouts.navbar_assets')
</body>
</html>
