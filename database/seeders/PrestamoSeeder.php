<?php

namespace Database\Seeders;

use App\Models\Prestamo;
use Illuminate\Database\Seeder;

class PrestamoSeeder extends Seeder
{
    public function run(): void
    {
        // [usuario_id, libro_id, días desde el préstamo hasta hoy, plazo en días, estado, multa, cantidad, estante, sección]
        $prestamos = [
            [1, 1, 2, 14, 'activo', 0, 1, 'E-01', 'Literatura'],
            [2, 4, 5, 14, 'activo', 0, 1, 'E-02', 'Literatura'],
            [3, 6, 1, 14, 'activo', 0, 1, 'E-03', 'Cuento'],
            [4, 8, 7, 14, 'activo', 0, 2, 'E-04', 'Novela'],
            [5, 12, 3, 14, 'activo', 0, 1, 'E-05', 'Poesía'],
            [6, 2, 20, 14, 'devuelto', 0, 1, 'E-01', 'Literatura'],
            [7, 10, 30, 14, 'devuelto', 0, 1, 'E-06', 'Novela'],
            [8, 14, 15, 14, 'devuelto', 0, 1, 'E-07', 'Novela'],
            [9, 18, 25, 14, 'vencido', 5500, 1, 'E-08', 'Novela'],
            [10, 3, 40, 14, 'vencido', 13000, 2, 'E-01', 'Literatura'],
        ];

        foreach ($prestamos as [$usuario, $libro, $hace, $plazo, $estado, $multa, $cantidad, $estante, $seccion]) {
            $fechaPrestamo = now()->subDays($hace);

            Prestamo::create([
                'usuario_id' => $usuario,
                'libro_id' => $libro,
                'fecha_prestamo' => $fechaPrestamo->toDateString(),
                'fecha_devolucion_estimada' => $fechaPrestamo->copy()->addDays($plazo)->toDateString(),
                'fecha_devolucion_real' => $estado === 'devuelto'
                    ? $fechaPrestamo->copy()->addDays($plazo - 2)->toDateString()
                    : null,
                'estado' => $estado,
                'multas' => $multa,
                'cantidad_prestamos' => $cantidad,
                'ubicacion' => 'Sede central',
                'estante' => $estante,
                'seccion' => $seccion,
            ]);
        }
    }
}
