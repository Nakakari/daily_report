<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MasterDataUserController;
use App\Http\Controllers\Admin\MasterDataCustomerController;
use App\Http\Controllers\Admin\MasterDataMesinController;
use App\Http\Controllers\Teknisi\reportController;
use App\Http\Controllers\assSpv\assSpvController;

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
    //Master Data Customer
    Route::get('master_customer', [MasterDataCustomerController::class, 'index']);
    Route::post('list_cust', [MasterDataCustomerController::class, 'listCust']);
    Route::post('add_cust', [MasterDataCustomerController::class, 'addCust']);
    Route::post('edit_cust', [MasterDataCustomerController::class, 'editCust']);
    Route::post('hapus_cust', [MasterDataCustomerController::class, 'hapusCust']);
    //Master Data Mesin
    Route::get('master_mesin', [MasterDataMesinController::class, 'index']);
    Route::post('list_mesin', [MasterDataMesinController::class, 'listMesin']);
    Route::post('add_mesin', [MasterDataMesinController::class, 'addMesin']);
    Route::post('edit_mesin', [MasterDataMesinController::class, 'editMesin']);
    Route::post('hapus_mesin', [MasterDataMesinController::class, 'hapusMesin']);
    //Kunjungan Report
});

Route::group(['middleware' => 'is_teknisi'], function () {
    Route::get('teknisi/home', [HomeController::class, 'teknisiHome'])->name('teknisi.home');
    //Master Data Users
    Route::get('report', [reportController::class, 'index']);
    Route::get('new_report', [reportController::class, 'addReport']);
    Route::post('kodecust', [reportController::class, 'kodeCustomer']);
    Route::post('kodeoption', [reportController::class, 'kodeOption']);
    Route::post('kodemesin', [reportController::class, 'kodeMesin']);
    //Technical Report
    Route::post('add_report', [reportController::class, 'uploadReport']);
    Route::post('list_report', [reportController::class, 'listReport']);
    Route::post('hapus_report', [reportController::class, 'hapusReport']);
    Route::get('edit_report/{id_report}', [reportController::class, 'editReport']);
    Route::post('update_report/{id_report}', [reportController::class, 'updateReport']);
});

Route::group(['middleware' => 'is_assspv'], function () {
    Route::get('assspv/home', [HomeController::class, 'assspvHome'])->name('assspv.home');
    Route::get('assspv', [HomeController::class, 'assspvHome'])->name('assspv');
    // Daftar Report Assisten Supervisor
    Route::get('daftar_report', [assSpvController::class, 'index']);

    Route::post('list_report_aspv', [assSpvController::class, 'listReportAspv']);
    Route::post('by_aspv/approve', [assSpvController::class, 'approveByAspv']);
    Route::post('by_aspv/revision', [assSpvController::class, 'revisionByAspv']);
    Route::post('by_aspv/reject', [assSpvController::class, 'rejectByAspv']);
});
