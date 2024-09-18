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
            'longitud' => 'required|max:15',
            'latitud' => 'required|max:15',
            'direccion' => 'required|max:250',
            'nombre' => 'required|max:250',
            'urlfacebook' => 'nullable|regex:/^(https?:\/\/)?(www\.)?facebook.com\/.+$/',
            'googlemaps' => 'required|regex:/^https:\/\/www\.google\.com\/maps.+$/',
            'file' => 'required|image|max:1024', // 2M = 2048
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
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre no puede tener más de :max caracteres.',
            'urlfacebook.regex' => 'El campo url de Facebook debe ser una URL válida de Facebook.',
            'googlemaps.required' => 'El campo Google Maps es obligatorio.',
            'googlemaps.regex' => 'El campo Google Maps debe ser una URL válida de Google Maps.',
        ];
    }
}
