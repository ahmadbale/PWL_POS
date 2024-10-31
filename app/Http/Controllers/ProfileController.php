<?php
namespace App\Http\Controllers;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    public function index()
    {
        $user = UserModel::findOrFail(Auth::id());
        $breadcrumb = (object) [
            'title' => 'Data Profil',
            'list' => [
                ['name' => 'Home', 'url' => url('/')],
                ['name' => 'Profil', 'url' => url('/profile')]
            ]
        ];
        $activeMenu = 'profile';
        return view('profile', compact('user'), [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
   
    public function update(Request $request, $id)
    {
        // Validasi input
        request()->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama'     => 'required|string|max:100',
            'old_password' => 'nullable|string',
            'password' => 'nullable|min:5',
            'profile_image' => 'nullable|image|max:2048' // Validasi jika gambar diunggah
        ]);
    
        // Temukan user berdasarkan ID
        $user = UserModel::find($id);
    
        // Update username dan nama
        $user->username = $request->username;
        $user->nama = $request->nama;
    
        // Jika field password lama diisi, maka periksa validitasnya dan update password
        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                // Jika password baru juga diisi, lakukan update
                if ($request->filled('password')) {
                    $user->password = Hash::make($request->password);
                }
            } else {
                return back()
                    ->withErrors(['old_password' => __('Please enter the correct password')])
                    ->withInput();
            }
        }
    
        // Jika ada file profil image diunggah, maka proses gambar tersebut
        if ($request->hasFile('profile_image')) {
            // Hapus gambar lama jika ada
            if ($user->profile_image && file_exists(storage_path('app/public/photos/' . $user->profile_image))) {
                Storage::delete('app/public/photos/' . $user->profile_image);
            }
    
            // Simpan gambar baru
            $file = $request->file('profile_image');
            $fileName = $file->hashName(); // Hash name sudah menyertakan ekstensi
            $request->profile_image->move(storage_path('app/public/photos'), $fileName);
            $user->profile_image = $fileName;
        }
    
        // Simpan perubahan user
        $user->save();
    
        // Kembalikan dengan status sukses
        return back()->with('status', 'Profile berhasil diperbarui');
    }
    

    
}