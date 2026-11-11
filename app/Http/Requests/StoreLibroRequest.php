<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLibroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:250',
            'isbn' => 'required|string|max:30|unique:libros,isbn',
            'anio_publicacion' => 'nullable|integer|min:1000|max:2100',
            'numero_paginas' => 'nullable|integer|min:1',
            'descripcion' => 'nullable|string',
            'stock_disponible' => 'required|integer|min:0',
            'costo' => 'nullable|numeric|min:0',
            'foto' => 'nullable|string',
            'autores' => 'sometimes|array',
            'autores.*' => 'integer|exists:autores,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'El título del libro es obligatorio.',
            'isbn.required' => 'El ISBN es obligatorio.',
            'isbn.unique' => 'Este ISBN ya está registrado.',
            'stock_disponible.required' => 'Debe indicar el stock disponible.',
            'stock_disponible.min' => 'El stock disponible no puede ser negativo.',
            'autores.*.exists' => 'Uno de los autores seleccionados no existe.',
        ];
    }
}
