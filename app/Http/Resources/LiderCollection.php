<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LiderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($lider) {
            return [
                'id' => $lider->usuario->id,
                'uuid' => $lider->usuario->uuid,
                'nombre' => $lider->usuario->nombre,
                'apellidos' => $lider->usuario->apellidos,
                'celular' => $lider->usuario->celular,
                'imagenperfil' => $lider->imagen?  $lider->imagen->url : null,
                'tipolider' => $lider->liderTipo->nombre,
                'visiblecelular' => $lider->usuario->visible_celular,
            
            ];
        })->toArray();
        
    }
}