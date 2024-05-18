<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CongregacionRequest extends FormRequest
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
       // $congregacion = $this->route->parameter('congregacion');

        // Reglas de validación por defecto
        $rules = [
            'municipio' => 'required|numeric',
            'longitud' => 'nullable|max:10',
            'latitud' => 'nullable|max:10',
            'direccion' => 'required|max:250',
        ];

        

        return $rules;
    }

    public function messages()
    {
        return [
            'municipio.required' => 'El campo municipio es obligatorio.',
            'municipio.numeric' => 'El campo municipio debe ser un valor numérico.',
            'longitud.max' => 'El campo longitud no puede tener más de :max caracteres.',
            'latitud.max' => 'El campo latitud no puede tener más de :max caracteres.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.max' => 'El campo dirección no puede tener más de :max caracteres.',
        ];
    }
}