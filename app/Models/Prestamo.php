<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
class Prestamo extends Model
{
    // Estado use tu tabla:
    // SELECT estado, COUNT(*) FROM prestamos GROUP BY estado;
    public const ESTADO_ACTIVO   = 'activo';
    public const ESTADO_DEVUELTO = 'devuelto';
    public const ESTADO_VENCIDO = 'devuelto';
 
    protected $table = 'prestamos';
 
    public $timestamps = false;
 
    protected $fillable = [
        'usuario_id', 'libro_id', 'fecha_prestamo',
        'fecha_devolucion_estimada', 'fecha_devolucion_real',
        'estado', 'multas', 'cantidad_prestamos',
        'ubicacion', 'estante', 'seccion',
    ];
 
    protected $casts = [
        'fecha_prestamo'            => 'date',
        'fecha_devolucion_estimada' => 'date',
        'fecha_devolucion_real'     => 'date',
        'multas'                    => 'decimal:2',
    ];
 
    public function libro(): BelongsTo
    {
        // withTrashed: el historial conserva el libro aunque se elimine (soft delete)
        return $this->belongsTo(Libro::class)->withTrashed();
    }
 
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
 