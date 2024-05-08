<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dni' => $this->faker->numberBetween(10000000, 99999999),
            'nombre' => $this->faker->name,
            'direccion' => $this->faker->address,
            'codigoPostal' => $this->faker->postcode, 
            'telefono' => $this->faker->e164PhoneNumber,
            'genero' => $this->faker->randomElement(['M', 'F']), 
            'fechaNacimiento' => $this->faker->date(), 
            'correo' => $this->faker->email
            
        ];
    }
}
