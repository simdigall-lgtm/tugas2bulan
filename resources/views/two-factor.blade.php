<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi 2FA - SIPEKAN</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

        .twofa-card {
            width: 100%;
            max-width: 500px;
            background: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.05), 0 2px 8px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            border: 1px solid #E5E7EB;
            padding: 40px 36px;
        }


        .brand-title {
            font-size: 24px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 4px;
            letter-spacing: -0.4px;
        }

        .brand-subtitle {
            font-size: 13.5px;
            font-weight: 500;
            color: #4B5563;
            line-height: 1.45;
            margin-bottom: 18px;
        }

        .user-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #F1F5F9;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12.5px;
            font-weight: 700;
            color: #1E3A8A;
            margin-bottom: 24px;
            border: 1px solid #E2E8F0;
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
            line-height: 1.4;
        }

        .alert-danger {
            background-color: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FCA5A5;
        }

        .alert-info {
            background-color: #F0FDF4;
            color: #166534;
            border: 1px solid #86EFAC;
        }

        /* Timer & Attempts Bar */
        .status-header-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .status-label {
            font-size: 13px;
            font-weight: 700;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .attempts-badge {
            font-size: 11.5px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 12px;
            background: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FCA5A5;
        }

        .totp-timer-bar {
            width: 100%;
            height: 6px;
            background: #E5E7EB;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 22px;
        }

        .totp-timer-fill {
            height: 100%;
            background: #1B3B6F;
            width: 100%;
            transition: width 1s linear;
        }

        /* 6-Digit OTP Inputs */
        .otp-inputs-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 24px;
        }

        .otp-digit-input {
            width: 58px;
            height: 62px;
            border: 1.5px solid #D1D5DB;
            border-radius: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 24px;
            font-weight: 800;
            text-align: center;
            color: #111827;
            background-color: #FFFFFF;
            transition: all 0.2s ease-in-out;
            outline: none;
        }

        .otp-digit-input:focus {
            border-color: #1E3A8A;
            box-shadow: 0 0 0 3.5px rgba(30, 58, 138, 0.12);
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

        /* QR Setup Accordion / Modal Box */
        .setup-toggle-wrapper {
            margin-top: 18px;
            text-align: center;
        }

        .btn-setup-toggle {
            background: none;
            border: none;
            color: #1B3B6F;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s ease;
        }

        .btn-setup-toggle:hover {
            color: #142F5B;
            text-decoration: underline;
        }

        .setup-box {
            display: none;
            background: #F8FAFC;
            border: 1.5px dashed #CBD5E1;
            border-radius: 12px;
            padding: 18px;
            margin-top: 14px;
            text-align: left;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .setup-box-title {
            font-size: 13px;
            font-weight: 800;
            color: #1E293B;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .setup-box-desc {
            font-size: 12px;
            color: #64748B;
            line-height: 1.4;
            margin-bottom: 12px;
        }

        .setup-qr-wrapper {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .qr-code-img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            background: #FFFFFF;
            padding: 4px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            flex-shrink: 0;
        }

        .secret-key-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #1E293B;
            color: #38BDF8;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 10px;
            border-radius: 6px;
            letter-spacing: 1px;
            cursor: pointer;
            margin-top: 6px;
        }

        .footer-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px dashed #E5E7EB;
        }

        .btn-link {
            background: none;
            border: none;
            color: #6B7280;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s ease;
        }

        .btn-link:hover {
            color: #111827;
        }
    </style>
