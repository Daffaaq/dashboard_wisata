<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WisataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Endpoint API untuk mengambil daftar wisata
Route::get('/wisata', [WisataController::class, 'getWisata']);

// Endpoint API lainnya untuk menambahkan, mengupdate, dan menghapus data wisata
Route::get('/wisata/{id}', [WisataController::class, 'show']);
Route::post('/wisata', [WisataController::class, 'store']);
Route::put('/wisata/{id}', [WisataController::class, 'update']);
Route::delete('/wisata/{id}', [WisataController::class, 'destroy']);