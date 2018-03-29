<?php

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
    return Redirect::to('login');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resources([
            'jabatan' => 'BackEnd\JabatanController',
            'pegawai' => 'BackEnd\PegawaiController',
            'mesin' => 'BackEnd\MesinController',
            'absen' => 'BackEnd\AbsenController'
    ]);
    Route::get('/absen/list/log', 'BackEnd\AbsenController@absenLog')->name('absen.log');
    Route::post('/get/datatables/jabatan', 'BackEnd\JabatanController@getDtRowData')->name('get.datatables.jabatan');
    Route::post('/get/datatables/mesin', 'BackEnd\MesinController@getDtRowData')->name('get.datatables.mesin');
    Route::post('/get/datatables/pegawai', 'BackEnd\PegawaiController@getDtRowData')->name('get.datatables.pegawai');
    Route::post('/get/datatables/absen/log', 'BackEnd\AbsenController@getDtRowDataAbsenLog')->name('get.datatables.absen.log');
    Route::post('/get/datatables/absen', 'BackEnd\AbsenController@getDtRowDataAbsen')->name('get.datatables.absen');
    Route::post('/sync/data/from/absen/log/modal', 'BackEnd\AbsenController@syncDataFromLogModal')->name('modal.sync.data.from.absen.log');
    Route::post('/sync/data/from/absen/log', 'BackEnd\AbsenController@syncDataFromLog')->name('sync.data.from.absen.log');
    Route::post('/sync/data/from/machine', 'BackEnd\AbsenController@syncData')->name('sync.data.from.machine');
});
