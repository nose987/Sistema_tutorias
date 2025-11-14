<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MotivoBajaFactory extends Factory
{
    /**
     * @var string
     */
    
    //este motivo baja factory define informacio para usarla como una simulacion en los test, esto para la informacion del motivo baja
    // ERNESTO JAVIER PARRA MARTÍNEZ
    public function definition(): array
    {
        return [
            'nombre' => fake()->sentence(3), 
        ];
    }
}
