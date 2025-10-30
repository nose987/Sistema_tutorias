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
        Schema::table('canalizacion', function (Blueprint $table) {
            $table->foreign(['fk_alumno'], 'canalizacion_ibfk_1')->references(['pk_alumno'])->on('alumno')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_motivo_canalizacion'], 'fk_motivo')->references(['pk_motivo_canalizacion'])->on('motivo_canalizacion')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('canalizacion', function (Blueprint $table) {
            $table->dropForeign('canalizacion_ibfk_1');
            $table->dropForeign('fk_motivo');
        });
    }
};
