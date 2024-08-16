<?php

use App\Http\Controllers\Api\V2\ComiteController;
use Illuminate\Support\Facades\Route;

Route::get('comites', [ComiteController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function() {

    
});
