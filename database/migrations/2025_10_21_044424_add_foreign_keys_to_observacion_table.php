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
        Schema::table('observacion', function (Blueprint $table) {
            $table->foreign(['fk_alumno'], 'observacion_ibfk_1')->references(['pk_alumno'])->on('alumno')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('observacion', function (Blueprint $table) {
            $table->dropForeign('observacion_ibfk_1');
        });
    }
};
