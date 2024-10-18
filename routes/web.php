<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);
Route::get('/', [WelcomeController::class, 'index']);

// Route::group(['prefix' => 'user'], function(){
//     Route::get('/', [UserController::class, 'index']); //halaman awal
//     Route::post('/list', [UserController::class, 'list']);  //data user (json)
//     Route::get('/create', [UserController::class, 'create']); //form tambah user
//     Route::post('/', [UserController::class, 'store']); //data user baru
//     Route::get('/create_ajax', [UserController::class, 'create_ajax']); //menamilkan halaman tamabh user ajax
//     Route::post('/ajax', [UserController::class, 'store_ajax']); //data user baru ajax
//     Route::get('/{id}', [UserController::class, 'show']); //detail user
//     Route::get('/{id}/edit', [UserController::class, 'edit']); //form edit
//     Route::put('/{id}', [UserController::class, 'update']); // simpan perubahan data
//     Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); //form edit
//     Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // simpan perubahan data
//     Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
//     Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
//     Route::delete('/{id}', [UserController::class, 'destroy']); //hapus data user
// });

// Route::group(['prefix' => 'level'], function(){
//     Route::get('/', [LevelController::class, 'index']); //halaman awal
//     Route::post('/list', [LevelController::class, 'list']);  //data user (json)
//     Route::get('/create', [LevelController::class, 'create']); //form tambah user
//     Route::post('/', [LevelController::class, 'store']); //data user baru
//     Route::get('/create_ajax', [LevelController::class, 'create_ajax']); //menamilkan halaman tamabh user ajax
//     Route::post('/ajax', [LevelController::class, 'store_ajax']);
//     Route::get('/{id}', [LevelController::class, 'show']); //detail user
//     Route::get('/{id}/edit', [LevelController::class, 'edit']); //form edit
//     Route::put('/{id}', [LevelController::class, 'update']); // simpan perubahan data
//     Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); //form edit
//     Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // simpan perubahan data
//     Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
//     Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
//     Route::delete('/{id}', [LevelController::class, 'destroy']); //hapus data user
// });

// Route::group(['prefix' => 'kategori'], function(){
//     Route::get('/', [KategoriController::class, 'index']); //halaman awal
//     Route::post('/list', [KategoriController::class, 'list']);  //data user (json)
//     Route::get('/create', [KategoriController::class, 'create']); //form tambah user
//     Route::post('/', [KategoriController::class, 'store']); //data user baru
//     Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); //menamilkan halaman tamabh user ajax
//     Route::post('/ajax', [KategoriController::class, 'store_ajax']);
//     Route::get('/{id}', [KategoriController::class, 'show']); //detail user
//     Route::get('/{id}/edit', [KategoriController::class, 'edit']); //form edit
//     Route::put('/{id}', [KategoriController::class, 'update']); // simpan perubahan data
//     Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); //form edit
//     Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // simpan perubahan data
//     Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
//     Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
//     Route::delete('/{id}', [KategoriController::class, 'destroy']); //hapus data user
// });
// Route::group(['prefix' => 'supplier'], function(){
//     Route::get('/', [SupplierController::class, 'index']); //halaman awal
//     Route::post('/list', [SupplierController::class, 'list']);  //data user (json)
//     Route::get('/create', [SupplierController::class, 'create']); //form tambah user
//     Route::post('/', [SupplierController::class, 'store']); //data user baru
//     Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); //menamilkan halaman tamabh user ajax
//     Route::post('/ajax', [SupplierController::class, 'store_ajax']);
//     Route::get('/{id}', [SupplierController::class, 'show']); //detail user
//     Route::get('/{id}/edit', [SupplierController::class, 'edit']); //form edit
//     Route::put('/{id}', [SupplierController::class, 'update']); // simpan perubahan data
//     Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); //form edit
//     Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // simpan perubahan data
//     Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
//     Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
//     Route::delete('/{id}', [SupplierController::class, 'destroy']); //hapus data user
// });
// Route::group(['prefix' => 'barang'], function(){
//     Route::get('/', [BarangController::class, 'index']); //halaman awal
//     Route::post('/list', [BarangController::class, 'list']);  //data user (json)
//     Route::get('/create', [BarangController::class, 'create']); //form tambah user
//     Route::post('/', [BarangController::class, 'store']); //data user baru
//     Route::get('/create_ajax', [BarangController::class, 'create_ajax']); //menamilkan halaman tamabh user ajax
//     Route::post('/ajax', [BarangController::class, 'store_ajax']);
//     Route::get('/{id}', [BarangController::class, 'show']); //detail user
//     Route::get('/{id}/edit', [BarangController::class, 'edit']); //form edit
//     Route::put('/{id}', [BarangController::class, 'update']); // simpan perubahan data
//     Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); //form edit
//     Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // simpan perubahan data
//     Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
//     Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
//     Route::delete('/{id}', [BarangController::class, 'destroy']); //hapus data user
// });

