<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Container\Attributes\Authenticated;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/{id}', [AuthenticationController::class, 'index']);
        Route::post('/create', [AuthenticationController::class, 'store']);
        Route::get('/update', [AuthenticationController::class, 'store']);
    });
});
