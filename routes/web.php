<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\UmumController;
use App\Http\Controllers\PembangunanController;
use App\Http\Controllers\KelembagaanController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('pages.index');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('pages.index');
})->name('dashboard');

/** Profile */
Route::put('editProfile/{id}', [UserController::class, 'update'])->name('editProfile');
Route::put('editPassword/{id}', [UserController::class, 'changePassword'])->name('editPassword');

/** User */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/daftar-user', [UserController::class, 'daftarUser'])->name('daftar-user');
    Route::post('daftar-user/add', [UserController::class, 'addUser'])->name('daftar-user.add');
    Route::put('/daftar-user/edit/{id}', [UserController::class, 'updateUser'])->name('daftar-user.update');
    Route::delete('/daftar-user/delete/{id}', [UserController::class, 'destroyUser'])->name('daftar-user.delete');
});
/** Administrasi Penduduk **/
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-penduduk', [PendudukController::class, 'bukuPenduduk'])->name('penduduk.buku_penduduk');
    Route::put('/buku-penduduk/edit/{id}', [PendudukController::class, 'updatePenduduk'])->name('buku-penduduk.update');
    Route::get('/load-penduduk/{id}', [PendudukController::class, 'loadPenduduk'])->name('penduduk.load-penduduk');
    Route::post('/load-detail-penduduk/{id}', [PendudukController::class, 'loadDetail'])->name('penduduk.load-detail');
    Route::get('/save-penduduk/{id}', [PendudukController::class, 'savePenduduk'])->name('penduduk.save-penduduk');
});
//Buku Perkawinan
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-perkawinan', [PendudukController::class, 'bukuPerkawinan'])->name('penduduk.buku_perkawinan');
    Route::post('buku-perkawinan/add', [PendudukController::class, 'addPerkawinan'])->name('buku-perkawinan.add');
    Route::put('/buku-perkawinan/edit/{id}', [PendudukController::class, 'updatePerkawinan'])->name('buku-perkawinan.update');
    Route::delete('/buku-perkawinan/delete/{id}', [PendudukController::class, 'destroyPerkawinan'])->name('buku-perkawinan.delete');
    Route::get('/load-perkawinan/{id}', [PendudukController::class, 'loadPerkawinan'])->name('penduduk.load-perkawinan');
    Route::get('/save-perkawinan/{id}', [PendudukController::class, 'savePerkawinan'])->name('penduduk.save-perkawinan');
});
//Buku Kematian
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-kematian', [PendudukController::class, 'bukuKematian'])->name('penduduk.buku_kematian');
    Route::post('buku-kematian/add', [PendudukController::class, 'addKematian'])->name('buku-kematian.add');
    Route::put('/buku-kematian/edit/{id}', [PendudukController::class, 'updateKematian'])->name('buku-kematian.update');
    Route::delete('/buku-kematian/delete/{id}', [PendudukController::class, 'destroyKematian'])->name('buku-kematian.delete');
    Route::get('/load-kematian/{id}', [PendudukController::class, 'loadKematian'])->name('penduduk.load-kematian');
    Route::get('/save-kematian/{id}', [PendudukController::class, 'saveKematian'])->name('penduduk.save-kematian');
});
/** Administrasi Umum **/
//Buku Keputusan
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-keputusan', [UmumController::class, 'bukuKeputusan'])->name('umum.buku-keputusan');
    Route::post('buku-keputusan/add', [UmumController::class, 'addKeputusan'])->name('buku-keputusan.add');
    Route::put('/buku-keputusan/edit/{id}', [UmumController::class, 'updateSK'])->name('buku-keputusan.update');
    Route::delete('/buku-keputusan/delete/{id}', [UmumController::class, 'destroySK'])->name('buku-keputusan.delete');
    Route::get('/buku-keputusan/download/{id}', [UmumController::class, 'downloadSK'])->name('buku-keputusan.download');
});
//Buku Inventaris
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-inventaris', [UmumController::class, 'bukuInventaris'])->name('umum.buku-inventaris');
    Route::post('buku-inventaris/add', [UmumController::class, 'addInventaris'])->name('buku-inventaris.add');
    Route::put('/buku-inventaris/edit/{id}', [UmumController::class, 'updateInventaris'])->name('buku-inventaris.update');
    Route::delete('/buku-inventaris/delete/{id}', [UmumController::class, 'destroyInventaris'])->name('buku-inventaris.delete');
});
//Buku Cuti
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-cuti', [UmumController::class, 'bukuCuti'])->name('umum.buku-cuti');
    Route::delete('/buku-cuti/delete/{id}', [UmumController::class, 'destroyCuti'])->name('buku-cuti.delete');
    Route::post('buku-cuti/add', [UmumController::class, 'addCuti'])->name('buku-cuti.add');
    Route::put('/buku-cuti/edit/{id}', [UmumController::class, 'updateCuti'])->name('buku-cuti.update');
});
//Buku Agenda Masuk
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-masuk', [UmumController::class, 'bukuMasuk'])->name('umum.buku-masuk');
    Route::post('buku-masuk/add', [UmumController::class, 'addMasuk'])->name('buku-masuk.add');
    Route::put('/buku-masuk/edit/{id}', [UmumController::class, 'updateMasuk'])->name('buku-masuk.update');
    Route::delete('/buku-masuk/delete/{id}', [UmumController::class, 'destroyMasuk'])->name('buku-masuk.delete');
    Route::get('/buku-masuk/download/{id}', [UmumController::class, 'downloadMasuk'])->name('buku-masuk.download');
});
//Buku Agenda Keluar
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-keluar', [UmumController::class, 'bukuKeluar'])->name('umum.buku-keluar');
    Route::post('buku-keluar/add', [UmumController::class, 'addKeluar'])->name('buku-keluar.add');
    Route::get('/buku-keluar/download/{id}', [UmumController::class, 'downloadKeluar'])->name('buku-keluar.download');
    Route::delete('/buku-keluar/delete/{id}', [UmumController::class, 'destroyKeluar'])->name('buku-keluar.delete');
    Route::put('/buku-keluar/edit/{id}', [UmumController::class, 'updateKeluar'])->name('buku-keluar.update');
});
/** Adminitrasi Kelembagaan **/
//Buku Kepangkatan
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-pangkat', [KelembagaanController::class, 'bukuPangkat'])->name('kelembagaan.buku-pangkat');
    Route::post('buku-pangkat/add', [KelembagaanController::class, 'addPangkat'])->name('buku-pangkat.add');
    Route::put('/buku-pangkat/edit/{id}', [KelembagaanController::class, 'updatePangkat'])->name('buku-pangkat.update');
    Route::delete('/buku-pangkat/delete/{id}', [KelembagaanController::class, 'destroyPangkat'])->name('buku-pangkat.delete');
});
//Buku Kenaikan Gaji
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-gaji', [KelembagaanController::class, 'bukuGaji'])->name('kelembagaan.buku-gaji');
    Route::post('buku-gaji/add', [KelembagaanController::class, 'addGaji'])->name('buku-gaji.add');
    Route::put('/buku-gaji/edit/{id}', [KelembagaanController::class, 'updateGaji'])->name('buku-gaji.update');
    Route::delete('/buku-gaji/delete/{id}', [KelembagaanController::class, 'destroyGaji'])->name('buku-gaji.delete');
    Route::get('/buku-gaji/download/{id}', [KelembagaanController::class, 'downloadGaji'])->name('buku-gaji.download');
});
//Buku Kenaikan Pegawai
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-kenaikan-pegawai', [KelembagaanController::class, 'bukuKP'])->name('kelembagaan.buku-kenaikanPegawai');
    Route::get('/load-kenaikan-pegawai/{id}', [KelembagaanController::class, 'loadKP'])->name('kelembagaan.load-kenaikanPegawai');
    Route::post('buku-kenaikan-pegawai/add', [KelembagaanController::class, 'addKP'])->name('buku-kenaikan-pegawai.add');
    Route::put('/buku-kenaikan-pegawai/edit/{id}', [KelembagaanController::class, 'updateKP'])->name('buku-kenaikan-pegawai.update');
    Route::put('/buku-kenaikan-pegawai/kt-add/{id}', [KelembagaanController::class, 'addKT'])->name('buku-kenaikan-pegawai.addKT');
    Route::put('/buku-kenaikan-pegawai/kt-remove/{id}', [KelembagaanController::class, 'removeKT'])->name('buku-kenaikan-pegawai.removeKT');
    Route::delete('/buku-kenaikan-pegawai/delete/{id}', [KelembagaanController::class, 'destroyKP'])->name('buku-kenaikan-pegawai.delete');
});
//Buku Rekomendasi Masuk
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-rekomendasimasuk', [KelembagaanController::class, 'bukuRekomendasimasuk'])->name('kelembagaan.buku-rekomendasimasuk');
    Route::post('buku-rekomendasimasuk/add', [KelembagaanController::class, 'addRM'])->name('buku-rekomendasimasuk.add');
    Route::put('/buku-rekomendasimasuk/edit/{id}', [KelembagaanController::class, 'updateRM'])->name('buku-rekomendasimasuk.update');
    Route::get('/buku-rekomendasimasuk/download/{id}', [KelembagaanController::class, 'downloadRM'])->name('buku-rekomendasimasuk');
    Route::delete('/buku-rekomendasimasuk/delete/{id}', [KelembagaanController::class, 'destroyRM'])->name('buku-rekomendasimasuk.delete');
});
//Buku Rekomendasi Keluar
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku-rekomendasikeluar', [KelembagaanController::class, 'bukuRekomendasikeluar'])->name('kelembagaan.buku-rekomendasikeluar');
    Route::post('buku-rekomendasikeluar/add', [KelembagaanController::class, 'addRK'])->name('buku-rekomendasikeluar.add');
    Route::put('/buku-rekomendasikeluar/edit/{id}', [KelembagaanController::class, 'updateRK'])->name('buku-rekomendasikeluar.update');
    Route::get('/buku-rekomendasikeluar/download/{id}', [KelembagaanController::class, 'downloadRK'])->name('buku-rekomendasikeluar');
    Route::delete('/buku-rekomendasikeluar/delete/{id}', [KelembagaanController::class, 'destroyRK'])->name('buku-rekomendasikeluar.delete');
});