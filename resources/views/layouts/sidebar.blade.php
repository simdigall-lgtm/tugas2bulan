<!-- Sidebar Navigation -->
<aside class="sidebar">
    <div>
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}" title="Ke Dasbor Utama" style="text-decoration: none; color: inherit; display: block;">
                <div class="brand-name">Prima Grafika</div>
                <div class="brand-tag">Konsol Admin</div>
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
        <a href="{{ route('pengaturan') }}" class="menu-item {{ request()->routeIs('pengaturan') ? 'active' : '' }}">
            <i class="fa-solid fa-gear"></i>
            <span>Pengaturan</span>
        </a>
        <a href="{{ route('logout') }}" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Keluar</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
