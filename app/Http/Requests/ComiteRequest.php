<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComiteRequest extends FormRequest
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
        $comite = $this->route()->parameter('comite');

        // Reglas de validación por defecto
        $rules = [
            'nombre' => 'required|max:50',
            'slug' => 'required|max:255|alpha_dash|unique:comites,slug',
            'descripcion' => 'required|max:1000',
            'file' => 'required|image|dimensions:width=480,height=640',
            'imagen_banner' => 'required|image|dimensions:width=1920,height=500',
            'banner_little' => 'required|image|dimensions:width=600,height=144',
        ];

        // Si hay una categoría, aplicar regla de validación condicional para el slug
        if ($comite) {
            $rules['slug'] = 'required|max:255|alpha_dash|unique:comites,slug,' . $comite->id;
            $rules['file'] = 'nullable|image|dimensions:width=480,height=640';
            $rules['imagen_banner'] = 'nullable|image|dimensions:width=1920,height=500';
            $rules['banner_little'] = 'nullable|image|dimensions:width=600,height=144';


        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
            'slug.required' => 'El slug es obligatorio.',
            'slug.max' => 'El slug no puede tener más de :max caracteres.',
            'slug.alpha_dash' => 'El slug solo puede contener letras, números, guiones y guiones bajos.',
            'slug.unique' => 'El slug ya está en uso.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no puede tener más de :max caracteres.',
            'imagen_banner.required' => 'La imagen de banner es obligatoria.',
            'imagen_banner.image' => 'El archivo debe ser una imagen.',
            'imagen_banner.dimensions' => 'La imagen de banner debe tener dimensiones de :widthx:height píxeles.',

            'banner_little.required' => 'La imagen del mini banner es obligatoria.',
            'banner_little.image' => 'El archivo debe ser una imagen.',
            'banner_little.dimensions' => 'La imagen del mini banner debe tener dimensiones de :widthx:height píxeles.',

            'file.required' => 'La imagen de portada es obligatoria.',
            'file.image' => 'El archivo debe ser una imagen.',
            'file.dimensions' => 'La imagen de portada debe tener dimensiones de :widthx:height píxeles.',
        ];
    }
}
