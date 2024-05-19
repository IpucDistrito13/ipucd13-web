<?php

use App\Http\Controllers\Api\V1\ComiteController;
use App\Http\Controllers\Api\V1\PodcastController;
use Illuminate\Support\Facades\Route;


Route::get('comites', [ComiteController::class, 'index']);
Route::get('podcasts', [PodcastController::class, 'index']);


Route::middleware(['auth:sanctum'])->group(function() {
    //Route::get('logout',[LoginController::class, 'logout']);
    //Importamos la version 1 (V1)

    
});