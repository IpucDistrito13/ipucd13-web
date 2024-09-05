<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Carbon\Carbon;

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
            // Parsear las fechas usando Carbon
            $start = Carbon::parse($cronograma->start);
            $end = Carbon::parse($cronograma->end);

            // Formatear dependiendo de la hora
            $formattedStart = $start->format('H:i:s') === '01:00:00' 
                                ? $start->format('Y-m-d') 
                                : $start->format('Y-m-d H:i:s');
                                
            $formattedEnd = $end->format('H:i:s') === '23:59:00' 
                                ? $end->format('Y-m-d') 
                                : $end->format('Y-m-d H:i:s');

            return [
                'id' => $cronograma->id,
                'nombre' => $cronograma->title,
                'start' => $formattedStart,   // Formateado según la condición
                'end' => $formattedEnd,       // Formateado según la condición
                'lugar' => $cronograma->lugar,
                'descripcion' => $cronograma->descripcion,
                'url' => $cronograma->url,            
            ];
        })->toArray();
    }
}
