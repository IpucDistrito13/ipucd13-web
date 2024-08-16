<?php

use App\Http\Controllers\HomeController as ControllersHomeController;
use App\Http\Controllers\Web\Admin\ArchivoController;
use App\Http\Controllers\Web\Admin\CarpetaauxController;
use App\Http\Controllers\Web\Admin\CarpetaController;
use App\Http\Controllers\Web\Admin\CategoriaController;
use App\Http\Controllers\Web\Admin\CertificadoController;
use App\Http\Controllers\Web\Admin\ComiteController;
use App\Http\Controllers\Web\Admin\CongregacionController;
use App\Http\Controllers\Web\Admin\CronogramaController;
use App\Http\Controllers\Web\Admin\DatatableController;
use App\Http\Controllers\Web\Admin\EpisodioController;
use App\Http\Controllers\Web\Admin\EventoController;
use App\Http\Controllers\Web\Admin\FileUploadController;
use App\Http\Controllers\Web\Admin\GaleriaController;
use App\Http\Controllers\Web\Admin\GenerarApiController;
use App\Http\Controllers\Web\Admin\HomeController;
use App\Http\Controllers\Web\Admin\IpucEnLineaController;
use App\Http\Controllers\Web\Admin\LiderController;
use App\Http\Controllers\Web\Admin\LiderTipoController;
use App\Http\Controllers\Web\Admin\LogController;
use App\Http\Controllers\Web\Admin\PermisoController;
use App\Http\Controllers\Web\Admin\PodcastController;
use App\Http\Controllers\Web\Admin\PublicacionController;
use App\Http\Controllers\Web\Admin\RedesController;
use App\Http\Controllers\Web\Admin\RolController;
use App\Http\Controllers\Web\Admin\SerieController;
use App\Http\Controllers\Web\Admin\SolicitudController;
use App\Http\Controllers\Web\Admin\SolicitudTipoController;
use App\Http\Controllers\Web\Admin\UsuarioController;
use App\Http\Controllers\Web\Admin\VideoController;
use App\Models\GaleriaTipo;
use Illuminate\Support\Facades\Route;


Route::post('file-upload/upload-large-files', [FileUploadController::class, 'uploadLargeFiles'])->name('files.upload.large');

Route::get('file-upload', [FileUploadController::class, 'index'])->name('files.index');
Route::post('file-upload/upload-large-files', [FileUploadController::class, 'uploadLargeFiles'])->name('files.upload.large');

Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
Route::get('transmision', [HomeController::class, 'transmision']);

Route::post('redes/updateTransmision', [RedesController::class, 'updateTransmision'])->name('admin.redes.updateTransmision');

Route::get('datatable/usuarios', [DatatableController::class, 'usuarios'])->name('datatable.usuarios');
Route::post('datatable/galerias', [DatatableController::class, 'galeriaTodos'])->name('datatable.galeriaTodos');

Route::resource('roles', RolController::class)->names('admin.roles');
Route::resource('solicitud_tipos', SolicitudTipoController::class)->names('admin.solicitud_tipos');
Route::get('solicitudes/download/{solicitudId}', [SolicitudController::class, 'download'])->name('admin.solicitudes.download');
Route::get('solicitudes/pendientes', [SolicitudController::class, 'pendientes'])->name('admin.solicitudes.pendientes');
Route::get('solicitudes/respondidas', [SolicitudController::class, 'respondidas'])->name('admin.solicitudes.respondidas');
//Route::get('solicitudes/download/{solicitudId}', [SolicitudController::class, 'download'])->name('admin.solicitudes.download');// CREAR NUEVO EPISODIO
Route::get('certificado/bautismo', [CertificadoController::class, 'certificadoBautismo'])->name('admin.certificado.bautismo');
Route::post('certificado/bautismo/download', [CertificadoController::class, 'downloadCertificadoBautismo'])->name('admin.certificado.bautismo.download');

Route::resource('solicitudes', SolicitudController::class)->names('admin.solicitudes')->parameters([
    'solicitudes' => 'solicitud',
]);

Route::resource('congregaciones', CongregacionController::class)->names('admin.congregaciones')->parameters([
    'congregaciones' => 'congregacion', // Cambia el nombre del parámetro de la ruta
]);

Route::resource('comites', ComiteController::class)->names('admin.comites');
Route::resource('categorias', CategoriaController::class)->names('admin.categorias');

