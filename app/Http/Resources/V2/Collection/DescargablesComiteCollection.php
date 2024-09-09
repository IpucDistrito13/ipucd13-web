<?php

namespace App\Http\Resources\V2\Collection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DescargablesComiteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($descargableComite) {
            return [
                'id' => $descargableComite->id,
                'uuid' => $descargableComite->uuid,
                'url' => $descargableComite->url,
                'nombre' => $descargableComite->nombre_original,
                'created_at' => $descargableComite->updated_at,
                //'comite' => $descargableComite->comite->nombre,
                
            ];
        })->toArray();
    }
}