</head>
<body>

    <div class="twofa-card">

        <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 22px;">
            <img src="{{ asset('assets/images/sipekan-logo.png') }}" alt="SIPEKAN Logo"
                style="height: 46px; width: auto; object-fit: contain; flex-shrink: 0; display: block;">
            <div style="display: flex; flex-direction: column; justify-content: space-between; height: 46px;">
                <h1 class="brand-title" style="margin: 0; font-size: 22px; font-weight: 800; line-height: 1.1; letter-spacing: -0.4px;">SIPEKAN</h1>
                <p class="brand-subtitle" style="margin: 0; font-size: 12.5px; font-weight: 500; line-height: 1.25; color: #4B5563;">Verifikasi Keamanan Google Authenticator</p>
            </div>
        </div>

        <div class="user-pill">
            <img src="{{ asset('assets/images/admin-avatar.png') }}" alt="Admin Avatar" style="width: 26px; height: 26px; border-radius: 50%; object-fit: cover; border: 1.5px solid #CBD5E1;">
            <span>{{ $userName }} ({{ $userEmail }})</span>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Status Header Bar -->
        <div class="status-header-bar">
            <div class="status-label">
                <i class="fa-solid fa-mobile-screen-button" style="color: #1B3B6F;"></i>
                <span>Masukkan 6-Digit Kode Authenticator:</span>
            </div>
            <div class="attempts-badge">
                Sisa Percobaan: {{ $attemptsLeft }}/3
            </div>
        </div>

        <!-- TOTP Cycle Timer Bar -->
        <div class="totp-timer-bar">
            <div class="totp-timer-fill" id="totpTimerFill"></div>
        </div>

        <!-- 6-Digit OTP Form -->
        <form action="{{ route('login.2fa.verify') }}" method="POST" id="otpForm" autocomplete="off">
            @csrf
            <input type="hidden" name="otp_code" id="fullOtpInput">

            <div class="otp-inputs-wrapper">
                <input type="text" maxlength="1" class="otp-digit-input" id="digit1" autofocus autocomplete="off">
                <input type="text" maxlength="1" class="otp-digit-input" id="digit2" autocomplete="off">
                <input type="text" maxlength="1" class="otp-digit-input" id="digit3" autocomplete="off">
                <input type="text" maxlength="1" class="otp-digit-input" id="digit4" autocomplete="off">
                <input type="text" maxlength="1" class="otp-digit-input" id="digit5" autocomplete="off">
                <input type="text" maxlength="1" class="otp-digit-input" id="digit6" autocomplete="off">
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-shield-check"></i>
                <span>Verifikasi & Masuk Sistem</span>
            </button>
        </form>



        <!-- Footer Action Links -->
        <div class="footer-actions">
            <a href="{{ route('login.2fa') }}" class="btn-link">
                <i class="fa-solid fa-rotate-right"></i>
                <span>Refresh Halaman</span>
            </a>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-link" style="color: #94A3B8;">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Keluar / Batal</span>
                </button>
            </form>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Toggle Setup QR Code Box
            const toggleSetupBtn = document.getElementById('toggleSetupBtn');
            const setupBox = document.getElementById('setupBox');

            if (toggleSetupBtn && setupBox) {
                toggleSetupBtn.addEventListener('click', function () {
                    if (setupBox.style.display === 'block') {
                        setupBox.style.display = 'none';
                    } else {
                        setupBox.style.display = 'block';
                    }
                });
            }

            // 2. Setup Copy Secret Key
            const secretKeyBadge = document.getElementById('secretKeyBadge');
            if (secretKeyBadge) {
                secretKeyBadge.addEventListener('click', function () {
                    navigator.clipboard.writeText('{{ $cleanSecret }}');
                    const span = this.querySelector('span');
                    const originalText = span.innerText;
                    span.innerText = 'TERSALIN!';
                    setTimeout(() => span.innerText = originalText, 1500);
                });
            }

            // 3. Setup 6-Digit OTP Inputs Auto-Tab & Auto-Submit
            const digitInputs = [
                document.getElementById('digit1'),
                document.getElementById('digit2'),
                document.getElementById('digit3'),
                document.getElementById('digit4'),
                document.getElementById('digit5'),
                document.getElementById('digit6')
            ];
            const fullOtpInput = document.getElementById('fullOtpInput');
            const otpForm = document.getElementById('otpForm');

            digitInputs.forEach((input, index) => {
                input.addEventListener('input', function (e) {
                    const value = this.value.replace(/[^0-9]/g, '');
                    this.value = value;

                    if (value && index < 5) {
                        digitInputs[index + 1].focus();
                    }

                    combineDigits();
                });

                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && !this.value && index > 0) {
                        digitInputs[index - 1].focus();
                    }
                });

                input.addEventListener('paste', function (e) {
                    e.preventDefault();
                    const pastedData = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
                    if (pastedData) {
                        for (let i = 0; i < 6; i++) {
                            if (pastedData[i]) {
                                digitInputs[i].value = pastedData[i];
                            }
                        }
                        if (digitInputs[5].value) {
                            digitInputs[5].focus();
                        } else {
                            const lastFilled = Math.min(pastedData.length, 6) - 1;
                            if (lastFilled >= 0) digitInputs[lastFilled].focus();
                        }
                        combineDigits();
                    }
                });
            });

            function combineDigits() {
                const combined = digitInputs.map(input => input.value).join('');
                fullOtpInput.value = combined;

                if (combined.length === 6) {
                    setTimeout(() => {
                        otpForm.submit();
                    }, 150);
                }
            }

            // 4. Live 30-Second TOTP Cycle Progress Bar Sync
            let remainingSeconds = {{ $secondsRemaining }};
            const totpTimerFill = document.getElementById('totpTimerFill');

            function updateTimer() {
                const percentage = (remainingSeconds / 30) * 100;
                if (totpTimerFill) {
                    totpTimerFill.style.width = percentage + '%';
                }

                if (remainingSeconds <= 0) {
                    remainingSeconds = 60;
                } else {
                    remainingSeconds--;
                }
            }

            updateTimer();
            setInterval(updateTimer, 1000);
        });
    </script>
</body>
</html>
