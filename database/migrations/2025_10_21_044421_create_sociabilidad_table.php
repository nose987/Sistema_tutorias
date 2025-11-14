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
        Schema::create('sociabilidad', function (Blueprint $table) {
            $table->integer('pk_sociabilidad', true);
            $table->integer('fk_alumno')->nullable();
            $table->text('relacion_padres')->nullable()->comment('¿Qué tal te llevas con tus padres?');
            $table->text('relacion_hermanos')->nullable()->comment('¿Y con tus hermanos?');
            $table->boolean('gusta_tiempo_familia')->nullable()->comment('¿Te gusta pasar tiempo con la familia?');
            $table->boolean('agusto_en_casa')->nullable()->comment('¿Te sientes a gusto en casa?');
            $table->boolean('comprendido_familia')->nullable()->comment('¿Te sientes comprendido por tus padres y hermanos?');
            $table->boolean('tiene_buenos_amigos')->nullable()->comment('¿Tienes buenos amigos?');
            $table->text('confia_amigos_detalle')->nullable()->comment('¿Confías en ellos? ¿Qué es lo que te hace confiar o no?');
            $table->enum('preferencia_tiempo_libre', ['amigos', 'solo'])->nullable()->comment('¿Pasas más tiempo con ellos o prefieres pasar más tiempo sólo?');
            $table->text('preocupacion_amigos')->nullable()->comment('¿Qué es lo que más te preocupa de tu relación con los amigos?');
            $table->boolean('agusto_companeros_clase')->nullable()->comment('¿Te encuentras a gusto con tus compañeros de clase?');
            $table->text('integrado_clase_porque')->nullable()->comment('¿Crees que estas integrado/a? ¿Por qué?');
            $table->text('normas_clase_respetan_detalle')->nullable()->comment('¿Crees que se conocen y respetan las normas? Especifica');
            $table->text('enemistad_clase_motivo')->nullable()->comment('¿Hay alguien con quien te lleves mal? ¿Cuál crees que sea el motivo?');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sociabilidad');
    }
};
