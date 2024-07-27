<?php

use App\Http\Controllers\Api\V1\ComiteController;
use App\Http\Controllers\Api\V1\CronogramaController;
use App\Http\Controllers\Api\V1\EventoController;
use App\Http\Controllers\Api\V1\InformesController;
use App\Http\Controllers\Api\V1\PodcastController;
use App\Http\Controllers\Api\V1\SerieController;
use App\Http\Controllers\Web\Admin\EpisodioController;
use Illuminate\Support\Facades\Route;


Route::get('comites', [ComiteController::class, 'index']);
Route::get('eventos', [EventoController::class, 'index']);
Route::get('cronogramas', [CronogramaController::class, 'index']);
Route::get('podcasts', [PodcastController::class, 'index']);
Route::get('series', [SerieController::class, 'index']);
Route::get('informes', [InformesController::class, 'index']);

Route::get('podcasts/{podcastId}', [PodcastController::class, 'show']);
Route::get('series/{serieId}', [SerieController::class, 'show']);
Route::get('informes/{informeId}', [InformesController::class, 'show']);
Route::get('getAudioEpisodio/{episodio}', [EpisodioController::class, 'apigetAudio'])->name('public.audio.episodio');

Route::get('comites/{comiteId}', [ComiteController::class, 'show']);






Route::middleware(['auth:sanctum'])->group(function() {
    //Route::get('logout',[LoginController::class, 'logout']);
    //Importamos la version 1 (V1)

    
});