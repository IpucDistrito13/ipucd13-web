<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Comite;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publicacion>
 */
class PublicacionFactory extends Factory
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
            'titulo' =>  $titulo,
            'slug' => Str::slug($titulo),
            'descripcion' => $this->faker->text(150),
            'contenido' => $this->faker->text(2000),
            'comite_id' =>  Comite::all()->random()->id,
            'categoria_id' =>  Categoria::all()->random()->id,
            'user_id' =>  User::all()->random()->id,
            'estado' => $this->faker->randomElement(['Borrador','Publicado']),

        ];
    }
}
