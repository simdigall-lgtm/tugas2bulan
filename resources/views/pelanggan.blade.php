<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pelanggan - SIPEKAN</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

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
            font-size: 13px;
        }

        .cus-sub {
            font-size: 11.5px;
            color: #64748B;
            margin-top: 2px;
        }

        .contact-info {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #475569;
            margin-bottom: 2px;
            white-space: nowrap;
        }

        .contact-info:last-child {
            margin-bottom: 0;
        }

        .contact-info i {
            width: 14px;
            text-align: center;
            color: #64748B;
            font-size: 12px;
            flex-shrink: 0;
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

        .dropdown-menu.dropup {
            top: auto !important;
            bottom: 100% !important;
            margin-top: 0 !important;
            margin-bottom: 6px !important;
            box-shadow: 0 -10px 25px rgba(0, 0, 0, 0.12) !important;
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
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
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

        .modal-form input,
        .modal-form textarea {
            width: 100%;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13.5px;
            color: #0F172A;
            outline: none;
        }

        .modal-form input:focus,
        .modal-form textarea:focus {
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

        /* Custom Country Flag Picker */
        .custom-country-picker {
            position: relative;
            width: 125px;
            flex-shrink: 0;
        }

        .country-picker-btn {
            width: 100%;
            height: 42px;
            background-color: #FFFFFF;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 0 12px;
            font-size: 13.5px;
            font-weight: 700;
            color: #1E293B;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            cursor: pointer;
            outline: none;
            transition: all 0.2s ease;
        }

        .country-picker-btn:hover,
        .country-picker-btn:focus {
            border-color: #1E3A8A;
            background-color: #F8FAFC;
        }

        .country-picker-dropdown {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            width: 200px;
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
            z-index: 200;
            display: none;
            flex-direction: column;
            padding: 6px;
            max-height: 220px;
            overflow-y: auto;
        }

        .country-picker-dropdown.show {
            display: flex;
        }

        .country-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .country-option:hover {
            background-color: #EEF2FF;
            color: #1E3A8A;
        }

        .country-option.active {
            background-color: #E0E7FF;
            color: #1D4ED8;
            font-weight: 700;
        }

        .flag-img {
            width: 22px;
            height: 15px;
            border-radius: 2px;
            object-fit: cover;
            box-shadow: 0 0 2px rgba(0, 0, 0, 0.25);
            flex-shrink: 0;
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

            .customer-search-box,
            .customer-search-box input {
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

            <!-- Search Toolbar -->
            <div class="filter-toolbar">
                <div class="customer-search-box" style="max-width: 360px;">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="customerSearchInput" placeholder="Cari pelanggan berdasarkan nama, HP, atau email...">
                </div>
            </div>

            <!-- Customer Data Table Card -->
            <div class="table-card">
                <div class="table-responsive">
                    <table class="custom-table" id="customerTable">
                        <thead>
                            <tr>
                                <th style="width: 115px;">ID PELANGGAN</th>
                                <th>NAMA PELANGGAN</th>
                                <th style="width: 200px;">KONTAK</th>
                                <th style="width: 100px; text-align: center;">TOTAL PESANAN</th>
                                <th style="width: 120px;">TANGGAL DAFTAR</th>
                                <th style="width: 90px; text-align: center;">STATUS</th>
                                <th style="width: 50px; text-align: center;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelanggans ?? [] as $p)
                                <tr class="customer-row" data-customer='@json($p)' style="cursor: pointer;">
                                    <td class="cus-id">{{ $p->kode_pelanggan }}</td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="avatar-init" style="background-color: #DBEAFE; color: #1D4ED8;">
                                                {{ strtoupper(substr($p->nama, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="cus-name" style="color:#1E3A8A; font-weight:700;">{{ $p->nama }}
                                                </div>
                                                <div class="cus-sub">{{ Str::limit($p->alamat ?? 'Pelanggan', 30) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-info"><i
                                                class="fa-solid fa-phone"></i><span>{{ $p->no_hp }}</span></div>
                                        <div class="contact-info"><i
                                                class="fa-regular fa-envelope"></i><span>{{ $p->email }}</span></div>
                                    </td>
                                    <td style="font-weight: 700; text-align: center;">{{ $p->total_pesanan }}x</td>
                                    <td>{{ $p->tanggal_daftar ? \Carbon\Carbon::parse($p->tanggal_daftar)->format('d M Y') : '-' }}
                                    </td>
                                    <td style="text-align: center;"><span
                                            class="badge {{ strtolower($p->status) == 'aktif' ? 'badge-active' : 'badge-inactive' }}">{{ $p->status }}</span>
                                    </td>
                                    <td class="prevent-row-click" style="text-align: center;">
                                        <div class="action-btns" style="justify-content: center;">
                                            <div class="action-dropdown">
                                                <button class="action-icon-btn action-toggle" title="Aksi"><i
                                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                                <div class="dropdown-menu">
                                                    <a href="javascript:void(0)" class="dropdown-item btn-show-detail"
                                                        data-customer='@json($p)'><i class="fa-solid fa-eye"
                                                            style="color:#1E3A8A;"></i> Detail Pelanggan</a>
                                                    <a href="{{ route('pesanan') }}?pelanggan={{ urlencode($p->nama) }}"
                                                        class="dropdown-item"><i class="fa-solid fa-cart-plus"
                                                            style="color:#2563EB;"></i> Buat Pesanan</a>
                                                    <a href="javascript:void(0)" class="dropdown-item btn-edit-pelanggan"
                                                        data-customer='@json($p)'><i
                                                            class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                    <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST"
                                                        style="display:inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item danger"
                                                            style="background:none; border:none; width:100%; text-align:left; cursor:pointer;"><i
                                                                class="fa-regular fa-trash-can"></i> Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; padding: 20px; color:#64748B;">Belum ada data
                                        pelanggan di database.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Footer -->
                <div class="table-footer">
                    <div class="entry-info">
                        Menampilkan 1 hingga 8 dari 48 entri
                    </div>
                    <div class="pagination">
                        <button class="page-btn"><i class="fa-solid fa-chevron-left"
                                style="font-size: 11px;"></i></button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <span class="page-ellipsis">...</span>
                        <button class="page-btn"><i class="fa-solid fa-chevron-right"
                                style="font-size: 11px;"></i></button>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Modal Form Tambah & Edit Pelanggan -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Pelanggan Baru</h3>
                <button class="close-modal-btn" id="closeModalBtn">&times;</button>
            </div>
            <form class="modal-form" id="addCustomerForm">
                <input type="hidden" id="cusIdVal">
                <div class="form-group">
                    <label for="cusName">Nama Pelanggan / Perusahaan</label>
                    <input type="text" id="cusName" required placeholder="Contoh: PT Jaya Abadi">
                </div>
                <div class="form-group">
                    <label for="cusPhone">Nomor Telepon (WhatsApp)</label>
                    <div style="display: flex; gap: 8px;">
                        <div class="custom-country-picker" id="customCountryPicker">
                            <button type="button" class="country-picker-btn" id="countryPickerBtn">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <img id="selectedFlagImg" src="https://flagcdn.com/w40/id.png" alt="ID"
                                        class="flag-img">
                                    <span id="selectedCountryCode">+62</span>
                                </div>
                                <i class="fa-solid fa-chevron-down" style="font-size: 10px; color: #64748B;"></i>
                            </button>
                            <div class="country-picker-dropdown" id="countryPickerDropdown">
                                <div class="country-option active" data-code="+62"
                                    data-flag="https://flagcdn.com/w40/id.png">
                                    <img src="https://flagcdn.com/w40/id.png" alt="Indonesia" class="flag-img">
                                    <span>Indonesia (+62)</span>
                                </div>
                                <div class="country-option" data-code="+1" data-flag="https://flagcdn.com/w40/us.png">
                                    <img src="https://flagcdn.com/w40/us.png" alt="Amerika Serikat" class="flag-img">
                                    <span>Amerika (+1)</span>
                                </div>
                                <div class="country-option" data-code="+65" data-flag="https://flagcdn.com/w40/sg.png">
                                    <img src="https://flagcdn.com/w40/sg.png" alt="Singapura" class="flag-img">
                                    <span>Singapura (+65)</span>
                                </div>
                                <div class="country-option" data-code="+60" data-flag="https://flagcdn.com/w40/my.png">
                                    <img src="https://flagcdn.com/w40/my.png" alt="Malaysia" class="flag-img">
                                    <span>Malaysia (+60)</span>
                                </div>
                                <div class="country-option" data-code="+81" data-flag="https://flagcdn.com/w40/jp.png">
                                    <img src="https://flagcdn.com/w40/jp.png" alt="Jepang" class="flag-img">
                                    <span>Jepang (+81)</span>
                                </div>
                                <div class="country-option" data-code="+44" data-flag="https://flagcdn.com/w40/gb.png">
                                    <img src="https://flagcdn.com/w40/gb.png" alt="Inggris" class="flag-img">
                                    <span>Inggris (+44)</span>
                                </div>
                                <div class="country-option" data-code="+61" data-flag="https://flagcdn.com/w40/au.png">
                                    <img src="https://flagcdn.com/w40/au.png" alt="Australia" class="flag-img">
                                    <span>Australia (+61)</span>
                                </div>
                            </div>
                            <input type="hidden" id="cusCountryCode" value="+62">
                        </div>
                        <input type="text" id="cusPhone" required placeholder="812-3456-7890" style="flex: 1;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cusEmail">Email</label>
                    <input type="email" id="cusEmail" required placeholder="info@perusahaan.com">
                </div>
                <div class="form-group">
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <label for="cusAddress" style="margin-bottom: 0;">Alamat (Kota/Kabupaten, Provinsi)</label>
                        <span style="font-size: 11.5px; color: #64748B; font-weight: 600;">Pilih Cepat Kota:</span>
                    </div>
                    <select id="cusCityQuickSelect"
                        style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 9px 12px; font-size: 13.5px; background: #F8FAFC; outline: none; margin-bottom: 8px; cursor: pointer;">
                        <option value="">-- Pilih Kota / Wilayah Langsung --</option>
                        @foreach($allAvailableCities as $c)
                            <option value="{{ $c }}">{{ $c }}</option>
                        @endforeach
                    </select>
                    <textarea id="cusAddress" rows="2" required
                        placeholder="Pilih kota di atas atau ketik alamat lengkap..."></textarea>
                </div>
                <div class="form-group">
                    <label for="cusStatus">Status Keanggotaan</label>
                    <select id="cusStatus" required
                        style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 10px 14px; font-size: 13.5px; background: #fff; outline: none;">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" id="cancelModalBtn">Batal</button>
                    <button type="submit" class="btn-save">Simpan Pelanggan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Lebih Banyak Filter -->
    <div class="modal-overlay" id="filterMoreModalOverlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3 class="modal-title">Lebih Banyak Filter Pelanggan</h3>
                <button class="close-modal-btn" id="closeFilterMoreBtn">&times;</button>
            </div>
            <div class="modal-form">
                <div class="form-group">
                    <label for="advFilterCity">Filter Kota / Wilayah Alamat</label>
                    <select id="advFilterCity"
                        style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 10px 14px; font-size: 13.5px; background: #fff; outline: none; cursor: pointer;">
                        <option value="">Semua Kota / Wilayah</option>
                        @foreach($allAvailableCities as $c)
                            <option value="{{ $c }}">{{ $c }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="advFilterStatus">Status Keanggotaan</label>
                    <select id="advFilterStatus"
                        style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 10px 14px; font-size: 13.5px; background: #fff; outline: none; cursor: pointer;">
                        <option value="">Semua Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="advFilterDatePreset">Rentang Waktu Pendaftaran</label>
                    <select id="advFilterDatePreset"
                        style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 10px 14px; font-size: 13.5px; background: #fff; outline: none; margin-bottom: 8px; cursor: pointer;">
                        <option value="">Semua Rentang Waktu</option>
                        <option value="today">Hari Ini</option>
                        <option value="7days">7 Hari Terakhir</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="this_year">Tahun Ini</option>
                        <option value="custom">Pilih Tanggal Manual...</option>
                    </select>
                    <div id="advDateRangeBox" style="display: flex; gap: 10px;">
                        <input type="date" id="advFilterStartDate" style="width: 50%;" title="Dari Tanggal">
                        <input type="date" id="advFilterEndDate" style="width: 50%;" title="Sampai Tanggal">
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" id="resetFilterBtn">Reset Filter</button>
                    <button type="button" class="btn-save" id="applyFilterBtn">Terapkan Filter</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Pelanggan -->
    <div class="modal-overlay" id="detailModalOverlay">
        <div class="modal-box" style="max-width: 550px; padding: 0; overflow: hidden; border-radius: 16px;">
            <div
                style="background: linear-gradient(135deg, #1B3B6F 0%, #1E3A8A 100%); padding: 24px; color: #fff; position: relative;">
                <button class="close-modal-btn" id="closeDetailModalBtn"
                    style="color: #fff; position: absolute; right: 20px; top: 20px; opacity: 0.8; font-size: 24px; background:none; border:none; cursor:pointer;">&times;</button>
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div id="detAvatar"
                        style="width: 56px; height: 56px; border-radius: 50%; background: #DBEAFE; color: #1D4ED8; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; border: 3px solid rgba(255,255,255,0.3); flex-shrink: 0;">
                        EJ
                    </div>
                    <div>
                        <h3 id="detNama" style="font-size: 20px; font-weight: 800; color: #ffffff; margin-bottom: 4px;">
                            Nama Pelanggan</h3>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span id="detKode"
                                style="background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 6px; font-size: 11.5px; font-weight: 700; color: #ffffff;">CUST-000</span>
                            <span id="detStatusBadge" class="badge" style="font-size: 11px;">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="padding: 24px; display: flex; flex-direction: column; gap: 18px;">
                <div
                    style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; background: #F8FAFC; padding: 16px; border-radius: 12px; border: 1px solid #E2E8F0;">
                    <div>
                        <div
                            style="font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; margin-bottom: 4px;">
                            No. Telepon / WA</div>
                        <div
                            style="font-size: 14px; font-weight: 600; color: #0F172A; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-phone" style="color: #2563EB; font-size: 13px;"></i>
                            <span id="detNoHp">-</span>
                            <a id="detWaLink" href="#" target="_blank" title="Chat WhatsApp"
                                style="color: #16A34A; margin-left: 4px;"><i class="fa-brands fa-whatsapp"
                                    style="font-size: 17px;"></i></a>
                        </div>
                    </div>
                    <div>
                        <div
                            style="font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; margin-bottom: 4px;">
                            Email</div>
                        <div
                            style="font-size: 14px; font-weight: 600; color: #0F172A; display: flex; align-items: center; gap: 8px; word-break: break-all;">
                            <i class="fa-regular fa-envelope" style="color: #2563EB; font-size: 13px;"></i>
                            <span id="detEmail">-</span>
                        </div>
                    </div>
                </div>

                <div style="background: #F8FAFC; padding: 16px; border-radius: 12px; border: 1px solid #E2E8F0;">
                    <div
                        style="font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; margin-bottom: 4px;">
                        Alamat Lengkap</div>
                    <div
                        style="font-size: 14px; font-weight: 600; color: #0F172A; display: flex; align-items: flex-start; gap: 8px;">
                        <i class="fa-solid fa-location-dot"
                            style="color: #EF4444; font-size: 14px; margin-top: 2px;"></i>
                        <span id="detAlamat" style="line-height: 1.4;">-</span>
                    </div>
                </div>

                <div
                    style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; background: #F8FAFC; padding: 16px; border-radius: 12px; border: 1px solid #E2E8F0;">
                    <div>
                        <div
                            style="font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; margin-bottom: 4px;">
                            Total Transaksi</div>
                        <div
                            style="font-size: 16px; font-weight: 800; color: #1E3A8A; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-bag-shopping" style="color: #1E3A8A; font-size: 14px;"></i>
                            <span id="detTotalPesanan">0x Pesanan</span>
                        </div>
                    </div>
                    <div>
                        <div
                            style="font-size: 11.5px; font-weight: 700; color: #64748B; text-transform: uppercase; margin-bottom: 4px;">
                            Tanggal Terdaftar</div>
                        <div
                            style="font-size: 13.5px; font-weight: 600; color: #0F172A; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-regular fa-calendar-check" style="color: #16A34A; font-size: 13px;"></i>
                            <span id="detTanggalDaftar">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                style="padding: 16px 24px 24px; display: flex; justify-content: space-between; align-items: center; background: #FAF5FF; border-top: 1px solid #F1F5F9;">
                <a id="detBuatPesananBtn" href="#" class="btn-add"
                    style="text-decoration: none; font-size: 13px; padding: 8px 16px;">
                    <i class="fa-solid fa-cart-plus"></i>
                    <span>Buat Pesanan</span>
                </a>
                <div style="display: flex; gap: 10px;">
                    <button type="button" class="btn-cancel" id="detEditBtn"
                        style="font-size: 13px; padding: 8px 16px;">
                        <i class="fa-regular fa-pen-to-square"></i> Edit
                    </button>
                    <button type="button" class="btn-cancel" id="closeDetailModalFooterBtn"
                        style="font-size: 13px; padding: 8px 16px; background: #E2E8F0;">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const modalOverlay = document.getElementById('modalOverlay');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');
        const addCustomerForm = document.getElementById('addCustomerForm');
        const modalTitle = document.querySelector('.modal-title');
        const customerTable = document.getElementById('customerTable');
        const tbody = customerTable.getElementsByTagName('tbody')[0];
        const entryInfo = document.querySelector('.entry-info');
        const paginationEl = document.querySelector('.pagination');

        // Filter More Modal Elements
        const filterMoreModalOverlay = document.getElementById('filterMoreModalOverlay');
        const openFilterMoreBtn = document.getElementById('openFilterMoreBtn');
        const closeFilterMoreBtn = document.getElementById('closeFilterMoreBtn');
        const resetFilterBtn = document.getElementById('resetFilterBtn');
        const applyFilterBtn = document.getElementById('applyFilterBtn');
        const filterStatusSelect = document.getElementById('filterStatusSelect');

        // Select All Checkbox Handler
        const selectAllCb = document.getElementById('selectAll');
        if (selectAllCb) {
            selectAllCb.addEventListener('change', function () {
                const checkboxes = tbody.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        }

        let currentPage = 1;
        const itemsPerPage = 5;

        function updatePagination() {
            if (!tbody) return;
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const visibleRows = rows.filter(r => r.getAttribute('data-search-hidden') !== 'true' && r.getAttribute('data-filter-hidden') !== 'true');
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

        // Custom Country Flag Picker JS Logic
        const countryPickerBtn = document.getElementById('countryPickerBtn');
        const countryPickerDropdown = document.getElementById('countryPickerDropdown');
        const cusCountryCodeInput = document.getElementById('cusCountryCode');
        const selectedFlagImg = document.getElementById('selectedFlagImg');
        const selectedCountryCode = document.getElementById('selectedCountryCode');

        if (countryPickerBtn && countryPickerDropdown) {
            countryPickerBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                countryPickerDropdown.classList.toggle('show');
            });

            const countryOptions = countryPickerDropdown.querySelectorAll('.country-option');
            countryOptions.forEach(opt => {
                opt.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const code = opt.getAttribute('data-code');
                    const flag = opt.getAttribute('data-flag');

                    if (cusCountryCodeInput) cusCountryCodeInput.value = code;
                    if (selectedFlagImg) selectedFlagImg.src = flag;
                    if (selectedCountryCode) selectedCountryCode.textContent = code;

                    countryOptions.forEach(o => o.classList.remove('active'));
                    opt.classList.add('active');

                    countryPickerDropdown.classList.remove('show');
                });
            });

            document.addEventListener('click', () => {
                countryPickerDropdown.classList.remove('show');
            });
        }

        window.setCustomCountryPickerValue = function (code) {
            if (!countryPickerDropdown) return;
            const countryOptions = countryPickerDropdown.querySelectorAll('.country-option');
            let targetOpt = null;
            countryOptions.forEach(opt => {
                if (opt.getAttribute('data-code') === code) {
                    targetOpt = opt;
                }
            });
            if (!targetOpt && countryOptions.length > 0) targetOpt = countryOptions[0];
            if (targetOpt) {
                const targetCode = targetOpt.getAttribute('data-code');
                const targetFlag = targetOpt.getAttribute('data-flag');
                if (cusCountryCodeInput) cusCountryCodeInput.value = targetCode;
                if (selectedFlagImg) selectedFlagImg.src = targetFlag;
                if (selectedCountryCode) selectedCountryCode.textContent = targetCode;
                countryOptions.forEach(o => o.classList.remove('active'));
                targetOpt.classList.add('active');
            }
        };

        // Open modal for adding customer
        if (openModalBtn) {
            openModalBtn.addEventListener('click', () => {
                document.getElementById('cusIdVal').value = '';
                if (modalTitle) modalTitle.textContent = 'Tambah Pelanggan Baru';
                addCustomerForm.reset();
                if (window.setCustomCountryPickerValue) window.setCustomCountryPickerValue('+62');
                document.getElementById('cusStatus').value = 'Aktif';
                modalOverlay.classList.add('active');
            });
        }

        if (closeModalBtn) closeModalBtn.addEventListener('click', () => modalOverlay.classList.remove('active'));
        if (cancelModalBtn) cancelModalBtn.addEventListener('click', () => modalOverlay.classList.remove('active'));

        // Filter More Modal Listeners
        if (openFilterMoreBtn) {
            openFilterMoreBtn.addEventListener('click', () => filterMoreModalOverlay.classList.add('active'));
        }
        if (closeFilterMoreBtn) {
            closeFilterMoreBtn.addEventListener('click', () => filterMoreModalOverlay.classList.remove('active'));
        }
        // Handler Quick City Select for Customer Address in Modal
        const cusCityQuickSelect = document.getElementById('cusCityQuickSelect');
        const cusAddressTextarea = document.getElementById('cusAddress');
        if (cusCityQuickSelect && cusAddressTextarea) {
            cusCityQuickSelect.addEventListener('change', function () {
                if (this.value) {
                    const currentVal = cusAddressTextarea.value.trim();
                    if (!currentVal) {
                        cusAddressTextarea.value = this.value;
                    } else if (!currentVal.toLowerCase().includes(this.value.toLowerCase())) {
                        cusAddressTextarea.value = currentVal + ', ' + this.value;
                    }
                }
            });
        }

        // Handler Date Preset in Filter Modal
        const advFilterDatePreset = document.getElementById('advFilterDatePreset');
        const advFilterStartDate = document.getElementById('advFilterStartDate');
        const advFilterEndDate = document.getElementById('advFilterEndDate');

        if (advFilterDatePreset && advFilterStartDate && advFilterEndDate) {
            advFilterDatePreset.addEventListener('change', function () {
                const now = new Date();
                const pad = n => String(n).padStart(2, '0');
                const formatDate = d => `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;

                const todayStr = formatDate(now);

                if (this.value === 'today') {
                    advFilterStartDate.value = todayStr;
                    advFilterEndDate.value = todayStr;
                } else if (this.value === '7days') {
                    const d7 = new Date();
                    d7.setDate(now.getDate() - 7);
                    advFilterStartDate.value = formatDate(d7);
                    advFilterEndDate.value = todayStr;
                } else if (this.value === 'this_month') {
                    const firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
                    advFilterStartDate.value = formatDate(firstDay);
                    advFilterEndDate.value = todayStr;
                } else if (this.value === 'this_year') {
                    const firstYear = new Date(now.getFullYear(), 0, 1);
                    advFilterStartDate.value = formatDate(firstYear);
                    advFilterEndDate.value = todayStr;
                } else if (this.value === '') {
                    advFilterStartDate.value = '';
                    advFilterEndDate.value = '';
                }
            });
        }

        if (resetFilterBtn) {
            resetFilterBtn.addEventListener('click', () => {
                const advCityEl = document.getElementById('advFilterCity');
                if (advCityEl) advCityEl.value = '';
                const advStatusEl = document.getElementById('advFilterStatus');
                if (advStatusEl) advStatusEl.value = '';
                if (advFilterDatePreset) advFilterDatePreset.value = '';
                if (advFilterStartDate) advFilterStartDate.value = '';
                if (advFilterEndDate) advFilterEndDate.value = '';
                if (filterStatusSelect) filterStatusSelect.value = '';
                const quickCityEl = document.getElementById('filterCityQuickSelect');
                if (quickCityEl) quickCityEl.value = '';

                const rows = tbody.querySelectorAll('tr');
                rows.forEach(r => r.removeAttribute('data-filter-hidden'));
                currentPage = 1;
                updatePagination();
                filterMoreModalOverlay.classList.remove('active');
                if (window.showAppToast) window.showAppToast('Filter telah direset.', 'info');
            });
        }

        if (applyFilterBtn) {
            applyFilterBtn.addEventListener('click', () => {
                const cityEl = document.getElementById('advFilterCity');
                const city = cityEl ? cityEl.value.toLowerCase().trim() : '';
                const statusEl = document.getElementById('advFilterStatus');
                const status = statusEl ? statusEl.value.toLowerCase().trim() : '';
                const startDate = advFilterStartDate ? advFilterStartDate.value : '';
                const endDate = advFilterEndDate ? advFilterEndDate.value : '';

                // Also sync quick selects on toolbar if matching
                const quickCityEl = document.getElementById('filterCityQuickSelect');
                if (quickCityEl && cityEl) quickCityEl.value = cityEl.value;
                if (filterStatusSelect && statusEl) filterStatusSelect.value = statusEl.value.toLowerCase();

                const rows = tbody.querySelectorAll('tr');

                rows.forEach(r => {
                    const text = r.textContent.toLowerCase();
                    const custDataStr = r.getAttribute('data-customer');
                    let custData = null;
                    if (custDataStr) {
                        try { custData = JSON.parse(custDataStr); } catch (e) { }
                    }

                    let match = true;
                    if (city) {
                        const alamat = (custData && custData.alamat ? custData.alamat : text).toLowerCase();
                        if (!alamat.includes(city)) match = false;
                    }
                    if (status && !text.includes(status)) match = false;

                    // Filter Date Range
                    if (startDate || endDate) {
                        const rawDate = custData ? (custData.tanggal_daftar || custData.created_at) : '';
                        if (rawDate) {
                            const dStr = rawDate.substring(0, 10);
                            if (startDate && dStr < startDate) match = false;
                            if (endDate && dStr > endDate) match = false;
                        }
                    }

                    if (match) {
                        r.removeAttribute('data-filter-hidden');
                    } else {
                        r.setAttribute('data-filter-hidden', 'true');
                    }
                });
                currentPage = 1;
                updatePagination();
                filterMoreModalOverlay.classList.remove('active');
                if (window.showAppToast) window.showAppToast('Filter berhasil diterapkan!', 'success');
            });
        }

        // Quick Filter Status Select
        if (filterStatusSelect) {
            filterStatusSelect.addEventListener('change', function () {
                const selected = this.value.toLowerCase().trim();
                const quickCityEl = document.getElementById('filterCityQuickSelect');
                const selectedCity = quickCityEl ? quickCityEl.value.toLowerCase().trim() : '';

                const rows = tbody.querySelectorAll('tr');
                rows.forEach(r => {
                    const text = r.textContent.toLowerCase();
                    let match = true;
                    if (selected && !text.includes(selected)) match = false;
                    if (selectedCity && !text.includes(selectedCity)) match = false;

                    if (match) {
                        r.removeAttribute('data-filter-hidden');
                    } else {
                        r.setAttribute('data-filter-hidden', 'true');
                    }
                });
                currentPage = 1;
                updatePagination();
            });
        }

        // Quick Filter City Select
        const filterCityQuickSelect = document.getElementById('filterCityQuickSelect');
        if (filterCityQuickSelect) {
            filterCityQuickSelect.addEventListener('change', function () {
                const selectedCity = this.value.toLowerCase().trim();
                const selectedStatus = filterStatusSelect ? filterStatusSelect.value.toLowerCase().trim() : '';

                const rows = tbody.querySelectorAll('tr');
                rows.forEach(r => {
                    const text = r.textContent.toLowerCase();
                    let match = true;
                    if (selectedCity && !text.includes(selectedCity)) match = false;
                    if (selectedStatus && !text.includes(selectedStatus)) match = false;

                    if (match) {
                        r.removeAttribute('data-filter-hidden');
                    } else {
                        r.setAttribute('data-filter-hidden', 'true');
                    }
                });
                currentPage = 1;
                updatePagination();
            });
        }

        // Function Detail Pelanggan Modal
        let currentDetailData = null;

        window.showCustomerDetail = function (e, p) {
            let data = p;
            if (!data && e && typeof e === 'object' && !e.target) {
                data = e;
            }
            if (!data) return;
            currentDetailData = data;

            document.getElementById('detNama').textContent = data.nama || '-';
            document.getElementById('detKode').textContent = data.kode_pelanggan || '-';

            const avatarEl = document.getElementById('detAvatar');
            if (avatarEl) {
                avatarEl.textContent = (data.nama || 'P').substring(0, 2).toUpperCase();
            }

            const badgeEl = document.getElementById('detStatusBadge');
            if (badgeEl) {
                badgeEl.textContent = data.status || 'Aktif';
                badgeEl.className = 'badge ' + (data.status && data.status.toLowerCase() === 'aktif' ? 'badge-active' : 'badge-inactive');
            }

            document.getElementById('detNoHp').textContent = data.no_hp || '-';

            const waLink = document.getElementById('detWaLink');
            if (waLink) {
                let cleanPhone = (data.no_hp || '').replace(/[^0-9]/g, '');
                if (cleanPhone.startsWith('0')) cleanPhone = '62' + cleanPhone.substring(1);
                if (cleanPhone) {
                    waLink.href = `https://wa.me/${cleanPhone}?text=Halo%20${encodeURIComponent(data.nama)},%20`;
                    waLink.style.display = 'inline-flex';
                } else {
                    waLink.style.display = 'none';
                }
            }

            document.getElementById('detEmail').textContent = data.email || '-';
            document.getElementById('detAlamat').textContent = data.alamat || 'Alamat tidak diisi';
            document.getElementById('detTotalPesanan').textContent = (data.total_pesanan || 0) + 'x Pesanan';

            const rawDate = data.tanggal_daftar || data.created_at;
            let formattedDate = '-';
            if (rawDate) {
                const d = new Date(rawDate);
                if (!isNaN(d.getTime())) {
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                    formattedDate = `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
                }
            }
            document.getElementById('detTanggalDaftar').textContent = formattedDate;

            const buatPesananBtn = document.getElementById('detBuatPesananBtn');
            if (buatPesananBtn) {
                buatPesananBtn.href = `{{ route('pesanan') }}?pelanggan=${encodeURIComponent(data.nama)}`;
            }

            const detailModalOverlay = document.getElementById('detailModalOverlay');
            if (detailModalOverlay) {
                detailModalOverlay.classList.add('active');
            }
        };

        const closeDetailModalBtn = document.getElementById('closeDetailModalBtn');
        const closeDetailModalFooterBtn = document.getElementById('closeDetailModalFooterBtn');
        const detailModalOverlay = document.getElementById('detailModalOverlay');

        if (closeDetailModalBtn) closeDetailModalBtn.addEventListener('click', () => detailModalOverlay.classList.remove('active'));
        if (closeDetailModalFooterBtn) closeDetailModalFooterBtn.addEventListener('click', () => detailModalOverlay.classList.remove('active'));

        // Backdrop click handler to close modals when clicking outside modal box
        [modalOverlay, filterMoreModalOverlay, detailModalOverlay].forEach(modal => {
            if (modal) {
                modal.addEventListener('click', function (evt) {
                    if (evt.target === this) {
                        this.classList.remove('active');
                    }
                });
            }
        });

        const detEditBtn = document.getElementById('detEditBtn');
        if (detEditBtn) {
            detEditBtn.addEventListener('click', function () {
                if (detailModalOverlay) detailModalOverlay.classList.remove('active');
                if (currentDetailData) {
                    window.editPelanggan(currentDetailData);
                }
            });
        }

        // Function edit pelanggan
        window.editPelanggan = function (p) {
            document.getElementById('cusIdVal').value = p.id;
            document.getElementById('cusName').value = p.nama;
            document.getElementById('cusEmail').value = p.email;
            document.getElementById('cusAddress').value = p.alamat || '';
            document.getElementById('cusStatus').value = p.status || 'Aktif';

            // Parse Country Code and Phone Number
            let rawPhone = p.no_hp || '';
            const ccSelect = document.getElementById('cusCountryCode');
            const phoneInput = document.getElementById('cusPhone');
            let matchedCc = '+62';
            const countryCodes = ['+62', '+1', '+65', '+60', '+81', '+44', '+61'];

            for (let code of countryCodes) {
                if (rawPhone.startsWith(code)) {
                    matchedCc = code;
                    rawPhone = rawPhone.substring(code.length).trim();
                    break;
                }
            }
            if (ccSelect) ccSelect.value = matchedCc;
            if (window.setCustomCountryPickerValue) window.setCustomCountryPickerValue(matchedCc);
            if (phoneInput) phoneInput.value = rawPhone;

            if (modalTitle) modalTitle.textContent = 'Edit Data Pelanggan';
            modalOverlay.classList.add('active');
        };

        // Handle Add & Edit submission to MySQL Database via AJAX Fetch
        if (addCustomerForm) {
            addCustomerForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const editingId = document.getElementById('cusIdVal').value;
                const name = document.getElementById('cusName').value.trim();
                const countryCode = document.getElementById('cusCountryCode').value;
                const phoneBody = document.getElementById('cusPhone').value.trim();
                const fullPhone = `${countryCode} ${phoneBody}`;
                const email = document.getElementById('cusEmail').value.trim();
                const address = document.getElementById('cusAddress').value.trim();
                const status = document.getElementById('cusStatus').value;

                const targetUrl = editingId ? `/pelanggan/${editingId}` : "{{ route('pelanggan.store') }}";
                const targetMethod = editingId ? 'PUT' : 'POST';

                fetch(targetUrl, {
                    method: targetMethod,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        nama: name,
                        no_hp: fullPhone,
                        email: email,
                        alamat: address,
                        status: status
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert(data.message || 'Gagal menyimpan data ke database.');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Terjadi kesalahan saat menyimpan data.');
                    });
            });
        }

        // Helper function to bind dropdown toggle & action buttons listener to a row
        function bindRowActions(row) {
            const toggleBtn = row.querySelector('.action-toggle');
            const dropdownMenu = row.querySelector('.dropdown-menu');

            if (toggleBtn && dropdownMenu) {
                toggleBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const isOpening = !dropdownMenu.classList.contains('show');
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== dropdownMenu) menu.classList.remove('show');
                    });
                    if (isOpening) {
                        const rect = toggleBtn.getBoundingClientRect();
                        const tbody = row.parentElement;
                        const rows = tbody ? Array.from(tbody.children).filter(r => r.offsetParent !== null) : [];
                        const index = rows.indexOf(row);
                        const spaceBelow = window.innerHeight - rect.bottom;
                        if (spaceBelow < 220 || (rows.length > 2 && index >= rows.length - 2)) {
                            dropdownMenu.classList.add('dropup');
                        } else {
                            dropdownMenu.classList.remove('dropup');
                        }
                        dropdownMenu.classList.add('show');
                    } else {
                        dropdownMenu.classList.remove('show');
                    }
                });
            }

            const detailBtn = row.querySelector('.btn-show-detail');
            if (detailBtn) {
                detailBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    if (dropdownMenu) dropdownMenu.classList.remove('show');
                    const custDataStr = this.getAttribute('data-customer');
                    if (custDataStr) {
                        window.showCustomerDetail(JSON.parse(custDataStr));
                    }
                });
            }

            const editBtn = row.querySelector('.btn-edit-pelanggan');
            if (editBtn) {
                editBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    if (dropdownMenu) dropdownMenu.classList.remove('show');
                    const custDataStr = this.getAttribute('data-customer');
                    if (custDataStr) {
                        window.editPelanggan(JSON.parse(custDataStr));
                    }
                });
            }

            row.addEventListener('click', function (e) {
                if (e.target.closest('.prevent-row-click, .action-dropdown, input[type="checkbox"], button, a')) return;
                const custDataStr = this.getAttribute('data-customer');
                if (custDataStr) {
                    window.showCustomerDetail(JSON.parse(custDataStr));
                }
            });
        }

        // Bind existing table rows & initialize pagination
        tbody.querySelectorAll('tr').forEach(row => bindRowActions(row));
        updatePagination();

        // Client side search filter
        const customerSearchInput = document.getElementById('customerSearchInput');
        if (customerSearchInput) {
            customerSearchInput.addEventListener('keyup', function () {
                const query = this.value.toLowerCase();
                const rows = tbody.querySelectorAll('tr');
                rows.forEach(r => {
                    if (r.textContent.toLowerCase().includes(query)) {
                        r.removeAttribute('data-search-hidden');
                    } else {
                        r.setAttribute('data-search-hidden', 'true');
                    }
                });
                currentPage = 1;
                updatePagination();
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function () {
            document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.remove('show'));
        });
    </script>
    @include('layouts.navbar_assets')
</body>

</html>