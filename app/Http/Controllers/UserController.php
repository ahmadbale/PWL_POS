<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
    $breadcrumb = (object)[
        'title' => 'Daftar User',
        'list' => ['Home', 'User']
    ];

    $page = (object)[
        'title' => 'Daftar user yang terdaftar dalam sistem'
    ];

    $activeMenu = 'user'; //set menu yang sedang aktif

    $level = LevelModel::all();// ambil data level untuk filter level

    return view('user.index',['breadcrumb'=>$breadcrumb, 'page' => $page,'level' => $level, 'activeMenu'=>$activeMenu]);
    }
    // Ambil data user dalam bentuk json untuk datables
    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        //Filter data user berdasarkan level_id
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {  // menambahkan kolom aksi 
                // $btn  = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
                //     . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                // return $btn;
                $btn  = '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> '; 
                $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> '; 
                $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/delete_ajax').'\')"  class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn; 
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
            ->make(true);
    }

  


    //Menampilkan halaman form tambah user
    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah user baru'
        ];
        $level = LevelModel::all(); //ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; //set menu yang sedang aktif
        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }
    //Menyimpan data user baru
    public function store(Request $request){
        $request -> validate([
            //username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100', //nama harus diisi, berupa string, dan maksimal 100 karakter
            'password' => 'required|min:5', //pasword harus diisi dan minimal 5 karakter
            'level_id' => 'required|integer'// level_id harus diisi dan berupa angka
        ]);
        UserModel::create([
            'username' => $request->username,
            'nama' => $request -> nama,
            'password' => bcrypt($request->password), //passwird dienkripsi sebelum disimpan
            'level_id' => $request->level_id
        ]);
        return redirect('/user') -> with('success', 'Data user berhasil disimpan');
    }
    //Menampilkan detail user
    public function show(String $id){
        $user = UserModel::with('level') -> find($id);
        $breadcrumb = (object)[
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail user'
        ];
        $activeMenu = 'user'; //set menu yang sedang aktif
        return view('user.show', ['breadcrumb' => $breadcrumb, 'page'=>$page, 'user'=>$user, 'activeMenu'=>$activeMenu]);
    }
    //Menampilkan halaman form edit user
    public function edit(string $id){
        $user = UserModel::find($id);
        $level = LevelModel::all();
        $breadcrumb = (object)[
            'title' => 'Edit user',
            'list' => ['Home', 'User', 'Edit']
        ];
        $page = (object)[
            'title' => 'Edit User'
        ];
        $activeMenu = 'user';
        return view ('user.edit', ['breadcrumb'=>$breadcrumb, 'page'=>$page, 'user'=>$user, 'level'=>$level, 'activeMenu'=>$activeMenu]);
    }


    //Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:5',
            'level_id' => 'required|integer'
        ]);
        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id
        ]);
        return redirect('/user')->with('success' . "data user berhasil diubah");
    }

    //Mengapus data user
    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error','Data user tidak ditemukan');
        }

        try{
            userModel::destroy($id);

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect('/user')->with('error','Data yser gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}

    public function create_ajax(){
        $level = levelModel::select('level_id', 'level_nama')->get();

        return view('user.create_ajax')
            ->with('level', $level);
    }

    Public function store_ajax(Request $request){
        // cek apakah request brua ajax
        if($request->ajax()||$request->wantsJson()){
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:6'
            ];
        // use Illuminate\Support\Facades\Validator;
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'msgField' => $validator->errors(),
            ]);
        }

        UserModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function edit_ajax(string $id){
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama') -> get();

        return view('user.edit_ajax', ['user' => $user, 'level' => $level]);
    }

    Public function update_ajax(Request $request, $id){ 
        // cek apakah request dari ajax 
        // dd('sdgjasd');
        if ($request->ajax()|| $request->wantsJson()) { 

            $rules = [ 
                'level_id' => 'required|integer', 
                'username' => 'required|max:20|unique:m_user,username,'.$id.',user_id', 
                'nama'     => 'required|max:100', 
                'password' => 'nullable|min:6|max:20' 
            ]; 
            $validator = Validator::make($request->all(), $rules); 
 
            if ($validator->fails()) { 
                return response()->json([ 
                    'status'   => false,    
                    'message'  => 'Validasi gagal.', 
                    'msgField' => $validator->errors()  
                ]); 
            } 
     
            $check = UserModel::find($id); 
            if ($check) { 
                if(!$request->filled('password') ){  
                    $request->request->remove('password'); 
                } 
                 
                $check->update($request->all()); 
                return response()->json([ 
                    'status'  => true, 
                    'message' => 'Data berhasil diupdate' 
                ]); 
            } else{ 
                return response()->json([ 
                    'status'  => false, 
                    'message' => 'Data tidak ditemukan' 
                ]); 
            } 
        } 
        return redirect('/'); 
    } 

    public function confirm_ajax(string $id){
        $user = UserModel::find($id);

        return view('user.confirm_ajax', ['user' => $user]);
    }

    public function delete_ajax(Request $request, $id){
        if($request -> ajax() || $request -> wantsJson()){
            $user = UserModel::find($id);
            if($user){
                $user -> delete();
                return response() -> json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response() -> json([
                    'status' => false,
                    'message' => 'data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}
        //tambah data
        // $data=[
        //     'username' => 'customer 1',
        //     'nama' => 'pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 5
        // ];
        // UserModel::insert($data);

        // $data =[
        //     'level_id' => 2,
        //     'username' => 'manager_dua',
        //     'nama' => 'Manager 2',
        //     'password' => Hash::make('12345')
        // ];

        // $data =[
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];

        // UserModel::create($data);
        //tambah data dengan Eloquent
        // $data = [
        //     'nama' => 'Pelanggan pertama',
        // ];
        // UserModel::where('username', 'customer 1')->update($data); //update data user

        // coba akses model UserModel
        // $user = UserModel::all(); //ambil semua data m_user
        
        // $user = UserModel::find(1);

        // $user = UserModel::where('level_id', 1)->first();

        // $user = UserModel::firstWhere('level_id',1);

        // $user = UserModel::findOr(1,['username', 'nama'], function (){
        
        // $user = UserModel::findOr(20,['username', 'nama'], function (){
        // abort(404);
        // });

        // $user = UserModel::findOrFail(1);

        // $user = UserModel::where('username', 'manager9')->firstOrFail();
        // $userCount = UserModel::where('level_id', 2)->count();
        // // dd($user);
        // return view('user', ['userCount' => $userCount]);


        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager',
        //     ],
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user->save();

        // return view('user', ['data' => $user]);

        // $user = UserModel::create([
        //     'username' => 'manager55',
        //     'nama' => 'Manager55',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2,
        // ]);
        
        // $user->username = 'manager56';

        // $user->isDirty();//true
        // $user->isDirty('username');//true
        // $user->isDirty('nama');//false
        // $user->isDirty(['nama','username']);//true

        // $user->isClean();//false
        // $user->isClean('username');//false
        // $user->isClean('nama');//true
        // $user->isClean(['nama','username']);

        // $user->save();

        // $user->isDirty();//false
        // $user->isClean();//true
        // dd($user->isDirty());

        
        // $user = UserModel::create([
        //         'username' => 'manager55',
        //         'nama' => 'Manager55',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2,
        //     ]);

        // $user->save();

        // $user->wasChanged();//true
        // $user->wasChanged('username');//true
        // $user->wasChanged(['username', 'level_id']);//true
        // $user->wasChanged('nama');//false
        // dd($user->wasChanged(['nama','username']));//true

    //     $user = UserModel::all();
    //     return view('user', ['data' => $user]);
    // }

    // public function tambah()
    // {
    //     return view('user_tambah');
    // }

    // public function tambah_simpan(Request $request)
    // {
    //     UserModel::create([
    //         'username' => $request->username,
    //         'nama' => $request->nama,
    //         'password' => Hash::make('$request->password'),
    //         'level_id' => $request->level_id
    //     ]);

    //     return redirect('/user');
    // }

    // public function ubah($id)
    // {
    //     $user = UserModel::find($id);
    //     return view('user_ubah', ['data' => $user]);
    // }

    // public function ubah_simpan($id, Request $request)
    // {
    //     $user = UserModel::find($id);

    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     $user->password = Hash::make('$request->password');
    //     $user->level_id = $request->level_id;

    //     $user->save();
    //     return redirect('/user');
    // }

    // public function hapus($id)
    // {
    //     $user = UserModel::find($id);
    //     $user->delete();

    //     return redirect('/user');
    // }

    // {
    //     $user = UserModel::with('level')->get();
    //     // dd($user);
    //     return view('user',['data'=>$user]);
    // }
