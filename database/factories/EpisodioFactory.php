<?php

namespace Database\Factories;

use App\Models\Podcast;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Episodio>
 */
class EpisodioFactory extends Factory
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
            'descripcion' => $this->faker->text(250),
            'url' => 'www.google.com',
            'podcast_id' =>  Podcast::all()->random()->id,
        ];
    }
}
