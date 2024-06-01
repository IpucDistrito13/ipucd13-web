<?php

use App\Http\Controllers\Api\V1\ComiteController;
use App\Http\Controllers\Api\V1\CronogramaController;
use App\Http\Controllers\Api\V1\CronogramaDistritalController;
use App\Http\Controllers\Api\V1\EventoController;
use App\Http\Controllers\Api\V1\PodcastController;
use App\Http\Controllers\Api\V1\SerieController;
use App\Http\Controllers\Web\Admin\EpisodioController;
use App\Models\Comite;
use Illuminate\Support\Facades\Route;


Route::get('comites', [ComiteController::class, 'index']);
Route::get('podcasts', [PodcastController::class, 'index']);
Route::get('eventos', [EventoController::class, 'index']);
Route::get('cronogramas', [CronogramaController::class, 'index']);

Route::get('serie', [SerieController::class, 'index']);
Route::get('getAudioEpisodio/{episodio}', [EpisodioController::class, 'apigetAudio'])->name('public.audio.episodio');

Route::get('comites/{comiteId}', [ComiteController::class, 'show']);
Route::get('podcast/{comiteId}', [ComiteController::class, 'show']);





Route::middleware(['auth:sanctum'])->group(function() {
    //Route::get('logout',[LoginController::class, 'logout']);
    //Importamos la version 1 (V1)

    
});