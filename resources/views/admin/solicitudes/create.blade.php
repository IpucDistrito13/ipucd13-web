@extends('adminlte::page')

@section('title', 'Crear solicitud')

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">Crear solicitud</h1> {{ $uuid }}

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
                Datos solicitud
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <form method="POST" action="{{ route('admin.solicitudes.store') }}" autocomplete="off">
                @csrf

                @include('admin.solicitudes.form')

                <div class="modal-footer">
                    <a class="btn btn-secondary" href="{{ route('admin.solicitudes.index') }}">Volver</a>
                    <button type="submit" class="btn btn-primary float-right">Generar</button>
                </div>
            </form>

        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <span id="card_title">
                Lista de solicitudes
            </span>
        </div>

        <!-- /.card-header -->
        <div class="card-body">

            <table id="datatable" class="table table-striped table-bordered data-table">
                <thead>
                    <tr>
                        <th class="counter-column">#</th>
                        <th>UUID</th>
                        <th>Tipo solicitud</th>
                        <th>Fecha creación</th>
                        <th>Fecha respondido</th>

                        <th>Estado</th>
                        <th class="acciones-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 0;
                    @endphp
                     @foreach($listSolicitudes as $solicitud)
                     <tr>
                         <td style="text-align: center">{{ ++$contador }}</td>
                         <td>{{ $solicitud->uuid }}</td>
                         <td>{{ $solicitud->solicitudTipo->nombre }}</td>
                         <td>{{ $solicitud->created_at->format('Y-m-d h:i a') }}</td>
                         <td>
                             @if ($solicitud->estado == '1')
                                 @if ($solicitud->updated_at)
                                     {{ $solicitud->updated_at->format('Y-m-d h:i a') }}
                                 @else
                                     No actualizado
                                 @endif
                             @else
                                 -
                             @endif
                         </td>
                         <td>
                             @if ($solicitud->estado == '1')
                                 <span class="right badge badge-primary">Respondido</span>
                             @else
                                 <span class="right badge badge-danger">Solicitado</span>
                             @endif
                         </td>
                         <td>
                             <!-- Botones de acciones -->
                             <div class="btn-group" role="group" aria-label="Acciones">
                                 <!-- Mostrar botón de descargar solo si el estado es '1' y hay una URL -->
                                 @if ($solicitud->estado == '1' && isset($solicitud->url) && $solicitud->url)
                                     <a href="{{ route('admin.solicitudes.download', $solicitud) }}"
                                         class="btn btn-success btn-sm">Descargar ahora</a>
                                 @endif
     
                                 <!-- Mostrar botón de eliminar si el estado es '0' -->
                                 @if ($solicitud->estado == '0')
                                     <form action="{{ route('admin.solicitudes.destroy', $solicitud) }}" method="POST">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                     </form>
                                 @endif
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
    {{-- Add here extra stylesheets --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap4.min.css">

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