Route::pattern('id','[0-9]+');// ketika ada parameter {id}, maka harus berupa angka

Route::get('register', [AuthController::class,'register'])->name('register');
Route::post('register', [AuthController::class,'postregister']);
Route::get('login', [AuthController::class,'login'])->name('login');
Route::post('login', [AuthController::class,'postlogin']);
Route::get('logout', [AuthController::class,'logout'])->middleware('auth');
    
Route::middleware(['auth'])->group(function(){ //artinya semuar route di dalam group ini harus login dulu

Route::get('/', [WelcomeController::class,'index']);
//route level

//artinya semua route di dalam group ini harus punya role ADM (Administrator)
// Route::middleware(['authorize:ADM'])->group(function(){
//     Route::get('/level',[LevelController::class,'index']);
//     Route::post('/level/list',[LevelController::class,'list']);
//     Route::get('/level/create',[LevelController::class,'create']);
//     Route::post('/level',[LevelController::class,'store']);
//     Route::get('/level/{id}/edit',[LevelController::class,'edit']);
//     Route::get('/level/{id}',[LevelController::class,'update']);
//     Route::get('/level/{id}',[LevelController::class,'destroy']);
// });

Route::middleware(['authorize:ADM,MNG'])->group(function(){
// Route::middleware(['auth', 'authorize:ADM, MNG'])->group(function () {

    // Route::get('/', [WelcomeController::class, 'index']); //halaman awal

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']); //halaman awal
        Route::post('/list', [UserController::class, 'list']);  //data user (json)
        Route::get('/create', [UserController::class, 'create']); //form tambah user
        Route::post('/', [UserController::class, 'store']); //data user baru
        Route::get('/create_ajax', [UserController::class, 'create_ajax']); //form tambah user ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']); //simpan data user baru ajax
        Route::get('/{id}', [UserController::class, 'show']); //detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']); //form edit
        Route::put('/{id}', [UserController::class, 'update']); // simpan perubahan data
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); //tampilkan form edit dengan ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); //simpan perubahan user ajax
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); //confirm delete ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); //hapus ajax
        Route::delete('/{id}', [UserController::class, 'destroy']); //hapus data user
    });
    Route::group(['prefix' => 'level'], function () {
        Route::get('/', [LevelController::class, 'index']); //halaman awal
        Route::post('/list', [LevelController::class, 'list']);  //data user (json)
        Route::get('/create', [LevelController::class, 'create']); //form tambah user
        Route::post('/', [LevelController::class, 'store']); //data user baru
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']); //form tambah user ajax
        Route::post('/ajax', [LevelController::class, 'store_ajax']); //simpan data user baru ajax
        Route::get('/{id}', [LevelController::class, 'show']); //detail user
        Route::get('/{id}/edit', [LevelController::class, 'edit']); //form edit
        Route::put('/{id}', [LevelController::class, 'update']); // simpan perubahan data
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); //tampilkan form edit dengan ajax
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); //simpan perubahan user ajax
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); //confirm delete ajax
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); //hapus ajax
        Route::delete('/{id}', [LevelController::class, 'destroy']); //hapus data user
    });
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']); //halaman awal
        Route::post('/list', [KategoriController::class, 'list']);  //data user (json)
        Route::get('/create', [KategoriController::class, 'create']); //form tambah user
        Route::post('/', [KategoriController::class, 'store']); //data user baru
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); //form tambah user ajax
        Route::post('/ajax', [KategoriController::class, 'store_ajax']); //simpan data user baru ajax
        Route::get('/{id}', [KategoriController::class, 'show']); //detail user
        Route::get('/{id}/edit', [KategoriController::class, 'edit']); //form edit
        Route::put('/{id}', [KategoriController::class, 'update']); // simpan perubahan data
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); //tampilkan form edit dengan ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); //simpan perubahan user ajax
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); //confirm delete ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); //hapus ajax
        Route::delete('/{id}', [KategoriController::class, 'destroy']); //hapus data user
    });
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/', [SupplierController::class, 'index']); //halaman awal
        Route::post('/list', [SupplierController::class, 'list']);  //data user (json)
        Route::get('/create', [SupplierController::class, 'create']); //form tambah user
        Route::post('/', [SupplierController::class, 'store']); //data user baru
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); //form tambah user ajax
        Route::post('/ajax', [SupplierController::class, 'store_ajax']); //simpan data user baru ajax
        Route::get('/{id}', [SupplierController::class, 'show']); //detail user
        Route::get('/{id}/edit', [SupplierController::class, 'edit']); //form edit
        Route::put('/{id}', [SupplierController::class, 'update']); // simpan perubahan data
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); //tampilkan form edit dengan ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); //simpan perubahan user ajax
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); //confirm delete ajax
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); //hapus ajax
        Route::delete('/{id}', [SupplierController::class, 'destroy']); //hapus data user
    });
    Route::group(['prefix' => 'barang'], function () {
        Route::get('/', [BarangController::class, 'index']); //halaman awal
        Route::post('/list', [BarangController::class, 'list']);  //data user (json)
        Route::get('/create', [BarangController::class, 'create']); //form tambah user
        Route::post('/', [BarangController::class, 'store']); //data user baru
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']); //form tambah user ajax
        Route::post('/ajax', [BarangController::class, 'store_ajax']); //simpan data user baru ajax
        Route::get('/{id}', [BarangController::class, 'show']); //detail user
        Route::get('/{id}/edit', [BarangController::class, 'edit']); //form edit
        Route::put('/{id}', [BarangController::class, 'update']); // simpan perubahan data
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); //tampilkan form edit dengan ajax
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); //simpan perubahan user ajax
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); //confirm delete ajax
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); //hapus ajax
        Route::delete('/{id}', [BarangController::class, 'destroy']); //hapus data user
        Route::get('/import', [BarangController::class, 'import']); //uppload excel
        Route::post('/import_ajax', [BarangController::class, 'import_ajax']); //ajax import excel
    });
});


