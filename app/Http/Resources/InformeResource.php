<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InformeResource extends JsonResource
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
            'nombre' => $this->titulo,
            'imagenportada' => $this->imagen ? $this->imagen->url : null,

            /*
            'relationships' => [
                'comite' => new ComiteSimpleResource($this->whenLoaded('comite')),
                'categoria' => new CategoriaSimpleResource($this->whenLoaded('categoria')),
            ]
            */
        ];
    }
}
