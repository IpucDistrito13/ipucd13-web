<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SliderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($slider) {
            return [
                'id' => $slider->id,
                'nombre' => $slider->titulo,
                'imagen' => $slider->imagen?  $slider->imagen->url : null,
            
            ];
        })->toArray();
        
    }
}