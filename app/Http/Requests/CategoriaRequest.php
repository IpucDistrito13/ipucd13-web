<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
        $categoria = $this->route()->parameter('categoria');
    
        // Reglas de validación por defecto
        $rules = [
            'nombre' => 'required|max:50',
            'slug' => 'required|max:255|alpha_dash|unique:categorias,slug',
            'descripcion' => 'required|max:1000',
            'file' => 'required|image|dimensions:width=480,height=640',
            'imagen_banner' => 'required|image|dimensions:width=1920,height=500',
        ];
    
        // Si hay una categoría, aplicar regla de validación condicional para el slug
        if ($categoria) {
            $rules['slug'] = 'required|max:255|alpha_dash|unique:categorias,slug,' . $categoria->id;
            $rules['file'] = 'nullable|image|dimensions:width=480,height=640';
            $rules['imagen_banner'] = 'nullable|image|dimensions:width=1920,height=500';   
        }
    
        return $rules;
    }
    
    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre no debe tener más de :max caracteres.',
            'slug.required' => 'El campo slug es obligatorio.',
            'slug.unique' => 'El valor ingresado en el campo slug ya está en uso.',
            'slug.alpha_dash' => 'El campo slug solo puede contener letras, números, guiones y guiones bajos.',
            'descripcion.max' => 'El campo descripción no debe tener más de :max caracteres.',
            'file.required' => 'El campo nombre es obligatorio.',
            'file.image' => 'El archivo debe ser una imagen.',
        ];
    }
}
