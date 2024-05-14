<?php

namespace Database\Factories;

use App\Models\Serie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
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
            'url' => 'https://www.youtube.com/watch?v=GN53MCuFLHk&t=2s',
            'enlace' => '',
            'serie_id' => Serie::all()->random()->id,
            //'contenido' => $this->faker->text(250),
        ];
    }
}
