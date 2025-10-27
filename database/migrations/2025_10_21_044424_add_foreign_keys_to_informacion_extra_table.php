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
        Schema::table('informacion_extra', function (Blueprint $table) {
            $table->foreign(['fk_alumno'], 'informacion_extra_ibfk_1')->references(['pk_alumno'])->on('alumno')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informacion_extra', function (Blueprint $table) {
            $table->dropForeign('informacion_extra_ibfk_1');
        });
    }
};
