<?php

namespace Database\Seeders;

use App\Models\Congregacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CongregacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Congregacion::create([
            'municipio' => 1,
            'direccion' => 'Clle 13 B Av.16 Olga Teresa (Av.Las Américas) Cúcuta, Colombia',
            'estado' =>'Activo',
        ]);
    }
}
