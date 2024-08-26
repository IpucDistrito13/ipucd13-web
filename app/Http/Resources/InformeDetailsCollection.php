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
        return $this->collection->map(function ($publicacion) {
            return [
                'id' => $publicacion->id,
                'slug' => $publicacion->slug,
                'nombre' => $publicacion->titulo,
                'descripcion' => $publicacion->descripcion,
                'imagenportada' => $publicacion->imagen ?  $publicacion->imagen->url : null,
                'categoria' => $publicacion->categoria->nombre,
                'comite' => $publicacion->comite->nombre,
                'created_at' => $publicacion->created_at->format('dd/mm/Y'),
            ];
        })->toArray();
    }
}
