<?php

use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return ApiResponse::success('API is running');
})->middleware('auth:sanctum');

Route::apiResource('clients', App\Http\Controllers\ClientController::class)->middleware('auth:sanctum');

// auth routes
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');

