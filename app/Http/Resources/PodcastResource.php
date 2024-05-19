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
        /*
        return [
            'id' => $this->id,
            'type' => 'Podcasts',
            'attributes' => [
                'titulo' => $this->titulo,
                'slug' => $this->slug,
                //'descripcion' => $this->descripcion,
                //'contenido' => $this->contenido,
                'imagenbanner' => $this->imagen_banner,
            ],

            'relations' => [
                'imagen' => [
                    'imagen' => $this->imagen ? $this->imagen->url : null,
                ]
            ]
        ];
        */

        return [
            'id' => $this->id,
            'type' => 'Podcasts',
            'titulo' => $this->titulo,
            'slug' => $this->slug,
            //'descripcion' => $this->descripcion,
            //'contenido' => $this->contenido,
            //'comite_id' => $this->comite->nombre,
            //'categoria_id' => $this->categoria->nombre,
            'imagenbanner' => $this->imagen_banner,
            'imagen' => $this->imagen ? $this->imagen->url : null,

        ];
    }
}
