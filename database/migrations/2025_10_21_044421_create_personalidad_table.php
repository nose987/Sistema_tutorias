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
        Schema::create('personalidad', function (Blueprint $table) {
            $table->integer('pk_personalidad', true);
            $table->integer('fk_alumno')->nullable();
            $table->text('autodescripcion')->nullable()->comment('¿Cómo te describirías a ti mismo/a?');
            $table->text('como_lo_ven_demas')->nullable()->comment('¿Cómo crees que te ven los demás?');
            $table->text('gusta_mas_de_si')->nullable()->comment('¿Qué es lo que más te gusta de ti?');
            $table->text('gusta_menos_de_si')->nullable()->comment('¿Y lo que menos te gusta de ti?');
            $table->boolean('contento_ser_fisico')->nullable()->comment('¿Estás contento/a con tu forma de ser y con tu físico?');
            $table->text('cambiaria_algo_ser_fisico')->nullable()->comment('¿Cambiarias algo de tu forma de ser o de tu físico?');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personalidad');
    }
};
