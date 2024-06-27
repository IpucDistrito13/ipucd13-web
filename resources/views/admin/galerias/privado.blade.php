@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">
            <i class="fas fa-images"></i> Galería privada: {{ $usuario->nombre . ' ' . $usuario->apellidos }}
        </h1>
        <div>
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.galerias.index') }}">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_upload">
                <i class="fas fa-upload"></i> Añadir a galería
            </a>
        </div>

    </div>

@stop

@section('content')
<p><b>Congregación: </b> {{ $usuario->congregacion ? $usuario->congregacion->direccion : 'Sin congregación' }}</p>

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
                                    {{ $galeria->formatted_created_at  }}
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <a href="{{ Storage::url($galeria->url) }}" data-toggle="lightbox"
                                                data-title="{{ $galeria->formatted_created_at  }}" data-gallery="gallery">
                                                <img src="{{ Storage::url($galeria->url) }}" alt="Error, al mostrar."
                                                    class="img-thumbnail small-image img-fluid mb-2">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <form action="{{ route('admin.galeria.destroy', $galeria->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta foto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
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

@stop

@section('css')
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
