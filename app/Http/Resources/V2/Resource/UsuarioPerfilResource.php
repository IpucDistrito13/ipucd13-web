<?php

namespace App\Http\Resources\V2\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioPerfilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'type' => 'usuario',
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'email' => $this->email,
            'celular' => $this->celular,
            'visibleCelular' => $this->visible_celular,
            'congregacion' => $this->congregacion->nombre,
            'municipio' => $this->congregacion->municipio->nombre,
            'departamento' => $this->congregacion->municipio->departamento->nombre,
            'roles' => $this->roles->pluck('name'),
            'imagen' => $this->imagen ? $this->imagen->url : null,
        ];
    }
}
