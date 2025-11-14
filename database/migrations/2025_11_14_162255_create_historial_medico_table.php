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
        Schema::create('historial_medico', function (Blueprint $table) {
            $table->integer('pk_historial_medico', true);
            $table->integer('fk_alumno')->nullable()->index('fk_alumno');
            $table->boolean('check_alergia')->nullable()->default(false);
            $table->text('alergias')->nullable()->comment('Campo para "Especifica" de Alergia');
            $table->boolean('check_asma')->nullable()->default(false);
            $table->text('asma_especifica')->nullable()->comment('Especifica para Asma');
            $table->boolean('check_cancer')->nullable()->default(false);
            $table->text('cancer_especifica')->nullable()->comment('Especifica para Cáncer');
            $table->boolean('check_diabetes')->nullable()->default(false);
            $table->text('diabetes_especifica')->nullable()->comment('Especifica para Diabetes');
            $table->boolean('check_epilepsia')->nullable()->default(false);
            $table->text('epilepsia_especifica')->nullable()->comment('Especifica para Epilepsia');
            $table->boolean('check_gripa_tos_frecuente')->nullable()->default(false)->comment('Gripa o tos más de 3 veces al año');
            $table->text('gripa_tos_especifica')->nullable()->comment('Especifica para Gripa/Tos Frecuente');
            $table->boolean('check_leucemia')->nullable()->default(false);
            $table->text('leucemia_especifica')->nullable()->comment('Especifica para Leucemia');
            $table->boolean('check_bulimia')->nullable()->default(false);
            $table->text('bulimia_especifica')->nullable()->comment('Especifica para Bulimia');
            $table->boolean('check_crisis_ansiedad')->nullable()->default(false);
            $table->text('crisis_ansiedad_especifica')->nullable()->comment('Especifica para Crisis de Ansiedad');
            $table->boolean('check_migrana')->nullable()->default(false);
            $table->text('migrana_especifica')->nullable()->comment('Especifica para Migraña');
            $table->boolean('check_anorexia')->nullable()->default(false);
            $table->text('anorexia_especifica')->nullable()->comment('Especifica para Anorexia');
            $table->boolean('check_afeccion_corazon')->nullable()->default(false);
            $table->text('afeccion_corazon_especifica')->nullable()->comment('Especifica para Afección Corazón');
            $table->boolean('check_depresion')->nullable()->default(false);
            $table->text('depresion_especifica')->nullable()->comment('Especifica para Depresión');
            $table->text('check_otro_salud')->nullable()->comment('Para el campo ñ) Otro');
            $table->text('otro_salud_especifica')->nullable()->comment('Campo general para "Especifica"');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_medico');
    }
};
