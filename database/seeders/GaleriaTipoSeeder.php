<?php

namespace Database\Seeders;

use App\Models\GaleriaTipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GaleriaTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GaleriaTipo::create([
            'nombre' => 'General',
            'slug' => 'general',
            'descripcion' => 'Galeria general pastores y lideres',
        ]);

        GaleriaTipo::create([
            'nombre' => 'Privado',
            'slug' => 'privado',
            'descripcion' => 'Galeria privada por pastor',
        ]);
    }
}
