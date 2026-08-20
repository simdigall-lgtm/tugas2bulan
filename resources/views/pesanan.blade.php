<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - CV Prima Grafika</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Plus Jakarta Sans',sans-serif;}
        body{background:#F8FAFC;color:#1E293B;display:flex;min-height:100vh;}
        .sidebar{width:250px;background:#fff;border-right:1px solid #E2E8F0;display:flex;flex-direction:column;justify-content:space-between;position:fixed;top:0;bottom:0;left:0;z-index:100;}
        .sidebar-brand{padding:24px 20px 20px 24px;}
        .brand-name{font-size:19px;font-weight:800;color:#1E3A8A;}
        .brand-tag{font-size:12px;color:#64748B;margin-top:2px;}
        .sidebar-menu{padding:12px 14px;display:flex;flex-direction:column;gap:4px;flex:1;}
        .menu-item{display:flex;align-items:center;gap:12px;padding:11px 16px;border-radius:8px;color:#475569;text-decoration:none;font-size:14px;font-weight:600;transition:all .2s;}
        .menu-item:hover{background:#F1F5F9;color:#1E3A8A;}
        .menu-item.active{background:#EEF2FF;color:#1E3A8A;font-weight:700;}
        .menu-item i{font-size:16px;width:20px;text-align:center;}
        .sidebar-bottom{padding:16px 14px 20px;border-top:1px dashed #E2E8F0;display:flex;flex-direction:column;gap:4px;}
        .main-wrapper{margin-left:250px;flex:1;display:flex;flex-direction:column;}
        .topbar{height:68px;background:#fff;border-bottom:1px solid #E2E8F0;display:flex;align-items:center;justify-content:space-between;padding:0 32px;position:sticky;top:0;z-index:90;}
        .search-wrap{position:relative;width:300px;}
        .search-wrap i{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#94A3B8;font-size:13px;}
        .search-wrap input{width:100%;background:#F1F5F9;border:1px solid transparent;border-radius:8px;padding:9px 14px 9px 36px;font-size:13.5px;outline:none;}
        .topbar-right{display:flex;align-items:center;gap:18px;}
        .icon-btn{background:none;border:none;color:#64748B;font-size:17px;cursor:pointer;padding:6px;border-radius:50%;}
        .avatar-img{width:36px;height:36px;border-radius:50%;object-fit:cover;border:1.5px solid #E2E8F0;}
        .content-body{padding:32px;flex:1;}
        .page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;}
        .page-title{font-size:26px;font-weight:800;color:#0F172A;letter-spacing:-.5px;}
        .page-subtitle{font-size:14px;color:#64748B;margin-top:4px;}
        .header-right{display:flex;align-items:center;gap:12px;}
        .search-filter{position:relative;width:260px;}
        .search-filter i{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#94A3B8;font-size:13px;}
        .search-filter input{width:100%;background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:9px 14px 9px 36px;font-size:13px;outline:none;}
        .btn-primary{background:#1B3B6F;color:#fff;border:none;padding:10px 18px;border-radius:8px;font-size:13.5px;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:8px;}
        .card{background:#fff;border-radius:12px;border:1px solid #E2E8F0;overflow:hidden;}
        table{width:100%;border-collapse:collapse;text-align:left;}
        thead th{padding:13px 20px;font-size:11.5px;font-weight:700;color:#64748B;text-transform:uppercase;letter-spacing:.5px;border-bottom:1px solid #E2E8F0;background:#fff;}
        tbody td{padding:16px 20px;font-size:13.5px;color:#334155;font-weight:500;border-bottom:1px solid #F1F5F9;vertical-align:middle;}
        tbody tr:last-child td{border-bottom:none;}
        tbody tr:hover td{background:#F8FAFC;}
        .order-code{color:#1E3A8A;font-weight:700;white-space:nowrap;}
        .customer-cell{display:flex;align-items:center;gap:10px;}
        .avatar-init{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;flex-shrink:0;}
        .product-sub{font-size:11.5px;color:#64748B;margin-top:2px;}
        .badge{display:inline-flex;align-items:center;justify-content:center;padding:4px 12px;border-radius:12px;font-size:11.5px;font-weight:700;white-space:nowrap;}
        .badge-menunggu{background:#FEF3C7;color:#D97706;}
        .badge-diproses{background:#DBEAFE;color:#2563EB;}
        .badge-selesai{background:#DCFCE7;color:#16A34A;}
        .action-btn{background:none;border:none;color:#94A3B8;font-size:16px;cursor:pointer;width:30px;height:30px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;}
        .action-btn:hover{background:#F1F5F9;color:#1E3A8A;}
        .table-footer{padding:16px 20px;display:flex;align-items:center;justify-content:space-between;border-top:1px solid #E2E8F0;}
        .entry-info{font-size:12.5px;color:#64748B;}
        .pagination{display:flex;align-items:center;gap:4px;}
        .page-btn{min-width:32px;height:32px;border-radius:6px;border:1px solid #E2E8F0;background:#fff;color:#475569;font-size:13px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;}
        .page-btn.active{background:#1B3B6F;border-color:#1B3B6F;color:#fff;}
        @media (max-width: 768px) {
            .page-header { flex-direction: column; align-items: flex-start; gap: 16px; }
            .header-right { flex-direction: column; align-items: stretch; width: 100%; }
            .search-filter, .search-filter input { width: 100%; }
            .btn-primary { width: 100%; justify-content: center; }
            .table-footer { flex-direction: column; gap: 16px; }
        }
    </style>
</head>
<body>
@include('layouts.sidebar')

<div class="main-wrapper">
    @include('layouts.topbar')

    <main class="content-body">
        <div class="page-header">
            <div>
                <h1 class="page-title">Kelola Pesanan</h1>
                <p class="page-subtitle">Pantau dan kelola seluruh transaksi cetak pelanggan.</p>
            </div>
            <div class="header-right">
                <div class="search-filter">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari kode, pelanggan...">
                </div>
                <button class="btn-primary"><i class="fa-solid fa-plus"></i> Buat Pesanan Baru</button>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table>
                <thead>
                    <tr>
                        <th>KODE</th>
                        <th>PELANGGAN</th>
                        <th>PRODUK</th>
                        <th>JML &amp; UKURAN</th>
                        <th>TOTAL HARGA</th>
                        <th>STATUS</th>
                        <th style="text-align:right;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="order-code">ORD-2023-007</td>
                        <td>
                            <div class="customer-cell">
                                <div class="avatar-init" style="background:#DBEAFE;color:#1D4ED8;">PT</div>
                                <span>PT. Maju Bersama</span>
                            </div>
                        </td>
                        <td>Brosur A4 Lipat 3</td>
                        <td><div>1000 pcs</div><div class="product-sub">A4 (21 × 29,7 cm)</div></td>
                        <td>Rp 1.500.000</td>
                        <td><span class="badge badge-diproses">Diproses</span></td>
                        <td style="text-align:right;"><button class="action-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                    </tr>
                    <tr>
                        <td class="order-code">ORD-2023-006</td>
                        <td>
                            <div class="customer-cell">
                                <div class="avatar-init" style="background:#DCFCE7;color:#15803D;">CV</div>
                                <span>CV. Karya Abadi</span>
                            </div>
                        </td>
                        <td>Kartu Nama 2 Sisi</td>
                        <td><div>5 box</div><div class="product-sub">9 × 5,5 cm</div></td>
                        <td>Rp 125.000</td>
                        <td><span class="badge badge-selesai">Selesai</span></td>
                        <td style="text-align:right;"><button class="action-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                    </tr>
                    <tr>
                        <td class="order-code">ORD-2023-005</td>
                        <td>
                            <div class="customer-cell">
                                <div class="avatar-init" style="background:#FEF3C7;color:#D97706;">IH</div>
                                <span>Ibu Hani</span>
                            </div>
                        </td>
                        <td>Spanduk Vinyl 280gr</td>
                        <td><div>1 pcs</div><div class="product-sub">400 × 100 cm</div></td>
                        <td>Rp 80.000</td>
                        <td><span class="badge badge-menunggu">Menunggu</span></td>
                        <td style="text-align:right;"><button class="action-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                    </tr>
                    <tr>
                        <td class="order-code">ORD-2023-004</td>
                        <td>
                            <div class="customer-cell">
                                <div class="avatar-init" style="background:#EDE9FE;color:#7C3AED;">UD</div>
                                <span>UD. Sumber Rejeki</span>
                            </div>
                        </td>
                        <td>Stiker Kromo A3+</td>
                        <td><div>50 lembar</div><div class="product-sub">32 × 48 cm</div></td>
                        <td>Rp 350.000</td>
                        <td><span class="badge badge-diproses">Diproses</span></td>
                        <td style="text-align:right;"><button class="action-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                    </tr>
                    <tr>
                        <td class="order-code">ORD-2023-003</td>
                        <td>
                            <div class="customer-cell">
                                <div class="avatar-init" style="background:#DBEAFE;color:#1D4ED8;">PT</div>
                                <span>PT. Global Tech</span>
                            </div>
                        </td>
                        <td>Company Profile</td>
                        <td><div>20 buku</div><div class="product-sub">A4, 12 Halaman</div></td>
                        <td>Rp 2.400.000</td>
                        <td><span class="badge badge-selesai">Selesai</span></td>
                        <td style="text-align:right;"><button class="action-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                    </tr>
                    <tr>
                        <td class="order-code">ORD-2023-002</td>
                        <td>
                            <div class="customer-cell">
                                <div class="avatar-init" style="background:#FEF3C7;color:#D97706;">BP</div>
                                <span>Bpk. Budi</span>
                            </div>
                        </td>
                        <td>Undangan Pernikahan</td>
                        <td><div>300 pcs</div><div class="product-sub">Custom 15×15 cm</div></td>
                        <td>Rp 1.800.000</td>
                        <td><span class="badge badge-menunggu">Menunggu</span></td>
                        <td style="text-align:right;"><button class="action-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                    </tr>
                    <tr>
                        <td class="order-code">ORD-2023-001</td>
                        <td>
                            <div class="customer-cell">
                                <div class="avatar-init" style="background:#DCFCE7;color:#15803D;">CV</div>
                                <span>CV. Media Kreatif</span>
                            </div>
                        </td>
                        <td>Poster A2 Glossy</td>
                        <td><div>10 pcs</div><div class="product-sub">42 × 59,4 cm</div></td>
                        <td>Rp 450.000</td>
                        <td><span class="badge badge-selesai">Selesai</span></td>
                        <td style="text-align:right;"><button class="action-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                     </tr>
                </tbody>
            </table>
        </div>
            <div class="table-footer">
                <div class="entry-info">Menampilkan 1-7 dari 24 pesanan</div>
                <div class="pagination">
                    <button class="page-btn"><i class="fa-solid fa-chevron-left" style="font-size:11px;"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn"><i class="fa-solid fa-chevron-right" style="font-size:11px;"></i></button>
                </div>
            </div>
        </div>
    </main>
</div>
@include('layouts.navbar_assets')
</body>
</html>
