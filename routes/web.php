<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function (Request $request) {
    if (session()->has('user')) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

Route::get('/login', function (Request $request) {
    if (session()->has('user')) {
        return redirect()->route('dashboard');
    }
    return view('login');
});

Route::post('/login', function (Request $request) {
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $username = $request->input('username');

    // Store user session upon login
    session(['user' => $username]);

    return redirect()->route('dashboard')->with('success', 'Berhasil masuk! Selamat datang di Dashboard.');
})->name('login.post');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/pelanggan', function () {
    return view('pelanggan');
})->name('pelanggan');

Route::get('/produk', function () {
    return view('produk');
})->name('produk');

Route::get('/pesanan', function () {
    return view('pesanan');
})->name('pesanan');

Route::get('/pembayaran', function () {
    return view('pembayaran');
})->name('pembayaran');

Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');

Route::get('/pengaturan', function () {
    return view('pengaturan');
})->name('pengaturan');

Route::match(['get', 'post'], '/logout', function (Request $request) {
    session()->forget('user');
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
})->name('logout');
