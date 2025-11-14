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
        Schema::table('alumno_estadia', function (Blueprint $table) {
            $table->foreign(['fk_alumno'], 'alumno_estadia_ibfk_1')->references(['pk_alumno'])->on('alumno')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_empresa'], 'fk_empresa_estadia')->references(['pk_empresa'])->on('empresa')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumno_estadia', function (Blueprint $table) {
            $table->dropForeign('alumno_estadia_ibfk_1');
            $table->dropForeign('fk_empresa_estadia');
        });
    }
};
