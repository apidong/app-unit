<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Home\HomeController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Pengaturan\UserController;
use App\Http\Controllers\Web\Pengaturan\PengaturanAplikasiController;

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


Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


Route::middleware('auth')->group(function () {
    Route::prefix('home')->group(function () {
        Route::get('/', [HomeController::class, 'index']);
    });

    Route::prefix('pengaturan')->group(function () {
        Route::get('aplikasi', [PengaturanAplikasiController::class, 'index'])->name('pengaturanaplikasi');
        Route::put('aplikasi', [PengaturanAplikasiController::class, 'update']);
        Route::resource('pengguna', UserController::class);
    });
});
