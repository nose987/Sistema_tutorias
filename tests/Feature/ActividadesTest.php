<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\TipoActividad;
use App\Models\Actividad;

class ActividadesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba 1: Un usuario autenticado puede ver la página de actividades.
     *
     * Objetivo: Asegurar que la ruta, el controlador y la vista principal
     * del módulo de actividades funcionan correctamente y están protegidas.
     */
    public function test_un_usuario_autenticado_puede_ver_la_pagina_de_actividades(): void
    {
        // Arrange: Creamos un usuario para la prueba.
        $user = User::factory()->create();

        // Act: Actuamos como ese usuario y hacemos una petición GET a la ruta 'actividades'.
        $response = $this->actingAs($user)->get(route('actividades'));

        // Assert: Verificamos que la respuesta sea exitosa (código 200).
        $response->assertOk();
        // Opcional: Verificar que se vea un texto específico en la página.
        $response->assertSeeText('Actividades y Pláticas');
    }

    /**
     * Prueba 2: Un usuario autenticado puede crear una nueva actividad.
     *
     * Objetivo: Probar el "camino feliz" de la creación de un registro,
     * asegurando que los datos se guarden en la base de datos y se redirija al usuario.
     */
    public function test_un_usuario_autenticado_puede_crear_una_actividad(): void
    {
        // Arrange: Preparamos los datos necesarios.
        $user = User::factory()->create();
        // Creamos un 'Tipo de Actividad' para cumplir con la llave foránea.
        $tipoActividad = TipoActividad::create(['nombre' => 'Plática']);

        $actividadData = [
            'nombre' => 'Plática de Finanzas Personales',
            'fk_tipo_actividad' => $tipoActividad->pk_tipo_actividad,
            'fecha' => '2025-11-15',
            'asistencia' => 50,
        ];

        // Act: Hacemos una petición POST a la ruta de guardado con los datos.
        $response = $this->actingAs($user)->post(route('actividades.store'), $actividadData);

        // Assert: Verificamos el resultado.
        // 1. La petición debe redirigir de vuelta a la lista de actividades.
        $response->assertRedirect(route('actividades'));

        // 2. La base de datos debe contener el registro que intentamos crear.
        $this->assertDatabaseHas('actividad', [
            'nombre' => 'Plática de Finanzas Personales',
            'asistencia' => 50,
        ]);
    }

    /**
     * Prueba 3: El reporte de actividades se descarga correctamente.
     *
     * Objetivo: Verificar que la funcionalidad de exportación que refactorizamos
     * responde correctamente y con las cabeceras HTTP adecuadas para una descarga.
     */
    public function test_el_reporte_de_actividades_se_descarga_correctamente(): void
    {
        // Arrange: Solo necesitamos un usuario autenticado.
        $user = User::factory()->create();

        // Act: Hacemos una petición GET a la ruta del reporte.
        $response = $this->actingAs($user)->get(route('actividades.reporte'));

        // Assert: Verificamos las cabeceras de la respuesta.
        // 1. La respuesta debe ser exitosa.
        $response->assertOk();

        // 2. El tipo de contenido debe ser el de un archivo Excel (xlsx).
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        // 3. La cabecera debe indicar que es un archivo adjunto para descargar.
        // Usamos 'assertHeaderContains' porque el nombre del archivo incluye una fecha dinámica.
        $response->assertHeaderContains('Content-Disposition', 'attachment;filename="Reporte_Actividades_');
    }
}