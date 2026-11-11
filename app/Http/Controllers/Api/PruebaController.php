<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $data = [
            ['id' => 1, 'nombre' => 'Proyecto Laravel'],
            ['id' => 2, 'nombre' => 'Respuestas estandarizadas']
        ];

        return $this->success($data, 'Lista obtenida con éxito', 200);
    }
}