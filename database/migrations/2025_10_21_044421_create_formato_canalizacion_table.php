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
        Schema::create('formato_canalizacion', function (Blueprint $table) {
            $table->integer('pk_formato_canalizacion', true);
            $table->integer('fk_alumno')->nullable();
            $table->date('fecha_canalizacion')->nullable();
            $table->string('tutor_nombre')->nullable()->comment('Nombre del Tutor(a)');
            $table->string('carrera', 150)->nullable()->comment('Carrera del alumno');
            $table->boolean('motivo_reprobacion')->default(false);
            $table->boolean('motivo_constantes_faltas')->default(false);
            $table->boolean('motivo_no_participa')->default(false);
            $table->boolean('motivo_no_entrega_actividades')->default(false);
            $table->boolean('motivo_dificultad_asignatura')->default(false);
            $table->boolean('motivo_inasistencia_distancia')->default(false);
            $table->boolean('motivo_inasistencia_transporte')->default(false);
            $table->boolean('motivo_inasistencia_enfermedad')->default(false);
            $table->boolean('motivo_inasistencia_familiar')->default(false);
            $table->boolean('motivo_inasistencia_personal')->default(false);
            $table->boolean('motivo_salud_dolor_cabeza')->default(false);
            $table->boolean('motivo_salud_dolor_estomago')->default(false);
            $table->boolean('motivo_salud_dolor_muscular')->default(false);
            $table->boolean('motivo_salud_respiratorios')->default(false);
            $table->boolean('motivo_salud_vertigo')->default(false);
            $table->boolean('motivo_salud_vomito')->default(false);
            $table->boolean('motivo_adiccion_ojos_rojos')->default(false);
            $table->boolean('motivo_adiccion_somnolencia')->default(false);
            $table->boolean('motivo_adiccion_aliento_alcoholico')->default(false);
            $table->boolean('motivo_comportamiento_agresivo')->default(false);
            $table->boolean('motivo_comportamiento_indisciplina')->default(false);
            $table->boolean('motivo_comportamiento_desafiante')->default(false);
            $table->boolean('motivo_comportamiento_irrespetuoso')->default(false);
            $table->boolean('motivo_comportamiento_desinteres')->default(false);
            $table->boolean('motivo_estres_frustracion')->default(false);
            $table->boolean('motivo_estres_desmotivacion')->default(false);
            $table->boolean('motivo_estres_cansancio')->default(false);
            $table->boolean('motivo_estres_hiperactividad')->default(false);
            $table->boolean('motivo_estres_ansiedad')->default(false);
            $table->boolean('motivo_socioeconomico_matrimonio')->default(false);
            $table->boolean('motivo_socioeconomico_embarazo')->default(false);
            $table->boolean('motivo_socioeconomico_no_desea_estudiar')->default(false);
            $table->boolean('motivo_socioeconomico_decidio_trabajar')->default(false);
            $table->boolean('motivo_socioeconomico_horario_laboral')->default(false);
            $table->boolean('motivo_socioeconomico_pago_mensualidades')->default(false);
            $table->boolean('motivo_socioeconomico_transporte')->default(false);
            $table->boolean('motivo_socioeconomico_manutencion')->default(false);
            $table->boolean('motivo_faltas_ebrio')->default(false);
            $table->boolean('motivo_faltas_drogado')->default(false);
            $table->boolean('motivo_faltas_vandalismo')->default(false);
            $table->boolean('motivo_faltas_porta_armas_drogas')->default(false);
            $table->text('motivo_otros')->nullable()->comment('Otros (especifique)');
            $table->text('observaciones_tutor')->nullable()->comment('OBSERVACIONES POR TUTOR');
            $table->text('acciones_tutor')->nullable()->comment('ACCIONES APLICADAS POR EL TUTOR');
            $table->enum('estatus', ['Pendiente', 'Completado'])->nullable()->default('Pendiente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formato_canalizacion');
    }
};
