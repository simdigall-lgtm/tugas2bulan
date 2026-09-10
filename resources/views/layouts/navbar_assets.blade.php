@php
    try {
        $dbPelanggan = \App\Models\Pelanggan::latest()->get();
    } catch (\Throwable $e) {
        $dbPelanggan = collect();
    }
    try {
        $dbProduk = \App\Models\Produk::latest()->get();
    } catch (\Throwable $e) {
        $dbProduk = collect();
    }
    try {
        $dbPesanan = \App\Models\Pesanan::latest()->get();
    } catch (\Throwable $e) {
        $dbPesanan = collect();
    }
    try {
        $dbPembayaran = \App\Models\Pembayaran::latest()->get();
    } catch (\Throwable $e) {
        $dbPembayaran = collect();
    }
@endphp

<style>
    /* Hide number input spin buttons (up/down arrows) globally */
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none !important;
        margin: 0 !important;
    }

    input[type=number] {
        -moz-appearance: textfield !important;
        appearance: textfield !important;
    }

    /* Modern subtle custom scrollbars globally (No chunky Windows scrollbars) */
    * {
        scrollbar-width: thin;
        scrollbar-color: #CBD5E1 transparent;
    }

    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: #CBD5E1;
        border-radius: 9999px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94A3B8;
    }

    /* Navbar Unified Interactive Styles */

    /* Topbar Right Enhancements */
    .topbar-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    /* Digital Clock Widget */
    .jakarta-clock-widget {
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: #F8FAFC;
        border: 1px solid #E2E8F0;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        color: #1E293B;
        white-space: nowrap;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    }

    /* Mobile Hamburger Menu Toggle Button */
    .mobile-toggle-btn {
        display: none;
        background: none;
        border: none;
        color: #475569;
        font-size: 20px;
        cursor: pointer;
        padding: 6px;
        border-radius: 8px;
        margin-right: 12px;
        transition: background 0.2s ease;
    }

    .mobile-toggle-btn:hover {
        background-color: #F1F5F9;
        color: #1E3A8A;
    }

    /* Sidebar Mobile Backdrop */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(15, 23, 42, 0.4);
        z-index: 99;
        backdrop-filter: blur(2px);
    }

    .sidebar-overlay.active {
        display: block;
    }

    /* Icon Button Badges */
    .icon-btn {
        position: relative;
        background: none;
        border: none;
        color: #64748B;
        font-size: 17px;
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
    }

    .icon-btn:hover {
        color: #1E3A8A;
        background-color: #F1F5F9;
    }

    .notif-badge {
        position: absolute;
        top: 3px;
        right: 3px;
        background-color: #EF4444;
        color: #FFFFFF;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 5px;
        border-radius: 10px;
        border: 2px solid #FFFFFF;
        line-height: 1;
    }

    /* User Profile Chip */
    .user-profile {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        padding: 4px 8px 4px 4px;
        border-radius: 24px;
        transition: background 0.2s ease;
        border: 1px solid transparent;
    }

    .user-profile:hover {
        background-color: #F1F5F9;
        border-color: #E2E8F0;
    }

    .avatar-img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 1.5px solid #E2E8F0;
    }

    .user-name-label {
        font-size: 13.5px;
        font-weight: 700;
        color: #1E293B;
    }

    .profile-chevron {
        font-size: 11px;
        color: #94A3B8;
        transition: transform 0.2s ease;
    }

    .user-profile-wrapper.active .profile-chevron {
        transform: rotate(180deg);
    }

    /* Global Search Box & Dropdown */
    .search-container,
    .search-wrap {
        position: relative;
        width: 380px;
        max-width: 100%;
    }

    .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        font-size: 14px;
        z-index: 10;
        pointer-events: none;
    }

    .search-input {
        width: 100%;
        background-color: #F1F5F9;
        border: 1px solid transparent;
        border-radius: 8px;
        padding: 9px 34px 9px 38px;
        font-size: 13.5px;
        color: #1E293B;
        outline: none;
        transition: all 0.2s ease;
    }

    .search-input:focus {
        background-color: #FFFFFF;
        border-color: #1E3A8A;
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.12);
    }

    .clear-search-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        font-size: 18px;
        color: #94A3B8;
        cursor: pointer;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 12;
        transition: all 0.15s ease;
    }

    .clear-search-btn:hover {
        background-color: #E2E8F0;
        color: #0F172A;
    }

    .search-dropdown-menu {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        width: 100%;
        min-width: 380px;
        max-width: 90vw;
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        box-shadow: 0 16px 36px rgba(15, 23, 42, 0.16);
        z-index: 200;
        display: none;
        overflow: hidden;
    }

    .search-dropdown-menu.show {
        display: block;
        animation: fadeInDown 0.15s ease-out;
    }

    .search-dropdown-header {
        padding: 10px 16px;
        font-size: 11px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background-color: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .search-results-list {
        max-height: 360px;
        overflow-y: auto;
    }

    .search-result-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 16px;
        text-decoration: none;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.15s ease;
        border-bottom: 1px solid #F8FAFC;
        border-left: 3px solid transparent;
    }

    .search-result-item:hover,
    .search-result-item.active {
        background-color: #EEF2FF !important;
        color: #1E3A8A !important;
        border-left-color: #1B3B6F !important;
    }

    .search-result-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background-color: #F1F5F9;
        color: #1E3A8A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    .search-result-info {
        flex: 1;
        min-width: 0;
    }

    .search-result-title {
        font-weight: 700;
        color: #0F172A;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .search-result-sub {
        font-size: 11.5px;
        color: #64748B;
        margin-top: 1px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .search-cat-badge {
        font-size: 10px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
        white-space: nowrap;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .search-cat-badge.cat-menu {
        background: #EFF6FF;
        color: #1E3A8A;
    }

    .search-cat-badge.cat-pelanggan {
        background: #DCFCE7;
        color: #15803D;
    }

    .search-cat-badge.cat-produk {
        background: #F3E8FF;
        color: #6B21A8;
    }

    .search-cat-badge.cat-pesanan {
        background: #FEF3C7;
        color: #B45309;
    }

    .search-cat-badge.cat-pembayaran {
        background: #D1FAE5;
        color: #047857;
    }

    .search-highlight {
        background-color: #FEF08A;
        color: #0F172A;
        padding: 0 2px;
        border-radius: 2px;
        font-weight: 700;
    }

    .search-result-sub {
        font-size: 11.5px;
        color: #64748B;
        margin-top: 1px;
    }

    /* Notification Dropdown Card */
    .notif-dropdown-card {
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        width: 340px;
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        box-shadow: 0 16px 36px rgba(15, 23, 42, 0.12);
        z-index: 200;
        display: none;
        overflow: hidden;
    }

    .notif-dropdown-card.show {
        display: block;
        animation: fadeInDown 0.15s ease-out;
    }

    .notif-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        border-bottom: 1px solid #F1F5F9;
    }

    .notif-title {
        font-size: 14px;
        font-weight: 800;
        color: #0F172A;
    }

    .notif-mark-read {
        background: none;
        border: none;
        color: #2563EB;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .notif-mark-read:hover {
        text-decoration: underline;
    }

    .notif-body {
        max-height: 310px;
        overflow-y: auto;
    }

    .notif-item {
        display: flex;
        gap: 12px;
        padding: 12px 18px;
        text-decoration: none;
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s ease;
    }

    .notif-item:hover {
        background-color: #F8FAFC;
    }

    .notif-item.unread {
        background-color: #F0Fdf4;
    }

    .notif-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .notif-icon.blue {
        background-color: #EFF6FF;
        color: #2563EB;
    }

    .notif-icon.green {
        background-color: #DCFCE7;
        color: #16A34A;
    }

    .notif-icon.orange {
        background-color: #FFEDD5;
        color: #EA580C;
    }

    .notif-content {
        flex: 1;
    }

    .notif-text {
        font-size: 12.5px;
        color: #334155;
        line-height: 1.4;
    }

    .notif-time {
        font-size: 11px;
        color: #94A3B8;
        margin-top: 4px;
    }

    .notif-footer {
        padding: 10px 18px;
        text-align: center;
        background-color: #F8FAFC;
        border-top: 1px solid #F1F5F9;
    }

    .notif-view-all {
        font-size: 12.5px;
        font-weight: 700;
        color: #1E3A8A;
        text-decoration: none;
    }

    /* Profile Dropdown Card */
    .profile-dropdown-card {
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        width: 240px;
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        box-shadow: 0 16px 36px rgba(15, 23, 42, 0.12);
        z-index: 200;
        display: none;
        padding: 8px 0;
        overflow: hidden;
    }

    .profile-dropdown-card.show {
        display: block;
        animation: fadeInDown 0.15s ease-out;
    }

    .profile-header-info {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px 14px 16px;
    }

    .profile-header-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #E2E8F0;
    }

    .profile-header-name {
        font-size: 14px;
        font-weight: 800;
        color: #0F172A;
    }

    .profile-header-email {
        font-size: 11.5px;
        color: #64748B;
        margin-top: 1px;
    }

    .profile-menu-divider {
        height: 1px;
        background-color: #F1F5F9;
        margin: 4px 0;
    }

    .profile-menu-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        text-decoration: none;
        transition: all 0.15s ease;
        cursor: pointer;
    }

    .profile-menu-item:hover {
        background-color: #EEF2FF;
        color: #1E3A8A;
    }

    .profile-menu-item.danger {
        color: #EF4444;
    }

    .profile-menu-item.danger:hover {
        background-color: #FEF2F2;
        color: #DC2626;
    }

    /* Modal Overlay Base */
    .app-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(15, 23, 42, 0.5);
        backdrop-filter: blur(3px);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
    }

    .app-modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .app-modal-box {
        background-color: #FFFFFF;
        border-radius: 16px;
        width: 100%;
        max-width: 520px;
        padding: 28px;
        box-shadow: 0 24px 48px rgba(15, 23, 42, 0.2);
        transform: translateY(-16px);
        transition: transform 0.2s ease;
    }

    .app-modal-overlay.active .app-modal-box {
        transform: translateY(0);
    }

    .app-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .app-modal-title {
        font-size: 19px;
        font-weight: 800;
        color: #0F172A;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .app-modal-close {
        background: none;
        border: none;
        color: #94A3B8;
        font-size: 18px;
        cursor: pointer;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s ease;
    }

    .app-modal-close:hover {
        background-color: #F1F5F9;
        color: #0F172A;
    }

    /* Keyframe Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Global Table Responsive & Formatting Utility */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin-bottom: 0;
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE / Edge */
    }

    .table-responsive::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
    }

    .order-link,
    .order-code,
    .pay-id,
    .inv-code,
    .cus-id,
    .price-text,
    .status-badge,
    .badge,
    .size-badge,
    table th,
    table td,
    .custom-table th,
    .custom-table td {
        white-space: nowrap !important;
    }

    /* Table Dropdown Menu & Dropup Positioning */
    .dropdown-menu.dropup {
        top: auto !important;
        bottom: 100% !important;
        margin-top: 0 !important;
        margin-bottom: 6px !important;
        box-shadow: 0 -10px 25px rgba(0, 0, 0, 0.12) !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .mobile-toggle-btn {
            display: inline-flex;
        }

        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .main-wrapper {
            margin-left: 0 !important;
        }

        .search-container,
        .search-wrap {
            width: 180px;
        }

        .user-name-label {
            display: none;
        }
    }
    /* ===================================================
       Enhanced Help Center Modal Styles
    =================================================== */
    #helpModal .app-modal-box {
        max-width: 820px;
        width: 95%;
        max-height: 88vh;
        height: 640px;
        padding: 0;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: 18px;
        box-shadow: 0 25px 60px -15px rgba(15, 23, 42, 0.35);
        border: 1px solid #E2E8F0;
    }

    .help-header-wrapper {
        padding: 22px 26px 16px 26px;
        background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 100%);
        color: #FFFFFF;
        position: relative;
    }

    .help-header-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .help-header-title {
        font-size: 18px;
        font-weight: 800;
        color: #FFFFFF;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .help-header-subtitle {
        font-size: 12px;
        color: #93C5FD;
        margin-top: 2px;
        font-weight: 400;
    }

    .help-close-btn {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #FFFFFF;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.2s ease;
    }

    .help-close-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: scale(1.05);
    }

    .help-search-input-box {
        position: relative;
        width: 100%;
    }

    .help-search-input-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        font-size: 13.5px;
    }

    .help-search-input-box input {
        width: 100%;
        padding: 10px 14px 10px 38px;
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 10px;
        font-size: 13px;
        color: #0F172A;
        outline: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.2s ease;
    }

    .help-search-input-box input:focus {
        border-color: #3B82F6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    }

    /* Tab navigation bar */
    .help-nav-tabs {
        display: flex;
        background: #F8FAFC;
        border-bottom: 1px solid #E2E8F0;
        padding: 0 20px;
        gap: 6px;
        overflow-x: auto;
    }

    .help-tab-link {
        padding: 12px 14px;
        background: none;
        border: none;
        border-bottom: 2px solid transparent;
        font-size: 13px;
        font-weight: 600;
        color: #64748B;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .help-tab-link:hover {
        color: #1E3A8A;
    }

    .help-tab-link.active {
        color: #2563EB;
        border-bottom-color: #2563EB;
        font-weight: 700;
    }

    /* Tab Content Area */
    .help-body-content {
        flex: 1;
        overflow-y: auto;
        padding: 20px 24px;
        background-color: #FFFFFF;
    }

    .help-tab-pane {
        display: none;
        animation: fadeInDown 0.2s ease-out;
    }

    .help-tab-pane.active {
        display: block;
    }

    /* Workflow Cards */
    .workflow-grid {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .workflow-step-card {
        display: flex;
        gap: 14px;
        padding: 14px 16px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .workflow-step-card:hover {
        border-color: #CBD5E1;
        background: #F1F5F9;
        transform: translateY(-2px);
    }

    .workflow-step-num {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #1E3A8A, #2563EB);
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 14px;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
    }

    .workflow-step-content {
        flex: 1;
    }

    .workflow-step-title {
        font-size: 13.5px;
        font-weight: 700;
        color: #0F172A;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 4px;
    }

    .workflow-step-desc {
        font-size: 12px;
        color: #64748B;
        line-height: 1.5;
        margin-bottom: 8px;
    }

    .workflow-quick-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11.5px;
        font-weight: 700;
        color: #2563EB;
        text-decoration: none;
        padding: 4px 10px;
        background: #EFF6FF;
        border-radius: 6px;
        transition: all 0.15s ease;
    }

    .workflow-quick-link:hover {
        background: #DBEAFE;
        color: #1D4ED8;
    }

    /* FAQ Accordion */
    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .faq-item {
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        overflow: hidden;
        background: #FFFFFF;
        transition: all 0.2s ease;
    }

    .faq-item.active {
        border-color: #93C5FD;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.08);
    }

    .faq-question-btn {
        width: 100%;
        padding: 13px 16px;
        background: #F8FAFC;
        border: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        text-align: left;
        font-size: 13px;
        font-weight: 700;
        color: #1E293B;
        cursor: pointer;
        transition: background 0.15s ease;
    }

    .faq-item.active .faq-question-btn {
        background: #EFF6FF;
        color: #1E3A8A;
    }

    .faq-chevron {
        font-size: 12px;
        color: #64748B;
        transition: transform 0.25s ease;
    }

    .faq-item.active .faq-chevron {
        transform: rotate(180deg);
        color: #2563EB;
    }

    .faq-answer-body {
        display: none;
        padding: 13px 16px;
        font-size: 12.5px;
        color: #475569;
        line-height: 1.6;
        border-top: 1px solid #E2E8F0;
        background: #FFFFFF;
    }

    .faq-item.active .faq-answer-body {
        display: block;
    }

    /* Shortcuts Grid */
    .shortcut-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 12px;
    }

    .shortcut-item-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 14px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        transition: all 0.15s ease;
    }

    .shortcut-item-card:hover {
        background: #EFF6FF;
        border-color: #BFDBFE;
    }

    .kbd-badge {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
        border-radius: 6px;
        padding: 3px 8px;
        font-family: monospace;
        font-size: 12px;
        font-weight: 700;
        color: #1E3A8A;
    }

    /* Contact & Support Tab */
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 14px;
        margin-bottom: 16px;
    }

    .contact-card {
        padding: 18px 14px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .contact-card:hover {
        border-color: #CBD5E1;
        transform: translateY(-2px);
    }

    .contact-card-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    /* Footer */
    .help-modal-footer {
        padding: 12px 24px;
        background: #F8FAFC;
        border-top: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>

<!-- Sidebar Overlay Backdrop for Mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Professional Help Center Modal -->
<div class="app-modal-overlay" id="helpModal">
    <div class="app-modal-box">
        <!-- Header -->
        <div class="help-header-wrapper">
            <div class="help-header-top">
                <div>
                    <div class="help-header-title">
                        <i class="fa-solid fa-headset" style="color: #60A5FA;"></i>
                        <span>Pusat Bantuan & Panduan Sistem</span>
                    </div>
                    <div class="help-header-subtitle">SIPEKAN — Sistem Informasi Manajemen Percetakan Modern</div>
                </div>
                <button type="button" class="help-close-btn closeHelpModal" title="Tutup Panduan (Esc)">&times;</button>
            </div>
            <!-- Search Bar inside Help Center -->
            <div class="help-search-input-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="helpFilterInput" placeholder="Cari topik panduan, alur fitur, atau tanya jawab..." autocomplete="off">
            </div>
        </div>

        <!-- Tab Navigation Bar -->
        <div class="help-nav-tabs">
            <button type="button" class="help-tab-link active" data-tab="helpTabWorkflow">
                <i class="fa-solid fa-diagram-project"></i>
                <span>Alur Kerja Sistem</span>
            </button>
            <button type="button" class="help-tab-link" data-tab="helpTabFaq">
                <i class="fa-regular fa-circle-question"></i>
                <span>Tanya Jawab (FAQ)</span>
            </button>
            <button type="button" class="help-tab-link" data-tab="helpTabShortcuts">
                <i class="fa-solid fa-keyboard"></i>
                <span>Pintasan Keyboard</span>
            </button>
            <button type="button" class="help-tab-link" data-tab="helpTabContact">
                <i class="fa-solid fa-comments"></i>
                <span>Dukungan & Kontak</span>
            </button>
        </div>

        <!-- Body Content -->
        <div class="help-body-content">
            <!-- TAB 1: ALUR KERJA SISTEM -->
            <div class="help-tab-pane active" id="helpTabWorkflow">
                <div style="font-size: 12.5px; color: #64748B; margin-bottom: 14px;">
                    Ikuti 5 tahapan alur operasional standar percetakan dari awal order hingga pencatatan keuangan:
                </div>

                <div class="workflow-grid">
                    <!-- Step 1 -->
                    <div class="workflow-step-card searchable-item">
                        <div class="workflow-step-num">1</div>
                        <div class="workflow-step-content">
                            <div class="workflow-step-title">
                                <span>1. Registrasi & Manajemen Pelanggan</span>
                                <span class="badge" style="background:#E0E7FF; color:#3730A3; font-size:10.5px; padding:2px 8px; border-radius:4px;">Master Data</span>
                            </div>
                            <div class="workflow-step-desc">
                                Catat data pelanggan baru (Nama, Nomor WhatsApp, Email, & Alamat). Riwayat pemesanan pelanggan akan otomatis tersimpan untuk kemudahan re-order.
                            </div>
                            <a href="{{ route('pelanggan') }}" class="workflow-quick-link">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Menu Pelanggan
                            </a>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="workflow-step-card searchable-item">
                        <div class="workflow-step-num">2</div>
                        <div class="workflow-step-content">
                            <div class="workflow-step-title">
                                <span>2. Kelola Katalog Produk & Tarif Cetak</span>
                                <span class="badge" style="background:#FEF3C7; color:#92400E; font-size:10.5px; padding:2px 8px; border-radius:4px;">Katalog</span>
                            </div>
                            <div class="workflow-step-desc">
                                Atur varian produk cetak (Banner/Spanduk, Brosur, Stiker Vinyl, Kartu Nama), satuan ukuran (m² / lembar / rim), serta tarif harga dasar per item.
                            </div>
                            <a href="{{ route('produk') }}" class="workflow-quick-link">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Menu Produk
                            </a>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="workflow-step-card searchable-item">
                        <div class="workflow-step-num">3</div>
                        <div class="workflow-step-content">
                            <div class="workflow-step-title">
                                <span>3. Buat & Pantau Pesanan (Order Cetak)</span>
                                <span class="badge" style="background:#DBEAFE; color:#1E40AF; font-size:10.5px; padding:2px 8px; border-radius:4px;">Transaksi</span>
                            </div>
                            <div class="workflow-step-desc">
                                Input pesanan pelanggan dengan memilih produk dan jumlah. Sistem menghitung total biaya otomatis. Pantau progres pengerjaan: <em>Menunggu &rarr; Diproses &rarr; Selesai</em>.
                            </div>
                            <a href="{{ route('pesanan') }}" class="workflow-quick-link">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Menu Pesanan
                            </a>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="workflow-step-card searchable-item">
                        <div class="workflow-step-num">4</div>
                        <div class="workflow-step-content">
                            <div class="workflow-step-title">
                                <span>4. Pembayaran Kasir & Cetak Invoice</span>
                                <span class="badge" style="background:#DCFCE7; color:#166534; font-size:10.5px; padding:2px 8px; border-radius:4px;">Kasir</span>
                            </div>
                            <div class="workflow-step-desc">
                                Catat transaksi pembayaran melalui Tunai, Transfer Bank, atau QRIS. Status pembayaran mendukung Uang Muka (DP / Belum Lunas) hingga Pelunasan (Lunas) & cetak struk kwitansi.
                            </div>
                            <a href="{{ route('pembayaran') }}" class="workflow-quick-link">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Menu Pembayaran
                            </a>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="workflow-step-card searchable-item">
                        <div class="workflow-step-num">5</div>
                        <div class="workflow-step-content">
                            <div class="workflow-step-title">
                                <span>5. Rekapitulasi Laporan & Export Data</span>
                                <span class="badge" style="background:#F3E8FF; color:#6B21A8; font-size:10.5px; padding:2px 8px; border-radius:4px;">Analitik</span>
                            </div>
                            <div class="workflow-step-desc">
                                Analisis performa omset cetak harian, mingguan, dan bulanan. Filter data berdasarkan tanggal dan unduh laporan resmi dalam format <strong>PDF</strong> atau <strong>Excel</strong>.
                            </div>
                            <a href="{{ route('laporan') }}" class="workflow-quick-link">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Menu Laporan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: FAQ ACCORDION -->
            <div class="help-tab-pane" id="helpTabFaq">
                <div style="font-size: 12.5px; color: #64748B; margin-bottom: 14px;">
                    Pertanyaan yang sering diajukan mengenai pengoperasian aplikasi SIPEKAN:
                </div>

                <div class="faq-list">
                    <!-- FAQ 1 -->
                    <div class="faq-item searchable-item active">
                        <button type="button" class="faq-question-btn">
                            <span><i class="fa-regular fa-file-lines" style="color:#2563EB; margin-right:8px;"></i> Bagaimana cara mencetak struk atau invoice pesanan?</span>
                            <i class="fa-solid fa-chevron-down faq-chevron"></i>
                        </button>
                        <div class="faq-answer-body">
                            Buka menu <strong>Pembayaran</strong> atau <strong>Pesanan</strong>, klik tombol opsi aksi (titik tiga `⋮`) pada baris transaksi yang diinginkan, kemudian pilih <strong>Cetak Kwitansi / Struk</strong>. Anda juga bisa menekan tombol cetak langsung dari modal detail invoice.
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item searchable-item">
                        <button type="button" class="faq-question-btn">
                            <span><i class="fa-solid fa-circle-check" style="color:#10B981; margin-right:8px;"></i> Bagaimana mengubah status pesanan yang sudah selesai dicetak?</span>
                            <i class="fa-solid fa-chevron-down faq-chevron"></i>
                        </button>
                        <div class="faq-answer-body">
                            Buka menu <strong>Pesanan</strong>, cari kode pesanan pelanggan, klik tombol <strong>Edit</strong>, ubah kolom status dari <em>Diproses</em> menjadi <strong>Selesai</strong>, lalu klik <strong>Simpan Perubahan</strong>. Sistem akan otomatis memperbarui data dan mengirimkan status ke dasbor.
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item searchable-item">
                        <button type="button" class="faq-question-btn">
                            <span><i class="fa-solid fa-money-bill-wave" style="color:#F59E0B; margin-right:8px;"></i> Bagaimana jika pelanggan hanya membayar uang muka (DP) terlebih dahulu?</span>
                            <i class="fa-solid fa-chevron-down faq-chevron"></i>
                        </button>
                        <div class="faq-answer-body">
                            Pada formulir <strong>Tambah Pembayaran</strong>, masukkan jumlah uang muka yang dibayarkan. Pilih status <strong>Belum Lunas</strong>. Sisa tagihan akan tercatat otomatis dan dapat dilunasi kapan saja saat pesanan selesai diambil.
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="faq-item searchable-item">
                        <button type="button" class="faq-question-btn">
                            <span><i class="fa-solid fa-file-excel" style="color:#059669; margin-right:8px;"></i> Bagaimana cara mengekspor laporan keuangan ke format Excel atau PDF?</span>
                            <i class="fa-solid fa-chevron-down faq-chevron"></i>
                        </button>
                        <div class="faq-answer-body">
                            Masuk ke menu <strong>Laporan</strong>, atur filter rentang tanggal dan jenis laporan yang ingin ditampilkan, kemudian klik tombol <strong>Export PDF</strong> atau <strong>Export Excel</strong> di pojok kanan atas tabel laporan.
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="faq-item searchable-item">
                        <button type="button" class="faq-question-btn">
                            <span><i class="fa-solid fa-shield-halved" style="color:#6366F1; margin-right:8px;"></i> Bagaimana cara mengaktifkan keamanan Two-Factor Authentication (2FA)?</span>
                            <i class="fa-solid fa-chevron-down faq-chevron"></i>
                        </button>
                        <div class="faq-answer-body">
                            Buka menu <strong>Pengaturan</strong>, cari bagian <em>Keamanan Autentikasi 2FA</em>, aktifkan tombol switch, lalu scan QR Code menggunakan aplikasi Google Authenticator di smartphone Anda dan masukkan 6 digit token untuk verifikasi.
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: PINTASAN KEYBOARD -->
            <div class="help-tab-pane" id="helpTabShortcuts">
                <div style="font-size: 12.5px; color: #64748B; margin-bottom: 14px;">
                    Gunakan pintasan keyboard berikut untuk mempercepat pekerjaan Anda:
                </div>

                <div class="shortcut-grid">
                    <div class="shortcut-item-card searchable-item">
                        <div>
                            <div style="font-size: 13px; font-weight: 700; color: #0F172A;">Fokus Pencarian Global</div>
                            <div style="font-size: 11.5px; color: #64748B;">Cari menu & data cepat</div>
                        </div>
                        <button type="button" id="triggerSearchShortcutBtn" class="kbd-badge" style="cursor:pointer; background:#EEF2FF; border-color:#C7D2FE;" title="Klik untuk mencoba">
                            / (Garis Miring)
                        </button>
                    </div>

                    <div class="shortcut-item-card searchable-item">
                        <div>
                            <div style="font-size: 13px; font-weight: 700; color: #0F172A;">Tutup Modal & Popup</div>
                            <div style="font-size: 11.5px; color: #64748B;">Kembali ke halaman utama</div>
                        </div>
                        <button type="button" id="triggerEscShortcutBtn" class="kbd-badge" style="cursor:pointer;" title="Klik untuk mencoba">
                            Esc
                        </button>
                    </div>

                    <div class="shortcut-item-card searchable-item">
                        <div>
                            <div style="font-size: 13px; font-weight: 700; color: #0F172A;">Cetak Halaman / Invoice</div>
                            <div style="font-size: 11.5px; color: #64748B;">Buka dialog cetak printer</div>
                        </div>
                        <span class="kbd-badge">Ctrl + P</span>
                    </div>

                    <div class="shortcut-item-card searchable-item">
                        <div>
                            <div style="font-size: 13px; font-weight: 700; color: #0F172A;">Buka Pusat Bantuan</div>
                            <div style="font-size: 11.5px; color: #64748B;">Akses panduan sistem</div>
                        </div>
                        <span class="kbd-badge">Icon Bantuan (?)</span>
                    </div>
                </div>

                <div style="margin-top: 18px; padding: 12px 16px; background: #F8FAFC; border: 1px dashed #CBD5E1; border-radius: 10px; font-size: 12px; color: #475569; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-lightbulb" style="color: #F59E0B; font-size: 16px;"></i>
                    <span><strong>Tips Produktivitas:</strong> Tekan tombol <kbd style="background:#FFF; padding:2px 6px; border:1px solid #CBD5E1; border-radius:4px;">/</kbd> di mana saja pada aplikasi untuk langsung mencari nama pelanggan atau nomor pesanan.</span>
                </div>
            </div>

            <!-- TAB 4: KONTAK & DUKUNGAN -->
            <div class="help-tab-pane" id="helpTabContact">
                <div style="font-size: 12.5px; color: #64748B; margin-bottom: 14px;">
                    Hubungi tim bantuan teknis SIPEKAN jika mengalami kendala sistem atau membutuhkan integrasi khusus:
                </div>

                <div class="contact-grid">
                    <!-- Contact 1: WhatsApp CS -->
                    <div class="contact-card searchable-item">
                        <div class="contact-card-icon" style="background: #DCFCE7; color: #16A34A;">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div style="font-size: 13px; font-weight: 700; color: #0F172A;">WhatsApp CS Helpdesk</div>
                        <div style="font-size: 11.5px; color: #64748B;">Respon cepat untuk kasir & admin</div>
                        <a href="https://wa.me/6281234567890?text=Halo%20Tim%20Support%20SIPEKAN,%20saya%20membutuhkan%20bantuan" target="_blank" class="btn-primary" style="background:#16A34A; color:white; padding:6px 14px; border-radius:6px; font-size:11.5px; font-weight:700; text-decoration:none; margin-top:4px;">
                            Chat WhatsApp
                        </a>
                    </div>

                    <!-- Contact 2: Call Support -->
                    <div class="contact-card searchable-item">
                        <div class="contact-card-icon" style="background: #EFF6FF; color: #2563EB;">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div style="font-size: 13px; font-weight: 700; color: #0F172A;">Layanan Telepon Kantor</div>
                        <div style="font-size: 11.5px; color: #64748B;">Senin – Sabtu (08:00 – 17:00 WIB)</div>
                        <a href="tel:+62215550192" class="btn-primary" style="background:#2563EB; color:white; padding:6px 14px; border-radius:6px; font-size:11.5px; font-weight:700; text-decoration:none; margin-top:4px;">
                            +62 21 555 0192
                        </a>
                    </div>

                    <!-- Contact 3: Email Support -->
                    <div class="contact-card searchable-item">
                        <div class="contact-card-icon" style="background: #EEF2FF; color: #4F46E5;">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <div style="font-size: 13px; font-weight: 700; color: #0F172A;">Email Dukungan Teknis</div>
                        <div style="font-size: 11.5px; color: #64748B;">Kirim tiket & laporan bug</div>
                        <a href="mailto:support@sipekan.co.id?subject=Bantuan%20Sistem%20SIPEKAN" class="btn-primary" style="background:#4F46E5; color:white; padding:6px 14px; border-radius:6px; font-size:11.5px; font-weight:700; text-decoration:none; margin-top:4px;">
                            support@sipekan.co.id
                        </a>
                    </div>
                </div>

                <!-- Server & System Status Info -->
                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px 18px; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: #10B981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);"></span>
                        <div>
                            <div style="font-size: 12.5px; font-weight: 700; color: #0F172A;">Status Sistem SIPEKAN: Beroperasi Normal</div>
                            <div style="font-size: 11.5px; color: #64748B;">Database, Layanan Cloudflare, & Kasir Terhubung</div>
                        </div>
                    </div>
                    <div style="font-size: 11px; font-weight: 700; color: #64748B; background: #E2E8F0; padding: 3px 8px; border-radius: 6px;">v2.4 Pro</div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="help-modal-footer">
            <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #64748B;">
                <i class="fa-solid fa-circle-info" style="color: #2563EB;"></i>
                <span>Tekan <kbd style="background:#FFF; padding:1px 5px; border:1px solid #CBD5E1; border-radius:4px; font-size:11px;">Esc</kbd> untuk menutup panduan</span>
            </div>
            <button type="button" class="closeHelpModal" style="background: #1E3A8A; color: #FFFFFF; border: none; padding: 8px 18px; border-radius: 8px; font-size: 12.5px; font-weight: 700; cursor: pointer; transition: all 0.15s ease;">
                Tutup Panduan
            </button>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="app-modal-overlay" id="profileModal">
    <div class="app-modal-box">
        <div class="app-modal-header">
            <div class="app-modal-title">
                <i class="fa-regular fa-user" style="color: #1E3A8A;"></i>
                <span>{{ ($isKasir ?? false) ? 'Profil Kasir' : 'Profil Administrator' }}</span>
            </div>
            <button class="app-modal-close closeProfileModal">&times;</button>
        </div>
        <form id="profileForm"
            onsubmit="event.preventDefault(); alert('Profil berhasil diperbarui!'); document.getElementById('profileModal').classList.remove('active');">
            <div
                style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #F1F5F9;">
                <img src="{{ asset('assets/images/admin-avatar.png') }}" alt="User"
                    style="width: 64px; height: 64px; border-radius: 50%; object-fit: cover; border: 2px solid #E2E8F0;">
                <div>
                    <div style="font-weight: 800; font-size: 16px; color: #0F172A;">
                        {{ $authUserName ?? 'Admin SIPEKAN' }}</div>
                    <div style="font-size: 12.5px; color: #64748B;">
                        {{ ($isKasir ?? false) ? 'Staff Kasir Operasional' : 'Super Administrator' }}</div>
                    <span
                        style="display: inline-block; background-color: #DCFCE7; color: #16A34A; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 10px; margin-top: 4px;">Status:
                        Aktif</span>
                </div>
            </div>

            <div style="margin-bottom: 14px;">
                <label
                    style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Nama
                    Lengkap</label>
                <input type="text" value="{{ $authUserName ?? 'Admin SIPEKAN' }}"
                    style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 9px 12px; font-size: 13.5px; outline: none;">
            </div>

            <div style="margin-bottom: 14px;">
                <label
                    style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Email</label>
                <input type="email" value="{{ $authUserEmail ?? 'admin@sipekan.co.id' }}"
                    style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 9px 12px; font-size: 13.5px; outline: none;">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px;">
                <button type="button" class="closeProfileModal"
                    style="background-color: #F1F5F9; color: #475569; border: none; padding: 9px 18px; border-radius: 8px; font-weight: 600; cursor: pointer;">Batal</button>
                <button type="submit"
                    style="background-color: #1B3B6F; color: white; border: none; padding: 9px 20px; border-radius: 8px; font-weight: 700; cursor: pointer;">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Live Jakarta Realtime Clock Engine (WIB)
        function updateJakartaClock() {
            const clockEl = document.getElementById('digitalClockTime');
            if (!clockEl) return;
            const now = new Date();
            const options = {
                timeZone: 'Asia/Jakarta',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const timeStr = new Intl.DateTimeFormat('id-ID', options).format(now).replace(/\./g, ':');
            clockEl.textContent = timeStr + ' WIB';
        }
        setInterval(updateJakartaClock, 1000);
        updateJakartaClock();

        // Global Navigation & Items Data Engine for Live Search
        const searchData = [
            // Navigation Pages
            { title: 'Dasbor (Dashboard)', category: 'Menu & Navigasi', catClass: 'cat-menu', sub: 'Ringkasan & Statistik Utama', icon: 'fa-table-cells-large', url: '{{ route("dashboard") }}' },
            { title: 'Kelola Pelanggan', category: 'Menu & Navigasi', catClass: 'cat-menu', sub: 'Daftar & Detail Pelanggan', icon: 'fa-users', url: '{{ route("pelanggan") }}' },
            { title: 'Katalog Produk', category: 'Menu & Navigasi', catClass: 'cat-menu', sub: 'Daftar Produk & Harga Dasar', icon: 'fa-box-archive', url: '{{ route("produk") }}' },
            { title: 'Kelola Pesanan', category: 'Menu & Navigasi', catClass: 'cat-menu', sub: 'Transaksi & Order Pelanggan', icon: 'fa-file-invoice', url: '{{ route("pesanan") }}' },
            { title: 'Kelola Pembayaran', category: 'Menu & Navigasi', catClass: 'cat-menu', sub: 'Catatan & Status Pembayaran', icon: 'fa-credit-card', url: '{{ route("pembayaran") }}' },
            { title: 'Laporan & Statistik', category: 'Menu & Navigasi', catClass: 'cat-menu', sub: 'Laporan Penjualan & Keuangan', icon: 'fa-chart-column', url: '{{ route("laporan") }}' },
            { title: 'Pengaturan Sistem', category: 'Menu & Navigasi', catClass: 'cat-menu', sub: 'Konfigurasi Aplikasi & Profil', icon: 'fa-gear', url: '{{ route("pengaturan") }}' },

            @foreach($dbPelanggan as $pel)
                {
                        title: {!! json_encode($pel->nama ?? 'Pelanggan') !!},
                        category: 'Pelanggan',
                        catClass: 'cat-pelanggan',
                        sub: {!! json_encode(($pel->kode_pelanggan ? $pel->kode_pelanggan . ' • ' : '') . ($pel->no_hp ?? $pel->email ?? 'Data Pelanggan')) !!},
                        icon: 'fa-building',
                        url: '{{ route("pelanggan") }}?search=' + encodeURIComponent({!! json_encode($pel->nama ?? '') !!})
                    },
            @endforeach

            @foreach($dbProduk as $prod)
                {
                        title: {!! json_encode($prod->nama_produk ?? 'Produk') !!},
                        category: 'Produk',
                        catClass: 'cat-produk',
                        sub: {!! json_encode(($prod->kategori ? $prod->kategori . ' • ' : '') . 'Rp ' . number_format($prod->harga ?? 0, 0, ',', '.')) !!},
                        icon: 'fa-box',
                        url: '{{ route("produk") }}?search=' + encodeURIComponent({!! json_encode($prod->nama_produk ?? '') !!})
                    },
            @endforeach

            @foreach($dbPesanan as $ord)
                {
                        title: {!! json_encode(($ord->kode_pesanan ?? 'ORD') . ' - ' . ($ord->nama_pelanggan ?? '')) !!},
                        category: 'Pesanan',
                        catClass: 'cat-pesanan',
                        sub: {!! json_encode(($ord->nama_produk ?? '') . ' • Rp ' . number_format($ord->total_harga ?? 0, 0, ',', '.') . ' (' . ($ord->status ?? 'Diproses') . ')') !!},
                        icon: 'fa-receipt',
                        url: '{{ route("pesanan") }}?search=' + encodeURIComponent({!! json_encode($ord->kode_pesanan ?? '') !!})
                    },
            @endforeach

            @foreach($dbPembayaran as $pay)
                {
                        title: {!! json_encode(($pay->kode_pembayaran ?? 'PAY') . ' (' . ($pay->kode_pesanan ?? '') . ')') !!},
                        category: 'Pembayaran',
                        catClass: 'cat-pembayaran',
                        sub: {!! json_encode(($pay->metode ?? 'Tunai') . ' • Rp ' . number_format($pay->jumlah ?? 0, 0, ',', '.') . ' (' . ($pay->status ?? 'Lunas') . ')') !!},
                        icon: 'fa-money-bill-wave',
                        url: '{{ route("pembayaran") }}?search=' + encodeURIComponent({!! json_encode($pay->kode_pembayaran ?? '') !!})
                    },
            @endforeach
    ];

        // Mobile Sidebar Toggle Logic
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (mobileBtn && sidebar && overlay) {
            mobileBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', function () {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }

        // Global Search Functionality with Live Instant Autocomplete
        const searchInputs = document.querySelectorAll('.search-input, #globalSearchInput');
        searchInputs.forEach(input => {
            const container = input.closest('.search-container') || input.closest('.search-wrap');
            if (!container) return;

            container.style.position = 'relative';

            let dropdown = container.querySelector('.search-dropdown-menu');
            if (!dropdown) {
                dropdown = document.createElement('div');
                dropdown.className = 'search-dropdown-menu';
                dropdown.innerHTML = `
                <div class="search-dropdown-header">
                    <span>Hasil Pencarian</span>
                    <span style="font-size: 10px; color: #94A3B8;">Gunakan ↑ ↓ Enter</span>
                </div>
                <div class="search-results-list"></div>
            `;
                container.appendChild(dropdown);
            }

            const resultsList = dropdown.querySelector('.search-results-list');
            let activeIndex = -1;

            function highlightMatch(text, query) {
                if (!query || !text) return text || '';
                const escaped = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                const regex = new RegExp(`(${escaped})`, 'gi');
                return text.replace(regex, '<mark class="search-highlight">$1</mark>');
            }

            function renderResults(query) {
                query = (query || '').trim();
                const lowerQuery = query.toLowerCase();
                const clearBtn = container.querySelector('#clearSearchBtn');
                if (clearBtn) clearBtn.style.display = query ? 'flex' : 'none';

                let matches = [];
                if (!query) {
                    // Show default menu shortcuts when input is focused but empty
                    matches = searchData.filter(i => i.category === 'Menu & Navigasi');
                } else {
                    matches = searchData.filter(item =>
                        item.title.toLowerCase().includes(lowerQuery) ||
                        item.category.toLowerCase().includes(lowerQuery) ||
                        (item.sub && item.sub.toLowerCase().includes(lowerQuery))
                    );
                }

                activeIndex = -1;

                if (matches.length === 0) {
                    dropdown.querySelector('.search-dropdown-header').innerHTML = `<span>Hasil Pencarian</span> <span style="font-weight:500;">0 hasil</span>`;
                    resultsList.innerHTML = `<div style="padding: 20px; text-align: center; color: #94A3B8; font-size: 13px;">
                    <i class="fa-solid fa-magnifying-glass" style="font-size: 20px; margin-bottom: 6px; display: block; color: #CBD5E1;"></i>
                    Tidak ada hasil untuk "<strong>${query}</strong>"
                </div>`;
                } else {
                    const headerText = !query ? 'Pintasan Navigasi Cepat' : `Hasil Pencarian (${matches.length})`;
                    dropdown.querySelector('.search-dropdown-header').innerHTML = `<span>${headerText}</span> <span style="font-size: 10px; color: #94A3B8;">Gunakan ↑ ↓ Enter</span>`;

                    resultsList.innerHTML = matches.map((item, idx) => `
                    <a href="${item.url}" class="search-result-item" data-index="${idx}">
                        <div class="search-result-icon"><i class="fa-solid ${item.icon}"></i></div>
                        <div class="search-result-info">
                            <div class="search-result-title">${highlightMatch(item.title, query)}</div>
                            <div class="search-result-sub">${highlightMatch(item.sub || item.category, query)}</div>
                        </div>
                        <span class="search-cat-badge ${item.catClass || 'cat-menu'}">${item.category}</span>
                    </a>
                `).join('');
                }

                dropdown.classList.add('show');
            }

            input.addEventListener('input', function (e) {
                renderResults(e.target.value);
            });

            input.addEventListener('focus', function (e) {
                renderResults(e.target.value);
            });

            input.addEventListener('keydown', function (e) {
                const items = resultsList.querySelectorAll('.search-result-item');
                if (!dropdown.classList.contains('show') || items.length === 0) return;

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    activeIndex = (activeIndex + 1) % items.length;
                    updateActiveItem(items);
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    activeIndex = (activeIndex - 1 + items.length) % items.length;
                    updateActiveItem(items);
                } else if (e.key === 'Enter') {
                    if (activeIndex >= 0 && items[activeIndex]) {
                        e.preventDefault();
                        items[activeIndex].click();
                    }
                }
            });

            function updateActiveItem(items) {
                items.forEach((item, idx) => {
                    if (idx === activeIndex) {
                        item.classList.add('active');
                        item.scrollIntoView({ block: 'nearest' });
                    } else {
                        item.classList.remove('active');
                    }
                });
            }

            const clearBtn = container.querySelector('#clearSearchBtn');
            if (clearBtn) {
                clearBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    input.value = '';
                    this.style.display = 'none';
                    renderResults('');
                    input.focus();
                });
            }
        });

        // Auto-filter local page table if URL has ?search=...
        const urlParams = new URLSearchParams(window.location.search);
        const searchParam = urlParams.get('search');
        if (searchParam) {
            setTimeout(function () {
                const pageInput = document.querySelector('.filter-input-box input, .search-filter input, #paySearchInput, #cusSearchInput');
                if (pageInput) {
                    pageInput.value = searchParam;
                    pageInput.dispatchEvent(new Event('keyup'));
                    pageInput.dispatchEvent(new Event('input'));
                }
            }, 100);
        }

        // Notifications Dropdown Logic with Persistent localStorage State
        const notifBtn = document.getElementById('notifBellBtn');
        const notifDropdown = document.getElementById('notifDropdown');
        const markReadBtn = document.getElementById('markAllReadBtn');
        const notifBadge = document.querySelector('.notif-badge');

        function applyNotifReadState() {
            const isAllRead = localStorage.getItem('sipekan_notif_read_all') === 'true';
            const readItems = JSON.parse(localStorage.getItem('sipekan_read_notif_ids') || '[]');

            if (isAllRead) {
                document.querySelectorAll('.notif-item').forEach(el => el.classList.remove('unread'));
                if (notifBadge) notifBadge.style.display = 'none';
            } else {
                let unreadCount = 0;
                document.querySelectorAll('.notif-item').forEach((el, index) => {
                    const id = el.getAttribute('data-notif-id') || String(index + 1);
                    if (readItems.includes(id)) {
                        el.classList.remove('unread');
                    } else if (el.classList.contains('unread')) {
                        unreadCount++;
                    }
                });

                if (notifBadge) {
                    if (unreadCount > 0) {
                        notifBadge.textContent = unreadCount;
                        notifBadge.style.display = 'inline-block';
                    } else {
                        notifBadge.style.display = 'none';
                    }
                }
            }
        }

        applyNotifReadState();

        if (notifBtn && notifDropdown) {
            notifBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                closeAllDropdowns(notifDropdown);
                notifDropdown.classList.toggle('show');
            });
        }

        if (markReadBtn) {
            markReadBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                localStorage.setItem('sipekan_notif_read_all', 'true');
                applyNotifReadState();
            });
        }

        document.querySelectorAll('.notif-item').forEach((item, index) => {
            item.addEventListener('click', function() {
                const id = this.getAttribute('data-notif-id') || String(index + 1);
                let readItems = JSON.parse(localStorage.getItem('sipekan_read_notif_ids') || '[]');
                if (!readItems.includes(id)) {
                    readItems.push(id);
                    localStorage.setItem('sipekan_read_notif_ids', JSON.stringify(readItems));
                }
                applyNotifReadState();
            });
        });

        // User Profile Dropdown Logic
        const userProfileBtn = document.getElementById('userProfileBtn') || document.querySelector('.user-profile');
        const userProfileDropdown = document.getElementById('userProfileDropdown');

        if (userProfileBtn && userProfileDropdown) {
            userProfileBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                closeAllDropdowns(userProfileDropdown);
                userProfileDropdown.classList.toggle('show');
                if (userProfileBtn.closest('.user-profile-wrapper')) {
                    userProfileBtn.closest('.user-profile-wrapper').classList.toggle('active');
                }
            });
        }

        // Help Modal Logic & Interactions
        const helpBtns = [document.getElementById('helpModalBtn'), document.getElementById('helpModalProfileLink')].filter(Boolean);
        const helpModal = document.getElementById('helpModal');
        const closeHelpBtns = document.querySelectorAll('.closeHelpModal');

        helpBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                closeAllDropdowns();
                if (helpModal) helpModal.classList.add('active');
            });
        });

        closeHelpBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                if (helpModal) helpModal.classList.remove('active');
            });
        });

        if (helpModal) {
            helpModal.addEventListener('click', function (e) {
                if (e.target === helpModal) {
                    helpModal.classList.remove('active');
                }
            });
        }

        // Help Modal Tabs Switcher
        const helpTabBtns = document.querySelectorAll('.help-tab-link');
        const helpTabPanes = document.querySelectorAll('.help-tab-pane');

        helpTabBtns.forEach(tabBtn => {
            tabBtn.addEventListener('click', function () {
                const targetTabId = this.getAttribute('data-tab');
                helpTabBtns.forEach(b => b.classList.remove('active'));
                helpTabPanes.forEach(p => p.classList.remove('active'));

                this.classList.add('active');
                const targetPane = document.getElementById(targetTabId);
                if (targetPane) targetPane.classList.add('active');
            });
        });

        // FAQ Accordion Toggle
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const btn = item.querySelector('.faq-question-btn');
            if (btn) {
                btn.addEventListener('click', function () {
                    const isActive = item.classList.contains('active');
                    faqItems.forEach(fi => fi.classList.remove('active'));
                    if (!isActive) {
                        item.classList.add('active');
                    }
                });
            }
        });

        // Live Real-Time Search Filter inside Help Center
        const helpFilterInput = document.getElementById('helpFilterInput');
        if (helpFilterInput) {
            helpFilterInput.addEventListener('input', function () {
                const q = this.value.toLowerCase().trim();
                const searchableItems = document.querySelectorAll('.searchable-item');

                if (!q) {
                    searchableItems.forEach(el => el.style.display = '');
                    return;
                }

                // If user starts searching, automatically open matching items and activate relevant tab if needed
                searchableItems.forEach(el => {
                    const text = el.textContent.toLowerCase();
                    if (text.includes(q)) {
                        el.style.display = '';
                        if (el.classList.contains('faq-item')) {
                            el.classList.add('active'); // Expand matching FAQ
                        }
                    } else {
                        el.style.display = 'none';
                    }
                });
            });
        }

        const triggerSearchShortcutBtn = document.getElementById('triggerSearchShortcutBtn');
        if (triggerSearchShortcutBtn) {
            triggerSearchShortcutBtn.addEventListener('click', function () {
                if (helpModal) helpModal.classList.remove('active');
                const searchInput = document.querySelector('.search-input');
                if (searchInput) {
                    setTimeout(() => searchInput.focus(), 150);
                }
            });
        }

        const triggerEscShortcutBtn = document.getElementById('triggerEscShortcutBtn');
        if (triggerEscShortcutBtn) {
            triggerEscShortcutBtn.addEventListener('click', function () {
                if (helpModal) helpModal.classList.remove('active');
                if (typeof window.showAppToast === 'function') {
                    window.showAppToast('Pintasan Esc aktif untuk menutup modal & menu', 'info');
                }
            });
        }

        // Profile Modal Logic
        const myProfileLink = document.getElementById('myProfileModalLink');
        const profileModal = document.getElementById('profileModal');
        const closeProfileBtns = document.querySelectorAll('.closeProfileModal');

        if (myProfileLink && profileModal) {
            myProfileLink.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                closeAllDropdowns();
                profileModal.classList.add('active');
            });
        }

        closeProfileBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                if (profileModal) profileModal.classList.remove('active');
            });
        });

        if (profileModal) {
            profileModal.addEventListener('click', function (e) {
                if (e.target === profileModal) {
                    profileModal.classList.remove('active');
                }
            });
        }

        // Keyboard shortcut '/' to search & 'Escape' to close all modals/dropdowns
        document.addEventListener('keydown', function (e) {
            if (e.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
                e.preventDefault();
                const firstSearch = document.querySelector('.search-input');
                if (firstSearch) firstSearch.focus();
            } else if (e.key === 'Escape') {
                closeAllDropdowns();
                if (helpModal) helpModal.classList.remove('active');
                if (profileModal) profileModal.classList.remove('active');
                if (sidebar) sidebar.classList.remove('active');
                if (overlay) overlay.classList.remove('active');
            }
        });

        // Helper: Close all open dropdowns except current
        function closeAllDropdowns(exceptElement) {
            document.querySelectorAll('.search-dropdown-menu, .notif-dropdown-card, .profile-dropdown-card').forEach(el => {
                if (el !== exceptElement) {
                    el.classList.remove('show');
                }
            });
            document.querySelectorAll('.user-profile-wrapper').forEach(el => el.classList.remove('active'));
        }

        // Click outside handler
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.search-container') && !e.target.closest('.search-wrap')) {
                document.querySelectorAll('.search-dropdown-menu').forEach(el => el.classList.remove('show'));
            }
            if (!e.target.closest('#notifBellBtn') && !e.target.closest('#notifDropdown')) {
                if (notifDropdown) notifDropdown.classList.remove('show');
            }
            if (!e.target.closest('.user-profile') && !e.target.closest('#userProfileDropdown')) {
                if (userProfileDropdown) userProfileDropdown.classList.remove('show');
                document.querySelectorAll('.user-profile-wrapper').forEach(el => el.classList.remove('active'));
            }
        });

        // Global Toast Notification Helper for Interactive Prototype Buttons
        window.showAppToast = function (message, type = 'info') {
            let toastContainer = document.getElementById('appToastContainer');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'appToastContainer';
                toastContainer.style.cssText = 'position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; pointer-events: none;';
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            const bgColor = type === 'success' ? '#059669' : type === 'warning' ? '#D97706' : type === 'error' ? '#DC2626' : '#1E3A8A';
            const icon = type === 'success' ? 'fa-circle-check' : type === 'warning' ? 'fa-triangle-exclamation' : type === 'error' ? 'fa-circle-xmark' : 'fa-circle-info';

            toast.style.cssText = `background: ${bgColor}; color: #FFFFFF; padding: 12px 18px; border-radius: 10px; font-size: 13.5px; font-weight: 700; display: flex; align-items: center; gap: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.18); opacity: 0; transform: translateY(12px); transition: all 0.25s ease; pointer-events: auto;`;
            toast.innerHTML = `<i class="fa-solid ${icon}"></i> <span>${message}</span>`;
            toastContainer.appendChild(toast);

            requestAnimationFrame(() => {
                toast.style.opacity = '1';
                toast.style.transform = 'translateY(0)';
            });

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(12px)';
                setTimeout(() => toast.remove(), 300);
            }, 3200);
        };

        // Global Automatic Dropup positioning for table action menus
        document.addEventListener('click', function (e) {
            const toggle = e.target.closest('.action-toggle, .action-icon-btn');
            if (toggle) {
                const parent = toggle.closest('.action-dropdown') || toggle.parentElement;
                const menu = parent ? parent.querySelector('.dropdown-menu') : toggle.nextElementSibling;
                if (menu) {
                    const rect = toggle.getBoundingClientRect();
                    const row = toggle.closest('tr');
                    let isLastRows = false;
                    if (row && row.parentElement) {
                        const rows = Array.from(row.parentElement.children).filter(r => r.offsetParent !== null);
                        const index = rows.indexOf(row);
                        if (rows.length > 2 && index >= rows.length - 2) {
                            isLastRows = true;
                        }
                    }
                    const spaceBelow = window.innerHeight - rect.bottom;
                    if (spaceBelow < 220 || isLastRows) {
                        menu.classList.add('dropup');
                    } else {
                        menu.classList.remove('dropup');
                    }
                }
            }
        }, true);

        @if(session('success'))
            window.showAppToast(@json(session('success')), 'success');
        @endif
        @if(session('error'))
            window.showAppToast(@json(session('error')), 'error');
        @endif
});
</script>