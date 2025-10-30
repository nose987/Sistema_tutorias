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
        Schema::table('historial_del_alumno', function (Blueprint $table) {
            $table->foreign(['fk_alumno'], 'historial_del_alumno_ibfk_1')->references(['pk_alumno'])->on('alumno')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_historial_medico'], 'historial_del_alumno_ibfk_2')->references(['pk_historial_medico'])->on('historial_medico')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_del_alumno', function (Blueprint $table) {
            $table->dropForeign('historial_del_alumno_ibfk_1');
            $table->dropForeign('historial_del_alumno_ibfk_2');
        });
    }
};
