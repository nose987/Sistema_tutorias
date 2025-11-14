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
        Schema::table('opciones_estadia', function (Blueprint $table) {
            $table->foreign(['fk_alumno'], 'opciones_estadia_fk_alumno')->references(['pk_alumno'])->on('alumno')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['fk_empresa'], 'opciones_estadia_fk_empresa')->references(['pk_empresa'])->on('empresa')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('opciones_estadia', function (Blueprint $table) {
            $table->dropForeign('opciones_estadia_fk_alumno');
            $table->dropForeign('opciones_estadia_fk_empresa');
        });
    }
};
