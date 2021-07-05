<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DokterController;

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

// FRONT-END
Route::get('/', [HomeController::class, 'index']);
Route::match(array('GET', 'POST'), 'daftar', [HomeController::class, 'daftar']);
Route::match(array('GET', 'POST'), 'do_daftar', [HomeController::class, 'do_daftar']);
Route::match(array('GET', 'POST'), 'do_login', [HomeController::class, 'do_login']);
Route::match(array('GET', 'POST'), 'tambah_anak', [HomeController::class, 'tambah_anak']);
Route::match(array('GET', 'POST'), 'hapus_anak/{id}', [HomeController::class, 'hapus_anak']);
Route::match(array('GET', 'POST'), 'diagnosa/{id}', [HomeController::class, 'diagnosa']);
Route::match(array('GET', 'POST'), 'buat_diagnosa/{id}', [HomeController::class, 'buat_diagnosa']);
Route::match(array('GET', 'POST'), 'hasil_diagnosa/{id}', [HomeController::class, 'hasil_diagnosa']);

Route::get('jenis_kk', [HomeController::class, 'jenis_kk']);
Route::match(array('GET', 'POST'), 'tambah_jkk', [HomeController::class, 'tambah_jkk']);
Route::match(array('GET', 'POST'), 'hapus_jkk/{id}', [HomeController::class, 'hapus_jkk']);
Route::get('jenis_diagnosa', [HomeController::class, 'jenis_diagnosa']);
Route::match(array('GET', 'POST'), 'tambah_diagnosa', [HomeController::class, 'tambah_diagnosa']);
Route::match(array('GET', 'POST'), 'hapus_diagnosa/{id}', [HomeController::class, 'hapus_diagnosa']);

// login
Route::get('login', [LoginController::class, 'index']);
Route::match(array('GET', 'POST'), 'login/verify', [LoginController::class, 'verify']);


// logout
Route::get('logout', function () {
    Session::forget('loged_in');
    Session::forget('uid');
        
    return redirect(url('/'));
});