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
            'created_at' => $this->created_at,
        ];
    }
}