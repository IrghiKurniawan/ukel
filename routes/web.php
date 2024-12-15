<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengaduanController;

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

Route::get('/', function () {
    return view('landing_page');
});



Route::get('/landing-page', [UserController::class, 'tampilLanding'])->name('landing_page');
Route::get('/login', [UserController::class, 'tampil'])->name('login');
Route::post('/login', [UserController::class, 'loginProses'])->name('login.proses');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Rute untuk menampilkan artikel
Route::get('/artikel', [PengaduanController::class, 'index'])->name('report.artikel');

// Rute untuk menampilkan formulir pembuatan laporan
Route::get('/artikel/create', [PengaduanController::class, 'create'])->name('report.create_report');

// Rute untuk menyimpan laporan baru (gunakan POST, bukan GET)
Route::post('/artikel/store', [PengaduanController::class, 'store'])->name('report.store');
Route::get('/report/show', [PengaduanController::class, 'show'])->name('report.show');



Route::prefix('/kelola_akun')->name('kelola_akun.')->group(function () {
    Route::get('/data', [UserController::class, 'index'])->name('data');
    Route::get('/tambah', [UserController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [UserController::class, 'store'])->name('tambah.proses');
    Route::get('/ubah/{id}', [UserController::class, 'edit'])->name('ubah');
    Route::patch('/ubah/{id}/proses', [UserController::class, 'update'])->name('ubah.proses');
    Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('hapus');
    Route::get('/kelola-akun/tambah', [UserController::class, 'tambah'])->name('kel_akun.tambah');
    Route::post('/kelola-akun/simpan', [UserController::class, 'simpan'])->name('kel_akun.simpan');
});

