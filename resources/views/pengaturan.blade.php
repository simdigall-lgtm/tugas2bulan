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

        /* Sidebar */
        .sidebar {
            width: 250px;
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
            padding: 24px 20px 20px 24px;
        }

        .brand-name {
            font-size: 19px;
            font-weight: 800;
            color: #1E3A8A;
            letter-spacing: -0.3px;
        }

        .brand-tag {
            font-size: 12px;
            font-weight: 500;
            color: #64748B;
            margin-top: 2px;
        }

        .sidebar-menu {
            padding: 12px 14px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 8px;
            color: #475569;
            text-decoration: none;
            font-size: 14px;
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
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .sidebar-bottom {
            padding: 16px 14px 20px;
            border-top: 1px dashed #E2E8F0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        /* Main Wrapper */
        .main-wrapper {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            height: 68px;
            background: #FFFFFF;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 90;
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
                        <img src="{{ asset('assets/images/sipekan-logo.png') }}" alt="Logo Perusahaan"
                            class="profile-avatar" id="profileAvatar"
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
                        <input type="text" id="companyName" class="form-control" value="SIPEKAN (CV Prima Grafika)">
                    </div>

                    <div class="form-group">
                        <label for="companyAddress">Alamat Lengkap</label>
                        <textarea id="companyAddress"
                            class="form-control">Jl. Percetakan Negara No. 45, Komplek Ruko Sentra Niaga Blok B2, Jakarta Pusat, DKI Jakarta 10560</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="companyPhone">Nomor Telepon</label>
                            <div class="input-wrap">
                                <i class="input-icon fa-solid fa-phone"></i>
                                <input type="text" id="companyPhone" class="form-control with-icon"
                                    value="+62 21 555 0192">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="companyEmail">Email Bisnis</label>
                            <div class="input-wrap">
                                <i class="input-icon fa-regular fa-envelope"></i>
                                <input type="email" id="companyEmail" class="form-control with-icon"
                                    value="info@sipekan.co.id">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="companyNpwp">NPWP</label>
                            <input type="text" id="companyNpwp" class="form-control" placeholder="00.000.000.0-000.000">
                        </div>
                        <div class="form-group">
                            <label for="companyWebsite">Website</label>
                            <input type="text" id="companyWebsite" class="form-control"
                                placeholder="https://sipekan.co.id">
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

                    <div class="form-row">
                        <div class="form-group">
                            <label for="currency">Mata Uang Default</label>
                            <select id="currency" class="form-control">
                                <option value="IDR" selected>Indonesian Rupiah (IDR)</option>
                                <option value="USD">US Dollar (USD)</option>
                                <option value="SGD">Singapore Dollar (SGD)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateFormat">Format Tanggal</label>
                            <select id="dateFormat" class="form-control">
                                <option value="DD/MM/YYYY" selected>DD/MM/YYYY (09/09/2026)</option>
                                <option value="MM/DD/YYYY">MM/DD/YYYY (09/09/2026)</option>
                                <option value="YYYY-MM-DD">YYYY-MM-DD (2026-09-09)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="max-width: 50%; padding-right: 10px;">
                        <label for="timezone">Zona Waktu</label>
                        <select id="timezone" class="form-control">
                            <option value="Asia/Jakarta" selected>(UTC+07:00) Waktu Indonesia Barat</option>
                            <option value="Asia/Makassar">(UTC+08:00) Waktu Indonesia Tengah</option>
                            <option value="Asia/Jayapura">(UTC+09:00) Waktu Indonesia Timur</option>
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
                                    <i class="fa-regular fa-key"></i>
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

            // Load saved settings from localStorage
            function loadSavedSettings() {
                const savedLogo = localStorage.getItem('companyLogo');
                if (savedLogo && profileAvatar) profileAvatar.src = savedLogo;

                if (localStorage.getItem('companyName') && companyName) companyName.value = localStorage.getItem('companyName');
                if (localStorage.getItem('companyAddress') && companyAddress) companyAddress.value = localStorage.getItem('companyAddress');
                if (localStorage.getItem('companyPhone') && companyPhone) companyPhone.value = localStorage.getItem('companyPhone');
                if (localStorage.getItem('companyEmail') && companyEmail) companyEmail.value = localStorage.getItem('companyEmail');
                if (localStorage.getItem('companyNpwp') && companyNpwp) companyNpwp.value = localStorage.getItem('companyNpwp');
                if (localStorage.getItem('companyWebsite') && companyWebsite) companyWebsite.value = localStorage.getItem('companyWebsite');
                if (localStorage.getItem('currency') && currency) currency.value = localStorage.getItem('currency');
                if (localStorage.getItem('dateFormat') && dateFormat) dateFormat.value = localStorage.getItem('dateFormat');
                if (localStorage.getItem('timezone') && timezone) timezone.value = localStorage.getItem('timezone');
            }

            loadSavedSettings();

            // 1. Real Logo Upload Functionality
            if (btnUploadLogo && logoFileInput) {
                btnUploadLogo.addEventListener('click', function (e) {
                    e.preventDefault();
                    logoFileInput.click();
                });

                logoFileInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            if (window.showAppToast) window.showAppToast('Ukuran berkas melebihi 2MB!', 'error');
                            return;
                        }
                        const reader = new FileReader();
                        reader.onload = function (evt) {
                            const dataUrl = evt.target.result;
                            if (profileAvatar) profileAvatar.src = dataUrl;
                            localStorage.setItem('companyLogo', dataUrl);
                            if (window.showAppToast) window.showAppToast('Logo perusahaan berhasil diperbarui!', 'success');
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // 2. Real Settings Save Functionality
            if (btnSave) {
                btnSave.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Check Password matching if filled
                    if (newPass.value.trim() || confirmPass.value.trim()) {
                        if (newPass.value !== confirmPass.value) {
                            if (window.showAppToast) window.showAppToast('Konfirmasi kata sandi baru tidak cocok!', 'error');
                            return;
                        }
                        if (newPass.value.length < 6) {
                            if (window.showAppToast) window.showAppToast('Kata sandi baru minimal 6 karakter!', 'warning');
                            return;
                        }
                        currentPass.value = '';
                        newPass.value = '';
                        confirmPass.value = '';
                    }

                    // Save settings to localStorage
                    if (companyName) localStorage.setItem('companyName', companyName.value.trim());
                    if (companyAddress) localStorage.setItem('companyAddress', companyAddress.value.trim());
                    if (companyPhone) localStorage.setItem('companyPhone', companyPhone.value.trim());
                    if (companyEmail) localStorage.setItem('companyEmail', companyEmail.value.trim());
                    if (companyNpwp) localStorage.setItem('companyNpwp', companyNpwp.value.trim());
                    if (companyWebsite) localStorage.setItem('companyWebsite', companyWebsite.value.trim());
                    if (currency) localStorage.setItem('currency', currency.value);
                    if (dateFormat) localStorage.setItem('dateFormat', dateFormat.value);
                    if (timezone) localStorage.setItem('timezone', timezone.value);

                    if (window.showAppToast) {
                        window.showAppToast('Pengaturan umum berhasil disimpan!', 'success');
                    }
                });
            }

            // 3. Reset / Batal
            if (btnCancel) {
                btnCancel.addEventListener('click', function (e) {
                    e.preventDefault();
                    loadSavedSettings();
                    if (currentPass) currentPass.value = '';
                    if (newPass) newPass.value = '';
                    if (confirmPass) confirmPass.value = '';
                    if (window.showAppToast) window.showAppToast('Perubahan dibatalkan.', 'info');
                });
            }
        });
    </script>
    @include('layouts.navbar_assets')
</body>

</html>