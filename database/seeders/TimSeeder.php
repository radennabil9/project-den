<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tim;

class TimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tim::create([
            'nama_regu' => 'Regu 1',
            'anggota' => 'Anggota 1, Anggota 2',
            'user_ulp_id' => 1, // Pastikan user_ulp_id ini valid di tabel user_ulps
        ]);
    }
}
