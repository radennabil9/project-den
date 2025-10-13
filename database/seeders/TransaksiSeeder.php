<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaksi::create([
            'tanggal' => '2025-10-09',
            'tim_id' => 1,
            'realisasi_kwh' => 1234.56, // Pastikan ini angka
        ]);
    }
}
