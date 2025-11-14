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
        Schema::table('canalizacion_seguimiento', function (Blueprint $table) {
            $table->foreign(['fk_formato_canalizacion'], 'seguimiento_to_canalizacion_fk')->references(['pk_formato_canalizacion'])->on('formato_canalizacion')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('canalizacion_seguimiento', function (Blueprint $table) {
            $table->dropForeign('seguimiento_to_canalizacion_fk');
        });
    }
};
