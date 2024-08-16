<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermisoRequest extends FormRequest
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
            'name' => 'required|max:250',
            'descripcion' => 'required|max:250',
            'guard_name' => 'required|in:web,api',
            'roles' => 'required|array|min:1', // Asegura que al menos un rol esté seleccionado
            'roles.*' => 'exists:roles,id', // Valida que cada rol seleccionado exista en la tabla de roles
        ];
    }
}
