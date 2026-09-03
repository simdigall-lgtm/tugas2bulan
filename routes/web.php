<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaturanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

class AuthCheckSession
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('2fa_pending')) {
            return redirect()->route('login.2fa')->with('info', 'Silakan selesaikan verifikasi Google Authenticator 2FA terlebih dahulu.');
        }

        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu untuk mengakses sistem.');
        }

        return $next($request);
    }
}

// Public Auth & 2FA Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/login/captcha-refresh', [AuthController::class, 'refreshCaptcha'])->name('login.captcha.refresh');

// Lupa Password / Reset Password Verification Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password/send-code', [AuthController::class, 'sendResetCode'])->name('password.send_code');
Route::post('/forgot-password/verify-code', [AuthController::class, 'verifyResetCode'])->name('password.verify_code');
Route::post('/forgot-password/reset-password', [AuthController::class, 'resetPasswordWithVerification'])->name('password.reset.post');

// Google Authenticator 2FA Routes
Route::get('/login/2fa', [AuthController::class, 'show2FAForm'])->name('login.2fa');
Route::post('/login/2fa', [AuthController::class, 'verify2FA'])->name('login.2fa.verify');
Route::post('/login/2fa/refresh', [AuthController::class, 'refresh2FA'])->name('login.2fa.refresh');

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');


// Protected Routes
Route::middleware([AuthCheckSession::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan');
    Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    // Produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::put('/pesanan/{id}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.destroy');

    // Pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
    Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

    // Laporan & Pengaturan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
});



