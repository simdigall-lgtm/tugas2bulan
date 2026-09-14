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
                'total_pesanan' => 9,
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
            ],
            [
                'kode_pelanggan' => 'CUST-006',
                'nama' => 'Toko Berkah Mandiri',
                'email' => 'berkah.mandiri@gmail.com',
                'no_hp' => '+62 819-2233-4455',
                'alamat' => 'Malang, Jawa Timur',
                'total_pesanan' => 14,
                'tanggal_daftar' => '2026-06-12',
                'status' => 'Aktif',
            ],
            [
                'kode_pelanggan' => 'CUST-007',
                'nama' => 'Yayasan Bina Insani',
                'email' => 'admin@binainsani.org',
                'no_hp' => '+62 852-3344-5566',
                'alamat' => 'Depok, Jawa Barat',
                'total_pesanan' => 11,
                'tanggal_daftar' => '2026-07-08',
                'status' => 'Aktif',
            ],
            [
                'kode_pelanggan' => 'CUST-008',
                'nama' => 'Resto Sedap Rasa',
                'email' => 'resto.sedaprasa@gmail.com',
                'no_hp' => '+62 811-9988-7766',
                'alamat' => 'Tangerang Selatan, Banten',
                'total_pesanan' => 16,
                'tanggal_daftar' => '2026-08-03',
                'status' => 'Aktif',
            ],
            [
                'kode_pelanggan' => 'CUST-009',
                'nama' => 'dr. Hendra Kurniawan',
                'email' => 'dr.hendra.k@gmail.com',
                'no_hp' => '+62 812-7766-5544',
                'alamat' => 'Bekasi, Jawa Barat',
                'total_pesanan' => 6,
                'tanggal_daftar' => '2026-08-20',
                'status' => 'Aktif',
            ],
            [
                'kode_pelanggan' => 'CUST-010',
                'nama' => 'Klinik Medika Sehat',
                'email' => 'medikasehat@klinik.co.id',
                'no_hp' => '+62 823-4455-6677',
                'alamat' => 'Jakarta Selatan, DKI Jakarta',
                'total_pesanan' => 5,
                'tanggal_daftar' => '2026-09-02',
                'status' => 'Aktif',
            ],
        ];

        foreach ($data as $item) {
            Pelanggan::updateOrCreate(['kode_pelanggan' => $item['kode_pelanggan']], $item);
        }
    }
}
