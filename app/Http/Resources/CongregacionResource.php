<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CongregacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'congregacion',
            'attributes' => [ 
                'municipio' =>$this->municipio->nombre,
                'longitud' => $this->longitud,
                'latitud' => $this->latitud,
                'direccion' => $this->direccion,
                'estado' => $this->estado,
            ],

            'relationships' => [
                'municipio' => [
                    'nombre' => $this->municipio->nombre,
                ],
                
            ]
        ];
    }
}