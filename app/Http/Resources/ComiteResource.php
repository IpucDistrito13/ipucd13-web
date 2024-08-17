<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComiteResource extends JsonResource
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
            'type' => 'comite',
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'imagenportada' => $this->imagen ? $this->imagen->url : null,
            'imagenbanner' => $this->imagen_banner,

            //'leader' => LiderSimpleResource::collection($this->whenLoaded('lideres')),
            //'podcasts' => PodcastSimpleResource::collection($this->whenLoaded('podcasts')),
            //'series' => SerieSimpleResource::collection($this->whenLoaded('series')),
            //'informes' => InformeSimpleResource::collection($this->whenLoaded('publicaciones')),



        ];
    }
}
