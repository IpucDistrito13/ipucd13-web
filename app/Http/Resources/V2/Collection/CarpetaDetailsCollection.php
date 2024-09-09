<?php

namespace App\Http\Resources\V2\Collection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CarpetaDetailsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($carpeta) {
            return [
                'id' => $carpeta->id,
                'slug' => $carpeta->slug,
                'nombre' => $carpeta->nombre,
                'descripcion'=> $carpeta->descripcion,
                'comite' => $carpeta->comite->nombre,
            ];
        })->toArray();
        
    }
}
