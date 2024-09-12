<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
        $video = $this->route()->parameter(name: 'video');

        $rules = [
            'titulo' => 'required|max:230',
            'slug' => 'required|max:255|alpha_dash|unique:videos,slug',
            'url' => ['required', 'max:150', 'regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/'],
            'descripcion' => 'required|max:250',
        ];

        // Si hay un video, aplicar regla de validación condicional para el slug
        if ($video) {
            $rules['slug'] = 'required|max:255|alpha_dash|unique:videos,slug,' . $video->id;
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
            'slug.unique' => 'El slug ya está en uso.',
            'url.required' => 'La URL es obligatoria.',
            'url.max' => 'La URL no puede tener más de :max caracteres.',
            'url.regex' => 'La URL debe ser un enlace válido de YouTube.',
            'descripcion.max' => 'La descripción no puede tener más de :max caracteres.'
        ];
    }
}
