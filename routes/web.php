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
Route::post('buku-inventaris/add', [UmumController::class, 'addInventaris'])->name('buku-inventaris.add');
Route::put('/buku-inventaris/edit/{id}', [UmumController::class, 'updateInventaris'])->name('buku-inventaris.update');
Route::delete('/buku-inventaris/delete/{id}', [UmumController::class, 'destroyInventaris'])->name('buku-inventaris.delete');
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
//Buku Agenda Keluar
Route::get('/buku-keluar', [UmumController::class, 'bukuKeluar'])->name('umum.buku-keluar');
Route::post('buku-keluar/add', [UmumController::class, 'addKeluar'])->name('buku-keluar.add');
Route::get('/buku-keluar/download/{id}', [UmumController::class, 'downloadKeluar'])->name('buku-keluar.download');
Route::delete('/buku-keluar/delete/{id}', [UmumController::class, 'destroyKeluar'])->name('buku-keluar.delete');
Route::put('/buku-keluar/edit/{id}', [UmumController::class, 'updateKeluar'])->name('buku-keluar.update');
/** Adminitrasi Kelembagaan **/
//Buku Kepangkatan
Route::get('/buku-pangkat', [KelembagaanController::class, 'bukuPangkat'])->name('kelembagaan.buku-pangkat');
Route::post('buku-pangkat/add', [KelembagaanController::class, 'addPangkat'])->name('buku-pangkat.add');
Route::put('/buku-pangkat/edit/{id}', [KelembagaanController::class, 'updatePangkat'])->name('buku-pangkat.update');
Route::delete('/buku-pangkat/delete/{id}', [KelembagaanController::class, 'destroyPangkat'])->name('buku-pangkat.delete');
//Buku Kenaikan Gaji
Route::get('/buku-gaji', [KelembagaanController::class, 'bukuGaji'])->name('kelembagaan.buku-gaji');
Route::post('buku-gaji/add', [KelembagaanController::class, 'addGaji'])->name('buku-gaji.add');
Route::put('/buku-gaji/edit/{id}', [KelembagaanController::class, 'updateGaji'])->name('buku-gaji.update');
Route::delete('/buku-gaji/delete/{id}', [KelembagaanController::class, 'destroyGaji'])->name('buku-gaji.delete');
Route::get('/buku-gaji/download/{id}', [KelembagaanController::class, 'downloadGaji'])->name('buku-gaji.download');
//Buku Kenaikan Pegawai
Route::get('/buku-kenaikan-pegawai', [KelembagaanController::class, 'bukuKP'])->name('kelembagaan.buku-kenaikanPegawai');
Route::get('/load-kenaikan-pegawai/{id}', [KelembagaanController::class, 'loadKP'])->name('kelembagaan.load-kenaikanPegawai');
Route::post('buku-kenaikan-pegawai/add', [KelembagaanController::class, 'addKP'])->name('buku-kenaikan-pegawai.add');
Route::put('/buku-kenaikan-pegawai/edit/{id}', [KelembagaanController::class, 'updateKP'])->name('buku-kenaikan-pegawai.update');
Route::put('/buku-kenaikan-pegawai/kt-add/{id}', [KelembagaanController::class, 'addKT'])->name('buku-kenaikan-pegawai.addKT');
Route::put('/buku-kenaikan-pegawai/kt-remove/{id}', [KelembagaanController::class, 'removeKT'])->name('buku-kenaikan-pegawai.removeKT');
Route::delete('/buku-kenaikan-pegawai/delete/{id}', [KelembagaanController::class, 'destroyKP'])->name('buku-kenaikan-pegawai.delete');
Route::get('/buku-rekomendasimasuk', [KelembagaanController::class, 'bukuRekomendasimasuk'])->name('kelembagaan.buku-rekomendasimasuk');
Route::post('buku-rekomendasimasuk/add', [KelembagaanController::class, 'addRM'])->name('buku-rekomendasimasuk.add');
Route::get('/buku-rekomendasimasuk/download/{id}', [KelembagaanController::class, 'downloadRM'])->name('buku-rekomendasimasuk');
Route::delete('/buku-rekomendasimasuk/delete/{id}', [KelembagaanController::class, 'destroyRM'])->name('buku-rekomendasimasuk.delete');

Route::get('/buku-rekomendasikeluar', [KelembagaanController::class, 'bukuRekomendasikeluar'])->name('kelembagaan.buku-rekomendasikeluar');