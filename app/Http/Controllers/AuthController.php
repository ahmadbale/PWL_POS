<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()){
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if($request->ajax() || $request->wantsJson()){
            $credentials = $request->only('username','password');

            if(Auth::attempt($credentials)){
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }

        return redirect('login');
    }



    public function register()
    {
        return view('auth.register');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function postregister(Request $request)
{
    if ($request->ajax() || $request->wantsJson()) {
        // Cek apakah username sudah ada di database
        $existingUser = UserModel::where('username', $request->username)->first();
        
        if ($existingUser) {
            return response()->json([
                'status' => false,
                'message' => 'Username sudah terpakai, silakan coba yang lain!',
                'redirect' => url('/register')
            ]);
        }

        // Lakukan validasi input form
        $validator = \Validator::make($request->all(), [
            'username' => 'required|string|min:3|unique:m_user,username',
            'name' => 'required|string|max:100',
            'password' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Ada kesalahan dalam input data. Coba lagi!',
                'msgField' => $validator->errors(),
                'redirect' => url('/register')
            ]);
        }

        // Buat user baru
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->name,
            'password' => bcrypt($request->password),
            'level_id' => 3
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Register berhasil',
            'redirect' => url('/login')
        ]);

    }
    return redirect('register');
}


   
   
   
}
