@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear rol</h1>
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
        Datos rol
    </span>
</div>
<!-- /.card-header -->
<div class="card-body">

    <form method="POST" action="{{ route('admin.roles.store') }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @include('admin.roles.form')
    
        <div class="modal-footer">
            <a class="btn btn-secondary" href="{{ route('admin.roles.index') }}">Volver</a>
            <button type="submit" class="btn btn-primary float-right">Guardar</button>
        </div>
    </form>
    
</div>

</div>



@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
@stop

@section('js')

@stop