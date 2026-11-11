<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('email', 100)->unique();
            $table->string('telefono', 30)->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->text('foto')->nullable();
            $table->jsonb('contactos_redes')->nullable();
        });

        DB::statement("ALTER TABLE usuarios ADD CONSTRAINT ck_usuarios_redes_objeto
            CHECK (contactos_redes IS NULL OR jsonb_typeof(contactos_redes) = 'object')");
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
