<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pembayaran;

class LaporanController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::orderBy('id', 'desc')->get();
        $totalPendapatan = Pembayaran::where('status', 'Lunas')->sum('jumlah');
        $totalTransaksi = Pesanan::count();
        $pesananSelesai = Pesanan::orderBy('id', 'desc')->get();

        return view('laporan', compact('pesanans', 'totalPendapatan', 'totalTransaksi', 'pesananSelesai'));
    }
}

