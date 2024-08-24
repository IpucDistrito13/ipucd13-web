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
            'nombre' => $this->titulo,
            'imagenbanner' => $this->imagen_banner,
            'imagenportada' => $this->imagen ? $this->imagen->url : null,
            'contenido' => $this->contenido,

        ];
    }
}
