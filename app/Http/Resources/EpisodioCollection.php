<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EpisodioCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

     //Mostrar episodios segun el podcast
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($episodio) {
            return [
                'id' => $episodio->id,
                'slug' => $episodio->slug,
                'titulo' => $episodio->titulo,
                'descripcion' => $episodio->descripcion,
                'imagenportada' => $episodio->podcast->imagen ?  $episodio->podcast->imagen->url : null,
                'url' => $episodio->url,
                'categoria' => $episodio->podcast->categoria->nombre,
                //'comite' => $episodio->podcast->comite->nombre,
                //'updated_at' => $episodio->updated_at->format('d/m/Y'),
            ];
        })->toArray();
    }
}
