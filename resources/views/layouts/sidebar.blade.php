<!-- Sidebar Navigation -->
<aside class="sidebar">
    <div>
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}" title="Ke Dasbor Utama" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 12px;">
                <img src="{{ asset('assets/images/sipekan-logo.png') }}" alt="SIPEKAN Logo" style="height: 38px; width: auto; object-fit: contain; flex-shrink: 0; display: block;">
                <div style="display: flex; flex-direction: column; justify-content: space-between; height: 38px;">
                    <div class="brand-name" style="line-height: 1.1; font-size: 19px; font-weight: 800; margin: 0;">SIPEKAN</div>
                    <div class="brand-tag" style="line-height: 1.2; font-size: 12px; margin: 0;">{{ ($isKasir ?? false) ? 'Konsol Kasir' : 'Konsol Admin' }}</div>
                </div>
            </a>
        </div>

        <nav class="sidebar-menu">
            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Dasbor</span>
            </a>
            <a href="{{ route('pelanggan') }}" class="menu-item {{ request()->routeIs('pelanggan') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span>Pelanggan</span>
            </a>
            <a href="{{ route('produk') }}" class="menu-item {{ request()->routeIs('produk') ? 'active' : '' }}">
                <i class="fa-solid fa-box-archive"></i>
                <span>Produk</span>
            </a>
            <a href="{{ route('pesanan') }}" class="menu-item {{ request()->routeIs('pesanan') ? 'active' : '' }}">
                <i class="fa-solid fa-file-invoice"></i>
                <span>Pesanan</span>
            </a>
            <a href="{{ route('pembayaran') }}" class="menu-item {{ request()->routeIs('pembayaran') ? 'active' : '' }}">
                <i class="fa-solid fa-credit-card"></i>
                <span>Pembayaran</span>
            </a>
            <a href="{{ route('laporan') }}" class="menu-item {{ request()->routeIs('laporan') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-column"></i>
                <span>Laporan</span>
            </a>
        </nav>
    </div>

    <div class="sidebar-bottom">
        @if(!($isKasir ?? false))
        <a href="{{ route('pengaturan') }}" class="menu-item {{ request()->routeIs('pengaturan') ? 'active' : '' }}">
            <i class="fa-solid fa-gear"></i>
            <span>Pengaturan</span>
        </a>
        @endif
        <a href="{{ route('logout') }}" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Keluar</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
