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
        Schema::create('canalizacion', function (Blueprint $table) {
            $table->integer('pk_canalizacion', true);
            $table->integer('fk_alumno')->nullable();
            $table->integer('fk_motivo_canalizacion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_final')->nullable();
            $table->enum('estatus', ['Activa', 'Cerrada'])->nullable()->default('Activa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canalizacion');
    }
};
