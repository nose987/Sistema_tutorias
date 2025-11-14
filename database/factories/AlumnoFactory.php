<?php

namespace Database\Factories;

use App\Models\Grupo; 
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     * 
     */

    //este Alumno factory define informacio para usarla como una simulacion en los test, esto para la informacion del alumno
    // ERNESTO JAVIER PARRA MARTÍNEZ
    public function definition(): array
    {
        return [
           
            'nombre' => fake()->firstName(),
            'apellido_paterno' => fake()->lastName(),
            'apellido_materno' => fake()->lastName(),

            
            'carrera' => fake()->randomElement(['Ingeniería en Software', 'Mecatrónica', 'Redes Digitales']),
            'padre_profesion' => fake()->jobTitle(), 
            'madre_profesion' => fake()->jobTitle(), 

           
            'fk_grupo' => Grupo::factory(), 
            'fecha_nacimiento' => fake()->date(),
            'celular' => fake()->phoneNumber(),
            'direccion' => fake()->address(),
            'estatus' => 'Activo', 
        ];
    }
}
