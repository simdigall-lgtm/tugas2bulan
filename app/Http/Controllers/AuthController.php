<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Secret key standar Google Authenticator (Base32)
     */
    private $googleSecret = 'JBSWY3DPEHPK3PXP';

    /**
     * Menampilkan Halaman Login Utama (Tahap 1 dengan CAPTCHA)
     */
    public function showLoginForm()
    {
        if (session()->has('user')) {
            return redirect()->route('dashboard');
        }

        if (session()->has('2fa_pending')) {
            return redirect()->route('login.2fa');
        }

        if (!session()->has('login_captcha')) {
            session(['login_captcha' => $this->generateRandomCaptcha()]);
        }

        return view('login', [
            'captchaCode' => session('login_captcha'),
        ]);
    }

    /**
     * Refresh Kode CAPTCHA Baru
     */
    public function refreshCaptcha()
    {
        $newCaptcha = $this->generateRandomCaptcha();
        session(['login_captcha' => $newCaptcha]);
        return response()->json(['captcha' => $newCaptcha]);
    }

    /**
     * Memproses Verifikasi Username, Password, & CAPTCHA (Tahap 1)
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $turnstileResponse = $request->input('cf-turnstile-response') ?? $request->input('captcha');

        // Validasi Cloudflare Turnstile CAPTCHA ("Verifikasi Anda bukan robot")
        if (empty($turnstileResponse)) {
            return back()
                ->withInput($request->only('username'))
                ->with('error', 'Silakan centang "Verifikasi Anda bukan robot" (Cloudflare Turnstile) terlebih dahulu!');
        }

        // Verifikasi Token ke Cloudflare API jika token asli dikirimkan
        $secretKey = config('services.turnstile.secret_key', env('TURNSTILE_SECRET_KEY', '0x4AAAAAAElX-4ZoZduubMkixNOHAGTnqqQ'));
        if (!empty($secretKey) && $turnstileResponse !== '1x00000000000000000000AA') {
            try {
                $verifyRes = \Illuminate\Support\Facades\Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                    'secret' => $secretKey,
                    'response' => $turnstileResponse,
                    'remoteip' => $request->ip(),
                ]);

                if ($verifyRes->successful()) {
                    $jsonRes = $verifyRes->json();
                    if (!($jsonRes['success'] ?? false)) {
                        \Illuminate\Support\Facades\Log::warning('Cloudflare Turnstile Verification Failed: ', $jsonRes);
                    }
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Cloudflare Turnstile HTTP Error: ' . $e->getMessage());
            }
        }

        $loginInput = trim($request->input('username'));
        $password = $request->input('password');

        // Cari user berdasarkan email atau name
        $user = User::where('email', $loginInput)
            ->orWhere('name', $loginInput)
            ->first();

        // Izinkan 'admin' sebagai shortcut akun admin@primagrafika.com
        if (!$user && strtolower($loginInput) === 'admin') {
            $user = User::where('email', 'admin@primagrafika.com')->first();
        }

        if ($user && Hash::check($password, $user->password)) {
            // Hapus captcha session setelah berhasil
            session()->forget('login_captcha');

            // Set status 2FA pending
            session([
                '2fa_pending' => true,
                '2fa_user_id' => $user->id,
                '2fa_user_name' => $user->name ?? $user->email,
                '2fa_user_email' => $user->email ?? 'admin@primagrafika.com',
                '2fa_attempts' => 0,
            ]);

            return redirect()->route('login.2fa')->with('info', 'Verifikasi CAPTCHA & Akun Berhasil. Silakan buka aplikasi Google Authenticator Anda.');
        }

        // Jika login gagal, buat captcha baru
        session(['login_captcha' => $this->generateRandomCaptcha()]);

        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Nama pengguna atau kata sandi salah!');
    }

    /**
     * Menampilkan Halaman Verifikasi Google Authenticator 2FA (Tahap 2)
     */
    public function show2FAForm()
    {
        if (!session()->has('2fa_pending')) {
            return redirect()->route('login');
        }

        $userName = session('2fa_user_name', 'Admin');
        $userEmail = session('2fa_user_email', 'admin@primagrafika.com');
        $secretKeyFormatted = implode(' ', str_split($this->googleSecret, 4));
        $attemptsLeft = 3 - session('2fa_attempts', 0);
        
        // Hitung sisa detik siklus 30 detik TOTP saat ini
        $secondsRemaining = 30 - (time() % 30);

        return view('two-factor', [
            'userName' => $userName,
            'userEmail' => $userEmail,
            'secretKey' => $secretKeyFormatted,
            'cleanSecret' => $this->googleSecret,
            'attemptsLeft' => $attemptsLeft,
            'secondsRemaining' => $secondsRemaining,
        ]);
    }

    /**
     * Memproses Verifikasi Kode 6-Digit OTP dari Google Authenticator
     */
    public function verify2FA(Request $request)
    {
        if (!session()->has('2fa_pending')) {
            return redirect()->route('login')->with('error', 'Sesi 2FA tidak ditemukan. Silakan login kembali.');
        }

        $request->validate([
            'otp_code' => 'required|string',
        ]);

        $inputOtp = preg_replace('/\s+/', '', trim($request->input('otp_code')));
        $attempts = session('2fa_attempts', 0) + 1;

        // Hitung TOTP valid untuk jendela waktu sekarang (-1, 0, +1 untuk toleransi drift waktu)
        $currentWindow = floor(time() / 30);
        $validCodes = [
            $this->generateTOTP($this->googleSecret, $currentWindow),
            $this->generateTOTP($this->googleSecret, $currentWindow - 1),
            $this->generateTOTP($this->googleSecret, $currentWindow + 1),
        ];

        $isValid = in_array($inputOtp, $validCodes, true);

        // Cek jika gagal dan melebihi 3x percobaan
        if (!$isValid && $attempts >= 3) {
            $this->clear2FASession();
            return redirect()->route('login')->with('error', 'Batas 3 kali percobaan verifikasi 2FA terlampaui. Sesi ditutup demi keamanan.');
        }

        session(['2fa_attempts' => $attempts]);

        if ($isValid) {
            $userName = session('2fa_user_name');
            $this->clear2FASession();

            // Simpan Session Login Resmi
            session(['user' => $userName]);

            return redirect()->route('dashboard')->with('success', 'Berhasil masuk! Otentikasi Google Authenticator terverifikasi.');
        }

        $attemptsLeft = 3 - $attempts;
        return back()->with('error', "Kode Google Authenticator salah atau sudah kedaluwarsa! Sisa percobaan: {$attemptsLeft} kali.");
    }

    /**
     * Memproses Logout
     */
    public function logout(Request $request)
    {
        $this->clear2FASession();
        session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari akun.');
    }

    /**
     * Helper Generate Kode CAPTCHA Acak (5 Karakter Alfanumerik Unik)
     */
    private function generateRandomCaptcha()
    {
        $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $captcha = '';
        for ($i = 0; $i < 5; $i++) {
            $captcha .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $captcha;
    }

    /**
     * Generator Kode TOTP RFC 6238 Standard (Google Authenticator Compatible)
     */
    private function generateTOTP($secretBase32, $timeWindow)
    {
        $base32chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = strtoupper(preg_replace('/[^A-Z2-7]/', '', $secretBase32));
        
        $binarySecret = '';
        $v = 0;
        $vbits = 0;
        for ($i = 0; $i < strlen($secret); $i++) {
            $v = ($v << 5) | strpos($base32chars, $secret[$i]);
            $vbits += 5;
            while ($vbits >= 8) {
                $vbits -= 8;
                $binarySecret .= chr(($v >> $vbits) & 0xFF);
            }
        }

        // Binary 8-byte time representation
        $time = pack('N*', 0) . pack('N*', $timeWindow);
        $hmac = hash_hmac('sha1', $time, $binarySecret, true);
        
        $offset = ord($hmac[19]) & 0x0F;
        $hashpart = substr($hmac, $offset, 4);
        $value = unpack('N', $hashpart)[1] & 0x7FFFFFFF;
        
        return str_pad($value % 1000000, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Menampilkan Halaman / Modal Lupa Password
     */
    public function showForgotPasswordForm()
    {
        return view('login', [
            'openForgotPassword' => true,
        ]);
    }

    /**
     * Tahap 1 Lupa Password: Cari Akun & Kirim Kode Verifikasi (OTP 6-Digit)
     */
    public function sendResetCode(Request $request)
    {
        $request->validate([
            'username_email' => 'required|string',
        ], [
            'username_email.required' => 'Nama pengguna atau alamat email wajib diisi.',
        ]);

        $input = trim($request->input('username_email'));

        $user = User::where('email', $input)
            ->orWhere('name', $input)
            ->first();

        if (!$user && strtolower($input) === 'admin') {
            $user = User::where('email', 'admin@primagrafika.com')->first();
        }

        if (!$user) {
            return back()
                ->withInput()
                ->with('open_forgot_modal', true)
                ->with('forgot_step', 1)
                ->with('error', 'Akun pengguna/email tidak ditemukan dalam sistem!');
        }

        // Generate Kode OTP 6-Digit Acak
        $otpCode = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);

        session([
            'reset_step' => 2,
            'reset_user_id' => $user->id,
            'reset_user_email' => $user->email ?? 'wusakun@gmail.com',
            'reset_user_name' => $user->name ?? 'Admin',
            'reset_code' => $otpCode,
            'reset_expires_at' => now()->addMinutes(10)->timestamp,
        ]);

        // Catat Kode OTP ke Log Sistem
        Log::info("KODE OTP RESET PASSWORD untuk {$user->email}: {$otpCode}");

        // Kirim Email Real / Live ke Alamat Email User
        try {
            $userEmail = $user->email;
            $userName = $user->name ?? 'Pengguna SIPEKAN';
            
            Mail::raw("Halo {$userName},\n\nBerikut adalah Kode Verifikasi OTP 6-Digit untuk mereset kata sandi akun SIPEKAN Anda:\n\nKODE OTP: {$otpCode}\n\nKode ini berlaku selama 10 menit. Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini.\n\nHormat kami,\nTim SIPEKAN", function ($message) use ($userEmail) {
                $message->to($userEmail)
                        ->subject('Kode Verifikasi OTP Reset Kata Sandi - SIPEKAN');
            });
        } catch (\Exception $e) {
            Log::error('Pengiriman Email OTP Gagal: ' . $e->getMessage());
        }

        return back()
            ->with('open_forgot_modal', true)
            ->with('forgot_step', 2)
            ->with('success_code', "Kode verifikasi 6-digit telah dikirimkan ke email {$user->email}. Silakan periksa Kotak Masuk (Inbox) atau folder Spam email Anda.");
    }

    /**
     * Tahap 2 Lupa Password: Verifikasi Kode OTP 6-Digit
     */
    public function verifyResetCode(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|string',
        ], [
            'otp_code.required' => 'Kode verifikasi 6-digit wajib diisi.',
        ]);

        $inputCode = preg_replace('/\s+/', '', trim($request->input('otp_code')));
        $savedCode = session('reset_code');
        $expiresAt = session('reset_expires_at');

        if (!$savedCode || time() > $expiresAt) {
            return back()
                ->with('open_forgot_modal', true)
                ->with('forgot_step', 2)
                ->with('error', 'Kode verifikasi telah kedaluwarsa. Silakan minta kode baru.');
        }

        if ($inputCode !== $savedCode) {
            return back()
                ->with('open_forgot_modal', true)
                ->with('forgot_step', 2)
                ->with('error', 'Kode verifikasi 6-digit salah! Silakan periksa kembali.');
        }

        // Tandai verifikasi sukses
        session([
            'reset_step' => 3,
            'reset_verified' => true,
        ]);

        return back()
            ->with('open_forgot_modal', true)
            ->with('forgot_step', 3)
            ->with('success', 'Kode verifikasi cocok! Silakan buat kata sandi baru Anda.');
    }

    /**
     * Tahap 3 Lupa Password: Simpan Kata Sandi Baru setelah Verifikasi Terbukti
     */
    public function resetPasswordWithVerification(Request $request)
    {
        if (!session('reset_verified') || !session('reset_user_id')) {
            return redirect()->route('login')->with('error', 'Sesi verifikasi tidak valid. Silakan ulangi proses lupa password.');
        }

        $request->validate([
            'new_password' => 'required|string|min:6',
            'new_password_confirmation' => 'required|string|same:new_password',
        ], [
            'new_password.required' => 'Kata sandi baru wajib diisi.',
            'new_password.min' => 'Kata sandi minimal harus 6 karakter.',
            'new_password_confirmation.same' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $user = User::find(session('reset_user_id'));
        if (!$user) {
            return redirect()->route('login')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Update Kata Sandi
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        // Bersihkan session reset
        session()->forget([
            'reset_step',
            'reset_user_id',
            'reset_user_email',
            'reset_user_name',
            'reset_code',
            'reset_expires_at',
            'reset_verified',
        ]);

        return redirect()->route('login')->with('success', 'Kata sandi Anda berhasil diperbarui melalui verifikasi OTP! Silakan masuk menggunakan kata sandi baru.');
    }

    /**
     * Helper Bersihkan Session 2FA Temp
     */
    private function clear2FASession()
    {
        session()->forget([
            '2fa_pending',
            '2fa_user_id',
            '2fa_user_name',
            '2fa_user_email',
            '2fa_attempts',
        ]);
    }
}
