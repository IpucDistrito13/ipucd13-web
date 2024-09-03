<?php

namespace App\Http\Resources\V2\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IpucenLineaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'descripcion' => $this->descripcion ?? null,
            'url' => $this->url ?? null,
            'video1' => $this->video1 ?? null,
            'video2' => $this->video2 ?? null,
        ];
    }
}
