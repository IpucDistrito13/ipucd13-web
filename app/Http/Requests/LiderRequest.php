<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiderRequest extends FormRequest
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
            'tipo' => 'required|integer',
            'comite' => 'required|integer',
            'usuario' => 'required|integer',
            'file' => 'required|image|dimensions:width=600,height=755',
        ];
    }
}
