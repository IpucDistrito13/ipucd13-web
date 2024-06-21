@extends('adminlte::page')

@section('title', 'Responder solicitud')

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">Detalles solicitud: {{ $solicitud->uuid }}</h1>

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
                Datos usuario
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <form method="POST" action="{{ route('admin.solicitudes.update', $solicitud) }}" autocomplete="off"
                enctype="multipart/form-data" file="true">
                @csrf
                @method('PUT') <!-- Establece el método PUT -->

                <input type="hidden" name="id" id="id" value="{{ $solicitud->id }}">

                <div class="row">


                    <div class="col-sm-3">
                        <!-- select input -->
                        <div class="form-group">
                            <label>Tipo de solicitud *</label>
                            <select id="solicitud" name="solicitud" class="form-control" disabled>
                                <option value="" selected disabled>Selecciona</option>
                                @foreach ($solicitudTipo as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ isset($solicitud) && $solicitud->solicitud_tipo_id == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('solicitud')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Hidden input to store the selected value since the select is disabled -->
                    <input type="hidden" name="solicitud"
                        value="{{ isset($solicitud) ? $solicitud->solicitud_tipo_id : '' }}">


                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Código *</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" readonly
                                value="{{ old('titulo', $user->codigo ?? '') }}">
                            @error('titulo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nombre *</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" readonly
                                value="{{ old('titulo', $user->nombre ?? '') }}">
                            @error('titulo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Apellidos *</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" readonly
                                value="{{ old('titulo', $user->apellidos ?? '') }}">
                            @error('titulo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Departamento *</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" readonly
                                value="{{ old('titulo', $user->congregacion->municipio->departamento->nombre ?? '') }}">
                            @error('titulo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Municipio *</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" readonly
                                value="{{ old('titulo', $user->congregacion->municipio->nombre ?? '') }}">
                            @error('titulo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Congregación *</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" readonly
                                value="{{ old('titulo', $user->congregacion->direccion ?? '') }}">
                            @error('titulo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">

                            @if ($solicitud->estado == '1' && isset($solicitud->url) && $solicitud->url)
                                <a href="{{ route('admin.solicitudes.download', $solicitud) }}"
                                    class="btn btn-success btn-sm">Descargar ahora</a>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Añadir archivo (pdf, jpg, jpeg, png ) *</label>
                            <input class="form-control-file" type="file" name="file" id="file"
                                accept=".pdf,.jpg,.jpeg,.png" onchange="cambiarImagen(event)"> @error('file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <a class="btn btn-secondary" href="javascript:history.back()">Volver</a>
                    @can('admin.solicitudes.edit')
                        <button type="submit" class="btn btn-primary float-right">Actualizar</button>
                    @endcan
                </div>
            </form>

        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap4.min.css">
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


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap4.min.js"></script>

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
            var nombreInput = document.getElementById("titulo");
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

        //Mostrar imagen
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
    </script>


@stop
