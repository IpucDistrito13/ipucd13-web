@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Directorio D13</h1>
@stop

@section('content')

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">


                <div class="row">
                    @foreach ($usuarios as $usuario)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>{{ $usuario->nombre }}</b></h2>
                                            <h2 class="lead"><b>{{ $usuario->apellidos }}</b></h2>

                                            <p class="text-muted text-sm"><b>
                                                    @foreach ($usuario->roles as $role)
                                                        {{ $role->name }}@if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </b> </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i
                                                            class="fas fa-lg fa-building"></i></span> Congregación: 
                                                    {{ $usuario->congregacion->direccion }} </li>
                                                @if ($usuario->visible_celular)
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span> Celular:
                                                        {{ $usuario->celular }}</li>
                                                @else
                                                    <li class="small">
                                                        <span class="fa-li">
                                                            <i class="fas fa-lg fa-phone"></i>
                                                        </span>
                                                        Celular #: Oculto
                                                    </li>
                                                @endif

                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="https://cdn.icon-icons.com/icons2/3250/PNG/512/person_circle_filled_icon_202012.png" alt="user-avatar"
                                                class="img-circle img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">

                                        @if ($usuario->visible_celular)
                                            <a href="tel:{{ $usuario->celular }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-phone-alt"></i> Celular
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <nav aria-label="Contacts Page Navigation">
                    <ul class="pagination justify-content-center m-0">
                        @if ($usuarios->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo; Ant.</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $usuarios->previousPageUrl() }}">&laquo;
                                    Ant.</a></li>
                        @endif

                        @foreach ($usuarios->getUrlRange($usuarios->currentPage() - 1, $usuarios->currentPage() + 3) as $page => $url)
                            @if ($page > 0 && $page <= $usuarios->lastPage())
                                @if ($page == $usuarios->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endif
                        @endforeach

                        @if ($usuarios->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $usuarios->nextPageUrl() }}">Sig.
                                    &raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Sig. &raquo;</span></li>
                        @endif
                    </ul>


                </nav>
            </div>

            <!-- /.card-footer -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

@stop

@section('js')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@stop
