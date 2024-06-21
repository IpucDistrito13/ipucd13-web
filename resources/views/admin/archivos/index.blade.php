@extends('adminlte::page')

@section('title', 'Lista archivos')

@section('content_header')

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">Carpeta: {{ $carpeta->nombre }} </h1>

        @can('admin.archivos.upload')
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_upload">
                <i class="fas fa-upload"></i> Añadir archivos
            </a>
        @endcan


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
                Lista de archivos
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="datatable" class="table table-striped table-bordered data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th class="acciones-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($archivos as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ basename($item->url) }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Group of buttons">
                                    @can('admin.archivos.download')
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('admin.archivos.download', $item->uuid) }}">Descargar</a>
                                    @endcan

                                    @can('admin.archivos.destroy')
                                        <form action="{{ route('admin.archivos.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    @endcan

                                </div>


                            </td>

                        </tr>
                    @endforeach

                    <!-- Fin del ejemplo -->
                </tbody>
            </table>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_upload">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Subir fotos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.archivos.upload') }}" method="POST" enctype="multipart/form-data"
                    class="dropzone" id="myDropzone">
                    @csrf
                    <div class="modal-body">

                        <input type="hidden" value="{{ $carpeta->id }}" id="carpeta" name="carpeta">

                        <div class="fallback">
                            <input type="file" name="file" multiple>
                        </div>

                    </div>


                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@stop

@section('css')

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

    <style>
        .acciones-column {
            width: 100px;
        }

        .counter-column {
            width: 2%;
        }
    </style>

@stop

@section('js')

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        Dropzone.options.myDropzone = {
            paramName: "file",
            //autoProcessQueue: false,
            //addRemoveLinks: true,
            dictRemoveFile: 'Eliminar',
            dictDefaultMessage: "Arrastra y suelta las fotos aquí o haz clic para seleccionar las fotos de forma masiva. Maximo 20 archivos masivo, y tamaño 200 Mb",
            maxFilesize: 200, // Tamaño máximo de archivo 100 Mb
            maxFiles: 20,
            init: function() {
                var myDropzone = this;
                this.on("queuecomplete", function() {
                    // Mostrar mensaje de carga completa
                    alert("Se han completado todas las cargas de archivos.");
                    // Preguntar al usuario si desea actualizar la página
                    if (confirm("¿Desea actualizar la página para ver los cambios?")) {
                        // Actualizar la página
                        window.location.reload();
                    }
                });
            }
        };
    </script>
@stop
