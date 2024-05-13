<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([RolSeeder::class]);

        User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'haresje@gmail.com',

        ])->assignRole('Administrador');

        User::factory()->create([
            'name' => 'Admin Ipuc',
            'email' => 'admin@ipuc.com',
        ])->assignRole('Administrador');

        User::factory(1000)->create();


        $this->call([DepartamentoSeeder::class]);
        $this->call([MunicipioSeeder::class]);
        \App\Models\Congregacion::factory(10)->create();

        \App\Models\Evento::factory(1)->create();
        \App\Models\Cronograma::factory(1)->create();

        $this->call([SolicitudTipoSeeder::class]);
    }
}
