<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'slug' => $this->slug,
            'descripcion' => $this->descripcion,
            'url' => $this->url,
            'serie' => $this->serie->titulo,
            'comite' => $this->serie->comite->nombre,
            //'comite' => $this->serie->comite->nombre,
            'categoria' => $this->serie->categoria->nombre,
            //'imagenportada' => $this->imagen ? $this->imagen->url : null,
        ];
    }
}
