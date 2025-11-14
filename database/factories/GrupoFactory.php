<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoFactory extends Factory
{

    //este grupo factory define informacio para usarla como una simulacion en los test, esto para la informacion del grupo
    // ERNESTO JAVIER PARRA MARTÍNEZ
    public function definition(): array
    {
        return [
            'nombre_grupo' => fake()->lexify('???'),
            'estatus' => 'Activo',
            'cuatrimestre' => fake()->randomDigitNotNull(),
        ];
    }
}
