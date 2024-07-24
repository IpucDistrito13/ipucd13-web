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
            'titulo' => $this->titulo,
            'imagenbanner' => $this->imagen_banner,
            'imagenportada' => $this->imagen ? $this->imagen->url : null,

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
