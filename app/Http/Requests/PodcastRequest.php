<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PodcastRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $podcast = $this->route()->parameter('podcast');

        // Reglas de validación por defecto
        $rules = [
            'titulo' => 'required|max:250',
            'slug' => 'required|max:255|alpha_dash|unique:podcasts,slug',
            'descripcion' => 'required|max:300',
            'contenido' => 'required|max:1000',
            'comite' => 'required|numeric',
            'categoria' => 'required|numeric',

            'file' => 'required|image|dimensions:width=480,height=640',
            'imagen_banner' => 'required|image|dimensions:width=1920,height=500',
        ];

        // Si hay una podcast, aplicar regla de validación condicional para el slug
        if ($podcast) {
            $rules['slug'] = 'required|max:255|alpha_dash|unique:podcasts,slug,' . $podcast->id;
            $rules['file'] = 'nullable|image|dimensions:width=480,height=640';
            $rules['imagen_banner'] = 'nullable|image|dimensions:width=1920,height=500';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no puede tener más de :max caracteres.',
            'slug.required' => 'El slug es obligatorio.',
            'slug.max' => 'El slug no puede tener más de :max caracteres.',
            'slug.alpha_dash' => 'El slug solo puede contener letras, números, guiones y guiones bajos.',
            'slug.unique' => 'El slug ya está en uso, elige otro.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no puede tener más de :max caracteres.',
            'contenido.required' => 'El contenido es obligatorio.',
            'contenido.max' => 'El contenido no puede tener más de :max caracteres.',
            'comite.required' => 'El comité es obligatorio.',
            'comite.numeric' => 'El comité debe ser un valor numérico.',
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.numeric' => 'La categoría debe ser un valor numérico.',
            'file.required' => 'La imagen de portada es obligatoria.',
            'file.image' => 'El archivo de la imagen de portada debe ser una imagen válida.',
            'file.dimensions' => 'La imagen de portada debe tener las dimensiones :widthx:height.',
            'imagen_banner.required' => 'La imagen de banner es obligatoria.',
            'imagen_banner.image' => 'El archivo de la imagen de banner debe ser una imagen válida.',
            'imagen_banner.dimensions' => 'La imagen de banner debe tener las dimensiones :widthx:height.',
        ];
    }
}
