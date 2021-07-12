<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendudukController;

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

Route::get('/buku-induk-penduduk', [PendudukController::class, 'bukuInduk'])->name('penduduk.buku_induk_penduduk');
Route::get('/buku-mutasi', [PendudukController::class, 'bukuMutasi'])->name('penduduk.buku_mutasi');
Route::get('/buku-rekapitulasi', [PendudukController::class, 'bukuRekapitulasi'])->name('penduduk.buku_rekapitulasi');
Route::get('/buku-penduduk', [PendudukController::class, 'bukuPenduduk'])->name('penduduk.buku_penduduk');
Route::get('/buku-ktp', [PendudukController::class, 'bukuKtp'])->name('penduduk.buku_ktp');