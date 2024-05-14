<?php

use App\Http\Controllers\HomeController as ControllersHomeController;
use App\Http\Controllers\Web\Admin\CategoriaController;
use App\Http\Controllers\Web\Admin\ComiteController;
use App\Http\Controllers\Web\Admin\CongregacionController;
use App\Http\Controllers\Web\Admin\HomeController;
use App\Http\Controllers\Web\Admin\RolController;
use App\Http\Controllers\Web\Admin\SolicitudTipoController;
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


