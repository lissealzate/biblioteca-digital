<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrestamoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'libro_id' => $this->libro_id,
            'fecha_prestamo' => $this->fecha_prestamo,
            'fecha_devolucion_estimada' => $this->fecha_devolucion_estimada,
            'fecha_devolucion_real' => $this->fecha_devolucion_real,
            'estado' => $this->estado,
            'multas' => $this->multas,
            'ubicacion' => $this->ubicacion,
            'estante' => $this->estante,
            'seccion' => $this->seccion,
            'created_at' => $this->created_at,
        ];
    }
}