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
        Schema::table('bajas', function (Blueprint $table) {
            $table->foreign(['fk_alumno'], 'bajas_ibfk_1')->references(['pk_alumno'])->on('alumno')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_motivo_baja'], 'fk_motivo_baja')->references(['pk_motivo_baja'])->on('motivo_baja')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bajas', function (Blueprint $table) {
            $table->dropForeign('bajas_ibfk_1');
            $table->dropForeign('fk_motivo_baja');
        });
    }
};
