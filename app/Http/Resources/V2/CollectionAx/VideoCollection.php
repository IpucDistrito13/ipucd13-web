<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VideoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($video) {
            return [
                'id' => $video->id,
                'slug' => $video->slug,
                'titulo' => $video->titulo,
                
                'descripcion' => $video->descripcion,
                'imagenportada' => $video->serie->imagen ?  $video->serie->imagen->url : null,
                'url' => $episodio->url ?? '',
                'categoria' => $video->serie->categoria->nombre,
                'comite' => $video->serie->comite->nombre,
                'updated_at' => $video->updated_at->format('d/m/Y'),
                
            ];
        })->toArray();
    }
}
