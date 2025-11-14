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
        Schema::create('potencial_aprendizaje', function (Blueprint $table) {
            $table->integer('pk_potencial_aprendizaje', true);
            $table->integer('fk_alumno')->nullable()->index('fk_alumno');
            $table->text('aspectos_propician_y_dificultan_aprendizaje')->nullable()->comment('Aspectos que propician y dificultan tu aprendizaje');
            $table->text('razones_para_estudiar')->nullable()->comment('¿Cuáles son tus razones para estudiar?');
            $table->boolean('clima_clase_permite_aprender')->nullable()->comment('¿Crees que en tu clase hay un clima que permite aprender?');
            $table->text('clima_clase_especifica')->nullable()->comment('Especifica sobre el clima de clase');
            $table->boolean('contento_profesores_general')->nullable()->comment('¿Estas contento/a con tus profesores en general?');
            $table->text('opinion_familia_estudios')->nullable()->comment('¿Qué piensan en tu casa de que estés estudiando?');
            $table->boolean('apoyo_padres_estudiar')->nullable()->comment('¿Tus padres te apoyan para seguir estudiando?');
            $table->string('actividad_paraescolar_cual', 150)->nullable()->comment('¿Asistes a alguna actividad paraescolar?	¿Cuál?');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potencial_aprendizaje');
    }
};
