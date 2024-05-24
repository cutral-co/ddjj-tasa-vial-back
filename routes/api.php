<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{AuthController, DeclaracionJuradaController, DerivadoController};

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('dj/mis_ddjj', [DeclaracionJuradaController::class, 'mis_ddjj']);

    Route::post('dj/update', [DeclaracionJuradaController::class, 'update']);
    Route::resource('dj', DeclaracionJuradaController::class)->except(['update']);

    Route::resource('derivado', DerivadoController::class)->except(['update']);

    Route::post('refresh', [AuthController::class, 'refresh']);
});
