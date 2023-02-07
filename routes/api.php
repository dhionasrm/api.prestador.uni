<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestadorController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/ListaPrestador', [PrestadorController::class, 'ListaPrestador']);
});