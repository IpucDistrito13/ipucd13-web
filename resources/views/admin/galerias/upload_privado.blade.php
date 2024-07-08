@extends('adminlte::page')

@section('title', 'Galería | Privada')

@section('content_header')

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">
            <i class="fas fa-images"></i> Galería privada: {{ $usuario->nombre . ' ' . $usuario->apellidos }}
        </h1>
        <div>
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.galerias.index') }}">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            @can('admin.galerias.upload')
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_upload">
                    <i class="fas fa-upload"></i> Añadir a galería
                </a>
            @endcan
        </div>

    </div>

@stop

@section('content')
    <p><b>Congregación: </b> {{ $usuario->congregacion ? $usuario->congregacion->direccion : 'Sin congregación' }}</p>

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
    <div class="card card-solid">
        <div class="card-body pb-0">
            @if ($galerias->isEmpty())
                <p class="text-center">No hay galerías disponibles.</p>
            @else
                <div class="row">
                    @foreach ($galerias as $galeria)
                        <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    {{ $galeria->formatted_created_at }}
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <a href="{{ Storage::url($galeria->url) }}" data-toggle="lightbox"
                                                data-title="{{ $galeria->formatted_created_at }}" data-gallery="gallery">
                                                <img src="{{ Storage::url($galeria->url) }}" alt="Error, al mostrar."
                                                    class="img-thumbnail small-image img-fluid mb-2">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    @can('admin.galeria.destroy')
                                        <div class="text-right">

                                            <!-- Delete Button -->
                                            <form id="deleteForm{{ $galeria->id }}"
                                                action="{{ route('admin.galeria.destroy', $galeria) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $galeria->id }})">Eliminar</button>
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
                                        </div>
                                    @endcan

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- /.card-body -->
        @if (!$galerias->isEmpty())
            <div class="card-footer">
                <nav aria-label="Pastores Galeria Navegacion">
                    <ul class="pagination justify-content-center m-0">
                        @if ($galerias->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo; Ant.</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $galerias->previousPageUrl() }}">&laquo;
                                    Ant.</a></li>
                        @endif

                        @foreach ($galerias->getUrlRange(max(1, $galerias->currentPage() - 2), min($galerias->lastPage(), $galerias->currentPage() + 2)) as $page => $url)
                            @if ($page == $galerias->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        @if ($galerias->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $galerias->nextPageUrl() }}">Sig.
                                    &raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Sig. &raquo;</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
            <!-- /.card-footer -->
        @endif

    </div>

    <!-- /.card -->

    @can('admin.galerias.upload')
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

                    <form action="{{ route('admin.galerias.upload') }}" method="POST" enctype="multipart/form-data"
                        class="dropzone" id="myDropzone">
                        @csrf
                        <div class="modal-body">

                            <input type="hidden" value="{{ $usuario->id }}" id="usuario" name="usuario">
                            <input type="hidden" value="2" id="type" name="type">

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
    @endcan


@stop

@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">

    <style>
        .img-thumbnail {
            width: 100%;
            height: 250px;
            /* ajusta este valor según tus necesidades */
            object-fit: cover;
        }
    </style>

@stop

@section('js')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <!-- sweetalert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Muestra imagen al hacer click
        $(function() {
                $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                    event.preventDefault();
                    $(this).ekkoLightbox({
                        alwaysShowClose: true
                    });
                });

                $('.filter-container').filterizr({
                    gutterPixels: 3
                });
                $('.btn[data-filter]').on('click', function() {
                    $('.btn[data-filter]').removeClass('active');
                    $(this).addClass('active');
                });
            }),
            //

            //Agrega imagenes de forma masiva y automatica
            Dropzone.options.myDropzone = {
                paramName: "file",
                dictRemoveFile: 'Eliminar',
                dictDefaultMessage: "Arrastra y suelta las fotos aquí o haz clic para seleccionar las fotos de forma masiva. Se guardara de forma automatica.",
                acceptedFiles: ".jpeg,.jpg,.png",
                maxFilesize: 2,
                maxFiles: 20,
                addRemoveLinks: true,
                init: function() {
                    var myDropzone = this;

                    // Handler for file upload completion
                    this.on("queuecomplete", function() {

                        alert("Se han completado todas las cargas de galeria.");
                        if (confirm("¿Desea actualizar la página para ver los cambios?")) {
                            window.location.reload();
                        }

                    });

                    // Handler for file removal
                    this.on("removedfile", function(file) {
                        // Ensure file upload object exists and uuid is available
                        if (file.upload && file.upload.uuid) {
                            $.ajax({
                                url: "{{ route('file.delete') }}",
                                type: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    uuid: file.upload.uuid
                                },
                                success: function(data) {
                                    if (data.success) {
                                        alert('Archivo eliminado exitosamente.');
                                    } else {
                                        alert('Error al eliminar el archivo.');
                                    }
                                },
                                error: function() {
                                    alert('Error al eliminar el archivo.');
                                }
                            });
                        } else {
                            alert('No se puede eliminar el archivo porque falta información.');
                        }
                    });

                    this.on("success", function(file, response) {
                        // Attach the UUID from the response to the file object for later use
                        file.upload.uuid = response.uuid;
                    });
                }
            };
    </script>



@stop
