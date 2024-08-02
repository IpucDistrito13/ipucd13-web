<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LiderSimpleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /*
        return [
            'id' => $this->id,
            'type' => 'usuario',
            'nombre' => $this->usuario->nombre,
            'apellidos' => $this->usuario->apellidos,
            'celular' => $this->usuario->celular,
            'email' => $this->usuario->email,
            'imagenperfil' => $this->imagen ? $this->imagen->url : null,
        ];
        */
        return [
            'id' => $this->id,
            'type' => 'usuario',
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'celular' => $this->celular,
            'email' => $this->email,
            'imagenperfil' => $this->imagen ? $this->imagen->url : null,
        ];
    }
}
