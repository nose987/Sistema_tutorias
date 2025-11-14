<?php

namespace Tests\Feature;

use App\Models\Alumno;
use App\Models\MotivoBaja;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;



uses(RefreshDatabase::class);


//este primer test sirve para saber si la persona autenticada en este caso el tutor de la sesion puede dar de baja a un alumno
//ERNESTO JAVIER PARRA MARTÍNEZ
test('un usuario autenticado puede dar de baja a un alumno', function () {
    

    $usuario = User::factory()->create();


    $alumno = Alumno::factory()->create([
        'estatus' => 'Activo'
    ]);


    $motivo = MotivoBaja::factory()->create(); 

  
    $response = $this->actingAs($usuario) 
        ->post(route('alumnos.baja', $alumno), [
            'motivo_baja' => $motivo->pk_motivo_baja 
        ]);


    $response->assertRedirect(route('canalizaciones'));
    

    $response->assertSessionHas('status');


    $this->assertDatabaseHas('alumno', [
        'pk_alumno' => $alumno->pk_alumno,
        'estatus' => 'Baja'
    ]);

   
    $this->assertDatabaseHas('bajas', [
        'fk_alumno' => $alumno->pk_alumno,
        'fk_motivo_baja' => $motivo->pk_motivo_baja,
        'estatus' => 'Activa' 
    ]);
});


//este segundo test sirve para verificar que no se pueda der de baja a un alumno sin haber especificado un motivo de la baja
//ERNESTO JAVIER PARRA MARTÍNEZ

test('la baja falla si no se proporciona un motivo', function () {


    $usuario = User::factory()->create();
    $alumno = Alumno::factory()->create([
        'estatus' => 'Activo'
    ]);


    $response = $this->actingAs($usuario)
        ->post(route('alumnos.baja', $alumno), []); 


    $response->assertSessionHasErrors('motivo_baja');


    $this->assertDatabaseHas('alumno', [
        'pk_alumno' => $alumno->pk_alumno,
        'estatus' => 'Activo'
    ]);


    $this->assertDatabaseCount('bajas', 0);
});


// este tercer y ultimo test sirve para comprobar que si se muestren correctamente los alumnos que han sido dados de baja
// ERNESTO JAVIER PARRA MARTÍNEZ

test('se pueden visualizar los alumnos dados de baja en el listado', function () {

 
    $usuario = User::factory()->create();
    

    $motivo = MotivoBaja::factory()->create([
        'nombre' => 'Baja por Pruebas de Visualización'
    ]);

    $alumno = Alumno::factory()->create([
        'estatus' => 'Baja'
    ]);


    \App\Models\Baja::create([
        'fk_alumno' => $alumno->pk_alumno,
        'fk_motivo_baja' => $motivo->pk_motivo_baja,
        'fecha' => now(),
        'estatus' => 'Activa'
    ]);


    $response = $this->actingAs($usuario)
        ->get(route('canalizaciones'));


    $response->assertStatus(200);


    $response->assertSee($alumno->nombre);
    $response->assertSee($alumno->apellido_paterno);


    $response->assertSee('Baja por Pruebas de Visualización');
});
