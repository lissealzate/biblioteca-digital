<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('nacionalidad', 100)->nullable();
            $table->text('biografia')->nullable();
            $table->text('foto')->nullable();
            $table->string('url', 255)->nullable();
            $table->jsonb('redes_sociales')->nullable();
            $table->string('pais', 100)->nullable();

            $table->index(['apellido', 'nombre'], 'idx_autores_apellido');
        });

        DB::statement("ALTER TABLE autores ADD CONSTRAINT ck_autores_redes_objeto
            CHECK (redes_sociales IS NULL OR jsonb_typeof(redes_sociales) = 'object')");
    }

    public function down(): void
    {
        Schema::dropIfExists('autores');
    }
};
