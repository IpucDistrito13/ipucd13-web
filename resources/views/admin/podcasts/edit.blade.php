@extends('adminlte::page')

@section('title', 'Editar podcat')

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">Editar Podcast: {{ $podcast->titulo }}</h1>
        <div>
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.podcasts.index') }}">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
    @endif

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <span id="card_title">
                Datos Podcast
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <form method="POST" action="{{ route('admin.podcasts.update', $podcast) }}" autocomplete="off"
                enctype="multipart/form-data" file="true">
                @csrf
                @method('PUT') <!-- Establece el método PUT -->

                @include('admin.podcasts.form', $podcast);

                <div class="modal-footer">
                    <a class="btn btn-secondary" href="{{ route('admin.podcasts.index') }}">Volver</a>
                    <button type="submit" class="btn btn-success float-right">Actualizar</button>
                </div>
            </form>

        </div>

    </div>
@stop

@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">


    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%
        }

        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>

@stop

@section('js')

    <script>
        showErrores();

        function showErrores() {
            @if ($errors->any())

                @foreach ($errors->all() as $error)
                    console.error('{{ $error }}');
                @endforeach
            @endif
        }

        // generate slug
        function generateSlug(inputText) {
            var slug = inputText.toLowerCase().replace(/[^a-zA-Z0-9 -]/g, '').replace(/\s+/g, '-');
            return slug;
        }

        function updateSlug() {
            var nombreInput = document.getElementById("nombre");
            var slugInput = document.getElementById("slug");

            if (nombreInput && slugInput) {
                var nombre = nombreInput.value;
                var slug = generateSlug(nombre);
                slugInput.value = slug;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            updateSlug();
        });

        // end generate slug

        //Mostrar imagen
        function redirectUpdate(url) {
            window.location.href = url;
        }

        document.getElementById("imagen").addEventListener("change", cambiarImagen);

        function cambiarImagen(evento) {
            var file = evento.target.files[0];
            var reader = new FileReader();
            reader.onload = function(evento) {
                document.getElementById("imagen").src = evento.target.result;
            }
            reader.readAsDataURL(file);
        }
        //end mostrar imagen

        //Mostrar imagen banner
        function cambiarImagenBanner(evento) {
            var file = evento.target.files[0];
            var reader = new FileReader();
            reader.onload = function(evento) {
                document.getElementById("imagen_banner").src = evento.target.result;
            }
            reader.readAsDataURL(file);
        }
        //end mostrar imagen banner
    </script>
@stop
