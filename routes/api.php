<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InventoryController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('ensure.token.is.valid')->group(function () {

    Route::prefix('inventory')->group(function () {
        Route::get('show_list', [InventoryController::class, 'show_list']);
        Route::post('add', [InventoryController::class, 'add']);
        Route::get('detail', [InventoryController::class, 'detail']);
        Route::post('update', [InventoryController::class, 'update']);
        Route::post('delete', [InventoryController::class, 'delete']);
        Route::get('export_pdf', [InventoryController::class, 'export_pdf']);
    });
});
