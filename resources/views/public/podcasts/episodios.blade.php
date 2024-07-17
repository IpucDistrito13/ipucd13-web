<!doctype html>
<html class="no-js" lang="es">

<head>
    <title>{{ $metaData['title'] }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="author" content="{{ $metaData['author'] }}">
    <meta name="description" content="{{ $metaData['description'] }}">
    <meta name="robots" content="noindex">
    <!-- favicon icon -->
    @include('public.layouts.iconos')

    <style>
        a {
            color: #00008B;
        }

        .progress-bar {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 10px;
            cursor: pointer;
            position: relative;
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
            transition: left 0.1s ease-out;
            /* Agregamos transición para suavizar el movimiento */
        }

        .audio-player-container {
            margin-top: 20px;
        }

        .audio-player-container audio {
            width: 100%;
            height: 40px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .info-cancion {
            font-size: 16px;
            text-align: center;
        }

        .current_time,
        .total_duration {
            font-size: 14px;
            margin-right: 10px;
        }

        .section-pause .buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .section-pause .pause {
            background: none;
            border: none;
            color: #007bff;
            font-size: 24px;
            cursor: pointer;
            outline: none;
        }

        .pause {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .pause:hover {
            background-color: #e9e9e9;
        }

        .pause i {
            font-size: 20px;
            margin-right: 5px;
            color: #007bff;
        }
    </style>


</head>

<body data-mobile-nav-style="full-screen-menu" data-mobile-nav-bg-color="#00338D" class="custom-cursor">

    <!-- start cursor -->
    <div class="cursor-page-inner">
        <div class="circle-cursor circle-cursor-inner"></div>
        <div class="circle-cursor circle-cursor-outer"></div>
    </div>
    <!-- end cursor -->

    @include('public.layouts.menu')

    <!-- start banner -->
    <section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography"
        style="background-image: url({{ Storage::url($podcast->imagen_banner) }} )">
        <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0"
            style="background-image: url('{{ asset('images/vertical-line-bg-small.svg') }}')"></div>
        <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true"
            data-particle-options='{"particles": {"number": {"value": 50,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#00338D", "#009FDA", "#F0AB00"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'>
        </div>
        <div class="container">
            <div class="row align-items-center extra-small-screen">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small"
                    data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h1 class="mb-20px alt-font text-yellow"></h1>
                    <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">{{ $podcast->titulo }}</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner -->


    <!-- start section -->
    <section class="bg-very-light-gray">
        <div class="container">
            <!-- start dropcaps item -->
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 sm-mb-30px">
                    <img class="w-100 border-radius-6px"
                        src="{{ !empty($podcast->imagen->url) ? Storage::url($podcast->imagen->url) : asset('img/imagen_not_found_480x640.png') }}"
                        alt="" />
                </div>
                <div class="col-12 col-lg-5 col-md-6 offset-lg-1 dropcap-style-01 last-paragraph-no-margin">
                    <p><span
                            class="first-letter text-dark-gray fw-700">{{ strtoupper(substr($podcast->contenido, 0, 1)) }}</span>{{ substr($podcast->contenido, 1) }}
                    </p>
                </div>
            </div>
            <!-- end dropcaps item -->
        </div>
    </section>
    <!-- end section -->

    @if ($episodios->isNotEmpty())
        <section class="big-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10"
                        data-anime='{ "el": "childs", "translateY": [15, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        @php $contador = 1; @endphp <!-- Inicializamos el contador -->
                        @foreach ($episodios as $episodio)
                            <div
                                class="row border-bottom border-2 border-color-dark-gray pb-50px mb-50px sm-pb-35px sm-mb-35px align-items-center">
                                <div class="col-md-1 text-center text-md-end md-mb-15px">
                                    <div class="fs-16 fw-600 text-dark-gray">
                                        {{ str_pad($contador, 2, '0', STR_PAD_LEFT) }}</div>
                                    <!-- Mostramos el contador con formato 01, 02, etc. -->
                                </div>
                                <div class="col-md-7 offset-lg-1 icon-with-text-style-01 md-mb-25px">
                                    <div class="feature-box feature-box-left-icon-middle last-paragraph-no-margin">

                                        <div class="feature-box-content">
                                            <span class="d-inline-block text-dark-gray mb-5px fs-20 ls-minus-05px"><span
                                                    class="fw-700">{{ $episodio->titulo }}</span></span>
                                            <p class="w-90 md-w-100">{{ $episodio->descripcion }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 text-center text-md-end">
                                    @if ($episodio->url)
                                        <div class="audio-player-container">
                                            <audio id="audio-player-{{ $episodio->id }}"></audio>

                                            <div class="info-cancion" id="info-cancion-{{ $episodio->id }}"></div>
                                            <div class="current_time" id="current_time-{{ $episodio->id }}">0:00</div>
                                            <div class="total_duration" id="total_duration-{{ $episodio->id }}">
                                                Duración: --:--</div>

                                            <div class="progress-bar" id="progress-bar-{{ $episodio->id }}"
                                                onclick="seek(event, {{ $episodio->id }})">
                                                <div class="progress-fill" id="progress-fill-{{ $episodio->id }}">
                                                </div>
                                                <div class="progress-circle"></div>
                                            </div>

                                            <div class="mt-3 text-center">
                                                <button
                                                    class="btn btn-dark-gray btn-box-shadow btn-medium btn-sm btn-rounded reproducir"
                                                    data-id="{{ $episodio->id }}"
                                                    onclick="reproducirBtn({{ $episodio->id }}, this)">Reproducir</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @php $contador++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif



    <!-- end section movies -->

    <!-- start footer -->
    @include('public.layouts.footer')
    <!-- end footer -->

    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->
    <!-- javascript libraries -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/vendors.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }} "></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        // Variable global para almacenar la URL del audio una vez obtenida
        let audioUrl = null;
        // Variable para controlar la posición de reproducción
        let currentPlaybackTime = 0;

        // Función para manejar el botón de reproducir/pausar
        function reproducirBtn(episodioId, button) {
            let audioPlayer = document.getElementById(`audio-player-${episodioId}`);
            let isPlaying = !audioPlayer.paused;

            if (!isPlaying) {
                // Si no se ha obtenido la URL del audio, obtenerla
                if (!audioUrl) {
                    obtenerUrlAudio(episodioId, button);
                } else {
                    playAudio(audioPlayer, episodioId, button);
                }
            } else {
                pauseAudio(audioPlayer, button);
            }
        }

        // Función para obtener la URL del audio del servidor
        function obtenerUrlAudio(episodioId, button) {
            axios.get(`/api/v1/getAudioEpisodio/${episodioId}`)
                .then(function(response) {
                    if (!response.data.url) {
                        console.error('No se encontró la URL del audio en la respuesta');
                        return;
                    }

                    audioUrl = response.data.url;
                    let audioPlayer = document.getElementById(`audio-player-${episodioId}`);
                    playAudio(audioPlayer, episodioId, button);
                })
                .catch(function(error) {
                    console.error('Error al obtener el audio:', error);
                });
        }

        // Función para reproducir el audio
        function playAudio(audioPlayer, episodioId, button) {
            // Establecer la URL del audio solo si es necesario
            if (audioPlayer.src !== audioUrl) {
                audioPlayer.src = audioUrl;
            }

            // Configurar evento para manejar tiempo de reproducción
            audioPlayer.addEventListener('timeupdate', function onTimeUpdate() {
                currentPlaybackTime = audioPlayer.currentTime;
            });

            // Si el audio ya se ha cargado antes, continuar desde currentPlaybackTime
            if (currentPlaybackTime > 0 && !isNaN(currentPlaybackTime)) {
                audioPlayer.currentTime = currentPlaybackTime;
            }

            // Iniciar la reproducción
            audioPlayer.play()
                .then(() => {
                    updatePlayerUI(audioPlayer, episodioId);
                    button.innerText = 'Pausar';
                })
                .catch((error) => {
                    console.error('Error al reproducir el audio:', error);
                });
        }

        // Función para pausar el audio
        function pauseAudio(audioPlayer, button) {
            audioPlayer.pause();
            button.innerText = 'Reproducir';
        }

        // Función para actualizar la interfaz del reproductor
        function updatePlayerUI(audioPlayer, episodioId) {
            audioPlayer.addEventListener('timeupdate', function() {
                let progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
                let progressFill = document.getElementById(`progress-fill-${episodioId}`);
                progressFill.style.width = `${progress}%`;

                let progressCircle = document.querySelector(`#progress-bar-${episodioId} .progress-circle`);
                progressCircle.style.left = `calc(${progress}% - 5px)`; // Ajusta el desplazamiento del círculo

                let currentTime = formatTime(audioPlayer.currentTime);
                document.getElementById(`current_time-${episodioId}`).innerText = currentTime;
            });

            audioPlayer.addEventListener('loadedmetadata', function() {
                let duration = formatTime(audioPlayer.duration);
                document.getElementById(`total_duration-${episodioId}`).innerText = `Duración: ${duration}`;
            });
        }

        // Función para buscar en la barra de progreso
        function seek(event, episodioId) {
            let progressBar = document.getElementById(`progress-bar-${episodioId}`);
            let rect = progressBar.getBoundingClientRect();
            let offsetX = event.clientX - rect.left;
            let totalWidth = rect.width;
            let percentage = offsetX / totalWidth;
            let seekTime = percentage * document.getElementById(`audio-player-${episodioId}`).duration;

            document.getElementById(`audio-player-${episodioId}`).currentTime = seekTime;
        }

        // Función para formatear el tiempo en formato mm:ss
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }
    </script>

</body>

</html>
