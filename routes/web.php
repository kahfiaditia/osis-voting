<?php

use App\Http\Controllers\ClasessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KandidatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'grafik'])->name('awal');
Route::get('/grafik', [FrontendController::class, 'grafik'])->name('grafik');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/recovery', [LoginController::class, 'recovery'])->name('recovery');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::group(
    [
        'prefix'     => 'login'
    ],
    function () {
        Route::post('/proses', [LoginController::class, 'authenticate'])->name('login.proses');
    }
);

Route::group(
    [
        'middleware' => 'auth'
    ],
    function () {

        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // vote
        Route::resource('/vote', VoteController::class);
        Route::get('/confirmasi', [VoteController::class, 'confirmasi'])->name('vote.confirmasi');
        // menu
        Route::resource('/pengguna', UserController::class);
        Route::get('/halaman', [UserController::class, 'halaman'])->name('pengguna.halaman');
        Route::get('/profil', [UserController::class, 'profil'])->name('pengguna.profil');
        Route::patch('/updateprofil/{id}', [UserController::class, 'updateprofil'])->name('pengguna.updateprofil');
        Route::get('/alluser', [UserController::class, 'alluser'])->name('pengguna.alluser');
        Route::post('/upload_excel', [UserController::class, 'uploadExcel'])->name('pengguna.uploadExcel');
        Route::get('/hasil_import', [UserController::class, 'hasil_import'])->name('pengguna.hasil_import');
        Route::get('/get_data_pengguna', [UserController::class, 'get_data_pengguna'])->name('pengguna.get_data_pengguna');
        Route::get('/tambah_siswa', [UserController::class, 'tambah_siswa'])->name('pengguna.tambah_siswa');
        Route::get('/get_data_all', [UserController::class, 'get_data_all'])->name('pengguna.get_data_all');
        Route::resource('/class', ClasessController::class);
        Route::get('/data_kelas', [ClasessController::class, 'data_kelas'])->name('class.data_kelas');
        Route::resource('/periode', PeriodeController::class);
        Route::get('/data_periode', [PeriodeController::class, 'data_periode'])->name('periode.data_periode');
        Route::resource('/kandidat', KandidatController::class);
        Route::post('/get_calonketua', [KandidatController::class, 'get_calonketua'])->name('kandidat.get_calonketua');
        Route::post('/get_calonwakil', [KandidatController::class, 'get_calonwakil'])->name('kandidat.get_calonwakil');
        Route::post('/edit_get_nisketua', [KandidatController::class, 'edit_get_nisketua'])->name('kandidat.edit_get_nisketua');
        Route::post('/edit_get_niswakil', [KandidatController::class, 'edit_get_niswakil'])->name('kandidat.edit_get_niswakil');
    }
);
