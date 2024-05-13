<?php

namespace Database\Seeders;

use App\Models\Cronograma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CronogramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cronograma::create([
            'title' => 'Evento 1',
            'start' => '2024-05-13 10:30:00',
            'end' => '2024-05-15 15:00:00',
            'backgroundColor' => '#f39c12',
            'borderColor' => '#f39c12',
            'lugar' => 'Calle 1',
            'descripcion' => 'descripcion 1',
            'url' => 'www.google.com',
        ]);
    }
}
