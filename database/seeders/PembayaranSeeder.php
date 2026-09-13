<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            // Jan
            ['ORD-2026-001', '2026-01-08', 'Tunai', 150000, 'Lunas'],
            ['ORD-2026-002', '2026-01-14', 'Transfer Bank (BCA)', 2250000, 'Lunas'],
            ['ORD-2026-003', '2026-01-18', 'QRIS', 270000, 'Lunas'],
            ['ORD-2026-004', '2026-01-22', 'Transfer Bank (Mandiri)', 1925000, 'Lunas'],
            ['ORD-2026-005', '2026-01-28', 'Tunai', 525000, 'Lunas'],

            // Feb
            ['ORD-2026-006', '2026-02-04', 'Transfer Bank (BCA)', 1200000, 'Lunas'],
            ['ORD-2026-007', '2026-02-10', 'Transfer Bank (BCA)', 3000000, 'Lunas'],
            ['ORD-2026-008', '2026-02-15', 'Tunai', 1400000, 'Lunas'],
            ['ORD-2026-009', '2026-02-21', 'QRIS', 450000, 'Lunas'],
            ['ORD-2026-010', '2026-02-26', 'Transfer Bank (Mandiri)', 1800000, 'Lunas'],

            // Mar
            ['ORD-2026-011', '2026-03-05', 'Transfer Bank (BCA)', 3750000, 'Lunas'],
            ['ORD-2026-012', '2026-03-12', 'Transfer Bank (Mandiri)', 3750000, 'Lunas'],
            ['ORD-2026-013', '2026-03-18', 'Tunai', 540000, 'Lunas'],
            ['ORD-2026-014', '2026-03-24', 'QRIS', 1750000, 'Lunas'],
            ['ORD-2026-015', '2026-03-29', 'Tunai', 1160000, 'Lunas'],

            // Apr
            ['ORD-2026-016', '2026-04-06', 'Transfer Bank (BCA)', 2700000, 'Lunas'],
            ['ORD-2026-017', '2026-04-12', 'QRIS', 360000, 'Lunas'],
            ['ORD-2026-018', '2026-04-17', 'Transfer Bank (Mandiri)', 2100000, 'Lunas'],
            ['ORD-2026-019', '2026-04-22', 'Transfer Bank (BCA)', 2450000, 'Lunas'],
            ['ORD-2026-020', '2026-04-28', 'Tunai', 1590000, 'Lunas'],

            // Mei
            ['ORD-2026-021', '2026-05-04', 'Transfer Bank (BCA)', 2700000, 'Lunas'],
            ['ORD-2026-022', '2026-05-11', 'Transfer Bank (Mandiri)', 4500000, 'Lunas'],
            ['ORD-2026-023', '2026-05-17', 'QRIS', 2975000, 'Lunas'],
            ['ORD-2026-024', '2026-05-23', 'Transfer Bank (BCA)', 2600000, 'Lunas'],
            ['ORD-2026-025', '2026-05-29', 'Tunai', 1080000, 'Lunas'],

            // Jun
            ['ORD-2026-026', '2026-06-03', 'Transfer Bank (BCA)', 6600000, 'Lunas'],
            ['ORD-2026-027', '2026-06-10', 'Transfer Bank (BCA)', 3750000, 'Lunas'],
            ['ORD-2026-028', '2026-06-16', 'QRIS', 3150000, 'Lunas'],
            ['ORD-2026-029', '2026-06-22', 'Transfer Bank (Mandiri)', 2100000, 'Lunas'],
            ['ORD-2026-030', '2026-06-27', 'Tunai', 810000, 'Lunas'],

            // Jul
            ['ORD-2026-031', '2026-07-04', 'Transfer Bank (BCA)', 4200000, 'Lunas'],
            ['ORD-2026-032', '2026-07-11', 'Transfer Bank (Mandiri)', 6000000, 'Lunas'],
            ['ORD-2026-033', '2026-07-17', 'QRIS', 4200000, 'Lunas'],
            ['ORD-2026-034', '2026-07-24', 'Transfer Bank (BCA)', 4500000, 'Lunas'],
            ['ORD-2026-035', '2026-07-30', 'Tunai', 1050000, 'Lunas'],

            // Agu
            ['ORD-2026-036', '2026-08-02', 'Transfer Bank (BCA)', 6560000, 'Lunas'],
            ['ORD-2026-037', '2026-08-08', 'Tunai', 2880000, 'Lunas'],
            ['ORD-2026-038', '2026-08-14', 'Transfer Bank (BCA)', 5250000, 'Lunas'],
            ['ORD-2026-039', '2026-08-19', 'QRIS', 4900000, 'Lunas'],
            ['ORD-2026-040', '2026-08-25', 'Transfer Bank (Mandiri)', 4000000, 'Lunas'],
            ['ORD-2026-041', '2026-08-29', 'Tunai', 1100000, 'Lunas'],

            // Sep
            ['ORD-2026-042', '2026-09-02', 'Transfer Bank (BCA)', 10000000, 'Lunas'],
            ['ORD-2026-043', '2026-09-05', 'Transfer Bank (Mandiri)', 6750000, 'Lunas'],
            ['ORD-2026-044', '2026-09-08', 'QRIS', 5250000, 'Lunas'],
            ['ORD-2026-045', '2026-09-10', 'Transfer Bank (BCA)', 3750000, 'Lunas'],
            ['ORD-2026-046', '2026-09-11', 'Tunai', 1350000, 'Lunas'],
            ['ORD-2026-047', '2026-09-12', 'Tunai', 1200000, 'Lunas'],
        ];

        foreach ($orders as $idx => $ord) {
            $code = sprintf('PAY-2026-%03d', $idx + 1);
            Pembayaran::updateOrCreate(
                ['kode_pembayaran' => $code],
                [
                    'kode_pesanan' => $ord[0],
                    'tanggal' => $ord[1],
                    'metode' => $ord[2],
                    'jumlah' => $ord[3],
                    'status' => $ord[4],
                ]
            );
        }
    }
}
