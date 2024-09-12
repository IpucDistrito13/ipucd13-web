<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodioRequest extends FormRequest
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

        $episodio = $this->route()->parameter(name: 'episodio');

        $rules = [
            'titulo' => 'required|string|max:250',
            'slug' => 'required|string|max:255',
            'descripcion' => 'required|max:255',
            'url' => 'nullable',
        ];

        // SI hay un episodio, aplicar regla de validacion condicional para el slu
        if ($episodio) {
            $rules['slug'] = 'required|max:255|alpha_dash|unique:episodios,slug,' . $episodio->id;
        }

        return $rules;
    }
}
