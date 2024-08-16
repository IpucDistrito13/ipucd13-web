<?php

use App\Http\Controllers\Api\V2\ComiteController;
use App\Http\Controllers\Api\V2\PodcastController;
use Illuminate\Support\Facades\Route;

Route::get('comites', [ComiteController::class, 'index']);
Route::get('podcasts', [PodcastController::class, 'index']);


Route::middleware(['auth:sanctum'])->group(function() {

    
});
