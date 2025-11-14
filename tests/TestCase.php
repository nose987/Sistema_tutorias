<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Schema;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Sobrescribe el método de carga de esquema del trait `RefreshDatabase`.
     *
     * Esto fuerza a las pruebas (que usan la conexión 'sqlite') a cargar
     * el snapshot creado desde la conexión 'mysql', resolviendo el conflicto.
     */
    protected function loadSchema(): void
    {
        // Carga el snapshot usando la ruta y nombre de archivo correctos.
        Schema::load(base_path('database/schema/mysql-schema.sql'));
    }
}
