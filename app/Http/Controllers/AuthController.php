<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;

class AuthController extends Controller
{
   
    public function register()
    {
        return view('auth.register');
    }

    public function postregister(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $request->validate([
                'username' => 'required|string|min:3|unique:m_user,username',
                'name' => 'required|string|max:100',
                'password' => 'required|min:5',
            ]);
            UserModel::create([
                'username' => $request->username,
                'nama' => $request->name,
                'password' => bcrypt($request->password),
                'level_id' => 3
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Register Berhasil',
                'redirect' => url('/login')
            ]);
        }
        return redirect('register');
    }

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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
