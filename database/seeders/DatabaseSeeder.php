<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // El orden importa por las claves foráneas
        $this->call([
            AutorSeeder::class,     // 10 autores
            LibroSeeder::class,     // 20 libros + relaciones autor_libro
            UsuarioSeeder::class,   // 15 usuarios
            PrestamoSeeder::class,  // 10 préstamos
        ]);
    }
}
