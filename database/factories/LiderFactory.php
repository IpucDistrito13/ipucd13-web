<?php

namespace Database\Factories;

use App\Models\Comite;
use App\Models\LiderTipo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lider>
 */
class LiderFactory extends Factory
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
            'lidertipo_id' => LiderTipo::all()->random()->id,
            'comite_id' => Comite::all()->random()->id,
            'usuario_id' => User::all()->random()->id,
            'user_created' => User::all()->random()->id,
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
        ];
    }
}