Route::get('podcasts/episodios/{podcast}', [PodcastController::class, 'listEpisodio'])->name('admin.podcasts.listEpisodio');
Route::resource('podcasts', PodcastController::class)->names('admin.podcasts');
// LISTAR LOS EPISODIOS SEGUN EL PODCAST

Route::get('episodios/testFile/{episodioId}', [EpisodioController::class, 'testFile'])->name('admin.episodios.testFile'); //P

Route::resource('episodios', EpisodioController::class)->names('admin.episodios');
Route::get('episodios/file-upload/{episodioId}', [EpisodioController::class, 'uploadFile'])->name('admin.episodios.file_upload'); //P
//Route::post('episodios/file-upload/upload-large-files', [EpisodioController::class, 'uploadLargeFiles'])->name('admin.episodios.upload_large');//P
Route::post('admin/episodios/upload_large', [EpisodioController::class, 'uploadLargeFiles'])->name('admin.episodios.upload_audio');



Route::post('episodios/uploadUrl', [EpisodioController::class, 'uploadUrl'])->name('admin.episodios.upload');
Route::get('episodios/apigetAudio/{episodioid}', [EpisodioController::class, 'apigetAudio'])->name('admin.episodio.apigetAudio');


//Route::post('series/storeaux', [SerieController::class, 'storeaux'])->name('admin.series.store');
Route::resource('series', SerieController::class)->names('admin.series')->parameters([
    'series' => 'serie', // Cambia el nombre del parámetro de la ruta
]);
// LISTAR LOS VIDEOS SEGUN LA SERIE
Route::get('series/videos/{serie}', [SerieController::class, 'listVideos'])->name('admin.series.listVideos');
Route::resource('videos', VideoController::class)->names('admin.videos');

Route::resource('usuarios', UsuarioController::class)->names('admin.usuarios');
Route::delete('admin/users/{id}', [UsuarioController::class, 'destroyUser'])->name('admin.usuarios.destroyUser');

Route::get('user/directorio/pastores', [UsuarioController::class, 'directorioPastores'])->name('admin.usuarios.directorioPastores');
Route::get('user/directorio/lideres', [UsuarioController::class, 'directorioLideres'])->name('admin.usuarios.directorioLideres');

Route::get('users/edit/{userId}', [UsuarioController::class, 'editar'])->name('admin.usuarios.editar');

Route::get('user/serverside', [UsuarioController::class, 'serverSideJson'])->name('admin.usuarios.serverside');


Route::get('perfil', [UsuarioController::class, 'perfil'])->name('admin.usuario.perfil'); //LISTAR TODOS
Route::post('usuarios/update/{usuario}', [UsuarioController::class, 'updatePerfil'])->name('admin.usuarios.updatePerfil'); //LISTAR TODOS

Route::resource('eventos', EventoController::class)->names('admin.eventos');
//Route::get('apiGetEventos', [EventoController::class, 'apiGetEventos'])->name('public.eventos.apiGetEventos');

Route::resource('cronogramas', CronogramaController::class)->names('admin.cronogramas');
Route::get('apiGetCronogramas', [CronogramaController::class, 'apiGetCronogramas'])->name('admin.cronogramas.apiGetCronogramas');
//Route::get('public/apiGetCronogramas', [CronogramaController::class, 'apiGetCronogramas'])->name('public.cronogramas.apiGetCronogramas');

Route::get('apiGetEventos', [EventoController::class, 'apiGetEventos'])->name('admin.eventos.apiGetEventos');

//CAMBIAMOS PARAMETRO A PUBLICACION
Route::resource('publicaciones', PublicacionController::class)
    ->names('admin.publicaciones')
    ->parameter('publicaciones', 'publicacion');


Route::resource('galeria_tipos', GaleriaTipo::class)->names('admin.galeria_tipos');

//LISTAR TODOS LOS USUARIOS CON ROL PASTOR
Route::get('galerias', [GaleriaController::class, 'index'])->name('admin.galerias.index');
//Route::get('galerias/show/lider', [GaleriaController::class, 'lider'])->name('admin.galerias.lider');

//GALERIA PRIVADA ADMIN
Route::get('galeria/privado/{usuario}', [GaleriaController::class, 'privadoAdmin'])->name('admin.galerias.privadoadmin');
Route::get('galeria/general/{usuario}', [GaleriaController::class, 'generalAdmin'])->name('admin.galerias.generalAdmin');
Route::get('galeria/generalLider/{usuario}', [GaleriaController::class, 'generalLider'])->name('admin.galerias.generalLider');

