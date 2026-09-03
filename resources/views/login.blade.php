<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPEKAN</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Cloudflare Turnstile SDK -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background: #F4F7FC;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            color: #1F2937;
        }

        .login-card {
            width: 100%;
            max-width: 940px;
            background: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.05), 0 2px 8px rgba(0, 0, 0, 0.02);
            display: flex;
            overflow: hidden;
            border: 1px solid #E5E7EB;
            min-height: 560px;
        }

        /* Left Column - Form */
        .login-form-container {
            flex: 1;
            padding: 40px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-logo-wrapper {
            margin-bottom: 20px;
            margin-left: -20px;
        }

        .brand-logo {
            height: 65px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .brand-title {
            font-size: 24px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 6px;
            letter-spacing: -0.4px;
        }

        .brand-subtitle {
            font-size: 13.5px;
            font-weight: 500;
            color: #4B5563;
            line-height: 1.45;
            margin-bottom: 24px;
        }

        /* Alert styling */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background-color: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FCA5A5;
        }

        .alert-success {
            background-color: #F0FDF4;
            color: #166534;
            border: 1px solid #86EFAC;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            background-color: #FFFFFF;
            border: 1.5px solid #D1D5DB;
            border-radius: 8px;
            padding: 0 14px;
            height: 46px;
            transition: all 0.2s ease-in-out;
        }

        .input-wrapper:focus-within {
            border-color: #1E3A8A;
            box-shadow: 0 0 0 3.5px rgba(30, 58, 138, 0.12);
        }

        .input-icon {
            color: #9CA3AF;
            font-size: 15px;
            width: 20px;
            display: flex;
            justify-content: center;
            margin-right: 10px;
            transition: color 0.2s ease;
        }

        .input-wrapper:focus-within .input-icon {
            color: #1E3A8A;
        }

        .form-input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-size: 14px;
            font-weight: 500;
            color: #111827;
        }

        .form-input::placeholder {
            color: #9CA3AF;
            font-weight: 400;
        }

        .password-toggle {
            background: none;
            border: none;
            color: #9CA3AF;
            cursor: pointer;
            padding: 4px;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease;
        }

        .password-toggle:hover {
            color: #4B5563;
        }

        .form-subrow {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 8px;
            font-size: 13px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #4B5563;
            font-weight: 500;
            cursor: pointer;
            user-select: none;
        }

        .remember-label input[type="checkbox"] {
            accent-color: #1B3B6F;
            width: 15px;
            height: 15px;
            cursor: pointer;
        }

        .forgot-link {
            color: #2563EB;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .forgot-link:hover {
            color: #1D4ED8;
            text-decoration: underline;
        }

        /* Forgot Password Modal Overlay */
        .forgot-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            padding: 20px;
        }

        .forgot-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .forgot-modal-box {
            background-color: #FFFFFF;
            border-radius: 16px;
            width: 100%;
            max-width: 440px;
            padding: 28px;
            box-shadow: 0 24px 48px rgba(15, 23, 42, 0.25);
            transform: translateY(-16px);
            transition: transform 0.2s ease;
        }

        .forgot-modal-overlay.active .forgot-modal-box {
            transform: translateY(0);
        }

        .forgot-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .forgot-modal-title {
            font-size: 18px;
            font-weight: 800;
            color: #0F172A;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .forgot-modal-close {
            background: none;
            border: none;
            color: #94A3B8;
            font-size: 20px;
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s ease;
        }

        .forgot-modal-close:hover {
            background-color: #F1F5F9;
            color: #0F172A;
        }

        /* 2FA Box Container */
        .twofa-box {
            background: #F8FAFC;
            border: 1.5px dashed #CBD5E1;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 20px;
        }

        .twofa-header-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #1E3A8A;
            font-weight: 800;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .twofa-tag {
            font-size: 11px;
            background: #DBEAFE;
            color: #1E40AF;
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: 700;
        }

        .twofa-equation-text {
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .twofa-badge-num {
            background: #1E3A8A;
            color: #FFFFFF;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .btn-submit {
            width: 100%;
            background-color: #1B3B6F;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            height: 46px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 6px;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 4px 12px rgba(27, 59, 111, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background-color: #142F5B;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(27, 59, 111, 0.25);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 2px 6px rgba(27, 59, 111, 0.15);
        }

        /* Right Column - Illustration */
        .login-illustration-container {
            flex: 1;
            background: linear-gradient(135deg, #F0F4FC 0%, #E5EDF9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .illustration-image {
            max-width: 90%;
            max-height: 440px;
            width: auto;
            height: auto;
            object-fit: contain;
            mix-blend-mode: multiply;
            filter: contrast(1.02);
            transition: transform 0.3s ease;
        }

        .illustration-image:hover {
            transform: scale(1.03);
        }

        /* Responsive Breakpoints */
        @media (max-width: 820px) {
            .login-card {
                flex-direction: column;
                max-width: 480px;
            }

            .login-illustration-container {
                display: none;
            }

            .login-form-container {
                padding: 36px 28px;
            }
        }
    </style>
</head>
<body>

    <div class="login-card">
        <!-- Left Side: Login Form -->
        <div class="login-form-container">
            <div class="brand-logo-wrapper">
                <img src="{{ asset('assets/images/pg-logo.png') }}" alt="PG Logo" class="brand-logo">
            </div>

            <h1 class="brand-title">SIPEKAN</h1>
            <p class="brand-subtitle">Sistem Informasi Manajemen Pesanan Percetakan</p>

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" autocomplete="off">
                @csrf
                
                <!-- Username Input -->
                <div class="form-group">
                    <label for="username" class="form-label">Nama Pengguna</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-user input-icon"></i>
                        <input type="text" 
                               id="username" 
                               name="username" 
                               class="form-input" 
                               placeholder="Masukkan nama pengguna Anda"
                               value="{{ old('username') }}" 
                               required 
                               autofocus>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="form-group">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock input-icon" style="font-size: 14px;"></i>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input" 
                               placeholder="********" 
                               required>
                        <button type="button" class="password-toggle" id="togglePasswordBtn" title="Tampilkan/Sembunyikan kata sandi">
                            <i class="fa-regular fa-eye" id="passwordEyeIcon"></i>
                        </button>
                    </div>
                    <div class="form-subrow">
                        <label class="remember-label">
                            <input type="checkbox" name="remember" id="rememberMe">
                            <span>Ingat Saya</span>
                        </label>
                        <a href="javascript:void(0)" id="forgotPasswordBtn" class="forgot-link">Lupa Kata Sandi?</a>
                    </div>
                </div>

                <!-- Cloudflare Turnstile CAPTCHA ("Verifikasi Anda Bukan Robot") -->
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label">Verifikasi Keamanan</label>
                    <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key', env('TURNSTILE_SITE_KEY', '0x4AAAAAAElX-y-BGcmshHBP')) }}" data-theme="light"></div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit">
                    <span>Lanjutkan ke Verifikasi 2FA</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>
        </div>

        <!-- Right Side: Side Illustration -->
        <div class="login-illustration-container">
            <img src="{{ asset('assets/images/printing-illustration.png') }}" 
                 alt="Percetakan SIPEKAN" 
                 class="illustration-image">
        </div>
    </div>

    <!-- Forgot Password Modal (Multi-Step Verification Workflow) -->
    @php
        $currentStep = session('forgot_step', 1);
    @endphp

    <div class="forgot-modal-overlay {{ (isset($openForgotPassword) || session('open_forgot_modal')) ? 'active' : '' }}" id="forgotModal">
        <div class="forgot-modal-box">
            <div class="forgot-modal-header">
                <div class="forgot-modal-title">
                    <i class="fa-solid fa-shield-halved" style="color: #1E3A8A;"></i>
                    <span>Verifikasi Lupa Kata Sandi</span>
                </div>
                <button type="button" class="forgot-modal-close" id="closeForgotModal">&times;</button>
            </div>

            <!-- Step Progress Indicator -->
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 22px; position: relative;">
                <div style="flex: 1; text-align: center; z-index: 2;">
                    <div style="width: 30px; height: 30px; border-radius: 50%; background: {{ $currentStep >= 1 ? '#1B3B6F' : '#E2E8F0' }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; margin: 0 auto 4px auto; box-shadow: {{ $currentStep == 1 ? '0 0 0 4px rgba(27,59,111,0.2)' : 'none' }};">1</div>
                    <span style="font-size: 11.5px; font-weight: 700; color: {{ $currentStep >= 1 ? '#1B3B6F' : '#94A3B8' }};">Cari Akun</span>
                </div>
                <div style="height: 3px; flex: 1; background: {{ $currentStep >= 2 ? '#1B3B6F' : '#E2E8F0' }}; margin: -16px -10px 0 -10px; z-index: 1;"></div>
                <div style="flex: 1; text-align: center; z-index: 2;">
                    <div style="width: 30px; height: 30px; border-radius: 50%; background: {{ $currentStep >= 2 ? '#1B3B6F' : '#E2E8F0' }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; margin: 0 auto 4px auto; box-shadow: {{ $currentStep == 2 ? '0 0 0 4px rgba(27,59,111,0.2)' : 'none' }};">2</div>
                    <span style="font-size: 11.5px; font-weight: 700; color: {{ $currentStep >= 2 ? '#1B3B6F' : '#94A3B8' }};">Verifikasi OTP</span>
                </div>
                <div style="height: 3px; flex: 1; background: {{ $currentStep >= 3 ? '#1B3B6F' : '#E2E8F0' }}; margin: -16px -10px 0 -10px; z-index: 1;"></div>
                <div style="flex: 1; text-align: center; z-index: 2;">
                    <div style="width: 30px; height: 30px; border-radius: 50%; background: {{ $currentStep >= 3 ? '#1B3B6F' : '#E2E8F0' }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; margin: 0 auto 4px auto; box-shadow: {{ $currentStep == 3 ? '0 0 0 4px rgba(27,59,111,0.2)' : 'none' }};">3</div>
                    <span style="font-size: 11.5px; font-weight: 700; color: {{ $currentStep >= 3 ? '#1B3B6F' : '#94A3B8' }};">Sandi Baru</span>
                </div>
            </div>

            @if(session('open_forgot_modal') && session('error'))
                <div class="alert alert-danger" style="margin-bottom: 16px; padding: 10px 14px; font-size: 13px; background: #FEF2F2; color: #DC2626; border: 1px solid #FCA5A5; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success_code'))
                <div class="alert alert-success" style="margin-bottom: 18px; padding: 14px 16px; font-size: 13px; background: #F0F9FF; color: #0369A1; border: 1px solid #BAE6FD; border-radius: 10px; line-height: 1.5; box-shadow: 0 2px 6px rgba(3, 105, 161, 0.08);">
                    <div style="font-weight: 700; margin-bottom: 6px; display: flex; align-items: center; gap: 6px; color: #0284C7; font-size: 13.5px;">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Kode Verifikasi OTP Dikirim</span>
                    </div>
                    <div style="color: #334155;">{{ session('success_code') }}</div>
                </div>
            @endif

            <!-- STEP 1: Cari Akun User -->
            @if($currentStep == 1)
                <p style="font-size: 13px; color: #64748B; margin-bottom: 16px; line-height: 1.5;">
                    Tahap 1 dari 3: Masukkan nama pengguna atau alamat email akun SIPEKAN Anda untuk menerima <strong>Kode OTP Verifikasi</strong>.
                </p>
                <form action="{{ route('password.send_code') }}" method="POST">
                    @csrf
                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; display: block;">Nama Pengguna atau Email</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input type="text" name="username_email" required class="form-input" placeholder="wusakun@gmail.com atau admin" value="{{ old('username_email', 'wusakun@gmail.com') }}">
                        </div>
                    </div>

                    <div style="display: flex; gap: 10px; margin-top: 16px;">
                        <button type="button" id="cancelForgotModalBtn" style="flex: 1; background: #F1F5F9; color: #475569; border: none; padding: 11px 16px; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer;">Batal</button>
                        <button type="submit" style="flex: 2; background-color: #1B3B6F; color: #FFFFFF; border: none; border-radius: 8px; padding: 11px 16px; font-size: 14px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 12px rgba(27, 59, 111, 0.15);">
                            <span>Kirim Kode OTP</span>
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </form>

            <!-- STEP 2: Input Kode OTP Verifikasi 6-Digit -->
            @elseif($currentStep == 2)
                <p style="font-size: 13px; color: #64748B; margin-bottom: 16px; line-height: 1.5;">
                    Tahap 2 dari 3: Masukkan <strong>Kode Verifikasi 6-Digit</strong> yang telah dikirimkan ke email akun Anda.
                </p>
                <form action="{{ route('password.verify_code') }}" method="POST">
                    @csrf
                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; display: block;">Kode Verifikasi OTP (6 Digit)</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-key input-icon"></i>
                            <input type="text" name="otp_code" required class="form-input" placeholder="Masukkan 6 digit kode OTP (Contoh: 123456)" maxlength="6" autofocus style="letter-spacing: 2px; font-weight: 800; font-size: 16px;">
                        </div>
                    </div>

                    <div style="display: flex; gap: 10px; margin-top: 16px;">
                        <a href="{{ route('password.request') }}" style="flex: 1; background: #F1F5F9; color: #475569; border: none; padding: 11px 16px; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer; text-align: center; text-decoration: none;">Ulangi</a>
                        <button type="submit" style="flex: 2; background-color: #1B3B6F; color: #FFFFFF; border: none; border-radius: 8px; padding: 11px 16px; font-size: 14px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 12px rgba(27, 59, 111, 0.15);">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Verifikasi Kode OTP</span>
                        </button>
                    </div>
                </form>

            <!-- STEP 3: Buat & Konfirmasi Kata Sandi Baru -->
            @elseif($currentStep == 3)
                <p style="font-size: 13px; color: #64748B; margin-bottom: 16px; line-height: 1.5;">
                    Tahap 3 dari 3: Verifikasi berhasil! Silakan buat <strong>Kata Sandi Baru</strong> untuk akun Anda.
                </p>
                <form action="{{ route('password.reset.post') }}" method="POST">
                    @csrf
                    <div class="form-group" style="margin-bottom: 14px;">
                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; display: block;">Kata Sandi Baru</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock input-icon" style="font-size: 14px;"></i>
                            <input type="password" name="new_password" id="newPasswordInput" required class="form-input" placeholder="Minimal 6 karakter" autofocus>
                            <button type="button" class="password-toggle" id="toggleNewPasswordBtn" title="Tampilkan/Sembunyikan kata sandi">
                                <i class="fa-regular fa-eye" id="newPasswordEyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label" style="font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; display: block;">Konfirmasi Kata Sandi Baru</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock input-icon" style="font-size: 14px;"></i>
                            <input type="password" name="new_password_confirmation" id="confirmPasswordInput" required class="form-input" placeholder="Ulangi kata sandi baru">
                        </div>
                    </div>

                    <div style="display: flex; gap: 10px; margin-top: 16px;">
                        <button type="button" id="cancelForgotModalBtn" style="flex: 1; background: #F1F5F9; color: #475569; border: none; padding: 11px 16px; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer;">Batal</button>
                        <button type="submit" style="flex: 2; background-color: #1B3B6F; color: #FFFFFF; border: none; border-radius: 8px; padding: 11px 16px; font-size: 14px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 12px rgba(27, 59, 111, 0.15);">
                            <i class="fa-solid fa-rotate"></i>
                            <span>Simpan Kata Sandi Baru</span>
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const passwordEyeIcon = document.getElementById('passwordEyeIcon');

            if (togglePasswordBtn && passwordInput && passwordEyeIcon) {
                togglePasswordBtn.addEventListener('click', function () {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    if (type === 'text') {
                        passwordEyeIcon.classList.remove('fa-eye');
                        passwordEyeIcon.classList.add('fa-eye-slash');
                    } else {
                        passwordEyeIcon.classList.remove('fa-eye-slash');
                        passwordEyeIcon.classList.add('fa-eye');
                    }
                });
            }

            // Forgot Password Modal Handlers
            const forgotPasswordBtn = document.getElementById('forgotPasswordBtn');
            const forgotModal = document.getElementById('forgotModal');
            const closeForgotModal = document.getElementById('closeForgotModal');
            const cancelForgotModalBtn = document.getElementById('cancelForgotModalBtn');
            const toggleNewPasswordBtn = document.getElementById('toggleNewPasswordBtn');
            const newPasswordInput = document.getElementById('newPasswordInput');
            const newPasswordEyeIcon = document.getElementById('newPasswordEyeIcon');

            if (forgotPasswordBtn && forgotModal) {
                forgotPasswordBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    forgotModal.classList.add('active');
                });
            }

            if (closeForgotModal && forgotModal) {
                closeForgotModal.addEventListener('click', function () {
                    forgotModal.classList.remove('active');
                });
            }

            if (cancelForgotModalBtn && forgotModal) {
                cancelForgotModalBtn.addEventListener('click', function () {
                    forgotModal.classList.remove('active');
                });
            }

            if (toggleNewPasswordBtn && newPasswordInput && newPasswordEyeIcon) {
                toggleNewPasswordBtn.addEventListener('click', function () {
                    const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    newPasswordInput.setAttribute('type', type);
                    
                    if (type === 'text') {
                        newPasswordEyeIcon.classList.remove('fa-eye');
                        newPasswordEyeIcon.classList.add('fa-eye-slash');
                    } else {
                        newPasswordEyeIcon.classList.remove('fa-eye-slash');
                        newPasswordEyeIcon.classList.add('fa-eye');
                    }
                });
            }
        });
    </script>
</body>
</html>
