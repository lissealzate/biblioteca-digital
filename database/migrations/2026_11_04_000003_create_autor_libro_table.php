
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autor_libro', function (Blueprint $table) {
            $table->foreignId('autor_id')
                ->constrained('autores')
                ->cascadeOnDelete();

            $table->foreignId('libro_id')
                ->constrained('libros')
                ->cascadeOnDelete();

            $table->integer('orden_autor')->default(1);

            $table->primary(['autor_id', 'libro_id']);

            $table->index('libro_id', 'idx_autor_libro_libro');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autor_libro');
    }
};
