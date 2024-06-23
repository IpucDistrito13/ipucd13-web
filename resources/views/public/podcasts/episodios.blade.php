<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <title>{{ $metaData['title'] }}</title>
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
</head>

<body data-mobile-nav-style="full-screen-menu" data-mobile-nav-bg-color="#00338D" class="custom-cursor">

    <!-- start cursor -->
    <div class="cursor-page-inner">
        <div class="circle-cursor circle-cursor-inner"></div>
        <div class="circle-cursor circle-cursor-outer"></div>
    </div>
    <!-- end cursor -->

    @include('public.layouts.menu')
    <!-- start page title -->
    <section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography"
        style="background-image: url({{ Storage::url($podcast->imagen_banner) }} )">
        <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0"
            style="background-image: url('{{ asset('images/vertical-line-bg-small.svg') }}')"></div>
        <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true"
            data-particle-options='{"particles": {"number": {"value": 8,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'>
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
    <!-- end page title -->


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

    <section class="ipad-top-space-margin md-pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card" id="seccion_musica" style="display: none;">
                    <div class="card-body">
                        <audio id="audio-player"></audio>
    
                        <div id="info-cancion"></div>
                        <div id="current_time">0:00</div>
                        <div id="total_duration">Duración: --:--</div>
    
                        <div class="progress-bar" id="progress-bar" onclick="seek(event)">
                            <div class="progress-fill"></div>
                            <div class="progress-circle"></div>
                        </div>
    
                        <div class="section-pause">
                            <div class="buttons">
                                <button class="pause" id="pause" onclick="togglePlayPause()">
                                    <i class="fas fa-play" id="pause-icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @if ($episodios->isNotEmpty())
    <section class="big-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10"
                    data-anime='{ "el": "childs", "translateY": [15, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    @foreach ($episodios as $episodio)
                    <div
                        class="row border-bottom border-2 border-color-dark-gray pb-50px mb-50px sm-pb-35px sm-mb-35px align-items-center">
                        <div class="col-md-1 text-center text-md-end md-mb-15px">
                            <div class="fs-16 fw-600 text-dark-gray">01</div>
                        </div>
                        <div class="col-md-7 offset-lg-1 icon-with-text-style-01 md-mb-25px">
                            <div class="feature-box feature-box-left-icon-middle last-paragraph-no-margin">
                                <div class="feature-box-icon me-50px md-me-35px">
                                    <img src="https://via.placeholder.com/130x130" class="w-75px" alt="" />
                                </div>
                                <div class="feature-box-content">
                                    <span class="d-inline-block text-dark-gray mb-5px fs-20 ls-minus-05px"><span
                                            class="fw-700">{{ $episodio->titulo }}</span></span>
                                    <p class="w-90 md-w-100">{{ $episodio->descripcion }}</p>
                                </div>
                            </div>
                        </div>
    
                        @if ($episodio->url)
                        <div class="col-lg-3 col-md-4 text-center text-md-end">
                            <button class="btn btn-dark-gray btn-box-shadow btn-medium btn-sm btn-rounded reproducir"
                                data-id="{{ $episodio->id }}" onclick="reproducirBtn({{ $episodio->id }}, this)">Reproducir</button>
                        </div>
                        @endif
                    </div>
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
        let audioPlayer = document.getElementById('audio-player');
let isPlaying = false;
let currentEpisodioId = null;
let currentButton = null;

function reproducirBtn(episodioId, button) {
    if (audioPlayer && episodioId === currentEpisodioId) {
        togglePlayPause();
        return;
    }

    if (audioPlayer && isPlaying) {
        audioPlayer.pause();
        isPlaying = false;
        if (currentButton) {
            currentButton.innerHTML = 'Reproducir';
        }
    }

    axios.get('/api/v1/getAudioEpisodio/' + episodioId)
        .then(function(response) {
            if (!response.data.url) {
                console.error('No se encontró la URL del audio en la respuesta');
                return;
            }

            const audioUrl = response.data.url;
            audioPlayer.src = audioUrl;
            document.getElementById('info-cancion').innerText = response.data.titulo;
            document.getElementById('seccion_musica').style.display = 'block';

            audioPlayer.play().then(() => {
                isPlaying = true;
                currentEpisodioId = episodioId;
                currentButton = button;
                button.innerHTML = 'Pausar';
                document.getElementById('pause-icon').className = 'fas fa-pause';
            }).catch((error) => {
                console.error('Error al reproducir el audio:', error);
            });

            audioPlayer.addEventListener('timeupdate', updateProgress);
            audioPlayer.addEventListener('loadedmetadata', () => {
                document.getElementById('total_duration').innerText = 'Duración: ' + formatTime(audioPlayer.duration);
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
        if (currentButton) {
            currentButton.innerHTML = 'Reproducir';
        }
    } else {
        audioPlayer.play().then(() => {
            isPlaying = true;
            document.getElementById('pause-icon').className = 'fas fa-pause';
            if (currentButton) {
                currentButton.innerHTML = 'Pausar';
            }
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
    progressCircle.style.left = `calc(${progressPercent}% - 5px)`;

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

</body>

</html>
