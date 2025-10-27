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
        Schema::create('bajas', function (Blueprint $table) {
            $table->integer('pk_bajas', true);
            $table->integer('fk_alumno')->nullable()->index('fk_alumno');
            $table->integer('fk_motivo_baja')->nullable()->index('fk_motivo_baja');
            $table->date('fecha')->nullable();
            $table->enum('estatus', ['Activa', 'Cerrada'])->nullable()->default('Activa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bajas');
    }
};
