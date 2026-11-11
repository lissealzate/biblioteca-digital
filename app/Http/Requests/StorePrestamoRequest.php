<?php
 
namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
 
class StorePrestamoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
 
    public function rules(): array
    {
        return [
            // Si prestamos.usuario_id apunta a "users" en vez de "usuarios", cambia la tabla
            'usuario_id' => ['required', 'integer', 'exists:usuarios,id'],
            'libro_id'   => ['required', 'integer',
                             Rule::exists('libros', 'id')->whereNull('deleted_at')],
            'fecha_devolucion_estimada' => ['nullable', 'date', 'after:today'],
            'ubicacion'  => ['nullable', 'string', 'max:255'],
            'estante'    => ['nullable', 'string', 'max:255'],
            'seccion'    => ['nullable', 'string', 'max:255'],
        ];
    }
}
 