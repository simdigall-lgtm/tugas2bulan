@php
    try {
        $recentOrders = \App\Models\Pesanan::latest('id')->take(4)->get();
    } catch (\Throwable $e) {
        $recentOrders = collect();
    }

    try {
        $recentPayments = \App\Models\Pembayaran::latest('id')->take(3)->get();
    } catch (\Throwable $e) {
        $recentPayments = collect();
    }

    $allNotifs = collect();

    foreach ($recentOrders as $ord) {
        $isSelesai = strtolower($ord->status ?? '') === 'selesai';
        $timeAgo = $ord->created_at ? $ord->created_at->diffForHumans() : ($ord->tanggal_pesan ? \Carbon\Carbon::parse($ord->tanggal_pesan)->diffForHumans() : 'Baru saja');
        
        $allNotifs->push([
            'id' => 'ord_' . $ord->id,
            'type' => 'pesanan',
            'title' => $isSelesai ? "Pesanan {$ord->kode_pesanan} Selesai" : "Pesanan Baru {$ord->kode_pesanan}",
            'desc' => "{$ord->nama_pelanggan} • {$ord->nama_produk} (Rp " . number_format($ord->total_harga, 0, ',', '.') . ")",
            'time' => $timeAgo,
            'icon' => $isSelesai ? 'fa-circle-check' : 'fa-file-invoice',
            'color' => $isSelesai ? 'green' : 'blue',
            'url' => route('pesanan') . '?search=' . urlencode($ord->kode_pesanan),
            'unread' => !$isSelesai,
        ]);
    }

    foreach ($recentPayments as $pay) {
        $isLunas = strtolower($pay->status ?? '') === 'lunas';
        $timeAgo = $pay->created_at ? $pay->created_at->diffForHumans() : ($pay->tanggal ? \Carbon\Carbon::parse($pay->tanggal)->diffForHumans() : 'Baru saja');
        
        $allNotifs->push([
            'id' => 'pay_' . $pay->id,
            'type' => 'pembayaran',
            'title' => "Pembayaran {$pay->kode_pembayaran} (" . ($isLunas ? 'Lunas' : 'Belum Lunas') . ")",
            'desc' => "Rp " . number_format($pay->jumlah, 0, ',', '.') . " • {$pay->kode_pesanan} ({$pay->metode})",
            'time' => $timeAgo,
            'icon' => 'fa-credit-card',
            'color' => $isLunas ? 'green' : 'orange',
            'url' => route('pembayaran') . '?search=' . urlencode($pay->kode_pembayaran),
            'unread' => !$isLunas,
        ]);
    }

    $unreadCount = $allNotifs->where('unread', true)->count();
    if ($unreadCount === 0 && $allNotifs->count() > 0) {
        $unreadCount = min(3, $allNotifs->count());
    }
@endphp

<style>
    /* Critical default hidden state to prevent FOUC (Flash of Unstyled Content) during page load/transitions */
    .notif-dropdown-card {
        display: none !important;
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        z-index: 200;
    }
    .notif-dropdown-card.show {
        display: block !important;
    }
    .profile-dropdown-card {
        display: none !important;
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        z-index: 200;
    }
    .profile-dropdown-card.show {
        display: block !important;
    }
    .search-dropdown-menu {
        display: none !important;
    }
    .search-dropdown-menu.show {
        display: block !important;
    }
</style>

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
            <button class="icon-btn" id="notifBellBtn" title="Notifikasi Pemberitahuan Pesanan & Pembayaran">
                <i class="fa-regular fa-bell"></i>
                <span class="notif-badge" style="{{ $unreadCount > 0 ? '' : 'display:none;' }}">{{ $unreadCount }}</span>
            </button>

            <div class="notif-dropdown-card" id="notifDropdown">
                <div class="notif-header">
                    <span class="notif-title">Notifikasi Terkini</span>
                    <button class="notif-mark-read" id="markAllReadBtn">Tandai dibaca</button>
                </div>
                <div class="notif-body">
                    @forelse($allNotifs as $notif)
                    <a href="{{ $notif['url'] }}" class="notif-item {{ $notif['unread'] ? 'unread' : '' }}" data-notif-id="{{ $notif['id'] }}">
                        <div class="notif-icon {{ $notif['color'] }}"><i class="fa-solid {{ $notif['icon'] }}"></i></div>
                        <div class="notif-content">
                            <div class="notif-text"><strong>{{ $notif['title'] }}</strong></div>
                            <div style="font-size: 11.5px; color: #64748B; margin-top: 1px;">{{ $notif['desc'] }}</div>
                            <div class="notif-time">{{ $notif['time'] }}</div>
                        </div>
                    </a>
                    @empty
                    <div style="padding: 24px 18px; text-align: center; color: #94A3B8; font-size: 12.5px;">
                        <i class="fa-regular fa-bell-slash" style="font-size: 24px; margin-bottom: 8px; display: block; color: #CBD5E1;"></i>
                        Belum ada notifikasi transaksi baru.
                    </div>
                    @endforelse
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
            <div class="user-profile" id="userProfileBtn" title="Menu Profil {{ $authUserName ?? 'Admin SIPEKAN' }}">
                <img src="{{ asset('assets/images/admin-avatar.png') }}" alt="{{ $authUserName ?? 'Admin' }}" class="avatar-img">
                <span class="user-name-label">{{ $authUserName ?? 'Admin SIPEKAN' }}</span>
                <i class="fa-solid fa-chevron-down profile-chevron"></i>
            </div>

            <div class="profile-dropdown-card" id="userProfileDropdown">
                <div class="profile-header-info">
                    <img src="{{ asset('assets/images/admin-avatar.png') }}" alt="{{ $authUserName ?? 'Admin' }}" class="profile-header-avatar">
                    <div>
                        <div class="profile-header-name">{{ $authUserName ?? 'Admin SIPEKAN' }}</div>
                        <div class="profile-header-email">{{ $authUserEmail ?? 'admin@sipekan.co.id' }}</div>
                    </div>
                </div>
                <div class="profile-menu-divider"></div>
                <a href="#" class="profile-menu-item" id="myProfileModalLink">
                    <i class="fa-regular fa-user"></i>
                    <span>Profil Saya</span>
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
