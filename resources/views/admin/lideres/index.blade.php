@extends('adminlte::page')

@section('title', 'Admin | Lideres')

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">Lista de lideres distrital</h1>
        @can('admin.lideres.create')
            <a class="btn btn-primary btn-sm" href="{{ route('admin.lideres.create') }}">
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
                Lista líder
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="datatable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="counter-column">#</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Tipo de líder</th>
                        <th>Cómite</th>
                        <th class="acciones-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 0;
                    @endphp
                    @foreach ($lideres as $lider)
                        <tr>
                            <td>{{ $lider->id }}</td>
                            <td>{{ $lider->usuario->nombre }}</td>
                            <td>{{ $lider->usuario->apellidos }}</td>
                            <td>{{ $lider->liderTipo->nombre }}</td>
                            <td>{{ $lider->comite->nombre }}</td>
                            <td>
                                <div class="btn-group" role="group">

                                    @can('admin.lideres.edit', $lider)
                                        <a href="{{ route('admin.lideres.edit', $lider) }}"
                                            class="btn btn-sm btn-success">Actualizar</a>
                                    @endcan

                                    @can('admin.lideres.destroy')
                                        <form id="deleteForm{{ $lider->id }}"
                                            action="{{ route('admin.lideres.destroy', $lider) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $lider->id }})">Eliminar</button>
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
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap4.min.css">
    <style>
        .acciones-column {
            width: 150px;
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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap4.min.js"></script>

    <!-- sweetalert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            $("#datatable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,

                language: {
                    processing: "Procesando...",
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    zeroRecords: "No se encontraron registros en el sistema...",
                    info: "Mostrando _START_ al _END_ de _TOTAL_ registros",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    search: "Buscar",
                    paginate: {
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                    emptyTable: "No hay datos disponibles en la tabla"
                },
            })
        });

        function redirectUpdate(url) {
            window.location.href = url;
        }
    </script>
@stop