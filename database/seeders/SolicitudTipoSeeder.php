<?php

namespace Database\Seeders;

use App\Models\Solicitud_tipo;
use App\Models\SolicitudTipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SolicitudTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SolicitudTipo::create([
            'nombre' => 'Certificado bautismo',
            'slug' => 'certificado-bautismo',
            'isbloqued' => 'Si',
            'descripcion' => 'Certificado bautismo',
        ]);

        SolicitudTipo::create([
            'nombre' => 'Diploma bautismo',
            'slug' => 'diploma-bautismo',
            'isbloqued' => 'Si',
            'descripcion' => 'Diploma bautismo',
        ]);

        SolicitudTipo::create([
            'nombre' => 'Certificado membresía',
            'slug' => 'certificado-membresia',
            'isbloqued' => 'Si',
            'descripcion' => 'Certificado membresía',
        ]);
    }
}
