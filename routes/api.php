<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MstItemController;
use App\Http\Controllers\TrxKoperasiController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'tugas'
], function ($router) {
    Route::post('/inputKaryawan', [KaryawanController::class, 'inputKaryawan']);
    Route::get('/karyawan', [KaryawanController::class, 'karyawan']);
    Route::get('/trx', [TrxKoperasiController::class, 'trx']);
    Route::post('/inputItem', [MstItemController::class, 'inputItem']);
});
