@extends('adminlte::page')

@section('title', 'Serie')

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">
            <i class="fas fa-volume-up"></i> Serie: {{ $serie->titulo }}
        </h1>
        <div class="btn-group">
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.series.index') }}">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            @can('admin.videos.store')
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_registro">
                    <i class="fas fa-plus-circle"></i> Registrar video
                </button>
            @endcan
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
    <div class="pb-0">
        @if ($videos->isEmpty())
            <p class="text-center">No hay videos disponibles.</p>
        @else
            <div class="row">
                @foreach ($videos as $video)
                    <div class="col-12 col-sm-12 col-md-6 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                <b>{{ $video->titulo }}</b>
                                <br>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <div class="plyr__video-embed" id="player">
                                                <iframe src="https://www.youtube.com/embed/{{ $video->url }}"
                                                    allowfullscreen allowtransparency allow="autoplay"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                            </div>

                            @can('admin.videos.destroy')
                                <div class="card-footer">
                                    <div class="text-right">
                                        <form id="deleteForm{{ $video->id }}"
                                            action="{{ route('admin.videos.destroy', $video) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $video->id }})">Eliminar</button>
                                        </form>
                                    </div>
                                </div>

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
                    </div>
                @endforeach
            </div>
        @endif
    </div>


    <div class="modal fade" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $serie->titulo }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.videos.store') }}" autocomplete="off">
                        @csrf

                        <input type="hidden" name="serie" value="{{ $serie->id }}">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="slug" class="col-form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" readonly
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="titulo" class="col-form-label">Título</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo"
                                        value="{{ old('titulo') }}" onkeyup="updateSlug()">
                                    @error('titulo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="url" class="col-form-label">Enlace YouTube *</label>
                                    <input type="text" class="form-control" id="url" name="url"
                                        value="{{ old('url') }}" placeholder="">
                                    @error('url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion" class="col-form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" data-dismiss="modal">Volver</a>
                            <button type="submit" class="btn btn-primary float-right">Guardar</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
@stop

@section('js')

    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        // generate slug
        function removeAccents(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        }

        function generateSlug(inputText) {
            var withoutAccents = removeAccents(inputText);
            var slug = withoutAccents.toLowerCase().replace(/[^a-zA-Z0-9 -]/g, '').replace(/\s+/g, '-');
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

        //show modal with error
        $(document).ready(function() {
            @if ($errors->any())
                $('#modal_registro').modal('show');
            @endif
        });
        //end show modal errors

        $(function() {
            $("#datatable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,

                language: {
                    processing: "Procesando...",
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    zeroRecords: "No se encontraron registros en el sistema...",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    search: "Buscar",
                    paginate: {
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                },
            })
        });

        function redirectUpdate(url) {
            window.location.href = url;
        }
    </script>
@stop
