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
        Schema::create('actividad', function (Blueprint $table) {
            $table->integer('pk_actividad', true);
            $table->integer('fk_tipo_actividad')->nullable()->index('fk_tipo_actividad');
            $table->string('nombre', 150)->nullable();
            $table->date('fecha')->nullable();
            $table->enum('estatus', ['Pendiente', 'Realizada'])->nullable()->default('Pendiente');
            $table->integer('asistencia')->nullable()->comment('Cantidad de asistentes a la actividad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividad');
    }
};
