<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema de Biblioteca</title>

    @vite(['resources/css/biblioteca.css',
        'resources/js/biblioteca.js'])
</head>

<body>

    <header class="encabezado">
        <h1>Biblioteca Digital</h1>
        <p>Sistema de gestión de libros y préstamos</p>
    </header>

    <main class="contenedor">
        @yield('contenido')
    </main>

</body>
</html>
