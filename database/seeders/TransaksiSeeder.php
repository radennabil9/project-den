<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\Tim;
use App\Models\UserULP;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamIds = Tim::pluck('id');

        if ($teamIds->isEmpty()) {
            $ulpIds = UserULP::pluck('id');

            if ($ulpIds->isEmpty()) {
                return;
            }

            $newTeams = [];
            $counter = 1;
            foreach ($ulpIds as $ulpId) {
                $newTeams[] = [
                    'nama_regu' => 'Regu Seed ' . $counter,
                    'anggota' => 'Anggota A' . $counter . ', Anggota B' . $counter,
                    'user_ulp_id' => $ulpId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $counter++;
            }

            Tim::insert($newTeams);
            $teamIds = Tim::pluck('id');
        }

        $periods = [];
        for ($year = 2022; $year <= 2026; $year++) {
            for ($month = 1; $month <= 12; $month++) {
                $periods[] = ['year' => $year, 'month' => $month];
            }
        }

        $rows = [];
        for ($i = 0; $i < 200; $i++) {
            $picked = $periods[array_rand($periods)];
            $start = Carbon::create($picked['year'], $picked['month'], 1)->startOfMonth();
            $end = (clone $start)->endOfMonth();
            $day = random_int(1, $end->day);
            $date = Carbon::create($picked['year'], $picked['month'], $day)->format('Y-m-d');

            $rows[] = [
                'tanggal' => $date,
                'tim_id' => $teamIds->random(),
                'realisasi_kwh' => random_int(450, 5000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Transaksi::insert($rows);
    }
}
