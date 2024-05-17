<?php

namespace App\Http\Requests;

use Encore\Admin\Auth\Database\Role;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
        $usuario = $this->route()->parameter('usuario');
    
        $rules = [
            'congregacion' => 'required',
            'nombre' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'celular' => 'required|regex:/^[0-9]{10}$/',
            'email' => 'required|email|max:250|unique:users,email',
            'file' => 'nullable|image',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
            'codigo' => [
                'nullable', // Default to nullable
                'required_if:roles.0,2', // Required if the first role is 2
            ],
        ];
    
        // Conditionally add the unique rule for 'codigo'
        if (request()->input('roles.0') == 2) {
            $codigoRule = 'unique:users,codigo';
            if ($usuario) {
                $codigoRule .= ',' . $usuario->id;
            }
            $rules['codigo'][] = $codigoRule;
        }
    
        if ($usuario) {
            $rules['email'] = 'required|email|unique:users,email,' . $usuario->id;
        }
    
        return $rules;
    }
    
    

}
