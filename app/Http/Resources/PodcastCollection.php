<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PodcastCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($podcast) {
            return [
                'id' => $podcast->id,
                'slug' => $podcast->slug,
                'nombre' => $podcast->titulo,
                'imagenportada' => $podcast->imagen?  $podcast->imagen->url : null,
            
            ];
        })->toArray();
        
    }
}