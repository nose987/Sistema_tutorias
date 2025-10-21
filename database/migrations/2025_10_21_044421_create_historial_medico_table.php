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
            $table->string('tipo_sangre', 5)->nullable();
            $table->boolean('check_alergia')->nullable()->default(false);
            $table->boolean('check_asma')->nullable()->default(false);
            $table->boolean('check_cancer')->nullable()->default(false);
            $table->boolean('check_diabetes')->nullable()->default(false);
            $table->boolean('check_epilepsia')->nullable()->default(false);
            $table->boolean('check_gripa_tos_frecuente')->nullable()->default(false)->comment('Gripa o tos más de 3 veces al año');
            $table->boolean('check_leucemia')->nullable()->default(false);
            $table->boolean('check_bulimia')->nullable()->default(false);
            $table->boolean('check_crisis_ansiedad')->nullable()->default(false);
            $table->boolean('check_migrana')->nullable()->default(false);
            $table->boolean('check_anorexia')->nullable()->default(false);
            $table->boolean('check_afeccion_corazon')->nullable()->default(false);
            $table->boolean('check_depresion')->nullable()->default(false);
            $table->text('check_otro_salud')->nullable()->comment('Para el campo ñ) Otro');
            $table->text('alergias')->nullable()->comment('Campo para "Especifica" de Alergia');
            $table->text('medicamentos')->nullable();
            $table->text('observaciones')->nullable()->comment('Campo general para "Especifica"');
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
