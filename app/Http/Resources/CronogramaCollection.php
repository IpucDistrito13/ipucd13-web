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
            // Convertir el start y end en objetos DateTime para manipular la hora
            $start = new \DateTime($cronograma->start);
            $end = new \DateTime($cronograma->end);
            
            // Comprobar si la hora es 23:59 y mostrar solo la fecha en ese caso
            $formattedStart = $start->format('H:i') === '23:59' ? $start->format('Y-m-d') : $start->format('Y-m-d H:i:s');
            $formattedEnd = $end->format('H:i') === '23:59' ? $end->format('Y-m-d') : $end->format('Y-m-d H:i:s');
            
            return [
                'id' => $cronograma->id,
                'nombre' => $cronograma->title,
                'start' => $formattedStart,
                'end' => $formattedEnd,
                'lugar' => $cronograma->lugar,
                'descripcion' => $cronograma->descripcion,
                'url' => $cronograma->url,            
            ];
        })->toArray();
    }
    
}