<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\UmumController;
use App\Http\Controllers\PembangunanController;
use App\Http\Controllers\KelembagaanController;


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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('pages.index');
})->name('dashboard');

/** Administrasi Penduduk **/
Route::get('/buku-induk-penduduk', [PendudukController::class, 'bukuInduk'])->name('penduduk.buku_induk_penduduk');
Route::get('/buku-mutasi', [PendudukController::class, 'bukuMutasi'])->name('penduduk.buku_mutasi');
Route::get('/buku-rekapitulasi', [PendudukController::class, 'bukuRekapitulasi'])->name('penduduk.buku_rekapitulasi');
Route::get('/buku-penduduk', [PendudukController::class, 'bukuPenduduk'])->name('penduduk.buku_penduduk');
Route::get('/buku-ktp', [PendudukController::class, 'bukuKtp'])->name('penduduk.buku_ktp');

/** Administrasi Umum **/
//Buku Keputusan
Route::get('/buku-keputusan', [UmumController::class, 'bukuKeputusan'])->name('umum.buku-keputusan');
Route::post('buku-keputusan/add', [UmumController::class, 'addKeputusan'])->name('buku-keputusan.add');
Route::put('/buku-keputusan/edit/{id}', [UmumController::class, 'updateSK'])->name('buku-keputusan.update');
Route::delete('/buku-keputusan/delete/{id}', [UmumController::class, 'destroySK'])->name('buku-keputusan.delete');
Route::get('/buku-keputusan/download/{id}', [UmumController::class, 'downloadSK'])->name('buku-keputusan.download');
//Buku Inventaris
Route::get('/buku-inventaris', [UmumController::class, 'bukuInventaris'])->name('umum.buku-inventaris');
//Buku Cuti
Route::get('/buku-cuti', [UmumController::class, 'bukuCuti'])->name('umum.buku-cuti');
Route::delete('/buku-cuti/delete/{id}', [UmumController::class, 'destroyCuti'])->name('buku-cuti.delete');
Route::post('buku-cuti/add', [UmumController::class, 'addCuti'])->name('buku-cuti.add');
Route::put('/buku-cuti/edit/{id}', [UmumController::class, 'updateCuti'])->name('buku-cuti.update');
//Buku Agenda Masuk
Route::get('/buku-masuk', [UmumController::class, 'bukuMasuk'])->name('umum.buku-masuk');
Route::post('buku-masuk/add', [UmumController::class, 'addMasuk'])->name('buku-masuk.add');
Route::put('/buku-masuk/edit/{id}', [UmumController::class, 'updateMasuk'])->name('buku-masuk.update');
Route::delete('/buku-masuk/delete/{id}', [UmumController::class, 'destroyMasuk'])->name('buku-masuk.delete');
Route::get('/buku-masuk/download/{id}', [UmumController::class, 'downloadMasuk'])->name('buku-masuk.download');

/** Adminitrasi Kelembagaan **/
Route::get('/data-anggota-pkk', [KelembagaanController::class, 'dataPKK'])->name('kelembagaan.data_pkk');
Route::get('/buku-gaji', [KelembagaanController::class, 'bukuGaji'])->name('kelembagaan.buku-gaji');
Route::get('/data-anggota-posyandu', [KelembagaanController::class, 'dataPosyandu'])->name('kelembagaan.data_posyandu');
Route::get('/buku-rekomendasimasuk', [KelembagaanController::class, 'bukuRekomendasimasuk'])->name('kelembagaan.buku-rekomendasimasuk');
Route::get('/buku-rekomendasikeluar', [KelembagaanController::class, 'bukuRekomendasikeluar'])->name('kelembagaan.buku-rekomendasikeluar');