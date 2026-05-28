<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('resultados_aprendizaje', function (Blueprint $table) {
            $table->decimal('peso_porcentaje', 5, 2)
                  ->after('descripcion')
                  ->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resultados_aprendizaje', function (Blueprint $table) {
            $table->dropColumn('peso_porcentaje');
        });
    }
};
