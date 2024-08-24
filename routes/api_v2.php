<?php

use App\Http\Controllers\Api\V2\ComiteController;
use App\Http\Controllers\Api\V2\CronogramaController;
use App\Http\Controllers\Api\V2\EventoController;
use App\Http\Controllers\Api\V2\InformeController;
use App\Http\Controllers\Api\V2\LiderController;
use App\Http\Controllers\Api\V2\PodcastController;
use App\Http\Controllers\Api\V2\SerieController;
use Illuminate\Support\Facades\Route;

Route::get('comites', [ComiteController::class, 'index']);
Route::get('podcasts/comite/{comiteId}', [PodcastController::class, 'getPodcastsByComite']);
Route::get('lideres/comite/{comiteId}', [LiderController::class, 'getLideresByComite']);

Route::get('podcasts', [PodcastController::class, 'index']);
Route::get('series', [SerieController::class, 'index']);
Route::get('informes', [InformeController::class, 'index']);
Route::get('eventos', [EventoController::class, 'index']);
Route::get('cronogramas', [CronogramaController::class, 'index']);

Route::get('comite/{id}', [ComiteController::class, 'show']);
Route::get('podcast/{id}', [PodcastController::class, 'show']);


Route::get('serie/{id}', [SerieController::class, 'show']);



Route::middleware(['auth:sanctum'])->group(function() {

    
});
