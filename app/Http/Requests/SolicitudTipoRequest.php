<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudTipoRequest extends FormRequest
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
        $solicitudTipo = $this->route('solicitud_tipos'); // Access route parameters correctly

        // Default validation rules
        $rules = [
            'nombre' => 'required|max:100',
            'slug' => 'required|max:255|alpha_dash|unique:solicitud_tipos,slug',
            'descripcion' => 'nullable|max:250',
        ];

        if ($solicitudTipo) {
            $rules['slug'] = 'required|max:255|alpha_dash|unique:solicitud_tipos,slug,' . $solicitudTipo->id;
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre no debe tener más de :max caracteres.',
            'slug.required' => 'El campo slug es obligatorio.',
            'slug.unique' => 'El slug ya está en uso.',
            'slug.alpha_dash' => 'El campo slug solo puede contener letras, números, guiones y guiones bajos.',

            'descripcion.max' => 'El campo descripción no debe tener más de :max caracteres.',
        ];
    }
}
