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
        Schema::table('actividad', function (Blueprint $table) {
            $table->foreign(['fk_tipo_actividad'], 'actividad_ibfk_2')->references(['pk_tipo_actividad'])->on('tipo_actividad')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actividad', function (Blueprint $table) {
            $table->dropForeign('actividad_ibfk_2');
        });
    }
};
