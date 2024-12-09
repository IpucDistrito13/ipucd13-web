<?php

use App\Http\Controllers\Api\V2\CertificadoController;
use App\Http\Controllers\Api\V2\ComiteController;
use App\Http\Controllers\Api\V2\CongregacionController;
use App\Http\Controllers\Api\V2\CronogramaController;
use App\Http\Controllers\Api\V2\DescargableComiteCarpetasController;
use App\Http\Controllers\Api\V2\EpisodioController;
use App\Http\Controllers\Api\V2\EventoController;
use App\Http\Controllers\Api\V2\GaleriaController;
use App\Http\Controllers\Api\V2\InformeController;
use App\Http\Controllers\Api\V2\IpucenLineaController;
use App\Http\Controllers\Api\V2\LiderController;
use App\Http\Controllers\Api\V2\PodcastController;
use App\Http\Controllers\Api\V2\SerieController;
use App\Http\Controllers\Api\V2\SliderController;
use App\Http\Controllers\Api\V2\SolicitudDescargableController;
use App\Http\Controllers\Api\V2\TransmisionController;
use App\Http\Controllers\Api\V2\UsuarioController;
use App\Http\Controllers\Api\V2\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('comites', [ComiteController::class, 'index']);
Route::get('podcasts/comite/{comiteId}', [PodcastController::class, 'getPodcastsByComite']);
Route::get('lideres/comite/{comiteId}', [LiderController::class, 'getLideresByComite']);
Route::get('series/comite/{comiteId}', [SerieController::class, 'getSeriesByComite']);
Route::get('informes/comite/{comiteId}', [InformeController::class, 'getInformesByComite']);
Route::get('podcasts', [PodcastController::class, 'index']);
Route::get('series', action: [SerieController::class, 'index']);
Route::get('informes', [InformeController::class, 'index']);
Route::get('eventos', [EventoController::class, 'index']);
Route::get('cronogramas', [CronogramaController::class, 'index']);
Route::get('comite/{id}', [ComiteController::class, 'show']);
Route::get('podcast/{id}', [PodcastController::class, 'show']);
Route::get('serie/{id}', [SerieController::class, 'show']);
Route::get('informe/{id}', [InformeController::class, 'show']);
Route::get('video/{id}', [VideoController::class, 'show']);
Route::get('episodios/podcast/{podcastId}', [EpisodioController::class, 'getEpisodiosByPodcast']);
Route::get('videos/serie/{serieId}', [VideoController::class, 'getVideosBySerie']);
Route::get('podcasts/comite/{comiteId}', [PodcastController::class, 'getPodcastsByComite']);
Route::get('congregaciones', [CongregacionController::class, 'index']);
Route::get('congregaciones/search/{query}', [CongregacionController::class, 'search']);
Route::get('transmision/envivo', [TransmisionController::class, 'getTransmisionEnVivo']);
Route::get('sliders', action: [SliderController::class, 'index']);

Route::get('certificado/bautismo/download', [CertificadoController::class, 'downloadCertificadoBautismoApi']);
Route::get('congregaciones/search/', [CongregacionController::class, 'search']);
Route::get('ipucenlinea', action: [IpucenLineaController::class, 'index']);
Route::get('descargable/carpeta/publica/comite/{uuid}', [DescargableComiteCarpetasController::class, 'getComitePublico']);
Route::get('archivo/carpeta/{uuid}', [DescargableComiteCarpetasController::class, 'getArchivosCarpeta']);
Route::get('solicitudes/archivo/download/{slug}', [SolicitudDescargableController::class, 'download'])->name('download');



Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('usuario/perfil/{uuid}', action: [UsuarioController::class, 'show']);
    Route::get('usuario/miPerfil', action: [UsuarioController::class, 'miPerfil']);

    Route::get('usuarios', [UsuarioController::class, 'getListUsuario']);
    Route::get('usuarios/pastores', [UsuarioController::class, 'getListUsuarioPastor']);
    Route::get('usuarios/lideres', [UsuarioController::class, 'getListUsuarioLider']);
    Route::get('galeria/privada/{uuid}', [GaleriaController::class, 'showGaleriaPrivadaUsuario']);
    Route::get('galeria/publica/{uuid}', [GaleriaController::class, 'showGaleriaPublicaUsuario']);
    Route::get('usuarios/pastores/search', [UsuarioController::class, 'searchPastores']);
    Route::get('usuarios/lideres/search', [UsuarioController::class, 'searchLideres']);

    //Lista las carpetas segun el comite
    //El uuid es del comite
    Route::get('descargable/carpeta/privado/comite/{uuid}', [DescargableComiteCarpetasController::class, 'getComitePrivado']);
    Route::get('carpetas/privado/comite/search', [DescargableComiteCarpetasController::class, 'searchPrivadoComite']);
    Route::get('carpetas/publica/comite/search', [DescargableComiteCarpetasController::class, 'searchPublicoComite']);
    Route::get('solicitudes/descargable/archivos', [SolicitudDescargableController::class, 'index']);
    Route::get('solicitudes/archivo/download/{slug}', [SolicitudDescargableController::class, 'download'])->name('download');
});
