<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fecha' => $this->faker->date(), 
            'horaInicio' => $this->faker->time(), 
            'horaFin' => $this->faker->time(), 
            'estado' => $this->faker->word(), 
            'motivo' => $this->faker->sentence(), 
            'paciente_id' => $this->faker->numberBetween(1, 30)
        ];
    }
}
