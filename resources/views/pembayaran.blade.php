<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pembayaran - SIPEKAN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',-apple-system,BlinkMacSystemFont,sans-serif; }
        body { background-color:#F8FAFC; color:#1E293B; display:flex; min-height:100vh; }

        .sidebar { width:250px; background:#FFFFFF; border-right:1px solid #E2E8F0; display:flex; flex-direction:column; justify-content:space-between; position:fixed; top:0; bottom:0; left:0; z-index:100; }
        .sidebar-brand { padding:24px 20px 20px 24px; }
        .brand-name { font-size:19px; font-weight:800; color:#1E3A8A; letter-spacing:-0.3px; }
        .brand-tag { font-size:12px; font-weight:500; color:#64748B; margin-top:2px; }
        .sidebar-menu { padding:12px 14px; display:flex; flex-direction:column; gap:4px; flex:1; }
        .menu-item { display:flex; align-items:center; gap:12px; padding:11px 16px; border-radius:8px; color:#475569; text-decoration:none; font-size:14px; font-weight:600; transition:all 0.2s ease; }
        .menu-item:hover { background-color:#F1F5F9; color:#1E3A8A; }
        .menu-item.active { background-color:#EEF2FF; color:#1E3A8A; font-weight:700; }
        .menu-item i { font-size:16px; width:20px; text-align:center; }
        .sidebar-bottom { padding:16px 14px 20px; border-top:1px dashed #E2E8F0; display:flex; flex-direction:column; gap:4px; }

        .main-wrapper { margin-left:250px; flex:1; display:flex; flex-direction:column; min-width:0; }
        .topbar { height:68px; background:#FFFFFF; border-bottom:1px solid #E2E8F0; display:flex; align-items:center; justify-content:space-between; padding:0 32px; position:sticky; top:0; z-index:90; }
        .search-container { position:relative; width:340px; }
        .search-icon { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#94A3B8; font-size:14px; }
        .search-input { width:100%; background:#F1F5F9; border:1px solid transparent; border-radius:8px; padding:9px 14px 9px 38px; font-size:13.5px; color:#1E293B; outline:none; }
        .topbar-right { display:flex; align-items:center; gap:20px; }
        .icon-btn { background:none; border:none; color:#64748B; font-size:17px; cursor:pointer; padding:6px; border-radius:50%; }
        .avatar-img { width:36px; height:36px; border-radius:50%; object-fit:cover; border:1.5px solid #E2E8F0; }

        .content-body { padding:32px; flex:1; }
        .page-header-row { margin-bottom:24px; }
        .page-title { font-size:26px; font-weight:800; color:#0F172A; letter-spacing:-0.5px; }
        .page-subtitle { font-size:14px; color:#64748B; margin-top:4px; }

        .grid-2col { display:grid; grid-template-columns:1fr 1.8fr; gap:24px; align-items:start; }
        .card { background:#FFFFFF; border-radius:12px; border:1px solid #E2E8F0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.02); padding:24px; }
        .card-title { font-size:17px; font-weight:800; color:#0F172A; margin-bottom:20px; }

        .card-header { display:flex; align-items:center; gap:10px; margin-bottom:20px; }
        .card-header-icon { width:32px; height:32px; background:#DBEAFE; border-radius:8px; display:flex; align-items:center; justify-content:center; color:#1E3A8A; font-size:14px; }

        .form-group { margin-bottom:16px; }
        .form-group label { display:block; font-size:13px; font-weight:700; color:#334155; margin-bottom:6px; }
        .form-control { width:100%; border:1px solid #CBD5E1; border-radius:8px; padding:10px 14px; font-size:13.5px; color:#0F172A; outline:none; background:#FFFFFF; }
        .form-control:focus { border-color:#1E3A8A; box-shadow:0 0 0 3px rgba(30,58,138,0.1); }

        .btn-submit { width:100%; background:#1B3B6F; color:#FFFFFF; border:none; padding:11px 20px; border-radius:8px; font-weight:700; font-size:14px; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; margin-top:20px; }

        .filter-bar { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
        .filter-search { position:relative; width:220px; }
        .filter-search input { width:100%; background:#FFFFFF; border:1px solid #E2E8F0; border-radius:8px; padding:8px 12px 8px 34px; font-size:13px; outline:none; }
        .filter-search .search-icon { left:11px; font-size:13px; }

        .custom-table { width:100%; border-collapse:collapse; text-align:left; }
        .custom-table th { background:#FFFFFF; padding:12px 16px; font-size:11px; font-weight:700; color:#64748B; text-transform:uppercase; letter-spacing:0.5px; border-bottom:1px solid #E2E8F0; white-space:nowrap; }
        .custom-table td { padding:14px 16px; font-size:13px; color:#334155; border-bottom:1px solid #F1F5F9; font-weight:500; vertical-align:middle; white-space:nowrap; }
        .custom-table tr:last-child td { border-bottom:none; }
        .custom-table tr:hover td { background:#F8FAFC; }

        .pay-id { font-weight:700; color:#0F172A; white-space:nowrap; }
        .order-link { color:#1E3A8A; font-weight:700; text-decoration:none; white-space:nowrap; }

        .status-badge { display:inline-flex; align-items:center; justify-content:center; padding:4px 10px; border-radius:12px; font-size:11px; font-weight:700; white-space:nowrap; }
        .status-lunas { background:#DCFCE7; color:#16A34A; }
        .status-menunggu { background:#FEF3C7; color:#D97706; }

        .table-footer { padding-top:16px; margin-top:8px; display:flex; align-items:center; justify-content:space-between; border-top:1px solid #E2E8F0; }
        .entry-info { font-size:12px; color:#64748B; font-weight:500; }
        .pagination { display:flex; align-items:center; gap:6px; }
        .page-btn { min-width:32px; height:32px; padding:0 8px; border-radius:6px; border:1px solid #E2E8F0; background:#FFFFFF; color:#475569; font-size:12.5px; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; }
        .page-btn.active { background:#1B3B6F; border-color:#1B3B6F; color:#FFFFFF; font-weight:700; }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .grid-2col { grid-template-columns: 1fr; }
            .filter-bar { flex-direction: column; align-items: flex-start; gap: 12px; }
            .filter-search, .filter-search input { width: 100%; }
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
            <div class="page-header-row">
                <h1 class="page-title">Kelola Pembayaran</h1>
                <p class="page-subtitle">Catat dan lacak pembayaran pelanggan.</p>
            </div>

            @if(session('error'))
                <div class="alert alert-danger" style="padding: 12px 16px; background: #FEF2F2; color: #991B1B; border: 1px solid #FCA5A5; border-radius: 8px; margin-bottom: 20px; font-weight: 600; font-size: 13.5px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success" style="padding: 12px 16px; background: #F0FDF4; color: #166534; border: 1px solid #86EFAC; border-radius: 8px; margin-bottom: 20px; font-weight: 600; font-size: 13.5px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid-2col">
                <!-- Left Card - Form Pembayaran Baru -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-icon"><i class="fa-solid fa-credit-card"></i></div>
                        <h2 class="card-title" style="margin-bottom:0;">Pembayaran Baru</h2>
                    </div>

                    <form action="{{ route('pembayaran.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="payOrder">Pilih Pesanan</label>
                            <select name="kode_pesanan" id="payOrder" class="form-control" required>
                                <option value="">Pilih pesanan...</option>
                                @foreach($pesanans ?? [] as $p)
                                    @php
                                        $isAlreadyLunas = in_array($p->kode_pesanan, $lunasOrderCodes ?? []) || strtolower($p->status ?? '') === 'lunas' || strtolower($p->status ?? '') === 'selesai';
                                    @endphp
                                    <option value="{{ $p->kode_pesanan }}" data-harga="{{ $p->total_harga }}" {{ $isAlreadyLunas ? 'disabled style=color:#94A3B8;background:#F1F5F9;' : '' }}>
                                        {{ $p->kode_pesanan }} – {{ $p->nama_pelanggan }} (Rp {{ number_format($p->total_harga, 0, ',', '.') }}) {{ $isAlreadyLunas ? ' [LUNAS]' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payDate">Tanggal Pembayaran</label>
                            <input type="date" name="tanggal_bayar" id="payDate" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="payMethod">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="payMethod" class="form-control" required>
                                <option value="">Pilih metode...</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="QRIS">QRIS</option>
                                <option value="Tunai">Tunai</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payAmount">Jumlah (IDR)</label>
                            <input type="number" name="jumlah" id="payAmount" class="form-control" min="0" step="1000" placeholder="900000" required>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fa-regular fa-floppy-disk"></i>
                            <span>Simpan Pembayaran</span>
                        </button>
                    </form>
                </div>

                <!-- Right Card - Pembayaran Terbaru Table -->
                <div class="card">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
                        <h2 class="card-title" style="margin-bottom:0;">Pembayaran Terbaru</h2>
                        <div class="filter-search">
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                            <input type="text" id="paySearchInput" placeholder="Cari pembayaran...">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="custom-table" id="payTable">
                            <thead>
                                <tr>
                                    <th>NO. PEMBAYARAN</th>
                                    <th>PESANAN</th>
                                    <th>TANGGAL</th>
                                    <th>METODE</th>
                                    <th>JUMLAH</th>
                                    <th>STATUS</th>
                                    <th style="text-align:right;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pembayarans ?? [] as $pem)
                                <tr>
                                    <td class="pay-id">{{ $pem->kode_pembayaran }}</td>
                                    <td><a href="{{ route('pesanan') }}" class="order-link">{{ $pem->kode_pesanan }}</a></td>
                                    <td>{{ $pem->tanggal_bayar ? \Carbon\Carbon::parse($pem->tanggal_bayar)->format('d M Y') : ($pem->tanggal ? \Carbon\Carbon::parse($pem->tanggal)->format('d M Y') : '-') }}</td>
                                    <td>{{ $pem->metode_pembayaran ?? $pem->metode }}</td>
                                    <td>Rp {{ number_format($pem->jumlah, 0, ',', '.') }}</td>
                                    <td><span class="status-badge {{ strtolower($pem->status) == 'lunas' ? 'status-lunas' : 'status-menunggu' }}">{{ $pem->status }}</span></td>
                                    <td style="text-align:right;">
                                        @if(strtolower($pem->status) == 'lunas')
                                            <span style="color: #94A3B8; font-weight: 500;">-</span>
                                        @else
                                            <div class="action-dropdown" style="position:relative; display:inline-block;">
                                                <button type="button" class="action-icon-btn action-toggle" title="Aksi" style="background:none; border:none; color:#94A3B8; font-size:16px; cursor:pointer; width:32px; height:32px; border-radius:6px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                                <div class="dropdown-menu">
                                                    <form action="{{ route('pembayaran.update', $pem->id) }}" method="POST" style="display:block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Lunas">
                                                        <button type="submit" class="dropdown-item" style="color:#16A34A; font-weight:600;"><i class="fa-solid fa-circle-check" style="color:#16A34A;"></i> Tandai Lunas</button>
                                                    </form>
                                                    <form action="{{ route('pembayaran.destroy', $pem->id) }}" method="POST" style="display:block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pembayaran ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item danger"><i class="fa-regular fa-trash-can"></i> Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; padding:20px; color:#64748B;">Belum ada data pembayaran di database.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        <div class="entry-info">Menampilkan {{ count($pembayarans ?? []) }} data pembayaran</div>
                        <div class="pagination">
                            <button class="page-btn"><i class="fa-solid fa-chevron-left" style="font-size: 11px;"></i></button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn"><i class="fa-solid fa-chevron-right" style="font-size: 11px;"></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payForm = document.querySelector('form');
            const payTable = document.getElementById('payTable');
            const tbody = payTable ? payTable.querySelector('tbody') : null;
            const entryInfo = document.querySelector('.entry-info');
            const paginationEl = document.querySelector('.pagination');
            const paySearchInput = document.getElementById('paySearchInput');
            const payOrderSelect = document.getElementById('payOrder');
            const payAmountInput = document.getElementById('payAmount');

            if (payOrderSelect && payAmountInput) {
                payOrderSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const harga = selectedOption ? selectedOption.getAttribute('data-harga') : '';
                    if (harga) {
                        payAmountInput.value = harga;
                    }
                });
            }

            let payCounter = 8;
            let currentPage = 1;
            const itemsPerPage = 5;

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
                    entryInfo.textContent = `Menampilkan ${startShow} hingga ${endShow} dari ${totalItems} data`;
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

            // Let payForm submit natively to controller route

            if (tbody) {
                updatePagination();
            }

            if (paySearchInput && payTable) {
                paySearchInput.addEventListener('keyup', function() {
                    const q = this.value.toLowerCase();
                    const rows = payTable.querySelectorAll('tbody tr');
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
            document.addEventListener('click', function(e) {
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
