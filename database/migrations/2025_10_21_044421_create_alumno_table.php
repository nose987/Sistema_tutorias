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
        Schema::create('alumno', function (Blueprint $table) {
            $table->integer('pk_alumno', true);
            $table->integer('fk_grupo')->nullable()->index('fk_grupo');
            $table->string('nombre', 100);
            $table->string('apellido_paterno', 100)->nullable();
            $table->string('apellido_materno', 100)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('nombre_padre', 20)->nullable();
            $table->string('padre_edad_profesion', 100)->nullable();
            $table->string('nombre_madre', 200)->nullable();
            $table->string('madre_edad_profesion', 100)->nullable();
            $table->text('hermanos_info')->nullable()->comment('Para guardar edad y ocupación');
            $table->boolean('tiene_hijos')->nullable()->default(false)->comment('0=No, 1=Si');
            $table->boolean('trabaja')->nullable()->default(false)->comment('0=No, 1=Si');
            $table->boolean('recibe_apoyo_familiar')->nullable()->default(false)->comment('0=No, 1=Si');
            $table->boolean('tiene_beca')->nullable()->default(false)->comment('0=No, 1=Si');
            $table->string('tipo_beca', 150)->nullable()->comment('Especificación de la beca');
            $table->string('contacto_emergencia_nombre', 200)->nullable()->comment('Contacto en caso de Emergencia');
            $table->string('contacto_emergencia_telefono', 20)->nullable()->comment('Teléfono de emergencia');
            $table->string('contacto_emergencia_celular', 20)->nullable()->comment('Celular de emergencia');
            $table->string('correo', 100)->nullable();
            $table->text('direccion')->nullable();
            $table->enum('estatus', ['Activo', 'Baja'])->nullable()->default('Activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno');
    }
};
