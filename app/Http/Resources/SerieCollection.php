<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SerieCollection extends ResourceCollection
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
                'nombre' => $serie->titulo,
                'imagenportada' => $serie->imagen?  $serie->imagen->url : null,   
                'categoria' => $serie->categoria->nombre,
            ];
        })->toArray();
        
    }
}
