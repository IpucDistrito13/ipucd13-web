@extends('adminlte::page')

@section('title', 'Lista archivos')

@section('content_header')

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">Carpeta: {{ $carpeta->nombre }} </h1>

        @can('admin.archivos.upload')
            <div class="btn-group">
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_upload">
                    <i class="fas fa-upload"></i> Añadir archivos
                </a>

                <a class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_enlace">
                    <i class="fas fa-link"></i> Añadir enlace
                </a>
            </div>
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

            <table id="datatable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th class="acciones-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($archivos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nombre_original }}</td>
                            <td>{{ $item->tipo }}</td>
                            <td>{{ $item->created_at->format('Y-m-d h:i a') }}</td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Group of buttons">
                                    @if ($item->tipo === 'archivo')
                                        @can('admin.archivos.download')
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('admin.archivos.download', $item->uuid) }}">Descargar</a>
                                        @endcan
                                    @elseif ($item->tipo === 'enlace')
                                        <a class="btn btn-primary btn-sm" href="{{ $item->url }}"
                                            target="_blank">Abrir</a>
                                    @endif

                                    @can('admin.archivos.destroy')
                                        <!-- Delete Button -->
                                        <form id="deleteForm{{ $item->id }}"
                                            action="{{ route('admin.archivos.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $item->id }})">Eliminar</button>
                                        </form>

                                        <script>
                                            function confirmDelete(itemId) {
                                                const swalWithBootstrapButtons = Swal.mixin({
                                                    customClass: {
                                                        confirmButton: 'btn btn-success',
                                                        cancelButton: 'btn btn-danger'
                                                    },
                                                    buttonsStyling: false
                                                });

                                                swalWithBootstrapButtons.fire({
                                                    title: '¿Estás seguro?',
                                                    text: '¡No podrás revertir esto!',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Eliminar',
                                                    confirmButtonColor: '#a5161d',
                                                    denyButtonColor: '#270a0a',
                                                    cancelButtonText: 'Cancelar',
                                                    reverseButtons: true
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        document.getElementById('deleteForm' + itemId).submit();
                                                    }
                                                });
                                            }
                                        </script>
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

    <!-- Modal Archivos -->
    <div class="modal fade" id="modal_upload">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Subir archivos</h4>
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
    <!-- /.modal archivos -->



    <div class="modal fade" id="modal_enlace">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Añadir enlace</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.archivos.storeUrl') }}" method="POST">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="nombre">Nombre *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="url">Enlace *</label>
                                <input type="text" class="form-control" id="url" name="url"
                                    placeholder="Enlace url externo">
                            </div>

                            <input type="hidden" value="{{ $carpeta->id }}" id="carpeta" name="carpeta">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary float-right">Guardar</button>
                        </div>

                    </form>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Dropzone.options.myDropzone = {
            paramName: "file",
            //autoProcessQueue: false,
            //addRemoveLinks: true,
            dictRemoveFile: 'Eliminar',
            dictDefaultMessage: "Arrastra y suelta las fotos aquí o haz clic para seleccionar las fotos de forma masiva. Maximo 20 archivos masivo, y tamaño 200 Mb",
            maxFilesize: 200, // Tamaño máximo de archivo 200 Mb
            maxFiles: 20,
            init: function() {
                var myDropzone = this;
                this.on("queuecomplete", function() {

                    Swal.fire({
                        title: 'Archivo subido exitosamente',
                        text: 'Debes actualizar la página para ver los cambios.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location
                                .reload(); // Recarga la página cuando el usuario acepta el mensaje
                        }
                    });

                });
            }
        };
    </script>
@stop
