<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@primagrafika.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('123'),
            ]
        );

        $this->call([
            PelangganSeeder::class,
            ProdukSeeder::class,
            PesananSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}
