<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InformeDetailsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($informe) {
            return [
                'id' => $informe->id,
                'slug' => $informe->slug,
                'nombre' => $informe->titulo,
                'descripcion' => $informe->descripcion,
                'imagenportada' => $informe->imagen?  $informe->imagen->url : null,
            ];
        })->toArray();
        
    }
}