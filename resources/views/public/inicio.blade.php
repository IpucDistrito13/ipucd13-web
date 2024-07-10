<!doctype html>
<html class="no-js" lang="es">

<head>
    <title>{{ $metaData['titulo'] }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="author" content="Distrito 13">
    <meta name="description" content="Iglesia Pentecostal Unida de Colombia - Distrito 13">
    <!-- favicon icon -->
    @include('public.layouts.iconos')
    <!-- <link rel="stylesheet" href="{{ asset('demos/elearning/elearning.css') }}" /> -->

    <style>
        
        @font-face {
            font-family: 'Myriad Pro Bold';
            src: url('{{ asset('fonts/myriadpro_bold.otf') }}') format('opentype');
            font-weight: bold;
        }
        
    
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }
    
        .reproductor {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 250px;
            border: 1px solid #fff;
            padding: 20px;
            border-radius: 10px;
            background-color: #00338D;
            z-index: 999;
            color: #fff;
            text-align: center;
            font-family: 'Myriad Pro Bold', Arial, sans-serif;
        }
    
        .titulo {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    
        .controles {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    
        .btn {
            margin: 0 10px;
        }
    
        .icono {
            margin-right: 8px;
        }
    
        .bg-base-color {
            background-color: #f0ab00;
        }
    
        .liveText,
        .text_secccion1,
        .playText {
            font-family: 'Myriad Pro Bold', Arial, sans-serif;
        }
    
        #liveText {
            color: white;
            background-color: red;
            padding: 2px 5px;
            border-radius: 5px;
        }
    
        .btn.btn-base-color {
            background-color: #f00;
            color: var(--white);
            border: 2px solid #f00;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
    
        .btn.btn-base-color:hover {
            background-color: #f00;
            color: var(--white);
            border-color: #f00;
        }
    
        @media only screen and (max-width: 600px) {
            .reproductor {
                width: 90%;
                left: 5%;
            }
        }
    </style>

    {{-- SECCION REPRODUCTOR --}}
    <div class="reproductor">
        <h2 class="titulo">Radio IPUC - <span id="liveText"> Live</span></h2>
        <div class="controles">
            <button class="btn btn-large btn-dark-gray btn-rounded btn-box-shadow btn-switch-text left-icon submit"
                type="button" id="toggle">
                <span>
                    <span id="playIcon" class="icono"><i class="fas fa-play"></i></span>
                    <span id="playText">Play</span>
                </span>
            </button>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        const audio = document.createElement("audio");
        audio.controls = false;
        audio.src = "https://play14.tikast.com:22038/stream?type=http&nocache=2126";

        const toggleButton = document.getElementById("toggle");
        const playIcon = document.getElementById("playIcon");
        const playText = document.getElementById("playText");

        toggleButton.addEventListener("click", () => {
            if (audio.paused) {
                audio.play();
                playIcon.innerHTML = '<i class="fas fa-pause"></i>';
                playText.textContent = 'Pause';
            } else {
                audio.pause();
                playIcon.innerHTML = '<i class="fas fa-play"></i>';
                playText.textContent = 'Play';
            }
        });
    </script>
</head>

<body data-mobile-nav-style="full-screen-menu" data-mobile-nav-bg-color="#00338D"
    class="custom-cursor">
    <!-- start cursor -->
    <div class="cursor-page-inner">
        <div class="circle-cursor circle-cursor-inner"></div>
        <div class="circle-cursor circle-cursor-outer"></div>
    </div>
    <!-- end cursor -->

    <!-- start header -->
    @include('public.layouts.menu')
    <!-- end header -->

    <!-- start section principal -->
    <section
        class="p-0 overflow-hidden bg-dark-gray full-screen ipad-top-space-margin md-h-auto position-relative md-pb-70px sm-pb-40px cover-background"
        style="background-image: url('{{ asset('img/fondo_azul_principal.png') }}')">
        <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0"
            style="background-image: url('images/vertical-line-bg-small.svg')"></div>
        <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true"
            data-particle-options='{"particles": {"number": {"value": 10,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#00338D", "#009FDA", "#F0AB00", "#00338D", "#009FDA"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'>
        </div>
        <div class="position-absolute left-minus-80px top-25" data-bottom-top="transform: translateY(-80px)"
            data-top-bottom="transform: translateY(80px)">
            <img src="{{ asset('img/circulo_azul_principal.png') }}" alt="">
        </div>
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-xl-5 col-lg-6 col-md-12 text-white text-center text-lg-start position-relative z-index-1 d-flex flex-column justify-content-center h-100 md-mt-50px md-mb-20px xs-mb-10px"
                    data-anime='{ "el": "childs", "opacity": [0, 1], "rotateY": [90, 0], "rotateZ": [-10, 0], "translateY": [80, 0], "translateZ": [50, 0], "staggervalue": 200, "duration": 600, "delay": 100, "easing": "easeOutCirc" }'>
                    <span id="text_secccion1" name="text_secccion1" class="alt-font fs-75 lh-80 sm-fs-60 fw-500 mb-25px ls-minus-2px">Iglesia Pentecostal Unida de Colombia</span>
                    <div class="mb-30px w-80 md-w-60 sm-w-100 d-block mx-auto mx-lg-0 overflow-hidden">
                        <span class="fs-45 lh-65 fw-500 opacity-5 d-inline-block">DISTRITO 13</span>
                    </div>
                    <div class="overflow-hidden">
                        @if(!empty($transmision->url))
                            <a href="https://www.youtube.com/watch?v={{ $transmision->url }}"
                                class="btn btn-extra-large btn-base-color btn-rounded btn-switch-text fw-600 d-inline-block me-25px sm-me-10px align-middle left-icon popup-youtube">
                                <span>
                                    <span><i class="feather icon-feather-youtube"></i></span>
                                    <span class="btn-double-text ls-minus-05px" data-text="Ver ahora">Estamos en vivo</span>
                                </span>
                            </a>
                        @endif
                    </div>
                    
                    <div
                        class="row row-cols-3 justify-content-center counter-style-04 w-100 md-w-auto position-absolute lg-position-relative bottom-80px lg-bottom-0px lg-mt-50px">
                        <!-- start counter item -->
                        <div class="col text-center text-lg-start">
                            <h5 class="vertical-counter d-inline-flex alt-font text-white fw-600 mb-10px" data-text=""
                                data-to="{{ $cantidadDepartamentos }}"></h5>
                            <div
                                class="divider-style-03 divider-style-03-01 border-2 border-color-base-color mb-5px w-80 xs-w-90 md-mx-auto">
                            </div>
                            <span class="fw-300 text-white opacity-5">Departamentos</span>
                        </div>
                        <!-- end counter item -->
                        <!-- start counter item -->
                        <div class="col text-center text-lg-start">
                            <h5 class="vertical-counter d-inline-flex alt-font text-white fw-600 mb-10px" data-text=""
                                data-to="{{ $cantidadMunicipios }}"></h5>
                            <div
                                class="divider-style-03 divider-style-03-01 border-2 border-color-base-color mb-5px w-80 xs-w-90 md-mx-auto">
                            </div>
                            <span class="fw-300 text-white opacity-5">Municipios</span>
                        </div>
                        <!-- end counter item -->
                        <!-- start counter item -->
                        <div class="col text-center text-lg-start">
                            <h5 class="vertical-counter d-inline-flex alt-font text-white fw-600 mb-10px" data-text=""
                                data-to="{{ $cantidadCongregaciones }}"></h5>
                            <div
                                class="divider-style-03 divider-style-03-01 border-2 border-color-base-color mb-5px w-80 xs-w-90 md-mx-auto">
                            </div>
                            <span class="fw-300 text-white opacity-5">Congregaciones</span>
                        </div>
                        <!-- end counter item -->
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 pt-30px lg-pt-0">
                    <div class="position-relative outside-box-right-10 md-outside-box-right-0 atropos" data-atropos>
                        <div class="atropos-scale">
                            <div class="atropos-rotate">
                                <div class="atropos-inner text-center w-100">
                                    <img src="https://via.placeholder.com/975x990" alt="">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section principal -->

    <!-- start section  applicacion -->
    <section class="overflow-hidden">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-7 col-lg-6 text-center md-mb-50px sm-mb-30px"
                    data-anime='{ "el": "childs", "opacity": [0, 1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <div class="position-relative pe-50px lg-pe-0 outside-box-left-10 md-outside-box-left-0 atropos"
                        data-atropos>
                        <div class="atropos-scale">
                            <div class="atropos-rotate">
                                <div class="atropos-inner text-center w-100 overflow-visible">
                                    <img src="https://via.placeholder.com/835x710" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-11 position-relative"
                    data-anime='{ "el": "childs", "translateX": [30, 0], "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 300, "easing": "easeOutQuad" }'>

                    <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-40px sm-mb-25px mx-auto">Descarga nuestra
                        app</h2>
                    <div class="accordion accordion-style-06 text-start" id="accordion-style-07">
                        <!-- start accordion item -->
                        <div class="accordion-item active-accordion">
                            <div class="accordion-header">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-07-01"
                                    aria-expanded="true" data-bs-parent="#accordion-style-07">
                                    <div
                                        class="accordion-title fs-18 position-relative pe-0 xs-lh-28px text-dark-gray fw-600 mb-0">
                                        Publico general</div>
                                </a>
                            </div>
                            <div id="accordion-style-07-01" class="accordion-collapse collapse show"
                                data-bs-parent="#accordion-style-07">
                                <div class="accordion-body last-paragraph-no-margin">
                                    <p>Visualice tranmisiones en vivo, videos, escucha musica, podcast, eventos por
                                        venir, y mucho mas...</p>
                                    <i class="line-icon-Address-Book icon-extra-double-large opacity-2"></i>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->
                        <!-- start accordion item -->
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-07-02"
                                    aria-expanded="false" data-bs-parent="#accordion-style-07">
                                    <div
                                        class="accordion-title fs-18 position-relative pe-0 text-dark-gray fw-600 mb-0">
                                        Pastores</div>
                                </a>
                            </div>
                            <div id="accordion-style-07-02" class="accordion-collapse collapse"
                                data-bs-parent="#accordion-style-07">
                                <div class="accordion-body last-paragraph-no-margin">
                                    <p>Informate de primera mano con información privilegiada.</p>
                                    <i class="line-icon-Sand-watch icon-extra-double-large opacity-2"></i>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->
                        <!-- start accordion item -->
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-07-03"
                                    aria-expanded="false" data-bs-parent="#accordion-style-07">
                                    <div
                                        class="accordion-title fs-18 position-relative pe-0 text-dark-gray fw-600 mb-0">
                                        Lideres</div>
                                </a>
                            </div>
                            <div id="accordion-style-07-03" class="accordion-collapse collapse"
                                data-bs-parent="#accordion-style-07">
                                <div class="accordion-body last-paragraph-no-margin">
                                    <p>Visualice información informacion requerida</p>
                                    <i class="line-icon-Gear-2 icon-extra-double-large opacity-2"></i>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->
                    </div>
                    <a href="#"
                        class="btn btn-extra-large btn-dark-gray btn-box-shadow btn-rounded btn-switch-text mt-30px">
                        <span>
                            <span class="btn-double-text" data-text="Descargar">Play Store</span>
                            <span><i class="fa-solid fa-arrow-right"></i></span>
                        </span>

                    </a>

                    <a href="#"
                        class="btn btn-extra-large btn-dark-gray btn-box-shadow btn-rounded btn-switch-text mt-30px">
                        <span>
                            <span class="btn-double-text" data-text="Descargar">App Store</span>
                            <span><i class="fa-solid fa-arrow-right"></i></span>
                        </span>

                    </a>
                </div>
            </div>
        </div>

    </section>
    <!-- end section aplicacion -->


            <!-- start section  ultimas publicaciones -->
            <section class="pt-0 ps-15 pe-15 xl-ps-2 xl-pe-2 lg-ps-2 lg-pe-2 sm-mx-0">
                <div class="row justify-content-center align-items-center mb-4 text-center text-md-start">
                    <div class="col-xxl-8 col-md-7 sm-mb-10px">
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Últimas publicaciones</h2>
                    </div>
                    <div class="col-xxl-4 col-md-5 text-center text-md-end"
                        data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <a href="{{ route('public.publicaciones.index') }}"
                            class="btn btn-link btn-hover-animation-switch btn-extra-large text-dark-gray fw-600">
                            <span>
                                <span class="btn-text">Explora todas las publicaciones</span>
                                <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="container-fluid">
                    
                    <!-- start row -->
                    <div class="row">
                        <div class="col-12">
                            <ul class="blog-classic blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                                <li class="grid-sizer"></li>
    
                                @foreach ($publicaciones as $publicacion)
    
                                <!-- start blog item -->
                                <li class="grid-item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="blog-image position-relative overflow-hidden border-radius-4px">
                                            <a href="{{ route('public.publicaciones.show', $publicacion) }}" >
                                                <img src="{{ !empty($publicacion->imagen->url) ? Storage::url($publicacion->imagen->url) : asset('img/imagen_not_found_480x640.png') }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="card-body px-0 pt-30px pb-30px">
                                            <span class="fs-13 text-uppercase mb-5px d-block"><a href="blog-grid.html" class="text-dark-gray text-dark-gray-hover fw-600 categories-text">{{ $publicacion->comite->nombre }}</a><a href="blog-grid.html" class="blog-date text-dark-gray-hover">26 August 2023</a></span>
                                            <a href="{{ route('public.publicaciones.show', $publicacion) }}" class="card-title mb-10px fw-600 fs-17 lh-26 text-dark-gray text-dark-gray-hover d-inline-block w-95">{{ $publicacion->titulo }}</a>
                                            <p class="mb-10px w-95">{{ $publicacion->descripcion }}</p>
                                            <a href="{{ route('public.publicaciones.show', $publicacion) }}" class="card-link alt-font fs-12 text-uppercase text-dark-gray text-dark-gray-hover fw-700">Ver más<i class="feather icon-feather-arrow-right icon-very-small"></i></a>
                                        </div>
                                    </div>
                                </li>
                                <!-- end blog item -->
                                @endforeach
    
    
                            </ul>
                        </div>
                        
                    </div>
                    <!-- end row -->

                </div>


                            <!-- seecin redes -->
            <div class="row justify-content-center mt-5">

                <!-- start features box item -->
                <div class="col-auto icon-with-text-style-08 md-mb-10px xs-mb-15px pe-25px md-pe-15px"
                    data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <div class="feature-box feature-box-left-icon-middle xs-lh-28">
                        <div class="feature-box-icon me-10px">
                            <i class="feather icon-feather-mail fs-20 text-dark-gray"></i>
                        </div>
                        <div class="feature-box-content">
                            <span class="text-dark-gray fw-500 fs-20 xs-fs-18 ls-minus-05px">
                                Suscríbete, mira videos y transmisiones en 
                                <a href="{{ $youtube }}" target="_blank" class="text-decoration-line-bottom-medium text-dark-gray fw-600">Youtube</a>
                            </span>
                            
                        </div>
                    </div>
                </div>
                <!-- end features box item -->
                <!-- start features box item -->
                <div class="col-auto icon-with-text-style-08 md-mb-10px xs-mb-15px pe-25px md-pe-15px"
                    data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <div class="feature-box feature-box-left-icon-middle xs-lh-28">
                        <div class="feature-box-icon me-10px">
                            <i class="feather icon-feather-mail fs-20 text-dark-gray"></i>
                        </div>
                        <div class="feature-box-content">
                            <span class="text-dark-gray fw-500 fs-20 xs-fs-18 ls-minus-05px">Síguenos y ve nuestro
                                contenido. <a href="{{ $instagram }}" target="_blank"
                                    class="text-decoration-line-bottom-medium text-dark-gray fw-600">Instagram</a></span>
                        </div>
                    </div>
                </div>
                <!-- end features box item -->
                <!-- start features box item -->
                <div class="col-auto icon-with-text-style-08 ps-25px md-ps-15px md-pe-15px"
                    data-anime='{ "translateX": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <div class="feature-box feature-box-left-icon-middle xs-lh-28">
                        <div class="feature-box-icon me-10px">
                            <i class="feather icon-feather-thumbs-up fs-20 text-dark-gray"></i>
                        </div>
                        <div class="feature-box-content">
                            <span class="text-dark-gray fw-500 fs-20 xs-fs-18 ls-minus-05px">Manténgase en contacto. <a
                                    href="{{ $facebook }}" target="_blank"
                                    class="text-decoration-line-bottom-medium text-dark-gray fw-600">Danos like en
                                    facebook</a></span>
                        </div>
                    </div>
                </div>
                <!-- end features box item -->
            </div>
            <!-- end seccion redes -->


            
            </section>
            <!-- end section ultimas publicaciones -->

    <!-- start footer -->
    @include('public.layouts.footer')
    <!-- end footer -->

    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span
                    class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->
    <!-- javascript libraries -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vendors.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>

</html>
