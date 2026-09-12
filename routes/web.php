<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Protected Routes - Require Authentication
Route::middleware(['auth'])->group(function () {
    // Master Items Routes
    Route::get('/master-items', [App\Http\Controllers\MasterItemsController::class, 'index']);
    Route::get('/master-items/search', [App\Http\Controllers\MasterItemsController::class, 'search']);
    Route::get('/master-items/export-excel', [App\Http\Controllers\MasterItemsController::class, 'exportExcel']);
    Route::get('/master-items/form/{method}/{id?}', [App\Http\Controllers\MasterItemsController::class, 'formView']);
    Route::post('/master-items/form/{method}/{id?}', [App\Http\Controllers\MasterItemsController::class, 'formSubmit']);
    Route::get('/master-items/view/{kode}', [App\Http\Controllers\MasterItemsController::class, 'singleView']);
    Route::post('/master-items/delete/{id}', [App\Http\Controllers\MasterItemsController::class, 'delete'])->name('master-items.delete');
    Route::get('/master-items/update-random-data', [App\Http\Controllers\MasterItemsController::class, 'updateRandomData']);

    // Kategori Items Routes
    Route::get('/kategori-items', [App\Http\Controllers\KategoriItemsController::class, 'index']);
    Route::get('/kategori-items/search', [App\Http\Controllers\KategoriItemsController::class, 'search']);
    Route::get('/kategori-items/form/{method}/{id?}', [App\Http\Controllers\KategoriItemsController::class, 'formView']);
    Route::post('/kategori-items/form/{method}/{id?}', [App\Http\Controllers\KategoriItemsController::class, 'formSubmit']);
    Route::get('/kategori-items/view/{id}', [App\Http\Controllers\KategoriItemsController::class, 'singleView']);
    Route::post('/kategori-items/delete/{id}', [App\Http\Controllers\KategoriItemsController::class, 'delete'])->name('kategori-items.delete');
    Route::get('/kategori-items/export-pdf/{id}', [App\Http\Controllers\KategoriItemsController::class, 'exportPdf']);
});
