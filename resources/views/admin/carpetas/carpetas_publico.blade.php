@extends('adminlte::page')

@section('title', 'Lista carpeta pública')

@section('content_header')

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">
            Carpeta Pública - {{ $comite->nombre }}
        </h1>


        <div>
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.carpetas.listComitePublico') }}">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            @can('admin.carpetas.publico.crearCarpetaPublico')
                <a class="btn btn-primary btn-sm" href="{{ route('admin.carpetas.publico.crearCarpetaPublico', $comite) }}">
                    <i class="fas fa-folder-open"></i> Crear carpeta
                </a>
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
    <div class="card">
        <div class="card-header">
            <span id="card_title">
                Lista de carpetas
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="datatable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="counter-column">#</th>
                        <th>Nombre</th>
                        <th class="acciones-column">Acciones</th>
                    </tr>
                </thead>

                @foreach ($carpetas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Group of buttons">
                                @can('admin.archivos.index')
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.archivos.index', $item->id) }}">Ver
                                        más</a>
                                @endcan

                                @can('admin.carpetas.destroyCarpeta')
                                    <!-- Delete Button -->
                                <form id="deleteForm{{ $item->id }}"
                                    action="{{ route('admin.carpetas.destroyCarpeta', $item->id) }}" method="POST">
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


    <div class="modal fade" id="modal_upload">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nombre carpeta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.galerias.upload') }}" method="POST" enctype="multipart/form-data"
                    class="dropzone" id="myDropzone">
                    @csrf
                    <div class="modal-body">


                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombre *</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ old('slug', $galeria_type->slug ?? '') }}">
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

    <style>
        .acciones-column {
            width: 160px;
        }

        .counter-column {
            width: 2%;
        }
    </style>
@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stop
