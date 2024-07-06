@extends('adminlte::page')

@section('title', 'Episodios')

@section('content_header')


    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">
            <i class="fas fa-volume-up"></i> Podcast: {{ $podcast->titulo }}
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

    <!-- Contenedor de audio en la tarjeta de música -->
    <div class="card" id="seccion_musica" style="display: none;">
        <div class="card-body">
            <audio></audio>

            <div id="info-cancion"></div> <!-- Elemento para mostrar información de la canción -->

            <div id="current_time">0:00</div>
            <div id="total_duration">Duración: --:--</div> <!-- Nuevo elemento para mostrar la duración total -->
            <div class="progress-bar" id="progress-bar" onclick="seek(event)">
                <div class="progress-fill"></div>
                <div class="progress-circle"></div> <!-- Círculo indicador -->
            </div>

            <div class="section-pause">
                <div class="buttons">
                    <button class="pause" id="pause" onclick="togglePlayPause()">
                        <i class="fas fa-pause" id="pause-icon"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <span id="card_title">
                Lista de episodios
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="datatable" class="table table-bordered table-hover">
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
                            <td>{{ $item->created_at->format('Y-m-d h:i a') }}</td>
                            <!-- Botón para abrir el modal -->
                            <td>
                                <div class="btn-group" role="group" aria-label="Group of buttons">
                                    @can('admin.episodios.upload_audio')
                                        @if ($item->url)
                                            <button class="btn btn-info btn-sm reproducir" data-id="{{ $item->id }}"
                                                onclick="reproducirBtn({{ $item->id }})">Reproducir</button>
                                        @else
                                            <a type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                                data-target="#modal_upload_{{ $item->id }}">
                                                <i class="fas fa-upload"></i> Añadir audio
                                            </a>
                                        @endif
                                    @endcan

                                    @can('admin.episodios.destroy')
                                        <form id="deleteForm{{ $item->id }}"
                                            action="{{ route('admin.episodios.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $item->id }})">Eliminar</button>
                                        </form>
                                    @endcan
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="modal_upload_{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modal_upload_label_{{ $item->id }}" aria-hidden="true">
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
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="episodio_id" id="episodio_id"
                                                        value="{{ $item->id }}">
                                                    <div class="container pt-4">
                                                        <div class="row justify-content-center">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-header text-center">
                                                                        <h5>Subir archivo</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div id="upload-container" class="text-center">
                                                                            <button id="browseFile"
                                                                                class="btn btn-primary"
                                                                                type="button">Buscar archivo</button>
                                                                            <input type="file" id="fileInput"
                                                                                name="file" style="display: none;">
                                                                        </div>
                                                                        <div class="progress mt-3" style="height: 25px">
                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                                                role="progressbar" aria-valuenow="0"
                                                                                aria-valuemin="0" aria-valuemax="100"
                                                                                style="width: 0%; background-color: #00338D;">
                                                                                0%</div>
                                                                        </div>
                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>

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
                                    <label>Slug *</label>
                                    <input type="text" class="form-control" id="slug" name="slug" readonly
                                        value="{{ old('slug', $episodio->slug ?? '') }}">
                                    @error('slug')
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

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        #browseFile {
            transition: all 0.3s;
        }

        #browseFile:hover {
            transform: scale(1.05);
        }

        .progress {
            height: 25px;
            margin-top: 20px;
        }
    </style>


    <style>
        .acciones-column {
            width: 210px;
        }

        .counter-column {
            width: 2%;
        }

        .progress-bar {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-fill {
            height: 10px;
            background-color: #007bff;
            width: 0%;
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

        .progress-bar {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 10px;
            cursor: pointer;
            /* Make the progress bar clickable */
            position: relative;
            /* Necesario para posicionar el círculo */
        }

        .progress-fill {
            height: 10px;
            background-color: #007bff;
            width: 0%;
        }

        .progress-circle {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 10px;
            height: 10px;
            background-color: #F0AB00;
            border-radius: 50%;
            pointer-events: none;
            /* Para que el círculo no interfiera con los eventos de clic */
        }

        .section-pause .buttons {
            display: flex;
            align-items: center;
            /* Centra verticalmente */
            justify-content: center;
            /* Centra horizontalmente */
            height: 100%;
            /* Ajusta la altura para centrar */
        }

        .section-pause .pause {
            background: none;
            border: none;
            color: #007bff;
            font-size: 24px;
            cursor: pointer;
            outline: none;
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


    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        #browseFile {
            transition: all 0.3s;
        }

        #browseFile:hover {
            transform: scale(1.05);
        }

        .progress {
            height: 25px;
            margin-top: 20px;
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

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
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
    </script>

    <script>
        let audioPlayer;
        let isPlaying = false;

        function reproducirBtn(episodioId) {
            console.log('Audio: ' + episodioId);

            axios.get('/api/v1/getAudioEpisodio/' + episodioId)
                .then(function(response) {
                    console.log(response.data);
                    // Verifica que la respuesta contenga la URL del audio
                    if (!response.data.url) {
                        console.error('No se encontró la URL del audio en la respuesta');
                        return;
                    }

                    // Obtén la URL del audio desde la respuesta
                    const audioUrl = response.data.url;

                    // Obtén el elemento de audio
                    audioPlayer = document.querySelector('#seccion_musica audio');
                    if (!audioPlayer) {
                        console.error('No se encontró el elemento de audio');
                        return;
                    }

                    // Establece la fuente del elemento de audio
                    audioPlayer.src = audioUrl;

                    // Actualiza la información de la canción
                    document.getElementById('info-cancion').innerText = response.data.titulo;

                    // Mostrar la sección de música una vez que se haya cargado el audio
                    document.getElementById('seccion_musica').style.display = 'block';

                    // Reproduce el audio
                    audioPlayer.play().then(() => {
                        console.log('Reproducción iniciada');
                        isPlaying = true;
                        document.getElementById('pause-icon').className = 'fas fa-pause';
                    }).catch((error) => {
                        console.error('Error al reproducir el audio:', error);
                    });

                    // Actualiza el tiempo actual y la duración total
                    audioPlayer.addEventListener('timeupdate', updateProgress);
                    audioPlayer.addEventListener('loadedmetadata', () => {
                        document.getElementById('total_duration').innerText = 'Duración: ' + formatTime(
                            audioPlayer.duration);
                    });

                })
                .catch(function(error) {
                    console.error('Error al obtener el audio:', error);
                });
        }

        function togglePlayPause() {
            if (isPlaying) {
                audioPlayer.pause();
                isPlaying = false;
                document.getElementById('pause-icon').className = 'fas fa-play';
            } else {
                audioPlayer.play().then(() => {
                    isPlaying = true;
                    document.getElementById('pause-icon').className = 'fas fa-pause';
                }).catch((error) => {
                    console.error('Error al reproducir el audio:', error);
                });
            }
        }

        function updateProgress() {
            const progressFill = document.querySelector('.progress-fill');
            const progressCircle = document.querySelector('.progress-circle');
            const currentTime = document.getElementById('current_time');

            const progressPercent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
            progressFill.style.width = progressPercent + '%';
            progressCircle.style.left = `calc(${progressPercent}% - 5px)`; // Centrar el círculo

            currentTime.innerText = formatTime(audioPlayer.currentTime);
        }

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }

        function seek(event) {
            const progressBar = document.getElementById('progress-bar');
            const rect = progressBar.getBoundingClientRect();
            const offsetX = event.clientX - rect.left;
            const totalWidth = rect.width;
            const percentage = offsetX / totalWidth;
            const seekTime = percentage * audioPlayer.duration;

            audioPlayer.currentTime = seekTime;
            updateProgress();
        }
    </script>

    <script type="text/javascript">
        // Obtener el valor del campo de texto
        var episodioId = document.getElementById("episodio_id").value;

        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '{{ route('admin.episodios.upload_audio') }}',
            query: {
                _token: '{{ csrf_token() }}',
                episodioId: episodioId,
            },
            fileType: ['mp3', 'mp4'],
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
            maxFiles: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function(file) {
            showProgress();
            resumable.upload()
        });

        resumable.on('fileProgress', function(file) {
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function(file, response) {
            response = JSON.parse(response)
            //$('#videoPreview').attr('src', response.path);
            $('.card-footer').show();

            Swal.fire({
                title: 'Archivo subido exitosamente',
                text: 'Debes actualizar la página para ver los cambios.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload(); // Recarga la página cuando el usuario acepta el mensaje
                }
            });
        });

        resumable.on('fileError', function(file, response) {
            alert('File uploading error.')
        });

        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>

@stop
