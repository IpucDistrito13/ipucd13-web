@extends('adminlte::page')

@section('title', 'Directorio | Lideres ')

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">Directorio</h1>
        @can('admin.usuarios.create')
            <a class="btn btn-primary btn-sm" href="{{ route('admin.usuarios.create') }}">
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
                Lista de lideres
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="datatable" class="table table-striped table-bordered data-table data-table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Celular</th>
                        <th>Municipio</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap4.min.css">

@stop

@section('js')

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap4.min.js"></script>

    <style>
        .acciones-column {
            width: 110px;
        }

        .counter-column {
            width: 2%;
        }

        /* Estilo para centrar los botones dentro de la columna de acciones */
        .acciones .btn-group {
            display: flex;
            justify-content: center;
        }
    </style>

<script>
    $(function() {
        var table = $('.data-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            language: {
                processing: "Procesando...",
                lengthMenu: "Mostrar _MENU_ registros por página",
                zeroRecords: "No se encontraron registros en el sistema...",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "No hay registros disponibles",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                search: "Buscar",
                paginate: {
                    next: "Siguiente",
                    previous: "Anterior"
                }
            },
            ajax: "{{ route('admin.usuarios.directorioLideres') }}",
            columns: [
                {
                    "data": "image_url",
                    "render": function(data, type, row) {
                        var baseUrl = '{{ env('APP_URL') }}/storage/'; // Usa APP_URL del archivo .env
                        var imageUrl = row.image_url ? baseUrl + row.image_url.replace('public/', '') : 'https://cdn.icon-icons.com/icons2/3250/PNG/512/person_circle_filled_icon_202012.png';
                        return '<img src="' + imageUrl + '" alt="Image" style="width:50px;height:50px;"/>';
                    }
                },
                {
                    data: 'nombre',
                    name: 'nombre'
                },
                {
                    data: 'apellidos',
                    name: 'apellidos'
                },
                {
                    data: 'celular',
                    name: 'celular'
                },
                {
                    data: 'nombre_municipio',
                    name: 'nombre_municipio'
                },
            ]
        });
    });
</script>


@stop
