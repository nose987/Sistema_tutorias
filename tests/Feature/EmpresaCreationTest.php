//Jesús Lombardo Grave Casillas - Módulo de empresas y estadías
<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

//Test 1: Este test comprueba que un usuario que ha iniciado sesión pueda guardar una empresa exitosamente

test('un usuario autenticado puede crear una nueva empresa', function () {
    
    $user = User::factory()->create();

    $empresaData = [
        'nombre_empresa' => 'Empresa de Prueba, S.A. de C.V.',
        'nombre_contacto' => 'Ing. Juan Pérez',
        'telefono' => '6691234567',
        'email' => 'juan.perez@empresa.com',
        'direccion' => 'Av. Siempre Viva 123',
        'notas' => 'Notas de prueba.',
    ];

    $response = $this->actingAs($user)->post(route('empresas.store'), $empresaData);

    $response->assertRedirect(route('estadias'));
    $response->assertSessionHas('success', '¡Empresa registrada con éxito!');

    $this->assertDatabaseHas('empresa', [
        'nombre' => 'Empresa de Prueba, S.A. de C.V.',
        'correo' => 'juan.perez@empresa.com',
        'tel' => '6691234567',
        'estatus' => 'Activa'
    ]);
});

//Test 2: Este otro test prueba que el sistema rechace los datos si están incompletos y no guarde nada

test('la creacion falla si el nombre de empresa esta vacio', function () {
    
    $user = User::factory()->create();

    $empresaData = [
        'nombre_empresa' => '',
        'nombre_contacto' => 'Ing. Juan Pérez',
        'email' => 'juan.perez@empresa.com',
    ];

    $response = $this->actingAs($user)->post(route('empresas.store'), $empresaData);

    $response->assertSessionHasErrors('nombre_empresa');

    $this->assertDatabaseCount('empresa', 0);
});

//Test 3: Este test prueba que una persona que no ha iniciado sesión no pueda crear una empresa y sea bloqueada

test('un invitado no puede crear una empresa', function () {
    
    $empresaData = [
        'nombre_empresa' => 'Empresa Fantasma',
        'email' => 'fantasma@empresa.com',
    ];

    $response = $this->post(route('empresas.store'), $empresaData);

    $response->assertRedirect(route('login'));

    $this->assertDatabaseCount('empresa', 0);
});