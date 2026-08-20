<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - CV Prima Grafika</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

        /* Main Wrapper */
        .main-wrapper {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* Topbar Header */
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

        .page-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
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

        .btn-add {
            background-color: #1B3B6F;
            color: #FFFFFF;
            font-weight: 700;
            font-size: 14px;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        /* Two Column Layout */
        .grid-2col {
            display: grid;
            grid-template-columns: 1.8fr 1fr;
            gap: 24px;
            align-items: start;
        }

        /* Left Card - Katalog Produk */
        .card {
            background-color: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        .card-header-row {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #F1F5F9;
        }

        .card-title {
            font-size: 17px;
            font-weight: 800;
            color: #0F172A;
        }

        .filter-input-box {
            position: relative;
            width: 240px;
        }

        .filter-input-box input {
            width: 100%;
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 7px 12px 7px 34px;
            font-size: 13px;
            color: #1E293B;
            outline: none;
        }

        .filter-input-box .search-icon {
            left: 11px;
            font-size: 13px;
        }

        /* Custom Table */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .custom-table th {
            background-color: #FFFFFF;
            padding: 14px 24px;
            font-size: 11.5px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #E2E8F0;
        }

        .custom-table td {
            padding: 16px 24px;
            font-size: 13.5px;
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

        .product-name {
            font-weight: 700;
            color: #0F172A;
        }

        .category-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 10px;
            border-radius: 6px;
            background-color: #F1F5F9;
            color: #475569;
            font-size: 11.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .price-text {
            font-weight: 600;
            color: #1E293B;
        }

        .action-dropdown {
            position: relative;
            display: inline-block;
        }

        .action-icon-btn {
            background: none;
            border: none;
            color: #94A3B8;
            font-size: 16px;
            cursor: pointer;
            width: 30px;
            height: 30px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-icon-btn:hover {
            color: #1E3A8A;
            background-color: #F1F5F9;
        }

        /* Table Footer */
        .table-footer {
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #E2E8F0;
            background-color: #FFFFFF;
        }

        .entry-info {
            font-size: 12.5px;
            color: #64748B;
            font-weight: 500;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .page-btn {
            min-width: 32px;
            height: 32px;
            padding: 0 8px;
            border-radius: 6px;
            border: 1px solid #E2E8F0;
            background-color: #FFFFFF;
            color: #475569;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
        }

        .page-btn.active {
            background-color: #1B3B6F;
            border-color: #1B3B6F;
            color: #FFFFFF;
            font-weight: 700;
        }

        /* Right Card - Detail Produk Form */
        .form-card {
            padding: 24px;
        }

        .form-card .card-title {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13.5px;
            color: #0F172A;
            outline: none;
            background-color: #FFFFFF;
        }

        .form-control:focus {
            border-color: #1E3A8A;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        select.form-control {
            cursor: pointer;
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-secondary {
            background-color: #FFFFFF;
            border: 1px solid #CBD5E1;
            color: #1B3B6F;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13.5px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #1B3B6F;
            border: none;
            color: #FFFFFF;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13.5px;
            cursor: pointer;
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
            
            <!-- Page Header Row -->
            <div class="page-header-row">
                <div>
                    <h1 class="page-title">Kelola Produk</h1>
                    <p class="page-subtitle">Kelola katalog produk cetak, kategori, dan harga Anda.</p>
                </div>
                <button class="btn-add">
                    <i class="fa-solid fa-plus"></i>
                    <span>Produk Baru</span>
                </button>
            </div>

            <!-- Two Column Layout -->
            <div class="grid-2col">
                
                <!-- Left Column - Katalog Produk Table -->
                <div class="card">
                    <div class="card-header-row">
                        <h2 class="card-title">Katalog Produk</h2>
                        <div class="filter-input-box">
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                            <input type="text" placeholder="Filter produk...">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>NAMA PRODUK</th>
                                    <th>KATEGORI</th>
                                    <th>HARGA DASAR</th>
                                    <th style="text-align: right;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-name">Kartu Nama Premium (Laminasi)</td>
                                    <td><span class="category-badge">Kartu Nama</span></td>
                                    <td class="price-text">Rp 45.000 / box</td>
                                    <td style="text-align: right;"><button class="action-icon-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="product-name">Brosur A5 Art Paper 120gr</td>
                                    <td><span class="category-badge">Brosur</span></td>
                                    <td class="price-text">Rp 450.000 / rim</td>
                                    <td style="text-align: right;"><button class="action-icon-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="product-name">Spanduk Flexy Korea 440gr</td>
                                    <td><span class="category-badge">Banner</span></td>
                                    <td class="price-text">Rp 35.000 / m²</td>
                                    <td style="text-align: right;"><button class="action-icon-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="product-name">Stiker Chromo A3+ (Die Cut)</td>
                                    <td><span class="category-badge">Stiker</span></td>
                                    <td class="price-text">Rp 10.000 / lembar</td>
                                    <td style="text-align: right;"><button class="action-icon-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="product-name">Kalender Meja 2024 (Custom)</td>
                                    <td><span class="category-badge">Merchandise</span></td>
                                    <td class="price-text">Rp 25.000 / pcs</td>
                                    <td style="text-align: right;"><button class="action-icon-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="product-name">Nota NCR 2 Rangkap (A5)</td>
                                    <td><span class="category-badge">Dokumen</span></td>
                                    <td class="price-text">Rp 185.000 / buku</td>
                                    <td style="text-align: right;"><button class="action-icon-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="product-name">Roll Up Banner 60×160cm</td>
                                    <td><span class="category-badge">Banner</span></td>
                                    <td class="price-text">Rp 225.000 / set</td>
                                    <td style="text-align: right;"><button class="action-icon-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="product-name">Sertifikat Linen 230gr</td>
                                    <td><span class="category-badge">Dokumen</span></td>
                                    <td class="price-text">Rp 5.000 / lembar</td>
                                    <td style="text-align: right;"><button class="action-icon-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="product-name">Poster A2 Art Carton 260gr</td>
                                    <td><span class="category-badge">Poster</span></td>
                                    <td class="price-text">Rp 15.000 / lembar</td>
                                    <td style="text-align: right;"><button class="action-icon-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="product-name">Undangan Pernikahan Softcover</td>
                                    <td><span class="category-badge">Undangan</span></td>
                                    <td class="price-text">Rp 3.500 / pcs</td>
                                    <td style="text-align: right;"><button class="action-icon-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        <div class="entry-info">Menampilkan 1 hingga 10 dari 48 entri</div>
                        <div class="pagination">
                            <button class="page-btn">Sebel</button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">Selan</button>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Detail Produk Form Card -->
                <div class="card form-card">
                    <h2 class="card-title">Detail Produk</h2>

                    <form>
                        <div class="form-group">
                            <label for="prodName">Nama Produk</label>
                            <input type="text" id="prodName" class="form-control" placeholder="mis. Spanduk Flexy 280gr">
                        </div>

                        <div class="form-group">
                            <label for="prodCategory">Kategori</label>
                            <select id="prodCategory" class="form-control">
                                <option value="">Pilih kategori</option>
                                <option value="Kartu Nama">Kartu Nama</option>
                                <option value="Brosur">Brosur</option>
                                <option value="Banner">Banner</option>
                                <option value="Stiker">Stiker</option>
                                <option value="Merchandise">Merchandise</option>
                                <option value="Dokumen">Dokumen</option>
                                <option value="Poster">Poster</option>
                                <option value="Undangan">Undangan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prodBasePrice">Harga Dasar</label>
                            <input type="text" id="prodBasePrice" class="form-control" placeholder="Rp 0">
                        </div>

                        <div class="form-group">
                            <label for="prodPriceUnit">Satuan Harga</label>
                            <select id="prodPriceUnit" class="form-control">
                                <option value="per m²">per m²</option>
                                <option value="box">box</option>
                                <option value="rim">rim</option>
                                <option value="pcs">pcs</option>
                                <option value="lembar">lembar</option>
                                <option value="buku">buku</option>
                                <option value="set">set</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prodDesc">Deskripsi (Opsional)</label>
                            <textarea id="prodDesc" rows="4" class="form-control" placeholder="Detail teknis singkat..."></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-secondary">Batal</button>
                            <button type="submit" class="btn-primary">Simpan Produk</button>
                        </div>
                    </form>
                </div>

            </div>

        </main>
    </div>

    @include('layouts.navbar_assets')
</body>
</html>
