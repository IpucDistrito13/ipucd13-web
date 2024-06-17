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
    
        // Inicializa las reglas básicas
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
                'nullable', // Por defecto es nullable
            ],
        ];
    
        // Revisa si alguno de los roles seleccionados es 2 (pastor)
        if (in_array(2, request()->input('roles', []))) {
            $rules['codigo'][] = 'required'; // Añade la regla de requerido
    
            // Añade la regla de unicidad para el campo 'codigo'
            $codigoRule = 'unique:users,codigo';
            if ($usuario) {
                $codigoRule .= ',' . $usuario->id;
            }
            $rules['codigo'][] = $codigoRule;
        }
    
        // Ajusta la regla de email para permitir duplicados en la actualización del usuario actual
        if ($usuario) {
            $rules['email'] = 'required|email|unique:users,email,' . $usuario->id;
        }
    
        return $rules;
    }
    

    public function messages(): array
    {
        return [
            'congregacion.required' => 'El campo congregación es obligatorio.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre no debe ser mayor a :max caracteres.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.max' => 'El campo apellidos no debe ser mayor a :max caracteres.',
            'celular.required' => 'El campo celular es obligatorio.',
            'celular.regex' => 'El campo celular debe tener un formato válido (10 dígitos numéricos).',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'email.max' => 'El campo email no debe ser mayor a :max caracteres.',
            'email.unique' => 'El campo email ya ha sido registrado.',
            'file.image' => 'El archivo debe ser una imagen válida.',
            'roles.required' => 'Debe seleccionar al menos un rol.',
            'roles.array' => 'Los roles deben ser proporcionados en formato de arreglo.',
            'roles.*.exists' => 'Uno de los roles seleccionados no es válido.',
            'codigo.required_if' => 'El campo código es obligatorio cuando el segundo rol es seleccionado.',
            'codigo.unique' => 'El campo código ya ha sido registrado.',
        ];
    }
}
