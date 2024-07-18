<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ComiteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($comite) {
            return [
                'id' => $comite->id,
                'nombre' => $comite->nombre,
                'imagen' => $comite->imagen?  $comite->imagen->url : null,
                //'imagenbanner' => $comite->imagen_banner,
            
            ];
        })->toArray();
        
    }
}