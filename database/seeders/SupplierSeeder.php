<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'supplier_id' => 1,
                'supplier_kode' => 'SUP1',
                'supplier_nama' => 'Bandung Clothing',
                'supplier_alamat' => 'Jl. Bandung No.3'
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'SUP2',
                'supplier_nama' => 'Hartono Elektronik',
                'supplier_alamat' => 'Jl. Soekarno Hatta'
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'SUP3',
                'supplier_nama' => 'PT Sinar Kencaya Agung',
                'supplier_alamat' => 'Jl. Kyai Tamin No.115'
            ]
            ];
            DB::table('m_supplier')->insert($data);
    }

}
