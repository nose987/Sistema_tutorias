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
        Schema::create('informacion_extra', function (Blueprint $table) {
            $table->integer('pk_informacion_extra', true);
            $table->integer('fk_alumno')->nullable()->index('fk_alumno');
            $table->text('datos_adicionales')->nullable()->comment('Respuesta a la sección 7');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion_extra');
    }
};
