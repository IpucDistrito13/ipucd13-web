<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Podcast;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Storage::deleteDirectory('public');

        $this->call([RolSeeder::class]);//REQUERIDO EN PRODUCCION
        $this->call([RedesSeeder::class]);//REQUERIDO EN PRODUCCION

        $this->call([DepartamentoSeeder::class]);//REQUERIDO EN PRODUCCION
        $this->call([MunicipioSeeder::class]);//REQUERIDO EN PRODUCCION
        \App\Models\Congregacion::factory(5)->create();

        User::factory()->create([
            'name' => 'Desarrollo Ipuc',
            'nombre' => 'Desarrollo',
            'apellidos' => 'D13',
            'email' => 'desarrollo@ipucdistrito13.org',
            'isbloqueo' => true,
            'estado' => 'Activo',
            
        ])->assignRole('Administrador');

        User::factory()->create([
            'name' => 'Admin Ipuc',
            'nombre' => 'Admin',
            'apellidos' => 'D13',
            'email' => 'admin@ipucdistrito13.org',
            'isbloqueo' => true,
            'estado' => 'Activo',
        ])->assignRole('Administrador');

        User::factory()->create([
            'name' => 'Decom Ipuc',
            'nombre' => 'Decom',
            'apellidos' => 'D13',
            'email' => 'decom@ipucdistrito13.org',
            'isbloqueo' => true,
            'estado' => 'Activo',
        ])->assignRole('Administrador');

        //User::factory(3700)->create(); //3700
    
        \App\Models\Evento::factory(1)->create();
        \App\Models\Cronograma::factory(1)->create();

        $this->call([SolicitudTipoSeeder::class]);
        $this->call([ComiteSeeder::class]);
        $this->call([CategoriaSeeder::class]);

        \App\Models\Podcast::factory(0)->create();
        \App\Models\Episodio::factory(0)->create();
        \App\Models\Serie::factory(0)->create();
        \App\Models\Video::factory(0)->create();

        \App\Models\Publicacion::factory(3)->create();
        \App\Models\Carpetaaux::factory(0)->create();

        $this->call([GaleriaTipoSeeder::class]);

        $this->call([LiderTipoSeeder::class]);
        \App\Models\Lider::factory(1)->create();


    }
}
