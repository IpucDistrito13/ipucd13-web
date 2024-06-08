@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard </h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <!-- Default box -->
    <div class="row">
        <div class="col-md-3">
             <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <span id="card_title">
                Datos transmisión
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <form method="POST" action="{{ route('admin.redes.updateTransmision') }}" autocomplete="off"
                enctype="multipart/form-data" file="true">

                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Transmisión Id *</label>
                            <input id="id" name="id" value="4">
                            <input type="text" class="form-control" id="url" name="url"
                                value="{{ old('nombre', $comite->nombre ?? '') }}" onkeyup="updateSlug()">
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <a class="btn btn-secondary" href="{{ route('admin.comites.index') }}">Volver</a>
                    <button type="submit" class="btn btn-primary float-right">Guardar</button>
                </div>
            </form>

        </div>

    </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop
