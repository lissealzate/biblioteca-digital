<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLibroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $libroId = $this->route('id');

        return [
            'titulo' => 'sometimes|required|string|max:250',

            'isbn' => [
                'sometimes',
                'required',
                'string',
                'max:30',
                Rule::unique('libros', 'isbn')->ignore($libroId),
            ],

            'anio_publicacion' => 'sometimes|nullable|integer|min:1000|max:2100',
            'numero_paginas' => 'sometimes|nullable|integer|min:1',
            'descripcion' => 'sometimes|nullable|string',
            'stock_disponible' => 'sometimes|required|integer|min:0',
            'costo' => 'sometimes|nullable|numeric|min:0',
            'foto' => 'sometimes|nullable|string',
            'autores' => 'sometimes|array',
            'autores.*' => 'integer|exists:autores,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'El título del libro es obligatorio.',
            'isbn.required' => 'El ISBN es obligatorio.',
            'isbn.unique' => 'Este ISBN ya está registrado en otro libro.',
            'stock_disponible.required' => 'Debe indicar el stock disponible.',
            'autores.*.exists' => 'Uno de los autores seleccionados no existe.',
        ];
    }
}
