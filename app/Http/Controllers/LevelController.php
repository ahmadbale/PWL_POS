<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelModel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];
    
        $page = (object)[
            'title' => 'Daftar Level yang terdaftar dalam sistem'
        ];
    
        $activeMenu = 'level'; //set menu yang sedang aktif

        $level = LevelModel::all();// ambil data level untuk filter level
    
        return view('level.index',['breadcrumb'=>$breadcrumb, 'page' => $page,'level' => $level, 'activeMenu'=>$activeMenu]);
        }

     //Ambil data user dalam bentuk json untuk datables
     public function list(Request $request)
     {
         $levels = LevelModel::all();
 
         return DataTables::of($levels)
             // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
             ->addIndexColumn()
             ->addColumn('aksi', function ($level) {  // menambahkan kolom aksi 
                 $btn  = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                 $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                 $btn .= '<form class="d-inline-block" method="POST" action="' .
                     url('/level/' . $level->level_id) . '">'
                     . csrf_field() . method_field('DELETE') .
                     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                 return $btn;
             })
             ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
             ->make(true);
     }
 
 
     //Menampilkan halaman form tambah user
     public function create(){
         $breadcrumb = (object)[
             'title' => 'Tambah Level',
             'list' => ['Home', 'Level', 'Tambah']
         ];
         $page = (object)[
             'title' => 'Tambah level baru'
         ];
         $level = LevelModel::all(); //ambil data level untuk ditampilkan di form
         $activeMenu = 'level'; //set menu yang sedang aktif
         return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
     }
     //Menyimpan data user baru
     public function store(Request $request){
         $request -> validate([
             //username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
             'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
             'level_nama' => 'required|string|max:100', //level_nama harus diisi, berupa string, dan maksimal 100 karakter
         ]);
         LevelModel::create([
             'level_kode' => $request->level_kode,
             'level_nama' => $request -> level_nama,
         
         ]);
         return redirect('/level') -> with('success', 'Data level berhasil disimpan');
     }
     //Menampilkan detail user
     public function show(String $id){
         $level = LevelModel::find($id);
         $breadcrumb = (object)[
             'title' => 'Detail Level',
             'list' => ['Home', 'Level', 'Detail']
         ];
         $page = (object)[
             'title' => 'Detail level'
         ];
         $activeMenu = 'level'; //set menu yang sedang aktif
         return view('level.show', ['breadcrumb' => $breadcrumb, 'page'=>$page, 'level'=>$level, 'activeMenu'=>$activeMenu]);
     }
     //Menampilkan halaman form edit user
     public function edit(string $id){
         $level = LevelModel::find($id);
         $breadcrumb = (object)[
             'title' => 'Edit Level',
             'list' => ['Home', 'Level', 'Edit']
         ];
         $page = (object)[
             'title' => 'Edit Level'
         ];
         $activeMenu = 'level';
         return view ('level.edit', ['breadcrumb'=>$breadcrumb, 'page'=>$page, 'level'=>$level, 'level'=>$level, 'activeMenu'=>$activeMenu]);
     }
 
     //Menyimpan perubahan data user
     public function update(Request $request, string $id)
     {
         $request->validate([
            'level_kode' => 'required|string|min:3|max:10|unique:m_level,level_kode,' . $id .',level_id',
            'level_nama' => 'required|string|max:100',
         ]);
         LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
                  ]);
         return redirect('/level') -> with('success' , 'Data level berhasil diubah');
     }
 
     //Mengapus data user
     public function destroy(string $id)
     {
         $check = LevelModel::find($id);
         if (!$check) {
             return redirect('/level')->with('error','Data level tidak ditemukan');
         }
 
         try{
             levelModel::destroy($id);
 
             return redirect('/level')->with('success', 'Data level berhasil dihapus');
         } catch (\Illuminate\Database\QueryException $e) {
 
             return redirect('/level')->with('error','Data yser gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
     }
 }

    //Insert
    // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?,?,?)',['CUS', 'Pelanggan', now()]);
    // return 'Insert data baru berhasil';
    // }

        //update
        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' .$row. 'baris';

        // delete
        // $row=DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return 'Delete data berhasil. Jumlah data yang dihapus: '. $row . ' baris';

        // view
        // $data = DB::select('select * from m_level');
        // return view('level', ['data' => $data]);
}
