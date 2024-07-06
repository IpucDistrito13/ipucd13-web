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
        $permission = Permission::create(['name' => 'admin.roles.create', 'descripcion' => 'Crear rol'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.roles.store', 'descripcion' => 'Guardar rol'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.roles.edit', 'descripcion' => 'Editar rol'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.roles.destroy', 'descripcion' => 'Eliminar rol'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.solicitud_tipos.index', 'descripcion' => 'Ver listado tipo de solicitudes'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.solicitud_tipos.create', 'descripcion' => 'Crear tipo de solicitud'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.solicitud_tipos.edit', 'descripcion' => 'Editar tipo de solicitud'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.solicitud_tipos.destroy', 'descripcion' => 'Eliminar tipo de solicitud'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.solicitudes.index', 'descripcion' => 'Ver listado de solicitudes'])->syncRoles([$rol1, $rol2]);
        $permission = Permission::create(['name' => 'admin.solicitudes.create', 'descripcion' => 'Crear solicitud'])->syncRoles([$rol1, $rol2]);
        $permission = Permission::create(['name' => 'admin.solicitudes.edit', 'descripcion' => 'Editar solicitud'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.solicitudes.destroy', 'descripcion' => 'Eliminar solicitud'])->syncRoles([$rol3]);
        $permission = Permission::create(['name' => 'admin.solicitudes.pendientes', 'descripcion' => 'Ver listado solicitudes pendientes'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.solicitudes.respondidas', 'descripcion' => 'Ver listado solicitudes respondidas'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.solicitudes.download', 'descripcion' => 'Descargar archivo solicitud'])->syncRoles([$rol1, $rol2]);

        $permission = Permission::create(['name' => 'admin.congregaciones.index', 'descripcion' => 'Ver listado de congregaciones'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.congregaciones.create', 'descripcion' => 'Crear congregación'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.congregaciones.store', 'descripcion' => 'Guardar congregación'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.congregaciones.edit', 'descripcion' => 'Editar congregación'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.congregaciones.destroy', 'descripcion' => 'Eliminar congregación'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.comites.index', 'descripcion' => 'Ver listado de comités'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.comites.create', 'descripcion' => 'Crear comité'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.comites.edit', 'descripcion' => 'Editar comité'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.comites.destroy', 'descripcion' => 'Eliminar comité'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.categorias.index', 'descripcion' => 'Ver listado de categorías'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.categorias.create', 'descripcion' => 'Crear categoría'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.categorias.edit', 'descripcion' => 'Editar categoría'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.categorias.destroy', 'descripcion' => 'Eliminar categoría'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.podcasts.index', 'descripcion' => 'Ver listado de podcasts'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.podcasts.create', 'descripcion' => 'Crear podcasts'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.podcasts.edit', 'descripcion' => 'Editar podcasts'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.podcasts.destroy', 'descripcion' => 'Eliminar podcasts'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.podcasts.listEpisodio', 'descripcion' => 'Ver listado episodios'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.podcasts.createEpisodio', 'descripcion' => 'Crear episodio'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.episodio.apigetAudio', 'descripcion' => 'Api audio episodio'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.episodios.upload_audio', 'descripcion' => 'Guarda y reproduzca archivo de podcast'])->syncRoles([$rol1]);


        $permission = Permission::create(['name' => 'admin.episodios.index', 'descripcion' => 'Ver listado de episodios'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.episodios.create', 'descripcion' => 'Crear episodios'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.episodios.edit', 'descripcion' => 'Editar episodios'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.episodios.destroy', 'descripcion' => 'Eliminar episodios'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.episodios.upload', 'descripcion' => 'episodio subir archivo'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.series.index', 'descripcion' => 'Ver listado de series'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.series.create', 'descripcion' => 'Crear serie'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.series.edit', 'descripcion' => 'Editar serie'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.series.destroy', 'descripcion' => 'Eliminar serie'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.series.listVideos', 'descripcion' => 'Ver listado de videos'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.videos.store', 'descripcion' => 'Guardar video'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.videos.destroy', 'descripcion' => 'Eliminar video'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.usuarios.index', 'descripcion' => 'Ver listado de usuarios'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.usuarios.create', 'descripcion' => 'Crear usuario'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.usuarios.edit', 'descripcion' => 'Editar usuario'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.usuarios.destroy', 'descripcion' => 'Eliminar usuario'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.usuarios.perfil', 'descripcion' => 'Ver perfil'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.usuarios.directorioLideres', 'descripcion' => 'Direcctorio lideres'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.usuarios.directorioPastores', 'descripcion' => 'Direcctorio pastores'])->syncRoles([$rol1, $rol2, $rol3]);

        $permission = Permission::create(['name' => 'admin.eventos.index', 'descripcion' => 'Ver listado de eventos'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.eventos.create', 'descripcion' => 'Crear evento'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.eventos.store', 'descripcion' => 'Guardar evento'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.eventos.edit', 'descripcion' => 'Editar evento'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.eventos.destroy', 'descripcion' => 'Eliminar evento'])->syncRoles([$rol1]);


        $permission = Permission::create(['name' => 'admin.cronogramas.index', 'descripcion' => 'Ver listado de cronogramas'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.cronogramas.store', 'descripcion' => 'Guardar cronograma'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.cronogramas.create', 'descripcion' => 'Crear cronograma'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.cronogramas.edit', 'descripcion' => 'Editar cronograma'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.cronogramas.destroy', 'descripcion' => 'Eliminar cronograma'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.publicaciones.index', 'descripcion' => 'Ver listado de publicaciones'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.publicaciones.create', 'descripcion' => 'Crear publicación'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.publicaciones.edit', 'descripcion' => 'Editar publicación'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.publicaciones.destroy', 'descripcion' => 'Eliminar publicación'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.galeria_tipos.index', 'descripcion' => 'Ver listado tipo galerias'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galeria_tipos.create', 'descripcion' => 'Crear tipo galería'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galeria_tipos.edit', 'descripcion' => 'Editar tipo galería'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galeria_tipos.destroy', 'descripcion' => 'Eliminar tipo galería'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.galerias.index', 'descripcion' => 'Ver listado de galerias'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.galerias.create', 'descripcion' => 'Crear galeria'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galerias.edit', 'descripcion' => 'Editar galeria'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galerias.destroy', 'descripcion' => 'Eliminar galeria'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.galerias.privadoadmin', 'descripcion' => 'Galeria privada'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galerias.generaladmin', 'descripcion' => 'Galeria general'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.galerias.upload', 'descripcion' => 'Galeria subir archivo'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.galeria.destroy', 'descripcion' => 'Eliminar galeria'])->syncRoles([$rol1]);

        //$permission = Permission::create(['name' => 'admin.galerias.list', 'descripcion' => 'Ver listado galerias - General'])->syncRoles([$rol3]);

        $permission = Permission::create(['name' => 'admin.carpetas.index', 'descripcion' => 'Ver listado de carpetas'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.carpetas.create', 'descripcion' => 'Crear carpeta'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.carpetas.store', 'descripcion' => 'Guardar carpeta'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.carpetas.edit', 'descripcion' => 'Editar carpeta'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.carpetas.destroyCarpeta', 'descripcion' => 'Eliminar carpeta'])->syncRoles([$rol1]);


        //$permission = Permission::create(['name' => '', 'descripcion' => 'Descargable privado'])->syncRoles([$rol1, $rol2, $rol3]);

        $permission = Permission::create(['name' => 'admin.carpetas.listComitePrivado', 'descripcion' => 'Descargable privado'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.carpetas.listComitePublico', 'descripcion' => 'Descargable publico'])->syncRoles([$rol1, $rol2, $rol3]);

        $permission = Permission::create(['name' => 'admin.archivos.index', 'descripcion' => 'Listar archivos'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.archivos.upload', 'descripcion' => 'Subir archivo'])->syncRoles([$rol1]);
        $permission = Permission::create(['name' => 'admin.archivos.download', 'descripcion' => 'Descargar archivo'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.archivos.destroy', 'descripcion' => 'Eliminar archivo'])->syncRoles([$rol1]);


        $permission = Permission::create(['name' => 'admin.carpetas.listCarpetasPublicoComite', 'descripcion' => 'Ver listado carpeta tipo publico'])->syncRoles([$rol1, $rol2, $rol3]);
        $permission = Permission::create(['name' => 'admin.carpetas.publico.crearCarpetaPublico', 'descripcion' => 'Crear carpeta tipo publico'])->syncRoles([$rol1]);

        $permission = Permission::create(['name' => 'admin.carpetas.storeCarpetaPublico', 'descripcion' => 'Guardar carpeta tipo publico'])->syncRoles([$rol1]);
    }
}
