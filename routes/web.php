<?php

 use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Home\HomeController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Data\WilayahController;
use App\Http\Controllers\Web\Master\AlamatController;
use App\Http\Controllers\Web\Master\ProdukController;
use App\Http\Controllers\Web\Master\KategoriController;
use App\Http\Controllers\Web\Pengaturan\UserController;
use App\Http\Controllers\Web\Master\PelangganController;
use App\Http\Controllers\Web\Penjualan\PemesananDoController;
use App\Http\Controllers\Web\Pengaturan\PengaturanAplikasiController;
use App\Http\Controllers\Web\Penjualan\ExpedisiController;

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

    Route::prefix('master')->group(function () {
        Route::resource('produk', ProdukController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('alamat', AlamatController::class);
        Route::resource('pelanggan', PelangganController::class);
    });

    Route::prefix('penjualan')->group(function () {
        Route::post('do/ajukan', [PemesananDoController::class, 'ajukan']);
        Route::post('do/{id}/update', [PemesananDoController::class, 'update']);
        Route::resource('do', PemesananDoController::class);
        Route::post('getrate', [ExpedisiController::class, 'getRates']);
    });

    Route::prefix('data')->group(function () {
        Route::get('list_wilayah', [WilayahController::class, 'listWilayah']);
    });

    Route::prefix('pengaturan')->group(function () {
        Route::get('aplikasi', [PengaturanAplikasiController::class, 'index'])->name('pengaturanaplikasi');
        Route::put('aplikasi', [PengaturanAplikasiController::class, 'update']);
        Route::resource('pengguna', UserController::class);
    });
});
