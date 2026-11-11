<?php

namespace Database\Seeders;

use App\Models\Libro;
use Illuminate\Database\Seeder;

class LibroSeeder extends Seeder
{
    public function run(): void
    {
        // [título, año, páginas, stock, costo, [ids de autores]]
        // Ids de autores: 1 García Márquez, 2 Allende, 3 Borges, 4 Cortázar, 5 Vargas Llosa,
        // 6 Neruda, 7 Restrepo, 8 Paz, 9 Lispector, 10 Bolaño
        $libros = [
            ['Cien años de soledad', 1967, 471, 5, 45000, [1]],
            ['El amor en los tiempos del cólera', 1985, 368, 4, 42000, [1]],
            ['La casa de los espíritus', 1982, 433, 3, 39000, [2]],
            ['Eva Luna', 1987, 316, 2, 36000, [2]],
            ['Ficciones', 1944, 174, 5, 30000, [3]],
            ['El Aleph', 1949, 160, 4, 29000, [3]],
            ['Rayuela', 1963, 600, 3, 52000, [4]],
            ['Bestiario', 1951, 150, 2, 27000, [4]],
            ['La ciudad y los perros', 1963, 400, 4, 40000, [5]],
            ['Conversación en La Catedral', 1969, 640, 2, 48000, [5]],
            ['Veinte poemas de amor y una canción desesperada', 1924, 80, 8, 20000, [6]],
            ['Canto general', 1950, 450, 3, 38000, [6]],
            ['Delirio', 2004, 340, 3, 37000, [7]],
            ['La novia oscura', 1999, 330, 2, 35000, [7]],
            ['El laberinto de la soledad', 1950, 190, 4, 31000, [8]],
            ['El olvido que seremos', 2006, 280, 5, 36000, [9]],
            ['Los detectives salvajes', 1998, 609, 2, 55000, [10]],
            ['Del amor y otros demonios', 1994, 180, 3, 33000, [1]],
            ['Paula', 1994, 330, 4, 38000, [2]],
            ];

        foreach ($libros as $i => [$titulo, $anio, $paginas, $stock, $costo, $autorIds]) {
            $libro = Libro::create([
                'titulo' => $titulo,
                'isbn' => sprintf('978-958-1000-%02d-%d', $i + 1, $i % 10),
                'anio_publicacion' => $anio,
                'numero_paginas' => $paginas,
                'descripcion' => "Libro de prueba: {$titulo}.",
                'stock_disponible' => $stock,
                'costo' => $costo,
                'foto' => 'https://example.com/fotos/libros/libro' . ($i + 1) . '.jpg',
            ]);

            $libro->autores()->attach($autorIds);
        }
    }
}
