<?php

namespace Database\Seeders;

use App\Models\LiderTipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LiderTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LiderTipo::create([
            'nombre' => 'Lider',
            'slug' => Str::slug('Lider'),
        ]);

        LiderTipo::create([
            'nombre' => 'Sublider',
            'slug' => Str::slug('Sublider'),
        ]);

        LiderTipo::create([
            'nombre' => 'Secretario/a',
            'slug' => Str::slug('Secretario/a'),
        ]);

        LiderTipo::create([
            'nombre' => 'Tesorero/a',
            'slug' => Str::slug('Tesorero/a'),
        ]);
    }
}
