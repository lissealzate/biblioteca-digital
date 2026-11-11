<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
 
class Usuario extends Model
{
    protected $table = 'usuarios';
 
    public $timestamps = false;
 
    protected $fillable = [
        'nombre', 'email', 'telefono', 'fecha_registro',
        'estado', 'foto', 'contactos_redes',
    ];
 
    protected $casts = [
        'contactos_redes' => 'array',
    ];
 
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class, 'usuario_id');
    }
}