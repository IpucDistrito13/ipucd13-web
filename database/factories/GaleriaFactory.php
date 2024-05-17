<?php

namespace Database\Factories;

use App\Models\GaleriaTipo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Galeria>
 */
class GaleriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titulo = $this->faker->unique()->sentence();

        return [
            'uuid' => $this->faker->numberBetween(10000, 9999999999),
            //'nombre' =>  $titulo,
            'user_id' => User::all()->random()->id,
            'galeriatype_id' => GaleriaTipo::all()->random()->id,
            'createdby_id' => 1,
        ];
    
    }
}
