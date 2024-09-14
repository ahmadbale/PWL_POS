<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'E01',
                'barang_nama' => 'Lampu Gantung',
                'harga_beli' => 100000,
                'harga_jual' => 120000
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'E02',
                'barang_nama' => 'Kulkas',
                'harga_beli' => 5000000,
                'harga_jual' => 5500000
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 1,
                'barang_kode' => 'E03',
                'barang_nama' => 'Mesin Cuci',
                'harga_beli' => 2000000,
                'harga_jual' => 2500000
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 1,
                'barang_kode' => 'E04',
                'barang_nama' => 'Mouse',
                'harga_beli' => 80000,
                'harga_jual' => 100000
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 1,
                'barang_kode' => 'E05',
                'barang_nama' => 'Keyboard',
                'harga_beli' => 90000,
                'harga_jual' => 110000
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 2,
                'barang_kode' => 'P01',
                'barang_nama' => 'Baju Laki-Laki',
                'harga_beli' => 100000,
                'harga_jual' => 120000
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 2,
                'barang_kode' => 'P02',
                'barang_nama' => 'Baju Perempuan',
                'harga_beli' => 200000,
                'harga_jual' => 250000
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 2,
                'barang_kode' => 'P03',
                'barang_nama' => 'Baju Anak-Anak',
                'harga_beli' => 50000,
                'harga_jual' => 80000
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 2,
                'barang_kode' => 'P04',
                'barang_nama' => 'Baju Bayi',
                'harga_beli' => 30000,
                'harga_jual' => 40000
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 2,
                'barang_kode' => 'P05',
                'barang_nama' => 'Topi',
                'harga_beli' => 50000,
                'harga_jual' => 65000
            ],
            [
                'barang_id' => 11,
                'kategori_id' => 3,
                'barang_kode' => 'A01',
                'barang_nama' => 'Pensil',
                'harga_beli' => 5000,
                'harga_jual' => 10000
            ],
            [
                'barang_id' => 12,
                'kategori_id' => 3,
                'barang_kode' => 'A02',
                'barang_nama' => 'Penghapus',
                'harga_beli' => 3000,
                'harga_jual' => 5000
            ],
            [
                'barang_id' => 13,
                'kategori_id' => 3,
                'barang_kode' => 'A03',
                'barang_nama' => 'Tipe-X',
                'harga_beli' => 6000,
                'harga_jual' => 8000
            ],
            [
                'barang_id' => 14,
                'kategori_id' => 3,
                'barang_kode' => 'A04',
                'barang_nama' => 'Kotak Pensil',
                'harga_beli' => 20000,
                'harga_jual' => 25000
            ],
            [
                'barang_id' => 15,
                'kategori_id' => 3,
                'barang_kode' => 'A05',
                'barang_nama' => 'Pensil Warna',
                'harga_beli' => 25000,
                'harga_jual' => 30000
            ]
        ];
        DB::table('m_barang')->insert($data);
    }//
 }