<?php

namespace App\Http\Resources\V2\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsuarioCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($usuario) {
            return [
                //id' => $usuario->id,
                'uuid' => $usuario->uuid,
                'nombre' => $usuario->nombre,
                'apellidos' => $usuario->apellidos,
                //'celular' => $usuario->celular,
                //'visibleCelular' => $usuario->visible_celular,
                'congregacion' => $usuario->congregacion->nombre,
                'municipio' => $usuario->congregacion->municipio->nombre,
                'departamento' => $usuario->congregacion->municipio->departamento->nombre,
                'imagen' => $usuario->imagen?  $usuario->imagen->url : null,
            
            ];
        })->toArray();
        
    }
}