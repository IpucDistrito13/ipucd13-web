<?php

use App\Http\Controllers\Web\Admin\DatatableController;
use App\Http\Controllers\Web\InicioController;
use App\Http\Controllers\Web\Public\ComiteController;
use App\Http\Controllers\Web\Public\ContactoController;
use App\Http\Controllers\Web\Public\CronogramaController;
use App\Http\Controllers\Web\Public\DescargableController;
use App\Http\Controllers\Web\Public\EventoController;
use App\Http\Controllers\Web\Public\PublicacionController;
use App\Http\Controllers\Web\Public\SerieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [InicioController::class, 'index'])->name('inicio.index');
//Route::get('login', [SerieController::class, 'show'])->name('public.series.show');

Route::get('eventos', [EventoController::class, 'index'])->name('public.eventos.index');
Route::get('cronogramas', [CronogramaController::class, 'index'])->name('public.cronogramas.index');
//Route::get('apiGetCronogramas', [CronogramaController::class, 'apiGetCronogramas'])->name('public.cronogramas.apiGetCronogramas');

Route::get('comites/{comite}', [ComiteController::class, 'show'])->name('comite.show');
Route::get('descargables', [DescargableController::class, 'index'])->name('public.descargables.index');
Route::get('publicaciones', [PublicacionController::class, 'index'])->name('public.publicaciones.index');
Route::get('contacto', [ContactoController::class, 'index'])->name('public.contacto.index');
Route::get('publicaciones/{publicacion}', [PublicacionController::class, 'show'])->name('public.publicaciones.show');
Route::get('series', [SerieController::class, 'show'])->name('public.series.show');


