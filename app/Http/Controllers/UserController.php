<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        //tambah data
        // $data=[
        //     'username' => 'customer 1',
        //     'nama' => 'pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 5
        // ];
        // UserModel::insert($data);

        //tambah data dengan Eloquent
        $data = [
            'nama' => 'Pelanggan pertama',
        ];
        UserModel::where('username', 'customer 1')->update($data); //update data user

        // coba akses model UserModel
        $user = UserModel::all(); //ambil semua data m_user
        return view('user', ['data' => $user]);
    }
}