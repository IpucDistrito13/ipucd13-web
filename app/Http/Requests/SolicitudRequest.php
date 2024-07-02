<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudRequest extends FormRequest
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
            'file' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Acepta JPEG, PNG y PDF, tamaño máximo de 2MB
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'El archivo es obligatorio.',
            'file.file' => 'El archivo debe ser válido.',
            'file.mimes' => 'El archivo debe ser de tipo JPEG, PNG o PDF.',
            'file.max' => 'El tamaño máximo del archivo es de :max kilobytes.',
        ];
    }
}
