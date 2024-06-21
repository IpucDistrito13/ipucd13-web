@extends('adminlte::page')

@section('title', 'Listar tipos galería')

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">Lista tipos galería</h1>
        @can('admin.galeria_tipos.create')
            <a class="btn btn-primary btn-sm" href="{{ route('admin.galeria_tipos.create') }}">
                Crear Nuevo
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
                Lista tipos de galería
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="datatable" class="table table-striped table-bordered data-table">
                <thead>
                    <tr>
                        <th class="counter-column">#</th>
                        <th>Nombre</th>
                        <th>Slug</th>
                        <th>Descripción</th>
                        <th class="acciones-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 0;
                    @endphp
                    @foreach ($galeria_tipos as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$contador }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    @can('admin.galeria_tipos.edit')
                                        <!-- Update Button -->
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('admin.galeria_tipos.edit', $item) }}">Actualizar</a>
                                    @endcan
                                    <!-- Delete Button -->
                                    @can('admin.galeria_tipos.destroy')
                                        <form action="{{ route('admin.galeria_tipos.destroy', $item) }}" method="POST">
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
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap4.min.css">

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

    <script>
        showErrores();

        function showErrores() {
            @if ($errors->any())

                @foreach ($errors->all() as $error)
                    console.error('{{ $error }}');
                @endforeach
            @endif
        }

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
    }
            })
        });

        function redirectUpdate(url) {
            window.location.href = url;
        }
    </script>
@stop
