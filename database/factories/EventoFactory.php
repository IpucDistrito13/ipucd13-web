<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(50),
            'start' => $this->faker->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d H:i:s'),
            'end' => $this->faker->dateTimeBetween('+1 month', '+2 months')->format('Y-m-d H:i:s'),
            'backgroundColor' => '#f39c12',
            'borderColor' => '#f39c12',
            'lugar' => $this->faker->address,
            'descripcion' => $this->faker->text(100),
        ];
    }
}
