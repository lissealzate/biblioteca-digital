<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Libro extends Model

{
    use SoftDeletes;

    protected $table = 'libros';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'isbn',
        'anio_publicacion',
        'numero_paginas',
        'descripcion',
        'stock_disponible',
        'costo',
        'foto',
    ];

    protected function casts(): array
    {
        return [
            'anio_publicacion' => 'integer',
            'numero_paginas' => 'integer',
            'stock_disponible' => 'integer',
            'costo' => 'decimal:2',
        ];
    }

    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(
            Autor::class,
            'autor_libro',
            'libro_id',
            'autor_id'
        )
        ->using(LibroAutor::class)
        ->withPivot('orden_autor')
        ->orderByPivot('orden_autor');
    }

    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class, 'libro_id');
    }

    // 1. Libros disponibles
    public function scopeDisponibles(Builder $query): Builder
    {
        return $query->where('stock_disponible', '>', 0);
    }

    // 2. Libros por año de publicación
    public function scopePorAnio(
        Builder $query,
        int $anio
    ): Builder {
        return $query->where('anio_publicacion', $anio);
    }

    // 3. Libros por autor
    public function scopePorAutor(
        Builder $query,
        int $autorId
    ): Builder {
        return $query->whereHas(
            'autores',
            fn (Builder $consulta) =>
                $consulta->where('autores.id', $autorId)
        );
    }

    // Accessor: título en mayúsculas
    protected function tituloMayusculas(): Attribute
    {
        return Attribute::make(
            get: fn () => strtoupper($this->titulo)
        );
    }
}
