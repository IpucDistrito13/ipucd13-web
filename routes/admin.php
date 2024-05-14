<?php

use App\Http\Controllers\HomeController as ControllersHomeController;
use App\Http\Controllers\Web\Admin\CategoriaController;
use App\Http\Controllers\Web\Admin\ComiteController;
use App\Http\Controllers\Web\Admin\CongregacionController;
use App\Http\Controllers\Web\Admin\EpisodioController;
use App\Http\Controllers\Web\Admin\HomeController;
use App\Http\Controllers\Web\Admin\PodcastController;
use App\Http\Controllers\Web\Admin\RolController;
use App\Http\Controllers\Web\Admin\SerieController;
use App\Http\Controllers\Web\Admin\SolicitudTipoController;
use App\Http\Controllers\Web\Admin\VideoController;
use App\Models\Episodio;
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
//Route::delete('videos/{video}/delete', [VideoController::class, 'destroy'])->name('admin.videos.destroy');



// Aquí se incluyen las rutas generadas por Route::resource()


////////////////////
//Route::delete('videos/{videos}', [VideoController::class, 'destroy'])->name('admin.videos.destroy');//EDITAR LA SERIE


/*

Route::get('series', [SerieController::class, 'index'])->name('admin.series.index');//LISTAR TODOS
Route::get('series/video/{serie}', [SerieController::class, 'listVideos'])->name('admin.series.listVideos');//LISTAR TODOS VIDEOS SEGUN LA SERIE


Route::get('series/create', [SerieController::class, 'create'])->name('admin.series.create');//LISTAR TODOS
Route::post('series/store', [SerieController::class, 'store'])->name('admin.series.store');//LISTAR TODOS
Route::post('series/update/{serie}', [SerieController::class, 'update'])->name('admin.series.update');//ACTUALIZAR LA SERIE
Route::get('series/video/{serie}/edit', [SerieController::class, 'edit'])->name('admin.series.edit');//EDITAR LA SERIE
Route::delete('series/{serie}/edit', [SerieController::class, 'destroy'])->name('admin.series.destroy');//EDITAR LA SERIE

*/



/*
Route::get('series', [SerieController::class, 'list'])->name('admin.series.list');//LISTAR TODOS
Route::get('series/create', [SerieController::class, 'create'])->name('admin.series.create');//LISTAR TODOS
Route::post('series/store', [SerieController::class, 'store'])->name('admin.series.store');//LISTAR TODOS
Route::get('series/video/{serie}', [SerieController::class, 'listVideos'])->name('admin.series.listVideos');//LISTAR TODOS VIDEOS SEGUN LA SERIE
Route::post('series/update/{serie}', [SerieController::class, 'update'])->name('admin.series.update');//ACTUALIZAR LA SERIE
Route::get('series/video/{serie}/edit', [SerieController::class, 'edit'])->name('admin.series.edit');//EDITAR LA SERIE
Route::delete('series/{serie}/edit', [SerieController::class, 'destroy'])->name('admin.series.destroy');//EDITAR LA SERIE

Route::resource('videos', VideoController::class)->names('admin.videos');*/
