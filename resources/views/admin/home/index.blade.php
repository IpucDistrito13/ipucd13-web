@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard </h1>
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
    <p>Panel de administración.</p>

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
                            <label>Url transmisión *</label>
                            <input id="id" name="id" value="4" hidden>
                            <input type="text" class="form-control" id="url" name="url"
                                value="{{ old('url', $transmision->url ?? '') ? 'https://www.youtube.com/watch?v=' . old('url', $transmision->url ?? '') : '' }}">
                            @error('url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary float-right">Actualizar</button>
                </div>
            </form>

        </div>

    </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

@stop

@section('js')

@stop
