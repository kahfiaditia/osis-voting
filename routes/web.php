<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VoteController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [FrontendController::class, 'grafik'])->name('awal');
Route::get('/grafik', [FrontendController::class, 'grafik'])->name('grafik');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/recovery', [LoginController::class, 'recovery'])->name('recovery');

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
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('/vote', VoteController::class);

        // // menu
        // Route::resource('/menu', MenuController::class);
        // Route::resource('/submenu', SubMenuController::class);
    }
);
