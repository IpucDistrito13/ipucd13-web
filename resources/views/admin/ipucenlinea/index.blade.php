@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">IPUC en Línea</h1>
        <div>
            <a class="btn btn-warning btn-sm" href="https://online.tiipuc.org/Seguridad/Login?ReturnUrl=%2F" target="_blank">
                <i class="fas fa-globe"></i> IPUC en Línea
            </a>
        </div>
    </div>
@stop

@section('content')


<div class="row">
    <!-- Tarjeta del primer tutorial -->
    <div class="col-12 col-md-6 d-flex align-items-stretch">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                <b>Tutorial #1</b>
                <br>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="embed-responsive embed-responsive-16by9">
                            <div class="plyr__video-embed" id="player1">
                                <iframe src="https://www.youtube.com/watch?v=OCrXXNGoqqI&t=813s"
                                    allowfullscreen allowtransparency allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tarjeta del segundo tutorial -->
    <div class="col-12 col-md-6 d-flex align-items-stretch">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                <b>Tutorial #2</b>
                <br>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="embed-responsive embed-responsive-16by9">
                            <div class="plyr__video-embed" id="player2">
                                <iframe src="https://www.youtube.com/watch?v=OCrXXNGoqqI&t=813s"
                                    allowfullscreen allowtransparency allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
