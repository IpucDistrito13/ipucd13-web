<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SerieResource extends JsonResource
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
            'type' => 'serie',
            'titulo' => $this->titulo,
            //'slug' => $this->slug,
            //'descripcion' => $this->descripcion,
            'imagen_banner' => $this->imagen_banner,



            'comite' => [
                'id' => $this->comite->id,
                'nombre' => $this->comite->nombre,
            ],

            'categoria' => [
                'id' => $this->categoria->id,
                'nombre' => $this->categoria->nombre

            ]

        ];
    }
}
