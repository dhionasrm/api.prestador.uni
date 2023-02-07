<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestadorController;
use App\Models\RedeBrasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user',  function (Request $request) {
    return $request->user();
});

Route::get('/login', [AuthController::class, 'login']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/ListaPrestador', [PrestadorController::class, 'ListaPrestador']);
});
