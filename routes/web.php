<?php

use App\Http\Controllers\ClasessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\JadwalExtraController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\KandidatsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPembinaController;

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
        Route::get('/data_voters', [VoteController::class, 'data_voters'])->name('vote.data_voters');
        // menu
        Route::resource('/pengguna', UserController::class);
        Route::get('/halaman', [UserController::class, 'halaman'])->name('pengguna.halaman');
        Route::get('/halaman_guru', [UserController::class, 'halaman_guru'])->name('pengguna.halaman_guru');
        Route::get('/profil', [UserController::class, 'profil'])->name('pengguna.profil');
        Route::patch('/updateprofil/{id}', [UserController::class, 'updateprofil'])->name('pengguna.updateprofil');
        Route::get('/alluser', [UserController::class, 'alluser'])->name('pengguna.alluser');
        Route::get('/data_guru', [UserController::class, 'data_guru'])->name('pengguna.data_guru');
        Route::get('/admin', [UserController::class, 'admin'])->name('pengguna.admin');
        Route::post('/upload_excel', [UserController::class, 'uploadExcel'])->name('pengguna.uploadExcel');
        Route::get('/hasil_import', [UserController::class, 'hasil_import'])->name('pengguna.hasil_import');
        Route::get('/gagal_import', [UserController::class, 'gagal_import'])->name('pengguna.gagal_import');
        Route::get('/hapus_semua', [UserController::class, 'hapus_semua'])->name('pengguna.hapus_semua');
        Route::get('/hapus_semua_guru', [UserController::class, 'hapus_semua_guru'])->name('pengguna.hapus_semua_guru');
        Route::post('/simpan_user_ajax', [UserController::class, 'simpanUserAjax'])->name('pengguna.simpanUserAjax');
        Route::get('/get_data_siswa', [UserController::class, 'get_data_siswa'])->name('pengguna.get_data_siswa');
        Route::get('/get_data_guru', [UserController::class, 'get_data_guru'])->name('pengguna.get_data_guru');
        Route::get('/guru/{id}/edit', [UserController::class, 'edit_guru'])->name('pengguna.edit_guru');
        Route::get('/get_data_administrator', [UserController::class, 'get_data_administrator'])->name('pengguna.get_data_administrator');
        Route::get('/cari_data_all', [UserController::class, 'cari_data_all'])->name('pengguna.cari_data_all');
        Route::get('/tambah_siswa', [UserController::class, 'tambah_siswa'])->name('pengguna.tambah_siswa');
        Route::get('/tambah_administrator', [UserController::class, 'tambah_administrator'])->name('pengguna.tambah_administrator');
        Route::get('/siswa/{id}/edit', [UserController::class, 'edit_siswa'])->name('pengguna.edit_siswa');
        Route::get('/admin/{id}/edit', [UserController::class, 'edit_admin'])->name('pengguna.edit_admin');
        Route::patch('/update_edit_siswa', [UserController::class, 'update_edit_siswa'])->name('pengguna.update_edit_siswa');
        Route::post('/reset_password/{id}', [UserController::class, 'reset_password'])->name('pengguna.reset_password');

        //list_user_all//
        Route::get('/get_list_user_siswa', [UserController::class, 'get_list_user_siswa'])->name('pengguna.get_list_user_siswa');
        Route::get('/get_list_user_guru', [UserController::class, 'get_list_user_guru'])->name('pengguna.get_list_user_guru');
        Route::get('/get_list_user_administrator', [UserController::class, 'get_list_user_administrator'])->name('pengguna.get_list_user_administrator');
        Route::get('/data-guru', [UserController::class, 'listDataGuru'])->name('list_data_guru');
        Route::get('/data-administrator', [UserController::class, 'listDataAdministrator'])->name('list_data_administrator');
        Route::get('/siswa-list_user/{id}/edit', [UserController::class, 'edit_siswa_list_user'])->name('pengguna.edit_siswa_list_user');
        Route::patch('/pengguna/update-siswa-listuser/{id}', [UserController::class, 'updateSiswa'])->name('pengguna.update_siswa_listuser');
        Route::get('/tambah_siswa_listuser', [UserController::class, 'tambah_siswa_listuser'])->name('pengguna.tambah_siswa_listuser');
        Route::post('/pengguna/storelistuser', [UserController::class, 'storeListUser'])->name('pengguna.storelistuser');
        Route::get('/guru-list_user/{id}/edit', [UserController::class, 'edit_guru_list_user'])->name('pengguna.edit_guru_list_user');
        Route::patch('/pengguna/update-guru-listuser/{id}', [UserController::class, 'updateGuru'])->name('pengguna.update_guru_listuser');
        Route::get('/tambah_guru_listuser', [UserController::class, 'tambah_guru_listuser'])->name('pengguna.tambah_guru_listuser');
        Route::post('/pengguna/storelistguru', [UserController::class, 'storelistguru'])->name('pengguna.storelistguru');

        Route::get('/admin-list_user/{id}/edit', [UserController::class, 'edit_admin_list_user'])->name('pengguna.edit_admin_list_user');
        Route::patch('/pengguna/update-admin-listuser/{id}', [UserController::class, 'updateAdmin'])->name('pengguna.update_admin_listuser');
        Route::get('/tambah_admin_listuser', [UserController::class, 'tambah_admin_listuser'])->name('pengguna.tambah_admin_listuser');
        Route::post('/pengguna/storelistadmin', [UserController::class, 'storelistadmin'])->name('pengguna.storelistadmin');
        //list_user_all//

        Route::resource('/class', ClasessController::class);
        Route::get('/data_kelas', [ClasessController::class, 'data_kelas'])->name('class.data_kelas');
        Route::resource('/periode', PeriodeController::class);
        Route::get('/data_periode', [PeriodeController::class, 'data_periode'])->name('periode.data_periode');
        Route::resource('/kandidats', KandidatsController::class);
        Route::resource('/kandidat', KandidatController::class);
        Route::get('/data_kandidat', [KandidatController::class, 'data_kandidat'])->name('kandidat.data_kandidat');
        Route::post('/get_calonketua', [KandidatController::class, 'get_calonketua'])->name('kandidat.get_calonketua');
        Route::post('/get_calonwakil', [KandidatController::class, 'get_calonwakil'])->name('kandidat.get_calonwakil');
        Route::post('/edit_get_nisketua', [KandidatController::class, 'edit_get_nisketua'])->name('kandidat.edit_get_nisketua');
        Route::post('/edit_get_niswakil', [KandidatController::class, 'edit_get_niswakil'])->name('kandidat.edit_get_niswakil');
        Route::get('/download-template', [UserController::class, 'template'])->name('template');
        Route::get('/download-guru', [UserController::class, 'template_guru'])->name('template_guru');

        Route::resource('/kegiatan', ExtraController::class);
        Route::resource('/pembina', PembinaController::class);
        Route::get('/get_data_pembina', [PembinaController::class, 'get_data_pembina'])->name('pembina.get_data_pembina');
        Route::resource('/pembina_list', UserPembinaController::class);
        Route::get('/get_list_user_pembina', [UserPembinaController::class, 'get_list_user_pembina'])->name('pembina_list.get_list_user_pembina');
        Route::post('/reset_password_pembina/{id}', [UserPembinaController::class, 'reset_password_pembina'])->name('pembina_list.reset_password_pembina');
        Route::resource('/jadwal', JadwalExtraController::class);
        Route::post('/cari_pembina', [JadwalExtraController::class, 'cari_pembina'])->name('jadwal.cari_pembina');
        Route::post('/cari_hari', [JadwalExtraController::class, 'cari_hari'])->name('jadwal.cari_hari');
        Route::get('/get_hari', [JadwalExtraController::class, 'getHari'])->name('jadwal.get_hari');
        Route::post('/simpan_data', [JadwalExtraController::class, 'simpan_data'])->name('jadwal.simpan_data');
        Route::get('/data_list_jadwal', [JadwalExtraController::class, 'data_list_jadwal'])->name('jadwal.data_list_jadwal');
    }
);
