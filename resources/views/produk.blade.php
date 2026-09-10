<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - SIPEKAN</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Hide number input spin buttons (up/down arrows) */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none !important;
            margin: 0 !important;
        }

        input[type=number] {
            -moz-appearance: textfield !important;
            appearance: textfield !important;
        }

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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
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
            padding: 12px 14px;
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
            white-space: nowrap;
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
            white-space: nowrap;
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

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-badge.tersedia {
            background-color: #DCFCE7;
            color: #15803D;
        }

        .status-badge.habis,
        .status-badge.nonaktif {
            background-color: #FEE2E2;
            color: #B91C1C;
        }

        .price-text {
            font-weight: 600;
            color: #1E293B;
            white-space: nowrap;
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

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 4px;
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            min-width: 130px;
            z-index: 50;
            display: none;
            flex-direction: column;
            padding: 4px 0;
        }

        .dropdown-menu.show {
            display: flex;
        }

        .dropdown-menu.dropup {
            top: auto !important;
            bottom: 100% !important;
            margin-top: 0 !important;
            margin-bottom: 6px !important;
            box-shadow: 0 -10px 25px rgba(0, 0, 0, 0.12) !important;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            text-decoration: none;
            transition: background 0.15s ease;
            text-align: left;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
        }

        .dropdown-item:hover {
            background-color: #F1F5F9;
            color: #1E3A8A;
        }

        .dropdown-item.danger {
            color: #EF4444;
        }

        .dropdown-item.danger:hover {
            background-color: #FEF2F2;
            color: #DC2626;
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

        /* Modal Popup Styling */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(15, 23, 42, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-box {
            background-color: #FFFFFF;
            border-radius: 12px;
            width: 100%;
            max-width: 520px;
            padding: 24px 28px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(-10px);
            transition: transform 0.2s ease;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-overlay.active .modal-box {
            transform: translateY(0);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #F1F5F9;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 800;
            color: #0F172A;
        }

        .close-modal-btn {
            background: none;
            border: none;
            color: #94A3B8;
            font-size: 20px;
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
        }

        .close-modal-btn:hover {
            background-color: #F1F5F9;
            color: #0F172A;
        }

        .form-group {
            margin-bottom: 16px;
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
            color: #475569;
            padding: 9px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13.5px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #1B3B6F;
            border: none;
            color: #FFFFFF;
            padding: 9px 22px;
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
                <button class="btn-add" id="openAddModalBtn">
                    <i class="fa-solid fa-plus"></i>
                    <span>Produk Baru</span>
                </button>
            </div>

            <!-- Full Width Katalog Produk Table Card -->
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
                                <th>STOK</th>
                                <th>STATUS</th>
                                <th style="text-align: right;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produks ?? [] as $prod)
                                <tr>
                                    <td class="product-name">{{ $prod->nama_produk }}</td>
                                    <td><span class="category-badge">{{ $prod->kategori }}</span></td>
                                    <td class="price-text">Rp {{ number_format($prod->harga, 0, ',', '.') }}</td>
                                    <td style="font-weight: 600; color: #475569;">
                                        {{ number_format($prod->stok ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td><span
                                            class="status-badge {{ strtolower($prod->status ?? 'tersedia') }}">{{ $prod->status ?? 'Tersedia' }}</span>
                                    </td>
                                    <td style="text-align: right;">
                                        <div class="action-dropdown">
                                            <button class="action-icon-btn action-toggle" title="Aksi"><i
                                                    class="fa-solid fa-ellipsis-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <button type="button" class="dropdown-item edit-prod-btn"
                                                    onclick="editProduk({{ json_encode($prod) }})"><i
                                                        class="fa-regular fa-pen-to-square"></i> Edit</button>
                                                <form action="{{ route('produk.destroy', $prod->id) }}" method="POST"
                                                    style="display:inline;"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item danger"><i
                                                            class="fa-regular fa-trash-can"></i> Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; padding: 20px; color: #64748B;">Belum ada
                                        produk di database.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <div class="entry-info">Menampilkan {{ count($produks ?? []) }} entri produk</div>
                    <div class="pagination"></div>
                </div>
            </div>

            <!-- Modal Popup Form for Product -->
            <div class="modal-overlay" id="productModal">
                <div class="modal-box">
                    <div class="modal-header">
                        <h2 class="modal-title" id="formCardTitle">Tambah Produk Baru</h2>
                        <button type="button" class="close-modal-btn" id="closeModalBtn">&times;</button>
                    </div>

                    <form id="productForm" action="{{ route('produk.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" id="prodFormMethod" value="POST">

                        <div class="form-group">
                            <label for="prodName">Nama Produk</label>
                            <input type="text" name="nama_produk" id="prodName" class="form-control"
                                placeholder="mis. Spanduk Flexy 280gr" required>
                        </div>

                        <div class="form-group">
                            <label for="prodCategory">Kategori</label>
                            <select name="kategori" id="prodCategory" class="form-control" required>
                                <option value="">Pilih kategori</option>
                                <option value="Banner & Outdoor">Banner & Outdoor</option>
                                <option value="Digital Printing">Digital Printing</option>
                                <option value="Promosi">Promosi</option>
                                <option value="Stiker & Label">Stiker & Label</option>
                                <option value="Merchandise">Merchandise</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prodBasePrice">Harga Dasar (Rp)</label>
                            <input type="number" name="harga" id="prodBasePrice" class="form-control" min="0"
                                step="any" placeholder="25000" required>
                        </div>

                        <div class="form-group">
                            <label for="prodStok">Stok (Maks 1.000.000 Pesanan/Unit)</label>
                            <input type="number" name="stok" id="prodStok" class="form-control" value="1" min="0"
                                max="1000000" placeholder="Contoh: 500" required>
                        </div>

                        <div class="form-group">
                            <label for="prodStatus">Status Produk</label>
                            <select name="status" id="prodStatus" class="form-control" required>
                                <option value="Tersedia">Tersedia (Aktif)</option>
                                <option value="Habis">Habis</option>
                                <option value="Nonaktif">Nonaktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prodDesc">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" id="prodDesc" rows="3" class="form-control"
                                placeholder="Detail teknis singkat..."></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-secondary" id="btnCancelForm">Batal</button>
                            <button type="submit" class="btn-primary" id="btnSubmitForm">Simpan Produk</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productForm = document.getElementById('productForm');
            const formTitle = document.getElementById('formCardTitle');
            const submitBtn = document.getElementById('btnSubmitForm');
            const cancelBtn = document.getElementById('btnCancelForm');
            const tbody = document.querySelector('.custom-table tbody');
            const entryInfo = document.querySelector('.entry-info');
            const paginationEl = document.querySelector('.pagination');
            const searchInput = document.querySelector('.filter-input-box input');
            const btnAdd = document.getElementById('openAddModalBtn');
            const modalEl = document.getElementById('productModal');
            const closeModalBtn = document.getElementById('closeModalBtn');

            let currentPage = 1;
            const itemsPerPage = 10;

            function openModal() {
                if (modalEl) modalEl.classList.add('active');
            }

            function closeModal() {
                if (modalEl) modalEl.classList.remove('active');
            }

            function updatePagination() {
                if (!tbody) return;
                const rows = Array.from(tbody.querySelectorAll('tr'));
                const visibleRows = rows.filter(r => r.getAttribute('data-search-hidden') !== 'true');
                const totalItems = visibleRows.length;
                const totalPages = Math.max(1, Math.ceil(totalItems / itemsPerPage));

                if (currentPage > totalPages) currentPage = totalPages;

                const startIdx = (currentPage - 1) * itemsPerPage;
                const endIdx = startIdx + itemsPerPage;

                rows.forEach(r => r.style.display = 'none');
                visibleRows.slice(startIdx, endIdx).forEach(r => r.style.display = '');

                if (entryInfo) {
                    const startShow = totalItems === 0 ? 0 : startIdx + 1;
                    const endShow = Math.min(endIdx, totalItems);
                    entryInfo.textContent = `Menampilkan ${startShow} hingga ${endShow} dari ${totalItems} entri`;
                }

                if (paginationEl) {
                    paginationEl.innerHTML = '';

                    const prevBtn = document.createElement('button');
                    prevBtn.className = 'page-btn';
                    prevBtn.innerHTML = '<i class="fa-solid fa-chevron-left" style="font-size: 11px;"></i>';
                    prevBtn.disabled = currentPage === 1;
                    prevBtn.style.opacity = currentPage === 1 ? '0.5' : '1';
                    prevBtn.addEventListener('click', () => { if (currentPage > 1) { currentPage--; updatePagination(); } });
                    paginationEl.appendChild(prevBtn);

                    for (let i = 1; i <= totalPages; i++) {
                        const pBtn = document.createElement('button');
                        pBtn.className = `page-btn ${i === currentPage ? 'active' : ''}`;
                        pBtn.textContent = i;
                        pBtn.addEventListener('click', () => { currentPage = i; updatePagination(); });
                        paginationEl.appendChild(pBtn);
                    }

                    const nextBtn = document.createElement('button');
                    nextBtn.className = 'page-btn';
                    nextBtn.innerHTML = '<i class="fa-solid fa-chevron-right" style="font-size: 11px;"></i>';
                    nextBtn.disabled = currentPage === totalPages;
                    nextBtn.style.opacity = currentPage === totalPages ? '0.5' : '1';
                    nextBtn.addEventListener('click', () => { if (currentPage < totalPages) { currentPage++; updatePagination(); } });
                    paginationEl.appendChild(nextBtn);
                }
            }

            window.editProduk = function (prod) {
                if (formTitle) formTitle.textContent = 'Edit Produk: ' + prod.nama_produk;
                const form = document.getElementById('productForm');
                form.action = '/produk/' + prod.id;
                document.getElementById('prodFormMethod').value = 'PUT';
                document.getElementById('prodName').value = prod.nama_produk;
                document.getElementById('prodCategory').value = prod.kategori;
                document.getElementById('prodBasePrice').value = prod.harga;
                document.getElementById('prodStok').value = prod.stok !== undefined ? prod.stok : 1;
                document.getElementById('prodStatus').value = prod.status || 'Tersedia';
                document.getElementById('prodDesc').value = prod.deskripsi || '';
                if (submitBtn) submitBtn.textContent = 'Update Produk';
                openModal();
                setTimeout(() => document.getElementById('prodName').focus(), 100);
            };

            function resetForm() {
                const form = document.getElementById('productForm');
                form.reset();
                form.action = "{{ route('produk.store') }}";
                document.getElementById('prodFormMethod').value = 'POST';
                document.getElementById('prodStok').value = 1;
                document.getElementById('prodStatus').value = 'Tersedia';
                if (formTitle) formTitle.textContent = 'Tambah Produk Baru';
                if (submitBtn) submitBtn.textContent = 'Simpan Produk';
            }

            if (btnAdd) {
                btnAdd.addEventListener('click', function () {
                    resetForm();
                    openModal();
                    setTimeout(() => document.getElementById('prodName').focus(), 100);
                });
            }

            if (cancelBtn) {
                cancelBtn.addEventListener('click', function () {
                    closeModal();
                });
            }

            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function () {
                    closeModal();
                });
            }

            if (modalEl) {
                modalEl.addEventListener('click', function (e) {
                    if (e.target === modalEl) {
                        closeModal();
                    }
                });
            }

            function bindRowActions(row) {
                const toggleBtn = row.querySelector('.action-toggle');
                const menu = row.querySelector('.dropdown-menu');

                if (toggleBtn && menu) {
                    toggleBtn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        document.querySelectorAll('.dropdown-menu').forEach(m => {
                            if (m !== menu) m.classList.remove('show');
                        });
                        menu.classList.toggle('show');
                    });
                }
            }

            if (tbody) {
                tbody.querySelectorAll('tr').forEach(row => bindRowActions(row));
                updatePagination();
            }

            if (searchInput && tbody) {
                searchInput.addEventListener('keyup', function () {
                    const q = this.value.toLowerCase();
                    const rows = tbody.querySelectorAll('tr');
                    rows.forEach(r => {
                        if (r.textContent.toLowerCase().includes(q)) {
                            r.removeAttribute('data-search-hidden');
                        } else {
                            r.setAttribute('data-search-hidden', 'true');
                        }
                    });
                    currentPage = 1;
                    updatePagination();
                });
            }

            document.addEventListener('click', function () {
                document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
            });
        });
    </script>

    @include('layouts.navbar_assets')
</body>

</html>