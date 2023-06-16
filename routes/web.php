<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\master\ObatController;
use App\Http\Controllers\master\JenisLayananController;
use App\Http\Controllers\master\KepalaPuskesmasController;
use App\Http\Controllers\master\KaryawanController;
use App\Http\Controllers\master\PasienBayiController;
use App\Http\Controllers\master\SuamiPasienDewasaController;
use App\Http\Controllers\master\PasienDewasaController;

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

Route::get('/', function () {
    return view('welcome');
});

// Bayi
Route::resource('/pasien-bayi', PasienBayiController::class);
// Dewasa
Route::resource('/pasien-dewasa', PasienDewasaController::class);
Route::get('/pasien-dewasa/cetak-kartu/{id}', [PasienDewasaController::class,'cetakKartu'])->name('pasien-dewasa.cetak.kartu'); 

// Suami Pasien Dewasa
Route::resource('/suami-pasien-dewasa', SuamiPasienDewasaController::class);
// Obat
Route::resource('/obat', ObatController::class);
// Kepala Puskesmas
Route::resource('/kepala-puskesmas', KepalaPuskesmasController::class);
// Layanan
Route::resource('/jenis-layanan', JenisLayananController::class);

// Karyawan
Route::resource('/karyawan', KaryawanController::class);







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
