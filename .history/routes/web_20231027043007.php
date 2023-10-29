<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BarcodeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//Route::get('/', [BarcodeController::class,'index']);
Route::post('/generate-barcode', [BarcodeController::class, 'generateBarcode'])->name();
//Route::get('/barcodes', [BarcodeController::class, 'showBarcodes']);
Route::get('/', [BarcodeController::class, 'showBarcodes'])->name('list-barcodes');

Route::delete('/delete-barcode/{id}', [BarcodeController::class, 'deleteBarcode'])->name('barcode.delete');
