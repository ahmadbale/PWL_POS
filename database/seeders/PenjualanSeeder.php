<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $data=[
            [
                'user_id' => $faker->numberBetween(1,3),
                'pembeli' => $faker->name,
                'penjualan_kode' => 'PJ01',
                'penjualan_tanggal' => '2024-09-14 00:00:00'
            ],
            [
                'user_id' => 1,
                'pembeli' => $faker->name,
                'penjualan_kode' => 'PJ02',
                'penjualan_tanggal' => '2024-09-14 00:00:00'
            ],
            [
                'user_id' => 1,
                'pembeli' => $faker->name,
                'penjualan_kode' => 'PJ03',
                'penjualan_tanggal' => '2024-09-14 00:00:00'
            ],
            [
                'user_id' => 1,
                'pembeli' => $faker->name,
                'penjualan_kode' => 'PJ04',
                'penjualan_tanggal' => '2024-09-14 00:00:00'
            ],
            [
                'user_id' => 1,
                'pembeli' => $faker->name,
                'penjualan_kode' => 'PJ05',
                'penjualan_tanggal' => '2024-09-14 00:00:00'
            ],
            [
                'user_id' => 2,
                'pembeli' => $faker->name,
                'penjualan_kode' => 'PJ06',
                'penjualan_tanggal' => '2024-09-14 00:00:00'
            ],
            [
                'user_id' => 2,
                'pembeli' => $faker->name,
                'penjualan_kode' => 'PJ07',
                'penjualan_tanggal' => '2024-09-14 00:00:00'
            ],
            [
                'user_id' => 3,
                'pembeli' => $faker->name,
                'penjualan_kode' => 'PJ08',
                'penjualan_tanggal' => '2024-09-14 00:00:00'
            ],
            [
                'user_id' => 3,
                'pembeli' => $faker->name,
                'penjualan_kode' => 'PJ09',
                'penjualan_tanggal' => '2024-09-14 00:00:00'
            ],
            [
                'user_id' => 3,
                'pembeli' => $faker->name,
                'penjualan_kode' => 'PJ10',
                'penjualan_tanggal' => '2024-09-14 00:00:00'
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
