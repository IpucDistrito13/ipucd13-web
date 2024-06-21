@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1>Perfil</h1>
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">

                        <h3 class="profile-username text-center">{{ $usuario->codigo }}</h3>

                        <p class="text-muted text-center">{{ $usuario->uuid }}</p>

                        <div class="text-center">
                            @if (isset($usuario) && $usuario->imagen)
                                <img id="imagen" src="{{ Storage::url($usuario->imagen->url) }}" alt=""
                                    class="img-thumbnail small-image img-fluid mb-2">
                            @else
                                <img id="imagen" src="{{ $usuario->profile_photo_url }}" alt="">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{ $usuario->congregacion->direccion }}</h3>

                        <div class="row">

                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" value="{{ $usuario->nombre }}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control" value="{{ $usuario->apellidos }}" disabled>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Departamento</label>
                                    <input type="text" class="form-control"
                                        value="{{ $usuario->congregacion->municipio->departamento->nombre }}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Municipio</label>
                                    <input type="text" class="form-control"
                                        value="{{ $usuario->congregacion->municipio->nombre }}" disabled>
                                </div>
                            </div>


                        </div>

                        <form action="{{ route('admin.usuarios.updatePerfil', $usuario) }}" method="POST" enctype="multipart/form-data" >
                            @csrf

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Correo electrónico</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ old('email', $usuario->email) }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nueva contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Confirmar contraseña</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation">
                                        @error('password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Imagen perfil *</label>
                                        <input class="form-control-file" type="file" class="custom-file-input"
                                            name="file" id="file" accept="image/*" onchange="cambiarImagen(event)">
                                        @error('file')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success float-right">Actualizar</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>


        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

    <style>
        .img-thumbnail {
            width: auto;
            height: 340px;
            /* ajusta este valor según tus necesidades */
            object-fit: cover;
        }
    </style>
@stop

@section('js')

    <script>
        //Mostrar imagen
        /*
         function redirectUpdate(url) {
                    window.location.href = url;
                }

                document.getElementById("imagen").addEventListener("change", cambiarImagen);

                function cambiarImagen(evento) {
                    var file = evento.target.files[0];
                    var reader = new FileReader();
                    reader.onload = function(evento) {
                        document.getElementById("imagen").src = evento.target.result;
                    }
                    reader.readAsDataURL(file);
                }
               */
        //end mostrar imagen

        function cambiarImagen(evento) {
            var file = evento.target.files[0];
            var reader = new FileReader();
            reader.onload = function(evento) {
                document.getElementById("imagen").src = evento.target.result;
            }
            reader.readAsDataURL(file);
        }
        //end mostrar imagen

        // Mostrar imagen banner
        function cambiarImagenBanner(evento) {
            var file = evento.target.files[0];
            var reader = new FileReader();
            reader.onload = function(evento) {
                document.getElementById("imagen_banner").src = evento.target.result;
            }
            reader.readAsDataURL(file);
        }
        //end mostrar imagen banner
    </script>
@stop
