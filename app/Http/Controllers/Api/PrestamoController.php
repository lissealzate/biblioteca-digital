<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrestamoRequest;
use App\Http\Resources\PrestamoResource;
use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
 
class PrestamoController extends Controller
{
    /** GET /api/prestamos?estado=&per_page= -> con libro y usuario */
    public function index(Request $request)
    {
        //Se valida los datos de entrada
        $request->validate([
            'estado'   => ['nullable', 'string'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);
 
        $prestamos = Prestamo::with(['libro', 'usuario'])
            ->when($request->filled('estado'), fn ($q) => $q->where('estado', $request->estado))
            ->orderByDesc('fecha_prestamo')
            ->paginate($request->input('per_page', 15))
            ->withQueryString();
 
        return PrestamoResource::collection($prestamos);
    }
 
    /**Prestamos -> 201 (descuentO stock_disponible) */
    public function store(StorePrestamoRequest $request)
    {
        $prestamo = DB::transaction(function () use ($request) {

            // Validar que el usuario no tenga más de 3 préstamos activos
            $prestamosActivos = Prestamo::where('usuario_id', $request->usuario_id)
                ->where('estado', Prestamo::ESTADO_ACTIVO)->count();

            if ($prestamosActivos >= 3) {
                abort(Response::HTTP_CONFLICT, 'El usuario ya cuenta con el límite máximo de 3 préstamos activos.');
            }  
            // Bloquea la fila del libro para evitar dos préstamos simultáneos del último ejemplar
            $libro = Libro::lockForUpdate()->findOrFail($request->libro_id);
 
            if ($libro->stock_disponible < 1) {
                abort(Response::HTTP_CONFLICT, 'No hay disponiblidad de este libro.');
            }
 
            $libro->decrement('stock_disponible');
 
            return Prestamo::create([
                'usuario_id'                => $request->usuario_id,
                'libro_id'                  => $libro->id,
                'fecha_prestamo'            => now()->toDateString(),
                'fecha_devolucion_estimada' => $request->input(
                    'fecha_devolucion_estimada', now()->addDays(14)->toDateString()
                ),
                'estado'                    => Prestamo::ESTADO_ACTIVO,
                'ubicacion'                 => $request->ubicacion,
                'estante'                   => $request->estante,
                'seccion'                   => $request->seccion,
            ]);
        });
 
        return (new PrestamoResource($prestamo->load(['libro', 'usuario'])))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
 
    /** PUT /api/prestamos/{id}/devolver (devuelve el ejemplar al stock) */
    public function devolver(Prestamo $prestamo)
    {
        if ($prestamo->fecha_devolucion_real !== null) {
            return response()->json(['message' => 'El préstamo ya fue devuelto.'], Response::HTTP_CONFLICT);
        }
 
        DB::transaction(function () use ($prestamo) {
            $prestamo->update([
                'fecha_devolucion_real' => now()->toDateString(),
                'estado'                => Prestamo::ESTADO_DEVUELTO,
            ]);
 
            Libro::withTrashed()->whereKey($prestamo->libro_id)->increment('stock_disponible');
        });
 
        return new PrestamoResource($prestamo->load(['libro', 'usuario']));
    }
}
