<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 250);
            $table->string('isbn', 30)->unique();
            $table->integer('anio_publicacion')->nullable();
            $table->integer('numero_paginas')->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('stock_disponible')->default(0);
            $table->decimal('costo', 12, 2)->nullable();
            $table->text('foto')->nullable();

            $table->index('titulo', 'idx_libros_titulo');
        });

        DB::statement('ALTER TABLE libros ADD CONSTRAINT ck_libros_paginas CHECK (numero_paginas > 0)');
        DB::statement('ALTER TABLE libros ADD CONSTRAINT ck_libros_stock CHECK (stock_disponible >= 0)');
        DB::statement('ALTER TABLE libros ADD CONSTRAINT ck_libros_costo CHECK (costo >= 0)');
    }

    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
