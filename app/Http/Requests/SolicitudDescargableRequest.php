<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudDescargableRequest extends FormRequest
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
        $solicitudDescargable = $this->route()->parameter('solicitud_descargable');
        //dd($solicitudDescargable);

        // Reglas de validación por defecto
        $rules = [
            'nombre' => 'required|max:230',
            'slug' => 'required|max:255|alpha_dash|unique:solicitud_descargables,slug',
            'url' => 'required|file|max:10240', // 10MB max
            'descripcion' => 'nullable|max:250',
            'estado' => 'required|in:Activo,Inactivo',

        ];

        // Si hay una categoría, aplicar regla de validación condicional para el slug
        if ($solicitudDescargable) {
            $rules['slug'] = 'required|max:255|alpha_dash|unique:solicitud_descargables,slug,' . $solicitudDescargable->id;
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
