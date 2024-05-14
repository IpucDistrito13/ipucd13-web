<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Estudio biblico',
            'slug' => 'estudio-biblico',
            'descripcion' => 'Estudio Biblico texto',
            'estado' => 'Activo',
        ]);

        Categoria::create([
            'nombre' => 'Documental',
            'slug' => 'documental',
            'descripcion' => 'documental texto',
            'estado' => 'Activo',
        ]);

        Categoria::create([
            'nombre' => 'Testimonio',
            'slug' => 'testimonio',
            'descripcion' => 'Textimonio texto',
            'estado' => 'Activo',
        ]);

        Categoria::create([
            'nombre' => 'Informativo',
            'slug' => 'informativo',
            'estado' => 'Inactivo',
        ]);
    }
}
