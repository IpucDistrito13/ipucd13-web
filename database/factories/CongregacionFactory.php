<?php

namespace Database\Factories;

use App\Models\Congregacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Congregacion>
 */
class CongregacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'municipio_id' => \App\Models\Municipio::all()->random()->id,
            'longitud' => $this->faker->numberBetween(1000000, 9999999),
            'latitud' => $this->faker->numberBetween(1000000, 9999999),
            'direccion' => $this->faker->address(),
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
        ];
    }
}
