<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarpetaRequest extends FormRequest
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
        return [
            'nombre' => 'required|max:255',
            'slug' => 'required|max:255|alpha_dash|unique:carpetas,slug',
            'descripcion' => 'nullable|max:300',
            'comite' => 'required|exists:comites,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la carpeta es obligatorio.',
            'nombre.max' => 'El nombre de la carpeta no puede tener más de :max caracteres.',
            'slug.required' => 'El slug de la carpeta es obligatorio.',
            'slug.max' => 'El slug de la carpeta no puede tener más de :max caracteres.',
            'slug.alpha_dash' => 'El slug de la carpeta solo puede contener letras, números, guiones y guiones bajos.',
            'slug.unique' => 'El slug de la carpeta ya está en uso.',
            'descripcion.max' => 'La descripción de la carpeta no puede tener más de :max caracteres.',
            'comite.required' => 'El comité es obligatorio.',
            'comite.exists' => 'El comité seleccionado no es válido.',
        ];
    }
}
