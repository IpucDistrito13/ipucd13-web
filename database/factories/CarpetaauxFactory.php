<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carpetaaux>
 */
class CarpetaauxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'uuid' => time(),
            'nombre' => $this->faker->unique()->sentence(),
            'descripcion' => $this->faker->name(),
            'user_id' =>  User::all()->random()->id,
            'visibilidad' => $this->faker->randomElement(['Publico', 'Privado']),
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
        ];
    }
}
