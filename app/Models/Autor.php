<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Autor extends Model
{
    protected $table = 'autores';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'nacionalidad',
        'biografia',
        'foto',
        'url',
        'redes_sociales',
        'pais',

        
    ];
    protected $hidden = ['foto_bin'];
    
    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'redes_sociales' => 'array',
        ];
    }

    
    public function libros(): BelongsToMany
    {
        return $this->belongsToMany(
            Libro::class,
            'autor_libro',
            'autor_id',
            'libro_id'
        )
        ->using(LibroAutor::class)
        ->withPivot('orden_autor')
        ->orderByPivot('orden_autor');
    }

    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn () => trim(
                $this->nombre . ' ' . $this->apellido
            )
        );
    }
}
