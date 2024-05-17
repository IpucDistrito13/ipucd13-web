<?php

namespace Database\Factories;

use App\Models\Congregacion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),

            'uuid' => $this->faker->unique()->numberBetween(1000000000, 9999999999),

            'codigo' => $this->faker->optional()->numberBetween(1000000000, 9999999999),
            'nombre' => fake()->name(),
            'apellidos' => fake()->name(),
            'celular' => $this->faker->numberBetween(1000000000, 9999999999),
            'visible_celular' => true,
            'telefono' => $this->faker->numberBetween(1000000, 9999999),
            'congregacion_id' => Congregacion::all()->random()->id,
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
        
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
