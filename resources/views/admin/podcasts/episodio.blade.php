@extends('adminlte::page')

@section('title', 'Podcast | Episodio')

@section('content_header')

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">
            <i class="fas fa-volume-up"></i> Podcast: {{ $podcast->titulo }}
        </h1>
        <div>
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.podcasts.index')}}">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_upload"><i class="fas fa-upload"></i> Registrar datos episodio</a>

        </div>
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

    <div class="card" id="secttion_musica">
        <div class="card-body">
            <audio></audio>

            <div id="info-cancion"></div> <!-- Elemento para mostrar información de la canción -->

            <div id="current_time">0:00</div>
            <div id="total_duration">Duración: --:--</div> <!-- Nuevo elemento para mostrar la duración total -->
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>

            <div class="section-pause" hidden>
                <div class="buttons">
                    <button class="pause" id="pause">
                        <i class="fas fa-pause"></i> Pausar
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de episodios</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Podcast</th>
                        <th>Slug</th>
                        <th>Descripción</th>
                        <th>Url</th>

                        <th class="acciones-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                <tbody>
                    <!-- Aquí puedes iterar sobre tus categorías y mostrarlas en la tabla -->
                    <!-- Ejemplo de una fila de la tabla -->
                    @php
                        $contador = 0;
                    @endphp
                    @foreach ($episodios as $item)
                        @php
                            $contador++;
                        @endphp
                        <tr>
                            <td>{{ $contador }}</td>
                            <td>{{ $item->titulo }}</td>
                            <td>{{ $item->podcast->titulo }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->url }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Group of buttons">

                                    @if($item->url)
                                        <button class="btn btn-info btn-sm reproducir" data-id="{{ $item->id }}">Reproducir</button>
                                    @else
                                        <a class="btn btn-secondary btn-sm" href="{{ route('admin.episodios.edit', $item) }}">Subir episodio</a>
                                    @endif
                    
                                    <form action="{{ route('admin.episodios.destroy', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <!-- Fin del ejemplo -->
                </tbody>
                </tr>

                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- Modal -->
    <div class="modal fade" id="modal_upload">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Guardar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.episodios.store') }}" method="POST" class="dropzone" enctype="multipart/form-data"
                file="true" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Podcast *</label>
                                    <input type="text" class="form-control" id="podcast" name="podcast" readonly
                                        value="{{ old('podcast', $podcast->id ?? '') }}">
                                    @error('podcast')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Episodio *</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo"
                                        value="{{ old('titulo', $episodio->titulo ?? '') }}" onkeyup="updateSlug()">
                                    @error('titulo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Slug *</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ old('slug', $episodio->slug ?? '') }}">
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea class="form-control" rows="3" placeholder="" id="descripcion" name="descripcion">{{ old('descripcion', $episodio->descripcion ?? '') }}</textarea>
                                    @error('descripcion')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Url *</label>
                                    <input type="text" class="form-control" id="url" name="url"
                                        value="{{ old('url', $episodio->url ?? '') }}">
                                    @error('url')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Imagen portada (480x640) *</label>
                                    <input class="form-control-file" type="file" class="custom-file-input" name="file" id="file"
                                        accept="audio/*" onchange="cambiarImagen(event)">
                                    @error('file')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
         .acciones-column {
            width: 360px;
        }

        .progress-bar {
            width: 100%;
            /* Set desired width */
            height: 10px;
            /* Set desired height */
            background-color: #ddd;
            /* Background color for unfilled progress */
        }

        .progress-fill {
            height: 100%;
            /* Match container height */
            background-color: #007bff;
            /* Fill color for progress */
        }


        /* Audio Element */
        audio {
            width: 300px;
            /* Adjust as needed */
            height: 40px;
            /* Adjust as needed */
            border-radius: 5px;
            /* Rounded corners */
            border: 1px solid #ccc;
            /* Border */
            margin-bottom: 10px;
        }

        /* Song Information */
        #info-cancion {
            flex-grow: 1;
            /* Allow to expand */
            font-size: 16px;
            text-align: center;
        }

        /* Current Time and Duration */
        #current_time,
        #total_duration {
            font-size: 14px;
            margin-right: 10px;
        }

        /* Progress Bar */
        .progress-bar {
            width: 100%;
            height: 10px;
            /* Adjust thickness */
            background-color: #ddd;
            /* Background color */
            border-radius: 5px;
            /* Rounded corners */
            margin-bottom: 10px;
        }

        /* Progress Fill */
        .progress-fill {
            height: 100%;
            /* Match progress bar height */
            background-color: #007bff;
            /* Fill color */
        }

        /* Pause Button */
        .pause {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            /* Adjust padding */
            border: 1px solid #ccc;
            /* Border */
            border-radius: 5px;
            /* Rounded corners */
            cursor: pointer;
            transition: background-color 0.3s;
            /* Smooth transition */
        }

        /* Hover effect for Pause Button */
        .pause:hover {
            background-color: #e9e9e9;
            /* Lighter background on hover */
        }

        /* Icon styles (assuming you're using Font Awesome icons) */
        .pause i {
            font-size: 20px;
            margin-right: 5px;
            color: #007bff;
            /* Blue icon color */
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const hiddenDiv = document.querySelector('.section-pause');
        // Function to show the div
        // Function to show the div
        function showDiv() {
            hiddenDiv.removeAttribute('hidden'); // Remove the hidden attribute
        }


        var botonesReproducir = document.querySelectorAll('.reproducir');
        var audioElement;

        var pauseButton = document.querySelector('.pause');

        // Add click event listener to the button
        pauseButton.addEventListener('click', function() {
            if (audioElement) {
                // Check if audio is playing
                if (audioElement.paused) {
                    // Resume playback if paused
                    audioElement.play();
                    pauseButton.querySelector('i').classList.replace('fa-play', 'fa-pause'); // Update icon
                } else {
                    // Pause playback if currently playing
                    audioElement.pause();
                    pauseButton.querySelector('i').classList.replace('fa-pause', 'fa-play'); // Update icon
                }
            }
        });

        function detenerYEliminarAudio() {
            if (audioElement) {
                audioElement.pause();
                audioElement.parentNode.removeChild(audioElement);
                audioElement = null;
            }
        }

        botonesReproducir.forEach(function(boton) {
            boton.addEventListener('click', function() {
                detenerYEliminarAudio();
                var episodioid = this.getAttribute('data-id');

                axios.get('/api/v1/getAudioEpisodio/' + episodioid)
                    .then(function(response) {
                        console.log(response.data);
                        var datosCancion = response.data;
                        mostrarInformacionCancion(datosCancion);
                        var audioUrl = datosCancion.url;
                        audioElement = document.createElement('audio');
                        audioElement.src = audioUrl;
                        audioElement.play();
                        document.body.appendChild(audioElement);

                        // Muestra la duración total del audio
                        audioElement.addEventListener('loadedmetadata', function() {
                            showDiv();
                            var totalDurationElement = document.getElementById(
                                'total_duration');
                            totalDurationElement.textContent = 'Duración: ' + formatTime(
                                audioElement.duration);
                        });

                        // Actualiza el tiempo de reproducción actual
                        audioElement.addEventListener('timeupdate', function() {
                            if (audioElement) { // Check if audioElement exists
                                var currentTime = audioElement.currentTime;
                                var duration = audioElement.duration;
                                var progress = currentTime / duration;
                                var progressFillElement = document.querySelector(
                                    '.progress-fill');
                                progressFillElement.style.width =
                                    `${progress * 100}%`; // Set width as a percentage

                                // Update current time element (existing code)
                                var currentTimeElement = document.getElementById(
                                    'current_time');
                                currentTimeElement.textContent = formatTime(currentTime);
                            }
                        });

                        document.querySelector('.progress-bar').addEventListener('click', function(
                            event) {
                            // Get click position relative to the progress bar
                            var clickX = event.offsetX;
                            var progressBarWidth = this.offsetWidth;
                            var progress = clickX / progressBarWidth;

                            // Calculate playback position based on click location
                            var currentTime = progress * audioElement.duration;

                            // Seek to the specified playback position
                            audioElement.currentTime = currentTime;

                            // Update progress bar visually
                            var progressFillElement = document.querySelector(
                                '.progress-fill');
                            progressFillElement.style.width = `${progress * 100}%`;

                            // Update current time display
                            var currentTimeElement = document.getElementById(
                                'current_time');
                            currentTimeElement.textContent = formatTime(currentTime);
                        });


                        // Agrega un botón de pausa
                        var botonPausa = document.createElement('button');
                        botonPausa.textContent = 'Pausar';
                        botonPausa.addEventListener('click', function() {
                            audioElement.pause();
                        });
                        document.body.appendChild(botonPausa);
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            });
        });

        function mostrarInformacionCancion(datosCancion) {
            var infoCancionDiv = document.getElementById('info-cancion');
            infoCancionDiv.innerHTML = `
            <h2>${datosCancion.titulo}</h2>
        `;
        }

        // Función para formatear el tiempo en minutos y segundos
        function formatTime(seconds) {
            var minutes = Math.floor(seconds / 60);
            var seconds = Math.floor(seconds % 60);
            return `${minutes}:${(seconds < 10 ? '0' : '')}${seconds}`;
        }
    </script>


@stop
