<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerieRequest extends FormRequest
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
    public function rules()
    {
        $serie = $this->route()->parameter('serie');

        $rules = [
            'titulo' => 'required|max:230',
            'slug' => 'required|max:255|alpha_dash|unique:series,slug',
            'descripcion' => 'required|max:300',
            'contenido' => 'required',
            'comite' => 'required|exists:comites,id',
            'categoria' => 'required|exists:categorias,id',
            //'estado' => 'required|in:Publicado,Borrador', // Ajusta según tus necesidades
            'file' => 'required|image|dimensions:width=480,height=640',
            'imagen_banner' => 'required|image|dimensions:width=1920,height=500',
        ];

        // Si es una actualización, ajustar la regla unique para el slug
        if ($serie) {
            $rules['slug'] = 'required|max:255|alpha_dash|unique:series,slug,' . $serie->id;
            $rules['file'] = 'nullable|image|dimensions:width=480,height=640';
            $rules['imagen_banner'] = 'nullable|image|dimensions:width=1920,height=500';
            $rules['descripcion'] = 'required';
            $rules['contenido'] = 'required';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no puede tener más de :max caracteres.',
            'slug.required' => 'El slug es obligatorio.',
            'slug.max' => 'El slug no puede tener más de :max caracteres.',
            'slug.alpha_dash' => 'El slug solo puede contener letras, números, guiones y guiones bajos.',
            'slug.unique' => 'El slug ya está en uso.',
            'descripcion.max' => 'La descripción no puede tener más de :max caracteres.',
            'contenido.required' => 'El contenido es obligatorio.',
            'comite.required' => 'El comité es obligatorio.',
            'comite.exists' => 'El comité seleccionado no es válido.',
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.exists' => 'La categoría seleccionada no es válida.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado seleccionado no es válido.',
            'file.file' => 'El archivo debe ser un archivo válido.',
            'file.mimes' => 'El archivo debe ser de tipo :values.',
            'file.max' => 'El tamaño máximo del archivo es :max kilobytes.',
            'imagen_banner.image' => 'El banner debe ser una imagen válida.',
            'imagen_banner.mimes' => 'El banner debe ser de tipo :values.',
            'imagen_banner.max' => 'El tamaño máximo del banner es :max kilobytes.',
        ];
    }
}
