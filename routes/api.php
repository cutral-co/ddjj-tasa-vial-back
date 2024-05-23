<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeclaracionJuradaController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('dj/mis_ddjj', [DeclaracionJuradaController::class, 'mis_ddjj']);
    Route::resource('dj', DeclaracionJuradaController::class);

    Route::post('refresh', [AuthController::class, 'refresh']);
});