Route::middleware(['authorize:STF'])->group(function(){
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']); //halaman awal
        Route::post('/list', [KategoriController::class, 'list']);  //data user (json)
        Route::get('/create', [KategoriController::class, 'create']); //form tambah user
        Route::post('/', [KategoriController::class, 'store']); //data user baru
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); //form tambah user ajax
        Route::post('/ajax', [KategoriController::class, 'store_ajax']); //simpan data user baru ajax
        Route::get('/{id}', [KategoriController::class, 'show']); //detail user
        Route::get('/{id}/edit', [KategoriController::class, 'edit']); //form edit
        Route::put('/{id}', [KategoriController::class, 'update']); // simpan perubahan data
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); //tampilkan form edit dengan ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); //simpan perubahan user ajax
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); //confirm delete ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); //hapus ajax
        Route::delete('/{id}', [KategoriController::class, 'destroy']); //hapus data user
    });
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/', [SupplierController::class, 'index']); //halaman awal
        Route::post('/list', [SupplierController::class, 'list']);  //data user (json)
        Route::get('/create', [SupplierController::class, 'create']); //form tambah user
        Route::post('/', [SupplierController::class, 'store']); //data user baru
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); //form tambah user ajax
        Route::post('/ajax', [SupplierController::class, 'store_ajax']); //simpan data user baru ajax
        Route::get('/{id}', [SupplierController::class, 'show']); //detail user
        Route::get('/{id}/edit', [SupplierController::class, 'edit']); //form edit
        Route::put('/{id}', [SupplierController::class, 'update']); // simpan perubahan data
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); //tampilkan form edit dengan ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); //simpan perubahan user ajax
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); //confirm delete ajax
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); //hapus ajax
        Route::delete('/{id}', [SupplierController::class, 'destroy']); //hapus data user
    });
    Route::group(['prefix' => 'barang'], function () {
        Route::get('/', [BarangController::class, 'index']); //halaman awal
        Route::post('/list', [BarangController::class, 'list']);  //data user (json)
        Route::get('/create', [BarangController::class, 'create']); //form tambah user
        Route::post('/', [BarangController::class, 'store']); //data user baru
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']); //form tambah user ajax
        Route::post('/ajax', [BarangController::class, 'store_ajax']); //simpan data user baru ajax
        Route::get('/{id}', [BarangController::class, 'show']); //detail user
        Route::get('/{id}/edit', [BarangController::class, 'edit']); //form edit
        Route::put('/{id}', [BarangController::class, 'update']); // simpan perubahan data
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); //tampilkan form edit dengan ajax
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); //simpan perubahan user ajax
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); //confirm delete ajax
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); //hapus ajax
        Route::delete('/{id}', [BarangController::class, 'destroy']); //hapus data user
        Route::get('/import', [BarangController::class, 'import']); //uppload excel
        Route::post('/import_ajax', [BarangController::class, 'import_ajax']); //ajax import excel
        Route::post('/', [BarangController::class, 'import_ajax']); //ajax import excel
        Route::get('/export_excel', [BarangController::class, 'export_excel']); //export excel
    });
});


});

