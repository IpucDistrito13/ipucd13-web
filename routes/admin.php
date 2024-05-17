<?php

use App\Http\Controllers\HomeController as ControllersHomeController;
use App\Http\Controllers\Web\Admin\CategoriaController;
use App\Http\Controllers\Web\Admin\ComiteController;
use App\Http\Controllers\Web\Admin\CongregacionController;
use App\Http\Controllers\Web\Admin\CronogramaController;
use App\Http\Controllers\Web\Admin\DatatableController;
use App\Http\Controllers\Web\Admin\EpisodioController;
use App\Http\Controllers\Web\Admin\EventoController;
use App\Http\Controllers\Web\Admin\HomeController;
use App\Http\Controllers\Web\Admin\PodcastController;
use App\Http\Controllers\Web\Admin\PublicacionController;
use App\Http\Controllers\Web\Admin\RolController;
use App\Http\Controllers\Web\Admin\SerieController;
use App\Http\Controllers\Web\Admin\SolicitudTipoController;
use App\Http\Controllers\Web\Admin\UsuarioController;
use App\Http\Controllers\Web\Admin\VideoController;
use App\Models\Episodio;
use App\Models\GaleriaTipo;
use App\Models\SolicitudTipo;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::resource('roles', RolController::class)->names('admin.roles');
Route::resource('solicitud_tipos', SolicitudTipoController::class)->names('admin.solicitud_tipos');

Route::resource('congregaciones', CongregacionController::class)->names('admin.congregaciones')->parameters([
    'congregaciones' => 'congregacion', // Cambia el nombre del parámetro de la ruta
]);

Route::resource('comites', ComiteController::class)->names('admin.comites');
Route::resource('categorias', CategoriaController::class)->names('admin.categorias');
Route::resource('podcasts', PodcastController::class)->names('admin.podcasts');

Route::get('podcasts', [PodcastController::class, 'index'])->name('admin.podcasts.index');
Route::get('podcasts/episodios/{podcast}', [PodcastController::class, 'listEpisodio'])->name('admin.podcasts.listEpisodio'); // CREAR NUEVO EPISODIO
Route::get('podcast/episodio/new/{podcast}', [PodcastController::class, 'createEpisodio'])->name('admin.podcasts.createEpisodio'); // CREAR NUEVO EPISODIO

Route::resource('episodios', EpisodioController::class)->names('admin.episodios');

Route::get('episodios/apigetAudio/{episodioid}', [EpisodioController::class, 'apigetAudio'])->name('admin.episodio.apigetAudio');
Route::get('episodio/{episodio}', function ($episodioid) {
    $audio = Episodio::select('id', 'titulo', 'url')->where('id', $episodioid)->first();
    return $audio;
});

//Route::resource('videos', VideoController::class)->names('admin.videos');
//Route::get('series', [SerieController::class, 'index'])->name('admin.series.index');//LISTAR TODOS


////////////////////Error
Route::get('series', [SerieController::class, 'index'])->name('admin.series.index');
Route::get('series/video/{serie}', [SerieController::class, 'listVideos'])->name('admin.series.listVideos');
Route::get('series/create', [SerieController::class, 'create'])->name('admin.series.create');
Route::post('series/store', [SerieController::class, 'store'])->name('admin.series.store');
Route::post('series/update/{serie}', [SerieController::class, 'update'])->name('admin.series.update');
Route::get('series/video/{serie}/edit', [SerieController::class, 'edit'])->name('admin.series.edit');
Route::delete('series/{serie}/delete', [SerieController::class, 'destroy'])->name('admin.series.destroy');

Route::resource('videos', VideoController::class)->names('admin.videos');

Route::resource('usuarios', UsuarioController::class)->names('admin.usuarios');
Route::get('user', [UsuarioController::class, 'list'])->name('admin.usuarios.list');


Route::get('datatable/usuarios', [DatatableController::class, 'usuarios'])->name('datatable.usuarios'); //LISTAR TODOS


Route::get('perfil', [UsuarioController::class, 'perfil'])->name('admin.usuario.perfil'); //LISTAR TODOS
Route::post('usuarios/update/{usuario}', [UsuarioController::class, 'updatePerfil'])->name('admin.usuarios.updatePerfil'); //LISTAR TODOS

Route::resource('eventos', EventoController::class)->names('admin.eventos');
Route::get('apiGetEventos', [EventoController::class, 'apiGetEventos'])->name('public.eventos.apiGetEventos');

Route::resource('cronogramas', CronogramaController::class)->names('admin.cronogramas');
Route::get('apiGetCronogramas', [CronogramaController::class, 'apiGetCronogramas'])->name('public.cronogramas.apiGetCronogramas');

//CAMBIAMOS PARAMETRO A PUBLICACION
Route::resource('publicaciones', PublicacionController::class)
    ->names('admin.publicaciones')
    ->parameter('publicaciones', 'publicacion');


Route::resource('galeria_tipos', GaleriaTipo::class)->names('admin.galeria_tipos');
