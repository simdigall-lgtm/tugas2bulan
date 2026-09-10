<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - SIPEKAN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
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
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #F8FAFC;
            color: #1E293B;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #fff;
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
        }

        .brand-tag {
            font-size: 12px;
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
            transition: all .2s;
        }

        .menu-item:hover {
            background: #F1F5F9;
            color: #1E3A8A;
        }

        .menu-item.active {
            background: #EEF2FF;
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
        }

        .topbar {
            height: 68px;
            background: #fff;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .search-wrap {
            position: relative;
            width: 300px;
        }

        .search-wrap i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 13px;
        }

        .search-wrap input {
            width: 100%;
            background: #F1F5F9;
            border: 1px solid transparent;
            border-radius: 8px;
            padding: 9px 14px 9px 36px;
            font-size: 13.5px;
            outline: none;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 18px;
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

        .content-body {
            padding: 24px 28px;
            flex: 1;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -.5px;
        }

        .page-subtitle {
            font-size: 13.5px;
            color: #64748B;
            margin-top: 3px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-filter {
            position: relative;
            width: 240px;
        }

        .search-filter i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 13px;
        }

        .search-filter input {
            width: 100%;
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 8px 12px 8px 34px;
            font-size: 13px;
            outline: none;
        }

        .btn-primary {
            background: #1B3B6F;
            color: #fff;
            border: none;
            padding: 9px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead th {
            padding: 10px 12px;
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: .4px;
            border-bottom: 1px solid #E2E8F0;
            background: #fff;
            white-space: nowrap;
        }

        tbody td {
            padding: 10px 12px;
            font-size: 12.5px;
            color: #334155;
            font-weight: 500;
            border-bottom: 1px solid #F1F5F9;
            vertical-align: middle;
            white-space: nowrap;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover td {
            background: #F8FAFC;
        }

        .order-code {
            color: #1E3A8A;
            font-weight: 700;
            white-space: nowrap;
        }

        .customer-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar-init {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .product-sub {
            font-size: 11.5px;
            color: #64748B;
            margin-top: 2px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-menunggu {
            background: #DBEAFE;
            color: #1E3A8A;
        }

        .badge-diproses {
            background: #DBEAFE;
            color: #2563EB;
        }

        .badge-selesai {
            background: #DCFCE7;
            color: #16A34A;
        }

        .action-dropdown {
            position: relative;
            display: inline-block;
            text-align: left;
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
            display: inline-flex;
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
            background: none;
            border: none;
            width: 100%;
            cursor: pointer;
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

        .table-footer {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #E2E8F0;
        }

        .entry-info {
            font-size: 12.5px;
            color: #64748B;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .page-btn {
            min-width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid #E2E8F0;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-btn.active {
            background: #1B3B6F;
            border-color: #1B3B6F;
            color: #fff;
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .header-right {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
            }

            .search-filter,
            .search-filter input {
                width: 100%;
            }

            .btn-primary {
                width: 100%;
                justify-content: center;
            }

            .table-footer {
                flex-direction: column;
                gap: 16px;
            }
        }

        /* Modal Styling */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.5);
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
            background: #FFFFFF;
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

        .form-group input,
        .form-group select {
            width: 100%;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13.5px;
            color: #0F172A;
            outline: none;
            background: #fff;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-cancel {
            background: #F1F5F9;
            color: #475569;
            border: none;
            padding: 9px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13.5px;
            cursor: pointer;
        }

        .btn-save {
            background: #1B3B6F;
            color: #FFFFFF;
            border: none;
            padding: 9px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13.5px;
            cursor: pointer;
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
                    <button class="btn-primary" id="openOrderModal"><i class="fa-solid fa-plus"></i> Buat Pesanan
                        Baru</button>
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
                                <th>JUMLAH</th>
                                <th>UKURAN</th>
                                <th>TOTAL HARGA</th>
                                <th>STATUS</th>
                                <th style="text-align:right;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanans ?? [] as $pesanan)
                                @php
                                    $rawJU = $pesanan->jumlah_ukuran ?? '-';
                                    preg_match('/^(.*?)(?:\s*\((.*?)\))?$/', $rawJU, $m);
                                    $jVal = !empty($m[1]) ? trim($m[1]) : $rawJU;
                                    $uVal = !empty($m[2]) ? trim($m[2]) : '';
                                    if (is_numeric($jVal)) {
                                        $jVal .= ' Pcs';
                                    }
                                @endphp
                                <tr>
                                    <td class="order-code">{{ $pesanan->kode_pesanan }}</td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="avatar-init" style="background:#DBEAFE;color:#1D4ED8;">
                                                {{ strtoupper(substr($pesanan->nama_pelanggan, 0, 2)) }}
                                            </div>
                                            <span>{{ $pesanan->nama_pelanggan }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $pesanan->nama_produk }}</td>
                                    <td style="font-weight: 700; color: #0F172A;">{{ $jVal }}</td>
                                    <td>
                                        <span class="size-badge"
                                            style="display:inline-flex; align-items:center; gap:4px; font-size:11.5px; font-weight:700; color:#475569; background:#F1F5F9; border:1px solid #CBD5E1; padding:3px 8px; border-radius:6px;">
                                            <i class="fa-solid fa-ruler-combined"
                                                style="font-size:10px; color:#64748B;"></i> {{ $uVal ?: 'Standard' }}
                                        </span>
                                    </td>
                                    <td style="white-space: nowrap; font-weight: 600; color: #0F172A;">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span
                                            class="badge {{ strtolower($pesanan->status) == 'selesai' ? 'badge-selesai' : (strtolower($pesanan->status) == 'diproses' ? 'badge-diproses' : 'badge-menunggu') }}">
                                            {{ $pesanan->status }}
                                        </span>
                                    </td>
                                    <td style="text-align:right;">
                                        <div class="action-dropdown">
                                            <button type="button" class="action-icon-btn action-toggle" title="Aksi"><i
                                                    class="fa-solid fa-ellipsis-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                @if(strtolower($pesanan->status ?? '') !== 'selesai')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="editPesanan({{ json_encode($pesanan) }})"><i
                                                            class="fa-regular fa-pen-to-square"></i> Edit</button>
                                                @endif
                                                <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST"
                                                    style="display:inline;"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan {{ $pesanan->kode_pesanan }}?');">
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
                                    <td colspan="8" style="text-align:center; padding:20px; color:#64748B;">Belum ada
                                        pesanan di database.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <div class="entry-info">Menampilkan {{ count($pesanans ?? []) }} pesanan</div>
                    <div class="pagination">
                        <button class="page-btn"><i class="fa-solid fa-chevron-left"
                                style="font-size:11px;"></i></button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn"><i class="fa-solid fa-chevron-right"
                                style="font-size:11px;"></i></button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Form Buat & Edit Pesanan -->
    <div class="modal-overlay" id="orderModalOverlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3 class="modal-title" id="orderModalTitle">Buat Pesanan Baru</h3>
                <button class="close-modal-btn" id="closeOrderModalBtn">&times;</button>
            </div>
            <form id="addOrderForm" action="{{ route('pesanan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="orderFormMethod" value="POST">
                <div class="form-group">
                    <label for="ordCustomer">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" id="ordCustomer" list="pelangganList" required
                        placeholder="Pilih atau ketik nama pelanggan..." autocomplete="off">
                    <datalist id="pelangganList">
                        @foreach($pelanggans ?? [] as $pel)
                            <option value="{{ $pel->nama }}">{{ $pel->kode_pelanggan }} - {{ $pel->nama }}</option>
                        @endforeach
                    </datalist>
                </div>
                <div class="form-group">
                    <label for="ordProduct">Nama Produk</label>
                    <select name="nama_produk" id="ordProduct" required
                        style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 10px 14px; font-size: 13.5px; color: #0F172A; outline: none; background: #fff; cursor: pointer;">
                        <option value="" disabled selected>-- Pilih Produk --</option>
                        @foreach($produks ?? [] as $prod)
                            @php $isOut = ($prod->stok ?? 0) <= 0; @endphp
                            <option value="{{ $prod->nama_produk }}" {{ $isOut ? 'disabled style=color:#94A3B8;background:#F1F5F9;' : '' }}>
                                {{ $prod->nama_produk }} — Rp {{ number_format($prod->harga, 0, ',', '.') }} (Stok: {{ $isOut ? 'Habis' : $prod->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Split Jumlah & Ukuran Fields -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 16px;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="ordJumlah">Jumlah Pesanan (Qty)</label>
                        <div style="display: flex; gap: 6px;">
                            <input type="number" name="jumlah_val" id="ordJumlah" min="1" value="1" required placeholder="1"
                                style="flex: 1;">
                            <select name="jumlah_unit" id="ordJumlahUnit"
                                style="width: 90px; border: 1px solid #CBD5E1; border-radius: 8px; padding: 9px 8px; font-size: 13.5px; font-weight: 600; color: #1E293B; outline: none; background: #F8FAFC; cursor: pointer;">
                                <option value="Pcs">Pcs</option>
                                <option value="Box">Box</option>
                                <option value="Rim">Rim</option>
                                <option value="Lembar">Lembar</option>
                                <option value="Meter">Meter</option>
                                <option value="Set">Set</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="ordUkuran">Ukuran Produk (Size)</label>
                        <input type="text" name="ukuran_val" id="ordUkuran" placeholder="Contoh: A4, A3+, 3x1 m"
                            list="ukuranList" autocomplete="off">
                        <datalist id="ukuranList">
                            <option value="A4 (21 x 29.7 cm)">
                            <option value="A5 (14.8 x 21 cm)">
                            <option value="A3+ (32 x 48 cm)">
                            <option value="Kartu Nama (9 x 5.5 cm)">
                            <option value="3 x 1 Meter">
                            <option value="2 x 1 Meter">
                            <option value="Standard">
                        </datalist>
                    </div>
                </div>
                <input type="hidden" name="jumlah_ukuran" id="ordJumlahUkuran">
                <div class="form-group">
                    <label for="ordPrice">Total Harga (IDR)</label>
                    <input type="number" name="total_harga" id="ordPrice" min="0" step="any" required
                        placeholder="Contoh: 500000">
                    <div id="priceCalculationHint" style="font-size: 12px; color: #2563EB; font-weight: 600; margin-top: 5px; display: none;"></div>
                </div>
                <div class="form-group">
                    <label for="ordStatus">Status Pesanan</label>
                    <select name="status" id="ordStatus" required>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Diproses" selected>Diproses</option>
                    </select>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" id="cancelOrderModalBtn">Batal</button>
                    <button type="submit" class="btn-save" id="saveOrderBtn">Simpan Pesanan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalOverlay = document.getElementById('orderModalOverlay');
            const openBtn = document.getElementById('openOrderModal');
            const closeBtn = document.getElementById('closeOrderModalBtn');
            const cancelBtn = document.getElementById('cancelOrderModalBtn');
            const form = document.getElementById('addOrderForm');
            const modalTitle = document.getElementById('orderModalTitle');
            const saveBtn = document.getElementById('saveOrderBtn');
            const methodInput = document.getElementById('orderFormMethod');
            const tbody = document.querySelector('tbody');
            const entryInfo = document.querySelector('.entry-info');
            const paginationEl = document.querySelector('.pagination');
            const searchInput = document.querySelector('.search-filter input');

            let currentPage = 1;
            const itemsPerPage = 10;

            function parseJumlahUkuran(str) {
                if (!str || str === '-') return { qty: '1', unit: 'Pcs', size: '' };
                str = String(str).trim();
                let size = '';
                const parenMatch = str.match(/\((.*?)\)/);
                if (parenMatch) {
                    size = parenMatch[1].trim();
                    str = str.replace(/\(.*?\)/, '').trim();
                }

                let qty = '1';
                let unit = 'Pcs';
                const parts = str.split(/\s+/);
                if (parts.length >= 1 && !isNaN(parts[0]) && parts[0] !== '') {
                    qty = parts[0];
                    if (parts.length >= 2) {
                        unit = parts.slice(1).join(' ');
                    }
                } else if (!isNaN(str) && str !== '') {
                    qty = str;
                } else if (str) {
                    size = str;
                }

                const stdUnits = ['Pcs', 'Box', 'Rim', 'Lembar', 'Meter', 'Set', 'PCS', 'pcs'];
                const matched = stdUnits.find(u => u.toLowerCase() === unit.toLowerCase());
                if (matched) {
                    unit = matched.toLowerCase() === 'pcs' ? 'Pcs' : matched;
                } else if (!unit) {
                    unit = 'Pcs';
                }

                return { qty, unit, size };
            }

            window.editPesanan = function (p) {
                if (!form || !modalOverlay) return;
                form.action = `/pesanan/${p.id}`;
                if (methodInput) methodInput.value = 'PUT';
                if (modalTitle) modalTitle.textContent = `Edit Pesanan: ${p.kode_pesanan}`;
                if (saveBtn) saveBtn.textContent = 'Update Pesanan';

                document.getElementById('ordCustomer').value = p.nama_pelanggan || '';
                document.getElementById('ordProduct').value = p.nama_produk || '';
                if (typeof validateStockAndCalculatePrice === 'function') {
                    validateStockAndCalculatePrice();
                }

                const parsed = parseJumlahUkuran(p.jumlah_ukuran);
                if (document.getElementById('ordJumlah')) document.getElementById('ordJumlah').value = parsed.qty;
                if (document.getElementById('ordJumlahUnit')) document.getElementById('ordJumlahUnit').value = parsed.unit;
                if (document.getElementById('ordUkuran')) document.getElementById('ordUkuran').value = parsed.size;
                if (document.getElementById('ordJumlahUkuran')) document.getElementById('ordJumlahUkuran').value = p.jumlah_ukuran || '';

                document.getElementById('ordPrice').value = p.total_harga || 0;
                document.getElementById('ordStatus').value = p.status || 'Diproses';

                modalOverlay.classList.add('active');
            };

            if (form) {
                form.addEventListener('submit', function () {
                    const qInput = document.getElementById('ordJumlah');
                    const uSelect = document.getElementById('ordJumlahUnit');
                    const szInput = document.getElementById('ordUkuran');
                    const juHidden = document.getElementById('ordJumlahUkuran');

                    const qVal = qInput ? qInput.value.trim() : '100';
                    const uVal = uSelect ? uSelect.value : 'Pcs';
                    const szVal = szInput ? szInput.value.trim() : '';

                    if (juHidden) {
                        juHidden.value = `${qVal} ${uVal}${szVal ? ' (' + szVal + ')' : ''}`;
                    }
                });
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
                    entryInfo.textContent = `Menampilkan ${startShow} hingga ${endShow} dari ${totalItems} pesanan`;
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

            if (openBtn) {
                openBtn.addEventListener('click', () => {
                    form.reset();
                    if (document.getElementById('ordProduct')) document.getElementById('ordProduct').value = '';
                    if (document.getElementById('ordJumlah')) document.getElementById('ordJumlah').value = '1';
                    if (document.getElementById('ordJumlahUnit')) document.getElementById('ordJumlahUnit').value = 'Pcs';
                    if (document.getElementById('ordUkuran')) document.getElementById('ordUkuran').value = '';
                    const sHint = document.getElementById('stockHint');
                    if (sHint) sHint.style.display = 'none';
                    form.action = "{{ route('pesanan.store') }}";
                    if (methodInput) methodInput.value = 'POST';
                    if (modalTitle) modalTitle.textContent = 'Buat Pesanan Baru';
                    if (saveBtn) saveBtn.textContent = 'Simpan Pesanan';
                    modalOverlay.classList.add('active');
                });
            }
            if (closeBtn) closeBtn.addEventListener('click', () => modalOverlay.classList.remove('active'));
            if (cancelBtn) cancelBtn.addEventListener('click', () => modalOverlay.classList.remove('active'));

            // Auto open & prefill modal if URL contains ?pelanggan=...
            const urlParams = new URLSearchParams(window.location.search);
            const prefillCustomer = urlParams.get('pelanggan');
            if (prefillCustomer && openBtn) {
                openBtn.click();
                const ordCustomer = document.getElementById('ordCustomer');
                if (ordCustomer) ordCustomer.value = prefillCustomer;
            }

            // Auto-calculate total harga and validate stock based on selected product and quantity
            const productPrices = {
                @foreach($produks ?? [] as $prod)
                    "{!! addslashes($prod->nama_produk) !!}": {{ $prod->harga ?? 0 }},
                @endforeach
            };

            const productStocks = {
                @foreach($produks ?? [] as $prod)
                    "{!! addslashes($prod->nama_produk) !!}": {{ $prod->stok ?? 0 }},
                @endforeach
            };

            const productUnits = {
                @foreach($produks ?? [] as $prod)
                    @php
                        $pName = strtolower($prod->nama_produk ?? '');
                        $unit = 'Pcs';
                        if (str_contains($pName, 'kartu nama')) $unit = 'Box';
                        elseif (str_contains($pName, 'brosur')) $unit = 'Rim';
                        elseif (str_contains($pName, 'spanduk') || str_contains($pName, 'banner')) $unit = 'Meter';
                        elseif (str_contains($pName, 'stiker')) $unit = 'Lembar';
                        elseif (str_contains($pName, 'kalender')) $unit = 'Set';
                    @endphp
                    "{!! addslashes($prod->nama_produk) !!}": "{{ $unit }}",
                @endforeach
            };

            const ordProductInput = document.getElementById('ordProduct');
            const ordJumlahInput = document.getElementById('ordJumlah');
            const ordJumlahUnitSelect = document.getElementById('ordJumlahUnit');
            const ordPriceInput = document.getElementById('ordPrice');
            const stockHint = document.getElementById('stockHint');

            function validateStockAndCalculatePrice(isProductChange = false) {
                if (!ordProductInput) return;
                const prodName = ordProductInput.value.trim();
                let basePrice = null;
                let availStock = null;
                let unitName = 'Pcs';

                for (const [name, price] of Object.entries(productPrices)) {
                    if (name.toLowerCase() === prodName.toLowerCase()) {
                        basePrice = price;
                        availStock = productStocks[name] ?? 0;
                        unitName = productUnits[name] ?? 'Pcs';
                        break;
                    }
                }

                if (isProductChange && ordJumlahUnitSelect && unitName) {
                    ordJumlahUnitSelect.value = unitName;
                } else if (ordJumlahUnitSelect && ordJumlahUnitSelect.value) {
                    unitName = ordJumlahUnitSelect.value;
                }

                if (availStock !== null) {
                    if (ordJumlahInput) {
                        ordJumlahInput.max = availStock;
                        let qty = parseInt(ordJumlahInput.value) || 1;
                        if (availStock > 0 && qty > availStock) {
                            ordJumlahInput.value = availStock;
                            qty = availStock;
                        }
                    }
                } else {
                    if (ordJumlahInput) ordJumlahInput.removeAttribute('max');
                }

                if (basePrice !== null && basePrice > 0 && ordPriceInput) {
                    const qty = parseInt(ordJumlahInput ? ordJumlahInput.value : 1) || 1;
                    const total = basePrice * Math.max(1, qty);
                    ordPriceInput.value = total;
                }
            }

            if (ordProductInput) {
                ordProductInput.addEventListener('input', () => validateStockAndCalculatePrice(true));
                ordProductInput.addEventListener('change', () => validateStockAndCalculatePrice(true));
            }
            if (ordJumlahInput) {
                ordJumlahInput.addEventListener('input', () => validateStockAndCalculatePrice(false));
                ordJumlahInput.addEventListener('change', () => validateStockAndCalculatePrice(false));
            }
            if (ordJumlahUnitSelect) {
                ordJumlahUnitSelect.addEventListener('change', () => validateStockAndCalculatePrice(false));
            }

        if (tbody) {
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

        // Dropdown toggle handler
        document.addEventListener('click', function (e) {
            const toggle = e.target.closest('.action-toggle');
            if (toggle) {
                e.stopPropagation();
                const menu = toggle.nextElementSibling;
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m !== menu) m.classList.remove('show');
                });
                if (menu) menu.classList.toggle('show');
            } else {
                document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
            }
        });
        });
    </script>
    @include('layouts.navbar_assets')
</body>

</html>