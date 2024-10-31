<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanModel;
use App\Models\SupplierModel;
use App\Models\PenjualanDetailModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
        'title' => 'Selamat Datang',
        'list' => ['Home', 'Welcome']
        ];
        

        $activeMenu = 'dashboard';

        $totalUser = UserModel::count();
        $totalBarang = BarangModel::count();
        $totalSupplier = SupplierModel::count();
        $totalStok = StokModel::count();
        $totalPenjualan = PenjualanModel::count();
        $totalDetailPenjualan = PenjualanDetailModel::count();
        $totalStokDetail = StokModel::sum('stok_jumlah');


        return view('welcome', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'totalUser' => $totalUser, 'totalBarang' => $totalBarang, 'totalSupplier' => $totalSupplier, 'totalPenjualan' => $totalPenjualan, 'totalDetailPenjualan' => $totalDetailPenjualan, 'totalStok' => $totalStok, 'totalStokDetail' => $totalStokDetail ]);
    }
}