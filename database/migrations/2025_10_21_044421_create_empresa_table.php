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
        Schema::create('empresa', function (Blueprint $table) {
            $table->integer('pk_empresa', true);
            $table->string('nombre', 150);
            $table->string('tel', 20)->nullable();
            $table->string('correo', 100)->nullable();
            $table->text('direccion')->nullable();
            $table->enum('estatus', ['Activa', 'Inactiva'])->nullable()->default('Activa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa');
    }
};