//GUARDAR IMAGENES MASIVO
Route::post('galerias/upload', [GaleriaController::class, 'upload'])->name('admin.galerias.upload');

//ELIMINA UNA IMAGEN EN ESPECIFICA
Route::delete('admin/galeria/{galeria}', [GaleriaController::class, 'destroy'])->name('admin.galeria.destroy');

//LISTAR TODOS LOS USUARIOS CON ROL PASTOR PARA LOS AUTENTICADOS TIPO LIDER
Route::get('galerias/pastores', [GaleriaController::class, 'list'])->name('admin.galerias.list');

// Elimina archivo individual desde Drozone
Route::post('file/delete', [GaleriaController::class, 'delete'])->name('file.delete');

Route::post('users/listJson', [DatatableController::class, 'listJson'])->name('users.listJson');

Route::delete('carpetas/publico/{carpetaId}', [CarpetaController::class, 'destroyCarpeta'])->name('admin.carpetas.destroyCarpeta');

Route::get('carpetas/privado', [CarpetaController::class, 'listComitePrivado'])->name('admin.carpetas.listComitePrivado');
Route::get('carpetas/publico', [CarpetaController::class, 'listComitePublico'])->name('admin.carpetas.listComitePublico');

Route::get('carpetas/privada/{comite}', [CarpetaController::class, 'listCarpetasPrivadoComite'])->name('admin.carpetas.listCarpetasPrivadoComite');
Route::get('carpetas/publico/{comite}', [CarpetaController::class, 'listCarpetasPublicoComite'])->name('admin.carpetas.listCarpetasPublicoComite');

// CREAR CARPETA PRIVADA FORMULARIO
Route::get('carpetas/privada/create/{comite}', [CarpetaController::class, 'crearCarpetaPrivada'])->name('admin.carpetas.privado.crearCarpetaPrivada');
// CREAR CARPETA PUBLICO FORMULARIO
Route::get('carpetas/publico/create/{comite}', [CarpetaController::class, 'crearCarpetaPublico'])->name('admin.carpetas.publico.crearCarpetaPublico');

// GUARDAR DATOS DE CARPETAS PRIVADA
Route::post('carpetas/storeCarpetaPrivada', [CarpetaController::class, 'storeCarpetaPrivada'])
    ->name('admin.carpetas.storeCarpetaPrivada');

// GUARDAR DATOS DE CARPETAS PUBLICO
Route::post('carpetas/storeCarpetaPublico', [CarpetaController::class, 'storeCarpetaPublico'])
    ->name('admin.carpetas.storeCarpetaPublico');

// LISTA LOS ARCHIVOS SEGUN LA CARPETA
//Route::resource('archivos', ArchivoController::class)->names('admin.archivos');
//Route::get('archivos', [ArchivoController::class, 'index'])->name('admin.archivos.index');

Route::get('archivos/{carpeta}', [ArchivoController::class, 'index'])->name('admin.archivos.index');
Route::delete('admin/archivos/{archivo}', [ArchivoController::class, 'destroy'])->name('admin.archivos.destroy');

Route::post('archivos/carpetas', [ArchivoController::class, 'upload'])->name('admin.archivos.upload');

Route::resource('carpetas', CarpetaauxController::class)->names('admin.carpetas');

Route::get('archivos/download/{archivoId}', [ArchivoController::class, 'download'])->name('admin.archivos.download');


//Route::resource('lideres_tipos', LiderTipo::class)->names('admin.lideres_tipos');
Route::resource('lideres_tipos', LiderTipoController::class)->names('admin.lideres_tipos');
Route::resource('lideres', LiderController::class)
    ->names('admin.lideres')
    ->parameter('lideres', 'lider');


Route::get('ipuc_en_linea', [IpucEnLineaController::class, 'index'])->name('admin.ipuc.linea');

Route::get('permissions', [PermisoController::class, 'index'])->name('developer.permissions.index');
Route::get('permissions/create', [PermisoController::class, 'create'])->name('developer.permissions.create');
Route::post('permissions/store', [PermisoController::class, 'store'])->name('developer.permissions.store');
Route::get('permissions/edit/{permission}', [PermisoController::class, 'edit'])->name('developer.permissions.edit');
Route::put('permissions/{permission}', [PermisoController::class, 'update'])->name('developer.permissions.update');

Route::delete('permissions/{permission}', [PermisoController::class, 'destroy'])->name('developer.permissions.destroy');


Route::resource('logs', LogController::class)->names('admin.logs');

Route::resource('apis', GenerarApiController::class)->names('admin.apis');

