<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){
    Route::post('/login', [AuthController::class, 'auth']);

    Route::middleware('auth:sanctum')->group(function(){
        Route::post('/logout',[AuthController::class, 'logout']);
    });
    Route::middleware(['auth:sanctum', 'abilities:customer-token'])->group(function(){
        Route::post('/transfer', [TransactionController::class, 'create']);
    });
});