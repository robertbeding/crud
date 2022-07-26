<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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

// Route::resource('/pegawai', PegawaiController::class);

Route::get('/pegawai',[PegawaiController::class, 'index'])->name('pegawai');

Route::get('/tambahpegawai',[PegawaiController::class, 'tambahpegawai'])->name('tambahpegawai');
Route::post('/insertdata',[PegawaiController::class, 'insertdata'])->name('insertdata');

Route::get('/tampildata/{id}',[PegawaiController::class, 'tampildata'])->name('tampildata');
Route::post('/updatedata/{id}',[PegawaiController::class, 'updatedata'])->name('updatedata');

Route::get('/delete/{id}',[PegawaiController::class, 'delete'])->name('delete');

//export PDF
Route::get('/exportpdf',[PegawaiController::class, 'exportpdf'])->name('exportpdf');


Route::group(['as' => 'excel.', 'prefix' => 'excel' ], function(){
    //export Excel
    Route::get('/export',[PegawaiController::class, 'exportexcel'])->name('export');
    //import Excel
    Route::post('/import',[PegawaiController::class, 'importexcel'])->name('import');
});

