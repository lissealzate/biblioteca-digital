<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LibroController;
use App\Http\Controllers\Api\PrestamoController;

Route::middleware('auth:sanctum')->group(function () {

    // Rutas para administrar libros
    Route::get('/libros', [LibroController::class, 'index']);
    Route::get('/libros/{id}', [LibroController::class, 'show']);
    Route::post('/libros', [LibroController::class, 'store']);
    Route::put('/libros/{id}', [LibroController::class, 'update']);
    Route::delete('/libros/{id}', [LibroController::class, 'destroy']);

    // Rutas para administrar préstamos
    Route::get('/prestamos', [PrestamoController::class, 'index']);
    Route::post('/prestamos', [PrestamoController::class, 'store']);
    Route::put('/prestamos/{id}/devolver', [PrestamoController::class, 'devolver']);

    // Consultar usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});

use App\Http\Controllers\Api\PruebaController;

Route::get('/prueba', [PruebaController::class, 'index']);