<?php

namespace App\Http\Resources\V2\Collection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArchivosDetailsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($archivos) {
            return [
                'id' => $archivos->id,
                'uuid' => $archivos->uuid,
                'tipo' => $archivos->tipo,
                'url' => $archivos->url,
                'nombre' => $archivos->nombre_original,
                'created_at' => $archivos->updated_at,
                'carpeta' => $archivos->carpeta->nombre,
                //'comite' => $archivos->carpeta->comite->nombre,
            ];
        })->toArray();
    }
}
