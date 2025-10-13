<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserULPSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_u_l_p_s')->insert([
            [
                'nama_ulp' => 'ULP Bogor Kota',
                'username' => 'ulpbogor',
                'password' => Hash::make('ulp123'), 
            ],
            [
                'nama_ulp' => 'ULP Bogor Barat',
                'username' => 'ulpbogorbarat',
                'password' => Hash::make('ulp123'),
            ],
            [
                'nama_ulp' => 'ULP Bogor Timur',
                'username' => 'ulpbogortimur',
                'password' => Hash::make('ulp123'),
            ],
            [
                'nama_ulp' => 'ULP Cipayung',
                'username' => 'ulpcipayung',
                'password' => Hash::make('ulp123'),
            ],
            [
                'nama_ulp' => 'ULP Jasinga',
                'username' => 'ulpjasinga',
                'password' => Hash::make('ulp123'),
            ],
            [
                'nama_ulp' => 'ULP Leuwiliang',
                'username' => 'ulpleuwiliang',
                'password' => Hash::make('ulp123'),
            ],
        ]);
    }
}
