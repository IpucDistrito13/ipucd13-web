<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
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
        return [
            'title' => 'required|max:50',
            'start' => 'required|date_format:Y-m-d\TH:i',
            'end' => 'required|date_format:Y-m-d\TH:i|after:start',
            'lugar' => 'nullable|max:100',
            'url' => 'nullable|max:250',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede tener más de :max caracteres.',
            'start.required' => 'La fecha de inicio es obligatoria.',
            'start.datetime' => 'El formato de la fecha de inicio es inválido.',
            'end.required' => 'La fecha final es obligatoria.',
            'end.datetime' => 'El formato de la fecha final es inválido.',
            'lugar.max' => 'El lugar no puede tener más de :max caracteres.',
            'url.max' => 'La URL no puede tener más de :max caracteres.',
        ];
    }
}