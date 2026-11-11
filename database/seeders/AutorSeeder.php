<?php

namespace Database\Seeders;

use App\Models\Autor;
use Illuminate\Database\Seeder;

class AutorSeeder extends Seeder
{
    public function run(): void
    {
        // [nombre, apellido, fecha_nacimiento, nacionalidad, país, biografía, slug]
        // Sin id: la base de datos lo asigna sola (1 a 10)
        $autores = [
            ['Gabriel', 'García Márquez', '1927-03-06', 'Colombiana', 'Colombia', 'Escritor y periodista colombiano, referente del realismo mágico.', 'gabrielgarciamarquez'],
            ['Isabel', 'Allende', '1942-08-02', 'Chilena', 'Chile', 'Novelista chilena, una de las autoras más leídas en español.', 'isabelallende'],
            ['Jorge Luis', 'Borges', '1899-08-24', 'Argentina', 'Argentina', 'Escritor argentino de cuentos, poemas y ensayos.', 'jorgeluisborges'],
            ['Julio', 'Cortázar', '1914-08-26', 'Argentina', 'Argentina', 'Escritor y traductor, maestro del cuento y la novela experimental.', 'juliocortazar'],
            ['Mario', 'Vargas Llosa', '1936-03-28', 'Peruana', 'Perú', 'Novelista, ensayista y premio Nobel de Literatura 2010.', 'mariovargasllosa'],
            ['Pablo', 'Neruda', '1904-07-12', 'Chilena', 'Chile', 'Poeta chileno y premio Nobel de Literatura 1971.', 'pabloneruda'],
            ['Laura', 'Restrepo', '1950-04-30', 'Colombiana', 'Colombia', 'Novelista y periodista colombiana.', 'laurarestrepo'],
            ['Octavio', 'Paz', '1914-03-31', 'Mexicana', 'México', 'Poeta y ensayista mexicano, premio Nobel de Literatura 1990.', 'octaviopaz'],
            ['Héctor', 'Abad Faciolince', '1958-07-12', 'Colombiana', 'Colombia', 'Escritor y periodista colombiano, autor de El olvido que seremos.', 'hectorabad'],
            ['Roberto', 'Bolaño', '1953-04-28', 'Chilena', 'Chile', 'Novelista y poeta chileno, autor de Los detectives salvajes.', 'robertobolano'],
        ];

           

        foreach ($autores as [$nombre, $apellido, $nac, $nacionalidad, $pais, $bio, $slug]) {
            Autor::create([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'fecha_nacimiento' => $nac,
                'nacionalidad' => $nacionalidad,
                'biografia' => $bio,
                'foto' => "https://example.com/fotos/autores/{$slug}.jpg",
                'url' => "https://example.com/autores/{$slug}",
                'redes_sociales' => [
                    'instagram' => "https://instagram.com/{$slug}",
                    'x' => "https://x.com/{$slug}",
                ],
                'pais' => $pais,
            ]);
        }
    }
}