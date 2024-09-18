@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">IPUC en Línea</h1>
        <div>
            <a class="btn btn-warning btn-sm" href="https://online.tiipuc.org/Seguridad/Login?ReturnUrl=%2F" target="_blank">
                <i class="fas fa-globe"></i> Ingresar aquí
            </a>
        </div>
    </div>
@stop

@section('content')
<div class="row">
    <!-- Tarjeta del video -->
    <div class="col-12 d-flex align-items-stretch">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                <b>Video Instructivo - IPUC en Línea</b>
                <br>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-12 text-center">
                        <video id="player" class="plyr" controls>
                            <source src="https://ipucd13.nyc3.cdn.digitaloceanspaces.com/public/videos/Video%20instructivo%20-%20Ipuc%20en%20Linea.mp4" type="video/mp4">
                            Tu navegador no soporta la reproducción de videos.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Incluir estilos de Plyr.js --}}
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css">
@stop

@section('js')
    {{-- Incluir script de Plyr.js --}}
    <script src="https://cdn.plyr.io/3.7.2/plyr.polyfilled.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Inicializar Plyr en el video
            const player = new Plyr('#player');
        });
    </script>
@stop
