<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index(Request $request)
    {
        $consulta = Libro::with('autores');

        if ($request->filled('titulo')) {
            $consulta->where('titulo', 'LIKE', '%' . $request->titulo . '%');
        }

        if ($request->filled('autor')) {
            $consulta->whereHas('autores', function ($query) use ($request) {
                $query->where('nombre', 'LIKE', '%' . $request->autor . '%')
                    ->orWhere('apellido', 'LIKE', '%' . $request->autor . '%');
            });
        }

        if ($request->filled('anio')) {
            $consulta->where('anio_publicacion', $request->anio);
        }

        $perPage = min((int) $request->input('per_page', 10), 100);
        $libros = $consulta->orderBy('id')->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Listado de libros obtenido correctamente.',
            'data' => $libros->items(),
            'total' => $libros->total(),
            'current_page' => $libros->currentPage(),
            'last_page' => $libros->lastPage()
        ], 200);
    }

    public function show(int $id)
    {
        $libro = Libro::with('autores')->find($id);

        if (!$libro) {
            return response()->json([
                'success' => false,
                'message' => 'Libro no encontrado.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Libro encontrado correctamente.',
            'data' => $libro
        ], 200);
    }
}