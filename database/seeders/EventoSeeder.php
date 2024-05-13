<?php

namespace Database\Seeders;

use App\Models\Evento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Evento::create([
            'title' => 'Evento 1',
            'start' => '2024-05-01 10:30:00',
            'end' => '2024-05-01 15:00:00',
            'backgroundColor' => '#f39c12',
            'borderColor' => '#f39c12',
            'lugar' => 'Calle 1',
            'descripcion' => 'descripcion 1',
            'url' => 'www.google.com',
        ]);
    }
}
