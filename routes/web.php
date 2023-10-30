<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\TendikController;
use App\Http\Controllers\Admin\DosenlbController;
// User
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\TendikUserController;
use App\Http\Controllers\User\DosenLbUserController;
use App\Http\Controllers\User\DosenTetapUserController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Admin Routes
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit')->middleware('auth');
Route::patch('password', [ChangePasswordController::class, 'update'])->name('password.edit')->middleware('auth');

// tendik
Route::get('slipGajiTendik', [TendikUserController::class, 'index'])->middleware(['auth', 'tendik'])->name('slipGajiTendik');
Route::get('slipGajiDosenLB', [DosenLbUserController::class, 'index'])->middleware(['auth', 'dosen_lb'])->name('slipGajiDosenLB');
Route::get('slipGajiDosenTetap', [DosenTetapUserController::class, 'index'])->middleware(['auth', 'dosen_tetap'])->name('slipGajiDosenTetap');



Route::middleware(['admin'])->group(function () {
    // Dashboard
    Route::get('/adminDashboard', [AdminController::class, 'index'])->middleware('auth')->name('adminDashboard');

    // Master Akun
    Route::get('/akun', [AkunController::class, 'index'])->middleware('auth')->name('akun');
    Route::post('/akun', [AkunController::class, 'store'])->middleware('auth')->name('insert.akun');
    Route::get('/editAkun/{id}', [AkunController::class, 'edit'])->middleware('auth')->name('edit.akun');
    Route::post('/updateAkun/{id}', [AkunController::class, 'update'])->middleware('auth')->name('update.akun');
    Route::delete('/deleteAkun/{id}', [AkunController::class, 'destroy'])->middleware('auth')->name('destroy.akun');
    Route::get('/resetAkun/{id}', [AkunController::class, 'reset'])->middleware('auth')->name('reset.akun');
    Route::post('/resetupdateAkun/{id}', [AkunController::class, 'resetupdate'])->middleware('auth')->name('resetupdate.akun');

    // Slip Tendik
    Route::get('tendik', [TendikController::class, 'index'])->middleware('auth')->name('tendik');
    Route::post('/tendik', [TendikController::class, 'store'])->middleware('auth')->name('insert.tendik');
    Route::get('/editTendik/{id}', [TendikController::class, 'edit'])->middleware('auth')->name('edit.tendik');
    Route::post('/updateTendik/{id}', [TendikController::class, 'update'])->middleware('auth')->name('update.tendik');
    Route::delete('/deleteTendik/{id}', [TendikController::class, 'destroy'])->middleware('auth')->name('destroy.tendik');
    Route::get('/import-tendik', [TendikController::class, 'showImportForm'])->name('import.tendik.view');
    Route::post('/import-tendik', [TendikController::class, 'importExcel'])->name('import.tendik');
    Route::get('download-example-excel', [TendikController::class, 'downloadExampleExcel'])->name('download.example.excel');
    Route::get('/export-pdf/{bulan}/{tahun}', [TendikController::class, 'exportPdf'])->middleware('auth')->name('export.pdf');
    // Route untuk menampilkan slip gaji berdasarkan ID Pegawai
    Route::get('/export-pdf/{id}', [TendikController::class, 'exportPdfbyid'])->middleware('auth')->name('export.pdfbyid');

    // Slip Dosen LB
    Route::get('dosenlb', [DosenlbController::class, 'index'])->middleware('auth')->name('dosenlb');
    Route::post('/dosenlb', [DosenlbController::class, 'store'])->middleware('auth')->name('insert.dosenlb');
    Route::get('/editDosenlb/{id}', [DosenlbController::class, 'edit'])->middleware('auth')->name('edit.dosenlb');
    Route::post('/updateDosenlb/{id}', [DosenlbController::class, 'update'])->middleware('auth')->name('update.dosenlb');
    Route::delete('/deleteDosenlb/{id}', [DosenlbController::class, 'destroy'])->middleware('auth')->name('destroy.dosenlb');
    Route::get('/import-dosenlb', [DosenlbController::class, 'showImportForm'])->name('import.dosenlb.view');
    Route::post('/import-dosenlb', [DosenlbController::class, 'importExcel'])->name('import.dosenlb');
    Route::get('excel-dosen-lb', [DosenlbController::class, 'downloadExampleExcel'])->name('excel.dosen.lb');
    Route::get('/export-pdf-dosenlb/{bulan}/{tahun}', [DosenlbController::class, 'exportPdf'])->middleware('auth')->name('export.pdf');
    Route::get('/export-pdf-dosenlb/{id}', [DosenlbController::class, 'exportPdfbyid'])->middleware('auth')->name('export.pdfbyid');

    // Slip Dosen Tetap
    Route::get('dosentetap', [DosenTetapController::class, 'index'])->middleware('auth')->name('dosentetap');
    Route::post('/dosentetap', [DosenTetapController::class, 'store'])->middleware('auth')->name('insert.dosentetap');
    Route::get('/editDosentetap/{id}', [DosenTetapController::class, 'edit'])->middleware('auth')->name('edit.dosentetap');
    Route::post('/updateDosentetap/{id}', [DosenTetapController::class, 'update'])->middleware('auth')->name('update.dosentetap');
    Route::delete('/deleteDosentetap/{id}', [DosenTetapController::class, 'destroy'])->middleware('auth')->name('destroy.dosentetap');
    Route::get('/import-dosentetap', [DosenTetapController::class, 'showImportForm'])->name('import.dosentetap.view');
    Route::post('/import-dosentetap', [DosenTetapController::class, 'importExcel'])->name('import.dosentetap');
    Route::get('excel-dosen-tetap', [DosenTetapController::class, 'downloadExampleExcel'])->name('excel.dosen.tetap');
    Route::get('/export-pdf-dosentetap/{bulan}/{tahun}', [DosenTetapController::class, 'exportPdf'])->middleware('auth')->name('export.pdf');
    Route::get('/export-pdf-dosentetap/{id}', [DosenTetapController::class, 'exportPdfbyid'])->middleware('auth')->name('export.pdfbyid');


});

// User Routes
Route::get('/userDashboard', [UserController::class, 'index'])->middleware('auth')->name('userDashboard');

