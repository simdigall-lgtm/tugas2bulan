<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_pembayaran' => 'PAY-2026-001',
                'kode_pesanan' => 'ORD-2026-001',
                'tanggal' => '2026-08-01',
                'metode' => 'Transfer Bank (BCA)',
                'jumlah' => 150000,
                'status' => 'Lunas',
            ],
            [
                'kode_pembayaran' => 'PAY-2026-002',
                'kode_pesanan' => 'ORD-2026-002',
                'tanggal' => '2026-08-05',
                'metode' => 'QRIS',
                'jumlah' => 225000,
                'status' => 'Lunas',
            ],
            [
                'kode_pembayaran' => 'PAY-2026-003',
                'kode_pesanan' => 'ORD-2026-003',
                'tanggal' => '2026-08-10',
                'metode' => 'Transfer Bank (Mandiri)',
                'jumlah' => 1500000,
                'status' => 'Lunas',
            ],
            [
                'kode_pembayaran' => 'PAY-2026-004',
                'kode_pesanan' => 'ORD-2026-004',
                'tanggal' => '2026-08-15',
                'metode' => 'Tunai',
                'jumlah' => 450000,
                'status' => 'Pending',
            ],
            [
                'kode_pembayaran' => 'PAY-2026-005',
                'kode_pesanan' => 'ORD-2026-005',
                'tanggal' => '2026-08-20',
                'metode' => 'Transfer Bank (BCA)',
                'jumlah' => 2750000,
                'status' => 'Lunas',
            ],
        ];

        foreach ($data as $item) {
            Pembayaran::updateOrCreate(['kode_pembayaran' => $item['kode_pembayaran']], $item);
        }
    }
}
