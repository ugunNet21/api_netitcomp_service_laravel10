<?php

use App\Http\Controllers\JenisKerusakanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PemesananJenisKerusakanController;
use App\Http\Controllers\PencarianPemesananController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/user', UserController::class);
Route::resource('/notif', NotifikasiController::class);
Route::resource('/jenisKerusakan', JenisKerusakanController::class);
Route::resource('/pemesanan', PemesananController::class);
Route::resource('/pemesananJkKerusakan', PemesananJenisKerusakanController::class);

Route::get('/pemesanans/search', [PencarianPemesananController::class, 'search']);
Route::get('/laporan/harian', [LaporanController::class, 'harian']);
Route::get('/laporan/mingguan', [LaporanController::class, 'mingguan']);
Route::get('/laporan/bulanan', [LaporanController::class, 'bulanan']);
Route::get('/laporan/tahunan', [LaporanController::class, 'tahunan']);
