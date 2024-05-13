<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Suponiendo que tienes un array con los nombres de los municipios
        $municipios_NorteDeSantander = [
            'Cúcuta',
            'Ocaña', 
            'Pamplona',
            'Chinácota',
            'Tibú',
            'El Zulia',
            'Los Patios',
            'Villa del Rosario',
            'Puerto Santander',
            'Bochalema',
            'Salazar', 
            'San Cayetano', 
            'El Tarra', 
            'Hacarí', 
            'La Esperanza', 
            'La Playa', 
            'Labateca', 
            'Ragonvalia', 
            'Sardinata', 
            'Toledo', 
            'Villa Caro', 
            'Ábrego', 
            'Arboledas', 
            'Cáchira', 
            'Convención', 
            'Durania', 
            'Gramalote', 
            'Lourdes', 
            'Mutiscua', 
            'Silos'
        ];

        $municipios_Arauca = [
            'Arauca',
            'Arauquita',
            'Cravo Norte',
            'Fortul',
            'Puerto Rondón',
            'Saravena',
            'Tame',
            'Arauquita',
            'Tame',
            'Saravena',
            'Fortul',
            'Cravo Norte',
            'Puerto Rondón',
            'Arauca'
        ];
        
        // Iteramos sobre cada municipio y los creamos en la base de datos
        foreach ($municipios_NorteDeSantander as $municipio) {
            Municipio::create([
                'nombre' => $municipio,
                'departamento_id' => 1, // Aquí asumimos que el ID del departamento de Norte de Santander es 1
            ]);
        }

        // Iteramos sobre cada municipio y los creamos en la base de datos
        foreach ($municipios_Arauca as $municipio) {
            Municipio::create([
                'nombre' => $municipio,
                'departamento_id' => 2, // Aquí asumimos que el ID del departamento de Arauca es 2
            ]);
        }
    }
}
