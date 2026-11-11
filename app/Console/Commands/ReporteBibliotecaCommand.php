<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\Usuario;

class ReporteBibliotecaCommand extends Command
{
    protected $signature = 'biblioteca:reporte';
    protected $description = 'Genera un reporte detallado de libros sin stock, libros más prestados y usuarios con préstamos vencidos.';

    public function handle()
    {
        $this->info('Reporte general de la biblioteca');
        $this->info('Reporte general de la biblioteca');
        $this->info('Reporte general de la biblioteca');

        // Libros que no tienen stock disponible
        $this->warn("\n[1] Libros sin stock disponible (stock_disponible <= 0):");
        $sinStock = Libro::where('stock_disponible', '<=', 0)->get(['id', 'titulo']);

        if ($sinStock->isEmpty()) {
            $this->line(' > No hay libros sin stock actualmente.');
        } else {
            $this->table(['ID', 'Título'], $sinStock->toArray());
        }
        // Libros más prestados
        $this->warn("\n[2] Libros más prestados:");
        $masPrestados = Libro::withCount('prestamos')
            ->orderByDesc('prestamos_count')
            ->limit(5)
            ->get(['id', 'titulo', 'prestamos_count']);

        if ($masPrestados->isEmpty()) {
            $this->line(' > No hay registros de préstamos.');
        } else {
            $this->table(['ID', 'Título', 'Total Préstamos'], $masPrestados->map(fn($l) => [
                $l->id, $l->titulo, $l->prestamos_count
            ])->toArray());
        }
        // Usuarios con préstamos vencidos o activos
        $this->warn("\n[3] Usuarios con préstamos activos/vencidos:");
        $usuariosConPrestamos = Usuario::whereHas('prestamos', function ($query) {
            $query->where('estado', Prestamo::ESTADO_ACTIVO);
        })->get(['id', 'nombre', 'email']);

        if ($usuariosConPrestamos->isEmpty()) {
            $this->line(' > No hay usuarios con préstamos pendientes.');
        } else {
            $this->table(['ID', 'Nombre', 'Correo'], $usuariosConPrestamos->map(fn($u) => [
                $u->id, $u->nombre, $u->email
            ])->toArray());
        }
        $this->info('Reporte general de la biblioteca');
        $this->info('Reporte general de la biblioteca');
        $this->info('Reporte general de la biblioteca');
    }
}