<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\UserController;

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

    Route::prefix('user')->group(function() {
        Route::post('update_token', [UserController::class, 'update_token']);
    });
});
