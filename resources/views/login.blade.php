<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CV Prima Grafika</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
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

        .login-card {
            width: 100%;
            max-width: 940px;
            background: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.05), 0 2px 8px rgba(0, 0, 0, 0.02);
            display: flex;
            overflow: hidden;
            border: 1px solid #E5E7EB;
            min-height: 540px;
        }

        /* Left Column - Form */
        .login-form-container {
            flex: 1;
            padding: 48px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-logo-wrapper {
            margin-bottom: 24px;
            margin-left: -20px;
        }

        .brand-logo {
            height: 70px;
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
            font-size: 14px;
            font-weight: 500;
            color: #4B5563;
            line-height: 1.45;
            margin-bottom: 28px;
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
            margin-bottom: 20px;
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
            margin-top: 10px;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 4px 12px rgba(27, 59, 111, 0.15);
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
            padding: 40px;
            position: relative;
        }

        .illustration-image {
            max-width: 100%;
            max-height: 420px;
            width: auto;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.05));
            transition: transform 0.3s ease;
        }

        .illustration-image:hover {
            transform: scale(1.02);
        }

        /* Responsive Breakpoints */
        @media (max-width: 820px) {
            .login-card {
                flex-direction: column;
                max-width: 480px;
            }

            .login-illustration-container {
                display: none; /* Mobile view keeps form clean as standard */
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

            <h1 class="brand-title">CV Prima Grafika</h1>
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
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit">
                    Masuk
                </button>
            </form>
        </div>

        <!-- Right Side: Side Illustration -->
        <div class="login-illustration-container">
            <img src="{{ asset('assets/images/printing-illustration.png') }}" 
                 alt="Percetakan CV Prima Grafika" 
                 class="illustration-image">
        </div>
    </div>

    <script>
        // Password Visibility Toggle Script
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
        });
    </script>
</body>
</html>
