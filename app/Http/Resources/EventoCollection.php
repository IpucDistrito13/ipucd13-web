<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($evento) {
            return [
                'id' => $evento->id,
                'nombre' => $evento->title,
                'start' => $evento->start,
                'end' => $evento->end,
                'lugar' => $evento->lugar,
                'descripcion' => $evento->descripcion,
                'url' => $evento->url,            
            ];
        })->toArray();
        
    }
}