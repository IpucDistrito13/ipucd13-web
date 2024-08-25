<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SerieDetailsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($serie) {
            return [
                'id' => $serie->id,
                'slug' => $serie->slug,
                'nombre' => $serie->titulo,
                'descripcion'=> $serie->descripcion,
                'imagenportada' => $serie->imagen?  $serie->imagen->url : null,
                'categoria' => $serie->categoria->nombre,
            ];
        })->toArray();
        
    }
}
