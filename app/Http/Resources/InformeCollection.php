<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InformeCollection extends ResourceCollection
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
                'titulo' => $informe->titulo,
                'imagenportada' => $informe->imagen?  $informe->imagen->url : null,
                'imagenbanner' => $informe->imagen_banner,
                'contenido' => $informe->contenido

            ];
        })->toArray();
        
    }
}
