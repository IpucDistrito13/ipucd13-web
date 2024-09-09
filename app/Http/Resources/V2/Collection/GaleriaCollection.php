<?php

namespace App\Http\Resources\V2\Collection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GaleriaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($galeria) {
            return [
                'uuid' => $galeria->uuid,
                'imagen' => $galeria->url,
                'created_at' => $galeria->created_at->format('d/m/Y'),
                //'nombre' => $galeria->user->nombre,
                //'apellidos' => $galeria->user->apellidos,
                //'updated_at' => $episodio->updated_at->format('d/m/Y'),
            ];
        })->toArray();
    }
}
