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

        html,
        body {
            max-width: 100vw;
            overflow-x: clip;
        }

        body {
            background: #F8FAFC;
            color: #1E293B;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 210px;
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
            padding: 18px 16px 14px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 800;
            color: #1E3A8A;
        }

        .brand-tag {
            font-size: 11px;
            color: #64748B;
            margin-top: 1px;
        }

        .sidebar-menu {
            padding: 10px 10px;
            display: flex;
            flex-direction: column;
            gap: 3px;
            flex: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            color: #475569;
            text-decoration: none;
            font-size: 13.5px;
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
            font-size: 15px;
            width: 18px;
            text-align: center;
        }

        .sidebar-bottom {
            padding: 12px 10px 16px;
            border-top: 1px dashed #E2E8F0;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .main-wrapper {
            margin-left: 210px;
            width: calc(100% - 210px);
            max-width: calc(100vw - 210px);
            min-width: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 100;
            max-width: 100%;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
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
            padding: 20px 22px;
            flex: 1;
            min-width: 0;
            max-width: 100%;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .page-title {
            font-size: 23px;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -.5px;
        }

        .page-subtitle {
            font-size: 13px;
            color: #64748B;
            margin-top: 3px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .search-filter {
            position: relative;
            width: 200px;
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
            white-space: nowrap;
            flex-shrink: 0;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
            min-width: 0;
            max-width: 100%;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead th {
            padding: 10px 11px;
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: .4px;
            border-bottom: 1px solid #E2E8F0;
            background: #FAFCFF;
            white-space: nowrap;
        }

        tbody td {
            padding: 10px 11px;
            font-size: 12.5px;
            color: #334155;
            font-weight: 500;
            border-bottom: 1px solid #F1F5F9;
            vertical-align: middle;
        }

        .product-cell {
            white-space: normal !important;
        }

        .product-sub {
            white-space: normal !important;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover td {
            background: #F8FAFC;
        }

        .td-nowrap {
            white-space: nowrap;
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
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Production Status Badges (Minimal, Enterprise, Cohesive) */
        .badge-prod {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 600;
            white-space: nowrap;
            line-height: 1.3;
        }

        .badge-prod::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .badge-antrean-cetak {
            background: #F1F5F9;
            color: #334155;
            border: 1px solid #E2E8F0;
        }
        .badge-antrean-cetak::before {
            background: #64748B;
        }

        .badge-sedang-dicetak {
            background: #FFFBEB;
            color: #92400E;
            border: 1px solid #FDE68A;
        }
        .badge-sedang-dicetak::before {
            background: #F59E0B;
        }

        .badge-finishing {
            background: #FAF5FF;
            color: #6B21A8;
            border: 1px solid #E9D5FF;
        }
        .badge-finishing::before {
            background: #A855F7;
        }

        .badge-siap-diambil {
            background: #F0FDFA;
            color: #0F766E;
            border: 1px solid #99F6E4;
        }
        .badge-siap-diambil::before {
            background: #14B8A6;
        }

        .badge-selesai {
            background: #F0FDF4;
            color: #166534;
            border: 1px solid #BBF7D0;
        }
        .badge-selesai::before {
            background: #22C55E;
        }

        .badge-diproses {
            background: #EFF6FF;
            color: #1D4ED8;
            border: 1px solid #BFDBFE;
        }
        .badge-diproses::before {
            background: #3B82F6;
        }

        .badge-menunggu {
            background: #F8FAFC;
            color: #64748B;
            border: 1px solid #E2E8F0;
        }
        .badge-menunggu::before {
            background: #94A3B8;
        }

        /* Subtle Payment Status Sub-Tags (Clean & Non-distracting) */
        .pay-sub-tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 4px;
            line-height: 1.25;
        }

        .pay-sub-tag i {
            font-size: 10px;
        }

        .pay-sub-tag.pay-sub-lunas {
            background: #F0FDF4;
            color: #166534;
            border: 1px solid #DCFCE7;
        }

        .pay-sub-tag.pay-sub-dp {
            background: #FFFBEB;
            color: #B45309;
            border: 1px solid #FEF3C7;
        }

        .pay-sub-tag.pay-sub-unpaid {
            background: #FFF1F2;
            color: #BE123C;
            border: 1px solid #FFE4E6;
        }

        .pay-sub-tag .sisa-note {
            font-size: 10px;
            font-weight: 500;
            opacity: 0.9;
        }

        .modal-box {
            background: #FFFFFF;
            border-radius: 14px;
            width: 100%;
            max-width: 540px;
            padding: 24px 28px;
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.18);
            transform: translateY(-10px);
            transition: transform 0.2s ease;
            max-height: 92vh;
            overflow-y: auto;
        }

        .modal-box.modal-lg {
            max-width: 780px;
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
            gap: 8px;
        }

        .page-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid #E2E8F0;
            background: #fff;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
        }

        .page-btn:hover:not(:disabled) {
            border-color: #CBD5E1;
            background: #F8FAFC;
            color: #1E293B;
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .page-select-container {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #64748B;
            font-weight: 600;
            user-select: none;
        }

        .page-select-dropdown {
            appearance: none;
            -webkit-appearance: none;
            background: #FFFFFF url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23475569'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E") no-repeat right 8px center;
            background-size: 12px;
            border: 1px solid #CBD5E1;
            border-radius: 6px;
            padding: 5px 26px 5px 10px;
            font-size: 13px;
            font-weight: 700;
            color: #1B3B6F;
            cursor: pointer;
            outline: none;
            transition: all 0.15s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .page-select-dropdown:hover {
            border-color: #94A3B8;
            background-color: #F8FAFC;
        }

        .page-select-dropdown:focus {
            border-color: #1B3B6F;
            box-shadow: 0 0 0 2px rgba(27, 59, 111, 0.15);
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

        /* Unified Pesanan Table Toolbar */
        .pesanan-table-toolbar {
            padding: 12px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border-bottom: 1px solid #E2E8F0;
            background: #FAFCFF;
            flex-wrap: wrap;
        }

        .toolbar-search-wrap {
            position: relative;
            flex: 1;
            min-width: 240px;
            max-width: 420px;
        }

        .toolbar-search-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 13px;
            pointer-events: none;
        }

        .toolbar-search-input {
            width: 100%;
            height: 36px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 0 12px 0 34px;
            font-size: 13px;
            color: #0F172A;
            background: #FFFFFF;
            outline: none;
            transition: all 0.15s ease;
        }

        .toolbar-search-input:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .toolbar-filters-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .toolbar-select {
            height: 36px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 0 10px;
            font-size: 12.5px;
            font-weight: 600;
            color: #334155;
            background: #FFFFFF;
            cursor: pointer;
            outline: none;
            transition: all 0.15s ease;
        }

        .toolbar-select:focus {
            border-color: #2563EB;
        }



        /* Compact Design File Icon */
        .design-file-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            border-radius: 5px;
            background: #EFF6FF;
            color: #2563EB;
            border: 1px solid #BFDBFE;
            font-size: 11px;
            text-decoration: none;
            transition: all 0.15s ease;
            vertical-align: middle;
            margin-left: 6px;
        }

        .design-file-icon:hover {
            background: #2563EB;
            color: #FFFFFF;
            border-color: #2563EB;
        }

        .design-file-icon.multi {
            width: auto;
            height: 22px;
            padding: 0 7px;
            gap: 4px;
            font-weight: 700;
            font-size: 10.5px;
            cursor: pointer;
            background: #EEF2FF;
            color: #1E3A8A;
            border: 1px solid #C7D2FE;
        }

        .design-file-icon.multi:hover {
            background: #1E3A8A;
            color: #FFFFFF;
            border-color: #1E3A8A;
        }

        /* Design Gallery Grid & Cards */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 14px;
            margin-top: 14px;
            max-height: 60vh;
            overflow-y: auto;
            padding: 4px;
        }

        .gallery-grid.is-single {
            display: flex;
            justify-content: center;
        }

        .gallery-grid.is-single .gallery-card {
            max-width: 440px;
            width: 100%;
        }

        .gallery-grid.is-single .gallery-thumb-wrap {
            height: 250px;
        }

        .gallery-card {
            background: #FFFFFF;
            border: 1.5px solid #E2E8F0;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.2s ease;
        }

        .gallery-card:hover {
            border-color: #3B82F6;
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.15);
        }

        .gallery-thumb-wrap {
            height: 140px;
            background: #F8FAFC;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            border-bottom: 1px solid #E2E8F0;
        }

        .gallery-thumb-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.2s ease;
        }

        .gallery-card:hover .gallery-thumb-img {
            transform: scale(1.05);
        }

        .gallery-card-body {
            padding: 10px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }

        .gallery-card-title {
            font-size: 12.5px;
            font-weight: 700;
            color: #0F172A;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .gallery-card-meta {
            font-size: 11px;
            color: #64748B;
        }

        .gallery-card-btn {
            margin-top: 8px;
            padding: 6px 10px;
            background: #EFF6FF;
            color: #1D4ED8;
            border: 1px solid #BFDBFE;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.15s ease;
        }

        .gallery-card-btn:hover {
            background: #1D4ED8;
            color: #FFFFFF;
            border-color: #1D4ED8;
        }

        /* Cart Item Design Badges */
        .cart-item-design-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            padding: 2px 7px;
            border-radius: 4px;
            font-weight: 600;
            text-decoration: none;
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .cart-item-design-badge.has-file {
            background: #EFF6FF;
            color: #1D4ED8;
            border: 1px solid #BFDBFE;
        }
        .cart-item-design-badge.is-link {
            background: #ECFEFF;
            color: #0E7490;
            border: 1px solid #CFFAFE;
        }
        .cart-item-design-badge.is-empty {
            color: #94A3B8;
            font-style: italic;
            font-weight: 400;
        }

        /* Multi Item Badge Button & Floating Popover */
        .badge-multi-item-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #EEF2FF;
            color: #1E3A8A;
            padding: 2px 8px;
            border-radius: 5px;
            font-weight: 700;
            font-size: 11px;
            border: 1px solid #C7D2FE;
            cursor: pointer;
            transition: all 0.15s ease;
            line-height: 1.3;
            text-align: left;
            user-select: none;
        }

        .badge-multi-item-btn:hover {
            background: #E0E7FF;
            border-color: #818CF8;
            color: #1E40AF;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(30, 58, 138, 0.12);
        }

        .badge-multi-item-btn.active {
            background: #1E3A8A;
            color: #FFFFFF;
            border-color: #1E3A8A;
            box-shadow: 0 2px 6px rgba(30, 58, 138, 0.25);
        }

        .badge-multi-item-btn .chevron-icon {
            font-size: 8.5px;
            transition: transform 0.2s ease;
            opacity: 0.75;
        }

        .badge-multi-item-btn.active .chevron-icon {
            transform: rotate(180deg);
            color: #FFFFFF;
        }

        /* Floating Popover */
        .multi-item-popover {
            position: fixed;
            z-index: 1060;
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            border-radius: 12px;
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.18), 0 2px 8px rgba(0, 0, 0, 0.06);
            width: 340px;
            max-width: calc(100vw - 28px);
            display: none;
            flex-direction: column;
            overflow: hidden;
            animation: popoverFadeIn 0.15s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes popoverFadeIn {
            from {
                opacity: 0;
                transform: translateY(-6px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .popover-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            background: #F8FAFC;
            border-bottom: 1px solid #E2E8F0;
        }

        .popover-title-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            color: #0F172A;
        }

        .popover-count-badge {
            background: #EFF6FF;
            color: #2563EB;
            font-size: 10.5px;
            font-weight: 700;
            padding: 1.5px 6px;
            border-radius: 4px;
            border: 1px solid #BFDBFE;
        }

        .popover-close-btn {
            background: none;
            border: none;
            color: #94A3B8;
            font-size: 18px;
            cursor: pointer;
            padding: 0 4px;
            line-height: 1;
            transition: color 0.15s ease;
        }

        .popover-close-btn:hover {
            color: #0F172A;
        }

        .popover-body {
            padding: 10px 14px;
            max-height: 240px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 8px;
            background: #FFFFFF;
        }

        .popover-item-card {
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding: 7px 10px;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 7px;
            transition: all 0.15s ease;
        }

        .popover-item-card:hover {
            border-color: #93C5FD;
            background: #F0F7FF;
        }

        .popover-item-card.is-main {
            border-left: 3px solid #2563EB;
            background: #F8FAFF;
        }

        .popover-item-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
        }

        .popover-item-name {
            font-weight: 700;
            font-size: 12px;
            color: #0F172A;
            line-height: 1.3;
        }

        .popover-item-badge {
            font-size: 9.5px;
            font-weight: 700;
            padding: 1px 5px;
            border-radius: 3px;
            white-space: nowrap;
        }

        .popover-item-badge.main {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .popover-item-badge.extra {
            background: #F1F5F9;
            color: #475569;
        }

        .popover-item-meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            font-size: 11px;
            color: #64748B;
            margin-top: 1px;
        }

        .popover-item-subtotal {
            font-weight: 700;
            color: #1E3A8A;
        }

        .popover-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 9px 14px;
            background: #F8FAFC;
            border-top: 1px solid #E2E8F0;
            gap: 10px;
        }

        .popover-total-info {
            font-size: 11.5px;
            color: #475569;
            font-weight: 600;
        }

        .popover-total-info strong {
            color: #0F172A;
            font-weight: 800;
        }

        .popover-spk-btn {
            background: #1E3A8A;
            color: #FFFFFF;
            border: none;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.15s ease;
        }

        .popover-spk-btn:hover {
            background: #1E40AF;
        }

        /* ========================================================
           MODAL SYSTEM - REFINED & PROFESSIONAL ENTERPRISE DESIGN
           ======================================================== */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.65);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            backdrop-filter: blur(4px);
            padding: 16px;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-box {
            background: #FFFFFF;
            border-radius: 14px;
            width: 100%;
            max-width: 520px;
            padding: 24px 28px;
            box-shadow: 0 24px 48px rgba(15, 23, 42, 0.2), 0 0 0 1px rgba(226, 232, 240, 0.8);
            transform: translateY(-8px) scale(0.99);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            max-height: 92vh;
            overflow-y: auto;
        }

        .modal-box.modal-lg {
            max-width: 860px !important;
        }

        /* Structured Pinned-Header & Pinned-Footer Layout for Order Modal */
        .modal-box.structured-modal {
            padding: 0 !important;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            max-height: 92vh;
            border-radius: 16px;
        }

        .modal-overlay.active .modal-box {
            transform: translateY(0) scale(1);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 22px;
            background: #FAFCFF;
            border-bottom: 1px solid #E2E8F0;
            flex-shrink: 0;
        }

        .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-icon-badge {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #EEF2FF;
            color: #1E3A8A;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
            border: 1px solid #E0E7FF;
        }

        .modal-title {
            font-size: 16.5px;
            font-weight: 800;
            color: #0F172A;
            margin: 0;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-subtitle {
            font-size: 12px;
            color: #64748B;
            margin: 2px 0 0 0;
            font-weight: 500;
        }

        .close-modal-btn {
            background: #F1F5F9;
            border: none;
            color: #64748B;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
            line-height: 1;
        }

        .close-modal-btn:hover {
            background: #E2E8F0;
            color: #0F172A;
        }

        .modal-body-scroll {
            padding: 18px 22px;
            overflow-y: auto;
            max-height: calc(92vh - 130px);
            display: flex;
            flex-direction: column;
            gap: 14px;
            background: #F8FAFC;
        }

        /* Order Section Cards */
        .order-section-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 14px 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            transition: border-color 0.15s ease;
        }

        .order-section-card:hover {
            border-color: #CBD5E1;
        }

        .section-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #F1F5F9;
        }

        .section-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step-badge {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #1E3A8A;
            color: #FFFFFF;
            font-size: 11.5px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 4px rgba(30, 58, 138, 0.2);
        }

        .section-card-title {
            font-size: 13px;
            font-weight: 700;
            color: #0F172A;
            margin: 0;
            letter-spacing: -0.2px;
        }

        .section-card-desc {
            font-size: 11px;
            color: #64748B;
            margin: 2px 0 0 0;
        }

        .cart-badge-pill {
            background: #EEF2FF;
            color: #1E3A8A;
            border: 1px solid #C7D2FE;
            padding: 2px 9px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
        }

        .form-row-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 5px;
        }

        .form-group input:not([type="checkbox"]):not([type="radio"]),
        .form-group select,
        .form-group textarea {
            width: 100%;
            height: 38px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 0 11px;
            font-size: 12.5px;
            color: #0F172A;
            outline: none;
            background: #FFFFFF;
            font-family: inherit;
            box-sizing: border-box;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Finishing Quick Tags */
        .finishing-tags-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px dashed #E2E8F0;
        }

        .finishing-tag-title {
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            margin-right: 2px;
        }

        .tag-pill-btn {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 6px;
            background: #F1F5F9;
            color: #334155;
            border: 1px solid #CBD5E1;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
            user-select: none;
        }

        .tag-pill-btn:hover {
            background: #EEF2FF;
            color: #1E3A8A;
            border-color: #93C5FD;
        }

        .tag-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 9px;
            border-radius: 6px;
            background: #F1F5F9;
            color: #475569;
            border: 1px solid #CBD5E1;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
            transition: all 0.15s;
        }

        .tag-pill:hover {
            background: #E2E8F0;
        }

        /* File Upload & Source Switcher Styles */
        .file-tab-container {
            display: flex;
            background: #F1F5F9;
            padding: 2px;
            border-radius: 6px;
            gap: 2px;
        }

        .file-tab-btn {
            border: none;
            background: none;
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            padding: 3px 9px;
            border-radius: 4px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.15s ease;
        }

        .file-tab-btn.active {
            background: #FFFFFF;
            color: #1E3A8A;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
        }

        .file-upload-dropzone {
            border: 1.5px dashed #CBD5E1;
            border-radius: 8px;
            padding: 9px 12px;
            background: #F8FAFC;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .file-upload-dropzone:hover {
            background: #EFF6FF;
            border-color: #3B82F6;
        }

        .file-upload-icon {
            font-size: 20px;
            color: #3B82F6;
            background: #DBEAFE;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .file-upload-browse-btn {
            background: #1E3A8A;
            color: #FFFFFF;
            font-size: 11px;
            font-weight: 700;
            padding: 5px 11px;
            border-radius: 6px;
            flex-shrink: 0;
            transition: background 0.15s ease;
        }

        .file-upload-browse-btn:hover {
            background: #172554;
        }

        /* Cart Builder Workbench */
        .cart-builder-box {
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 12px;
        }

        .meter-switch-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 0 12px;
            cursor: pointer;
            height: 38px;
            box-sizing: border-box;
            transition: all 0.15s ease;
            user-select: none;
        }

        .meter-switch-toggle:hover {
            border-color: #94A3B8;
            background: #F8FAFC;
        }

        .meter-switch-toggle input[type="checkbox"] {
            accent-color: #1E3A8A !important;
            width: 18px !important;
            height: 18px !important;
            min-width: 18px !important;
            cursor: pointer !important;
            margin: 0 !important;
            padding: 0 !important;
            box-shadow: none !important;
            flex-shrink: 0 !important;
        }

        /* Compound Input Group for Qty + Unit */
        .compound-input-group {
            display: flex;
            align-items: center;
            width: 100%;
            height: 38px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            overflow: hidden;
            background: #FFFFFF;
            box-sizing: border-box;
            transition: all 0.15s ease;
        }

        .compound-input-group:focus-within {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .compound-input-group input {
            flex: 1 !important;
            height: 36px !important;
            border: none !important;
            outline: none !important;
            padding: 0 10px !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            color: #0F172A !important;
            background: transparent !important;
            width: 100% !important;
            min-width: 0 !important;
            text-align: center !important;
            box-shadow: none !important;
        }

        .compound-input-group select {
            width: 80px !important;
            height: 36px !important;
            border: none !important;
            border-left: 1px solid #CBD5E1 !important;
            outline: none !important;
            padding: 0 8px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            color: #334155 !important;
            background: #F8FAFC !important;
            cursor: pointer !important;
            flex-shrink: 0 !important;
            box-shadow: none !important;
            border-radius: 0 !important;
        }

        /* Modern Size Chips & Interactive Controls */
        .size-chips-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .size-chip-btn {
            background: #FFFFFF;
            border: 1.5px solid #CBD5E1;
            color: #334155;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
            user-select: none;
            line-height: 1.2;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .size-chip-btn:hover {
            border-color: #3B82F6;
            background: #EFF6FF;
            color: #1E3A8A;
        }

        .size-chip-btn.active {
            background: #1E3A8A !important;
            border-color: #1E3A8A !important;
            color: #FFFFFF !important;
            font-weight: 700 !important;
            box-shadow: 0 2px 6px rgba(30, 58, 138, 0.25);
        }

        .stepper-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid #CBD5E1;
            background: #F8FAFC;
            color: #1E3A8A;
            font-size: 16px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
            user-select: none;
        }

        .stepper-btn:hover {
            background: #EEF2FF;
            border-color: #818CF8;
            color: #1E3A8A;
        }

        .stepper-btn:active {
            transform: scale(0.94);
        }

        .stepper-input {
            width: 60px !important;
            height: 32px !important;
            text-align: center !important;
            font-weight: 800 !important;
            font-size: 14px !important;
            color: #0F172A !important;
            border: 1px solid #CBD5E1 !important;
            border-radius: 8px !important;
            padding: 0 !important;
            background: #FFFFFF !important;
            -moz-appearance: textfield !important;
        }

        .stepper-input::-webkit-outer-spin-button,
        .stepper-input::-webkit-inner-spin-button {
            -webkit-appearance: none !important;
            margin: 0 !important;
        }

        /* Meter Box Grid */
        .meter-calc-grid {
            background: #FFFFFF;
            border: 1px solid #C7D2FE;
            border-radius: 8px;
            padding: 10px 12px;
            margin-bottom: 12px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1.1fr;
            gap: 10px;
            align-items: center;
        }

        .meter-calc-grid input {
            width: 100%;
            height: 36px;
            border: 1px solid #CBD5E1;
            border-radius: 6px;
            padding: 0 8px;
            font-size: 12.5px;
            outline: none;
            box-sizing: border-box;
        }

        .meter-calc-grid input:focus {
            border-color: #2563EB;
        }

        .meter-luas-badge {
            background: #EEF2FF;
            border: 1px solid #E0E7FF;
            border-radius: 6px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }

        .meter-luas-badge .val {
            font-size: 13.5px;
            font-weight: 800;
            color: #1E3A8A;
        }

        .cart-action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px solid #E2E8F0;
            margin-top: 8px;
        }

        .cart-subtotal-info {
            font-size: 12.5px;
            color: #475569;
            font-weight: 600;
        }

        .cart-subtotal-info span {
            color: #1E3A8A;
            font-weight: 800;
            font-size: 15px;
            margin-left: 4px;
        }

        .btn-add-item {
            background: #1E3A8A;
            color: #FFFFFF;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
            box-shadow: 0 2px 6px rgba(30, 58, 138, 0.2);
        }

        .btn-add-item:hover {
            background: #1E40AF;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(30, 58, 138, 0.25);
        }

        /* Cart Items Table Container */
        .cart-table-wrapper {
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            overflow: hidden;
            max-height: 170px;
            overflow-y: auto;
            background: #FFFFFF;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12.5px;
        }

        .cart-table th {
            background: #F8FAFC;
            color: #64748B;
            font-weight: 700;
            padding: 8px 12px;
            border-bottom: 1px solid #E2E8F0;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .cart-table td {
            padding: 9px 12px;
            border-bottom: 1px solid #F1F5F9;
            color: #1E293B;
            vertical-align: middle;
        }

        .cart-total-banner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            padding: 10px 14px;
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
            border-radius: 8px;
            color: #FFFFFF;
        }

        .cart-total-banner .total-label {
            font-size: 12px;
            font-weight: 600;
            color: #94A3B8;
        }

        .cart-total-banner .total-amount {
            font-size: 18px;
            font-weight: 800;
            color: #38BDF8;
            letter-spacing: -0.3px;
        }

        /* Payment Option Cards */
        .pay-options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 12px;
        }

        .pay-option-card {
            border: 1.5px solid #E2E8F0;
            border-radius: 10px;
            padding: 10px 12px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            cursor: pointer;
            background: #FFFFFF;
            transition: all 0.2s ease;
            position: relative;
        }

        .pay-option-card:hover {
            border-color: #CBD5E1;
            background: #F8FAFC;
        }

        .pay-option-card input[type="radio"] {
            margin-top: 2px;
            accent-color: #1E3A8A;
            cursor: pointer;
            width: auto;
        }

        .pay-option-card:has(input[type="radio"]:checked) {
            border-color: #1E3A8A;
            background: #F0F4FF;
            box-shadow: 0 2px 8px rgba(30, 58, 138, 0.08);
        }

        .pay-card-title {
            font-size: 12.5px;
            font-weight: 700;
            color: #0F172A;
            line-height: 1.2;
        }

        .pay-card-subtitle {
            font-size: 11px;
            color: #64748B;
            margin-top: 2px;
        }

        /* Cashier Split Columns */
        .cashier-split-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 14px;
            align-items: flex-start;
        }

        .cashier-chips-row {
            display: flex;
            gap: 5px;
            margin-top: 6px;
        }

        .chip-btn {
            flex: 1;
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            padding: 5px 0;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            color: #334155;
            cursor: pointer;
            text-align: center;
            transition: all 0.15s ease;
        }

        .chip-btn:hover {
            background: #EEF2FF;
            color: #1E3A8A;
            border-color: #C7D2FE;
        }

        .kembalian-banner {
            margin-top: 8px;
            font-size: 12.5px;
            font-weight: 800;
            padding: 8px 12px;
            border-radius: 6px;
            text-align: center;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        /* Modal Action Footer */
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            padding: 14px 22px;
            background: #FAFCFF;
            border-top: 1px solid #E2E8F0;
            flex-shrink: 0;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
            padding-top: 14px;
            border-top: 1px solid #E2E8F0;
        }

        .btn-cancel {
            background: #F1F5F9;
            color: #475569;
            border: 1px solid #CBD5E1;
            padding: 9px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-cancel:hover {
            background: #E2E8F0;
            color: #0F172A;
        }

        .btn-save {
            background: linear-gradient(135deg, #1E3A8A 0%, #2563EB 100%);
            color: #FFFFFF;
            border: none;
            padding: 9px 22px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            transition: all 0.15s ease;
        }

        .btn-save:hover {
            background: linear-gradient(135deg, #172554 0%, #1D4ED8 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
        }

        @media print {
            body * {
                visibility: hidden !important;
            }

            #spkPrintArea,
            #spkPrintArea * {
                visibility: visible !important;
            }

            #spkPrintArea {
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 16px !important;
                background: #fff !important;
                color: #000 !important;
                border: none !important;
                box-shadow: none !important;
            }
        }

        tr[data-filter-hidden="true"] {
            display: none !important;
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
                    <p class="page-subtitle">Pantau alur kerja produksi cetak (SPK), pesanan multi-item, dan status
                        pembayaran.</p>
                </div>
                <div class="header-right">
                    <button class="btn-primary" id="openOrderModal"><i class="fa-solid fa-plus"></i> Buat Pesanan
                        Baru</button>
                </div>
            </div>

            @if(session('error'))
                <div
                    style="padding: 12px 16px; background: #FEF2F2; color: #991B1B; border: 1px solid #FCA5A5; border-radius: 8px; margin-bottom: 20px; font-weight: 600; font-size: 13px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div
                    style="padding: 12px 16px; background: #F0FDF4; color: #166534; border: 1px solid #86EFAC; border-radius: 8px; margin-bottom: 20px; font-weight: 600; font-size: 13px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="card">
                <!-- Unified Table Toolbar: Search + Quick Status Filters -->
                <div class="pesanan-table-toolbar">
                    <div class="toolbar-search-wrap">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="tableSearchInput" class="toolbar-search-input"
                            placeholder="Cari kode pesanan, nama pelanggan, produk..." oninput="if(window.applyTableFilters) window.applyTableFilters()">
                    </div>
                    <div class="toolbar-filters-wrap">
                        <select id="filterStatusProd" class="toolbar-select"
                            title="Saring berdasarkan status alur produksi" onchange="if(window.applyTableFilters) window.applyTableFilters()">
                            <option value="">Semua Status Produksi</option>
                            <option value="Antrean Cetak">Antrean Cetak</option>
                            <option value="Sedang Dicetak">Sedang Dicetak</option>
                            <option value="Finishing">Finishing</option>
                            <option value="Siap Diambil">Siap Diambil</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                        <select id="filterStatusBayar" class="toolbar-select"
                            title="Saring berdasarkan status pembayaran" onchange="if(window.applyTableFilters) window.applyTableFilters()">
                            <option value="">Semua Pembayaran</option>
                            <option value="lunas">Lunas</option>
                            <option value="dp">DP</option>
                            <option value="belum_lunas">Belum Lunas</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="pesananMainTable">
                        <thead>
                            <tr>
                                <th style="width: 140px;">KODE & TANGGAL</th>
                                <th style="width: 175px;">PELANGGAN</th>
                                <th style="min-width: 200px;">PRODUK</th>
                                <th style="width: 155px;">TOTAL & BAYAR</th>
                                <th style="width: 150px;">STATUS PRODUKSI</th>
                                <th style="text-align:right; width: 60px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="pesananMainTableBody">
                            @forelse($pesanans ?? [] as $pesanan)
                                @php
                                    $stProd = $pesanan->status ?? 'Antrean Cetak';
                                    $stProdClass = 'badge-diproses';
                                    if ($stProd === 'Antrean Cetak')
                                        $stProdClass = 'badge-antrean-cetak';
                                    elseif ($stProd === 'Sedang Dicetak')
                                        $stProdClass = 'badge-sedang-dicetak';
                                    elseif ($stProd === 'Finishing')
                                        $stProdClass = 'badge-finishing';
                                    elseif ($stProd === 'Siap Diambil')
                                        $stProdClass = 'badge-siap-diambil';
                                    elseif ($stProd === 'Selesai')
                                        $stProdClass = 'badge-selesai';

                                    $stBayar = $pesanan->status_pembayaran ?? (strtolower($pesanan->status) === 'selesai' ? 'Lunas' : 'Belum Bayar');
                                    $stBayarLower = strtolower($stBayar);
                                    $sisaTagihan = floatval($pesanan->sisa_bayar ?? ($stBayarLower === 'lunas' ? 0 : $pesanan->total_harga));

                                    $detailItems = is_array($pesanan->detail_items)
                                        ? $pesanan->detail_items
                                        : (is_string($pesanan->detail_items) ? json_decode($pesanan->detail_items, true) : []);
                                    $itemsCount = is_array($detailItems) ? count($detailItems) : 1;

                                    $cleanProductName = trim(preg_replace('/\s*\(\+\s*\d+\s*produk lainnya\)/i', '', $pesanan->nama_produk ?? ''));

                                    $otherItemsList = [];
                                    if ($itemsCount > 1) {
                                        foreach (array_slice($detailItems, 1) as $oit) {
                                            $oitQty = ($oit['qty'] ?? '1') . ' ' . ($oit['satuan'] ?? 'Pcs');
                                            $otherItemsList[] = ($oit['nama_produk'] ?? 'Item') . ($oitQty ? " ({$oitQty})" : '');
                                        }
                                    }
                                    $otherTooltip = count($otherItemsList) > 0 ? "Klik untuk melihat rincian item:\n• " . implode("\n• ", $otherItemsList) : "Klik untuk melihat item pesanan";
                                @endphp
                                <tr data-status-prod="{{ $stProd }}" data-status-bayar="{{ $stBayarLower }}">
                                    <td class="td-nowrap">
                                        <div class="order-code">{{ $pesanan->kode_pesanan }}</div>
                                        <div style="font-size: 11px; color: #94A3B8; margin-top: 2px;">
                                            {{ $pesanan->tanggal_pesan ? date('d M Y', strtotime($pesanan->tanggal_pesan)) : ($pesanan->created_at ? $pesanan->created_at->format('d M Y') : '-') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="avatar-init" style="background:#DBEAFE;color:#1D4ED8;">
                                                {{ strtoupper(substr($pesanan->nama_pelanggan, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div style="font-weight: 700; color: #0F172A;">
                                                    {{ $pesanan->nama_pelanggan }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-cell" style="white-space: normal !important;">
                                        <div style="font-weight: 700; color: #0F172A; font-size: 13px; line-height: 1.35;">
                                            {{ $cleanProductName ?: '-' }}
                                        </div>

                                        @if($itemsCount > 1)
                                            <div style="margin-top: 4px;">
                                                <button type="button" class="badge-multi-item-btn"
                                                    onclick='openDesignGalleryModal(@json($detailItems), "{{ $pesanan->kode_pesanan }}", "{{ $pesanan->file_desain }}", @json($pesanan))'
                                                    title="Klik untuk melihat preview galeri desain ({{ $itemsCount }} item)">
                                                    <i class="fa-solid fa-images"></i> Lihat Desain (+{{ $itemsCount - 1 }} lainnya)
                                                    <i class="fa-solid fa-chevron-right chevron-icon"></i>
                                                </button>
                                            </div>
                                        @else
                                            @php
                                                $subUkuran = trim($pesanan->jumlah_ukuran ?? '');
                                                $isMacam = stripos($subUkuran, 'macam') !== false;
                                                $hasDesign = !empty($pesanan->file_desain) || (!empty($detailItems[0]['file_desain']));
                                            @endphp
                                            @if(!$isMacam && !empty($subUkuran) && $subUkuran !== '-')
                                                <div style="color: #64748B; font-size: 11.5px; margin-top: 2px;">
                                                    {{ $subUkuran }}
                                                </div>
                                            @endif

                                            @if($hasDesign)
                                                <div style="margin-top: 4px;">
                                                    <button type="button" class="badge-multi-item-btn"
                                                        onclick='openDesignGalleryModal(@json($detailItems), "{{ $pesanan->kode_pesanan }}", "{{ $pesanan->file_desain }}", @json($pesanan))'
                                                        title="Klik untuk melihat preview file desain">
                                                        <i class="fa-solid fa-image"></i> Lihat Desain
                                                        <i class="fa-solid fa-chevron-right chevron-icon"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="td-nowrap">
                                        <div style="font-weight: 700; color: #0F172A; font-size: 13.5px; letter-spacing: -0.01em;">
                                            Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                        </div>
                                        <div style="margin-top: 3px;">
                                            @if($stBayarLower === 'lunas')
                                                <span class="pay-sub-tag pay-sub-lunas" title="Pembayaran: Lunas">
                                                    <i class="fa-solid fa-circle-check"></i> Lunas
                                                </span>
                                            @elseif($stBayarLower === 'dp' || str_contains($stBayarLower, 'dp'))
                                                <span class="pay-sub-tag pay-sub-dp"
                                                    title="{{ $sisaTagihan > 0 ? 'Sisa tagihan: Rp ' . number_format($sisaTagihan, 0, ',', '.') : 'Pembayaran: DP' }}">
                                                    <i class="fa-solid fa-clock"></i> DP @if($sisaTagihan > 0)<span class="sisa-note">(Sisa Rp {{ number_format($sisaTagihan, 0, ',', '.') }})</span>@endif
                                                </span>
                                            @else
                                                <span class="pay-sub-tag pay-sub-unpaid"
                                                    title="{{ $sisaTagihan > 0 ? 'Sisa tagihan: Rp ' . number_format($sisaTagihan, 0, ',', '.') : 'Belum Lunas' }}">
                                                    <i class="fa-solid fa-circle-exclamation"></i> Belum Lunas
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="td-nowrap">
                                        <span class="badge-prod {{ $stProdClass }}">
                                            {{ $stProd }}
                                        </span>
                                    </td>
                                    <td class="td-nowrap" style="text-align:right;">
                                        <div class="action-dropdown">
                                            <button type="button" class="action-icon-btn action-toggle" title="Menu Aksi"><i
                                                    class="fa-solid fa-ellipsis-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <button type="button" class="dropdown-item"
                                                    onclick='openDesignGalleryModal(@json($detailItems), "{{ $pesanan->kode_pesanan }}", "{{ $pesanan->file_desain }}", @json($pesanan))'>
                                                    <i class="fa-solid {{ $itemsCount > 1 ? 'fa-images' : 'fa-image' }}" style="color:#2563EB;"></i> {{ $itemsCount > 1 ? "Galeri File Desain ({$itemsCount})" : "Lihat File Desain" }}
                                                </button>
                                                <button type="button" class="dropdown-item"
                                                    onclick='viewSpkDetail(@json($pesanan))'>
                                                    <i class="fa-solid fa-print"></i> Cetak SPK / Nota
                                                </button>
                                                @if($sisaTagihan > 0)
                                                    <button type="button" class="dropdown-item" style="color: #16A34A;"
                                                        onclick='openPelunasanModal(@json($pesanan))'>
                                                        <i class="fa-solid fa-hand-holding-dollar"></i> Pelunasan Cepat
                                                    </button>
                                                @endif
                                                @if(strtolower($pesanan->status ?? '') !== 'selesai')
                                                    <button type="button" class="dropdown-item"
                                                        onclick='openStatusModal(@json($pesanan))'>
                                                        <i class="fa-solid fa-arrows-rotate"></i> Update Produksi
                                                    </button>
                                                @endif
                                                @if(!($isKasir ?? false))
                                                    <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST"
                                                        style="display:inline;"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan {{ $pesanan->kode_pesanan }}?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item danger">
                                                            <i class="fa-regular fa-trash-can"></i> Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; padding:30px; color:#64748B;">Belum ada data
                                        pesanan cetak di database.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <div class="entry-info">Menampilkan {{ count($pesanans ?? []) }} pesanan</div>
                    <div class="pagination"></div>
                </div>
            </div>
        </main>
    </div>

    <!-- DEDICATED TABLE FILTER & PAGINATION ENGINE (ISOLATED & BULLETPROOF) -->
    <script>
        (function () {
            let currentPage = 1;
            const itemsPerPage = 10;

            function updatePagination() {
                const tbody = document.getElementById('pesananMainTableBody') || document.querySelector('#pesananMainTable tbody') || document.querySelector('.table-responsive table tbody');
                if (!tbody) return;

                const rows = Array.from(tbody.querySelectorAll('tr')).filter(r => r.id !== 'noDataFilterRow');
                const visibleRows = rows.filter(r => r.getAttribute('data-filter-hidden') !== 'true');
                const totalItems = visibleRows.length;
                const totalPages = Math.max(1, Math.ceil(totalItems / itemsPerPage));

                if (currentPage > totalPages) currentPage = totalPages;
                if (currentPage < 1) currentPage = 1;

                const startIdx = (currentPage - 1) * itemsPerPage;
                const endIdx = startIdx + itemsPerPage;

                rows.forEach(r => {
                    r.style.display = 'none';
                });

                visibleRows.slice(startIdx, endIdx).forEach(r => {
                    r.style.display = '';
                });

                // Empty state handler
                let emptyFilterRow = document.getElementById('noDataFilterRow');
                if (totalItems === 0) {
                    if (!emptyFilterRow) {
                        emptyFilterRow = document.createElement('tr');
                        emptyFilterRow.id = 'noDataFilterRow';
                        emptyFilterRow.innerHTML = '<td colspan="6" style="text-align:center; padding:32px; color:#64748B;"><i class="fa-solid fa-inbox" style="font-size:26px; margin-bottom:8px; display:block; color:#94A3B8;"></i> Tidak ada pesanan yang sesuai dengan filter yang dipilih.</td>';
                        tbody.appendChild(emptyFilterRow);
                    }
                    emptyFilterRow.style.display = '';
                } else if (emptyFilterRow) {
                    emptyFilterRow.style.display = 'none';
                }

                // Update entry info
                const entryInfo = document.querySelector('.entry-info');
                if (entryInfo) {
                    const startShow = totalItems === 0 ? 0 : startIdx + 1;
                    const endShow = Math.min(endIdx, totalItems);
                    entryInfo.textContent = `Menampilkan ${startShow} hingga ${endShow} dari ${totalItems} pesanan`;
                }

                // Update pagination controls
                const paginationEl = document.querySelector('.pagination');
                if (paginationEl) {
                    paginationEl.innerHTML = '';
                    if (totalPages > 1) {
                        const prevBtn = document.createElement('button');
                        prevBtn.className = 'page-btn';
                        prevBtn.title = 'Halaman Sebelumnya';
                        prevBtn.innerHTML = '<i class="fa-solid fa-chevron-left" style="font-size: 11px;"></i>';
                        prevBtn.disabled = currentPage === 1;
                        prevBtn.onclick = function () {
                            if (currentPage > 1) {
                                currentPage--;
                                updatePagination();
                            }
                        };
                        paginationEl.appendChild(prevBtn);

                        const selectWrap = document.createElement('div');
                        selectWrap.className = 'page-select-container';

                        const labelPre = document.createElement('span');
                        labelPre.textContent = 'Halaman';
                        selectWrap.appendChild(labelPre);

                        const select = document.createElement('select');
                        select.className = 'page-select-dropdown';
                        select.title = 'Pilih Halaman';
                        for (let p = 1; p <= totalPages; p++) {
                            const opt = document.createElement('option');
                            opt.value = p;
                            opt.textContent = p;
                            if (p === currentPage) opt.selected = true;
                            select.appendChild(opt);
                        }
                        select.onchange = function () {
                            currentPage = parseInt(this.value) || 1;
                            updatePagination();
                        };
                        selectWrap.appendChild(select);

                        const labelPost = document.createElement('span');
                        labelPost.innerHTML = `dari <strong style="color:#1E293B;">${totalPages}</strong>`;
                        selectWrap.appendChild(labelPost);

                        paginationEl.appendChild(selectWrap);

                        const nextBtn = document.createElement('button');
                        nextBtn.className = 'page-btn';
                        nextBtn.title = 'Halaman Selanjutnya';
                        nextBtn.innerHTML = '<i class="fa-solid fa-chevron-right" style="font-size: 11px;"></i>';
                        nextBtn.disabled = currentPage === totalPages;
                        nextBtn.onclick = function () {
                            if (currentPage < totalPages) {
                                currentPage++;
                                updatePagination();
                            }
                        };
                        paginationEl.appendChild(nextBtn);
                    }
                }
            }

            window.applyTableFilters = function () {
                const tbody = document.getElementById('pesananMainTableBody') || document.querySelector('#pesananMainTable tbody') || document.querySelector('.table-responsive table tbody');
                if (!tbody) return;

                const searchInput = document.getElementById('tableSearchInput') || document.querySelector('.pesanan-table-toolbar input');
                const statusProdSelect = document.getElementById('filterStatusProd');
                const statusBayarSelect = document.getElementById('filterStatusBayar');

                const q = (searchInput ? searchInput.value : '').toLowerCase().trim();
                const prodFilter = (statusProdSelect ? statusProdSelect.value : '').toLowerCase().trim();
                const bayarFilter = (statusBayarSelect ? statusBayarSelect.value : '').toLowerCase().trim();

                const rows = Array.from(tbody.querySelectorAll('tr'));
                rows.forEach(r => {
                    if (r.id === 'noDataFilterRow') return;

                    const rowText = r.textContent.toLowerCase();
                    const textMatch = !q || rowText.includes(q);

                    const rowProd = (r.getAttribute('data-status-prod') || '').toLowerCase().trim();
                    const rowBayar = (r.getAttribute('data-status-bayar') || '').toLowerCase().trim();

                    const prodMatch = !prodFilter || rowProd === prodFilter;

                    let bayarMatch = true;
                    if (bayarFilter === 'lunas') {
                        bayarMatch = (rowBayar === 'lunas' || rowBayar === 'sudah lunas');
                    } else if (bayarFilter === 'dp') {
                        bayarMatch = rowBayar.includes('dp');
                    } else if (bayarFilter === 'belum_lunas') {
                        bayarMatch = (rowBayar !== 'lunas' && rowBayar !== 'sudah lunas');
                    }

                    if (textMatch && prodMatch && bayarMatch) {
                        r.removeAttribute('data-filter-hidden');
                    } else {
                        r.setAttribute('data-filter-hidden', 'true');
                    }
                });

                currentPage = 1;
                updatePagination();
            };

            function initPesananTable() {
                const searchInput = document.getElementById('tableSearchInput');
                const statusProdSelect = document.getElementById('filterStatusProd');
                const statusBayarSelect = document.getElementById('filterStatusBayar');

                // Read URL parameters
                const urlParams = new URLSearchParams(window.location.search);
                const qParam = urlParams.get('search') || urlParams.get('q');
                let prodParam = urlParams.get('status_prod') || urlParams.get('prod');
                let bayarParam = urlParams.get('status_bayar') || urlParams.get('status_pembayaran') || urlParams.get('bayar');
                const genericStatus = urlParams.get('status');

                if (genericStatus) {
                    const gLower = genericStatus.toLowerCase();
                    if (gLower.includes('lunas') || gLower.includes('bayar') || gLower === 'dp') {
                        if (!bayarParam) bayarParam = genericStatus;
                    } else {
                        if (!prodParam) prodParam = genericStatus;
                    }
                }

                if (qParam && searchInput) {
                    searchInput.value = qParam;
                }
                if (prodParam && statusProdSelect) {
                    const pLower = prodParam.toLowerCase();
                    for (let opt of statusProdSelect.options) {
                        if (opt.value.toLowerCase() === pLower || opt.text.toLowerCase() === pLower) {
                            statusProdSelect.value = opt.value;
                            break;
                        }
                    }
                }
                if (bayarParam && statusBayarSelect) {
                    const bLower = bayarParam.toLowerCase().replace(/\s+/g, '_');
                    if (bLower.includes('belum') || bLower.includes('piutang') || bLower.includes('unpaid')) {
                        statusBayarSelect.value = 'belum_lunas';
                    } else if (bLower === 'dp') {
                        statusBayarSelect.value = 'dp';
                    } else if (bLower.includes('lunas') || bLower.includes('paid')) {
                        statusBayarSelect.value = 'lunas';
                    }
                }

                if (searchInput) {
                    searchInput.addEventListener('input', window.applyTableFilters);
                    searchInput.addEventListener('change', window.applyTableFilters);
                }
                if (statusProdSelect) {
                    statusProdSelect.addEventListener('change', window.applyTableFilters);
                }
                if (statusBayarSelect) {
                    statusBayarSelect.addEventListener('change', window.applyTableFilters);
                }

                window.applyTableFilters();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initPesananTable);
            } else {
                initPesananTable();
            }
        })();
    </script>

    <!-- FLOATING POPOVER: MULTI-ITEM ORDER DETAILS -->
    <div id="multiItemPopover" class="multi-item-popover">
        <div class="popover-header">
            <div class="popover-title-wrap">
                <i class="fa-solid fa-boxes-stacked" style="color: #2563EB;"></i>
                <span id="popoverOrderCode" style="letter-spacing: -0.2px; font-weight:800;">ORD-XXXX-XXX</span>
                <span id="popoverItemCountBadge" class="popover-count-badge">0 Produk</span>
            </div>
            <button type="button" class="popover-close-btn" onclick="closeMultiItemPopover()"
                title="Tutup">&times;</button>
        </div>
        <div class="popover-body" id="popoverItemsList">
            <!-- Dynamic item cards will be injected here -->
        </div>
        <div class="popover-footer">
            <div class="popover-total-info">
                Total: <strong id="popoverTotalText" style="color:#1E3A8A;">Rp 0</strong>
            </div>
            <button type="button" class="popover-spk-btn" id="popoverSpkBtn" title="Buka detail SPK / Nota">
                <i class="fa-solid fa-print"></i> Buka SPK
            </button>
        </div>
    </div>

    <!-- 1. MODAL BUAT PESANAN BARU (Multi-Item & Kalkulator Cetak) -->
    <div class="modal-overlay" id="orderModalOverlay">
        <div class="modal-box modal-lg structured-modal">
            <!-- Modal Header (Pinned) -->
            <div class="modal-header">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <div>
                        <h3 class="modal-title">Buat Pesanan & SPK Percetakan</h3>
                        <p class="modal-subtitle">Kalkulator dinamis ukuran cetak, spesifikasi finishing & penerbitan
                            SPK</p>
                    </div>
                </div>
                <button type="button" class="close-modal-btn" id="closeOrderModalBtn"
                    title="Tutup Modal">&times;</button>
            </div>

            <!-- Form -->
            <form id="addOrderForm" action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data"
                style="display: flex; flex-direction: column; flex: 1; min-height: 0; margin: 0;">
                @csrf
                <input type="hidden" name="items_json" id="ordItemsJson">
                <input type="hidden" name="pembayaran_tipe" value="belum_bayar">
                <!-- Fallbacks for Single Item compatibility -->
                <input type="hidden" name="nama_produk" id="ordFallbackProduct">
                <input type="hidden" name="total_harga" id="ordFallbackTotal">
                <input type="hidden" name="jumlah_val" id="ordFallbackJumlah">
                <input type="hidden" name="jumlah_unit" id="ordFallbackUnit">
                <input type="hidden" name="ukuran_val" id="ordFallbackUkuran">
                <input type="hidden" name="jumlah_ukuran" id="ordFallbackJumlahUkuran">

                <!-- Scrollable Body Content -->
                <div class="modal-body-scroll">

                    <!-- SECTION 1: PELANGGAN, STATUS, DESAIN & FINISHING -->
                    <div class="order-section-card">
                        <div class="section-card-header">
                            <div class="section-header-left">
                                <span class="step-badge">1</span>
                                <div>
                                    <h4 class="section-card-title">Informasi Pelanggan & Alur Produksi</h4>
                                    <p class="section-card-desc">Identitas pemesan, status alur cetak, link file desain
                                        & finishing</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-row-2col">
                            <div class="form-group">
                                <label for="ordCustomer">Nama Pelanggan <span style="color:#DC2626;">*</span></label>
                                <input type="text" name="nama_pelanggan" id="ordCustomer" list="pelangganList" required
                                    placeholder="Ketik nama pelanggan..." autocomplete="off">
                                <datalist id="pelangganList">
                                    @foreach($pelanggans ?? [] as $pel)
                                        <option value="{{ $pel->nama }}">{{ $pel->kode_pelanggan }} - {{ $pel->nama }}
                                        </option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label>Status Alur Produksi</label>
                                <div
                                    style="background: #FFFBEB; border: 1.5px solid #FDE68A; border-radius: 8px; padding: 0 12px; height: 38px; display: flex; align-items: center; justify-content: space-between;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <span
                                            style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #D97706;"></span>
                                        <span style="font-size: 12.5px; font-weight: 700; color: #92400E;">1. Antrean
                                            Cetak (Menunggu Mesin)</span>
                                    </div>
                                    <span
                                        style="font-size: 10.5px; background: #FEF3C7; color: #B45309; padding: 2px 7px; border-radius: 4px; font-weight: 700; text-transform: uppercase;">Otomatis</span>
                                </div>
                                <input type="hidden" name="status" value="Antrean Cetak">
                                <span style="font-size: 11px; color: #64748B; margin-top: 3px; display: block;">*Status
                                    alur produksi dapat diperbarui nanti setelah pesanan dibuat via tombol Aksi.</span>
                            </div>
                        </div>

                        <div class="form-row-2col" style="margin-top: 4px; align-items: flex-start;">
                            <!-- File Desain: File Laptop vs Link GDrive -->
                            <div class="form-group" style="margin-bottom: 0;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <label style="margin-bottom: 0; font-weight: 700; color: #334155;">File Desain
                                        Cetak <span style="color:#DC2626; font-size: 11px;">* (Wajib)</span></label>
                                    <div class="file-tab-container">
                                        <button type="button" id="tabBtnUpload" class="file-tab-btn active"
                                            onclick="switchDesignSource('upload')">
                                            <i class="fa-solid fa-laptop"></i> File Laptop
                                        </button>
                                        <button type="button" id="tabBtnLink" class="file-tab-btn"
                                            onclick="switchDesignSource('link')">
                                            <i class="fa-brands fa-google-drive"></i> Link Drive/URL
                                        </button>
                                    </div>
                                </div>

                                <!-- Mode 1: Upload File dari Laptop -->
                                <div id="fileUploadContainer">
                                    <input type="file" name="file_upload" id="ordFileUpload"
                                        accept=".jpg,.jpeg,.png,.webp,.pdf,.tif,.tiff,.svg,.ai,.psd,.cdr,.zip"
                                        style="display: none;" onchange="validateAndPreviewFile(this)">
                                    <div class="file-upload-dropzone"
                                        onclick="document.getElementById('ordFileUpload').click()">
                                        <i class="fa-solid fa-cloud-arrow-up file-upload-icon"></i>
                                        <div style="flex: 1; text-align: left;">
                                            <div style="font-size: 12.5px; font-weight: 700; color: #1E3A8A;">Pilih /
                                                Tarik File dari Laptop</div>
                                            <div style="font-size: 11px; color: #64748B;">Mendukung: JPG, PNG, PDF, SVG,
                                                TIFF, PSD, CDR, ZIP (Maks. 50MB)</div>
                                        </div>
                                        <span class="file-upload-browse-btn">Browse</span>
                                    </div>

                                    <!-- Status Bar File Terpilih & Validasi -->
                                    <div id="filePreviewBar"
                                        style="display: none; align-items: center; justify-content: space-between; background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 8px; padding: 7px 12px; margin-top: 6px;">
                                        <div style="display: flex; align-items: center; gap: 8px; overflow: hidden;">
                                            <i id="filePreviewIcon" class="fa-solid fa-file-image"
                                                style="color: #16A34A; font-size: 16px;"></i>
                                            <div style="overflow: hidden;">
                                                <div id="filePreviewName"
                                                    style="font-size: 12px; font-weight: 700; color: #166534; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                                    desain.jpg</div>
                                                <div id="filePreviewSize" style="font-size: 10.5px; color: #15803D;">0
                                                    KB • Lolos Verifikasi</div>
                                            </div>
                                        </div>
                                        <button type="button" onclick="removeSelectedFile()"
                                            style="background: none; border: none; color: #DC2626; cursor: pointer; padding: 4px; font-size: 13px;"
                                            title="Batalkan File">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                        </button>
                                    </div>

                                    <!-- Warning Alert Anti-Spoofing (Client Side) -->
                                    <div id="fileSpoofError"
                                        style="display: none; background: #FEF2F2; border: 1.5px solid #FCA5A5; border-radius: 8px; padding: 8px 12px; margin-top: 6px; color: #991B1B; font-size: 11.5px; line-height: 1.4;">
                                        <div style="display: flex; align-items: flex-start; gap: 7px;">
                                            <i class="fa-solid fa-circle-exclamation"
                                                style="font-size: 14px; margin-top: 2px; color: #DC2626;"></i>
                                            <div>
                                                <strong style="display: block; font-size: 12px;">Peringatan File Palsu
                                                    Ditolak!</strong>
                                                <span id="fileSpoofErrorMsg">File terdeteksi sebagai teks biasa yang
                                                    diubah ekstensinya.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mode 2: Link Google Drive / URL -->
                                <div id="fileLinkContainer" style="display: none;">
                                    <div style="position: relative;">
                                        <input type="text" name="file_desain" id="ordFileDesain"
                                            placeholder="https://drive.google.com/file/d/..." autocomplete="off"
                                            style="padding-left: 32px;">
                                        <i class="fa-brands fa-google-drive"
                                            style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #0EA5E9; font-size: 14px;"></i>
                                    </div>
                                    <span
                                        style="font-size: 11px; color: #64748B; margin-top: 3px; display: block;">Pastikan
                                        link Google Drive disetel ke <em>"Anyone with the link can view"</em>.</span>
                                </div>
                            </div>

                            <!-- Detail Finishing Cetak -->
                            <div class="form-group" style="margin-bottom: 0;">
                                <label for="ordCatatanFinishing">Detail Finishing Cetak</label>
                                <textarea name="catatan_finishing" id="ordCatatanFinishing" rows="3"
                                    placeholder="Contoh: Mata ayam 4 sudut, laminasi doff, selongsong atas-bawah..."
                                    style="resize: none; font-size: 12.5px; height: 78px; padding: 8px 11px;"></textarea>
                            </div>
                        </div>

                        <!-- Quick Finishing Tag Pills -->
                        <div class="finishing-tags-row">
                            <span class="finishing-tag-title">Pilihan Finishing:</span>
                            <button type="button" class="tag-pill-btn"
                                onclick="addFinishingTag('Mata Ayam 4 Sudut')">Mata Ayam 4 Sudut</button>
                            <button type="button" class="tag-pill-btn"
                                onclick="addFinishingTag('Laminasi Glossy')">Laminasi Glossy</button>
                            <button type="button" class="tag-pill-btn"
                                onclick="addFinishingTag('Laminasi Doff')">Laminasi Doff</button>
                            <button type="button" class="tag-pill-btn"
                                onclick="addFinishingTag('Selongsong Atas-Bawah')">Selongsong Atas-Bawah</button>
                            <button type="button" class="tag-pill-btn" onclick="addFinishingTag('Potong Pas')">Potong
                                Pas</button>
                            <button type="button" class="tag-pill-btn" onclick="addFinishingTag('Jilid Spiral')">Jilid
                                Spiral</button>
                        </div>
                    </div>

                    <!-- SECTION 2: MULTI-ITEM CART BUILDER & METER CALCULATOR -->
                    <div class="order-section-card">
                        <div class="section-card-header">
                            <div class="section-header-left">
                                <span class="step-badge">2</span>
                                <div>
                                    <h4 class="section-card-title">Keranjang Item & Kalkulator Dinamis</h4>
                                    <p class="section-card-desc">Kalkulator otomatis ukuran meteran atau produk cetak
                                        lembaran</p>
                                </div>
                            </div>
                            <span id="cartCountBadge" class="cart-badge-pill">0 Item Ditambahkan</span>
                        </div>

                        <!-- Builder Controls Workbench -->
                        <div class="cart-builder-box">
                            <div
                                style="display: grid; grid-template-columns: 1.6fr 1.1fr; gap: 12px; margin-bottom: 12px; align-items: flex-start;">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label for="cartItemProduct">Pilih Produk Cetak</label>
                                    <select id="cartItemProduct">
                                        <option value="" disabled selected>-- Pilih Produk Percetakan --</option>
                                        @foreach($produks ?? [] as $prod)
                                            @php $isOut = ($prod->stok ?? 0) <= 0; @endphp
                                            <option value="{{ $prod->nama_produk }}" data-harga="{{ $prod->harga }}"
                                                data-stok="{{ $prod->stok }}" {{ $isOut ? 'disabled style=color:#94A3B8;background:#F1F5F9;' : '' }}>
                                                {{ $prod->nama_produk }} — Rp {{ number_format($prod->harga, 0, ',', '.') }}
                                                (Stok: {{ $isOut ? 'Habis' : $prod->stok }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="margin-bottom: 0;">
                                    <label
                                        style="font-size: 11.5px; font-weight: 600; color: #334155; margin-bottom: 5px; display: block;">Perhitungan
                                        Khusus</label>
                                    <label class="meter-switch-toggle" for="cartToggleMeter">
                                        <span style="font-size: 12px; font-weight: 600; color: #1E3A8A;">Hitung Meteran
                                            (P &times; L)</span>
                                        <input type="checkbox" id="cartToggleMeter">
                                    </label>
                                </div>
                            </div>

                            <!-- Meteran Dynamic Mode (Panjang x Lebar) -->
                            <div id="meterFieldsRow" class="meter-calc-grid" style="display: none;">
                                <div>
                                    <label
                                        style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Panjang
                                        (Meter)</label>
                                    <input type="number" id="meterPanjang" step="0.01" min="0.1" value="3.00"
                                        placeholder="3.0">
                                </div>
                                <div>
                                    <label
                                        style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Lebar
                                        (Meter)</label>
                                    <input type="number" id="meterLebar" step="0.01" min="0.1" value="1.00"
                                        placeholder="1.0">
                                </div>
                                <div>
                                    <label
                                        style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Jumlah
                                        (Qty)</label>
                                    <input type="number" id="meterQty" min="1" value="1" placeholder="1">
                                </div>
                                <div>
                                    <label
                                        style="font-size: 11px; font-weight: 700; color: #1E3A8A; display: block; margin-bottom: 4px;">Total
                                        Luas</label>
                                    <div class="meter-luas-badge">
                                        <span id="meterLuasPreview" class="val">3.00 m²</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Standard Dynamic Mode: Modern Chips & Tactile Stepper (No Harsh Boxes!) -->
                            <div id="standardFieldsRow" style="margin-bottom: 14px;">

                                <!-- 1. Pilihan Ukuran Produk: Modern Pill Chips -->
                                <div style="margin-bottom: 12px;">
                                    <div
                                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                                        <label
                                            style="font-size: 11px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.3px;">PILIHAN
                                            UKURAN CETAK</label>
                                        <span id="selectedSizeBadge"
                                            style="font-size: 11px; font-weight: 700; color: #1E3A8A; background: #EEF2FF; padding: 2px 8px; border-radius: 6px;">A4
                                            (21 x 29.7 cm)</span>
                                    </div>
                                    <div class="size-chips-wrapper">
                                        <button type="button" class="size-chip-btn active" data-size="A4 (21 x 29.7 cm)"
                                            onclick="selectSizeChip(this)">A4</button>
                                        <button type="button" class="size-chip-btn" data-size="A3+ (32 x 48 cm)"
                                            onclick="selectSizeChip(this)">A3+</button>
                                        <button type="button" class="size-chip-btn"
                                            data-size="F4 / Folio (21.5 x 33 cm)" onclick="selectSizeChip(this)">F4 /
                                            Folio</button>
                                        <button type="button" class="size-chip-btn" data-size="Kartu Nama (9 x 5.5 cm)"
                                            onclick="selectSizeChip(this)">Kartu Nama (9×5.5)</button>
                                        <button type="button" class="size-chip-btn" data-size="Standard"
                                            onclick="selectSizeChip(this)">Standard</button>
                                        <button type="button" class="size-chip-btn" data-size="custom"
                                            onclick="selectSizeChip(this)">+ Ukuran Lain</button>
                                    </div>
                                    <div id="customSizeInputWrap" style="display: none; margin-top: 8px;">
                                        <input type="text" id="customSizeInput"
                                            placeholder="Ketik ukuran khusus (misal: 15 x 20 cm, B5, dll)..."
                                            style="width: 100%; border-radius: 8px; border: 1.5px solid #3B82F6; padding: 8px 12px; font-size: 12.5px; background: #F8FAFC;">
                                    </div>
                                    <input type="hidden" id="cartItemSize" value="A4 (21 x 29.7 cm)">
                                </div>

                                <!-- 2. Kontrol Jumlah (Stepper +/-) & Satuan Produk -->
                                <div
                                    style="display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 10px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 10px 14px;">
                                    <div>
                                        <div
                                            style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase;">
                                            Jumlah Pesanan</div>
                                        <div class="qty-stepper-group"
                                            style="display: flex; align-items: center; gap: 6px; margin-top: 5px;">
                                            <button type="button" class="stepper-btn"
                                                onclick="stepCartQty(-1)">&minus;</button>
                                            <input type="number" id="cartItemQty" min="1" value="1"
                                                class="stepper-input">
                                            <button type="button" class="stepper-btn"
                                                onclick="stepCartQty(1)">&plus;</button>
                                        </div>
                                    </div>
                                    <div
                                        style="border-left: 1px solid #E2E8F0; padding-left: 14px; flex: 1; max-width: 160px;">
                                        <div
                                            style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase; margin-bottom: 5px;">
                                            Satuan Item</div>
                                        <select id="cartItemUnit"
                                            style="width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 6px 10px; font-size: 12.5px; font-weight: 700; color: #1E3A8A; background: #FFFFFF; outline: none; cursor: pointer;">
                                            <option value="Pcs">Pcs</option>
                                            <option value="Box">Box</option>
                                            <option value="Rim">Rim</option>
                                            <option value="Lembar">Lembar</option>
                                            <option value="Meter">Meter</option>
                                            <option value="Set">Set</option>
                                            <option value="Buku">Buku</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- 3. Catatan Khusus Item: Toggle Elegan, Bukan Kotak Kaku Permanen! -->
                                <div style="margin-top: 6px;">
                                    <button type="button" id="btnToggleItemNote" onclick="toggleItemNoteInput()"
                                        style="background: none; border: none; color: #2563EB; font-size: 11.5px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; padding: 2px 0;">
                                        <i class="fa-solid fa-pen-to-square"></i> <span id="toggleItemNoteText">+ Tambah
                                            Catatan Khusus Item Ini</span>
                                    </button>
                                    <div id="itemNoteInputWrap" style="display: none; margin-top: 6px;">
                                        <input type="text" id="cartItemNote"
                                            placeholder="Tuliskan instruksi spesifik (misal: potong rounded corner, laminasi doff, dll)..."
                                            style="width: 100%; border-radius: 8px; border: 1px solid #CBD5E1; padding: 8px 12px; font-size: 12px; background: #FFFFFF;">
                                    </div>
                                </div>
                            </div>

                            <div class="cart-action-bar">
                                <div class="cart-subtotal-info">
                                    Estimasi Subtotal: <span id="cartItemSubtotalPreview">Rp 0</span>
                                </div>
                                <button type="button" id="btnAddToCart" class="btn-add-item">
                                    <i class="fa-solid fa-cart-plus"></i> Tambah ke Keranjang
                                </button>
                            </div>
                        </div>

                        <!-- Items Table -->
                        <div class="cart-table-wrapper">
                            <table class="cart-table" id="cartTable">
                                <thead>
                                    <tr>
                                        <th>Item Produk</th>
                                        <th>Ukuran / Dimensi</th>
                                        <th>Qty</th>
                                        <th>File Desain</th>
                                        <th>Subtotal</th>
                                        <th style="text-align: right;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="cartTableBody">
                                    <tr id="cartEmptyRow">
                                        <td colspan="6" style="text-align: center; color: #94A3B8; padding: 22px;">
                                            <span
                                                style="font-weight:600; color: #64748B; display: block; font-size: 12.5px;">Keranjang
                                                masih kosong</span>
                                            <div style="font-size:11.5px; margin-top:3px; color: #94A3B8;">Pilih produk
                                                di atas lalu klik <strong>Tambah ke Keranjang</strong>.</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-total-banner">
                            <div>
                                <div class="total-label">Total Seluruh Pesanan:</div>
                                <div style="font-size: 11px; color: #94A3B8;">Akumulasi seluruh item percetakan di atas
                                </div>
                            </div>
                            <div id="cartTotalDisplay" class="total-amount">Rp 0</div>
                        </div>

                        <!-- Info Alur Pembayaran Kasir -->
                        <div
                            style="background: #F0F9FF; border: 1px solid #BAE6FD; border-radius: 8px; padding: 12px 14px; margin-top: 14px; display: flex; align-items: flex-start; gap: 10px;">
                            <i class="fa-solid fa-circle-info"
                                style="color: #0284C7; font-size: 16px; margin-top: 2px; flex-shrink: 0;"></i>
                            <div style="font-size: 12px; color: #0369A1; line-height: 1.45;">
                                Pesanan akan otomatis diterbitkan dengan status tagihan <strong>Belum Lunas</strong>.
                                Penerimaan uang kasir, pencatatan DP/pelunasan, hitung kembalian, dan cetak kuitansi
                                dikelola terpusat di <strong>Menu Pembayaran</strong> di sidebar.
                            </div>
                        </div>
                    </div>

                </div> <!-- End modal-body-scroll -->

                <!-- Modal Footer (Pinned) -->
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="cancelOrderModalBtn">Batal</button>
                    <button type="submit" class="btn-save" id="btnSaveOrder">
                        <i class="fa-solid fa-check"></i> Simpan Pesanan & Terbitkan SPK
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. MODAL UPDATE STATUS PRODUKSI & SPESIFIKASI -->
    <div class="modal-overlay" id="statusModalOverlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fa-solid fa-arrows-rotate" style="color:#1E3A8A;"></i>
                    Update Alur Produksi (SPK)
                </h3>
                <button type="button" class="close-modal-btn" onclick="closeStatusModal()">&times;</button>
            </div>
            <form id="statusUpdateForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div
                    style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 10px 12px; margin-bottom: 14px; font-size: 12.5px;">
                    <div style="color: #64748B;">Kode Pesanan: <strong id="stModalKode"
                            style="color: #0F172A;">-</strong></div>
                    <div style="color: #64748B; margin-top: 2px;">Pelanggan: <strong id="stModalPelanggan"
                            style="color: #0F172A;">-</strong></div>
                </div>

                <div class="form-group">
                    <label for="stStatusSelect">Tahap Alur Produksi</label>
                    <select name="status" id="stStatusSelect" required>
                        <option value="Antrean Cetak">1. Antrean Cetak (Desain Siap)</option>
                        <option value="Sedang Dicetak">2. Sedang Dicetak (Mesin Printing)</option>
                        <option value="Finishing">3. Finishing (Potong, Laminasi, Mata Ayam)</option>
                        <option value="Siap Diambil">4. Siap Diambil / Diantar</option>
                        <option value="Selesai">5. Selesai (Sudah Diterima Pelanggan)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stCatatanFinishing">Perbarui Catatan Finishing</label>
                    <input type="text" name="catatan_finishing" id="stCatatanFinishing"
                        placeholder="Contoh: Tambah mata ayam sudut...">
                </div>

                <!-- Single Item Design Section -->
                <div class="form-group" id="stSingleItemContainer">
                    <label for="stFileDesain">Perbarui File / Link Desain</label>
                    <div id="stCurrentFileWrap" style="margin-bottom: 6px; font-size: 11.5px; display: none;">
                        <a href="#" id="stCurrentFileLink" target="_blank"
                            style="color: #2563EB; font-weight: 700; text-decoration: underline;">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat File Desain Saat Ini
                        </a>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <input type="text" name="file_desain" id="stFileDesain" placeholder="Tautan Google Drive..."
                            style="flex: 1;">
                        <label for="stFileUpload" class="tag-pill-btn"
                            style="height: 38px; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; padding: 0 12px; white-space: nowrap;">
                            <i class="fa-solid fa-upload"></i> Unggah Desain
                        </label>
                        <input type="file" name="file_upload" id="stFileUpload"
                            accept=".jpg,.jpeg,.png,.webp,.pdf,.tif,.tiff,.svg,.ai,.psd,.cdr,.zip"
                            style="display: none;" onchange="handleStatusFileUpload(this)">
                    </div>

                    <!-- Status File Preview & Verification Feedback -->
                    <div id="stFileChosenText"
                        style="display: none; font-size: 11.5px; color: #166534; background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 6px; padding: 6px 10px; margin-top: 8px; font-weight: 600;">
                        <i class="fa-solid fa-circle-check" id="stFileChosenIcon" style="margin-right: 4px;"></i>
                        <span id="stFileChosenName"></span>
                    </div>

                    <!-- Status File Anti-Spoofing Error Alert -->
                    <div id="stFileSpoofError"
                        style="display: none; font-size: 11.5px; color: #991B1B; background: #FEF2F2; border: 1px solid #FCA5A5; border-radius: 6px; padding: 6px 10px; margin-top: 8px; font-weight: 600;">
                        <i class="fa-solid fa-circle-exclamation" style="margin-right: 4px;"></i>
                        <span id="stFileSpoofErrorMsg"></span>
                    </div>
                </div>

                <!-- Multi-Item Design Manager (Shown dynamically if order has >1 item) -->
                <div class="form-group" id="stMultiItemsSection" style="display: none;">
                    <label style="font-weight: 700; color: #1E293B; margin-bottom: 6px; display: block;">
                        <i class="fa-solid fa-layer-group" style="color: #2563EB;"></i> Perbarui Desain Tiap Item Pesanan:
                    </label>
                    <div id="stMultiItemsList" style="display: flex; flex-direction: column; gap: 8px; max-height: 220px; overflow-y: auto; padding-right: 4px;">
                        <!-- Rendered dynamically in JS -->
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeStatusModal()">Batal</button>
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. MODAL CETAK SPK (SURAT PERINTAH KERJA) & NOTA PRODUKSI -->
    <div class="modal-overlay" id="spkModalOverlay">
        <div class="modal-box modal-lg">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fa-solid fa-print" style="color:#1E3A8A;"></i>
                    Surat Perintah Kerja (SPK) & Nota Produksi
                </h3>
                <button type="button" class="close-modal-btn" onclick="closeSpkModal()">&times;</button>
            </div>

            <!-- Print Target Document -->
            <div id="spkPrintArea"
                style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 10px; padding: 20px; font-size: 13px; color: #1E293B;">
                <!-- Header SPK -->
                <div
                    style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #1E3A8A; padding-bottom: 12px; margin-bottom: 14px;">
                    <div>
                        <div style="font-size: 20px; font-weight: 900; color: #1E3A8A; letter-spacing: -0.5px;">SIPEKAN
                            PRINTING</div>
                        <div style="font-size: 11px; color: #64748B;">Sistem Informasi & Manajemen Percetakan Digital
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <span
                            style="background: #1E3A8A; color: #FFFFFF; font-size: 11px; font-weight: 800; padding: 3px 10px; border-radius: 4px; text-transform: uppercase;">SPK
                            PRODUKSI</span>
                        <div style="font-size: 14px; font-weight: 800; color: #0F172A; margin-top: 4px;"
                            id="spkKodePesanan">-</div>
                        <div style="font-size: 11px; color: #64748B;" id="spkTglPesanan">-</div>
                    </div>
                </div>

                <!-- Alert Status Badge -->
                <div
                    style="display: flex; justify-content: space-between; align-items: center; background: #F1F5F9; border-radius: 6px; padding: 8px 12px; margin-bottom: 14px;">
                    <div style="font-size: 12px; color: #475569;">Dokumen resmi instruksi cetak bagian operator mesin &
                        finishing</div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="font-size: 11px; font-weight: 700; color: #475569;">STATUS BAYAR:</span>
                        <div>
                            <span id="spkStatusBadge"
                                style="background: #DCFCE7; color: #166534; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 800;">LUNAS</span>
                        </div>
                    </div>
                </div>

                <div
                    style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; background: #F8FAFC; padding: 12px; border-radius: 8px;">
                    <div>
                        <div style="font-size: 11px; color: #64748B; text-transform: uppercase; font-weight: 700;">Data
                            Pemesan</div>
                        <div style="font-size: 14px; font-weight: 800; color: #0F172A; margin-top: 2px;"
                            id="spkPelanggan">-</div>
                        <div style="font-size: 11.5px; color: #64748B; margin-top: 2px;" id="spkKontakPelanggan">
                            Pelanggan SIPEKAN</div>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: #64748B; text-transform: uppercase; font-weight: 700;">
                            Status Produksi & Desain</div>
                        <div style="font-size: 13px; font-weight: 800; color: #1E3A8A; margin-top: 2px;"
                            id="spkStatusProduksi">Antrean Cetak</div>
                        <div style="margin-top: 4px;" id="spkFileDesainWrapper">
                            <a href="#" id="spkFileDesainLink" target="_blank"
                                style="color: #2563EB; font-weight: 700; font-size: 11.5px; text-decoration: underline;">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka File Desain
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Table of Items in SPK -->
                <div style="margin-bottom: 16px;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                        <thead>
                            <tr style="background: #1E3A8A; color: #FFFFFF;">
                                <th style="padding: 8px 10px; text-align: left;">No.</th>
                                <th style="padding: 8px 10px; text-align: left;">Item Produk</th>
                                <th style="padding: 8px 10px; text-align: left;">Ukuran / Dimensi</th>
                                <th style="padding: 8px 10px; text-align: center;">Qty</th>
                                <th style="padding: 8px 10px; text-align: left;">File Desain</th>
                                <th style="padding: 8px 10px; text-align: right;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="spkItemsTableBody">
                            <!-- Populated dynamically via JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Finishing Note -->
                <div
                    style="background: #FFFBEB; border: 1px solid #FDE68A; border-radius: 8px; padding: 10px 14px; margin-bottom: 16px;">
                    <div style="font-size: 11px; font-weight: 800; color: #92400E; text-transform: uppercase;">Instruksi
                        Khusus Finishing:</div>
                    <div id="spkFinishingNote"
                        style="font-size: 12.5px; font-weight: 600; color: #78350F; margin-top: 2px;">
                        Standar percetakan tanpa finishing khusus.
                    </div>
                </div>

                <!-- Financial Summary -->
                <div style="display: flex; justify-content: flex-end; margin-bottom: 24px;">
                    <div style="width: 260px; font-size: 12.5px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                            <span style="color: #64748B;">Total Tagihan:</span>
                            <strong id="spkTotalHarga" style="color: #0F172A;">Rp 0</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                            <span style="color: #64748B;">Status Bayar:</span>
                            <span id="spkStatusBayarText" style="font-weight: 700; color: #16A34A;">Lunas</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; border-top: 1px solid #CBD5E1; padding-top: 6px; margin-top: 4px;">
                            <span style="font-weight: 800; color: #DC2626;">Sisa Tagihan:</span>
                            <strong id="spkSisaBayar" style="font-size: 14px; color: #DC2626; font-weight: 900;">Rp
                                0</strong>
                        </div>
                    </div>
                </div>

                <!-- Signatures -->
                <div
                    style="display: flex; justify-content: space-between; text-align: center; font-size: 11px; color: #475569; padding-top: 16px; border-top: 1px dashed #CBD5E1;">
                    <div style="width: 160px;">
                        <div>Operator Produksi / Kasir</div>
                        <div style="height: 48px;"></div>
                        <div style="border-top: 1px solid #CBD5E1; padding-top: 4px;">( _________________ )</div>
                    </div>
                    <div style="width: 160px;">
                        <div>Penerima / Pelanggan</div>
                        <div style="height: 48px;"></div>
                        <div style="border-top: 1px solid #CBD5E1; padding-top: 4px;">( _________________ )</div>
                    </div>
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeSpkModal()">Tutup</button>
                <button type="button" class="btn-save" onclick="window.print()">
                    <i class="fa-solid fa-print"></i> Cetak Dokumen SPK
                </button>
            </div>
        </div>
    </div>

    <!-- 4. MODAL PELUNASAN CEPAT (1-Click Kasir Pelunasan Sisa) -->
    <div class="modal-overlay" id="pelunasanModalOverlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fa-solid fa-hand-holding-dollar" style="color:#16A34A;"></i>
                    Pelunasan Sisa Tagihan
                </h3>
                <button type="button" class="close-modal-btn" onclick="closePelunasanModal()">&times;</button>
            </div>
            <form action="{{ route('pembayaran.store') }}" method="POST" id="pelunasanForm">
                @csrf
                <input type="hidden" name="kode_pesanan" id="pelunasanKodePesanan">

                <div
                    style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 12px 14px; margin-bottom: 14px; font-size: 13px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                        <span style="color: #64748B;">No. Pesanan:</span>
                        <strong id="pelunasanDisplayKode" style="color: #1E3A8A;">-</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                        <span style="color: #64748B;">Pelanggan:</span>
                        <strong id="pelunasanDisplayPelanggan" style="color: #0F172A;">-</strong>
                    </div>
                    <div
                        style="display: flex; justify-content: space-between; border-top: 1px solid #E2E8F0; padding-top: 6px; margin-top: 4px;">
                        <span style="color: #DC2626; font-weight: 700;">Sisa yang Harus Dilunasi:</span>
                        <strong id="pelunasanDisplaySisa" style="color: #DC2626; font-weight: 800; font-size: 15px;">Rp
                            0</strong>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pelunasanJumlah">Jumlah Pembayaran (Rp)</label>
                    <input type="number" name="jumlah" id="pelunasanJumlah" min="1" step="any" required>
                </div>

                <div class="form-group">
                    <label for="pelunasanMetode">Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="pelunasanMetode" required>
                        <option value="Tunai" selected>Tunai (Cash)</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="QRIS">QRIS</option>
                    </select>
                </div>

                <div class="form-group" id="pelunasanCashierBox">
                    <label for="pelunasanUangDiterima">Uang Diterima dari Pelanggan</label>
                    <input type="number" name="uang_diterima" id="pelunasanUangDiterima" placeholder="Contoh: 100000"
                        min="0" step="any">
                    <div style="display: flex; gap: 4px; margin-top: 6px; flex-wrap: wrap;">
                        <button type="button" class="chip-btn" onclick="setPelunasanChip('pas')">Uang Pas</button>
                        <button type="button" class="chip-btn" onclick="setPelunasanChip(50000)">50k</button>
                        <button type="button" class="chip-btn" onclick="setPelunasanChip(100000)">100k</button>
                        <button type="button" class="chip-btn" onclick="setPelunasanChip(200000)">200k</button>
                    </div>
                    <div id="pelunasanKembalianDisplay"
                        style="margin-top: 6px; font-size: 12.5px; font-weight: 800; color: #16A34A; background: #DCFCE7; padding: 4px 8px; border-radius: 4px; display: inline-block;">
                        Kembalian: Rp 0
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closePelunasanModal()">Batal</button>
                    <button type="submit" class="btn-save" style="background: #16A34A;">
                        <i class="fa-solid fa-check"></i> Proses Pelunasan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 5. MODAL GALERI DESAIN (MULTI-ITEM & SINGLE-ITEM DESIGN VIEWER) -->
    <div class="modal-overlay" id="designGalleryModalOverlay">
        <div class="modal-box modal-lg">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fa-solid fa-images" id="galleryModalTitleIcon" style="color:#1E3A8A;"></i>
                    <span id="galleryModalHeadingText">Galeri File Desain</span> — <span id="galleryKodePesanan" style="color:#2563EB;">-</span>
                </h3>
                <button type="button" class="close-modal-btn" onclick="closeDesignGalleryModal()">&times;</button>
            </div>
            <div style="font-size: 12.5px; color: #64748B; margin-bottom: 6px;" id="galleryModalSubtitle">
                Semua file desain cetak yang dilampirkan untuk masing-masing item pada pesanan ini:
            </div>
            <div id="galleryItemsContainer" class="gallery-grid">
                <!-- Rendered dynamically via JS -->
            </div>
            <div class="modal-actions" style="margin-top: 18px;">
                <button type="button" class="btn-cancel" onclick="closeDesignGalleryModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT ENGINE FOR SIPEKAN -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Product Master Data for Live Calculations
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

        // Multi-Item Cart State
        let cartItems = [];
        let currentUploadedDesignFile = null;

        // UI Elements
        const modalOverlay = document.getElementById('orderModalOverlay');
        const openBtn = document.getElementById('openOrderModal');
        const closeBtn = document.getElementById('closeOrderModalBtn');
        const cancelBtn = document.getElementById('cancelOrderModalBtn');
        const addOrderForm = document.getElementById('addOrderForm');

        const cartItemProduct = document.getElementById('cartItemProduct');
        const cartToggleMeter = document.getElementById('cartToggleMeter');
        const meterFieldsRow = document.getElementById('meterFieldsRow');
        const standardFieldsRow = document.getElementById('standardFieldsRow');
        const meterPanjang = document.getElementById('meterPanjang');
        const meterLebar = document.getElementById('meterLebar');
        const meterQty = document.getElementById('meterQty');
        const meterLuasPreview = document.getElementById('meterLuasPreview');
        const cartItemQty = document.getElementById('cartItemQty');
        const cartItemUnit = document.getElementById('cartItemUnit');
        const cartItemSize = document.getElementById('cartItemSize');
        const cartItemNote = document.getElementById('cartItemNote');
        const cartItemSubtotalPreview = document.getElementById('cartItemSubtotalPreview');
        const btnAddToCart = document.getElementById('btnAddToCart');
        const cartTableBody = document.getElementById('cartTableBody');
        const cartTotalDisplay = document.getElementById('cartTotalDisplay');
        const cartCountBadge = document.getElementById('cartCountBadge');
        const ordItemsJson = document.getElementById('ordItemsJson');

        // Dynamic Meteran Switch on Product selection
        function isMeteranProduct(name) {
            const lower = (name || '').toLowerCase();
            return lower.includes('spanduk') || lower.includes('banner') || lower.includes('backlite') || lower.includes('meter');
        }

        function updateItemSubtotalPreview() {
            const prodName = cartItemProduct.value;
            const unitPrice = productPrices[prodName] || 0;
            let subtotal = 0;

            if (cartToggleMeter.checked) {
                const p = parseFloat(meterPanjang.value) || 0;
                const l = parseFloat(meterLebar.value) || 0;
                const q = parseInt(meterQty.value) || 1;
                const luas = Math.max(0.1, p * l);
                meterLuasPreview.textContent = (luas * q).toFixed(2) + ' m²';
                subtotal = Math.round(luas * unitPrice * q);
            } else {
                const q = parseInt(cartItemQty.value) || 1;
                subtotal = Math.round(unitPrice * q);
            }

            cartItemSubtotalPreview.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            return subtotal;
        }

        if (cartItemProduct) {
            cartItemProduct.addEventListener('change', function () {
                const pName = this.value;
                if (isMeteranProduct(pName)) {
                    cartToggleMeter.checked = true;
                }
                toggleMeterView();
                updateItemSubtotalPreview();
            });
        }

        function toggleMeterView() {
            if (cartToggleMeter.checked) {
                meterFieldsRow.style.display = 'grid';
                standardFieldsRow.style.display = 'none';
            } else {
                meterFieldsRow.style.display = 'none';
                standardFieldsRow.style.display = 'grid';
            }
            updateItemSubtotalPreview();
        }

        if (cartToggleMeter) cartToggleMeter.addEventListener('change', toggleMeterView);
        [meterPanjang, meterLebar, meterQty, cartItemQty].forEach(input => {
            if (input) input.addEventListener('input', updateItemSubtotalPreview);
        });

        // Size Chips Selection Engine
        window.selectSizeChip = function (btn) {
            document.querySelectorAll('.size-chip-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const customWrap = document.getElementById('customSizeInputWrap');
            const badge = document.getElementById('selectedSizeBadge');
            const hiddenSize = document.getElementById('cartItemSize');

            if (btn.dataset.size === 'custom') {
                customWrap.style.display = 'block';
                const customInput = document.getElementById('customSizeInput');
                customInput.focus();
                const val = customInput.value.trim() || 'Custom';
                hiddenSize.value = val;
                if (badge) badge.textContent = val;
            } else {
                customWrap.style.display = 'none';
                hiddenSize.value = btn.dataset.size;
                if (badge) badge.textContent = btn.dataset.size;
            }
        };

        const customSizeInput = document.getElementById('customSizeInput');
        if (customSizeInput) {
            customSizeInput.addEventListener('input', function () {
                const val = this.value.trim() || 'Custom';
                document.getElementById('cartItemSize').value = val;
                const badge = document.getElementById('selectedSizeBadge');
                if (badge) badge.textContent = val;
            });
        }

        // Quantity Stepper Engine
        window.stepCartQty = function (delta) {
            const qtyInput = document.getElementById('cartItemQty');
            if (!qtyInput) return;
            let q = parseInt(qtyInput.value) || 1;
            q = Math.max(1, q + delta);
            qtyInput.value = q;
            updateItemSubtotalPreview();
        };

        // Toggle Item Note Input
        window.toggleItemNoteInput = function () {
            const wrap = document.getElementById('itemNoteInputWrap');
            const txt = document.getElementById('toggleItemNoteText');
            if (!wrap) return;
            const isHidden = (wrap.style.display === 'none' || wrap.style.display === '');
            wrap.style.display = isHidden ? 'block' : 'none';
            if (txt) {
                txt.textContent = isHidden ? '- Tutup Catatan Item' : '+ Tambah Catatan Khusus Item Ini';
            }
            if (isHidden) {
                const noteInput = document.getElementById('cartItemNote');
                if (noteInput) noteInput.focus();
            }
        };

        // Add Item to Cart
        if (btnAddToCart) {
            btnAddToCart.addEventListener('click', function () {
                const prodName = cartItemProduct.value;
                if (!prodName) {
                    alert('Pilih produk cetak terlebih dahulu!');
                    return;
                }

                const unitPrice = productPrices[prodName] || 0;
                let item = {};

                // Get Design from Section 1 (File Upload or GDrive Link)
                let itemFile = currentUploadedDesignFile;
                const fileInp = document.getElementById('ordFileUpload');
                if (!itemFile && fileInp && fileInp.files && fileInp.files[0]) {
                    itemFile = fileInp.files[0];
                }

                const linkInp = document.getElementById('ordFileDesain');
                const linkVal = linkInp ? linkInp.value.trim() : '';

                let designName = null;
                let designVal = null;
                if (itemFile) {
                    designName = itemFile.name;
                    designVal = itemFile.name;
                } else if (linkVal) {
                    designName = 'Link Google Drive';
                    designVal = linkVal;
                }

                if (cartToggleMeter.checked) {
                    const p = parseFloat(meterPanjang.value) || 1;
                    const l = parseFloat(meterLebar.value) || 1;
                    const q = parseInt(meterQty.value) || 1;
                    const luas = p * l;
                    const sub = Math.round(luas * unitPrice * q);

                    item = {
                        nama_produk: prodName,
                        ukuran: `${p} x ${l} Meter (${(luas * q).toFixed(1)} m²)`,
                        qty: q,
                        satuan: 'Meter',
                        harga: unitPrice,
                        subtotal: sub,
                        catatan: 'Ukuran Meteran: ' + p + ' x ' + l + ' m',
                        _fileObj: itemFile || null,
                        file_name: designName,
                        file_desain: designVal
                    };
                } else {
                    const q = parseInt(cartItemQty.value) || 1;
                    const sz = (cartItemSize ? cartItemSize.value.trim() : '') || 'A4 (21 x 29.7 cm)';
                    const u = cartItemUnit.value || 'Pcs';
                    const sub = Math.round(unitPrice * q);
                    const noteVal = cartItemNote ? cartItemNote.value.trim() : '';

                    item = {
                        nama_produk: prodName,
                        ukuran: sz,
                        qty: q,
                        satuan: u,
                        harga: unitPrice,
                        subtotal: sub,
                        catatan: noteVal,
                        _fileObj: itemFile || null,
                        file_name: designName,
                        file_desain: designVal
                    };
                }

                cartItems.push(item);
                renderCart();

                // Reset Section 1 File Desain Cetak so user can easily upload a NEW design for the next item
                window.removeSelectedFile();
                if (linkInp) linkInp.value = '';
                window.switchDesignSource('upload');
                currentUploadedDesignFile = null;

                // Reset sub-fields
                if (cartItemNote) cartItemNote.value = '';
                const noteWrap = document.getElementById('itemNoteInputWrap');
                if (noteWrap) noteWrap.style.display = 'none';
                const noteTxt = document.getElementById('toggleItemNoteText');
                if (noteTxt) noteTxt.textContent = '+ Tambah Catatan Khusus Item Ini';
                cartItemQty.value = 1;
            });
        }

        window.removeCartItem = function (index) {
            cartItems.splice(index, 1);
            renderCart();
        };

        function renderCart() {
            if (!cartTableBody) return;
            cartTableBody.innerHTML = '';

            if (cartItems.length === 0) {
                cartTableBody.innerHTML = `
                        <tr id="cartEmptyRow">
                            <td colspan="6" style="text-align: center; color: #94A3B8; padding: 22px;">
                                <span style="font-weight:600; color: #64748B; display: block; font-size: 12.5px;">Keranjang masih kosong</span>
                                <div style="font-size:11.5px; margin-top:3px; color: #94A3B8;">Pilih produk di atas lalu klik <strong>Tambah ke Keranjang</strong>.</div>
                            </td>
                        </tr>
                    `;
                cartTotalDisplay.textContent = 'Rp 0';
                cartCountBadge.textContent = '0 Item Ditambahkan';
                ordItemsJson.value = '';
                return;
            }

            let total = 0;
            cartItems.forEach((it, idx) => {
                total += it.subtotal;

                let designBadge = '<span style="font-size:11px; color:#94A3B8; font-style:italic;">Ikuti Master Order</span>';
                if (it._fileObj) {
                    designBadge = `<span class="cart-item-design-badge"><i class="fa-solid fa-file"></i> ${it._fileObj.name}</span>`;
                } else if (it.file_desain) {
                    if (it.file_desain.startsWith('http://') || it.file_desain.startsWith('https://')) {
                        designBadge = `<a href="${it.file_desain}" target="_blank" class="cart-item-design-badge" style="text-decoration:none;"><i class="fa-brands fa-google-drive"></i> Link Drive</a>`;
                    } else {
                        designBadge = `<span class="cart-item-design-badge"><i class="fa-solid fa-file"></i> ${it.file_name || it.file_desain}</span>`;
                    }
                }

                const tr = document.createElement('tr');
                tr.innerHTML = `
                        <td>
                            <div style="font-weight:700; color:#0F172A;">${it.nama_produk}</div>
                            ${it.catatan ? '<div style="font-size:11px; color:#64748B; margin-top:2px;">' + it.catatan + '</div>' : ''}
                        </td>
                        <td><span style="display:inline-block; padding:2px 8px; background:#F1F5F9; border-radius:6px; font-size:11.5px; font-weight:600; color:#475569; border:1px solid #E2E8F0;">${it.ukuran}</span></td>
                        <td style="font-weight:700; color:#1E293B;">${it.qty} ${it.satuan}</td>
                        <td>${designBadge}</td>
                        <td style="font-weight:700; color:#1E3A8A;">Rp ${it.subtotal.toLocaleString('id-ID')}</td>
                        <td style="text-align:right;">
                            <button type="button" onclick="removeCartItem(${idx})" style="width:28px; height:28px; border-radius:6px; background:#FEF2F2; border:1px solid #FEE2E2; color:#DC2626; cursor:pointer; display:inline-flex; align-items:center; justify-content:center; transition:all 0.15s;" title="Hapus Item">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                    `;
                cartTableBody.appendChild(tr);
            });

            cartTotalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
            cartCountBadge.textContent = cartItems.length + ' Item Ditambahkan';

            // Clean json for submission (strip DOM File object)
            const cleanItems = cartItems.map(item => {
                const copy = { ...item };
                delete copy._fileObj;
                return copy;
            });
            ordItemsJson.value = JSON.stringify(cleanItems);

            // Populate single-item fallbacks for backward compatibility
            if (cartItems.length > 0) {
                document.getElementById('ordFallbackProduct').value = cartItems[0].nama_produk;
                document.getElementById('ordFallbackTotal').value = total;
                document.getElementById('ordFallbackJumlah').value = cartItems[0].qty;
                document.getElementById('ordFallbackUnit').value = cartItems[0].satuan;
                document.getElementById('ordFallbackUkuran').value = cartItems[0].ukuran;
                document.getElementById('ordFallbackJumlahUkuran').value = cartItems[0].qty + ' ' + cartItems[0].satuan + ' (' + cartItems[0].ukuran + ')';
            }
        }

        window.addFinishingTag = function (tag) {
            const input = document.getElementById('ordCatatanFinishing');
            if (!input) return;
            const current = input.value.trim();
            if (current.includes(tag)) return;
            input.value = current ? current + ', ' + tag : tag;
        };

        // File Source Switcher & Anti-Spoofing Client Engine
        window.switchDesignSource = function (mode) {
            const tabUpload = document.getElementById('tabBtnUpload');
            const tabLink = document.getElementById('tabBtnLink');
            const boxUpload = document.getElementById('fileUploadContainer');
            const boxLink = document.getElementById('fileLinkContainer');

            if (mode === 'upload') {
                if (tabUpload) tabUpload.classList.add('active');
                if (tabLink) tabLink.classList.remove('active');
                if (boxUpload) boxUpload.style.display = 'block';
                if (boxLink) boxLink.style.display = 'none';
                const linkInp = document.getElementById('ordFileDesain');
                if (linkInp) linkInp.value = '';
            } else {
                if (tabLink) tabLink.classList.add('active');
                if (tabUpload) tabUpload.classList.remove('active');
                if (boxLink) boxLink.style.display = 'block';
                if (boxUpload) boxUpload.style.display = 'none';
                window.removeSelectedFile();
            }
        };

        window.removeSelectedFile = function () {
            currentUploadedDesignFile = null;
            const input = document.getElementById('ordFileUpload');
            if (input) input.value = '';
            const pBar = document.getElementById('filePreviewBar');
            if (pBar) pBar.style.display = 'none';
            const sErr = document.getElementById('fileSpoofError');
            if (sErr) sErr.style.display = 'none';
        };

        // Unified Anti-Spoofing & Deep Binary Inspection Engine for Design Files
        function verifyDesignFileClient(file, callback) {
            if (!file) return;

            const ext = (file.name.split('.').pop() || '').toLowerCase();
            const sizeFormatted = file.size > 1048576
                ? (file.size / 1048576).toFixed(2) + ' MB'
                : (file.size / 1024).toFixed(1) + ' KB';

            // 1. Cek ukuran file kosong / 0 bytes
            if (file.size <= 0) {
                callback({
                    valid: false,
                    message: `File '${file.name}' tidak valid (file kosong / 0 KB).`
                });
                return;
            }

            // 2. Batas maksimal 50 MB
            if (file.size > 52428800) {
                callback({
                    valid: false,
                    message: `Ukuran file '${file.name}' melebihi batas maksimal 50 MB.`
                });
                return;
            }

            const allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'pdf', 'tif', 'tiff', 'svg', 'ai', 'psd', 'cdr', 'zip'];
            if (!allowedExts.includes(ext)) {
                callback({
                    valid: false,
                    message: `Format '.${ext}' tidak didukung.`
                });
                return;
            }

            // 3. Binary Magic Byte & Structure Validation
            const reader = new FileReader();
            reader.onload = function (e) {
                const arr = new Uint8Array(e.target.result);
                if (arr.length < 4) {
                    callback({
                        valid: false,
                        message: `File '${file.name}' tidak valid.`
                    });
                    return;
                }

                // PNG Header Check: 89 50 4E 47 (\x89PNG)
                if (ext === 'png') {
                    if (!(arr[0] === 0x89 && arr[1] === 0x50 && arr[2] === 0x4E && arr[3] === 0x47)) {
                        callback({
                            valid: false,
                            message: `File '${file.name}' bukan gambar PNG yang valid.`
                        });
                        return;
                    }
                }

                // JPG/JPEG Header Check: FF D8 FF
                if (ext === 'jpg' || ext === 'jpeg') {
                    if (!(arr[0] === 0xFF && arr[1] === 0xD8 && arr[2] === 0xFF)) {
                        callback({
                            valid: false,
                            message: `File '${file.name}' bukan gambar JPG yang valid.`
                        });
                        return;
                    }
                }

                // PDF Header Check: 25 50 44 46 (%PDF)
                if (ext === 'pdf') {
                    if (!(arr[0] === 0x25 && arr[1] === 0x50 && arr[2] === 0x44 && arr[3] === 0x46)) {
                        callback({
                            valid: false,
                            message: `File '${file.name}' bukan dokumen PDF yang valid.`
                        });
                        return;
                    }
                }

                // ZIP Header Check: 50 4B (PK)
                if (ext === 'zip') {
                    if (!(arr[0] === 0x50 && arr[1] === 0x4B)) {
                        callback({
                            valid: false,
                            message: `File '${file.name}' bukan file ZIP yang valid.`
                        });
                        return;
                    }
                }

                // SVG Validation: verify XML <svg
                if (ext === 'svg') {
                    const textReader = new FileReader();
                    textReader.onload = function (te) {
                        const text = (te.target.result || '').toLowerCase();
                        if (!text.includes('<svg')) {
                            callback({
                                valid: false,
                                message: `File '${file.name}' bukan file SVG yang valid.`
                            });
                            return;
                        }
                        if (text.includes('<script') || text.includes('javascript:')) {
                            callback({
                                valid: false,
                                message: `File SVG '${file.name}' tidak diizinkan (mengandung script).`
                            });
                            return;
                        }
                        callback({
                            valid: true,
                            name: file.name,
                            info: `${sizeFormatted} • Vektor SVG Terverifikasi`,
                            icon: 'fa-file-code'
                        });
                    };
                    textReader.readAsText(file.slice(0, 4096));
                    return;
                }

                // Visual Image Decode Test for Bitmap (JPG, PNG, WEBP)
                if (['jpg', 'jpeg', 'png', 'webp'].includes(ext)) {
                    const objUrl = URL.createObjectURL(file);
                    const testImg = new Image();
                    testImg.onload = function () {
                        URL.revokeObjectURL(objUrl);
                        if (testImg.naturalWidth <= 0 || testImg.naturalHeight <= 0) {
                            callback({
                                valid: false,
                                message: `File '${file.name}' bukan gambar yang valid.`
                            });
                            return;
                        }
                        callback({
                            valid: true,
                            name: file.name,
                            info: `${sizeFormatted} (${testImg.naturalWidth}×${testImg.naturalHeight}px) • Terverifikasi`,
                            icon: 'fa-file-image'
                        });
                    };
                    testImg.onerror = function () {
                        URL.revokeObjectURL(objUrl);
                        callback({
                            valid: false,
                            message: `File '${file.name}' bukan gambar yang valid.`
                        });
                    };
                    testImg.src = objUrl;
                    return;
                }

                // Other design files (TIFF, PSD, AI, CDR)
                let icon = 'fa-file';
                if (['tif', 'tiff', 'psd'].includes(ext)) icon = 'fa-file-image';
                else if (['ai', 'cdr'].includes(ext)) icon = 'fa-file-pen';
                else if (ext === 'pdf') icon = 'fa-file-pdf';
                else if (ext === 'zip') icon = 'fa-file-zipper';

                callback({
                    valid: true,
                    name: file.name,
                    info: `${sizeFormatted} • Terverifikasi`,
                    icon: icon
                });
            };

            reader.readAsArrayBuffer(file.slice(0, 16));
        }

        window.validateAndPreviewFile = function (input) {
            const file = input.files[0];
            if (!file) return;

            const previewBar = document.getElementById('filePreviewBar');
            const spoofAlert = document.getElementById('fileSpoofError');
            const spoofMsg = document.getElementById('fileSpoofErrorMsg');
            const nameEl = document.getElementById('filePreviewName');
            const sizeEl = document.getElementById('filePreviewSize');
            const iconEl = document.getElementById('filePreviewIcon');

            verifyDesignFileClient(file, function (res) {
                if (!res.valid) {
                    currentUploadedDesignFile = null;
                    if (spoofAlert) {
                        spoofAlert.style.display = 'block';
                        spoofMsg.textContent = res.message;
                    }
                    if (previewBar) previewBar.style.display = 'none';
                    input.value = '';
                } else {
                    currentUploadedDesignFile = file;
                    if (spoofAlert) spoofAlert.style.display = 'none';
                    if (previewBar) previewBar.style.display = 'flex';
                    if (nameEl) nameEl.textContent = res.name;
                    if (sizeEl) sizeEl.textContent = res.info;
                    if (iconEl) iconEl.className = 'fa-solid ' + res.icon;
                }
            });
        };

        // Modal Toggles
        if (openBtn) {
            openBtn.addEventListener('click', () => {
                addOrderForm.reset();
                cartItems = [];
                currentUploadedDesignFile = null;
                renderCart();
                cartToggleMeter.checked = false;
                toggleMeterView();
                window.switchDesignSource('upload');
                window.removeSelectedFile();
                modalOverlay.classList.add('active');
            });
        }
        if (closeBtn) closeBtn.addEventListener('click', () => modalOverlay.classList.remove('active'));
        if (cancelBtn) cancelBtn.addEventListener('click', () => modalOverlay.classList.remove('active'));

        // Auto-check customer from URL param
        const urlParams = new URLSearchParams(window.location.search);
        const prefillCust = urlParams.get('pelanggan');
        if (prefillCust && openBtn) {
            openBtn.click();
            const cInput = document.getElementById('ordCustomer');
            if (cInput) cInput.value = prefillCust;
        }

        // 2. STATUS UPDATE MODAL
        const statusModalOverlay = document.getElementById('statusModalOverlay');
        window.openStatusModal = function (p) {
            if (!statusModalOverlay) return;
            document.getElementById('statusUpdateForm').action = '/pesanan/' + p.id;
            document.getElementById('stModalKode').textContent = p.kode_pesanan;
            document.getElementById('stModalPelanggan').textContent = p.nama_pelanggan;
            document.getElementById('stStatusSelect').value = p.status || 'Antrean Cetak';
            document.getElementById('stCatatanFinishing').value = p.catatan_finishing || '';
            document.getElementById('stFileDesain').value = p.file_desain || '';
            document.getElementById('stFileUpload').value = '';
            
            const chosenText = document.getElementById('stFileChosenText');
            if (chosenText) chosenText.style.display = 'none';
            const spoofAlert = document.getElementById('stFileSpoofError');
            if (spoofAlert) spoofAlert.style.display = 'none';

            const curWrap = document.getElementById('stCurrentFileWrap');
            const curLink = document.getElementById('stCurrentFileLink');
            if (p.file_desain) {
                const fUrl = (p.file_desain.startsWith('http://') || p.file_desain.startsWith('https://'))
                    ? p.file_desain
                    : (p.file_desain.startsWith('/') ? p.file_desain : '/' + p.file_desain);
                curLink.href = fUrl;
                curWrap.style.display = 'block';
            } else {
                curWrap.style.display = 'none';
            }

            // Multi-Item Design Editor in Status Modal
            const multiSec = document.getElementById('stMultiItemsSection');
            const multiList = document.getElementById('stMultiItemsList');
            if (multiSec && multiList) {
                if (Array.isArray(p.detail_items) && p.detail_items.length > 1) {
                    multiSec.style.display = 'block';
                    multiList.innerHTML = '';
                    p.detail_items.forEach((it, idx) => {
                        const itemCard = document.createElement('div');
                        itemCard.style.cssText = 'background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 10px 12px;';
                        
                        let currentFileBadge = '';
                        if (it.file_desain) {
                            const fUrl = (it.file_desain.startsWith('http://') || it.file_desain.startsWith('https://'))
                                ? it.file_desain
                                : (it.file_desain.startsWith('/') ? it.file_desain : '/' + it.file_desain);
                            currentFileBadge = `<a href="${fUrl}" target="_blank" style="font-size: 11px; color: #2563EB; font-weight: 700; text-decoration: none;"><i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Desain Item</a>`;
                        } else {
                            currentFileBadge = '<span style="font-size: 11px; color: #94A3B8;">(Belum ada desain khusus)</span>';
                        }

                        itemCard.innerHTML = `
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                <div style="font-size: 12px; font-weight: 700; color: #1E293B;">
                                    ${idx + 1}. ${it.nama_produk} <span style="font-weight: 500; color: #64748B;">(${it.ukuran || 'Standard'}, ${it.qty} ${it.satuan || 'Pcs'})</span>
                                </div>
                                <div>${currentFileBadge}</div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                                <div>
                                    <label style="font-size: 10.5px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Upload File Baru</label>
                                    <input type="file" name="item_file_${idx}" accept=".jpg,.jpeg,.png,.webp,.pdf,.tif,.tiff,.svg,.ai,.psd,.cdr,.zip" style="font-size: 11px; width: 100%;">
                                </div>
                                <div>
                                    <label style="font-size: 10.5px; font-weight: 700; color: #64748B; display: block; margin-bottom: 3px;">Atau Link GDrive Baru</label>
                                    <input type="text" name="item_link_${idx}" placeholder="https://drive.google.com/..." value="${(it.file_desain && it.file_desain.startsWith('http')) ? it.file_desain : ''}" style="font-size: 11.5px; width: 100%; border: 1px solid #CBD5E1; border-radius: 6px; padding: 4px 8px;">
                                </div>
                            </div>
                        `;
                        multiList.appendChild(itemCard);
                    });
                } else {
                    multiSec.style.display = 'none';
                    multiList.innerHTML = '';
                }
            }

            statusModalOverlay.classList.add('active');
        };
        window.closeStatusModal = function () {
            if (statusModalOverlay) statusModalOverlay.classList.remove('active');
        };

        window.handleStatusFileUpload = function (input) {
            const file = input.files[0];
            if (!file) return;

            const chosenText = document.getElementById('stFileChosenText');
            const chosenName = document.getElementById('stFileChosenName');
            const chosenIcon = document.getElementById('stFileChosenIcon');
            const spoofAlert = document.getElementById('stFileSpoofError');
            const spoofMsg = document.getElementById('stFileSpoofErrorMsg');

            verifyDesignFileClient(file, function (res) {
                if (!res.valid) {
                    if (spoofAlert) {
                        spoofAlert.style.display = 'block';
                        spoofMsg.textContent = res.message;
                    }
                    if (chosenText) chosenText.style.display = 'none';
                    input.value = '';
                } else {
                    if (spoofAlert) spoofAlert.style.display = 'none';
                    if (chosenText) chosenText.style.display = 'block';
                    if (chosenName) chosenName.textContent = res.name + ' (' + res.info + ')';
                    if (chosenIcon) chosenIcon.className = 'fa-solid ' + res.icon;
                }
            });
        };

        // 3. SPK & NOTA MODAL
        const spkModalOverlay = document.getElementById('spkModalOverlay');
        window.viewSpkDetail = function (p) {
            if (!spkModalOverlay) return;
            document.getElementById('spkKodePesanan').textContent = p.kode_pesanan;
            document.getElementById('spkTglPesanan').textContent = p.tanggal_pesan ? p.tanggal_pesan : (p.created_at ? p.created_at.substring(0, 10) : '-');
            document.getElementById('spkPelanggan').textContent = p.nama_pelanggan;
            document.getElementById('spkStatusProduksi').textContent = p.status || 'Antrean Cetak';

            const isLunas = (p.status_pembayaran || '').toLowerCase() === 'lunas' || (p.status || '').toLowerCase() === 'selesai';
            const spkBadge = document.getElementById('spkStatusBadge');
            spkBadge.textContent = isLunas ? 'LUNAS' : (p.status_pembayaran || 'BELUM LUNAS');
            spkBadge.style.background = isLunas ? '#DCFCE7' : '#FEF3C7';
            spkBadge.style.color = isLunas ? '#166534' : '#92400E';

            const fLink = document.getElementById('spkFileDesainLink');
            const fWrap = document.getElementById('spkFileDesainWrapper');
            if (p.file_desain) {
                const fUrl = (p.file_desain.startsWith('http://') || p.file_desain.startsWith('https://'))
                    ? p.file_desain
                    : (p.file_desain.startsWith('/') ? p.file_desain : '/' + p.file_desain);
                fLink.href = fUrl;
                fWrap.style.display = 'block';
            } else {
                fWrap.style.display = 'none';
            }

            document.getElementById('spkFinishingNote').textContent = p.catatan_finishing || 'Standar percetakan tanpa finishing khusus.';
            document.getElementById('spkTotalHarga').textContent = 'Rp ' + (parseFloat(p.total_harga) || 0).toLocaleString('id-ID');
            document.getElementById('spkStatusBayarText').textContent = isLunas ? 'Lunas' : (p.status_pembayaran || 'DP');
            document.getElementById('spkSisaBayar').textContent = 'Rp ' + (parseFloat(p.sisa_bayar) || (isLunas ? 0 : p.total_harga)).toLocaleString('id-ID');

            // Render Items inside SPK table
            const tbody = document.getElementById('spkItemsTableBody');
            tbody.innerHTML = '';
            let itemsList = [];
            if (Array.isArray(p.detail_items) && p.detail_items.length > 0) {
                itemsList = p.detail_items;
            } else {
                itemsList = [{
                    nama_produk: p.nama_produk,
                    ukuran: p.jumlah_ukuran || 'Standard',
                    qty: 1,
                    satuan: '',
                    subtotal: p.total_harga,
                    file_desain: p.file_desain
                }];
            }

            itemsList.forEach((it, idx) => {
                const tr = document.createElement('tr');
                tr.style.borderBottom = '1px solid #E2E8F0';

                let dLinkHtml = '<span style="color:#94A3B8; font-size:11px;">Ikuti Order</span>';
                const fPath = it.file_desain || p.file_desain;
                if (fPath) {
                    const fUrl = (fPath.startsWith('http://') || fPath.startsWith('https://'))
                        ? fPath
                        : (fPath.startsWith('/') ? fPath : '/' + fPath);
                    dLinkHtml = `<a href="${fUrl}" target="_blank" style="color:#2563EB; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:3px;"><i class="fa-solid fa-file-arrow-down"></i> Buka File</a>`;
                }

                tr.innerHTML = `
                        <td style="padding: 6px 10px;">${idx + 1}</td>
                        <td style="padding: 6px 10px;">
                            <strong>${it.nama_produk}</strong>
                            ${it.catatan ? '<div style="font-size:10.5px; color:#64748B;">' + it.catatan + '</div>' : ''}
                        </td>
                        <td style="padding: 6px 10px;">${it.ukuran || '-'}</td>
                        <td style="padding: 6px 10px; text-align: center;">${it.qty || 1} ${it.satuan || ''}</td>
                        <td style="padding: 6px 10px;">${dLinkHtml}</td>
                        <td style="padding: 6px 10px; text-align: right; font-weight: 700;">Rp ${(parseFloat(it.subtotal) || 0).toLocaleString('id-ID')}</td>
                    `;
                tbody.appendChild(tr);
            });

            spkModalOverlay.classList.add('active');
        };
        window.closeSpkModal = function () {
            if (spkModalOverlay) spkModalOverlay.classList.remove('active');
        };

        // 4. QUICK SETTLEMENT (PELUNASAN CEPAT) MODAL
        const pelunasanModalOverlay = document.getElementById('pelunasanModalOverlay');
        const pelunasanJumlah = document.getElementById('pelunasanJumlah');
        const pelunasanUangDiterima = document.getElementById('pelunasanUangDiterima');
        const pelunasanKembalianDisplay = document.getElementById('pelunasanKembalianDisplay');

        window.openPelunasanModal = function (p) {
            if (!pelunasanModalOverlay) return;
            const sisa = parseFloat(p.sisa_bayar) || parseFloat(p.total_harga) || 0;
            document.getElementById('pelunasanKodePesanan').value = p.kode_pesanan;
            document.getElementById('pelunasanDisplayKode').textContent = p.kode_pesanan;
            document.getElementById('pelunasanDisplayPelanggan').textContent = p.nama_pelanggan;
            document.getElementById('pelunasanDisplaySisa').textContent = 'Rp ' + sisa.toLocaleString('id-ID');
            pelunasanJumlah.value = sisa;
            pelunasanJumlah.max = sisa;
            pelunasanUangDiterima.value = sisa;
            calcPelunasanChange();
            pelunasanModalOverlay.classList.add('active');
        };

        function calcPelunasanChange() {
            const bayar = parseFloat(pelunasanJumlah.value) || 0;
            const uang = parseFloat(pelunasanUangDiterima.value) || 0;
            const diff = uang - bayar;
            if (diff >= 0) {
                pelunasanKembalianDisplay.style.color = '#16A34A';
                pelunasanKembalianDisplay.style.background = '#DCFCE7';
                pelunasanKembalianDisplay.textContent = 'Kembalian: Rp ' + diff.toLocaleString('id-ID');
            } else {
                pelunasanKembalianDisplay.style.color = '#DC2626';
                pelunasanKembalianDisplay.style.background = '#FEE2E2';
                pelunasanKembalianDisplay.textContent = 'Kurang: Rp ' + Math.abs(diff).toLocaleString('id-ID');
            }
        }

        if (pelunasanJumlah) pelunasanJumlah.addEventListener('input', calcPelunasanChange);
        if (pelunasanUangDiterima) pelunasanUangDiterima.addEventListener('input', calcPelunasanChange);

        window.setPelunasanChip = function (nominal) {
            const bayar = parseFloat(pelunasanJumlah.value) || 0;
            if (nominal === 'pas') {
                pelunasanUangDiterima.value = bayar;
            } else {
                pelunasanUangDiterima.value = nominal;
            }
            calcPelunasanChange();
        };

        window.closePelunasanModal = function () {
            if (pelunasanModalOverlay) pelunasanModalOverlay.classList.remove('active');
        };

        // Form Submit Safety & Dynamic Item File Attachment
        if (addOrderForm) {
            addOrderForm.addEventListener('submit', function (e) {
                if (cartItems.length === 0) {
                    e.preventDefault();
                    alert('Silakan tambahkan minimal 1 item ke keranjang cetak sebelum menyimpan pesanan!');
                    return false;
                }

                // Validasi Wajib Desain (File Upload Laptop, Link GDrive, atau File per Item)
                const masterFileInp = document.getElementById('ordFileUpload');
                const masterLinkInp = document.getElementById('ordFileDesain');
                const hasMasterUpload = Boolean(currentUploadedDesignFile instanceof File) || Boolean(masterFileInp && masterFileInp.files && masterFileInp.files.length > 0);
                const hasMasterLink = Boolean(masterLinkInp && masterLinkInp.value.trim());
                const hasItemDesign = cartItems.some(it => Boolean(it._fileObj instanceof File) || Boolean(it.file_desain && String(it.file_desain).trim()));

                if (!hasMasterUpload && !hasMasterLink && !hasItemDesign) {
                    e.preventDefault();
                    alert('Pesanan belum memiliki file desain!\n\nSilakan upload file desain dari laptop atau cantumkan link Google Drive pada Bagian 1 sebelum menyimpan pesanan.');
                    const dropzone = document.querySelector('.file-upload-dropzone') || masterLinkInp;
                    if (dropzone) {
                        dropzone.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        dropzone.style.outline = '2px dashed #DC2626';
                        setTimeout(() => { dropzone.style.outline = ''; }, 3500);
                    }
                    return false;
                }

                // Remove previous dynamic item file inputs if any
                document.querySelectorAll('.dynamic-item-file-input').forEach(el => el.remove());

                // Create DataTransfer inputs for each item that has an uploaded File
                cartItems.forEach((it, idx) => {
                    if (it._fileObj instanceof File) {
                        const dt = new DataTransfer();
                        dt.items.add(it._fileObj);
                        const fileInp = document.createElement('input');
                        fileInp.type = 'file';
                        fileInp.name = `item_file_${idx}`;
                        fileInp.className = 'dynamic-item-file-input';
                        fileInp.style.display = 'none';
                        fileInp.files = dt.files;
                        addOrderForm.appendChild(fileInp);
                    }
                });

                // Clean JSON payload
                const cleanItems = cartItems.map(item => {
                    const copy = { ...item };
                    delete copy._fileObj;
                    return copy;
                });
                ordItemsJson.value = JSON.stringify(cleanItems);
            });
        }

        // Dropdown Toggle
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

        // Multi-Item Popover Handler
        const multiItemPopover = document.getElementById('multiItemPopover');
        const popoverOrderCode = document.getElementById('popoverOrderCode');
        const popoverCountBadge = document.getElementById('popoverItemCountBadge');
        const popoverItemsList = document.getElementById('popoverItemsList');
        const popoverTotalText = document.getElementById('popoverTotalText');
        const popoverSpkBtn = document.getElementById('popoverSpkBtn');
        let currentActiveBtn = null;

        window.toggleItemsPopover = function (e, btn, items, kodePesanan, totalHarga, pesananObj) {
            e.stopPropagation();
            if (!multiItemPopover) return;

            if (currentActiveBtn === btn && multiItemPopover.style.display === 'flex') {
                closeMultiItemPopover();
                return;
            }

            if (currentActiveBtn) {
                currentActiveBtn.classList.remove('active');
            }

            currentActiveBtn = btn;
            btn.classList.add('active');

            popoverOrderCode.textContent = kodePesanan;
            const totalItems = Array.isArray(items) ? items.length : 0;
            popoverCountBadge.textContent = `${totalItems} Produk`;
            popoverTotalText.textContent = 'Rp ' + (parseFloat(totalHarga) || 0).toLocaleString('id-ID');

            popoverSpkBtn.onclick = function () {
                closeMultiItemPopover();
                if (window.viewSpkDetail && pesananObj) {
                    window.viewSpkDetail(pesananObj);
                }
            };

            // Render items inside popover
            popoverItemsList.innerHTML = '';
            if (Array.isArray(items) && items.length > 0) {
                items.forEach((it, idx) => {
                    const isMain = idx === 0;
                    const card = document.createElement('div');
                    card.className = `popover-item-card ${isMain ? 'is-main' : ''}`;

                    const ukuranText = it.ukuran ? ` • ${it.ukuran}` : '';
                    const qtyText = `${it.qty || 1} ${it.satuan || 'Pcs'}${ukuranText}`;
                    const subtotalVal = parseFloat(it.subtotal || it.harga || 0);

                    // Design file badge/link
                    let designInfoHtml = '';
                    const itemDesign = it.file_desain || (pesananObj && pesananObj.file_desain ? pesananObj.file_desain : null);
                    if (itemDesign) {
                        const fUrl = (itemDesign.startsWith('http://') || itemDesign.startsWith('https://'))
                            ? itemDesign
                            : (itemDesign.startsWith('/') ? itemDesign : '/' + itemDesign);
                        designInfoHtml = `
                            <div style="margin-top: 5px; display: flex; align-items: center; justify-content: space-between; font-size: 11px; background: #F8FAFC; padding: 3px 8px; border-radius: 5px; border: 1px solid #E2E8F0;">
                                <span style="color: #475569;"><i class="fa-solid fa-file-image" style="color:#2563EB;"></i> Desain:</span>
                                <a href="${fUrl}" target="_blank" onclick="event.stopPropagation();" style="color: #2563EB; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                    Buka File <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 10px;"></i>
                                </a>
                            </div>
                        `;
                    }

                    card.innerHTML = `
                            <div class="popover-item-title-row">
                                <span class="popover-item-name">${idx + 1}. ${it.nama_produk}</span>
                                <span class="popover-item-badge ${isMain ? 'main' : 'extra'}">
                                    ${isMain ? 'Produk Utama' : 'Item ' + (idx + 1)}
                                </span>
                            </div>
                            <div class="popover-item-meta-row">
                                <span>${qtyText}</span>
                                <span class="popover-item-subtotal">Rp ${subtotalVal.toLocaleString('id-ID')}</span>
                            </div>
                            ${designInfoHtml}
                        `;
                    popoverItemsList.appendChild(card);
                });
            } else {
                popoverItemsList.innerHTML = '<div style="font-size:12px; color:#94A3B8; text-align:center; padding:12px;">Tidak ada rincian item.</div>';
            }

            // Show popover to calculate dimensions
            multiItemPopover.style.display = 'flex';

            // Position dynamically using getBoundingClientRect()
            const rect = btn.getBoundingClientRect();
            const popoverWidth = multiItemPopover.offsetWidth || 340;
            const popoverHeight = multiItemPopover.offsetHeight || 260;

            let left = rect.left;
            if (left + popoverWidth > window.innerWidth - 12) {
                left = window.innerWidth - popoverWidth - 12;
            }
            left = Math.max(12, left);

            let top = rect.bottom + 6;
            if (top + popoverHeight > window.innerHeight - 12 && rect.top > popoverHeight + 12) {
                top = rect.top - popoverHeight - 6;
            }
            top = Math.max(12, top);

            multiItemPopover.style.top = `${top}px`;
            multiItemPopover.style.left = `${left}px`;
        };

        window.closeMultiItemPopover = function () {
            if (!multiItemPopover) return;
            multiItemPopover.style.display = 'none';
            if (currentActiveBtn) {
                currentActiveBtn.classList.remove('active');
                currentActiveBtn = null;
            }
        };

        // Close popover when clicking anywhere outside
        document.addEventListener('click', function (e) {
            if (multiItemPopover && multiItemPopover.style.display === 'flex') {
                if (!multiItemPopover.contains(e.target) && (!currentActiveBtn || !currentActiveBtn.contains(e.target))) {
                    closeMultiItemPopover();
                }
            }
        });

        // 5. DESIGN GALLERY MODAL (MULTI-ITEM & SINGLE-ITEM DESIGN VIEWER)
        const galleryModalOverlay = document.getElementById('designGalleryModalOverlay');
        const galleryTitleCode = document.getElementById('galleryKodePesanan');
        const galleryModalHeadingText = document.getElementById('galleryModalHeadingText');
        const galleryModalTitleIcon = document.getElementById('galleryModalTitleIcon');
        const galleryModalSubtitle = document.getElementById('galleryModalSubtitle');
        const galleryContainer = document.getElementById('galleryItemsContainer');

        window.openDesignGalleryModal = function (items, kodePesanan, masterFile, pesananObj) {
            if (!galleryModalOverlay || !galleryContainer) return;

            galleryTitleCode.textContent = kodePesanan;
            galleryContainer.innerHTML = '';

            let itemsList = [];
            if (Array.isArray(items) && items.length > 0) {
                itemsList = items;
            } else if (pesananObj) {
                itemsList = [{
                    nama_produk: pesananObj.nama_produk ? pesananObj.nama_produk.replace(/\s*\(\+\s*\d+\s*produk lainnya\)/i, '') : 'Produk Utama',
                    ukuran: pesananObj.jumlah_ukuran || 'Standard',
                    qty: 1,
                    satuan: '',
                    file_desain: masterFile || pesananObj.file_desain
                }];
            } else if (masterFile) {
                itemsList = [{
                    nama_produk: 'Produk Utama',
                    ukuran: 'Standard',
                    qty: 1,
                    satuan: 'Pcs',
                    file_desain: masterFile
                }];
            }

            const isSingle = itemsList.length <= 1;

            if (galleryModalHeadingText) {
                galleryModalHeadingText.textContent = isSingle ? 'Preview File Desain' : 'Galeri File Desain';
            }
            if (galleryModalTitleIcon) {
                galleryModalTitleIcon.className = isSingle ? 'fa-solid fa-image' : 'fa-solid fa-images';
            }
            if (galleryModalSubtitle) {
                galleryModalSubtitle.textContent = isSingle
                    ? 'File desain cetak yang dilampirkan pada pesanan ini:'
                    : `Semua file desain cetak yang dilampirkan untuk masing-masing item pada pesanan ini (${itemsList.length} item):`;
            }

            galleryContainer.className = isSingle ? 'gallery-grid is-single' : 'gallery-grid';

            itemsList.forEach((it, idx) => {
                const fPath = it.file_desain || masterFile || (pesananObj ? pesananObj.file_desain : null);
                const card = document.createElement('div');
                card.className = 'gallery-card';

                let thumbHtml = '';
                let btnHtml = '';

                if (fPath) {
                    const fUrl = (fPath.startsWith('http://') || fPath.startsWith('https://'))
                        ? fPath
                        : (fPath.startsWith('/') ? fPath : '/' + fPath);

                    const isImage = /\.(jpg|jpeg|png|webp|gif|svg)$/i.test(fPath);
                    const isDrive = (fPath.startsWith('http://') || fPath.startsWith('https://'));

                    if (isImage) {
                        thumbHtml = `
                            <a href="${fUrl}" target="_blank" title="Klik untuk memperbesar / buka file" style="display:flex; align-items:center; justify-content:center; width:100%; height:100%; text-decoration:none;">
                                <img src="${fUrl}" alt="Desain ${it.nama_produk || 'Item'}" class="gallery-thumb-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div style="display:none; align-items:center; justify-content:center; width:100%; height:100%; color:#2563EB; font-size:36px;">
                                    <i class="fa-solid fa-file-image"></i>
                                </div>
                            </a>
                        `;
                    } else if (isDrive) {
                        thumbHtml = `
                            <a href="${fUrl}" target="_blank" title="Buka di Google Drive" style="display:flex; flex-direction:column; align-items:center; justify-content:center; width:100%; height:100%; color:#0284C7; gap:6px; text-decoration:none;">
                                <i class="fa-brands fa-google-drive" style="font-size:36px;"></i>
                                <span style="font-size:11px; font-weight:700;">Google Drive</span>
                            </a>
                        `;
                    } else {
                        const ext = (fPath.split('.').pop() || 'FILE').toUpperCase();
                        thumbHtml = `
                            <a href="${fUrl}" target="_blank" title="Buka / Download File" style="display:flex; flex-direction:column; align-items:center; justify-content:center; width:100%; height:100%; color:#2563EB; gap:6px; text-decoration:none;">
                                <i class="fa-solid fa-file-lines" style="font-size:36px;"></i>
                                <span style="font-size:11px; font-weight:700;">${ext}</span>
                            </a>
                        `;
                    }

                    btnHtml = `
                        <a href="${fUrl}" target="_blank" class="gallery-card-btn">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka File Desain
                        </a>
                    `;
                } else {
                    thumbHtml = `<div style="display:flex; align-items:center; justify-content:center; width:100%; height:100%; color:#94A3B8; font-size:11.5px; font-weight:600;">Tidak ada file desain</div>`;
                    btnHtml = `<span style="font-size:11px; color:#94A3B8; text-align:center; padding:6px; background:#F8FAFC; border-radius:6px;">Tanpa Desain</span>`;
                }

                const itemBadgeLabel = isSingle ? 'Desain Produk' : `Item ${idx + 1}`;
                let metaParts = [];
                if (it.ukuran && it.ukuran !== '-') metaParts.push(it.ukuran);
                if (it.qty) metaParts.push(`${it.qty} ${it.satuan || 'Pcs'}`.trim());
                const metaString = metaParts.join(' • ') || 'Standard';

                card.innerHTML = `
                    <div class="gallery-thumb-wrap">
                        ${thumbHtml}
                        <span style="position:absolute; top:8px; left:8px; background:rgba(15, 23, 42, 0.75); color:#fff; font-size:10px; font-weight:800; padding:2px 6px; border-radius:4px;">${itemBadgeLabel}</span>
                    </div>
                    <div class="gallery-card-body">
                        <div class="gallery-card-title">${it.nama_produk || 'Produk Cetak'}</div>
                        <div class="gallery-card-meta">${metaString}</div>
                        ${btnHtml}
                    </div>
                `;
                galleryContainer.appendChild(card);
            });

            galleryModalOverlay.classList.add('active');
        };

        window.closeDesignGalleryModal = function () {
            if (galleryModalOverlay) galleryModalOverlay.classList.remove('active');
        };

        if (galleryModalOverlay) {
            galleryModalOverlay.addEventListener('click', function (e) {
                if (e.target === galleryModalOverlay) {
                    closeDesignGalleryModal();
                }
            });
        }

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeMultiItemPopover();
                closeDesignGalleryModal();
            }
        });

        // Close on window resize or scroll
        window.addEventListener('resize', closeMultiItemPopover);
        });
    </script>
    @include('layouts.navbar_assets')
</body>

</html>