<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CronogramaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($cronograma) {
            return [
                'id' => $cronograma->id,
                'nombre' => $cronograma->title,
                'start' => $cronograma->start,
                'end' => $cronograma->end,
                'lugar' => $cronograma->lugar,
                'descripcion' => $cronograma->descripcion,
                'url' => $cronograma->url,            
            ];
        })->toArray();
        
    }
}