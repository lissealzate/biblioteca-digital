<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LibroAutor extends Pivot
{
    protected $table = 'autor_libro';

    public $incrementing = false;

    protected $fillable = [
        'autor_id',
        'libro_id',
        'orden_autor',
    ];

    protected function casts(): array
    {
        return [
            'autor_id' => 'integer',
            'libro_id' => 'integer',
            'orden_autor' => 'integer',
        ];
    }
}