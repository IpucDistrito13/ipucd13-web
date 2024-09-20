@extends('adminlte::page')

@section('title', 'Slider')

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">Lista sliders</h1>
        @can('admin.series.create')
            <a class="btn btn-primary btn-sm" href="{{ route('admin.sliders.create') }}">
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
                Lista de sliders
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="datatable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="counter-column">#</th>
                        <th>Título</th>
                        <th>Imagen</th>
                        <th>Creado</th>
                        <th class="acciones-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 0;
                    @endphp
                    @foreach ($sliders as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$contador }}</td>

                            <td>{{ $item->titulo }}</td>
                            <td>
                                <a href="{{ env('APP_ENV') === 'local' ? asset('storage/' . $item->imagen->url) : Storage::url($item->imagen->url) }}" target="_blank">
                                    Ver Imagen
                                </a>
                            </td>
                             <td>{{ $item->created_at->format('Y-m-d h:i a') }}</td>
                            <td>

                                <div class="btn-group" role="group" aria-label="Group of buttons">



                                    @can('admin.series.edit')
                                        <!-- Update Button -->
                                        <button class="btn btn-success btn-sm"
                                            data-url="{{ route('admin.sliders.edit', $item) }}"
                                            onclick="redirectUpdate(this.getAttribute('data-url'))">Actualizar</button>
                                    @endcan

                                    @can('admin.series.destroy')
                                        <!-- Delete Button -->
                                        <form id="deleteForm{{ $item->id }}"
                                            action="{{ route('admin.sliders.destroy', $item) }}" method="POST">
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

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