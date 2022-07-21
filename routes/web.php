<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MasterDataUserController;
use App\Http\Controllers\Admin\MasterDataCustomerController;
use App\Http\Controllers\Admin\MasterDataMesinController;
use App\Http\Controllers\Admin\reportAdminController;
use App\Http\Controllers\asMng\asMngController;
use App\Http\Controllers\Teknisi\reportController;
use App\Http\Controllers\assSpv\assSpvController;
use App\Http\Controllers\Mng\mngController;
use App\Http\Controllers\Spv\spvController;

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
    Route::get('kunjungan_report', [reportAdminController::class, 'index']);
    Route::post('list_reportAdmin', [reportAdminController::class, 'listReport']);
    Route::post('hapus_reportAdmin', [reportAdminController::class, 'hapusReport']);
    Route::get('edit_reportAdmin/{id_report}', [reportAdminController::class, 'editReport']);
    Route::post('update_reportAdmin/{id_report}', [reportAdminController::class, 'updateReport']);
    Route::get('report/print/{id_report}', [reportAdminController::class, 'printReport']);
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
    Route::get('detail_reportt/{id_report}', [reportController::class, 'detail']);
    Route::post('hapus_report', [reportController::class, 'hapusReport']);
    Route::get('edit_report/{id_report}', [reportController::class, 'editReport']);
    Route::post('update_report/{id_report}', [reportController::class, 'updateReport']);
    Route::get('report/print/{id_report}', [reportController::class, 'printReport']);
});

Route::group(['middleware' => 'is_assspv'], function () {
    Route::get('assspv/home', [HomeController::class, 'assspvHome'])->name('assspv.home');
    Route::get('assspv', [HomeController::class, 'assspvHome'])->name('assspv');
    // Daftar Report Assisten Supervisor
    Route::get('daftar_report', [assSpvController::class, 'index']);
    Route::get('detail_report/{id_report}', [assSpvController::class, 'detail']);
    Route::get('detail_problem', [assSpvController::class, 'detailProblem']);

    Route::post('list_report_aspv', [assSpvController::class, 'listReportAspv']);
    Route::post('by_aspv/approve', [assSpvController::class, 'approveByAspv']);
    Route::post('by_aspv/revision', [assSpvController::class, 'revisionByAspv']);
    Route::post('by_aspv/reject', [assSpvController::class, 'rejectByAspv']);
});

Route::group(['middleware' => 'is_spv'], function () {
    Route::get('spv/home', [HomeController::class, 'spvHome'])->name('spv.home');

    Route::get('daftar_reportSpv', [spvController::class, 'index']);
    Route::get('detail_report2/{id_report}', [spvController::class, 'detail']);
    Route::post('list_report_spv', [spvController::class, 'listReportAspv']);
    Route::post('by_spv/approve', [spvController::class, 'approveByAspv']);
    Route::post('by_spv/revision', [spvController::class, 'revisionByAspv']);
    Route::post('by_spv/reject', [spvController::class, 'rejectByAspv']);
});

Route::group(['middleware' => 'is_asMng'], function () {
    Route::get('asmng/home', [HomeController::class, 'asmngHome'])->name('asmng.home');

    Route::get('daftar_reportAsMng', [asMngController::class, 'index']);
    Route::get('detail_report3/{id_report}', [asMngController::class, 'detail']);
    Route::post('list_report_asmng', [asMngController::class, 'listReport']);
    Route::post('by_asmng/approve', [asMngController::class, 'approveByAspv']);
    Route::post('by_asmng/revision', [asMngController::class, 'revisionByAspv']);
    Route::post('by_asmng/reject', [asMngController::class, 'rejectByAspv']);
});
Route::group(['middleware' => 'is_mng'], function () {
    Route::get('mng/home', [HomeController::class, 'mngHome'])->name('mng.home');

    Route::get('daftar_reportMng', [mngController::class, 'index']);
    Route::get('detail_report4/{id_report}', [mngController::class, 'detail']);
    Route::post('list_report_mng', [mngController::class, 'listReport']);
    Route::post('by_mng/approve', [mngController::class, 'approveByAspv']);
    Route::post('by_mng/revision', [mngController::class, 'revisionByAspv']);
    Route::post('by_mng/reject', [mngController::class, 'rejectByAspv']);
});
