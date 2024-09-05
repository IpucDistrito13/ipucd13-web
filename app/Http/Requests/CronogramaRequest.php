<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CronogramaRequest extends FormRequest
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
            'title' => 'required|max:100',
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
            'start.date_format' => 'El formato de la fecha de inicio es inválido. Debe ser YYYY-MM-DDTHH:MM.',
            'end.required' => 'La fecha final es obligatoria.',
            'end.date_format' => 'El formato de la fecha final es inválido. Debe ser YYYY-MM-DDTHH:MM.',
            'end.after' => 'La fecha final debe ser posterior a la fecha de inicio.',
            'lugar.max' => 'El lugar no puede tener más de :max caracteres.',
            'url.max' => 'La URL no puede tener más de :max caracteres.',
        ];
    }
}
