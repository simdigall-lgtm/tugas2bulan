<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - SIPEKAN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #F0F2F5;
            color: #1E293B;
            display: flex;
            min-height: 100vh;
        }

        html,
        body {
            max-width: 100vw;
            overflow-x: clip;
        }

        /* Sidebar */
        .sidebar {
            width: 210px;
            background: #FFFFFF;
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
            letter-spacing: -0.3px;
        }

        .brand-tag {
            font-size: 11px;
            font-weight: 500;
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
            transition: all .2s ease;
        }

        .menu-item:hover {
            background-color: #F1F5F9;
            color: #1E3A8A;
        }

        .menu-item.active {
            background-color: #EEF2FF;
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

        /* Main Wrapper */
        .main-wrapper {
            margin-left: 210px;
            width: calc(100% - 210px);
            max-width: calc(100vw - 210px);
            min-width: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            height: 64px;
            background: #FFFFFF;
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

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-page-title {
            font-size: 14px;
            font-weight: 600;
            color: #64748B;
        }

        .search-wrap {
            position: relative;
            width: 240px;
        }

        .search-wrap i {
            position: absolute;
            left: 11px;
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
            padding: 7px 12px 7px 33px;
            font-size: 13px;
            outline: none;
            color: #1E293B;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .icon-btn {
            background: none;
            border: none;
            color: #64748B;
            font-size: 16px;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
        }

        .avatar-img {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid #E2E8F0;
        }

        /* Content Body */
        .content-body {
            padding: 32px;
            flex: 1;
        }

        .page-title {
            font-size: 24px;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -.5px;
        }

        .page-subtitle {
            font-size: 13.5px;
            color: #64748B;
            margin-top: 4px;
            margin-bottom: 28px;
        }

        /* Settings Card */
        .settings-card {
            background: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-section-header {
            padding: 20px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #F1F5F9;
        }

        .section-title {
            font-size: 16px;
            font-weight: 800;
            color: #0F172A;
        }

        .section-subtitle {
            font-size: 12.5px;
            color: #64748B;
            margin-top: 3px;
        }

        .section-icon {
            width: 36px;
            height: 36px;
            background: #F1F5F9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748B;
            font-size: 15px;
        }

        .card-body {
            padding: 24px 28px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 7px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 13px;
        }

        .form-control {
            width: 100%;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13.5px;
            color: #0F172A;
            outline: none;
            background: #FFFFFF;
            transition: border-color .2s;
        }

        .form-control:focus {
            border-color: #1E3A8A;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        .form-control.with-icon {
            padding-left: 36px;
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }

        /* Profile section */
        .profile-upload {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 24px;
        }

        .profile-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #E2E8F0;
        }

        .upload-info .upload-name {
            font-size: 15px;
            font-weight: 700;
            color: #0F172A;
        }

        .upload-info .upload-sub {
            font-size: 12.5px;
            color: #64748B;
            margin-top: 2px;
        }

        .btn-upload {
            background: #F1F5F9;
            border: 1px solid #CBD5E1;
            color: #334155;
            padding: 7px 14px;
            border-radius: 7px;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
        }

        /* Bottom Action Bar */
        .action-bar {
            background: #FFFFFF;
            border-top: 1px solid #E2E8F0;
            padding: 16px 28px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            position: sticky;
            bottom: 0;
        }

        .btn-cancel {
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            color: #475569;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13.5px;
            cursor: pointer;
        }

        .btn-save {
            background: #1B3B6F;
            border: none;
            color: #FFFFFF;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13.5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-save:hover {
            background: #142F5B;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            .action-bar button {
                width: 100%;
                justify-content: center;
            }

            .profile-upload {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .settings-card {
                border-radius: 12px;
            }

            .card-section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .section-icon {
                display: none;
            }
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
            <h1 class="page-title">Pengaturan Umum</h1>
            <p class="page-subtitle">Kelola identitas perusahaan, detail kontak, dan preferensi lokalisasi sistem Anda.
            </p>

            <!-- Section 1: Identitas Perusahaan -->
            <div class="settings-card">
                <div class="card-section-header">
                    <div>
                        <div class="section-title">Identitas Perusahaan</div>
                        <div class="section-subtitle">Informasi dasar yang ditampilkan pada invoice dan laporan.</div>
                    </div>
                    <div class="section-icon"><i class="fa-regular fa-building"></i></div>
                </div>
                <div class="card-body">

                    <!-- Logo & Profile Upload -->
                    <div class="profile-upload">
                        <img src="{{ asset('assets/images/sipekan-logo.png') }}?v={{ file_exists(public_path('assets/images/sipekan-logo.png')) ? filemtime(public_path('assets/images/sipekan-logo.png')) : time() }}"
                            alt="Logo Perusahaan" class="profile-avatar" id="profileAvatar"
                            style="object-fit: contain; background: #fff; padding: 4px;">
                        <div class="upload-info">
                            <div class="upload-name">Logo</div>
                            <div class="upload-sub">PNG atau JPG, maksimal 2MB. Disarankan 200×200px.</div>
                            <button type="button" class="btn-upload" id="btnUploadLogo"><i class="fa-solid fa-upload"
                                    style="margin-right:6px;"></i>Ganti Logo</button>
                            <input type="file" id="logoFileInput" accept="image/png, image/jpeg, image/webp"
                                style="display:none;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="companyName">Nama Perusahaan</label>
                        <input type="text" id="companyName" class="form-control" value="{{ $settings['company_name'] ?? ($companySettings['company_name'] ?? 'SIPEKAN (CV Prima Grafika)') }}">
                    </div>

                    <div class="form-group">
                        <label for="companyAddress">Alamat Lengkap</label>
                        <textarea id="companyAddress"
                            class="form-control">{{ $settings['company_address'] ?? ($companySettings['company_address'] ?? 'Jl. Percetakan Negara No. 45, Komplek Ruko Sentra Niaga Blok B2, Jakarta Pusat, DKI Jakarta 10560') }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="companyPhone">Nomor Telepon</label>
                            <div class="input-wrap">
                                <i class="input-icon fa-solid fa-phone"></i>
                                <input type="text" id="companyPhone" class="form-control with-icon"
                                    value="{{ $settings['company_phone'] ?? ($companySettings['company_phone'] ?? '+62 21 555 0192') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="companyEmail">Email Bisnis</label>
                            <div class="input-wrap">
                                <i class="input-icon fa-regular fa-envelope"></i>
                                <input type="email" id="companyEmail" class="form-control with-icon"
                                    value="{{ $settings['company_email'] ?? ($companySettings['company_email'] ?? 'info@sipekan.co.id') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="companyNpwp">NPWP</label>
                            <input type="text" id="companyNpwp" class="form-control" placeholder="00.000.000.0-000.000"
                                value="{{ $settings['company_npwp'] ?? ($companySettings['company_npwp'] ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label for="companyWebsite">Website</label>
                            <input type="text" id="companyWebsite" class="form-control"
                                placeholder="https://sipekan.co.id"
                                value="{{ $settings['company_website'] ?? ($companySettings['company_website'] ?? '') }}">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Section 2: Lokalisasi & Format -->
            <div class="settings-card">
                <div class="card-section-header">
                    <div>
                        <div class="section-title">Lokalisasi & Format</div>
                        <div class="section-subtitle">Pengaturan format tampilan untuk angka, mata uang, dan waktu.
                        </div>
                    </div>
                    <div class="section-icon"><i class="fa-solid fa-globe"></i></div>
                </div>
                <div class="card-body">

                    @php
                        $curr = $settings['currency'] ?? ($companySettings['currency'] ?? 'IDR');
                        $df = $settings['date_format'] ?? ($companySettings['date_format'] ?? 'DD/MM/YYYY');
                        $tz = $settings['timezone'] ?? ($companySettings['timezone'] ?? 'Asia/Jakarta');
                    @endphp

                    <div class="form-row">
                        <div class="form-group">
                            <label for="currency">Mata Uang Default</label>
                            <select id="currency" class="form-control">
                                <option value="IDR" {{ $curr === 'IDR' ? 'selected' : '' }}>Indonesian Rupiah (IDR)</option>
                                <option value="USD" {{ $curr === 'USD' ? 'selected' : '' }}>US Dollar (USD)</option>
                                <option value="SGD" {{ $curr === 'SGD' ? 'selected' : '' }}>Singapore Dollar (SGD)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateFormat">Format Tanggal</label>
                            <select id="dateFormat" class="form-control">
                                <option value="DD/MM/YYYY" {{ $df === 'DD/MM/YYYY' ? 'selected' : '' }}>DD/MM/YYYY (09/09/2026)</option>
                                <option value="MM/DD/YYYY" {{ $df === 'MM/DD/YYYY' ? 'selected' : '' }}>MM/DD/YYYY (09/09/2026)</option>
                                <option value="YYYY-MM-DD" {{ $df === 'YYYY-MM-DD' ? 'selected' : '' }}>YYYY-MM-DD (2026-09-09)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="max-width: 50%; padding-right: 10px;">
                        <label for="timezone">Zona Waktu</label>
                        <select id="timezone" class="form-control">
                            <option value="Asia/Jakarta" {{ $tz === 'Asia/Jakarta' ? 'selected' : '' }}>(UTC+07:00) Waktu Indonesia Barat</option>
                            <option value="Asia/Makassar" {{ $tz === 'Asia/Makassar' ? 'selected' : '' }}>(UTC+08:00) Waktu Indonesia Tengah</option>
                            <option value="Asia/Jayapura" {{ $tz === 'Asia/Jayapura' ? 'selected' : '' }}>(UTC+09:00) Waktu Indonesia Timur</option>
                        </select>
                    </div>

                </div>
            </div>

            <!-- Section 3: Keamanan Akun & 2FA -->
            <div class="settings-card">
                <div class="card-section-header">
                    <div>
                        <div class="section-title">Keamanan Akun & 2FA</div>
                        <div class="section-subtitle">Kelola kata sandi dan status Otentikasi Dua Faktor (2FA) Anda.
                        </div>
                    </div>
                    <div class="section-icon"><i class="fa-solid fa-shield-halved"></i></div>
                </div>
                <div class="card-body">

                    <div
                        style="background: #F8FAFC; border: 1px dashed #CBD5E1; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
                        <div
                            style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="fa-brands fa-google" style="color: #4285F4; font-size: 20px;"></i>
                                <span style="font-size: 14px; font-weight: 800; color: #0F172A;">Google Authenticator
                                    2FA (Aktif)</span>
                            </div>
                            <span
                                style="background: #DCFCE7; color: #166534; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 20px; border: 1px solid #86EFAC;">AKTIF</span>
                        </div>

                        <p style="font-size: 13px; color: #475569; line-height: 1.45; margin-bottom: 16px;">
                            Pindai QR Code di bawah ini menggunakan aplikasi <strong>Google Authenticator</strong> di HP
                            Anda untuk menghubungkan akun. Pemasangan hanya perlu dilakukan 1 kali.
                        </p>

                        <div
                            style="display: flex; align-items: center; gap: 20px; background: #FFFFFF; padding: 14px; border-radius: 10px; border: 1px solid #E2E8F0;">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=otpauth://totp/CV%20Prima%20Grafika:admin%40primagrafika.com?secret=JBSWY3DPEHPK3PXP&issuer=CV%20Prima%20Grafika"
                                alt="Google Authenticator QR Code"
                                style="width: 110px; height: 110px; border-radius: 8px; border: 1px solid #CBD5E1; padding: 4px;">
                            <div>
                                <div style="font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                                    Secret Key Manual:</div>
                                <div
                                    style="display: inline-flex; align-items: center; gap: 8px; background: #0F172A; color: #38BDF8; font-family: monospace; font-size: 13px; font-weight: 700; padding: 7px 12px; border-radius: 6px; letter-spacing: 1px;">
                                    <i class=""></i>
                                    <span>JBSW Y3DP EHPK 3PXP</span>
                                </div>
                                <div style="font-size: 12px; color: #64748B; margin-top: 8px;">
                                    <i class="fa-solid fa-circle-info" style="color: #2563EB;"></i> Simpan Secret Key
                                    ini di tempat aman untuk pemulihan akses HP.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="currentPass">Kata Sandi Saat Ini</label>
                        <input type="password" id="currentPass" class="form-control"
                            placeholder="Masukkan kata sandi lama">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="newPass">Kata Sandi Baru</label>
                            <input type="password" id="newPass" class="form-control" placeholder="Min. 8 karakter">
                        </div>
                        <div class="form-group">
                            <label for="confirmPass">Konfirmasi Kata Sandi</label>
                            <input type="password" id="confirmPass" class="form-control"
                                placeholder="Ulangi kata sandi baru">
                        </div>
                    </div>

                </div>
            </div>


        </main>

        <!-- Action Bar -->
        <div class="action-bar">
            <button class="btn-cancel">Batal</button>
            <button class="btn-save"><i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnUploadLogo = document.getElementById('btnUploadLogo');
            const logoFileInput = document.getElementById('logoFileInput');
            const profileAvatar = document.getElementById('profileAvatar');
            const btnSave = document.querySelector('.btn-save');
            const btnCancel = document.querySelector('.btn-cancel');

            // Form inputs
            const companyName = document.getElementById('companyName');
            const companyAddress = document.getElementById('companyAddress');
            const companyPhone = document.getElementById('companyPhone');
            const companyEmail = document.getElementById('companyEmail');
            const companyNpwp = document.getElementById('companyNpwp');
            const companyWebsite = document.getElementById('companyWebsite');
            const currency = document.getElementById('currency');
            const dateFormat = document.getElementById('dateFormat');
            const timezone = document.getElementById('timezone');
            const currentPass = document.getElementById('currentPass');
            const newPass = document.getElementById('newPass');
            const confirmPass = document.getElementById('confirmPass');

            // 1. Logo Upload via AJAX
            if (btnUploadLogo && logoFileInput) {
                btnUploadLogo.addEventListener('click', function (e) {
                    e.preventDefault();
                    logoFileInput.click();
                });

                logoFileInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    if (file.size > 2 * 1024 * 1024) {
                        if (window.showAppToast) window.showAppToast('Ukuran berkas logo melebihi 2MB!', 'warning');
                        return;
                    }

                    const originalBtnText = btnUploadLogo.innerHTML;
                    btnUploadLogo.disabled = true;
                    btnUploadLogo.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Mengunggah...';

                    const formData = new FormData();
                    formData.append('logo', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route("pengaturan.logo") }}', {
                        method: 'POST',
                        body: formData,
                        headers: { 'Accept': 'application/json' }
                    })
                    .then(res => res.json())
                    .then(data => {
                        btnUploadLogo.disabled = false;
                        btnUploadLogo.innerHTML = originalBtnText;

                        if (data.success && data.logo_url) {
                            if (profileAvatar) profileAvatar.src = data.logo_url;
                            document.querySelectorAll('.sidebar-brand-logo, .sidebar-brand img').forEach(img => {
                                img.src = data.logo_url;
                            });
                            if (window.showAppToast) window.showAppToast(data.message || 'Logo berhasil diperbarui!', 'success');
                        } else {
                            if (window.showAppToast) window.showAppToast(data.message || 'Gagal mengunggah logo.', 'error');
                        }
                    })
                    .catch(err => {
                        btnUploadLogo.disabled = false;
                        btnUploadLogo.innerHTML = originalBtnText;
                        console.error('Error uploading logo:', err);
                        if (window.showAppToast) window.showAppToast('Terjadi kesalahan saat mengunggah logo.', 'error');
                    });
                });
            }

            // 2. Settings Save via AJAX
            if (btnSave) {
                btnSave.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Check Password matching if filled
                    const newPasswordVal = newPass ? newPass.value.trim() : '';
                    const confirmPasswordVal = confirmPass ? confirmPass.value.trim() : '';
                    const currentPasswordVal = currentPass ? currentPass.value.trim() : '';

                    if (newPasswordVal || confirmPasswordVal) {
                        if (newPasswordVal !== confirmPasswordVal) {
                            if (window.showAppToast) window.showAppToast('Konfirmasi kata sandi baru tidak cocok!', 'error');
                            return;
                        }
                        if (newPasswordVal.length < 6) {
                            if (window.showAppToast) window.showAppToast('Kata sandi baru minimal 6 karakter!', 'warning');
                            return;
                        }
                    }

                    const originalBtnHtml = btnSave.innerHTML;
                    btnSave.disabled = true;
                    btnSave.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Menyimpan...';

                    const payload = {
                        company_name: companyName ? companyName.value.trim() : '',
                        company_address: companyAddress ? companyAddress.value.trim() : '',
                        company_phone: companyPhone ? companyPhone.value.trim() : '',
                        company_email: companyEmail ? companyEmail.value.trim() : '',
                        company_npwp: companyNpwp ? companyNpwp.value.trim() : '',
                        company_website: companyWebsite ? companyWebsite.value.trim() : '',
                        currency: currency ? currency.value : 'IDR',
                        date_format: dateFormat ? dateFormat.value : 'DD/MM/YYYY',
                        timezone: timezone ? timezone.value : 'Asia/Jakarta',
                    };

                    if (newPasswordVal) {
                        payload.current_password = currentPasswordVal;
                        payload.new_password = newPasswordVal;
                    }

                    fetch('{{ route("pengaturan.update") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    })
                    .then(res => res.json().then(data => ({ status: res.status, ok: res.ok, data })))
                    .then(({ ok, data }) => {
                        btnSave.disabled = false;
                        btnSave.innerHTML = originalBtnHtml;

                        if (ok && data.success) {
                            if (currentPass) currentPass.value = '';
                            if (newPass) newPass.value = '';
                            if (confirmPass) confirmPass.value = '';

                            // Update sidebar brand name if changed
                            if (payload.company_name) {
                                const brandWord = payload.company_name.split(' ')[0] || 'SIPEKAN';
                                document.querySelectorAll('.brand-name').forEach(el => el.textContent = brandWord);
                            }

                            if (window.showAppToast) window.showAppToast(data.message || 'Pengaturan berhasil disimpan!', 'success');
                        } else {
                            if (window.showAppToast) window.showAppToast(data.message || 'Gagal menyimpan pengaturan.', 'error');
                        }
                    })
                    .catch(err => {
                        btnSave.disabled = false;
                        btnSave.innerHTML = originalBtnHtml;
                        console.error('Error saving settings:', err);
                        if (window.showAppToast) window.showAppToast('Terjadi kesalahan saat menyimpan pengaturan.', 'error');
                    });
                });
            }

            // 3. Reset / Batal
            if (btnCancel) {
                btnCancel.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (currentPass) currentPass.value = '';
                    if (newPass) newPass.value = '';
                    if (confirmPass) confirmPass.value = '';
                    window.location.reload();
                });
            }
        });
    </script>
    @include('layouts.navbar_assets')
</body>

</html>