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
        Schema::create('canalizacion_seguimiento', function (Blueprint $table) {
            $table->integer('pk_canalizacion_seguimiento', true);
            $table->integer('fk_formato_canalizacion')->index('seguimiento_to_canalizacion_fk');
            $table->date('fecha_seguimiento')->nullable()->comment('Fecha de seguimiento (Página 2)');
            $table->string('modalidad_seguimiento')->nullable()->comment('Modalidad (Página 2)');
            $table->string('responsable_atencion')->nullable()->comment('Responsable(s) de la Atención');
            $table->text('diagnostico_otorgado')->nullable()->comment('Diagnóstico otorgado');
            $table->text('seguimiento_tutorias')->nullable()->comment('Seguimiento de TUTORÍAS');
            $table->text('seguimiento_medico')->nullable()->comment('Seguimiento de MÉDICO');
            $table->text('seguimiento_psicologo')->nullable()->comment('Seguimiento de PSICÓLOGO');
            $table->text('seguimiento_trabajo_social')->nullable()->comment('Seguimiento de TRABAJO SOCIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canalizacion_seguimiento');
    }
};
