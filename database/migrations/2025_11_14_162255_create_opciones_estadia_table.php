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
        Schema::create('opciones_estadia', function (Blueprint $table) {
            $table->integer('pk_opcion_estadia', true);
            $table->integer('fk_alumno')->index('opciones_estadia_fk_alumno_idx');
            $table->integer('fk_empresa')->index('opciones_estadia_fk_empresa_idx');
            $table->tinyInteger('opcion_numero')->comment('Para guardar si es la opción 1, 2 o 3');
            $table->enum('estatus', ['Pendiente', 'Contactado', 'No Contactado', 'Aceptado', 'Rechazado'])->default('Pendiente');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opciones_estadia');
    }
};
