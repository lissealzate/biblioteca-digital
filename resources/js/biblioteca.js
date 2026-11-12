const API_URL = '/api';

// Token opcional: solo se usa para rutas protegidas (crear préstamos, etc.)
const API_TOKEN = localStorage.getItem('biblioteca_token');

// Función general para consumir la API
async function consumirAPI(endpoint, opciones = {}) {

    const headers = {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        ...opciones.headers
    };

    if (API_TOKEN) {
        headers['Authorization'] = `Bearer ${API_TOKEN}`;
    }

    const respuesta = await fetch(API_URL + endpoint, {
        ...opciones,
        headers
    });

    const resultado = await respuesta.json();

    if (!respuesta.ok) {
        throw new Error(resultado.message || 'Error al consultar la API');
    }

    return resultado;
}


// Obtener libros
async function cargarLibros(titulo = '') {

    try {

        const parametros = new URLSearchParams({
            per_page: 100
        });

        if (titulo.trim() !== '') {
            parametros.append('titulo', titulo);
        }

        const resultado = await consumirAPI(
            `/libros?${parametros.toString()}`
        );

        const libros = resultado.data || [];

        mostrarLibros(libros);

        document.getElementById('totalLibros').textContent =
            resultado.total ?? libros.length;

        document.getElementById('librosDisponibles').textContent =
            libros.filter(libro =>
                Number(libro.stock_disponible) > 0
            ).length;

        return libros;

    } catch (error) {

        document.getElementById('mensajeLibros').textContent =
            error.message;

        document.getElementById('mensajeLibros').className = 'error';

        return [];
    }
}


// Mostrar libros en la tabla
function mostrarLibros(libros) {

    const tabla = document.getElementById('tablaLibros');

    tabla.innerHTML = '';

    libros.forEach(libro => {

        const fila = document.createElement('tr');

        [
            libro.id,
            libro.titulo,
            libro.isbn,
            libro.anio_publicacion,
            libro.stock_disponible,
            libro.costo
        ].forEach(valor => {

            const celda = document.createElement('td');

            celda.textContent = valor ?? '';

            fila.appendChild(celda);
        });

        tabla.appendChild(fila);
    });

    llenarSelectLibros(libros);
}


// Llenar el selector de libros
function llenarSelectLibros(libros) {

    const select = document.getElementById('libro_id');

    const valorAnterior = select.value;

    select.innerHTML =
        '<option value="">Seleccione un libro</option>';

    libros
        .filter(libro => Number(libro.stock_disponible) > 0)
        .forEach(libro => {

            const opcion = document.createElement('option');

            opcion.value = libro.id;
            opcion.textContent = libro.titulo;

            select.appendChild(opcion);
        });

    select.value = valorAnterior;
}


// Búsqueda en tiempo real
document.getElementById('buscarLibro')
    .addEventListener('input', function () {

        cargarLibros(this.value);
    });


// Registrar préstamo
document.getElementById('formPrestamo')
    .addEventListener('submit', async function (event) {

        event.preventDefault();

        const usuarioId = document.getElementById('usuario_id').value;
        const libroId = document.getElementById('libro_id').value;

        const mensaje = document.getElementById('mensajePrestamo');

        mensaje.textContent = '';

        // Validación del lado del cliente
        if (!usuarioId || Number(usuarioId) <= 0) {
            mensaje.textContent = 'Ingrese un ID de usuario válido.';
            mensaje.className = 'error';
            return;
        }

        if (!libroId) {
            mensaje.textContent = 'Seleccione un libro.';
            mensaje.className = 'error';
            return;
        }

        try {

            const resultado = await consumirAPI('/prestamos', {

                method: 'POST',

                body: JSON.stringify({
                    usuario_id: Number(usuarioId),
                    libro_id: Number(libroId)
                })

            });

            mensaje.textContent =
                resultado.message || 'Préstamo registrado correctamente.';

            mensaje.className = 'exito';

            this.reset();

            await cargarLibros();

            await cargarDashboard();

        } catch (error) {

            mensaje.textContent = error.message;
            mensaje.className = 'error';

        }

    });


// Consultar estadísticas
async function cargarDashboard() {

    try {

        const [respuestaLibros, respuestaPrestamos] =
            await Promise.all([

                consumirAPI('/libros?per_page=100'),

                consumirAPI('/prestamos')

            ]);

        const libros = respuestaLibros.data || [];

        const prestamosData = respuestaPrestamos.data;

        const prestamos = Array.isArray(prestamosData)
            ? prestamosData
            : (prestamosData?.data || []);

        // Total de libros registrados
        document.getElementById('totalLibros').textContent =
            respuestaLibros.total ?? libros.length;

        // Libros con existencias
        const disponibles = libros.filter(libro =>
            Number(libro.stock_disponible) > 0
        ).length;

        document.getElementById('librosDisponibles').textContent =
            disponibles;

        // Préstamos activos
        const activos = prestamos.filter(prestamo =>
            prestamo.estado === 'activo'
        ).length;

        document.getElementById('prestamosActivos').textContent =
            activos;

    } catch (error) {

        console.error('Error cargando dashboard:', error);

    }
}


// Inicializar página
document.addEventListener('DOMContentLoaded', function () {

    cargarLibros();

    cargarDashboard();

});