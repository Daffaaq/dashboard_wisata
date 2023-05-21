<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Auth::routes();
//dashboard barang
// Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth');
// Route::resource('/dashboard/barang', DashboardBarangController::class)->middleware('auth', 'ceklevel:admin');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
//dashboard barang
Route::resource('/dashboard/wisata', WisataController::class)->middleware('auth');
