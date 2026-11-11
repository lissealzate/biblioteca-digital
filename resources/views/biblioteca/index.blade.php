<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Digital</title>

    @vite([
        'resources/css/biblioteca.css',
        'resources/js/biblioteca.js'
    ])
</head>

<body>

    <header class="encabezado">
        <h1>Biblioteca Digital</h1>
        <p>Sistema de gestión de libros y préstamos</p>
    </header>

    <main class="contenedor">

        <section class="dashboard">

            <div class="tarjeta">
                <h3>Total de libros</h3>
                <p class="numero" id="totalLibros">0</p>
            </div>

            <div class="tarjeta">
                <h3>Libros disponibles</h3>
                <p class="numero" id="librosDisponibles">0</p>
            </div>

            <div class="tarjeta">
                <h3>Préstamos activos</h3>
                <p class="numero" id="prestamosActivos">0</p>
            </div>

        </section>

        <section class="seccion">

            <h2>Listado de libros</h2>

            <input
                type="search"
                id="buscarLibro"
                placeholder="Buscar libros por título..."
            >

            <div id="mensajeLibros" class="mensaje"></div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>ISBN</th>
                        <th>Año</th>
                        <th>Stock</th>
                        <th>Costo</th>
                    </tr>
                </thead>

                <tbody id="tablaLibros"></tbody>
            </table>

        </section>

        <section class="seccion">

            <h2>Registrar nuevo préstamo</h2>

            <form id="formPrestamo">

                <label for="usuario_id">ID del usuario:</label>

                <input
                    type="number"
                    id="usuario_id"
                    min="1"
                    placeholder="Ingrese el ID del usuario"
                    required
                >

                <label for="libro_id">Seleccionar libro:</label>

                <select id="libro_id" required>
                    <option value="">Seleccione un libro</option>
                </select>

                <button type="submit">
                    Registrar préstamo
                </button>

            </form>

            <div id="mensajePrestamo" class="mensaje"></div>

        </section>

    </main>

</body>
</html>
