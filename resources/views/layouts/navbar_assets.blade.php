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
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
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
    .search-container, .search-wrap {
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

    .search-result-item:hover, .search-result-item.active {
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

    .search-cat-badge.cat-menu { background: #EFF6FF; color: #1E3A8A; }
    .search-cat-badge.cat-pelanggan { background: #DCFCE7; color: #15803D; }
    .search-cat-badge.cat-produk { background: #F3E8FF; color: #6B21A8; }
    .search-cat-badge.cat-pesanan { background: #FEF3C7; color: #B45309; }
    .search-cat-badge.cat-pembayaran { background: #D1FAE5; color: #047857; }

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

    .notif-icon.blue { background-color: #EFF6FF; color: #2563EB; }
    .notif-icon.green { background-color: #DCFCE7; color: #16A34A; }
    .notif-icon.orange { background-color: #FFEDD5; color: #EA580C; }

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
    }
    .table-responsive th,
    .table-responsive td,
    .custom-table th,
    .custom-table td,
    .order-link,
    .order-code,
    .pay-id,
    .inv-code,
    .cus-id,
    .cus-name,
    .contact-info {
        white-space: nowrap !important;
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

        .search-container, .search-wrap {
            width: 180px;
        }

        .user-name-label {
            display: none;
        }
    }
</style>

<!-- Sidebar Overlay Backdrop for Mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Help Modal -->
<div class="app-modal-overlay" id="helpModal">
    <div class="app-modal-box">
        <div class="app-modal-header">
            <div class="app-modal-title">
                <i class="fa-regular fa-circle-question" style="color: #1E3A8A;"></i>
                <span>Pusat Bantuan & Panduan</span>
            </div>
            <button class="app-modal-close closeHelpModal">&times;</button>
        </div>
        <div style="font-size: 13.5px; color: #475569; line-height: 1.6;">
            <p style="margin-bottom: 12px;">Selamat datang di Konsol Manajemen <strong>SIPEKAN</strong>. Berikut adalah panduan ringkas navigasi sistem:</p>

            <div style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 14px; margin-bottom: 16px;">
                <div style="font-weight: 700; color: #0F172A; margin-bottom: 8px;">Pintasan Papan Ketik (Shortcuts):</div>
                <ul style="padding-left: 0; list-style: none; display: flex; flex-direction: column; gap: 8px; margin: 0;">
                    <li>
                        <button type="button" id="triggerSearchShortcutBtn" style="background: none; border: none; padding: 0; font-size: 13.5px; color: #475569; text-align: left; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <code style="background:#EEF2FF; padding: 3px 8px; border-radius: 6px; color: #1E3A8A; font-weight: 700; border: 1px solid #C7D2FE;">/</code>
                            <span>Fokus langsung ke Pencarian Utama (Global Search)</span>
                        </button>
                    </li>
                    <li>
                        <button type="button" id="triggerEscShortcutBtn" style="background: none; border: none; padding: 0; font-size: 13.5px; color: #475569; text-align: left; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <code style="background:#EEF2FF; padding: 3px 8px; border-radius: 6px; color: #1E3A8A; font-weight: 700; border: 1px solid #C7D2FE;">Esc</code>
                            <span>Menutup semua menu popup & modal</span>
                        </button>
                    </li>
                </ul>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px;">
                <div style="font-weight: 700; color: #0F172A;">Dukungan Teknis & Layanan:</div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-phone" style="color: #2563EB;"></i>
                    <a href="tel:+62215550192" style="color: #1E3A8A; font-weight: 600; text-decoration: none;">+62 21 555 0192 (Jam Kerja: 08.00 - 17.00 WIB)</a>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fa-regular fa-envelope" style="color: #2563EB;"></i>
                    <a href="mailto:support@sipekan.co.id" style="color: #1E3A8A; font-weight: 600; text-decoration: none;">support@sipekan.co.id</a>
                </div>
            </div>
        </div>
        <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
            <button class="btn-primary closeHelpModal" style="background-color: #1B3B6F; color: white; border: none; padding: 9px 20px; border-radius: 8px; font-weight: 700; cursor: pointer;">Mengerti</button>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="app-modal-overlay" id="profileModal">
    <div class="app-modal-box">
        <div class="app-modal-header">
            <div class="app-modal-title">
                <i class="fa-regular fa-user" style="color: #1E3A8A;"></i>
                <span>Profil Administrator</span>
            </div>
            <button class="app-modal-close closeProfileModal">&times;</button>
        </div>
        <form id="profileForm" onsubmit="event.preventDefault(); alert('Profil berhasil diperbarui!'); document.getElementById('profileModal').classList.remove('active');">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #F1F5F9;">
                <img src="{{ asset('assets/images/admin-avatar.png') }}" alt="Admin" style="width: 64px; height: 64px; border-radius: 50%; object-fit: cover; border: 2px solid #E2E8F0;">
                <div>
                    <div style="font-weight: 800; font-size: 16px; color: #0F172A;">Admin SIPEKAN</div>
                    <div style="font-size: 12.5px; color: #64748B;">Super Administrator</div>
                    <span style="display: inline-block; background-color: #DCFCE7; color: #16A34A; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 10px; margin-top: 4px;">Status: Aktif</span>
                </div>
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Nama Lengkap</label>
                <input type="text" value="Admin SIPEKAN" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 9px 12px; font-size: 13.5px; outline: none;">
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Email</label>
                <input type="email" value="admin@sipekan.co.id" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 9px 12px; font-size: 13.5px; outline: none;">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px;">
                <button type="button" class="closeProfileModal" style="background-color: #F1F5F9; color: #475569; border: none; padding: 9px 18px; border-radius: 8px; font-weight: 600; cursor: pointer;">Batal</button>
                <button type="submit" style="background-color: #1B3B6F; color: white; border: none; padding: 9px 20px; border-radius: 8px; font-weight: 700; cursor: pointer;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
        mobileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function() {
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

        input.addEventListener('input', function(e) {
            renderResults(e.target.value);
        });

        input.addEventListener('focus', function(e) {
            renderResults(e.target.value);
        });

        input.addEventListener('keydown', function(e) {
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
            clearBtn.addEventListener('click', function(e) {
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
        setTimeout(function() {
            const pageInput = document.querySelector('.filter-input-box input, .search-filter input, #paySearchInput, #cusSearchInput');
            if (pageInput) {
                pageInput.value = searchParam;
                pageInput.dispatchEvent(new Event('keyup'));
                pageInput.dispatchEvent(new Event('input'));
            }
        }, 100);
    }

    // Notifications Dropdown Logic
    const notifBtn = document.getElementById('notifBellBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    const markReadBtn = document.getElementById('markAllReadBtn');
    const notifBadge = document.querySelector('.notif-badge');

    if (notifBtn && notifDropdown) {
        notifBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            closeAllDropdowns(notifDropdown);
            notifDropdown.classList.toggle('show');
        });
    }

    if (markReadBtn && notifBadge) {
        markReadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            document.querySelectorAll('.notif-item.unread').forEach(el => el.classList.remove('unread'));
            notifBadge.style.display = 'none';
        });
    }

    // User Profile Dropdown Logic
    const userProfileBtn = document.getElementById('userProfileBtn') || document.querySelector('.user-profile');
    const userProfileDropdown = document.getElementById('userProfileDropdown');

    if (userProfileBtn && userProfileDropdown) {
        userProfileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            closeAllDropdowns(userProfileDropdown);
            userProfileDropdown.classList.toggle('show');
            if (userProfileBtn.closest('.user-profile-wrapper')) {
                userProfileBtn.closest('.user-profile-wrapper').classList.toggle('active');
            }
        });
    }

    // Help Modal Logic
    const helpBtns = [document.getElementById('helpModalBtn'), document.getElementById('helpModalProfileLink')].filter(Boolean);
    const helpModal = document.getElementById('helpModal');
    const closeHelpBtns = document.querySelectorAll('.closeHelpModal');

    helpBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeAllDropdowns();
            if (helpModal) helpModal.classList.add('active');
        });
    });

    closeHelpBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            if (helpModal) helpModal.classList.remove('active');
        });
    });

    if (helpModal) {
        helpModal.addEventListener('click', function(e) {
            if (e.target === helpModal) {
                helpModal.classList.remove('active');
            }
        });
    }

    const triggerSearchShortcutBtn = document.getElementById('triggerSearchShortcutBtn');
    if (triggerSearchShortcutBtn) {
        triggerSearchShortcutBtn.addEventListener('click', function() {
            if (helpModal) helpModal.classList.remove('active');
            const searchInput = document.querySelector('.search-input');
            if (searchInput) {
                setTimeout(() => searchInput.focus(), 150);
            }
        });
    }

    const triggerEscShortcutBtn = document.getElementById('triggerEscShortcutBtn');
    if (triggerEscShortcutBtn) {
        triggerEscShortcutBtn.addEventListener('click', function() {
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
        myProfileLink.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeAllDropdowns();
            profileModal.classList.add('active');
        });
    }

    closeProfileBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            if (profileModal) profileModal.classList.remove('active');
        });
    });

    if (profileModal) {
        profileModal.addEventListener('click', function(e) {
            if (e.target === profileModal) {
                profileModal.classList.remove('active');
            }
        });
    }

    // Keyboard shortcut '/' to search & 'Escape' to close all modals/dropdowns
    document.addEventListener('keydown', function(e) {
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
    document.addEventListener('click', function(e) {
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
    window.showAppToast = function(message, type = 'info') {
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

    @if(session('success'))
        window.showAppToast(@json(session('success')), 'success');
    @endif
    @if(session('error'))
        window.showAppToast(@json(session('error')), 'error');
    @endif
});
</script>
