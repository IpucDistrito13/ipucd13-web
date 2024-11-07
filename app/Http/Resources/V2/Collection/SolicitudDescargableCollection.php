<?php

namespace App\Http\Resources\V2\Collection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SolicitudDescargableCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($solicitudDescargable) {
            return [
                //'id' => $solicitudDescargable->id,
                'uuid' => $solicitudDescargable->uuid,
                //'slug' => $solicitudDescargable->slug,

                'tipo' => $solicitudDescargable->tipo,
                'url' => $solicitudDescargable->url,
                'nombre' => $solicitudDescargable->nombre,
                'created_at' => $solicitudDescargable->created_at,
                //'nombre_original' => $solicitudDescargable->nombre_original,
            ];
        })->toArray();
    }
}
