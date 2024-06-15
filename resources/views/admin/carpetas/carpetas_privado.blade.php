@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">
            Carpeta Privada - {{ $comite->nombre }}
        </h1>


        <div>
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.carpetas.listComitePrivado') }}">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            @can('admin.carpetas.privado.crearCarpetaPrivada')
            <a class="btn btn-primary btn-sm" href="{{ route('admin.carpetas.privado.crearCarpetaPrivada', $comite) }}">
                <i class="fas fa-folder-open"></i> Crear carpeta
            </a>
            @endcan
            
        </div>

    </div>

@stop

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <span id="card_title">
                Lista de carpetas
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="datatable" class="table table-striped table-bordered data-table">
                <thead>
                    <tr>
                        <th class="counter-column">#</th>
                        <th>Nombre</th>
                        <th class="acciones-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí puedes iterar sobre tus categorías y mostrarlas en la tabla -->
                    <!-- Ejemplo de una fila de la tabla -->
                    @foreach ($carpetas as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>

                                <div class="btn-group" role="group" aria-label="Group of buttons">
                                    <!-- Update Button -->
                                 
                                        <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.archivos.index', $item) }}">Ver más</a>

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
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}


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
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
