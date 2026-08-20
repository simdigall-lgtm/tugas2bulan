<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pembayaran - CV Prima Grafika</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
        .page-header-row { margin-bottom:24px; }
        .page-title { font-size:26px; font-weight:800; color:#0F172A; letter-spacing:-0.5px; }
        .page-subtitle { font-size:14px; color:#64748B; margin-top:4px; }

        .grid-2col { display:grid; grid-template-columns:1fr 1.8fr; gap:24px; align-items:start; }
        .card { background:#FFFFFF; border-radius:12px; border:1px solid #E2E8F0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.02); padding:24px; }
        .card-title { font-size:17px; font-weight:800; color:#0F172A; margin-bottom:20px; }

        .card-header { display:flex; align-items:center; gap:10px; margin-bottom:20px; }
        .card-header-icon { width:32px; height:32px; background:#DBEAFE; border-radius:8px; display:flex; align-items:center; justify-content:center; color:#1E3A8A; font-size:14px; }

        .form-group { margin-bottom:16px; }
        .form-group label { display:block; font-size:13px; font-weight:700; color:#334155; margin-bottom:6px; }
        .form-control { width:100%; border:1px solid #CBD5E1; border-radius:8px; padding:10px 14px; font-size:13.5px; color:#0F172A; outline:none; background:#FFFFFF; }
        .form-control:focus { border-color:#1E3A8A; box-shadow:0 0 0 3px rgba(30,58,138,0.1); }

        .btn-submit { width:100%; background:#1B3B6F; color:#FFFFFF; border:none; padding:11px 20px; border-radius:8px; font-weight:700; font-size:14px; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; margin-top:20px; }

        .filter-bar { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
        .filter-search { position:relative; width:220px; }
        .filter-search input { width:100%; background:#FFFFFF; border:1px solid #E2E8F0; border-radius:8px; padding:8px 12px 8px 34px; font-size:13px; outline:none; }
        .filter-search .search-icon { left:11px; font-size:13px; }

        .custom-table { width:100%; border-collapse:collapse; text-align:left; }
        .custom-table th { background:#FFFFFF; padding:12px 14px; font-size:11px; font-weight:700; color:#64748B; text-transform:uppercase; letter-spacing:0.5px; border-bottom:1px solid #E2E8F0; white-space:nowrap; }
        .custom-table td { padding:14px; font-size:13px; color:#334155; border-bottom:1px solid #F1F5F9; font-weight:500; vertical-align:middle; }
        .custom-table tr:last-child td { border-bottom:none; }
        .custom-table tr:hover td { background:#F8FAFC; }

        .pay-id { font-weight:700; color:#0F172A; white-space:nowrap; }
        .order-link { color:#1E3A8A; font-weight:700; text-decoration:none; white-space:nowrap; }

        .status-badge { display:inline-flex; align-items:center; justify-content:center; padding:4px 10px; border-radius:12px; font-size:11px; font-weight:700; white-space:nowrap; }
        .status-lunas { background:#DCFCE7; color:#16A34A; }
        .status-menunggu { background:#FEF3C7; color:#D97706; }

        .table-footer { padding-top:16px; margin-top:8px; display:flex; align-items:center; justify-content:space-between; border-top:1px solid #E2E8F0; }
        .entry-info { font-size:12px; color:#64748B; font-weight:500; }
        .pagination { display:flex; align-items:center; gap:4px; }
        .page-btn { min-width:80px; height:32px; padding:0 12px; border-radius:6px; border:1px solid #E2E8F0; background:#FFFFFF; color:#475569; font-size:12.5px; font-weight:600; cursor:pointer; }
        .page-btn.active { background:#1B3B6F; border-color:#1B3B6F; color:#FFFFFF; font-weight:700; min-width:32px; }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .grid-2col { grid-template-columns: 1fr; }
            .filter-bar { flex-direction: column; align-items: flex-start; gap: 12px; }
            .filter-search, .filter-search input { width: 100%; }
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
            <div class="page-header-row">
                <h1 class="page-title">Kelola Pembayaran</h1>
                <p class="page-subtitle">Catat dan lacak pembayaran pelanggan.</p>
            </div>

            <div class="grid-2col">
                <!-- Left Card - Form Pembayaran Baru -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-icon"><i class="fa-solid fa-credit-card"></i></div>
                        <h2 class="card-title" style="margin-bottom:0;">Pembayaran Baru</h2>
                    </div>

                    <form>
                        <div class="form-group">
                            <label for="payOrder">Pilih Pesanan</label>
                            <select id="payOrder" class="form-control">
                                <option value="">Pilih pesanan...</option>
                                <option value="ORD-2023-045">ORD-2023-045 – PT. Abadi Jaya</option>
                                <option value="ORD-2023-042">ORD-2023-042 – CV. Karya Abadi</option>
                                <option value="ORD-2023-039">ORD-2023-039 – Ibu Hani</option>
                                <option value="ORD-2023-035">ORD-2023-035 – UD. Sumber Rejeki</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payDate">Tanggal Pembayaran</label>
                            <input type="date" id="payDate" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="payMethod">Metode Pembayaran</label>
                            <select id="payMethod" class="form-control">
                                <option value="">Pilih metode...</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="QRIS">QRIS</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Kartu Debit">Kartu Debit</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payAmount">Jumlah (IDR)</label>
                            <input type="text" id="payAmount" class="form-control" placeholder="Rp 0">
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fa-regular fa-floppy-disk"></i>
                            <span>Simpan Pembayaran</span>
                        </button>
                    </form>
                </div>

                <!-- Right Card - Pembayaran Terbaru Table -->
                <div class="card">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
                        <h2 class="card-title" style="margin-bottom:0;">Pembayaran Terbaru</h2>
                        <div class="filter-search">
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                            <input type="text" placeholder="Cari pembayaran...">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>NO. PEMBAYARAN</th>
                                    <th>PESANAN</th>
                                    <th>TANGGAL</th>
                                    <th>METODE</th>
                                    <th>JUMLAH</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pay-id">PAY-1007</td>
                                    <td><a href="#" class="order-link">ORD-2023-045</a></td>
                                    <td>27 Okt 2023</td>
                                    <td>Transfer Bank</td>
                                    <td>Rp 2.450.000</td>
                                    <td><span class="status-badge status-menunggu">Menunggu Verifikasi</span></td>
                                </tr>
                                <tr>
                                    <td class="pay-id">PAY-1006</td>
                                    <td><a href="#" class="order-link">ORD-2023-042</a></td>
                                    <td>27 Okt 2023</td>
                                    <td>QRIS</td>
                                    <td>Rp 125.000</td>
                                    <td><span class="status-badge status-lunas">Lunas</span></td>
                                </tr>
                                <tr>
                                    <td class="pay-id">PAY-1005</td>
                                    <td><a href="#" class="order-link">ORD-2023-039</a></td>
                                    <td>26 Okt 2023</td>
                                    <td>Tunai</td>
                                    <td>Rp 500.000</td>
                                    <td><span class="status-badge status-lunas">Lunas</span></td>
                                </tr>
                                <tr>
                                    <td class="pay-id">PAY-1004</td>
                                    <td><a href="#" class="order-link">ORD-2023-035</a></td>
                                    <td>25 Okt 2023</td>
                                    <td>Transfer Bank</td>
                                    <td>Rp 3.200.000</td>
                                    <td><span class="status-badge status-lunas">Lunas</span></td>
                                </tr>
                                <tr>
                                    <td class="pay-id">PAY-1003</td>
                                    <td><a href="#" class="order-link">ORD-2023-018</a></td>
                                    <td>23 Okt 2023</td>
                                    <td>QRIS</td>
                                    <td>Rp 75.000</td>
                                    <td><span class="status-badge status-menunggu">Menunggu Verifikasi</span></td>
                                </tr>
                                <tr>
                                    <td class="pay-id">PAY-1002</td>
                                    <td><a href="#" class="order-link">ORD-2023-014</a></td>
                                    <td>24 Okt 2023</td>
                                    <td>Tunai</td>
                                    <td>Rp 250.000</td>
                                    <td><span class="status-badge status-lunas">Lunas</span></td>
                                </tr>
                                <tr>
                                    <td class="pay-id">PAY-1001</td>
                                    <td><a href="#" class="order-link">ORD-2023-001</a></td>
                                    <td>24 Okt 2023</td>
                                    <td>Transfer Bank</td>
                                    <td>Rp 1.500.000</td>
                                    <td><span class="status-badge status-lunas">Lunas</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        <div class="entry-info">Menampilkan 1 hingga 7 dari 42 data</div>
                        <div class="pagination">
                            <button class="page-btn">Sebelumnya</button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn" style="min-width:32px;">2</button>
                            <button class="page-btn">Selanjutnya</button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    @include('layouts.navbar_assets')
</body>
</html>
