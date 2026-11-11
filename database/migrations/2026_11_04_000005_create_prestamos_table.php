<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->restrictOnDelete();
            $table->foreignId('libro_id')->constrained('libros')->restrictOnDelete();
            $table->date('fecha_prestamo')->useCurrent();
            $table->date('fecha_devolucion_estimada');
            $table->date('fecha_devolucion_real')->nullable();
            $table->enum('estado', ['activo', 'devuelto', 'vencido'])->default('activo');
            $table->decimal('multas', 10, 2)->default(0);
            $table->integer('cantidad_prestamos')->default(1);
            $table->string('ubicacion', 100)->nullable();
            $table->string('estante', 50)->nullable();
            $table->string('seccion', 100)->nullable();

            $table->index('usuario_id', 'idx_prestamos_usuario');
            $table->index('libro_id', 'idx_prestamos_libro');
        });

        DB::statement('ALTER TABLE prestamos ADD CONSTRAINT ck_prestamos_multas CHECK (multas >= 0)');
        DB::statement('ALTER TABLE prestamos ADD CONSTRAINT ck_prestamos_cantidad CHECK (cantidad_prestamos > 0)');
        DB::statement('ALTER TABLE prestamos ADD CONSTRAINT ck_prestamos_fecha_est
            CHECK (fecha_devolucion_estimada >= fecha_prestamo)');
        DB::statement('ALTER TABLE prestamos ADD CONSTRAINT ck_prestamos_fecha_real
            CHECK (fecha_devolucion_real IS NULL OR fecha_devolucion_real >= fecha_prestamo)');
    }

    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
