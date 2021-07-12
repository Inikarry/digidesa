<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuanganController;

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