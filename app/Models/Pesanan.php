<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pesanan',
        'nama_pelanggan',
        'nama_produk',
        'jumlah_ukuran',
        'total_harga',
        'status',
        'tanggal_pesan',
    ];
}
