<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_pelanggan' => 'CUST-001',
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'no_hp' => '+62 812-3456-7890',
                'alamat' => 'Jakarta Pusat, DKI Jakarta',
                'total_pesanan' => 12,
                'tanggal_daftar' => '2026-01-15',
                'status' => 'Aktif',
            ],
            [
                'kode_pelanggan' => 'CUST-002',
                'nama' => 'Siti Aminah',
                'email' => 'siti.aminah@yahoo.com',
                'no_hp' => '+62 813-9876-5432',
                'alamat' => 'Bandung, Jawa Barat',
                'total_pesanan' => 8,
                'tanggal_daftar' => '2026-02-10',
                'status' => 'Aktif',
            ],
            [
                'kode_pelanggan' => 'CUST-003',
                'nama' => 'PT Jaya Mandiri',
                'email' => 'info@jayamandiri.co.id',
                'no_hp' => '+62 821-1122-3344',
                'alamat' => 'Surabaya, Jawa Timur',
                'total_pesanan' => 25,
                'tanggal_daftar' => '2026-03-01',
                'status' => 'Aktif',
            ],
            [
                'kode_pelanggan' => 'CUST-004',
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.l@gmail.com',
                'no_hp' => '+62 856-7788-9900',
                'alamat' => 'Semarang, Jawa Tengah',
                'total_pesanan' => 3,
                'tanggal_daftar' => '2026-04-18',
                'status' => 'Aktif',
            ],
            [
                'kode_pelanggan' => 'CUST-005',
                'nama' => 'CV Abadi Karya',
                'email' => 'contact@abadikarya.com',
                'no_hp' => '+62 878-4455-6677',
                'alamat' => 'Yogyakarta, DI Yogyakarta',
                'total_pesanan' => 17,
                'tanggal_daftar' => '2026-05-05',
                'status' => 'Aktif',
            ]
        ];

        foreach ($data as $item) {
            Pelanggan::updateOrCreate(['kode_pelanggan' => $item['kode_pelanggan']], $item);
        }
    }
}
