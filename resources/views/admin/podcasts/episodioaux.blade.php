@extends('adminlte::page')

@section('title', 'Episodios')

@section('content_header')

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">
            <i class="fas fa-volume-up"></i> Podcast::aaa {{ $podcast->titulo }}
        </h1>
        <div>
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.podcasts.index') }}">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_data">
                <i class="fas fa-pencil-alt"></i> Registrar datos episodio</a>

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

    <div class="card" id="seccion_musica">
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
                        <i class="fas fa-pause"></i> 
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <span id="card_title">
                Lista de comités
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="datatable" class="table table-striped table-bordered data-table">
                <thead>
                    <tr>
                        <th class="counter-column">#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Creado</th>
                        <th class="acciones-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 0;
                    @endphp
                    @foreach ($episodios as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$contador }}</td>
                            <td>{{ $item->titulo }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Group of buttons">


                                    @if ($item->url)
                                        <button class="btn btn-info btn-sm reproducir"
                                            data-id="{{ $item->id }}" onclick="reproducirBtn()">Reproducir</button>
                                    @else
                                        <a type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                            data-target="#modal_upload_{{ $item->id }}">
                                            <i class="fas fa-upload"></i> Añadir audio
                                        </a>
                                    @endif

                                    <form action="{{ route('admin.episodios.destroy', $item) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal_upload_{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modal_upload_label_{{ $item->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Subir audio</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('admin.episodios.upload') }}" method="POST"
                                                    enctype="multipart/form-data" class="dropzone"
                                                    id="myDropzone_{{ $item->id }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" value="{{ $item->id }}"
                                                            id="podcast_{{ $item->id }}" name="podcast">
                                                        <div class="fallback">
                                                            <input type="file" name="file" multiple>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach

                    <!-- Fin del ejemplo -->
                </tbody>
            </table>


        </div>

    </div>

    <!-- Modal data -->
    <div class="modal fade" id="modal_data">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Guardar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.episodios.store') }}" method="POST" enctype="multipart/form-data"
                    file="true" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" class="form-control" id="podcast" name="podcast" readonly
                                value="{{ old('podcast', $podcast->id ?? '') }}">

                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Podcast *</label>
                                    <input type="text" class="form-control" id="podcast_titulo" name="podcast_titulo"
                                        readonly value="{{ old('podcast', $podcast->titulo ?? '') }}">
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
                                    <input type="text" class="form-control" id="slug" name="slug" readonly
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

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal data -->


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

        // Generate slug
        function generateSlug(inputText) {
            var withoutAccents = inputText.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            var slug = withoutAccents.toLowerCase()
                .replace(/[^a-zA-Z0-9 -]/g, '') // Remueve caracteres no alfanuméricos ni espacios
                .replace(/\s+/g, '-') // Reemplaza espacios con guiones
                .replace(/-+/g, '-') // Reemplaza múltiples guiones con uno solo
                .trim(); // Elimina espacios en blanco al inicio y al final
            return slug;
        }

        function updateSlug() {
            var nombreInput = document.getElementById("titulo");
            var slugInput = document.getElementById("slug");

            if (nombreInput && slugInput) {
                var nombre = nombreInput.value;
                var slug = generateSlug(nombre);
                slugInput.value = slug;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            updateSlug();
        });
        // End generate slug

        function reproducirBtn(){
            console.log("Hola");
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

        const hiddenDiv = document.querySelector('.section-pause');
        // Function to show the div
        // Function to show the div
        function showDiv() {
            hiddenDiv.removeAttribute('hidden'); // Remove the hidden attribute
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
