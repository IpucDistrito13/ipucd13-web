<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CronogramaResource extends JsonResource
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
            'title' => $this->title,
            'start' => $this->start,
            'end' => $this->end,
            'lugar' => $this->lugar,
            'descripcion' => $this->descripcion,
            //'backgroundColor' => 'F0AB00',
            //'url' => $this->url,
            'imagen' => '',
        ];
    
    }
}
