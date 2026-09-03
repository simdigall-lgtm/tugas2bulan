<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;

class PesananSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_pesanan' => 'ORD-2026-001',
                'nama_pelanggan' => 'Budi Santoso',
                'nama_produk' => 'Spanduk / Banner Flexi',
                'jumlah_ukuran' => '2 Pcs (3x1 meter)',
                'total_harga' => 150000,
                'status' => 'Selesai',
                'tanggal_pesan' => '2026-08-01',
            ],
            [
                'kode_pesanan' => 'ORD-2026-002',
                'nama_pelanggan' => 'Siti Aminah',
                'nama_produk' => 'Kartu Nama Exclusive',
                'jumlah_ukuran' => '5 Box',
                'total_harga' => 225000,
                'status' => 'Diproses',
                'tanggal_pesan' => '2026-08-05',
            ],
            [
                'kode_pesanan' => 'ORD-2026-003',
                'nama_pelanggan' => 'PT Jaya Mandiri',
                'nama_produk' => 'Brosur A4 Full Color',
                'jumlah_ukuran' => '10 Rim',
                'total_harga' => 1500000,
                'status' => 'Selesai',
                'tanggal_pesan' => '2026-08-10',
            ],
            [
                'kode_pesanan' => 'ORD-2026-004',
                'nama_pelanggan' => 'Dewi Lestari',
                'nama_produk' => 'Stiker Vinyl Cutting',
                'jumlah_ukuran' => '100 Sheet A3+',
                'total_harga' => 450000,
                'status' => 'Pending',
                'tanggal_pesan' => '2026-08-15',
            ],
            [
                'kode_pesanan' => 'ORD-2026-005',
                'nama_pelanggan' => 'CV Abadi Karya',
                'nama_produk' => 'Kalender Meja 2026',
                'jumlah_ukuran' => '50 Pcs',
                'total_harga' => 2750000,
                'status' => 'Selesai',
                'tanggal_pesan' => '2026-08-20',
            ],
        ];

        foreach ($data as $item) {
            Pesanan::updateOrCreate(['kode_pesanan' => $item['kode_pesanan']], $item);
        }
    }
}
