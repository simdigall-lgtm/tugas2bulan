<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan & Statistik - SIPEKAN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',-apple-system,BlinkMacSystemFont,sans-serif; }
        html, body { max-width: 100vw; overflow-x: clip; }
        body { background-color:#F8FAFC; color:#1E293B; display:flex; min-height:100vh; }

        .sidebar { width:210px; background:#FFFFFF; border-right:1px solid #E2E8F0; display:flex; flex-direction:column; justify-content:space-between; position:fixed; top:0; bottom:0; left:0; z-index:100; }
        .sidebar-brand { padding:18px 16px 14px; }
        .brand-name { font-size:18px; font-weight:800; color:#1E3A8A; letter-spacing:-0.3px; }
        .brand-tag { font-size:11px; font-weight:500; color:#64748B; margin-top:1px; }
        .sidebar-menu { padding:10px 10px; display:flex; flex-direction:column; gap:3px; flex:1; }
        .menu-item { display:flex; align-items:center; gap:10px; padding:9px 12px; border-radius:8px; color:#475569; text-decoration:none; font-size:13.5px; font-weight:600; transition:all 0.2s ease; }
        .menu-item:hover { background-color:#F1F5F9; color:#1E3A8A; }
        .menu-item.active { background-color:#EEF2FF; color:#1E3A8A; font-weight:700; }
        .menu-item i { font-size:15px; width:18px; text-align:center; }
        .sidebar-bottom { padding:12px 10px 16px; border-top:1px dashed #E2E8F0; display:flex; flex-direction:column; gap:3px; }

        .main-wrapper { margin-left:210px; width:calc(100% - 210px); max-width:calc(100vw - 210px); flex:1; display:flex; flex-direction:column; min-width:0; }
        .topbar { height:64px; background:#FFFFFF; border-bottom:1px solid #E2E8F0; display:flex; align-items:center; justify-content:space-between; padding:0 24px; position:sticky; top:0; z-index:100; max-width:100%; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05); }
        .search-container { position:relative; width:300px; }
        .search-icon { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#94A3B8; font-size:14px; }
        .search-input { width:100%; background:#F1F5F9; border:1px solid transparent; border-radius:8px; padding:9px 14px 9px 38px; font-size:13.5px; color:#1E293B; outline:none; }
        .topbar-right { display:flex; align-items:center; gap:20px; }
        .icon-btn { background:none; border:none; color:#64748B; font-size:17px; cursor:pointer; padding:6px; border-radius:50%; }
        .avatar-img { width:36px; height:36px; border-radius:50%; object-fit:cover; border:1.5px solid #E2E8F0; }

        .content-body { padding:20px 24px; flex:1; min-width:0; max-width:100%; }

        .page-title { font-size:26px; font-weight:800; color:#0F172A; letter-spacing:-0.5px; }
        .page-subtitle { font-size:14px; color:#64748B; margin-top:4px; }

        /* Filter Card - Refined Modern Toolbar Layout */
        .filter-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        /* Top Row: Presets on Left, Exports on Right */
        .filter-row-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }
        .filter-preset-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .filter-section-title {
            font-size: 11.5px;
            font-weight: 800;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .segmented-filter-container {
            display: inline-flex;
            align-items: center;
            background: #F1F5F9;
            padding: 3.5px;
            border-radius: 10px;
            gap: 3px;
            border: 1px solid #E2E8F0;
        }
        .btn-segmented {
            padding: 6px 13px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 700;
            color: #475569;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
            white-space: nowrap;
            border: none;
            background: transparent;
            cursor: pointer;
        }
        .btn-segmented:hover {
            color: #1E3A8A;
            background: rgba(255, 255, 255, 0.7);
        }
        .btn-segmented.active {
            background: #1B3B6F !important;
            color: #FFFFFF !important;
            box-shadow: 0 2px 5px rgba(27, 59, 111, 0.22);
        }

        /* Export Actions on Top Right */
        .export-actions-group {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .btn-export {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid #CBD5E1;
            background: #FFFFFF;
            color: #334155;
            transition: all 0.15s ease;
            white-space: nowrap;
            height: 36px;
        }
        .btn-export:hover {
            background: #F8FAFC;
            border-color: #94A3B8;
            color: #0F172A;
        }
        .btn-export.primary {
            background: #1B3B6F;
            border-color: #1B3B6F;
            color: #FFFFFF;
        }
        .btn-export.primary:hover {
            background: #142F5B;
        }

        /* Export As Dropdown Engine */
        .export-dropdown-wrapper {
            position: relative;
            display: inline-block;
        }

        .export-dropdown-menu {
            position: absolute;
            top: calc(100% + 6px);
            right: 0;
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.12), 0 8px 10px -6px rgba(15, 23, 42, 0.06);
            padding: 6px;
            min-width: 240px;
            z-index: 100;
            display: none;
            flex-direction: column;
            gap: 3px;
            animation: dropdownFadeIn 0.18s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-6px) scale(0.97);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .export-dropdown-menu.show {
            display: flex;
        }

        .export-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 8px;
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
            width: 100%;
            transition: all 0.15s ease;
        }

        .export-dropdown-item:hover {
            background: #F8FAFC;
        }

        .export-item-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .export-item-icon.excel {
            background: #ECFDF5;
            color: #059669;
            border: 1px solid #A7F3D0;
        }

        .export-item-icon.csv {
            background: #F0F9FF;
            color: #0284C7;
            border: 1px solid #BAE6FD;
        }

        .export-item-icon.pdf {
            background: #EEF2FF;
            color: #4F46E5;
            border: 1px solid #C7D2FE;
        }

        .export-item-text {
            flex: 1;
            min-width: 0;
        }

        .export-item-title {
            font-size: 12.5px;
            font-weight: 700;
            color: #0F172A;
            line-height: 1.25;
        }

        .export-item-desc {
            font-size: 10.5px;
            color: #64748B;
            margin-top: 1px;
        }

        .export-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            letter-spacing: 0.3px;
        }

        .export-badge.excel {
            background: #DCFCE7;
            color: #166534;
        }

        .export-badge.csv {
            background: #E0F2FE;
            color: #0369A1;
        }

        .export-badge.pdf {
            background: #E0E7FF;
            color: #3730A3;
        }

        .export-dropdown-divider {
            height: 1px;
            background: #F1F5F9;
            margin: 3px 0;
        }

        /* Divider between Rows */
        .filter-divider {
            height: 1px;
            background: #F1F5F9;
            width: 100%;
        }

        /* Bottom Row: Custom Date Form across the toolbar */
        .filter-row-bottom {
            display: flex;
            align-items: center;
            width: 100%;
        }
        .filter-date-form {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            flex-wrap: wrap;
        }
        .date-range-box {
            display: inline-flex;
            align-items: center;
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 0 12px;
            height: 38px;
            gap: 8px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .date-range-box:focus-within {
            border-color: #1E3A8A;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.09);
        }
        .date-sub-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }
        .date-input-field {
            border: none;
            outline: none;
            font-size: 12.5px;
            font-weight: 600;
            color: #0F172A;
            background: transparent;
            font-family: inherit;
        }
        .date-range-separator {
            color: #94A3B8;
            font-size: 12px;
            font-weight: 600;
        }
        .btn-filter-apply {
            height: 38px;
            padding: 0 16px;
            border-radius: 8px;
            background: #1B3B6F;
            color: #FFFFFF;
            border: none;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.15s ease;
            white-space: nowrap;
        }
        .btn-filter-apply:hover {
            background: #142F5B;
        }
        .btn-filter-reset {
            height: 38px;
            padding: 0 12px;
            border-radius: 8px;
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            color: #64748B;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
            white-space: nowrap;
        }
        .btn-filter-reset:hover {
            background: #F1F5F9;
            color: #0F172A;
            border-color: #94A3B8;
        }

        /* Active Period Summary Badge */
        .active-period-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            padding: 0 14px;
            height: 38px;
            border-radius: 8px;
            font-size: 12px;
            color: #475569;
            white-space: nowrap;
            flex-shrink: 0;
            margin-left: auto;
        }
        @media (max-width: 1100px) {
            .active-period-badge {
                margin-left: 0;
            }
        }
        .active-period-badge strong {
            color: #0F172A;
        }
        .active-count-pill {
            background: #EEF2FF;
            color: #1E3A8A;
            font-weight: 800;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 12px;
            margin-left: 2px;
        }

        /* Stat Cards: 5 Columns Balanced Grid */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-bottom: 24px;
            width: 100%;
        }
        .stat-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 16px 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            min-width: 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(30, 58, 138, 0.09);
            border-color: #1E3A8A;
        }
        .card-highlight-glow {
            transition: all 0.3s ease;
            border-color: #2563EB !important;
            box-shadow: 0 0 0 3.5px rgba(37, 99, 235, 0.25), 0 12px 28px rgba(37, 99, 235, 0.12) !important;
        }
        .cell-highlight-glow {
            background-color: #EFF6FF !important;
            color: #1E40AF !important;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .stat-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }
        .stat-icon.blue { background: #DBEAFE; color: #1D4ED8; }
        .stat-icon.green { background: #DCFCE7; color: #15803D; }
        .stat-icon.purple { background: #EDE9FE; color: #7C3AED; }
        .stat-icon.teal { background: #CCFBF1; color: #0F766E; }
        .stat-icon.amber { background: #FEF3C7; color: #B45309; }

        .stat-value {
            font-size: 20px;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -0.4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 4px 0 2px;
        }
        .stat-footer {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 600;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px dashed #F1F5F9;
            flex-wrap: nowrap;
            white-space: nowrap;
            overflow: hidden;
        }
        .trend-badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .trend-badge.up { background: #DCFCE7; color: #15803D; }
        .trend-badge.down { background: #FEE2E2; color: #DC2626; }
        .trend-badge.neutral { background: #F1F5F9; color: #64748B; }
        .trend-text {
            color: #94A3B8;
            font-weight: 500;
            font-size: 11px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Laporan Charts Layout: Minmax + responsive stack to prevent cutoff */
        .card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            min-width: 0;
            overflow: hidden;
        }
        .card-title { font-size: 16px; font-weight: 800; color: #0F172A; margin-bottom: 4px; }
        .card-desc { font-size: 12.5px; color: #64748B; margin-bottom: 16px; }

        .charts-row-laporan {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr);
            gap: 20px;
            margin-bottom: 24px;
            width: 100%;
            min-width: 0;
        }
        .chart-container-laporan {
            position: relative;
            height: 270px;
            width: 100%;
            min-width: 0;
        }

        /* Table Toolbar & Search */
        .card-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }
        .table-search-box {
            position: relative;
            min-width: 250px;
            flex: 1;
            max-width: 360px;
        }
        .table-search-box input {
            width: 100%;
            background: #F8FAFC;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 8px 12px 8px 34px;
            font-size: 13px;
            color: #1E293B;
            outline: none;
            transition: all 0.2s ease;
        }
        .table-search-box input:focus {
            background: #FFFFFF;
            border-color: #1E3A8A;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }
        .table-search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 13px;
        }
        .table-filter-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .table-select {
            padding: 7.5px 12px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            color: #1E293B;
            background: #FFFFFF;
            outline: none;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .table-select:focus {
            border-color: #1E3A8A;
        }

        /* Table Design */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .custom-table { width: 100%; border-collapse: collapse; text-align: left; }
        .custom-table th { background: #F8FAFC; padding: 11px 14px; font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #E2E8F0; white-space: nowrap; }
        .custom-table td { padding: 12px 14px; font-size: 13px; color: #334155; border-bottom: 1px solid #F1F5F9; font-weight: 500; vertical-align: middle; white-space: nowrap; }
        .custom-table tr:hover td { background-color: #F8FAFC; }
        .custom-table tr:last-child td { border-bottom: none; }
        .inv-code { color: #1E3A8A; font-weight: 700; white-space: nowrap; }

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

        /* Pagination Controls */
        .table-pagination-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 16px;
            margin-top: 14px;
            border-top: 1px solid #F1F5F9;
            flex-wrap: wrap;
            gap: 12px;
        }
        .pagination-info { font-size: 13px; font-weight: 600; color: #64748B; }
        .pagination-controls { display: flex; align-items: center; gap: 6px; }
        .pag-btn {
            padding: 6.5px 14px;
            border: 1px solid #CBD5E1;
            background: #FFFFFF;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            color: #475569;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .pag-btn:hover:not(:disabled) { background-color: #F1F5F9; color: #1E3A8A; border-color: #94A3B8; }
        .pag-btn:disabled { opacity: 0.45; cursor: not-allowed; }
        .page-num-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #CBD5E1;
            background: #FFFFFF;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            color: #475569;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .page-num-btn:hover { background-color: #F1F5F9; color: #1E3A8A; }
        .page-num-btn.active {
            background-color: #1B3B6F !important;
            color: #FFFFFF !important;
            border-color: #1B3B6F !important;
            box-shadow: 0 2px 4px rgba(27, 59, 111, 0.2);
        }
        .page-ellipsis {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 32px;
            color: #94A3B8;
            font-size: 13px;
            font-weight: 700;
            user-select: none;
        }

        .page-select-container {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #64748B;
            font-weight: 600;
            padding: 0 4px;
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

        /* Responsive Breakpoints */
        @media (max-width: 1280px) {
            .stats-row { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 1024px) {
            .charts-row-laporan { grid-template-columns: 1fr; }
            .stats-row { grid-template-columns: repeat(2, 1fr); }
            .filter-row-top { flex-direction: column; align-items: flex-start; gap: 12px; }
            .export-actions-group { width: 100%; justify-content: flex-start; }
            .filter-row-bottom { flex-direction: column; align-items: flex-start; gap: 12px; }
            .active-period-badge { width: 100%; justify-content: space-between; }
        }
        @media (max-width: 768px) {
            .segmented-filter-container { width: 100%; display: grid; grid-template-columns: repeat(2, 1fr); }
            .btn-segmented { justify-content: center; }
            .export-actions-group { width: 100%; display: flex; }
            .export-dropdown-wrapper { width: 100%; }
            .export-dropdown-wrapper .btn-export { width: 100%; justify-content: center; }
            .export-dropdown-menu { width: 100%; right: auto; left: 0; min-width: 100%; }
            .filter-date-form { width: 100%; flex-direction: column; align-items: stretch; }
            .date-range-box { width: 100%; justify-content: space-between; }
            .btn-filter-apply { width: 100%; justify-content: center; }
            .btn-filter-reset { width: 100%; justify-content: center; }
            .stats-row { grid-template-columns: 1fr; }
            .table-toolbar { flex-direction: column; align-items: stretch; }
            .table-search-box { max-width: 100%; }
            .table-filter-controls { width: 100%; justify-content: space-between; }
        }

        @media (max-width: 480px) {
            .segmented-filter-container {
                grid-template-columns: 1fr;
            }
            .table-filter-controls {
                flex-direction: column;
                gap: 8px;
            }
            .table-filter-controls select {
                width: 100%;
            }
        }

        /* Print Media Styling */
        @media print {
            .sidebar, .topbar, .filter-card, .table-toolbar, .table-pagination-footer, .btn-export, .export-dropdown-wrapper, .brand-tag { display: none !important; }
            .main-wrapper { margin-left: 0 !important; width: 100% !important; max-width: 100% !important; }
            .content-body { padding: 0 !important; }
            .card { box-shadow: none !important; border: 1px solid #CBD5E1 !important; break-inside: avoid; margin-bottom: 20px !important; }
            .stats-row { grid-template-columns: repeat(5, 1fr) !important; gap: 8px !important; }
            body { background: #FFFFFF !important; }
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
            <!-- Page Header -->
            <div style="margin-bottom: 20px;">
                <h1 class="page-title">Laporan & Statistik</h1>
                <p class="page-subtitle">Ringkasan performa, tren pendapatan, dan riwayat transaksi percetakan.</p>
            </div>

            <!-- Filter Card: Unified 2-Row Balanced Toolbar -->
            <div class="filter-card">
                <!-- Top Row: Quick Presets on Left, Complete Export Group on Right -->
                <div class="filter-row-top">
                    <div class="filter-preset-group">
                        <span class="filter-section-title"><i class="fa-solid fa-clock-rotate-left"></i> Waktu:</span>
                        <div class="segmented-filter-container">
                            <a href="{{ route('laporan', ['range' => 'today']) }}" 
                               class="btn-segmented {{ ($activeRange ?? '') === 'today' ? 'active' : '' }}" 
                               data-range="today" title="Filter transaksi hari ini">
                                <i class="fa-regular fa-calendar-check"></i> Hari Ini
                            </a>
                            <a href="{{ route('laporan', ['range' => 'month']) }}" 
                               class="btn-segmented {{ ($activeRange ?? '') === 'month' ? 'active' : '' }}" 
                               data-range="month" title="Filter transaksi bulan ini">
                                <i class="fa-regular fa-calendar-days"></i> Bulan Ini
                            </a>
                            <a href="{{ route('laporan', ['range' => 'quarter']) }}" 
                               class="btn-segmented {{ ($activeRange ?? '') === 'quarter' ? 'active' : '' }}" 
                               data-range="quarter" title="Filter transaksi kuartal ini">
                                <i class="fa-solid fa-chart-pie"></i> Kuartal Ini
                            </a>
                            <a href="{{ route('laporan', ['range' => 'year']) }}" 
                               class="btn-segmented {{ ($activeRange ?? '') === 'year' ? 'active' : '' }}" 
                               data-range="year" title="Filter transaksi tahun {{ $currentYear ?? date('Y') }}">
                                <i class="fa-regular fa-calendar"></i> Tahun Ini
                            </a>
                        </div>
                    </div>

                    <!-- Export Actions on Right -->
                    <div class="export-actions-group">
                        <div class="export-dropdown-wrapper" id="exportDropdownWrapper">
                            <button type="button" class="btn-export primary" id="btnExportAs" title="Export atau Cetak Dokumen Laporan" aria-expanded="false">
                                <i class="fa-solid fa-file-export"></i> Ekspor <i class="fa-solid fa-chevron-down" id="exportDropdownChevron" style="font-size: 10px; margin-left: 3px; transition: transform 0.2s ease;"></i>
                            </button>
                            <div class="export-dropdown-menu" id="exportDropdownMenu">
                                <button type="button" class="export-dropdown-item" id="btnExportExcel" title="Download Format Excel Spreadsheet (.xls)">
                                    <div class="export-item-icon excel"><i class="fa-solid fa-file-excel"></i></div>
                                    <div class="export-item-text">
                                        <div class="export-item-title">Export Excel</div>
                                        <div class="export-item-desc">Spreadsheet (.xls)</div>
                                    </div>
                                    <span class="export-badge excel">XLS</span>
                                </button>
                                <button type="button" class="export-dropdown-item" id="btnExportCsv" title="Download Data Transaksi Format CSV (.csv)">
                                    <div class="export-item-icon csv"><i class="fa-solid fa-file-csv"></i></div>
                                    <div class="export-item-text">
                                        <div class="export-item-title">Export CSV</div>
                                        <div class="export-item-desc">Data tabular (.csv)</div>
                                    </div>
                                    <span class="export-badge csv">CSV</span>
                                </button>
                                <div class="export-dropdown-divider"></div>
                                <button type="button" class="export-dropdown-item" id="btnCetakPdf" title="Unduh Dokumen Laporan Format PDF (.pdf)">
                                    <div class="export-item-icon pdf"><i class="fa-solid fa-file-pdf"></i></div>
                                    <div class="export-item-text">
                                        <div class="export-item-title">Export PDF</div>
                                        <div class="export-item-desc">Unduh Dokumen PDF (.pdf)</div>
                                    </div>
                                    <span class="export-badge pdf">PDF</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subtle Card Divider -->
                <div class="filter-divider"></div>

                <!-- Bottom Row: Inline Custom Date Picker on Left, Active Period Summary on Right -->
                <div class="filter-row-bottom">
                    <form action="{{ route('laporan') }}" method="GET" class="filter-date-form" id="dateFilterForm">
                        <span class="filter-section-title"><i class="fa-regular fa-calendar"></i> Tanggal:</span>

                        <div class="date-range-box">
                            <span class="date-sub-label"></span>
                            <input type="date" 
                                   class="date-input-field" 
                                   id="startDateInput" 
                                   name="start_date" 
                                   value="{{ $startDate }}" 
                                   min="{{ $earliestDate }}" 
                                   max="{{ $latestAllowedDate }}"
                                   title="Pilih tanggal mulai">
                            <span class="date-range-separator">—</span>
                            <span class="date-sub-label"></span>
                            <input type="date" 
                                   class="date-input-field" 
                                   id="endDateInput" 
                                   name="end_date" 
                                   value="{{ $endDate }}" 
                                   min="{{ $earliestDate }}" 
                                   max="{{ $latestAllowedDate }}"
                                   title="Pilih tanggal akhir (maksimal hari ini)">
                        </div>

                        <button type="submit" class="btn-filter-apply" id="btnApplyFilter" title="Terapkan filter rentang tanggal">
                            <i class="fa-solid fa-filter"></i>
                            <span>Tampilkan</span>
                        </button>

                        @if(request()->has('start_date') || request()->has('end_date') || request()->has('range'))
                            <a href="{{ route('laporan') }}" class="btn-filter-reset" title="Kembalikan ke rentang default">
                                <i class="fa-solid fa-rotate-left"></i> Reset
                            </a>
                        @endif

                        <!-- Periode status langsung di sebelah kanan reset dalam baris yang sama -->
                        <div class="active-period-badge">
                            <i class="fa-solid fa-circle-info" style="color: #1E3A8A;"></i>
                            <span>Periode: <strong>{{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}</strong> s/d <strong>{{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</strong></span>
                            <span class="active-count-pill">{{ number_format($totalTransaksi ?? 0, 0, ',', '.') }} Transaksi</span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Balanced 5 Stat Cards with Growth Rates & Rich Business Metrics -->
            <div class="stats-row">
                <!-- 1. Total Pendapatan -->
                <a href="#trenPendapatanCard" class="stat-card" id="cardTotalPendapatan" onclick="scrollToTransactions(event, 'omzet')" title="Klik untuk melompat ke grafik tren pendapatan & rincian omzet">
                    <div>
                        <div class="stat-header">
                            <span class="stat-label">TOTAL PENDAPATAN</span>
                            <div class="stat-icon green"><i class="fa-solid fa-money-bill-trend-up"></i></div>
                        </div>
                        <div class="stat-value">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-footer">
                        @if(($growthPendapatan ?? 0) > 0)
                            <span class="trend-badge up"><i class="fa-solid fa-arrow-trend-up"></i> +{{ $growthPendapatan }}%</span>
                        @elseif(($growthPendapatan ?? 0) < 0)
                            <span class="trend-badge down"><i class="fa-solid fa-arrow-trend-down"></i> {{ $growthPendapatan }}%</span>
                        @else
                            <span class="trend-badge neutral"><i class="fa-solid fa-minus"></i> 0%</span>
                        @endif
                        <span class="trend-text">{{ $growthLabel ?? 'vs periode lalu' }}</span>
                    </div>
                </a>

                <!-- 2. Total Pesanan -->
                <a href="{{ route('pesanan') }}" class="stat-card" title="Klik untuk membuka daftar kelola pesanan">
                    <div>
                        <div class="stat-header">
                            <span class="stat-label">TOTAL PESANAN</span>
                            <div class="stat-icon blue"><i class="fa-solid fa-file-invoice"></i></div>
                        </div>
                        <div class="stat-value">{{ number_format($totalTransaksi ?? 0, 0, ',', '.') }} <span style="font-size: 14px; font-weight: 600; color: #64748B;">Pesanan</span></div>
                    </div>
                    <div class="stat-footer">
                        @if(($growthPesanan ?? 0) > 0)
                            <span class="trend-badge up"><i class="fa-solid fa-arrow-trend-up"></i> +{{ $growthPesanan }}%</span>
                        @elseif(($growthPesanan ?? 0) < 0)
                            <span class="trend-badge down"><i class="fa-solid fa-arrow-trend-down"></i> {{ $growthPesanan }}%</span>
                        @else
                            <span class="trend-badge neutral"><i class="fa-solid fa-minus"></i> 0%</span>
                        @endif
                        <span class="trend-text">{{ $growthLabel ?? 'vs periode lalu' }}</span>
                    </div>
                </a>

                <!-- 3. Rata-rata Transaksi (AOV) -->
                <a href="#detailTransaksiCard" class="stat-card" id="cardAov" onclick="scrollToTransactions(event, 'nilai')" title="Klik untuk melompat & menyorot rincian nilai transaksi pada tabel di bawah">
                    <div>
                        <div class="stat-header">
                            <span class="stat-label">RATA-RATA NILAI</span>
                            <div class="stat-icon purple"><i class="fa-solid fa-chart-line"></i></div>
                        </div>
                        <div class="stat-value">Rp {{ number_format($rataRataTransaksi ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-footer">
                        @if(($growthAov ?? 0) > 0)
                            <span class="trend-badge up"><i class="fa-solid fa-arrow-trend-up"></i> +{{ $growthAov }}%</span>
                        @elseif(($growthAov ?? 0) < 0)
                            <span class="trend-badge down"><i class="fa-solid fa-arrow-trend-down"></i> {{ $growthAov }}%</span>
                        @else
                            <span class="trend-badge neutral"><i class="fa-solid fa-minus"></i> Stabil</span>
                        @endif
                        <span class="trend-text">per transaksi</span>
                    </div>
                </a>

                <!-- 4. Total Produk / Kuantitas Terjual -->
                <a href="{{ route('produk') }}" class="stat-card" title="Klik untuk membuka katalog produk">
                    <div>
                        <div class="stat-header">
                            <span class="stat-label">PRODUK TERJUAL</span>
                            <div class="stat-icon teal"><i class="fa-solid fa-boxes-stacked"></i></div>
                        </div>
                        <div class="stat-value">{{ number_format($totalProdukTerjual ?? 0, 0, ',', '.') }} <span style="font-size: 14px; font-weight: 600; color: #64748B;">Item</span></div>
                    </div>
                    <div class="stat-footer">
                        <span class="trend-badge up" style="background:#CCFBF1; color:#0F766E;"><i class="fa-solid fa-check"></i> Volume</span>
                        <span class="trend-text">cetak diproduksi</span>
                    </div>
                </a>

                <!-- 5. Sisa Piutang / Belum Lunas -->
                <a href="{{ route('pesanan', ['status_bayar' => 'belum_lunas']) }}" class="stat-card" title="Klik untuk melihat semua pesanan belum lunas & perlu pelunasan">
                    <div>
                        <div class="stat-header">
                            <span class="stat-label">BELUM LUNAS</span>
                            <div class="stat-icon amber"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                        </div>
                        <div class="stat-value">Rp {{ number_format($totalPiutang ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-footer">
                        @if(($totalBelumLunasCount ?? 0) > 0)
                            <span class="trend-badge down" style="background:#FEF3C7; color:#92400E;"><i class="fa-solid fa-clock"></i> {{ $totalBelumLunasCount }} Tagihan</span>
                            <span class="trend-text">perlu pelunasan</span>
                        @else
                            <span class="trend-badge up"><i class="fa-solid fa-circle-check"></i> Lunas Semua</span>
                            <span class="trend-text">tidak ada piutang</span>
                        @endif
                    </div>
                </a>
            </div>

            <!-- Charts Row: Tren Pendapatan + Kontribusi Omzet Produk -->
            <div class="charts-row-laporan">
                <!-- Pendapatan Line Chart -->
                <div class="card" id="trenPendapatanCard">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                        <div>
                            <h2 class="card-title">Tren Pendapatan</h2>
                            <p class="card-desc">Grafik pergerakan omzet berkala dalam rentang filter yang dipilih.</p>
                        </div>
                        <span style="font-size:12px; font-weight:700; color:#1E3A8A; background:#EEF2FF; padding:4px 10px; border-radius:6px;">
                            <i class="fa-solid fa-chart-area"></i> Fluktuasi Omzet
                        </span>
                    </div>
                    <div class="chart-container-laporan">
                        <canvas id="laporanTrendChart"></canvas>
                    </div>
                </div>

                <!-- Product Revenue Bar Chart -->
                <div class="card" id="distribusiOmzetCard">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px; gap: 12px;">
                        <div style="min-width: 0;">
                            <h2 class="card-title" style="white-space: nowrap;">Omzet per Produk</h2>
                            <p class="card-desc" style="margin-bottom:0; font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Distribusi nilai transaksi berdasarkan kategori cetak.</p>
                        </div>
                        <span style="font-size:12px; font-weight:700; color:#0F766E; background:#CCFBF1; padding:5px 12px; border-radius:6px; white-space: nowrap; flex-shrink: 0; display: inline-flex; align-items: center; gap: 6px;">
                            <i class="fa-solid fa-ranking-star"></i> <span>Kontribusi Produk</span>
                        </span>
                    </div>
                    <div class="chart-container-laporan">
                        <canvas id="laporanShareChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Detailed Transactions Table Card -->
            <div class="card" id="detailTransaksiCard">
                <div class="card-header-row">
                    <div>
                        <h2 class="card-title">Detail Transaksi Terbaru</h2>
                        <p class="card-desc" style="margin-bottom:0;">Rincian transaksi aktual yang terekam pada periode ini.</p>
                    </div>
                </div>

                <!-- Table Filter & Search Toolbar -->
                <div class="table-toolbar">
                    <!-- Live Quick Search -->
                    <div class="table-search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="tableSearchInput" placeholder="Cari kode pesanan, pelanggan, atau produk...">
                    </div>

                    <!-- Right Controls: Status Filter & Rows per Page -->
                    <div class="table-filter-controls">
                        <div style="display:flex; align-items:center; gap:6px;">
                            <span style="font-size:12.5px; font-weight:700; color:#475569;">Status:</span>
                            <select id="tableStatusFilter" class="table-select" title="Saring berdasarkan alur status pesanan">
                                <option value="all">Semua Status</option>
                                <option value="Antrean Cetak">Antrean Cetak</option>
                                <option value="Sedang Dicetak">Sedang Dicetak</option>
                                <option value="Finishing">Finishing</option>
                                <option value="Siap Diambil">Siap Diambil</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        <div style="display:flex; align-items:center; gap:6px;">
                            <span style="font-size:12.5px; font-weight:700; color:#475569;">Tampilkan:</span>
                            <select id="tableLimitSelect" class="table-select" title="Jumlah baris per halaman">
                                <option value="5">5 data</option>
                                <option value="10" selected>10 data</option>
                                <option value="25">25 data</option>
                                <option value="50">50 data</option>
                                <option value="all">Semua</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="table-responsive">
                    <table class="custom-table" id="transactionTable">
                        <thead>
                            <tr>
                                <th>KODE PESANAN</th>
                                <th>PELANGGAN</th>
                                <th>TANGGAL PESAN</th>
                                <th>PRODUK & SPESIFIKASI</th>
                                <th>TOTAL & BAYAR</th>
                                <th>STATUS PRODUKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanans ?? [] as $pes)
                                @php
                                    $stProd = $pes->status ?? 'Antrean Cetak';
                                    $stProdClass = 'badge-antrean-cetak';
                                    if ($stProd === 'Sedang Dicetak') $stProdClass = 'badge-sedang-dicetak';
                                    elseif ($stProd === 'Finishing') $stProdClass = 'badge-finishing';
                                    elseif ($stProd === 'Siap Diambil') $stProdClass = 'badge-siap-diambil';
                                    elseif ($stProd === 'Selesai') $stProdClass = 'badge-selesai';

                                    $stBayar = $pes->status_pembayaran ?? (strtolower($stProd) === 'selesai' ? 'Lunas' : 'Belum Lunas');
                                    $stBayarLower = strtolower($stBayar);
                                    $sisaTagihan = floatval($pes->sisa_bayar ?? ($stBayarLower === 'lunas' ? 0 : $pes->total_harga));
                                @endphp
                                <tr data-status="{{ $stProd }}" data-order-code="{{ $pes->kode_pesanan }}" data-customer="{{ $pes->nama_pelanggan }}" data-product="{{ $pes->nama_produk }}">
                                    <td class="inv-code">{{ $pes->kode_pesanan }}</td>
                                    <td>
                                        <div style="font-weight:700; color:#0F172A;">{{ $pes->nama_pelanggan }}</div>
                                    </td>
                                    <td>{{ $pes->tanggal_pesan ? \Carbon\Carbon::parse($pes->tanggal_pesan)->format('d M Y') : '-' }}</td>
                                    <td>
                                        <div style="font-weight:600; color:#1E293B;">{{ $pes->nama_produk }}</div>
                                        @if($pes->jumlah_ukuran)
                                            <div style="font-size:11.5px; color:#64748B; margin-top:2px;">{{ $pes->jumlah_ukuran }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="font-weight:700; color:#0F172A; font-size:13.5px; letter-spacing:-0.01em;">
                                            Rp {{ number_format($pes->total_harga, 0, ',', '.') }}
                                        </div>
                                        <div style="margin-top: 3px;">
                                            @if($stBayarLower === 'lunas')
                                                <span class="pay-sub-tag pay-sub-lunas" title="Pembayaran: Lunas">
                                                    <i class="fa-solid fa-circle-check"></i> Lunas
                                                </span>
                                            @elseif($stBayarLower === 'dp' || str_contains($stBayarLower, 'dp'))
                                                <span class="pay-sub-tag pay-sub-dp" title="{{ $sisaTagihan > 0 ? 'Sisa tagihan: Rp ' . number_format($sisaTagihan, 0, ',', '.') : 'Pembayaran: DP' }}">
                                                    <i class="fa-solid fa-clock"></i> DP @if($sisaTagihan > 0)<span class="sisa-note">(Sisa Rp {{ number_format($sisaTagihan, 0, ',', '.') }})</span>@endif
                                                </span>
                                            @else
                                                <span class="pay-sub-tag pay-sub-unpaid" title="{{ $sisaTagihan > 0 ? 'Sisa tagihan: Rp ' . number_format($sisaTagihan, 0, ',', '.') : 'Belum Lunas' }}">
                                                    <i class="fa-solid fa-circle-exclamation"></i> Belum Lunas
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-prod {{ $stProdClass }}">
                                            {{ $stProd }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr id="emptyRowInitial">
                                    <td colspan="6" style="text-align:center; padding:28px; color:#64748B;">
                                        <i class="fa-solid fa-inbox" style="font-size:24px; margin-bottom:6px; display:block; color:#94A3B8;"></i>
                                        Tidak ada data transaksi yang sesuai dengan kriteria filter saat ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Dynamic Pagination Footer -->
                <div class="table-pagination-footer">
                    <div class="pagination-info" id="tablePaginationInfo">
                        Menampilkan <strong id="pageStartIdx" style="color: #0F172A;">0</strong> - <strong id="pageEndIdx" style="color: #0F172A;">0</strong> dari <strong id="totalRowsCount" style="color: #0F172A;">0</strong> total transaksi
                    </div>
                    <div class="pagination-controls">
                        <button class="pag-btn" id="prevPageBtn" title="Halaman Sebelumnya">
                            <i class="fa-solid fa-chevron-left" style="font-size:11px;"></i> Sebelum
                        </button>
                        <div id="pageNumbersList" style="display: flex; gap: 4px;"></div>
                        <button class="pag-btn" id="nextPageBtn" title="Halaman Selanjutnya">
                            Lanjut <i class="fa-solid fa-chevron-right" style="font-size:11px;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Hidden Container for Direct PDF Export -->
    <div id="laporanPdfExportArea" style="display: none;">
        <!-- Letterhead -->
        <div style="border-bottom: 2.5px solid #1e3a8a; padding-bottom: 12px; margin-bottom: 16px; display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <div style="font-size: 20px; font-weight: 800; color: #1e3a8a; letter-spacing: -0.3px;">SIPEKAN DIGITAL PRINTING</div>
                <div style="font-size: 11px; color: #64748b; margin-top: 2px;">Layanan Cetak Cepat & Berkualitas • Solusi Cetak Digital Terpadu</div>
                <div style="font-size: 11px; color: #64748b;">Jl. Percetakan No. 45, Jakarta • Telp: (021) 555-0192 • info@sipekan.id</div>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 15px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px;">LAPORAN TRANSAKSI & STATISTIK</div>
                <div style="font-size: 11.5px; color: #334155; margin-top: 3px;">
                    Periode: <strong>{{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}</strong> s/d <strong>{{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</strong>
                </div>
                <div style="font-size: 10.5px; color: #94a3b8; margin-top: 3px;">Dicetak otomatis: {{ date('d M Y, H:i') }} WIB</div>
            </div>
        </div>

        <!-- Summary Metrics Grid -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 18px;">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 14px;">
                <div style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.4px;">Total Pendapatan</div>
                <div style="font-size: 15px; font-weight: 800; color: #16a34a; margin-top: 3px;">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 14px;">
                <div style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.4px;">Total Transaksi</div>
                <div style="font-size: 15px; font-weight: 800; color: #1e3a8a; margin-top: 3px;">{{ number_format($totalTransaksi ?? 0, 0, ',', '.') }} Pesanan</div>
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 14px;">
                <div style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.4px;">Rata-rata Transaksi</div>
                <div style="font-size: 15px; font-weight: 800; color: #7c3aed; margin-top: 3px;">Rp {{ number_format($rataRataTransaksi ?? 0, 0, ',', '.') }}</div>
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 14px;">
                <div style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.4px;">Belum Lunas / Piutang</div>
                <div style="font-size: 15px; font-weight: 800; color: #ea580c; margin-top: 3px;">Rp {{ number_format($totalPiutang ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Data Table -->
        <table style="width: 100%; border-collapse: collapse; font-size: 11px;">
            <thead>
                <tr style="background: #1e3a8a; color: #ffffff;">
                    <th style="padding: 8px 10px; text-align: center; font-weight: 700; border: 1px solid #1e3a8a; width: 35px;">No</th>
                    <th style="padding: 8px 10px; text-align: left; font-weight: 700; border: 1px solid #1e3a8a; width: 110px;">Kode Pesanan</th>
                    <th style="padding: 8px 10px; text-align: left; font-weight: 700; border: 1px solid #1e3a8a; width: 85px;">Tanggal</th>
                    <th style="padding: 8px 10px; text-align: left; font-weight: 700; border: 1px solid #1e3a8a;">Pelanggan</th>
                    <th style="padding: 8px 10px; text-align: left; font-weight: 700; border: 1px solid #1e3a8a;">Produk & Spesifikasi</th>
                    <th style="padding: 8px 10px; text-align: right; font-weight: 700; border: 1px solid #1e3a8a; width: 110px;">Total Tagihan</th>
                    <th style="padding: 8px 10px; text-align: center; font-weight: 700; border: 1px solid #1e3a8a; width: 90px;">Status Bayar</th>
                    <th style="padding: 8px 10px; text-align: center; font-weight: 700; border: 1px solid #1e3a8a; width: 95px;">Status Produksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanans ?? [] as $idx => $pes)
                    @php
                        $stBayar = $pes->status_pembayaran ?? (strtolower($pes->status ?? '') === 'selesai' ? 'Lunas' : 'Belum Lunas');
                        $bgRow = ($idx % 2 === 0) ? '#ffffff' : '#f8fafc';
                        $sisaTagihan = floatval($pes->sisa_bayar ?? (strtolower($stBayar) === 'lunas' ? 0 : $pes->total_harga));
                    @endphp
                    <tr style="background: {{ $bgRow }};">
                        <td style="padding: 6px 8px; border: 1px solid #cbd5e1; text-align: center;">{{ $idx + 1 }}</td>
                        <td style="padding: 6px 8px; border: 1px solid #cbd5e1; font-weight: 700; color: #1e3a8a;">{{ $pes->kode_pesanan }}</td>
                        <td style="padding: 6px 8px; border: 1px solid #cbd5e1;">{{ $pes->tanggal_pesan ? \Carbon\Carbon::parse($pes->tanggal_pesan)->format('d/m/Y') : '-' }}</td>
                        <td style="padding: 6px 8px; border: 1px solid #cbd5e1; font-weight: 600;">{{ $pes->nama_pelanggan }}</td>
                        <td style="padding: 6px 8px; border: 1px solid #cbd5e1;">
                            {{ $pes->nama_produk }}
                            @if($pes->jumlah_ukuran)
                                <div style="font-size: 10px; color: #64748b;">{{ $pes->jumlah_ukuran }}</div>
                            @endif
                        </td>
                        <td style="padding: 6px 8px; border: 1px solid #cbd5e1; text-align: right; font-weight: 700;">Rp {{ number_format($pes->total_harga, 0, ',', '.') }}</td>
                        <td style="padding: 6px 8px; border: 1px solid #cbd5e1; text-align: center;">
                            @if(strtolower($stBayar) === 'lunas')
                                <span style="font-weight: 700; color: #16a34a;">Lunas</span>
                            @elseif(str_contains(strtolower($stBayar), 'dp'))
                                <span style="font-weight: 700; color: #d97706;">DP (Sisa Rp {{ number_format($sisaTagihan, 0, ',', '.') }})</span>
                            @else
                                <span style="font-weight: 700; color: #dc2626;">Belum Lunas</span>
                            @endif
                        </td>
                        <td style="padding: 6px 8px; border: 1px solid #cbd5e1; text-align: center; font-size: 10.5px;">{{ $pes->status ?? 'Antrean Cetak' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="padding: 16px; text-align: center; color: #64748b; border: 1px solid #cbd5e1;">Tidak ada data transaksi pada rentang periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Footer Note -->
        <div style="margin-top: 18px; padding-top: 10px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; font-size: 10px; color: #94a3b8;">
            <span>SIPEKAN — Sistem Informasi Percetakan & Kasir</span>
            <span>Dokumen ini sah dihasilkan secara digital tanpa tanda tangan basah.</span>
        </div>
    </div>

    <!-- html2pdf Library for Direct PDF Downloads -->
    <script src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>

    <!-- Chart.js & Interactive Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
            Chart.defaults.color = '#64748B';

            // 1. Tren Pendapatan Chart (Responsive & Smooth Line)
            const canvasTrend = document.getElementById('laporanTrendChart');
            if (canvasTrend) {
                const ctxTrend = canvasTrend.getContext('2d');
                const gradientBlue = ctxTrend.createLinearGradient(0, 0, 0, 250);
                gradientBlue.addColorStop(0, 'rgba(30, 58, 138, 0.24)');
                gradientBlue.addColorStop(1, 'rgba(30, 58, 138, 0.01)');
                const trendFullLabels = {!! json_encode($trendFullLabels ?? []) !!};

                const trendChart = new Chart(ctxTrend, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($trendLabels ?? []) !!},
                        datasets: [{
                            label: 'Pendapatan',
                            data: {!! json_encode($trendValues ?? []) !!},
                            borderColor: '#1E3A8A',
                            backgroundColor: gradientBlue,
                            fill: true,
                            tension: 0.36,
                            borderWidth: 3,
                            pointBackgroundColor: '#FFFFFF',
                            pointBorderColor: '#1E3A8A',
                            pointBorderWidth: 2.5,
                            pointRadius: 4.5,
                            pointHoverRadius: 7,
                            pointHoverBackgroundColor: '#1E3A8A',
                            pointHoverBorderColor: '#FFFFFF',
                            pointHoverBorderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: { mode: 'index', intersect: false },
                        plugins: {
                            legend: {
                                position: 'top',
                                align: 'end',
                                labels: { usePointStyle: true, pointStyle: 'circle', boxWidth: 8, boxHeight: 8, font: { weight: '600' } }
                            },
                            tooltip: {
                                backgroundColor: '#0F172A',
                                padding: 12,
                                titleFont: { size: 13, weight: '700' },
                                bodyFont: { size: 12 },
                                callbacks: {
                                    title: function(context) {
                                        if (context && context.length > 0) {
                                            const idx = context[0].dataIndex;
                                            if (trendFullLabels && trendFullLabels[idx]) {
                                                return trendFullLabels[idx];
                                            }
                                            return context[0].label;
                                        }
                                        return '';
                                    },
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
                                grid: { display: false },
                                ticks: {
                                    maxRotation: 0,
                                    minRotation: 0,
                                    autoSkip: true,
                                    maxTicksLimit: 12,
                                    font: { size: 11, weight: '600' },
                                    color: '#64748B'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                min: 0,
                                suggestedMax: 100000,
                                grid: { color: '#F1F5F9' },
                                ticks: {
                                    callback: function(val) {
                                        if (val < 0) return '';
                                        if (val === 0) return 'Rp 0';
                                        if (val >= 1000000000) {
                                            let m = val / 1000000000;
                                            return 'Rp ' + (m % 1 === 0 ? m : m.toFixed(1).replace('.', ',')) + ' M';
                                        }
                                        if (val >= 1000000) {
                                            let jt = val / 1000000;
                                            return 'Rp ' + (jt % 1 === 0 ? jt : jt.toFixed(1).replace('.', ',')) + ' Jt';
                                        }
                                        if (val >= 1000) {
                                            let rb = val / 1000;
                                            return 'Rp ' + (rb % 1 === 0 ? rb : rb.toFixed(1).replace('.', ',')) + ' Rb';
                                        }
                                        return 'Rp ' + Math.round(val).toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });

                // Window resize trigger to guarantee no layout overflow
                window.addEventListener('resize', () => { trendChart.resize(); });
            }

            // 2. Kontribusi Omzet Produk Chart
            const canvasShare = document.getElementById('laporanShareChart') || document.getElementById('laporanCategoryChart');
            if (canvasShare) {
                const ctxShare = canvasShare.getContext('2d');
                const shareChart = new Chart(ctxShare, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($shareLabels ?? ['Banner/Spanduk', 'Brosur', 'Kartu Nama', 'Stiker', 'Dokumen']) !!},
                        datasets: [{
                            label: 'Persentase Omzet (%)',
                            data: {!! json_encode($sharePercentages ?? [0, 0, 0, 0, 0]) !!},
                            backgroundColor: ['#1E3A8A', '#2563EB', '#3B82F6', '#60A5FA', '#93C5FD', '#BFDBFE'],
                            borderRadius: 6,
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
                                        return ' Kontribusi: ' + context.raw + '%';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: { color: '#F1F5F9' },
                                ticks: {
                                    maxRotation: 0,
                                    minRotation: 0,
                                    autoSkip: true,
                                    maxTicksLimit: 7,
                                    font: { size: 11, weight: '600' },
                                    color: '#64748B',
                                    callback: function(val) { return val + '%'; }
                                },
                                beginAtZero: true
                            },
                            y: {
                                grid: { display: false },
                                ticks: {
                                    font: { size: 12, weight: '600' },
                                    color: '#334155',
                                    callback: function(val, index) {
                                        let label = this.getLabelForValue(val);
                                        if (label && label.length > 22) {
                                            return label.substring(0, 20) + '...';
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });

                window.addEventListener('resize', () => { shareChart.resize(); });
            }

            // 3. Table Search, Status Filter & Pagination Control Engine
            const searchInput = document.getElementById('tableSearchInput');
            const statusFilter = document.getElementById('tableStatusFilter');
            const limitSelect = document.getElementById('tableLimitSelect');
            const tableBody = document.querySelector('#transactionTable tbody');
            const rawTableRows = Array.from(tableBody.querySelectorAll('tr')).filter(r => !r.querySelector('td[colspan]'));
            
            const prevBtn = document.getElementById('prevPageBtn');
            const nextBtn = document.getElementById('nextPageBtn');
            const pageNumbersList = document.getElementById('pageNumbersList');
            const startIdxEl = document.getElementById('pageStartIdx');
            const endIdxEl = document.getElementById('pageEndIdx');
            const totalRowsEl = document.getElementById('totalRowsCount');

            let filteredRows = [...rawTableRows];
            let currentPage = 1;
            let rowsPerPage = parseInt(limitSelect ? limitSelect.value : 10);

            // Empty state row element for when filter produces 0 rows
            let noDataRow = document.createElement('tr');
            noDataRow.id = 'noFilterMatchRow';
            noDataRow.innerHTML = '<td colspan="6" style="text-align:center; padding:28px; color:#64748B;"><i class="fa-solid fa-filter-circle-xmark" style="font-size:22px; margin-bottom:6px; display:block; color:#94A3B8;"></i>Tidak ada transaksi yang cocok dengan pencarian / filter ini.</td>';
            noDataRow.style.display = 'none';
            tableBody.appendChild(noDataRow);

            function applyFilters() {
                const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
                const selectedStatus = (statusFilter ? statusFilter.value : 'all').toLowerCase();

                filteredRows = rawTableRows.filter(row => {
                    const rowStatus = (row.getAttribute('data-status') || '').toLowerCase();
                    const matchesStatus = (selectedStatus === 'all' || rowStatus === selectedStatus);

                    const textContent = (row.textContent || '').toLowerCase();
                    const matchesQuery = (!query || textContent.includes(query));

                    return matchesStatus && matchesQuery;
                });

                currentPage = 1;
                renderTablePagination();
            }

            function renderTablePagination() {
                const totalFiltered = filteredRows.length;
                if (totalRowsEl) totalRowsEl.textContent = totalFiltered;

                // Hide all raw rows first
                rawTableRows.forEach(r => { r.style.display = 'none'; });

                if (totalFiltered === 0) {
                    noDataRow.style.display = '';
                    if (startIdxEl) startIdxEl.textContent = 0;
                    if (endIdxEl) endIdxEl.textContent = 0;
                    if (prevBtn) prevBtn.disabled = true;
                    if (nextBtn) nextBtn.disabled = true;
                    if (pageNumbersList) pageNumbersList.innerHTML = '';
                    return;
                }

                noDataRow.style.display = 'none';

                const effectiveRowsPerPage = (rowsPerPage === -1 || isNaN(rowsPerPage)) ? totalFiltered : rowsPerPage;
                const totalPages = Math.ceil(totalFiltered / effectiveRowsPerPage);

                if (currentPage > totalPages) currentPage = totalPages;
                if (currentPage < 1) currentPage = 1;

                const start = (currentPage - 1) * effectiveRowsPerPage;
                const end = Math.min(start + effectiveRowsPerPage, totalFiltered);

                if (startIdxEl) startIdxEl.textContent = start + 1;
                if (endIdxEl) endIdxEl.textContent = end;

                // Display active rows in slice
                for (let i = start; i < end; i++) {
                    if (filteredRows[i]) {
                        filteredRows[i].style.display = '';
                    }
                }

                if (prevBtn) prevBtn.disabled = (currentPage === 1);
                if (nextBtn) nextBtn.disabled = (currentPage === totalPages || totalPages === 0);

                // Build compact dropdown page selector
                if (pageNumbersList) {
                    pageNumbersList.innerHTML = '';
                    
                    const selectWrap = document.createElement('div');
                    selectWrap.className = 'page-select-container';

                    const labelPre = document.createElement('span');
                    labelPre.textContent = 'Halaman';
                    selectWrap.appendChild(labelPre);

                    const select = document.createElement('select');
                    select.className = 'page-select-dropdown';
                    select.title = 'Lompat ke Halaman';
                    for (let p = 1; p <= totalPages; p++) {
                        const opt = document.createElement('option');
                        opt.value = p;
                        opt.textContent = p;
                        if (p === currentPage) opt.selected = true;
                        select.appendChild(opt);
                    }
                    select.addEventListener('change', function() {
                        currentPage = parseInt(this.value);
                        renderTablePagination();
                    });
                    selectWrap.appendChild(select);

                    const labelPost = document.createElement('span');
                    labelPost.innerHTML = `dari <strong style="color:#0F172A;">${totalPages}</strong>`;
                    selectWrap.appendChild(labelPost);

                    pageNumbersList.appendChild(selectWrap);
                }
            }

            if (searchInput) {
                searchInput.addEventListener('input', applyFilters);
            }

            if (statusFilter) {
                statusFilter.addEventListener('change', applyFilters);
            }

            if (limitSelect) {
                limitSelect.addEventListener('change', function() {
                    const val = this.value;
                    rowsPerPage = val === 'all' ? -1 : parseInt(val);
                    currentPage = 1;
                    renderTablePagination();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    if (currentPage > 1) {
                        currentPage--;
                        renderTablePagination();
                    }
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    const effectiveRowsPerPage = rowsPerPage === -1 ? filteredRows.length : rowsPerPage;
                    const totalPages = Math.ceil(filteredRows.length / effectiveRowsPerPage);
                    if (currentPage < totalPages) {
                        currentPage++;
                        renderTablePagination();
                    }
                });
            }

            // Initial pagination render
            renderTablePagination();

            // 4. Export CSV Handler (RFC 4180 Compliant with UTF-8 BOM)
            const btnExportCsv = document.getElementById('btnExportCsv');
            if (btnExportCsv) {
                btnExportCsv.addEventListener('click', function() {
                    let csvContent = "KODE PESANAN,PELANGGAN,TANGGAL PESAN,PRODUK & SPESIFIKASI,NILAI TRANSAKSI (RP),STATUS PRODUKSI\r\n";
                    
                    // Export all rows currently matching search/filter or all filtered rows
                    const rowsToExport = filteredRows.length > 0 ? filteredRows : rawTableRows;
                    rowsToExport.forEach(r => {
                        const tds = Array.from(r.querySelectorAll('td'));
                        if (tds.length >= 6) {
                            const code = tds[0].innerText.trim();
                            const customer = tds[1].innerText.trim().replace(/\n/g, ' ');
                            const date = tds[2].innerText.trim();
                            const product = tds[3].innerText.trim().replace(/\n/g, ' - ');
                            const rawPrice = tds[4].innerText.trim().replace(/\n/g, ' ');
                            const status = tds[5].innerText.trim();

                            const rowData = [code, customer, date, product, rawPrice, status].map(field => {
                                const clean = field.replace(/"/g, '""');
                                return `"${clean}"`;
                            });
                            csvContent += rowData.join(",") + "\r\n";
                        }
                    });

                    const bom = '\uFEFF';
                    const blob = new Blob([bom + csvContent], { type: 'text/csv;charset=utf-8;' });
                    const url = URL.createObjectURL(blob);
                    const link = document.createElement("a");
                    link.setAttribute("href", url);
                    link.setAttribute("download", `Laporan_Transaksi_SIPEKAN_{{ $startDate }}_{{ $endDate }}.csv`);
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    URL.revokeObjectURL(url);

                    if (window.showAppToast) {
                        window.showAppToast('Laporan format CSV (.csv) berhasil di-unduh!', 'success');
                    }
                });
            }

            // 5. Export Excel Handler (.xls Spreadsheet)
            const btnExportExcel = document.getElementById('btnExportExcel');
            if (btnExportExcel) {
                btnExportExcel.addEventListener('click', function() {
                    const rowsToExport = filteredRows.length > 0 ? filteredRows : rawTableRows;
                    
                    let tableHtml = `
                    <html>
                    <head>
                        <meta charset="utf-8">
                        <style>
                            th { background-color: #1B3B6F; color: #FFFFFF; font-weight: bold; border: 1px solid #CBD5E1; padding: 10px; font-family: sans-serif; text-align: left; }
                            td { border: 1px solid #E2E8F0; padding: 8px; font-family: sans-serif; }
                            .title { font-size: 16pt; font-weight: bold; color: #1B3B6F; }
                            .meta { font-size: 10pt; color: #64748B; }
                        </style>
                    </head>
                    <body>
                        <table>
                            <tr><td colspan="6" class="title">LAPORAN & STATISTIK SIPEKAN</td></tr>
                            <tr><td colspan="6" class="meta">Periode: {{ $startDate }} s/d {{ $endDate }} | Total Transaksi: ${rowsToExport.length}</td></tr>
                            <tr><td colspan="6"></td></tr>
                            <tr>
                                <th>KODE PESANAN</th>
                                <th>PELANGGAN</th>
                                <th>TANGGAL PESAN</th>
                                <th>PRODUK & SPESIFIKASI</th>
                                <th>NILAI TRANSAKSI</th>
                                <th>STATUS PRODUKSI</th>
                            </tr>
                    `;

                    rowsToExport.forEach(r => {
                        const tds = Array.from(r.querySelectorAll('td'));
                        if (tds.length >= 6) {
                            tableHtml += `<tr>
                                <td><b>${tds[0].innerText.trim()}</b></td>
                                <td>${tds[1].innerText.trim().replace(/\n/g, ' ')}</td>
                                <td>${tds[2].innerText.trim()}</td>
                                <td>${tds[3].innerText.trim().replace(/\n/g, ' - ')}</td>
                                <td>${tds[4].innerText.trim().replace(/\n/g, ' ')}</td>
                                <td>${tds[5].innerText.trim()}</td>
                            </tr>`;
                        }
                    });

                    tableHtml += `</table></body></html>`;

                    const blob = new Blob([tableHtml], { type: 'application/vnd.ms-excel;charset=utf-8;' });
                    const url = URL.createObjectURL(blob);
                    const link = document.createElement("a");
                    link.setAttribute("href", url);
                    link.setAttribute("download", `Laporan_Transaksi_SIPEKAN_{{ $startDate }}_{{ $endDate }}.xls`);
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    URL.revokeObjectURL(url);

                    if (window.showAppToast) {
                        window.showAppToast('Laporan format Excel (.xls) berhasil di-unduh!', 'success');
                    }
                });
            }

            // 6. Direct PDF Export Handler using html2pdf
            const btnCetakPdf = document.getElementById('btnCetakPdf');
            if (btnCetakPdf) {
                btnCetakPdf.addEventListener('click', function() {
                    toggleExportDropdown(false);
                    const exportArea = document.getElementById('laporanPdfExportArea');
                    if (!exportArea) {
                        window.print();
                        return;
                    }

                    if (window.showAppToast) {
                        window.showAppToast('Menyiapkan berkas PDF laporan...', 'info');
                    }

                    const opt = {
                        margin: [8, 8, 8, 8],
                        filename: `Laporan_Transaksi_SIPEKAN_{{ $startDate }}_{{ $endDate }}.pdf`,
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2, useCORS: true, letterRendering: true },
                        jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
                    };

                    const containerHtml = `
                        <div style="background: #ffffff; color: #1e293b; padding: 20px 24px; font-family: 'Plus Jakarta Sans', Arial, sans-serif; box-sizing: border-box; width: 100%;">
                            ${exportArea.innerHTML}
                        </div>
                    `;

                    if (typeof html2pdf !== 'undefined') {
                        html2pdf().set(opt).from(containerHtml).save().then(() => {
                            if (window.showAppToast) {
                                window.showAppToast('Laporan PDF berhasil diunduh!', 'success');
                            }
                        }).catch(err => {
                            console.error('Error generating Laporan PDF:', err);
                            if (window.showAppToast) {
                                window.showAppToast('Gagal mengunduh PDF laporan', 'error');
                            }
                        });
                    } else {
                        window.print();
                    }
                });
            }

            // Export As Dropdown Toggle & Click-Outside Controller
            const btnExportAs = document.getElementById('btnExportAs');
            const exportDropdownMenu = document.getElementById('exportDropdownMenu');
            const exportDropdownChevron = document.getElementById('exportDropdownChevron');
            const exportDropdownWrapper = document.getElementById('exportDropdownWrapper');

            function toggleExportDropdown(forceState) {
                if (!exportDropdownMenu) return;
                const shouldOpen = forceState !== undefined ? forceState : !exportDropdownMenu.classList.contains('show');
                if (shouldOpen) {
                    exportDropdownMenu.classList.add('show');
                    if (btnExportAs) btnExportAs.setAttribute('aria-expanded', 'true');
                    if (exportDropdownChevron) exportDropdownChevron.style.transform = 'rotate(180deg)';
                } else {
                    exportDropdownMenu.classList.remove('show');
                    if (btnExportAs) btnExportAs.setAttribute('aria-expanded', 'false');
                    if (exportDropdownChevron) exportDropdownChevron.style.transform = 'rotate(0deg)';
                }
            }

            if (btnExportAs) {
                btnExportAs.addEventListener('click', function(e) {
                    e.stopPropagation();
                    toggleExportDropdown();
                });
            }

            // Tutup dropdown jika klik di luar area
            document.addEventListener('click', function(e) {
                if (exportDropdownWrapper && !exportDropdownWrapper.contains(e.target)) {
                    toggleExportDropdown(false);
                }
            });

            // Tutup dropdown setelah salah satu opsi dipilih
            [btnExportExcel, btnExportCsv, btnCetakPdf].forEach(btn => {
                if (btn) {
                    btn.addEventListener('click', function() {
                        toggleExportDropdown(false);
                    });
                }
            });

            // 7. Interactive Stat Card Scroll & Highlight Handler
            window.scrollToTransactions = function(e, type) {
                if (e) e.preventDefault();
                if (type === 'omzet') {
                    const chartCard = document.getElementById('trenPendapatanCard');
                    if (chartCard) {
                        chartCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        chartCard.classList.add('card-highlight-glow');
                        setTimeout(() => chartCard.classList.remove('card-highlight-glow'), 2200);
                    }
                } else {
                    const tableCard = document.getElementById('detailTransaksiCard');
                    if (tableCard) {
                        tableCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        tableCard.classList.add('card-highlight-glow');

                        const nilaiCells = document.querySelectorAll('.col-nilai-transaksi');
                        nilaiCells.forEach(cell => cell.classList.add('cell-highlight-glow'));

                        setTimeout(() => {
                            tableCard.classList.remove('card-highlight-glow');
                            nilaiCells.forEach(cell => cell.classList.remove('cell-highlight-glow'));
                        }, 2400);
                    }
                }
            };
        });
    </script>
    @include('layouts.navbar_assets')
</body>
</html>
