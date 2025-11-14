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
        Schema::create('historial_del_alumno', function (Blueprint $table) {
            $table->integer('pk_historial_del_alumno', true);
            $table->integer('fk_alumno')->nullable();
            $table->integer('fk_historial_medico')->nullable();
            $table->enum('estatus', ['Activo', 'Inactivo'])->nullable()->default('Activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_del_alumno');
    }
};
