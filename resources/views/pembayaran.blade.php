<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pembayaran - SIPEKAN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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

        .sidebar {
            width: 250px;
            background: #FFFFFF;
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
            padding: 16px 14px 20px;
            border-top: 1px dashed #E2E8F0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

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
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .topbar > div:first-child {
            display: flex;
            align-items: center;
        }

        .search-container {
            position: relative;
            width: 320px;
        }

        .search-container .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 14px;
        }

        .search-container .search-input {
            width: 100%;
            background-color: #F1F5F9;
            border: 1px solid transparent;
            border-radius: 8px;
            padding: 9px 14px 9px 38px;
            font-size: 13px;
            color: #1E293B;
            outline: none;
            transition: all 0.2s;
        }

        .search-container .search-input:focus {
            background-color: #FFFFFF;
            border-color: #CBD5E1;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08);
        }

        .clear-search-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 16px;
            color: #94A3B8;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .icon-btn {
            background: none;
            border: none;
            color: #64748B;
            font-size: 17px;
            cursor: pointer;
            padding: 6px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }

        .icon-btn:hover {
            color: #1E3A8A;
            background-color: #F1F5F9;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .user-profile:hover {
            background-color: #F8FAFC;
        }

        .avatar-img {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid #E2E8F0;
        }

        .user-name-label {
            font-size: 13.5px;
            font-weight: 700;
            color: #0F172A;
        }

        .profile-chevron {
            font-size: 11px;
            color: #64748B;
        }

        .content-body {
            padding: 20px 24px;
            flex: 1;
        }

        .page-header-row {
            margin-bottom: 18px;
        }

        .page-title {
            font-size: 23px;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -0.5px;
        }

        .page-subtitle {
            font-size: 13px;
            color: #64748B;
            margin-top: 2px;
        }

        /* 2 Column Grid Layout */
        .grid-2col {
            display: grid;
            grid-template-columns: 275px minmax(0, 1fr);
            gap: 16px;
            align-items: start;
        }

        .card {
            background: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            padding: 16px 18px;
        }

        .card-title {
            font-size: 15.5px;
            font-weight: 800;
            color: #0F172A;
            margin-bottom: 14px;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .card-header-icon {
            width: 30px;
            height: 30px;
            background: #DBEAFE;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1E3A8A;
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 4px;
        }

        .form-control {
            width: 100%;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 8px 11px;
            font-size: 12.5px;
            color: #0F172A;
            outline: none;
            background: #FFFFFF;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #1E3A8A;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .btn-submit {
            width: 100%;
            background: #1B3B6F;
            color: #FFFFFF;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 14px;
            transition: background 0.2s ease;
        }

        .btn-submit:hover {
            background: #1E3A8A;
        }

        .filter-search {
            position: relative;
            width: 180px;
        }

        .filter-search input {
            width: 100%;
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 6px 10px 6px 30px;
            font-size: 12px;
            outline: none;
            color: #1E293B;
        }

        .filter-search .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 11px;
            color: #94A3B8;
        }

        /* Custom Table (Responsive & Clean Fit) */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            table-layout: auto;
        }

        .custom-table th {
            background: #FFFFFF;
            padding: 8px 6px;
            font-size: 10.5px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-bottom: 1px solid #E2E8F0;
            white-space: nowrap;
        }

        .custom-table td {
            padding: 8px 6px;
            font-size: 11.5px;
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
            background: #F8FAFC;
        }

        .pay-id {
            font-weight: 700;
            color: #0F172A;
            white-space: nowrap;
            font-size: 11.5px;
        }

        .order-link {
            color: #1E3A8A;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            font-size: 11.5px;
        }

        .order-link:hover {
            text-decoration: underline;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 78px;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10.5px;
            font-weight: 700;
            white-space: nowrap;
            text-align: center;
        }

        .status-lunas {
            background: #DCFCE7;
            color: #16A34A;
        }

        .status-menunggu {
            background: #DBEAFE;
            color: #1E3A8A;
        }

        .table-footer {
            padding-top: 14px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #E2E8F0;
        }

        .entry-info {
            font-size: 12px;
            color: #64748B;
            font-weight: 500;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .page-btn {
            min-width: 30px;
            height: 30px;
            padding: 0 6px;
            border-radius: 6px;
            border: 1px solid #E2E8F0;
            background: #FFFFFF;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-btn.active {
            background: #1B3B6F;
            border-color: #1B3B6F;
            color: #FFFFFF;
            font-weight: 700;
        }

        @media (max-width: 900px) {
            .grid-2col {
                grid-template-columns: 1fr;
            }
            .table-responsive {
                overflow-x: auto;
            }
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
                <p class="page-subtitle">Pencatatan pembayaran pesanan dengan validasi tanggal dan status otomatis.</p>
            </div>

            @if(session('error'))
                <div class="alert alert-danger" style="padding: 12px 16px; background: #FEF2F2; color: #991B1B; border: 1px solid #FCA5A5; border-radius: 8px; margin-bottom: 20px; font-weight: 600; font-size: 13.5px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success" style="padding: 12px 16px; background: #F0FDF4; color: #166534; border: 1px solid #86EFAC; border-radius: 8px; margin-bottom: 20px; font-weight: 600; font-size: 13.5px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid-2col">
                <!-- Left Card - Form Pembayaran Baru -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-icon"><i class="fa-solid fa-credit-card"></i></div>
                        <h2 class="card-title" style="margin-bottom:0;">Pembayaran Baru</h2>
                    </div>

                    <form action="{{ route('pembayaran.store') }}" method="POST" id="mainPaymentForm">
                        @csrf
                        <div class="form-group">
                            <label for="payOrder">Pilih Pesanan</label>
                            <select name="kode_pesanan" id="payOrder" class="form-control" required>
                                <option value="">Pilih pesanan...</option>
                                @foreach($pesanans ?? [] as $p)
                                    @php
                                        $isAlreadyLunas = in_array($p->kode_pesanan, $lunasOrderCodes ?? []) || strtolower($p->status ?? '') === 'lunas' || strtolower($p->status ?? '') === 'selesai';
                                        $alreadyPaid = $paidByOrder[$p->kode_pesanan] ?? 0;
                                        $remaining = max(0, $p->total_harga - $alreadyPaid);
                                        $orderDateVal = $p->tanggal_pesan ? \Carbon\Carbon::parse($p->tanggal_pesan)->format('Y-m-d') : ($p->created_at ? $p->created_at->format('Y-m-d') : date('Y-m-d'));
                                        $orderDateFormatted = $p->tanggal_pesan ? \Carbon\Carbon::parse($p->tanggal_pesan)->format('d M Y') : ($p->created_at ? $p->created_at->format('d M Y') : date('d M Y'));
                                    @endphp
                                    <option value="{{ $p->kode_pesanan }}" 
                                        data-nama="{{ $p->nama_pelanggan }}"
                                        data-produk="{{ $p->nama_produk }}"
                                        data-harga="{{ $p->total_harga }}" 
                                        data-paid="{{ $alreadyPaid }}"
                                        data-remaining="{{ $isAlreadyLunas ? 0 : ($remaining > 0 ? $remaining : $p->total_harga) }}"
                                        data-tanggal="{{ $orderDateVal }}"
                                        data-tanggal-fmt="{{ $orderDateFormatted }}"
                                        {{ $isAlreadyLunas ? 'disabled style=color:#94A3B8;background:#F1F5F9;' : '' }}>
                                        {{ $p->kode_pesanan }} – {{ $p->nama_pelanggan }} (Rp {{ number_format($p->total_harga, 0, ',', '.') }}) {{ $isAlreadyLunas ? ' [LUNAS]' : '' }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Dynamic Order Summary Card (Clean & Elegant) -->
                            <div id="orderSummaryBox" style="display: none; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 10px 12px; margin-top: 8px;">
                                <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 6px; margin-bottom: 6px; border-bottom: 1px solid #E2E8F0;">
                                    <span style="font-size: 11px; font-weight: 700; color: #1E3A8A; text-transform: uppercase; letter-spacing: 0.5px;">Rincian Pesanan</span>
                                    <span id="sumOrderDate" style="font-size: 11px; font-weight: 600; color: #64748B;">-</span>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 4px; font-size: 12px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span style="color: #64748B;">Pelanggan</span>
                                        <span id="sumCustomer" style="font-weight: 600; color: #0F172A; text-align: right;">-</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span style="color: #64748B;">Produk</span>
                                        <span id="sumProduct" style="font-weight: 600; color: #0F172A; text-align: right;">-</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 4px; border-top: 1px solid #E2E8F0; margin-top: 2px;">
                                        <span style="color: #64748B;">Total Tagihan</span>
                                        <span id="sumTotal" style="font-weight: 700; color: #0F172A;">Rp 0</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span style="color: #1E3A8A; font-weight: 700;">Sisa Tagihan</span>
                                        <span id="sumRemaining" style="font-weight: 800; color: #1E3A8A;">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date Input with Silent Background Validation -->
                        <div class="form-group">
                            <label for="payDate">Tanggal Pembayaran</label>
                            <input type="date" name="tanggal_bayar" id="payDate" class="form-control" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="payMethod">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="payMethod" class="form-control" required>
                                <option value="">Pilih metode...</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="QRIS">QRIS</option>
                                <option value="Tunai">Tunai</option>
                            </select>
                        </div>

                        <!-- Dynamic Payment Details (Clean & Minimalist, No Calculator) -->
                        <div id="paymentDetailsContainer" style="display: none; margin-top: 6px; margin-bottom: 14px;">
                            <!-- QRIS Card -->
                            <div id="qrisBox" style="display: none; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: 12px 14px;">
                                <div style="display: flex; align-items: center; gap: 14px;">
                                    <div style="flex-shrink: 0; background: #FFFFFF; padding: 5px; border: 1px solid #1E3A8A; border-radius: 6px; line-height: 0;">
                                        <svg width="60" height="60" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="200" height="200" fill="white"/>
                                            <rect x="10" y="10" width="55" height="55" rx="6" fill="#1E3A8A"/>
                                            <rect x="20" y="20" width="35" height="35" rx="3" fill="white"/>
                                            <rect x="27" y="27" width="21" height="21" rx="2" fill="#1E3A8A"/>
                                            <rect x="135" y="10" width="55" height="55" rx="6" fill="#1E3A8A"/>
                                            <rect x="145" y="20" width="35" height="35" rx="3" fill="white"/>
                                            <rect x="152" y="27" width="21" height="21" rx="2" fill="#1E3A8A"/>
                                            <rect x="10" y="135" width="55" height="55" rx="6" fill="#1E3A8A"/>
                                            <rect x="20" y="145" width="35" height="35" rx="3" fill="white"/>
                                            <rect x="27" y="152" width="21" height="21" rx="2" fill="#1E3A8A"/>
                                            <rect x="75" y="15" width="12" height="12" rx="2" fill="#1E3A8A"/>
                                            <rect x="95" y="15" width="12" height="12" rx="2" fill="#1E3A8A"/>
                                            <rect x="115" y="15" width="12" height="12" rx="2" fill="#1E3A8A"/>
                                            <rect x="75" y="35" width="12" height="12" rx="2" fill="#1E3A8A"/>
                                            <rect x="105" y="35" width="18" height="18" rx="2" fill="#1E3A8A"/>
                                            <rect x="15" y="75" width="12" height="12" rx="2" fill="#1E3A8A"/>
                                            <rect x="35" y="75" width="12" height="12" rx="2" fill="#1E3A8A"/>
                                            <rect x="55" y="75" width="12" height="12" rx="2" fill="#1E3A8A"/>
                                            <rect x="75" y="75" width="50" height="50" rx="6" fill="#1E3A8A"/>
                                            <text x="100" y="105" font-family="'Plus Jakarta Sans', sans-serif" font-size="14" font-weight="900" fill="white" text-anchor="middle">QRIS</text>
                                            <rect x="135" y="75" width="15" height="15" rx="2" fill="#1E3A8A"/>
                                            <rect x="160" y="75" width="25" height="12" rx="2" fill="#1E3A8A"/>
                                            <rect x="15" y="95" width="15" height="15" rx="2" fill="#1E3A8A"/>
                                            <rect x="40" y="95" width="15" height="15" rx="2" fill="#1E3A8A"/>
                                            <rect x="135" y="100" width="20" height="20" rx="2" fill="#1E3A8A"/>
                                            <rect x="165" y="95" width="20" height="20" rx="2" fill="#1E3A8A"/>
                                            <rect x="75" y="135" width="15" height="15" rx="2" fill="#1E3A8A"/>
                                            <rect x="100" y="135" width="25" height="15" rx="2" fill="#1E3A8A"/>
                                            <rect x="135" y="135" width="50" height="50" rx="4" fill="#1E3A8A"/>
                                            <rect x="145" y="145" width="30" height="30" rx="2" fill="white"/>
                                            <rect x="155" y="155" width="10" height="10" rx="1" fill="#1E3A8A"/>
                                            <rect x="75" y="160" width="20" height="25" rx="2" fill="#1E3A8A"/>
                                            <rect x="105" y="165" width="20" height="20" rx="2" fill="#1E3A8A"/>
                                        </svg>
                                    </div>
                                    <div style="flex: 1; min-width: 0;">
                                        <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 2px;">
                                            <span style="background: #1E3A8A; color: #FFFFFF; font-weight: 800; font-size: 9.5px; padding: 1px 5px; border-radius: 4px;">QRIS</span>
                                            <span style="font-size: 11px; font-weight: 800; color: #0F172A;">SIPEKAN PRINT</span>
                                        </div>
                                        <div style="font-size: 9.5px; color: #64748B; margin-bottom: 5px;">M-Banking / E-Wallet</div>
                                        <button type="button" id="openQrisModalBtn" style="background: #EEF2FF; color: #1E3A8A; border: 1px solid #C7D2FE; padding: 2px 8px; border-radius: 4px; font-size: 10.5px; font-weight: 700; cursor: pointer;">
                                            <i class="fa-solid fa-expand"></i> Perbesar QR
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Transfer Card -->
                            <div id="bankBox" style="display: none; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: 10px 12px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; background: #F8FAFC; padding: 6px 8px; border-radius: 6px; border: 1px solid #E2E8F0;">
                                        <div style="display: flex; align-items: center; gap: 6px; min-width: 0;">
                                            <span style="background: #005E9E; color: #FFFFFF; font-weight: 900; font-size: 9.5px; padding: 1px 5px; border-radius: 3px;">BCA</span>
                                            <span style="font-size: 11.5px; font-weight: 800; color: #0F172A;">8830-9921-77</span>
                                        </div>
                                        <button type="button" onclick="copyAccNo('8830992177', this)" style="background: #FFFFFF; color: #1E3A8A; border: 1px solid #CBD5E1; padding: 2px 7px; border-radius: 4px; font-size: 10.5px; font-weight: 700; cursor: pointer;">Salin</button>
                                    </div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; background: #F8FAFC; padding: 6px 8px; border-radius: 6px; border: 1px solid #E2E8F0;">
                                        <div style="display: flex; align-items: center; gap: 6px; min-width: 0;">
                                            <span style="background: #F59E0B; color: #000000; font-weight: 900; font-size: 9.5px; padding: 1px 5px; border-radius: 3px;">MANDIRI</span>
                                            <span style="font-size: 11.5px; font-weight: 800; color: #0F172A;">1370-0098-1122</span>
                                        </div>
                                        <button type="button" onclick="copyAccNo('137000981122', this)" style="background: #FFFFFF; color: #1E3A8A; border: 1px solid #CBD5E1; padding: 2px 7px; border-radius: 4px; font-size: 10.5px; font-weight: 700; cursor: pointer;">Salin</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="payAmount">Jumlah Bayar Masuk (IDR)</label>
                            <input type="number" name="jumlah" id="payAmount" class="form-control" min="1" step="any" placeholder="Contoh: 50000" required>
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
                            <input type="text" id="paySearchInput" placeholder="Cari pembayaran...">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="custom-table" id="payTable">
                            <thead>
                                <tr>
                                    <th>NO. BAYAR</th>
                                    <th>PESANAN</th>
                                    <th>TANGGAL</th>
                                    <th>METODE</th>
                                    <th>JUMLAH</th>
                                    <th>STATUS</th>
                                    <th style="text-align: right;">BUKTI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pembayarans ?? [] as $pem)
                                @php
                                    $relPesanan = $pesanans->firstWhere('kode_pesanan', $pem->kode_pesanan);
                                    $custName = $relPesanan ? $relPesanan->nama_pelanggan : 'Pelanggan Umum';
                                    $prodName = $relPesanan ? $relPesanan->nama_produk : 'Produk Cetak';
                                    $totalTagihan = $relPesanan ? $relPesanan->total_harga : $pem->jumlah;
                                @endphp
                                <tr>
                                    <td class="pay-id">{{ $pem->kode_pembayaran }}</td>
                                    <td><a href="{{ route('pesanan') }}" class="order-link">{{ $pem->kode_pesanan }}</a></td>
                                    <td>{{ $pem->tanggal_bayar ? \Carbon\Carbon::parse($pem->tanggal_bayar)->format('d M Y') : ($pem->tanggal ? \Carbon\Carbon::parse($pem->tanggal)->format('d M Y') : '-') }}</td>
                                    <td>{{ $pem->metode_pembayaran ?? $pem->metode }}</td>
                                    <td style="white-space: nowrap; font-weight: 600; color: #0F172A;">Rp {{ number_format($pem->jumlah, 0, ',', '.') }}</td>
                                    <td><span class="status-badge {{ (strtolower($pem->status) == 'lunas' || strtolower($pem->status) == 'sudah lunas') ? 'status-lunas' : 'status-menunggu' }}">{{ (strtolower($pem->status) == 'lunas' || strtolower($pem->status) == 'sudah lunas') ? 'Sudah Lunas' : $pem->status }}</span></td>
                                    <td style="text-align: right;">
                                        <button type="button" onclick="openReceiptModal({{ json_encode([
                                            'kode_pembayaran' => $pem->kode_pembayaran,
                                            'kode_pesanan' => $pem->kode_pesanan,
                                            'nama_pelanggan' => $custName,
                                            'nama_produk' => $prodName,
                                            'total_tagihan' => $totalTagihan,
                                            'jumlah_bayar' => $pem->jumlah,
                                            'metode' => $pem->metode_pembayaran ?? $pem->metode ?? 'Tunai',
                                            'tanggal' => $pem->tanggal_bayar ? \Carbon\Carbon::parse($pem->tanggal_bayar)->format('d M Y') : ($pem->tanggal ? \Carbon\Carbon::parse($pem->tanggal)->format('d M Y') : date('d M Y')),
                                            'status' => $pem->status,
                                        ]) }})" style="background: #EEF2FF; color: #1E3A8A; border: 1px solid #C7D2FE; padding: 4px 9px; border-radius: 6px; font-size: 11px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;" title="Cetak Nota Pembayaran">
                                            <i class="fa-solid fa-receipt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; padding:20px; color:#64748B;">Belum ada data pembayaran di database.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        <div class="entry-info">Menampilkan {{ count($pembayarans ?? []) }} data pembayaran</div>
                        <div class="pagination">
                            <button class="page-btn"><i class="fa-solid fa-chevron-left" style="font-size: 11px;"></i></button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn"><i class="fa-solid fa-chevron-right" style="font-size: 11px;"></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Printable Receipt Modal -->
    <div class="modal-overlay" id="receiptModalOverlay" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.6); display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.2s ease;">
        <div class="modal-box" style="background: #FFFFFF; border-radius: 12px; width: 100%; max-width: 440px; padding: 24px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); transform: translateY(-10px); transition: transform 0.2s ease; border: 1px solid #E2E8F0;">
            <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px dashed #E2E8F0; padding-bottom: 12px; margin-bottom: 16px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-receipt" style="color: #1E3A8A; font-size: 18px;"></i>
                    <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">Nota Pembayaran</h3>
                </div>
                <button type="button" id="closeReceiptModalBtn" style="background: none; border: none; font-size: 18px; color: #64748B; cursor: pointer;">&times;</button>
            </div>

            <!-- Receipt Card Content (Print Target) -->
            <div id="receiptPrintArea" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 18px; font-size: 13px; color: #1E293B; line-height: 1.5;">
                <div style="text-align: center; border-bottom: 1px dashed #CBD5E1; padding-bottom: 12px; margin-bottom: 12px;">
                    <div style="font-size: 16px; font-weight: 900; color: #1E3A8A; letter-spacing: -0.3px;">SIPEKAN DIGITAL PRINTING</div>
                    <div style="font-size: 11.5px; color: #64748B; font-weight: 500;">Layanan Cetak Cepat & Berkualitas</div>
                    <div style="font-size: 10.5px; color: #94A3B8; margin-top: 2px;">Jl. Percetakan No. 45, Jakarta • Telp: (021) 555-0192</div>
                </div>

                <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                    <span style="color: #64748B;">No. Transaksi:</span>
                    <strong id="recNoBayar" style="color: #0F172A;">-</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                    <span style="color: #64748B;">Kode Pesanan:</span>
                    <strong id="recKodePesanan" style="color: #1E3A8A;">-</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                    <span style="color: #64748B;">Tanggal Bayar:</span>
                    <span id="recTanggal" style="font-weight: 600; color: #0F172A;">-</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                    <span style="color: #64748B;">Pelanggan:</span>
                    <strong id="recPelanggan" style="color: #0F172A;">-</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span style="color: #64748B;">Produk:</span>
                    <span id="recProduk" style="font-weight: 600; color: #0F172A;">-</span>
                </div>

                <div style="border-top: 1px dashed #CBD5E1; padding-top: 8px; margin-top: 8px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                        <span style="color: #64748B;">Total Tagihan:</span>
                        <strong id="recTotalTagihan" style="color: #0F172A;">Rp 0</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                        <span style="color: #64748B;">Metode Bayar:</span>
                        <span id="recMetode" style="font-weight: 700; color: #1E3A8A;">-</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                        <span style="color: #64748B;">Jumlah Dibayar:</span>
                        <strong id="recJumlahBayar" style="color: #16A34A; font-size: 14px; font-weight: 900;">Rp 0</strong>
                    </div>
                </div>

                <div style="border-top: 1.5px solid #1E3A8A; padding-top: 10px; margin-top: 12px; display: flex; align-items: center; justify-content: space-between;">
                    <span style="font-weight: 800; color: #0F172A; font-size: 12px;">STATUS PEMBAYARAN:</span>
                    <span id="recStatusBadge" style="background: #DCFCE7; color: #16A34A; padding: 3px 12px; border-radius: 12px; font-weight: 800; font-size: 11.5px;">LUNAS</span>
                </div>

                <div style="text-align: center; margin-top: 14px; font-size: 11px; color: #94A3B8;">
                    Terima kasih atas kepercayaan Anda bertransaksi di SIPEKAN.
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 16px;">
                <button type="button" id="btnBatalReceipt" style="background: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; padding: 8px 16px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer;">Tutup</button>
                <button type="button" onclick="window.print()" style="background: #1B3B6F; color: #FFFFFF; border: none; padding: 8px 18px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-print"></i>
                    <span>Cetak Nota</span>
                </button>
            </div>
        </div>
    </div>

    <!-- QRIS Preview Modal -->
    <div class="modal-overlay" id="qrisModalOverlay" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.7); display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.2s ease;">
        <div class="modal-box" style="background: #FFFFFF; border-radius: 14px; width: 100%; max-width: 380px; padding: 24px; text-align: center; box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">Scan QRIS SIPEKAN</h3>
                <button type="button" id="closeQrisModalBtn" style="background: none; border: none; font-size: 20px; color: #94A3B8; cursor: pointer;">&times;</button>
            </div>
            <div style="background: #FFFFFF; border: 2px solid #1E3A8A; border-radius: 12px; padding: 14px; display: inline-block; margin-bottom: 14px;">
                <svg width="220" height="220" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="200" height="200" fill="white"/>
                    <rect x="10" y="10" width="55" height="55" rx="6" fill="#1E3A8A"/>
                    <rect x="20" y="20" width="35" height="35" rx="3" fill="white"/>
                    <rect x="27" y="27" width="21" height="21" rx="2" fill="#1E3A8A"/>
                    <rect x="135" y="10" width="55" height="55" rx="6" fill="#1E3A8A"/>
                    <rect x="145" y="20" width="35" height="35" rx="3" fill="white"/>
                    <rect x="152" y="27" width="21" height="21" rx="2" fill="#1E3A8A"/>
                    <rect x="10" y="135" width="55" height="55" rx="6" fill="#1E3A8A"/>
                    <rect x="20" y="145" width="35" height="35" rx="3" fill="white"/>
                    <rect x="27" y="152" width="21" height="21" rx="2" fill="#1E3A8A"/>
                    <rect x="75" y="15" width="12" height="12" rx="2" fill="#1E3A8A"/>
                    <rect x="95" y="15" width="12" height="12" rx="2" fill="#1E3A8A"/>
                    <rect x="115" y="15" width="12" height="12" rx="2" fill="#1E3A8A"/>
                    <rect x="75" y="35" width="12" height="12" rx="2" fill="#1E3A8A"/>
                    <rect x="105" y="35" width="18" height="18" rx="2" fill="#1E3A8A"/>
                    <rect x="15" y="75" width="12" height="12" rx="2" fill="#1E3A8A"/>
                    <rect x="35" y="75" width="12" height="12" rx="2" fill="#1E3A8A"/>
                    <rect x="55" y="75" width="12" height="12" rx="2" fill="#1E3A8A"/>
                    <rect x="75" y="75" width="50" height="50" rx="6" fill="#1E3A8A"/>
                    <text x="100" y="105" font-family="'Plus Jakarta Sans', sans-serif" font-size="14" font-weight="900" fill="white" text-anchor="middle">QRIS</text>
                    <rect x="135" y="75" width="15" height="15" rx="2" fill="#1E3A8A"/>
                    <rect x="160" y="75" width="25" height="12" rx="2" fill="#1E3A8A"/>
                    <rect x="15" y="95" width="15" height="15" rx="2" fill="#1E3A8A"/>
                    <rect x="40" y="95" width="15" height="15" rx="2" fill="#1E3A8A"/>
                    <rect x="135" y="100" width="20" height="20" rx="2" fill="#1E3A8A"/>
                    <rect x="165" y="95" width="20" height="20" rx="2" fill="#1E3A8A"/>
                    <rect x="75" y="135" width="15" height="15" rx="2" fill="#1E3A8A"/>
                    <rect x="100" y="135" width="25" height="15" rx="2" fill="#1E3A8A"/>
                    <rect x="135" y="135" width="50" height="50" rx="4" fill="#1E3A8A"/>
                    <rect x="145" y="145" width="30" height="30" rx="2" fill="white"/>
                    <rect x="155" y="155" width="10" height="10" rx="1" fill="#1E3A8A"/>
                    <rect x="75" y="160" width="20" height="25" rx="2" fill="#1E3A8A"/>
                    <rect x="105" y="165" width="20" height="20" rx="2" fill="#1E3A8A"/>
                </svg>
            </div>
            <p style="font-size: 12px; color: #64748B; margin-bottom: 14px;">Buka aplikasi Mobile Banking atau E-Wallet pilihan Anda untuk melakukan pembayaran.</p>
            <button type="button" id="btnTutupQrisModal" style="background: #1B3B6F; color: #FFFFFF; border: none; padding: 9px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer; width: 100%;">Tutup</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payForm = document.getElementById('mainPaymentForm');
            const payTable = document.getElementById('payTable');
            const tbody = payTable ? payTable.querySelector('tbody') : null;
            const entryInfo = document.querySelector('.entry-info');
            const paginationEl = document.querySelector('.pagination');
            const paySearchInput = document.getElementById('paySearchInput');
            const payOrderSelect = document.getElementById('payOrder');
            const payDateInput = document.getElementById('payDate');
            const payAmountInput = document.getElementById('payAmount');

            // Order Summary Elements
            const summaryBox = document.getElementById('orderSummaryBox');
            const sumCustomer = document.getElementById('sumCustomer');
            const sumProduct = document.getElementById('sumProduct');
            const sumOrderDate = document.getElementById('sumOrderDate');
            const sumTotal = document.getElementById('sumTotal');
            const sumRemaining = document.getElementById('sumRemaining');

            const todayStr = new Date().toISOString().split('T')[0];
            let currentOrderDate = '';
            let currentOrderRemaining = 0;
            let currentOrderTotal = 0;

            function validatePayDate() {
                if (!payDateInput) return true;
                const chosenDate = payDateInput.value;

                if (currentOrderDate && chosenDate < currentOrderDate) {
                    alert('Tanggal pembayaran tidak boleh sebelum tanggal pemesanan (' + currentOrderDate + ')!');
                    payDateInput.value = currentOrderDate > todayStr ? todayStr : currentOrderDate;
                    return false;
                }

                if (chosenDate > todayStr) {
                    alert('Tanggal pembayaran tidak boleh di masa depan (maksimal hari ini: ' + todayStr + ')!');
                    payDateInput.value = todayStr;
                    return false;
                }

                return true;
            }

            if (payDateInput) {
                payDateInput.addEventListener('change', validatePayDate);
            }

            if (payOrderSelect) {
                payOrderSelect.addEventListener('change', function() {
                    const opt = this.options[this.selectedIndex];
                    if (!opt || !this.value) {
                        if (summaryBox) summaryBox.style.display = 'none';
                        if (payAmountInput) payAmountInput.value = '';
                        currentOrderRemaining = 0;
                        currentOrderTotal = 0;
                        currentOrderDate = '';
                        if (payDateInput) {
                            payDateInput.removeAttribute('min');
                            payDateInput.value = todayStr;
                        }
                        return;
                    }

                    const nama = opt.getAttribute('data-nama') || '-';
                    const produk = opt.getAttribute('data-produk') || '-';
                    const total = parseFloat(opt.getAttribute('data-harga')) || 0;
                    const remaining = parseFloat(opt.getAttribute('data-remaining')) || total;
                    const orderDate = opt.getAttribute('data-tanggal') || todayStr;
                    const orderDateFmt = opt.getAttribute('data-tanggal-fmt') || orderDate;

                    currentOrderRemaining = remaining;
                    currentOrderTotal = total;
                    currentOrderDate = orderDate;

                    // Update dynamic date limits (silent in background)
                    if (payDateInput) {
                        payDateInput.min = orderDate;
                        payDateInput.max = todayStr;
                        if (payDateInput.value < orderDate) {
                            payDateInput.value = orderDate;
                        }
                    }

                    if (summaryBox) {
                        summaryBox.style.display = 'block';
                        if (sumCustomer) sumCustomer.textContent = nama;
                        if (sumProduct) sumProduct.textContent = produk;
                        if (sumOrderDate) sumOrderDate.textContent = orderDateFmt;
                        if (sumTotal) sumTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
                        if (sumRemaining) sumRemaining.textContent = 'Rp ' + remaining.toLocaleString('id-ID');
                    }

                    if (payAmountInput) {
                        payAmountInput.value = remaining;
                    }
                });
            }

            window.copyAccNo = function(text, btn) {
                navigator.clipboard.writeText(text).then(() => {
                    const originalText = btn.textContent;
                    btn.textContent = 'Disalin!';
                    setTimeout(() => { btn.textContent = originalText; }, 1500);
                });
            };

            // Form Submit Interceptor
            if (payForm) {
                payForm.addEventListener('submit', function(e) {
                    if (!validatePayDate()) {
                        e.preventDefault();
                        return false;
                    }
                });
            }

            // Client Pagination & Search
            let currentPage = 1;
            const itemsPerPage = 10;

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

                const tableResponsive = document.querySelector('.table-responsive');
                if (tableResponsive) tableResponsive.scrollLeft = 0;

                if (entryInfo) {
                    const startShow = totalItems === 0 ? 0 : startIdx + 1;
                    const endShow = Math.min(endIdx, totalItems);
                    entryInfo.textContent = `Menampilkan ${startShow} hingga ${endShow} dari ${totalItems} data`;
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

            if (tbody) {
                updatePagination();
            }

            if (paySearchInput && payTable) {
                paySearchInput.addEventListener('keyup', function() {
                    const q = this.value.toLowerCase();
                    const rows = payTable.querySelectorAll('tbody tr');
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

            const payMethodSelect = document.getElementById('payMethod');
            const paymentDetailsContainer = document.getElementById('paymentDetailsContainer');
            const qrisBox = document.getElementById('qrisBox');
            const bankBox = document.getElementById('bankBox');

            function updatePaymentMethodView() {
                if (!payMethodSelect || !paymentDetailsContainer) return;
                const val = payMethodSelect.value;
                if (val === 'QRIS') {
                    paymentDetailsContainer.style.display = 'block';
                    if (qrisBox) qrisBox.style.display = 'block';
                    if (bankBox) bankBox.style.display = 'none';
                } else if (val === 'Transfer Bank') {
                    paymentDetailsContainer.style.display = 'block';
                    if (qrisBox) qrisBox.style.display = 'none';
                    if (bankBox) bankBox.style.display = 'block';
                } else {
                    paymentDetailsContainer.style.display = 'none';
                    if (qrisBox) qrisBox.style.display = 'none';
                    if (bankBox) bankBox.style.display = 'none';
                }
            }

            if (payMethodSelect) {
                payMethodSelect.addEventListener('change', updatePaymentMethodView);
                updatePaymentMethodView();
            }

            // QRIS Modal Engine
            const qrisOverlay = document.getElementById('qrisModalOverlay');
            const openQrisBtn = document.getElementById('openQrisModalBtn');
            const closeQrisBtn = document.getElementById('closeQrisModalBtn');
            const btnTutupQris = document.getElementById('btnTutupQrisModal');

            function openQris() {
                if (qrisOverlay) {
                    qrisOverlay.style.opacity = '1';
                    qrisOverlay.style.visibility = 'visible';
                }
            }

            function closeQris() {
                if (qrisOverlay) {
                    qrisOverlay.style.opacity = '0';
                    qrisOverlay.style.visibility = 'hidden';
                }
            }

            if (openQrisBtn) openQrisBtn.addEventListener('click', openQris);
            if (closeQrisBtn) closeQrisBtn.addEventListener('click', closeQris);
            if (btnTutupQris) btnTutupQris.addEventListener('click', closeQris);
            if (qrisOverlay) {
                qrisOverlay.addEventListener('click', function(e) {
                    if (e.target === qrisOverlay) closeQris();
                });
            }

            // Receipt Modal Engine
            const receiptOverlay = document.getElementById('receiptModalOverlay');
            const closeReceiptBtn = document.getElementById('closeReceiptModalBtn');
            const btnBatalReceipt = document.getElementById('btnBatalReceipt');

            window.openReceiptModal = function(data) {
                if (!receiptOverlay) return;
                document.getElementById('recNoBayar').textContent = data.kode_pembayaran || '-';
                document.getElementById('recKodePesanan').textContent = data.kode_pesanan || '-';
                document.getElementById('recTanggal').textContent = data.tanggal || '-';
                document.getElementById('recPelanggan').textContent = data.nama_pelanggan || '-';
                document.getElementById('recProduk').textContent = data.nama_produk || '-';
                document.getElementById('recTotalTagihan').textContent = 'Rp ' + (parseFloat(data.total_tagihan) || 0).toLocaleString('id-ID');
                document.getElementById('recMetode').textContent = data.metode || 'Tunai';
                document.getElementById('recJumlahBayar').textContent = 'Rp ' + (parseFloat(data.jumlah_bayar) || 0).toLocaleString('id-ID');

                const badge = document.getElementById('recStatusBadge');
                const isLunas = String(data.status).toLowerCase() === 'lunas' || String(data.status).toLowerCase() === 'sudah lunas';
                badge.textContent = isLunas ? 'SUDAH LUNAS' : data.status;
                badge.style.background = isLunas ? '#DCFCE7' : '#DBEAFE';
                badge.style.color = isLunas ? '#16A34A' : '#1E3A8A';

                receiptOverlay.style.opacity = '1';
                receiptOverlay.style.visibility = 'visible';
                receiptOverlay.querySelector('.modal-box').style.transform = 'translateY(0)';
            };

            function closeReceipt() {
                if (!receiptOverlay) return;
                receiptOverlay.style.opacity = '0';
                receiptOverlay.style.visibility = 'hidden';
                receiptOverlay.querySelector('.modal-box').style.transform = 'translateY(-10px)';
            }

            if (closeReceiptBtn) closeReceiptBtn.addEventListener('click', closeReceipt);
            if (btnBatalReceipt) btnBatalReceipt.addEventListener('click', closeReceipt);
            if (receiptOverlay) {
                receiptOverlay.addEventListener('click', function(e) {
                    if (e.target === receiptOverlay) closeReceipt();
                });
            }
        });
    </script>

    @include('layouts.navbar_assets')
</body>
</html>