<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('autor_libro', 'orden_autor')) {
            Schema::table('autor_libro', function (Blueprint $table) {
                $table->unsignedSmallInteger('orden_autor')->default(1);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('autor_libro', 'orden_autor')) {
            Schema::table('autor_libro', function (Blueprint $table) {
                $table->dropColumn('orden_autor');
            });
        }
    }
};