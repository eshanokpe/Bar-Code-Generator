<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarcodeController;


Route::get('/', [BarcodeController::class, 'index']);
Route::post('/generate-barcode', [BarcodeController::class, 'generateBarcode'])
    ->name('generate-barcode');
Route::get('/list-barcodes', [BarcodeController::class, 'showBarcodes'])
    ->name('list-barcodes');
Route::delete('/delete-barcode/{id}', [BarcodeController::class, 'deleteBarcode'])
    ->name('delete-barcode');