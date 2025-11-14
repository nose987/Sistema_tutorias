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
        Schema::create('antecedentes_escolares', function (Blueprint $table) {
            $table->integer('pk_antecedentes_escolares', true);
            $table->integer('fk_alumno')->nullable()->index('fk_alumno');
            $table->string('institucion_preparatoria', 100)->nullable()->comment('Institución en la que cursó Preparatoria');
            $table->decimal('promedio', 4)->nullable();
            $table->string('ciclo_preparatoria', 100)->nullable()->comment('Ciclo de preparatoria');
            $table->boolean('estudio_universidad_anterior')->nullable()->default(false)->comment('0=No, 1=Sí');
            $table->string('universidad_anterior_nombre', 150)->nullable();
            $table->string('universidad_anterior_carrera', 150)->nullable();
            $table->string('universidad_anterior_tiempo', 100)->nullable()->comment('¿Hace cuánto tiempo?');
            $table->text('universidad_anterior_motivo_salida')->nullable()->comment('Motivo por el que ya no siguió estudiando ahí');
            $table->text('rendimiento_cuatris_anteriores')->nullable()->comment('¿Cómo te ha ido en los cuatrimestres anteriores?');
            $table->boolean('perdio_cuatrimestre')->nullable()->default(false)->comment('¿Has perdido algún cuatrimestre?');
            $table->text('perdio_cuatrimestre_causa')->nullable()->comment('Causa de la pérdida y materia');
            $table->text('rendimiento_cuatri_actual')->nullable()->comment('¿Cómo te va este cuatrimestre?');
            $table->boolean('necesita_apoyo_extra')->nullable()->default(false)->comment('¿Has necesitado apoyo extra en alguna clase?');
            $table->text('necesita_apoyo_extra_materia')->nullable()->comment('¿Cuál?');
            $table->enum('atribucion_aprobacion', ['esfuerzo', 'suerte', 'habilidad'])->nullable()->comment('Cuando apruebas...');
            $table->enum('atribucion_suspension', ['falta_esfuerzo', 'mala_suerte', 'dificultad'])->nullable()->comment('Cuando suspendes...');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes_escolares');
    }
};
