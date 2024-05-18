<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuariosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $privado = route('admin.galerias.privadoadmin', $this->resource);
        $general = route('admin.galerias.generaladmin', $this->resource);

        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'celular' => $this->celular,
            'role' => $this->roles->pluck('name')->implode(', '),
            'direccion_congregacion' => $this->congregacion->direccion,
            'action' => '<div class="btn-group" role="group">' .
                        '<a href="' . $privado . '" class="edit btn btn-danger btn-sm">Galería privada</a>' .
                        ' <a href="' . $general . '" class="edit btn btn-success btn-sm">Galería general</a>' .
                        '</div>',
        ];
    }
}
