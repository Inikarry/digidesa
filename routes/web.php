<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmumController;

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

Route::get('/peraturan-desa', [UmumController::class, 'peraturanDesa'])->name('umum.peraturan-desa');
Route::get('/buku-keputusan', [UmumController::class, 'bukuKeputusan'])->name('umum.buku-keputusan');
Route::get('/buku-aparat', [UmumController::class, 'bukuAparat'])->name('umum.buku-aparat');
Route::get('/buku-agenda', [UmumController::class, 'bukuAgenda'])->name('umum.buku-agenda');
