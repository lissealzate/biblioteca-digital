<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $nombres = [
            'Ana Pérez', 'Carlos Gómez', 'María Rodríguez', 'Juan Martínez', 'Laura Hernández',
            'Andrés López', 'Camila Torres', 'Santiago Ramírez', 'Valentina Castro', 'Daniel Ruiz',
            'Sofía Mejía', 'Felipe Ortiz', 'Paula Jiménez', 'Mateo Vargas', 'Isabella Cárdenas',
        ];
        $correos = [
            'ana.perez', 'carlos.gomez', 'maria.rodriguez', 'juan.martinez', 'laura.hernandez',
            'andres.lopez', 'camila.torres', 'santiago.ramirez', 'valentina.castro', 'daniel.ruiz',
            'sofia.mejia', 'felipe.ortiz', 'paula.jimenez', 'mateo.vargas', 'isabella.cardenas',
        ];

        foreach ($nombres as $i => $nombre) {
            Usuario::create([
                'nombre' => $nombre,
                'email' => $correos[$i] . '@correo.com',
                'telefono' => '30012345' . str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT),
                'fecha_registro' => now()->subDays(100 - $i * 5),
                'estado' => in_array($i, [11, 14]) ? 'inactivo' : 'activo', // 2 inactivos
                'foto' => 'https://example.com/fotos/usuarios/usuario' . ($i + 1) . '.jpg',
                'contactos_redes' => [
                    'instagram' => 'https://instagram.com/' . $correos[$i],
                    'facebook' => 'https://facebook.com/' . $correos[$i],
                ],
            ]);
        }
    }
}
