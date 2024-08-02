<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LideresResource extends JsonResource
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
            'type' => 'lider',
            'lidertipo' => new LiderTipoSimpleResource($this->whenLoaded('liderTipo')),
            'lider' => new LiderSimpleResource($this->whenLoaded('usuario')),
            'imagenperfil' => $this->imagen ? $this->imagen->url : null, 
        ];
    }
}
