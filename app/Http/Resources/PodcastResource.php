<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PodcastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'type' => 'podcasts',
            'nombre' => $this->titulo,
            'descripcion' => $this->descripcion,
            'contenido' => $this->contenido,
            'imagenportada' => $this->imagen ? $this->imagen->url : null,
            'imagenbanner' => $this->imagen_banner,

            'relationships' => [
                'episodios' => EpisodioSimpleResource::collection($this->episodios),
            ],
            
        ];
    }
}
