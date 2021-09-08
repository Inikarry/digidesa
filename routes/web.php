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

Route::get('/buku-apb-desa', [KeuanganController::class,'apbdesa'])->name('keuangan.apbdesa');
Route::get('/buku-rab-desa', [KeuanganController::class,'rabdesa'])->name('keuangan.rabdesa');
Route::get('/buku-kaspemkeg-desa', [KeuanganController::class,'kaspemkegdesa'])->name('keuangan.kaspemkegdesa');
//Administrasi Penduduk
Route::get('/buku-induk-penduduk', [PendudukController::class, 'bukuInduk'])->name('penduduk.buku_induk_penduduk');
Route::get('/buku-mutasi', [PendudukController::class, 'bukuMutasi'])->name('penduduk.buku_mutasi');
Route::get('/buku-rekapitulasi', [PendudukController::class, 'bukuRekapitulasi'])->name('penduduk.buku_rekapitulasi');
Route::get('/buku-penduduk', [PendudukController::class, 'bukuPenduduk'])->name('penduduk.buku_penduduk');
Route::get('/buku-ktp', [PendudukController::class, 'bukuKtp'])->name('penduduk.buku_ktp');

//Administrasi Umum
Route::get('/peraturan-desa', [UmumController::class, 'peraturanDesa'])->name('umum.peraturan-desa');
Route::get('/buku-keputusan', [UmumController::class, 'bukuKeputusan'])->name('umum.buku-keputusan');
Route::get('/buku-inventaris', [UmumController::class, 'bukuInventaris'])->name('umum.buku-inventaris');
Route::get('/buku-cuti', [UmumController::class, 'bukuCuti'])->name('umum.buku-cuti');
Route::delete('/buku-cuti/delete/{id}', [UmumController::class, 'destroyCuti'])->name('buku-cuti.delete');
Route::post('buku-cuti/add', [UmumController::class, 'addCuti'])->name('buku-cuti.add');
Route::get('/buku-agenda', [UmumController::class, 'bukuAgenda'])->name('umum.buku-agenda');

//Administrasi Pembangunan
Route::get('/buku-rencana', [PembangunanController::class, 'bukuRencana'])->name('pembangunan.buku_rencana');
Route::get('/buku-kegiatan', [PembangunanController::class, 'bukuKegiatan'])->name('pembangunan.buku_kegiatan');
Route::get('/buku-kader', [PembangunanController::class, 'bukuKader'])->name('pembangunan.buku_kader');

//Adminitrasi Kelembagaan
Route::get('/data-anggota-pkk', [KelembagaanController::class, 'dataPKK'])->name('kelembagaan.data_pkk');
Route::get('/data-anggota-lpmd', [KelembagaanController::class, 'dataLPMD'])->name('kelembagaan.data_lpmd');
Route::get('/data-anggota-posyandu', [KelembagaanController::class, 'dataPosyandu'])->name('kelembagaan.data_posyandu');
Route::get('/data-anggota-bpd', [KelembagaanController::class, 'dataBPD'])->name('kelembagaan.data_bpd');
