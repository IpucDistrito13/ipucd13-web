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
            'Ábrego',
            'Arboledas',
            'Bochalema',
            'Bucarasica',
            'Cáchira',
            'Cácota',
            'Chinácota',
            'Chitagá',
            'Convención',
            'Cucutilla',
            'Durania',
            'El Carmen',
            'El Tarra',
            'El Zulia',
            'Gramalote',
            'Hacarí',
            'Herrán',
            'La Esperanza',
            'La Playa',
            'Labateca',
            'Los Patios',
            'Lourdes',
            'Mutiscua',
            'Ocaña',
            'Pamplona',
            'Pamplonita',
            'Puerto Santander',
            'Ragonvalia',
            'Salazar de Las Palmas',
            'San Calixto',
            'San Cayetano',
            'Santiago',
            'Sardinata',
            'Silos',
            'Teorama',
            'Tibú',
            'Toledo',
            'Villa Caro',
            'Villa del Rosario',
        ];

        $municipios_Arauca = [
            'Arauca',
            'Arauquita',
            'Cravo Norte',
            'Fortul',
            'Puerto Rondón',
            'Saravena',
            'Tame',
        ];

        $municipios_Cesar = [
            'Aguachica',
            'Agustín Codazzi',
            'Astrea',
            'Becerril',
            'Bosconia',
            'Chimichagua',
            'Chiriguaná',
            'Curumaní',
            'El Copey',
            'El Paso',
            'Gamarra',
            'González',
            'La Gloria',
            'La Jagua de Ibirico',
            'La Paz',
            'Manaure Balcón del Cesar',
            'Pailitas',
            'Pelaya',
            'Pueblo Bello',
            'Río de Oro',
            'San Alberto',
            'San Diego',
            'San Martín',
            'Tamalameque',
            'Valledupar'
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

        foreach ($municipios_Cesar as $municipio) {
            Municipio::create([
                'nombre' => $municipio,
                'departamento_id' => 3, // Aquí asumimos que el ID del departamento de Arauca es 2
            ]);
        }
    }
}
