<?php

namespace Database\Seeders;

use App\Models\Redes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Redes::create([
            'iniciales' => 'Fb.',
            'nombre' => 'Facebook',
            'url' => 'https://www.facebook.com/IPUCDistrito13Oficial/',
            'icono' => 'fa-brands fa-facebook-f fs-18 me-10px',
            'estado' => 'Activo'
        ]);

        Redes::create([
            'iniciales' => 'Ig.',
            'nombre' => 'Instagram',
            'url' => 'https://www.instagram.com/ipucdistrito13oficial/',
            'icono' => 'fa-brands fa-instagram fs-18 me-10px',
            'estado' => 'Activo'
        ]);

        Redes::create([
            'iniciales' => 'Yb.',
            'nombre' => 'YouTube',
            'url' => 'https://www.youtube.com/@IPUCDistrito13Oficial',
            'icono' => 'fa-brands fa-youtube fs-18 me-10px',
            'estado' => 'Activo'
        ]);

        Redes::create([
            'iniciales' => 'Ev.',
            'nombre' => 'En vivo',
            'url' => 'https://www.youtube.com/@IPUCDistrito13Oficial',
            'icono' => 'fa-brands fa-youtube fs-18 me-10px',
            'estado' => 'Activo'
        ]);
    }
}
