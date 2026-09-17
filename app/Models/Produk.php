<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori',
        'harga',
        'stok',
        'deskripsi',
        'status',
    ];

    protected static function booted()
    {
        static::saving(function ($produk) {
            if ($produk->stok <= 0) {
                $produk->status = 'Habis';
            } elseif (strtolower($produk->status ?? '') === 'habis' && $produk->stok > 0) {
                $produk->status = 'Tersedia';
            }
        });
    }
}
