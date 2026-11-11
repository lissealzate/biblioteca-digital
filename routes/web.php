<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BibliotecaWebController;

Route::get('/biblioteca', [BibliotecaWebController::class, 'index'])
    ->name('biblioteca.index');
