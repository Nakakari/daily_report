<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MasterDataUserController;

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
    return view('auth.login');
});

// Route::get('/', function () {
//     return view('Teknisi.v_form');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'is_admin'], function () {
    Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    //Master Data Users
    Route::get('master_data', [MasterDataUserController::class, 'index']);
    Route::post('list_user', [MasterDataUserController::class, 'listUser']);
    Route::post('add_user', [MasterDataUserController::class, 'addUser']);
    Route::post('edit_user', [MasterDataUserController::class, 'editUser']);
    Route::post('hapus_user', [MasterDataUserController::class, 'hapusUser']);
    //Kunjungan Report
});

Route::group(['middleware' => 'is_teknisi'], function () {
    Route::get('teknisi/home', [HomeController::class, 'teknisiHome'])->name('teknisi.home');
});

Route::group(['middleware' => 'is_assspv'], function () {
    Route::get('assspv/home', [HomeController::class, 'assspvHome'])->name('assspv.home');
});
