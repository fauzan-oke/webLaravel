<?php



use App\Http\Controllers\TrxKoperasiController;
use App\Models\TrxKoperasi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/input', [TrxKoperasiController::class, 'index']);
Route::get('/', [TrxKoperasiController::class, 'index']);
Route::get('/viewTrx', [TrxKoperasiController::class, 'viewTrx']);
Route::post('/input', [TrxKoperasiController::class, 'store']);
Route::get('/search', [TrxKoperasiController::class, 'search']);
Route::put('/edit', [TrxKoperasiController::class, 'edit']);
Route::delete('/delete/{id}', [TrxKoperasiController::class, 'delete'])->name('delete');
