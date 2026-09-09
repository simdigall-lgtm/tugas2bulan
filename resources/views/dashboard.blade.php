<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIPEKAN</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: #F8FAFC;
            color: #1E293B;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #FFFFFF;
            border-right: 1px solid #E2E8F0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 24px 20px 20px 24px;
        }

        .brand-name {
            font-size: 19px;
            font-weight: 800;
            color: #1E3A8A;
            letter-spacing: -0.3px;
        }

        .brand-tag {
            font-size: 12px;
            font-weight: 500;
            color: #64748B;
            margin-top: 2px;
        }

        .sidebar-menu {
            padding: 12px 14px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 8px;
            color: #475569;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .menu-item:hover {
            background-color: #F1F5F9;
            color: #1E3A8A;
        }

        .menu-item.active {
            background-color: #EEF2FF;
            color: #1E3A8A;
            font-weight: 700;
        }

        .menu-item i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .sidebar-bottom {
            padding: 16px 14px 20px 14px;
            border-top: 1px dashed #E2E8F0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        /* Main Content Wrapper */
        .main-wrapper {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* Top Header Navigation */
        .topbar {
            height: 68px;
            background-color: #FFFFFF;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .search-container {
            position: relative;
            width: 340px;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 14px;
        }

        .search-input {
            width: 100%;
            background-color: #F1F5F9;
            border: 1px solid transparent;
            border-radius: 8px;
            padding: 9px 14px 9px 38px;
            font-size: 13.5px;
            color: #1E293B;
            outline: none;
            transition: all 0.2s ease;
        }

        .search-input:focus {
            background-color: #FFFFFF;
            border-color: #CBD5E1;
            box-shadow: 0 0 0 3px rgba(226, 232, 240, 0.5);
        }

        .search-input::placeholder {
            color: #94A3B8;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icon-btn {
            background: none;
            border: none;
            color: #64748B;
            font-size: 17px;
            cursor: pointer;
            padding: 6px;
            border-radius: 50%;
            transition: color 0.2s ease;
            position: relative;
        }

        .icon-btn:hover {
            color: #1E293B;
            background-color: #F1F5F9;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .avatar-img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid #E2E8F0;
        }

        /* Content Body Area */
        .content-body {
            padding: 32px;
            flex: 1;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .page-title {
            font-size: 26px;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -0.5px;
        }

        .page-subtitle {
            font-size: 14px;
            color: #64748B;
            margin-top: 4px;
        }

        /* Metrics Cards Grid */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .metric-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            padding: 22px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            text-decoration: none;
            display: block;
            color: inherit;
            cursor: pointer;
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(30, 58, 138, 0.1);
            border-color: #1E3A8A;
        }

        .metric-card:hover .metric-icon-box {
            background-color: #1E3A8A;
            color: #FFFFFF;
            transition: all 0.2s ease;
        }

        .metric-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .metric-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .metric-icon-box {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background-color: #EFF6FF;
            color: #2563EB;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .metric-value {
            font-size: 28px;
            font-weight: 800;
            color: #0F172A;
            margin: 10px 0 6px 0;
            letter-spacing: -0.5px;
        }

        .metric-footer {
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .trend-up {
            color: #10B981;
        }

        .trend-period {
            color: #94A3B8;
            font-weight: 500;
        }

        /* Chart Section Styles */
        .charts-grid-2col {
            display: grid;
            grid-template-columns: 1.8fr 1fr;
            gap: 24px;
            margin-bottom: 28px;
        }

        .charts-grid-2col-equal {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 28px;
        }

        .chart-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            display: flex;
            flex-direction: column;
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 16px;
            font-weight: 700;
            color: #0F172A;
        }

        .chart-subtitle {
            font-size: 12px;
            color: #64748B;
            margin-top: 2px;
        }

        .chart-container {
            position: relative;
            flex: 1;
            min-height: 250px;
            width: 100%;
        }

        /* Recent Orders Table */
        .table-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid #F1F5F9;
        }

        .table-title {
            font-size: 16px;
            font-weight: 700;
            color: #0F172A;
        }

        .table-link {
            font-size: 13px;
            font-weight: 700;
            color: #2563EB;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .table-link:hover {
            color: #1D4ED8;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .custom-table th {
            background-color: #F8FAFC;
            padding: 11px 14px;
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #E2E8F0;
            white-space: nowrap;
        }

        .custom-table td {
            padding: 12px 14px;
            font-size: 13px;
            color: #334155;
            border-bottom: 1px solid #F1F5F9;
            font-weight: 500;
            vertical-align: middle;
        }

        .custom-table tr:last-child td {
            border-bottom: none;
        }

        .custom-table tr:hover td {
            background-color: #F8FAFC;
        }

        .order-code {
            font-weight: 700;
            color: #0F172A;
            white-space: nowrap;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-selesai {
            background-color: #DCFCE7;
            color: #15803D;
        }

        .status-diproses {
            background-color: #FEF3C7;
            color: #B45309;
        }

        .status-menunggu {
            background-color: #FFEDD5;
            color: #C2410C;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-wrapper {
                margin-left: 0;
            }
            .metrics-grid {
                grid-template-columns: 1fr;
            }
            .charts-grid-2col {
                grid-template-columns: 1fr;
            }
            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    @include('layouts.sidebar')

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        
        <!-- Top Navigation Bar -->
        @include('layouts.topbar')

        <!-- Content Body Area -->
        <main class="content-body">
            
            <div class="page-header">
                <h1 class="page-title">Ringkasan Dashboard</h1>
                <p class="page-subtitle">Metrik dan kinerja untuk SIPEKAN.</p>
            </div>

            <!-- Metrics Cards Grid -->
            <div class="metrics-grid">
                <!-- Card 1: TOTAL PELANGGAN -->
                <a href="{{ route('pelanggan') }}" class="metric-card" title="Klik untuk membuka Kelola Pelanggan">
                    <div class="metric-top">
                        <span class="metric-label">TOTAL PELANGGAN</span>
                        <div class="metric-icon-box">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                    <div class="metric-value">{{ $totalPelanggan ?? 0 }}</div>
                    <div class="metric-footer">
                        <span class="trend-up"><i class="fa-solid fa-arrow-up" style="font-size: 11px;"></i> +12%</span>
                        <span class="trend-period">vs bulan lalu</span>
                    </div>
                </a>

                <!-- Card 2: TOTAL PRODUK -->
                <a href="{{ route('produk') }}" class="metric-card" title="Klik untuk membuka Katalog Produk">
                    <div class="metric-top">
                        <span class="metric-label">TOTAL PRODUK</span>
                        <div class="metric-icon-box">
                            <i class="fa-solid fa-box-archive"></i>
                        </div>
                    </div>
                    <div class="metric-value">{{ $totalProduk ?? 0 }}</div>
                    <div class="metric-footer">
                        <span class="trend-up"><i class="fa-solid fa-circle-check" style="font-size: 11px;"></i> Aktif</span>
                        <span class="trend-period">di katalog</span>
                    </div>
                </a>

                <!-- Card 3: TOTAL PESANAN -->
                <a href="{{ route('pesanan') }}" class="metric-card" title="Klik untuk membuka Kelola Pesanan">
                    <div class="metric-top">
                        <span class="metric-label">TOTAL PESANAN</span>
                        <div class="metric-icon-box">
                            <i class="fa-solid fa-file-invoice"></i>
                        </div>
                    </div>
                    <div class="metric-value">{{ $totalPesanan ?? 0 }}</div>
                    <div class="metric-footer">
                        <span class="trend-up"><i class="fa-solid fa-arrow-up" style="font-size: 11px;"></i> +8.5%</span>
                        <span class="trend-period">vs bulan lalu</span>
                    </div>
                </a>

                <!-- Card 4: TOTAL PEMBAYARAN -->
                <a href="{{ route('pembayaran') }}" class="metric-card" title="Klik untuk membuka Kelola Pembayaran">
                    <div class="metric-top">
                        <span class="metric-label">TOTAL PEMBAYARAN</span>
                        <div class="metric-icon-box">
                            <i class="fa-solid fa-money-bill-trend-up"></i>
                        </div>
                    </div>
                    <div class="metric-value">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                    <div class="metric-footer">
                        <span class="trend-up"><i class="fa-solid fa-arrow-up" style="font-size: 11px;"></i> +15.3%</span>
                        <span class="trend-period">vs bulan lalu</span>
                    </div>
                </a>
            </div>

            <!-- Unified Charts Row: Sales Performance Trend & Product Categories -->
            <div class="charts-grid-2col">
                <!-- Main Line Chart: Monthly Performance -->
                <div class="chart-card">
                    <div class="chart-header">
                        <div>
                            <h3 class="chart-title">Tren Penjualan &amp; Pesanan</h3>
                            <p class="chart-subtitle">Performa pendapatan tahun 2026</p>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="mainSalesChart"></canvas>
                    </div>
                </div>

                <!-- Secondary Bar Chart: Product Categories -->
                <div class="chart-card">
                    <div class="chart-header">
                        <div>
                            <h2 class="chart-title">Penjualan Per Kategori</h2>
                            <p class="chart-subtitle">Total transaksi berdasarkan jenis produk</p>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="categoryBarChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="table-card">
                <div class="table-header">
                    <h2 class="table-title">Pesanan Terbaru</h2>
                    <a href="{{ route('pesanan') }}" class="table-link">Lihat Semua</a>
                </div>

                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>KODE PESANAN</th>
                                <th>PELANGGAN</th>
                                <th>PRODUK</th>
                                <th>TANGGAL</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesananTerbaru as $pesanan)
                            <tr>
                                <td class="order-code">{{ $pesanan->kode_pesanan }}</td>
                                <td>{{ $pesanan->nama_pelanggan }}</td>
                                <td>{{ $pesanan->nama_produk }}</td>
                                <td>{{ $pesanan->tanggal_pesan ? \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d M Y') : '-' }}</td>
                                <td>
                                    <span class="status-badge {{ strtolower($pesanan->status) == 'selesai' ? 'status-selesai' : (strtolower($pesanan->status) == 'diproses' ? 'status-diproses' : 'status-menunggu') }}">
                                        {{ $pesanan->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px; color: #64748B;">Belum ada data pesanan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- Chart.js Unified Initialization Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Global Chart Defaults for Consistency
            if (typeof Chart !== 'undefined') {
                Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
                Chart.defaults.color = '#64748B';
            }

            // 1. Main Sales Line Chart
            const canvasMain = document.getElementById('mainSalesChart');
            if (canvasMain && typeof Chart !== 'undefined') {
                const ctxMain = canvasMain.getContext('2d');
                
                // Create Gradient
                const gradientBlue = ctxMain.createLinearGradient(0, 0, 0, 300);
                gradientBlue.addColorStop(0, 'rgba(30, 58, 138, 0.16)');
                gradientBlue.addColorStop(1, 'rgba(30, 58, 138, 0.0)');

            new Chart(ctxMain, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [
                        {
                            label: 'Pendapatan Real',
                            data: {!! json_encode($monthlyRevenue ?? []) !!},
                            borderColor: '#1E3A8A',
                            backgroundColor: gradientBlue,
                            fill: true,
                            tension: 0.35,
                            borderWidth: 3,
                            pointBackgroundColor: '#1E3A8A',
                            pointRadius: 4,
                            pointHoverRadius: 6
                        },
                        {
                            label: 'Target Pendapatan',
                            data: {!! json_encode($monthlyTarget ?? []) !!},
                            borderColor: '#94A3B8',
                            borderDash: [5, 5],
                            fill: false,
                            tension: 0.35,
                            borderWidth: 2,
                            pointRadius: 0
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'end',
                            labels: {
                                usePointStyle: true,
                                pointStyleWidth: 8,
                                boxWidth: 8,
                                boxHeight: 8,
                                padding: 16,
                                font: { size: 12, weight: '600' }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#0F172A',
                            padding: 12,
                            titleFont: { size: 13, weight: '700' },
                            bodyFont: { size: 12 },
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || 'Pendapatan';
                                    let val = context.raw || 0;
                                    return ' ' + label + ': Rp ' + val.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false }
                        },
                        y: {
                            grid: { color: '#F1F5F9' },
                            ticks: {
                                callback: function(val) {
                                    if (val >= 1000000000) return 'Rp ' + (val / 1000000000) + ' M';
                                    if (val >= 1000000) return 'Rp ' + (val / 1000000) + ' Jt';
                                    return 'Rp ' + val.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
            }

            // 2. Category Sales Horizontal Bar Chart
            const canvasCategory = document.getElementById('categoryBarChart');
            if (canvasCategory && typeof Chart !== 'undefined') {
                const ctxCategory = canvasCategory.getContext('2d');
                new Chart(ctxCategory, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($categoryLabels ?? ['Banner/Spanduk', 'Brosur', 'Kartu Nama', 'Stiker', 'Buku/Kalender']) !!},
                        datasets: [{
                            label: 'Total Pesanan',
                            data: {!! json_encode($categoryCounts ?? [0, 0, 0, 0, 0]) !!},
                            backgroundColor: [
                                '#1E3A8A',
                                '#2563EB',
                                '#3B82F6',
                                '#60A5FA',
                                '#93C5FD'
                            ],
                            borderRadius: 6,
                            borderSkipped: false,
                            barThickness: 18
                        }]
                    },
                    options: {
                        animation: false,
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#0F172A',
                                padding: 12,
                                callbacks: {
                                    label: function(context) {
                                        return ' Total Pesanan: ' + context.raw + ' pesanan';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: { color: '#F1F5F9' },
                                ticks: {
                                    precision: 0,
                                    stepSize: 1
                                },
                                beginAtZero: true
                            },
                            y: {
                                grid: { display: false },
                                ticks: {
                                    font: { size: 12, weight: '600' },
                                    color: '#334155'
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @include('layouts.navbar_assets')
</body>
</html>
