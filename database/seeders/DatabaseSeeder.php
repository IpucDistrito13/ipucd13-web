<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        $this->call([RolSeeder::class]);
        $this->call([RedesSeeder::class]);

        $this->call([DepartamentoSeeder::class]);
        $this->call([MunicipioSeeder::class]);
        \App\Models\Congregacion::factory(100)->create();

        User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'haresje@gmail.com',
            'isbloqueo' => true,

        ])->assignRole('Administrador');

        User::factory()->create([
            'name' => 'Decom Ipuc',
            'email' => 'admin@ipuc.com',
            'isbloqueo' => true,
        ])->assignRole('Administrador');

        User::factory()->create([
            'name' => 'Decom Ipuc',
            'email' => 'decom@ipucdistrito13.org',
            'isbloqueo' => true,
        ])->assignRole('Administrador');

        User::factory(2000)->create();
        
        \App\Models\Evento::factory(1)->create();
        \App\Models\Cronograma::factory(1)->create();

        $this->call([SolicitudTipoSeeder::class]);
        $this->call([ComiteSeeder::class]);
        $this->call([CategoriaSeeder::class]);

        \App\Models\Podcast::factory(100)->create();
        \App\Models\Episodio::factory(2)->create();
        \App\Models\Serie::factory(90)->create();
        \App\Models\Video::factory(90)->create();

        \App\Models\Publicacion::factory(100)->create();
        $this->call([GaleriaTipoSeeder::class]);

    }
}
