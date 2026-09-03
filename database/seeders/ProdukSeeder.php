<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_produk' => 'PRD-001',
                'nama_produk' => 'Spanduk / Banner Flexi',
                'kategori' => 'Banner & Outdoor',
                'harga' => 25000,
                'stok' => 500,
                'deskripsi' => 'Cetak banner flexi outdoor resolusi tinggi, tahan cuaca panas dan hujan.',
                'status' => 'Tersedia',
            ],
            [
                'kode_produk' => 'PRD-002',
                'nama_produk' => 'Kartu Nama Exclusive',
                'kategori' => 'Digital Printing',
                'harga' => 45000,
                'stok' => 120,
                'deskripsi' => 'Cetak kartu nama isi 100 lembar Art Carton 260gr plus laminasi doff/glossy.',
                'status' => 'Tersedia',
            ],
            [
                'kode_produk' => 'PRD-003',
                'nama_produk' => 'Brosur A4 Full Color',
                'kategori' => 'Promosi',
                'harga' => 150000,
                'stok' => 80,
                'deskripsi' => 'Cetak brosur A4 1 rim Art Paper 150gr cetak 2 sisi full color.',
                'status' => 'Tersedia',
            ],
            [
                'kode_produk' => 'PRD-004',
                'nama_produk' => 'Stiker Vinyl Cutting',
                'kategori' => 'Stiker & Label',
                'harga' => 35000,
                'stok' => 300,
                'deskripsi' => 'Stiker bahan vinyl waterproof cocok untuk outdoor dan kemasan produk.',
                'status' => 'Tersedia',
            ],
            [
                'kode_produk' => 'PRD-005',
                'nama_produk' => 'Kalender Meja 2026',
                'kategori' => 'Merchandise',
                'harga' => 55000,
                'stok' => 0,
                'deskripsi' => 'Kalender meja custom dudukan hardboard eksklusif.',
                'status' => 'Habis',
            ],
        ];

        foreach ($data as $item) {
            Produk::updateOrCreate(['kode_produk' => $item['kode_produk']], $item);
        }
    }
}
