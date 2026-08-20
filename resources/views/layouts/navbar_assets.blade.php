<style>
    /* Navbar Unified Interactive Styles */
    
    /* Topbar Right Enhancements */
    .topbar-right {
        display: flex;
        align-items: center;
        gap: 16px;
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
        width: 340px;
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
        padding: 9px 14px 9px 38px;
        font-size: 13.5px;
        color: #1E293B;
        outline: none;
        transition: all 0.2s ease;
    }

    .search-input:focus {
        background-color: #FFFFFF;
        border-color: #CBD5E1;
        box-shadow: 0 0 0 3px rgba(226, 232, 240, 0.6);
    }

    .search-dropdown-menu {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        right: 0;
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
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
    }

    .search-results-list {
        max-height: 320px;
        overflow-y: auto;
    }

    .search-result-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 16px;
        text-decoration: none;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        transition: background 0.15s ease;
        border-bottom: 1px solid #F8FAFC;
    }

    .search-result-item:hover {
        background-color: #EEF2FF;
        color: #1E3A8A;
    }

    .search-result-icon {
        width: 32px;
        height: 32px;
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
    }

    .search-result-title {
        font-weight: 700;
        color: #0F172A;
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

    /* Global Table Responsive Utility */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin-bottom: 0;
    }
    .table-responsive th,
    .order-link,
    .order-code,
    .pay-id,
    .inv-code,
    .cus-id {
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
            <button class="app-modal-close" class="closeHelpModal">&times;</button>
        </div>
        <div style="font-size: 13.5px; color: #475569; line-height: 1.6;">
            <p style="margin-bottom: 12px;">Selamat datang di Konsol Manajemen <strong>CV Prima Grafika</strong>. Berikut adalah panduan ringkas navigasi sistem:</p>

            <div style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 14px; margin-bottom: 16px;">
                <div style="font-weight: 700; color: #0F172A; margin-bottom: 8px;">Pintasan Papan Ketik (Shortcuts):</div>
                <ul style="padding-left: 20px; display: flex; flex-direction: column; gap: 6px;">
                    <li><code style="background:#EEF2FF; padding: 2px 6px; border-radius: 4px; color: #1E3A8A;">/</code> – Fokus langsung ke Pencarian Utama (Global Search)</li>
                    <li><code style="background:#EEF2FF; padding: 2px 6px; border-radius: 4px; color: #1E3A8A;">Esc</code> – Menutup semua menu popup & modal</li>
                </ul>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px;">
                <div style="font-weight: 700; color: #0F172A;">Dukungan Teknis & Layanan:</div>
                <div style="display: flex; align-items: center; gap: 10px;"><i class="fa-solid fa-phone" style="color: #2563EB;"></i><span>+62 21 555 0192 (Jam Kerja: 08.00 - 17.00 WIB)</span></div>
                <div style="display: flex; align-items: center; gap: 10px;"><i class="fa-regular fa-envelope" style="color: #2563EB;"></i><span>support@primagrafika.co.id</span></div>
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
            <button class="app-modal-close" class="closeProfileModal">&times;</button>
        </div>
        <form id="profileForm" onsubmit="event.preventDefault(); alert('Profil berhasil diperbarui!'); document.getElementById('profileModal').classList.remove('active');">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #F1F5F9;">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&auto=format&fit=crop&q=80" alt="Admin" style="width: 64px; height: 64px; border-radius: 50%; object-fit: cover; border: 2px solid #E2E8F0;">
                <div>
                    <div style="font-weight: 800; font-size: 16px; color: #0F172A;">Admin Prima Grafika</div>
                    <div style="font-size: 12.5px; color: #64748B;">Super Administrator</div>
                    <span style="display: inline-block; background-color: #DCFCE7; color: #16A34A; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 10px; margin-top: 4px;">Status: Aktif</span>
                </div>
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Nama Lengkap</label>
                <input type="text" value="Admin Prima Grafika" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 9px 12px; font-size: 13.5px; outline: none;">
            </div>

            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Email</label>
                <input type="email" value="admin@primagrafika.co.id" style="width: 100%; border: 1px solid #CBD5E1; border-radius: 8px; padding: 9px 12px; font-size: 13.5px; outline: none;">
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
    // Global Navigation & Items Data Engine for Live Search
    const searchData = [
        // Navigation Pages
        { title: 'Dasbor (Dashboard)', category: 'Halaman Utama', icon: 'fa-table-cells-large', url: '{{ route("dashboard") }}' },
        { title: 'Kelola Pelanggan', category: 'Navigasi', icon: 'fa-users', url: '{{ route("pelanggan") }}' },
        { title: 'Katalog Produk', category: 'Navigasi', icon: 'fa-box-archive', url: '{{ route("produk") }}' },
        { title: 'Kelola Pesanan', category: 'Navigasi', icon: 'fa-file-invoice', url: '{{ route("pesanan") }}' },
        { title: 'Kelola Pembayaran', category: 'Navigasi', icon: 'fa-credit-card', url: '{{ route("pembayaran") }}' },
        { title: 'Laporan & Statistik', category: 'Navigasi', icon: 'fa-chart-column', url: '{{ route("laporan") }}' },
        { title: 'Pengaturan Sistem', category: 'Navigasi', icon: 'fa-gear', url: '{{ route("pengaturan") }}' },
        
        // Sample Customers
        { title: 'TechSynergy Solutions', category: 'Pelanggan', icon: 'fa-building', url: '{{ route("pelanggan") }}' },
        { title: 'PT Mitra Jaya Makmur', category: 'Pelanggan', icon: 'fa-building', url: '{{ route("pelanggan") }}' },
        { title: 'Creative Media Studio', category: 'Pelanggan', icon: 'fa-building', url: '{{ route("pelanggan") }}' },
        { title: 'Acme Corp', category: 'Pelanggan', icon: 'fa-user', url: '{{ route("pelanggan") }}' },
        
        // Sample Products
        { title: 'Kartu Nama Premium (Laminasi)', category: 'Produk', icon: 'fa-id-card', url: '{{ route("produk") }}' },
        { title: 'Brosur A5 Art Paper 120gr', category: 'Produk', icon: 'fa-file-lines', url: '{{ route("produk") }}' },
        { title: 'Spanduk Flexy Korea 440gr', category: 'Produk', icon: 'fa-scroll', url: '{{ route("produk") }}' },
        { title: 'Stiker Chromo A3+', category: 'Produk', icon: 'fa-note-sticky', url: '{{ route("produk") }}' },
        
        // Sample Orders
        { title: 'ORD-2023-001 (Business Cards)', category: 'Pesanan', icon: 'fa-receipt', url: '{{ route("pesanan") }}' },
        { title: 'ORD-2023-005 (Spanduk Vinyl)', category: 'Pesanan', icon: 'fa-receipt', url: '{{ route("pesanan") }}' },
        { title: 'PAY-1006 (Pembayaran QRIS)', category: 'Pembayaran', icon: 'fa-money-bill-check', url: '{{ route("pembayaran") }}' }
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

    // Global Search Functionality
    const searchInputs = document.querySelectorAll('.search-input, #globalSearchInput');
    searchInputs.forEach(input => {
        const container = input.closest('.search-container') || input.closest('.search-wrap');
        if (!container) return;

        // Ensure container has relative position
        container.style.position = 'relative';

        // Check or create search dropdown
        let dropdown = container.querySelector('.search-dropdown-menu');
        if (!dropdown) {
            dropdown = document.createElement('div');
            dropdown.className = 'search-dropdown-menu';
            dropdown.innerHTML = `
                <div class="search-dropdown-header">Hasil Pencarian Menu & Data</div>
                <div class="search-results-list"></div>
            `;
            container.appendChild(dropdown);
        }

        const resultsList = dropdown.querySelector('.search-results-list');

        function renderResults(query) {
            query = query.trim().toLowerCase();
            if (!query) {
                dropdown.classList.remove('show');
                return;
            }

            const matches = searchData.filter(item => 
                item.title.toLowerCase().includes(query) || 
                item.category.toLowerCase().includes(query)
            );

            if (matches.length === 0) {
                resultsList.innerHTML = `<div style="padding: 16px; text-align: center; color: #94A3B8; font-size: 13px;">Tidak ada hasil ditemukan</div>`;
            } else {
                resultsList.innerHTML = matches.map(item => `
                    <a href="${item.url}" class="search-result-item">
                        <div class="search-result-icon"><i class="fa-solid ${item.icon}"></i></div>
                        <div class="search-result-info">
                            <div class="search-result-title">${item.title}</div>
                            <div class="search-result-sub">${item.category}</div>
                        </div>
                        <i class="fa-solid fa-chevron-right" style="font-size: 10px; color: #CBD5E1;"></i>
                    </a>
                `).join('');
            }

            dropdown.classList.add('show');
        }

        input.addEventListener('input', function(e) {
            renderResults(e.target.value);
        });

        input.addEventListener('focus', function(e) {
            if (e.target.value.trim() !== '') {
                renderResults(e.target.value);
            }
        });
    });

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
});
</script>
