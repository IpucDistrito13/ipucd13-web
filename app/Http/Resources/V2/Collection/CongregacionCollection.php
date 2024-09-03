<?php

namespace App\Http\Resources\V2\Collection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CongregacionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($congregacion) {
            return [
                'congregacion' => $congregacion->nombre,
                'municipio' => $congregacion->municipio->nombre,
                'departamento' => $congregacion->municipio->departamento->nombre,
                'direccion'=> $congregacion->direccion,
            ];
        })->toArray();
    }
}
