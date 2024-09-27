<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;

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

Route::group(['prefix' => 'user'], function(){
    Route::get('/', [UserController::class, 'index']); //halaman awal
    Route::post('/list', [UserController::class, 'list']);  //data user (json)
    Route::get('/create', [UserController::class, 'create']); //form tambah user
    Route::post('/', [UserController::class, 'store']); //data user baru
    Route::get('/{id}', [UserController::class, 'show']); //detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); //form edit
    Route::put('/{id}', [UserController::class, 'update']); // simpan perubahan data
    Route::delete('/{id}', [UserController::class, 'destroy']); //hapus data user
});

