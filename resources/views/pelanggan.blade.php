<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pelanggan - CV Prima Grafika</title>
    
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

        /* Page Top Header */
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
            box-shadow: 0 2px 8px rgba(27, 59, 111, 0.15);
        }

        .btn-add:hover {
            background-color: #142F5B;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(27, 59, 111, 0.25);
        }

        /* Search & Filter Toolbar */
        .filter-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            gap: 16px;
        }

        .customer-search-box {
            position: relative;
            width: 360px;
        }

        .customer-search-box .search-icon {
            left: 14px;
        }

        .customer-search-box input {
            width: 100%;
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 10px 14px 10px 38px;
            font-size: 13.5px;
            color: #1E293B;
            outline: none;
            transition: all 0.2s ease;
        }

        .customer-search-box input:focus {
            border-color: #1E3A8A;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .filter-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .filter-select {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 9.5px 16px;
            font-size: 13.5px;
            font-weight: 600;
            color: #334155;
            outline: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-select:hover {
            border-color: #CBD5E1;
        }

        .btn-filter-more {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 9.5px 16px;
            font-size: 13.5px;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-filter-more:hover {
            background-color: #F8FAFC;
            border-color: #CBD5E1;
        }

        /* Customer Table Card */
        .table-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

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
            padding: 18px 24px;
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

        .cus-id {
            color: #64748B;
            font-weight: 600;
            white-space: nowrap;
        }

        .cus-name {
            font-weight: 700;
            color: #0F172A;
        }

        .action-btns {
            display: flex;
            align-items: center;
            justify-content: flex-end;
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
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
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
            min-width: 120px;
            z-index: 50;
            display: none;
            flex-direction: column;
            padding: 4px 0;
        }

        .dropdown-menu.show {
            display: flex;
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

        /* Table Footer / Pagination */
        .table-footer {
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #E2E8F0;
            background-color: #FFFFFF;
        }

        .entry-info {
            font-size: 13px;
            color: #64748B;
            font-weight: 500;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .page-btn {
            min-width: 32px;
            height: 32px;
            padding: 0 6px;
            border-radius: 6px;
            border: 1px solid #E2E8F0;
            background-color: #FFFFFF;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .page-btn:hover {
            border-color: #CBD5E1;
            background-color: #F8FAFC;
        }

        .page-btn.active {
            background-color: #1B3B6F;
            border-color: #1B3B6F;
            color: #FFFFFF;
            font-weight: 700;
        }

        .page-ellipsis {
            color: #94A3B8;
            font-size: 13px;
            padding: 0 4px;
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
            max-width: 500px;
            padding: 28px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            transform: translateY(-10px);
            transition: transform 0.2s ease;
        }

        .modal-overlay.active .modal-box {
            transform: translateY(0);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
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
            font-size: 18px;
            cursor: pointer;
        }

        .modal-form .form-group {
            margin-bottom: 16px;
        }

        .modal-form label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
        }

        .modal-form input, .modal-form textarea {
            width: 100%;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13.5px;
            color: #0F172A;
            outline: none;
        }

        .modal-form input:focus, .modal-form textarea:focus {
            border-color: #1E3A8A;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-cancel {
            background-color: #F1F5F9;
            color: #475569;
            border: none;
            padding: 9px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13.5px;
            cursor: pointer;
        }

        .btn-save {
            background-color: #1B3B6F;
            color: #FFFFFF;
            border: none;
            padding: 9px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13.5px;
            cursor: pointer;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .page-header-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            .filter-toolbar {
                flex-direction: column;
                align-items: stretch;
            }
            .customer-search-box, .customer-search-box input {
                width: 100%;
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
            
            <!-- Page Header Row -->
            <div class="page-header-row">
                <div>
                    <h1 class="page-title">Kelola Pelanggan</h1>
                    <p class="page-subtitle">Kelola daftar klien dan informasi kontak Anda.</p>
                </div>
                <button class="btn-add" id="openModalBtn">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Pelanggan</span>
                </button>
            </div>

            <!-- Filter & Search Toolbar -->
            <div class="filter-toolbar">
                <div class="customer-search-box">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="customerSearchInput" placeholder="Cari pelanggan...">
                </div>

                <div class="filter-actions">
                    <select class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>

                    <button class="btn-filter-more">
                        <i class="fa-solid fa-sliders"></i>
                        <span>Lebih Banyak Filter</span>
                    </button>
                </div>
            </div>

            <!-- Customer Data Table Card -->
            <div class="table-card">
                <div class="table-responsive">
                    <table class="custom-table" id="customerTable">
                        <thead>
                            <tr>
                                <th style="width: 40px;"><input type="checkbox" style="cursor:pointer;" id="selectAll"></th>
                                <th>ID PELANGGAN</th>
                                <th>NAMA PELANGGAN</th>
                                <th>KONTAK</th>
                                <th>TOTAL PESANAN</th>
                                <th>TANGGAL DAFTAR</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="checkbox" style="cursor:pointer;"></td>
                            <td class="cus-id">#CUS-001</td>
                            <td>
                                <div class="customer-cell">
                                    <div class="avatar-init" style="background-color: #DBEAFE; color: #1D4ED8;">A</div>
                                    <div>
                                        <div class="cus-name">Acme Corporation</div>
                                        <div class="cus-sub">Perusahaan Swasta</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="contact-info">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>0812-3456-7890</span>
                                </div>
                                <div class="contact-info">
                                    <i class="fa-regular fa-envelope"></i>
                                    <span>contact@acme.com</span>
                                </div>
                            </td>
                            <td style="font-weight: 700;">12x</td>
                            <td>Jan 15, 2023</td>
                            <td><span class="badge badge-active">Aktif</span></td>
                            <td>
                                <div class="action-btns">
                                    <div class="action-dropdown">
                                        <button class="action-icon-btn action-toggle" title="Aksi"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                            <a href="#" class="dropdown-item danger"><i class="fa-regular fa-trash-can"></i> Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" style="cursor:pointer;"></td>
                            <td class="cus-id">#CUS-002</td>
                            <td>
                                <div class="customer-cell">
                                    <div class="avatar-init" style="background-color: #FEF3C7; color: #D97706;">T</div>
                                    <div>
                                        <div class="cus-name">TechStart Inc.</div>
                                        <div class="cus-sub">Startup Teknologi</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="contact-info">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>0856-7890-1234</span>
                                </div>
                                <div class="contact-info">
                                    <i class="fa-regular fa-envelope"></i>
                                    <span>hello@techstart.io</span>
                                </div>
                            </td>
                            <td style="font-weight: 700;">8x</td>
                            <td>Mar 22, 2023</td>
                            <td><span class="badge badge-active">Aktif</span></td>
                            <td>
                                <div class="action-btns">
                                    <div class="action-dropdown">
                                        <button class="action-icon-btn action-toggle" title="Aksi"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                            <a href="#" class="dropdown-item danger"><i class="fa-regular fa-trash-can"></i> Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" style="cursor:pointer;"></td>
                            <td class="cus-id">#CUS-003</td>
                            <td>
                                <div class="customer-cell">
                                    <div class="avatar-init" style="background-color: #DCFCE7; color: #15803D;">C</div>
                                    <div>
                                        <div class="cus-name">Creative Media Studio</div>
                                        <div class="cus-sub">Agensi Desain</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="contact-info">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>0856-1234-9876</span>
                                </div>
                                <div class="contact-info">
                                    <i class="fa-regular fa-envelope"></i>
                                    <span>hello@creativemedia.net</span>
                                </div>
                            </td>
                            <td style="font-weight: 700;">5x</td>
                            <td>Apr 10, 2023</td>
                            <td><span class="badge badge-inactive">Nonaktif</span></td>
                            <td>
                                <div class="action-btns">
                                    <div class="action-dropdown">
                                        <button class="action-icon-btn action-toggle" title="Aksi"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                            <a href="#" class="dropdown-item danger"><i class="fa-regular fa-trash-can"></i> Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

                <!-- Pagination Footer -->
                <div class="table-footer">
                    <div class="entry-info">
                        Menampilkan 1 hingga 8 dari 42 entri
                    </div>
                    <div class="pagination">
                        <button class="page-btn"><i class="fa-solid fa-chevron-left" style="font-size: 11px;"></i></button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <span class="page-ellipsis">...</span>
                        <button class="page-btn"><i class="fa-solid fa-chevron-right" style="font-size: 11px;"></i></button>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Modal Form Tambah Pelanggan -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Pelanggan Baru</h3>
                <button class="close-modal-btn" id="closeModalBtn">&times;</button>
            </div>
            <form class="modal-form" id="addCustomerForm">
                <div class="form-group">
                    <label for="cusName">Nama Pelanggan / Perusahaan</label>
                    <input type="text" id="cusName" required placeholder="Contoh: PT Jaya Abadi">
                </div>
                <div class="form-group">
                    <label for="cusPhone">Nomor Telepon</label>
                    <input type="text" id="cusPhone" required placeholder="+62 812-xxxx-xxxx">
                </div>
                <div class="form-group">
                    <label for="cusEmail">Email</label>
                    <input type="email" id="cusEmail" required placeholder="info@perusahaan.com">
                </div>
                <div class="form-group">
                    <label for="cusAddress">Alamat</label>
                    <textarea id="cusAddress" rows="3" required placeholder="Alamat lengkap..."></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" id="cancelModalBtn">Batal</button>
                    <button type="submit" class="btn-save">Simpan Pelanggan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal interactivity
        const modalOverlay = document.getElementById('modalOverlay');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');

        openModalBtn.addEventListener('click', () => modalOverlay.classList.add('active'));
        closeModalBtn.addEventListener('click', () => modalOverlay.classList.remove('active'));
        cancelModalBtn.addEventListener('click', () => modalOverlay.classList.remove('active'));

        // Client side simple search filter
        const customerSearchInput = document.getElementById('customerSearchInput');
        const customerTable = document.getElementById('customerTable');
        const rows = customerTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        customerSearchInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            for (let i = 0; i < rows.length; i++) {
                const text = rows[i].textContent.toLowerCase();
                rows[i].style.display = text.includes(query) ? '' : 'none';
            }
        });

        // 3 Dots Action Dropdown toggle
        document.querySelectorAll('.action-toggle').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdownMenu = this.nextElementSibling;
                // Close all other open dropdowns first
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdownMenu) menu.classList.remove('show');
                });
                dropdownMenu.classList.toggle('show');
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.remove('show'));
        });
    </script>
    @include('layouts.navbar_assets')
</body>
</html>
