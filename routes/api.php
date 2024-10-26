<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\LoginController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
    Route::prefix('user')->group(function () {
        Route::post('/create', [AuthenticationController::class, 'store']);
        Route::get('/{id}', [AuthenticationController::class, 'index'])->middleware('auth:sanctum');
        Route::put('/update/{id}', [AuthenticationController::class, 'update'])->middleware('auth:sanctum');
        Route::delete('/delete/{id}', [AuthenticationController::class, 'destroy'])->middleware('auth:sanctum');
    });



});
