<!-- Top Navigation Bar -->
<header class="topbar">
    <div style="display: flex; align-items: center;">
        <button class="mobile-toggle-btn" id="mobileMenuBtn" title="Buka Menu Navigasi">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="search-container">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" class="search-input" id="globalSearchInput" placeholder="Cari menu, pelanggan, produk, pesanan... (Tekan '/')" autocomplete="off">
            <button type="button" id="clearSearchBtn" class="clear-search-btn" title="Hapus pencarian" style="display:none;">&times;</button>
        </div>
    </div>

    <div class="topbar-right">
        <!-- Jakarta Digital Clock Widget -->
        <div class="jakarta-clock-widget" title="Waktu Indonesia Barat (WIB) - Jakarta">
            <i class="fa-regular fa-clock" style="color: #2563EB; font-size: 14px;"></i>
            <span id="digitalClockTime" style="font-weight: 700; color: #0F172A; font-size: 13px;">--:--:-- WIB</span>
        </div>

        <!-- Notification Button & Dropdown -->
        <div style="position: relative;">
            <button class="icon-btn" id="notifBellBtn" title="Notifikasi Pemberitahuan">
                <i class="fa-regular fa-bell"></i>
                <span class="notif-badge">3</span>
            </button>

            <div class="notif-dropdown-card" id="notifDropdown">
                <div class="notif-header">
                    <span class="notif-title">Notifikasi Terkini</span>
                    <button class="notif-mark-read" id="markAllReadBtn">Tandai dibaca</button>
                </div>
                <div class="notif-body">
                    <a href="{{ route('pesanan') }}" class="notif-item unread">
                        <div class="notif-icon blue"><i class="fa-solid fa-file-invoice"></i></div>
                        <div class="notif-content">
                            <div class="notif-text">Pesanan Baru <strong>#ORD-2026-007</strong> dari PT Mitra Jaya Makmur</div>
                            <div class="notif-time">5 menit yang lalu</div>
                        </div>
                    </a>
                    <a href="{{ route('pembayaran') }}" class="notif-item unread">
                        <div class="notif-icon green"><i class="fa-solid fa-credit-card"></i></div>
                        <div class="notif-content">
                            <div class="notif-text">Pembayaran <strong>PAY-2026-006</strong> terverifikasi (Lunas)</div>
                            <div class="notif-time">20 menit yang lalu</div>
                        </div>
                    </a>
                    <a href="{{ route('pesanan') }}" class="notif-item unread">
                        <div class="notif-icon orange"><i class="fa-solid fa-circle-check"></i></div>
                        <div class="notif-content">
                            <div class="notif-text">Pesanan <strong>#ORD-2026-001</strong> Klinik Sehat Bersama selesai</div>
                            <div class="notif-time">1 jam yang lalu</div>
                        </div>
                    </a>
                </div>
                <div class="notif-footer">
                    <a href="{{ route('pesanan') }}" class="notif-view-all">Lihat Semua Pesanan & Aktivitas</a>
                </div>
            </div>
        </div>

        <!-- Help Modal Button -->
        <button class="icon-btn" id="helpModalBtn" title="Pusat Bantuan & FAQ">
            <i class="fa-regular fa-circle-question"></i>
        </button>

        <!-- User Profile Dropdown Button -->
        <div class="user-profile-wrapper" style="position: relative;">
            <div class="user-profile" id="userProfileBtn" title="Menu Profil Admin">
                <img src="{{ asset('assets/images/admin-avatar.png') }}" alt="Admin" class="avatar-img">
                <span class="user-name-label">Admin SIPEKAN</span>
                <i class="fa-solid fa-chevron-down profile-chevron"></i>
            </div>

            <div class="profile-dropdown-card" id="userProfileDropdown">
                <div class="profile-header-info">
                    <img src="{{ asset('assets/images/admin-avatar.png') }}" alt="Admin" class="profile-header-avatar">
                    <div>
                        <div class="profile-header-name">Admin SIPEKAN</div>
                        <div class="profile-header-email">admin@sipekan.co.id</div>
                    </div>
                </div>
                <div class="profile-menu-divider"></div>
                <a href="#" class="profile-menu-item" id="myProfileModalLink">
                    <i class="fa-regular fa-user"></i>
                    <span>Profil Saya</span>
                </a>
                <a href="{{ route('pengaturan') }}" class="profile-menu-item">
                    <i class="fa-solid fa-gear"></i>
                    <span>Pengaturan Sistem</span>
                </a>
                <a href="#" class="profile-menu-item" id="helpModalProfileLink">
                    <i class="fa-regular fa-circle-question"></i>
                    <span>Pusat Bantuan</span>
                </a>
                <div class="profile-menu-divider"></div>
                <a href="{{ route('logout') }}" class="profile-menu-item danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar (Logout)</span>
                </a>
            </div>
        </div>
    </div>
</header>
