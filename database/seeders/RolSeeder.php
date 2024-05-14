<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $rol1 = Role::create(['name' => 'Administrador', 'isbloqued' => 'Si']);
        $rol2 = Role::create(['name' => 'Pastor', 'isbloqued' => 'Si']);
        $rol3 = Role::create(['name' => 'Lider', 'isbloqued' => 'Si']);

        $permission = Permission::create(['name' => 'admin.roles.index', 'descripcion' => 'Ver listado de roles'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.roles.create', 'descripcion' => 'Crear rol' ])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.roles.store', 'descripcion' => 'Guardar rol'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.roles.edit', 'descripcion' => 'Editar rol'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.roles.destroy', 'descripcion' => 'Eliminar rol'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.solicitud_tipos.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.solicitud_tipos.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.solicitud_tipos.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.solicitud_tipos.destroy'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.congregaciones.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.congregaciones.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.congregaciones.store'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.congregaciones.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.congregaciones.destroy'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.comites.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.comites.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.comites.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.comites.destroy'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.categorias.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.categorias.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.categorias.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.categorias.destroy'])->syncRoles([$rol1]);

        /*
        $permission = Permission::create(['name' => 'admin.solicitudes.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.solicitudes.create'])->syncRoles([$rol2]);
        $permission = Permission::create(['name' => 'admin.solicitudes.store'])->syncRoles([$rol2]);
        $permission = Permission::create(['name' => 'admin.solicitudes.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.solicitudes.destroy'])->syncRoles([$rol2]);

        
        $permission = Permission::create(['name' => 'admin.eventos.index'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.eventos.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.eventos.store'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.eventos.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.eventos.destroy'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.cronogramas.index'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.cronogramas.store'])->syncRoles([$rol1]);     
        $permission = Permission::create(['name' => 'admin.cronogramas.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.cronogramas.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.cronogramas.destroy'])->syncRoles([$rol1]);

        ## DESCARGABLES
        ###############


        
        $permission = Permission::create(['name' => 'admin.galeria_types.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galeria_types.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galeria_types.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galeria_types.destroy'])->syncRoles([$rol1]);
        

        $permission = Permission::create(['name' => 'admin.categorias.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.categorias.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.categorias.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.categorias.destroy'])->syncRoles([$rol1]);



        $permission = Permission::create(['name' => 'admin.etiquetas.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.etiquetas.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.etiquetas.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.etiquetas.destroy'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.podcasts.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.podcasts.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.podcasts.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.podcasts.destroy'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.podcasts.listEpisodio'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.podcasts.createEpisodio'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.episodio.apigetAudio'])->syncRoles([$rol1]);


        $permission = Permission::create(['name' => 'admin.series.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.series.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.series.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.series.destroy'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.series.list'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.series.listVideos'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.videos.store'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.videos.destroy'])->syncRoles([$rol1]);


        $permission = Permission::create(['name' => 'admin.galerias.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galerias.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galerias.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galerias.destroy'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.galerias.privadoadmin'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galerias.generaladmin'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.galerias.upload'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.galerias.listpastores'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.galerias.listlideres'])->syncRoles([$rol1, $rol2, $rol3]);

        $permission = Permission::create(['name' => 'admin.usuarios.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.usuarios.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.usuarios.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.usuarios.destroy'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.usuarios.perfil'])->syncRoles([$rol1, $rol2, $rol3]);


        $permission = Permission::create(['name' => 'admin.posts.index'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.posts.create'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.posts.edit'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.posts.destroy'])->syncRoles([$rol1]);
        */     

    }
}
