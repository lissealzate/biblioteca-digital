    <!-- DASHBOARD -->
    <section class="dashboard">

        <h2>Dashboard</h2>

        <div class="estadisticas">

            <div class="tarjeta">
                <h3>Total de libros</h3>
                <p id="totalLibros">0</p>
            </div>

            <div class="tarjeta">
                <h3>Libros disponibles</h3>
                <p id="librosDisponibles">0</p>
            </div>

            <div class="tarjeta">
                <h3>Préstamos activos</h3>
                <p id="prestamosActivos">0</p>
            </div>

        </div>

    </section>

    <!-- LISTADO DE LIBROS -->
    <section class="seccion">

        <h2>Listado de libros</h2>

        <input
            type="text"
            id="buscarLibro"
            placeholder="Buscar libro por título..."
        >

        <div id="mensajeLibros"></div>

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

            <tbody id="tablaLibros">
            </tbody>
        </table>

    </section>

    <!-- FORMULARIO DE PRÉSTAMO -->
    <section class="seccion">

        <h2>Registrar nuevo préstamo</h2>

        <form id="formPrestamo">

            <label for="usuario_id">ID del usuario</label>

            <input
                type="number"
                id="usuario_id"
                name="usuario_id"
                min="1"
                required
            >

            <label for="libro_id">Seleccionar libro</label>

            <select id="libro_id" name="libro_id" required>
                <option value="">Seleccione un libro</option>
            </select>

            <button type="submit">
                Registrar préstamo
            </button>

        </form>

        <div id="mensajePrestamo"></div>

    </section>


