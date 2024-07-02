<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicacionRequest extends FormRequest
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
        $publicacion = $this->route()->parameter('publicacion');

        $rules = [
            'titulo' => 'required|max:255',
            'slug' => 'required|max:255|alpha_dash|unique:publicaciones,slug',
            'descripcion' => 'required|max:250',
            'contenido' => 'required',
            'comite' => 'required|exists:comites,id',
            'categoria' => 'required|exists:categorias,id',
            'estado' => 'required|in:Borrador,Publicado',
            'file' => 'nullable|image|max:2048',
        ];

        if ($publicacion) {
            $rules['slug'] = 'required|max:255|alpha_dash|unique:publicaciones,slug,' . $publicacion->id;
        }

        return $rules;
    }


}