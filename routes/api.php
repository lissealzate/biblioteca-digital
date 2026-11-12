<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LibroController;
use App\Http\Controllers\Api\PrestamoController;
use App\Http\Controllers\Api\PruebaController;

// Rutas públicas (las usa el dashboard sin login)
Route::get('/libros', [LibroController::class, 'index']);
Route::get('/libros/{id}', [LibroController::class, 'show']);
Route::get('/prestamos', [PrestamoController::class, 'index']);
Route::get('/prueba', [PruebaController::class, 'index']);

// Rutas protegidas (requieren token)
Route::middleware('auth:sanctum')->group(function () {

    // Administrar libros
    Route::post('/libros', [LibroController::class, 'store']);
    Route::put('/libros/{id}', [LibroController::class, 'update']);
    Route::delete('/libros/{id}', [LibroController::class, 'destroy']);

    // Administrar préstamos
    Route::post('/prestamos', [PrestamoController::class, 'store']);
    Route::put('/prestamos/{id}/devolver', [PrestamoController::class, 'devolver']);

    // Usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
}
);