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
        Schema::create('alumno_estadia', function (Blueprint $table) {
            $table->integer('pk_alumno_estadia', true);
            $table->integer('fk_alumno')->nullable()->index('fk_alumno');
            $table->integer('fk_empresa')->nullable()->index('fk_empresa_estadia');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_final')->nullable();
            $table->enum('estatus', ['En curso', 'Finalizada'])->nullable()->default('En curso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_estadia');
    }
};
