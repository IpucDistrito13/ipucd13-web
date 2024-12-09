<!doctype html>
<html class="no-js" lang="es">

<head>
    <title>{{ $metaData['title'] }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="{{ $metaData['author'] }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="{{ $metaData['description'] }}">
    <meta name="robots" content="noindex">
    <!-- favicon icon -->
    @include('public.layouts.iconos')

    <style>
        .podcast-row:hover {
            box-shadow: 0 0 10px #00338d;
            /* Color: #00338d */
        }

        .banner-section {
            width: 100%;
            height: 0;
            padding-top: 20.00%;
            /* (500 / 1920) * 100 */
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
        }

        @media (max-width: 768px) {
            .banner-section {
                padding-top: 26.04%;
                /* Mantiene la misma proporción */
            }
        }

        @media (max-width: 480px) {
            .banner-section {
                padding-top: 15.04%;
                /* Mantiene la misma proporción */
            }
        }
    </style>

</head>

<!-- google analytics -->
@include('public.layouts.analytics')

<body data-mobile-nav-style="full-screen-menu" data-mobile-nav-bg-color="#00338D" class="custom-cursor">
    <!-- start cursor -->
    <div class="cursor-page-inner">
        <div class="circle-cursor circle-cursor-inner"></div>
        <div class="circle-cursor circle-cursor-outer"></div>
    </div>
    <!-- end cursor -->

    @include('public.layouts.menu')

    <!-- start banner -->
    <section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography banner-section"
        @if ($comite->imagen_banner) style="background-image: url({{ Storage::url($comite->imagen_banner) }});" @endif>
        <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0"
            style="background-image: url('images/vertical-line-bg-small.svg');">
        </div>
        <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true"
            data-particle-options='{"particles": {"number": {"value": 50,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#00338D", "#009FDA", "#F0AB00"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'>
        </div>
        <div class="container h-100 position-relative">
            <div class="row align-items-center h-100 extra-small-screen">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small"
                    data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font"></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner -->

    <!-- start descripcion comite -->
    <section class="bg-very-light-gray">
        <div class="container">
            <!-- start dropcaps item -->
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 sm-mb-30px">
                    <img class="w-100 border-radius-6px"
                        src="{{ !empty($comite->imagen->url) ? Storage::url($comite->imagen->url) : asset('img/imagen_not_found_480x640.png') }}"
                        alt="" />
                </div>
                <div class="col-12 col-lg-5 col-md-6 offset-lg-1 dropcap-style-01 last-paragraph-no-margin">
                    <p><span
                            class="first-letter text-dark-gray fw-700">{{ strtoupper(substr($comite->descripcion, 0, 1)) }}</span>{{ substr($comite->descripcion, 1) }}
                    </p>

                </div>
            </div>
            <!-- end dropcaps item -->
        </div>
    </section>
    <!-- end descripcion comite -->


        <!-- start section lideres -->
        @if ($lideres->isNotEmpty())
        <section class="background-repeat position-relative overflow-hidden" style="background-image:url('images/demo-spa-salon-home-bg-01.jpg');">
            <div class="container">
                <div class="row justify-content-center mb-2">
                    <div class="col-lg-6 text-center" data-anime='{ "el": "childs", "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 100, "easing": "easeOutQuad" }'>
                        <span class="fs-15 mb-5px text-tussock-yellow fw-600 d-block text-uppercase ls-1px">{{ $comite->nombre }}</span>
                        <h3 class="fw-600 ls-minus-1px text-dark-gray">Líderes</h3>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-lg-4 row-cols-sm-2" data-anime='{ "el": "childs", "translateY": [30, 0], "translateX": [-30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 100, "easing": "easeOutQuad" }'>
                    @foreach ($lideres as $lider)
                    <!-- start team member item --> 
                    <div class="col text-center team-style-05 md-mb-20px">
                        <div class="position-relative mb-30px border-radius-4px last-paragraph-no-margin overflow-hidden">
                            <img src="{{ !empty($lider->usuario->imagen->url) ? Storage::url($lider->usuario->imagen->url) : 'https://via.placeholder.com/600x755' }}" class="border-radius-4px" alt="" />
                            <div class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-40px lg-p-20px team-content bg-gradient-gray-light-dark-transparent">
                                <div class="social-icon fs-19">
                                    <!-- Enlace para WhatsApp -->
                                    <a href="https://wa.me/+57{{ $lider->usuario->celular }}" target="_blank" class="text-white">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>

                                    <!-- Enlace para Llamar -->
                                    <a href="tel:{{ $lider->usuario->celular }}" class="text-white">
                                        <i class="fas fa-phone-volume"></i>
                                    </a>

                                </div>                                
                            </div>
                        </div>
                        <div class="text-dark-gray lh-24 fs-18 fw-600">{{ $lider->usuario->nombre. ' ' .$lider->usuario->apellidos }}</div>
                        <p class="mb-0">{{ $lider->liderTipo->nombre }}</p>
                    </div>
                    <!-- end team member item -->   
                    @endforeach
                </div>
            </div>
        </section>
        @endif
        <!-- end section lideres -->

    <!-- start section publicaciones -->
    @if ($publicaciones->isNotEmpty())
        <section
            class="bg-gradient-tranquil-white overflow-hidden position-relative overlap-height pb-5 md-pb-7 xs-pb-50px">
            <div class="container overlap-gap-section">
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

                <!-- start row -->
                <div class="row">
                    <div class="col-12">
                        <ul
                            class="blog-classic blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>

                            @foreach ($publicaciones as $publicacion)
                                <!-- start blog item -->
                                <li class="grid-item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="blog-image position-relative overflow-hidden border-radius-4px">
                                            <a href="{{ route('public.publicaciones.show', $publicacion) }}">
                                                <img src="{{ !empty($publicacion->imagen->url) ? Storage::url($publicacion->imagen->url) : asset('img/imagen_not_found_480x640.png') }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="card-body px-0 pt-30px pb-30px">
                                            <span class="fs-13 text-uppercase mb-5px d-block"><a href="#"
                                                    class="text-dark-gray text-dark-gray-hover fw-600 categories-text">{{ $publicacion->comite->nombre }}</a>
                                                <br>
                                                <a href="#"
                                                    class="blog-date text-dark-gray-hover">{{ $publicacion->created_at->format('Y-m-d h:i a') }}</a>
                                            </span>
                                            <a href="{{ route('public.publicaciones.show', $publicacion) }}"
                                                class="card-title mb-10px fw-600 fs-17 lh-26 text-dark-gray text-dark-gray-hover d-inline-block w-95">{{ $publicacion->titulo }}</a>
                                            <p class="mb-10px w-95">{{ $publicacion->descripcion }}</p>
                                            <a href="{{ route('public.publicaciones.show', $publicacion) }}"
                                                class="card-link alt-font fs-12 text-uppercase text-dark-gray text-dark-gray-hover fw-700">Ver
                                                más<i class="feather icon-feather-arrow-right icon-very-small"></i></a>
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
        </section>

    @endif
    <!-- end section publicaciones -->

    <!-- start section show serie -->
    @if ($series->isNotEmpty())
        <section class="background-repeat overflow-hidden">
            <div class="container">
                <div class="row justify-content-center align-items-center mb-4 text-center text-md-start">
                    <div class="col-xxl-8 col-md-7 sm-mb-10px">
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Últimos series</h2>
                    </div>
                    <div class="col-xxl-4 col-md-5 text-center text-md-end"
                        data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <a href="{{ route('public.series.index') }}"
                            class="btn btn-link btn-hover-animation-switch btn-extra-large text-dark-gray fw-600">
                            <span>
                                <span class="btn-text">Explora todas las series</span>
                                <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- start row -->
                <div class="row">
                    <div class="col-12">
                        <ul
                            class="blog-classic blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>

                            @foreach ($series as $serie)
                                <!-- start blog item -->
                                <li class="grid-item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="blog-image position-relative overflow-hidden border-radius-4px">
                                            <a href="{{ route('public.series.show', $serie) }} ">
                                                <img src="{{ !empty($serie->imagen->url) ? Storage::url($serie->imagen->url) : asset('img/imagen_not_found_480x640.png') }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="card-body px-0 pt-30px pb-30px">
                                            <span class="fs-13 text-uppercase mb-5px d-block"><a href="#"
                                                    class="text-dark-gray text-dark-gray-hover fw-600 categories-text">{{ $serie->comite->nombre }}</a>
                                                <br>
                                                <a href="{{ route('public.series.show', $serie) }}"
                                                    class="blog-date text-dark-gray-hover">{{ $serie->created_at->format('Y-m-d h:i a') }}</a>
                                            </span>
                                            <a href="{{ route('public.series.show', $serie) }} "
                                                class="card-title mb-10px fw-600 fs-17 lh-26 text-dark-gray text-dark-gray-hover d-inline-block w-95">{{ $serie->titulo }}</a>
                                            <p class="mb-10px w-95">{{ $serie->descripcion }}</p>
                                            <a href="{{ route('public.series.show', $serie) }} "
                                                class="card-link alt-font fs-12 text-uppercase text-dark-gray text-dark-gray-hover fw-700">Ver
                                                más<i class="feather icon-feather-arrow-right icon-very-small"></i></a>
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
        </section>
    @endif
    <!-- end section show serie-->

    <!-- start section show podcasts -->
    @if (!$podcasts->isEmpty())
        <section class="background-repeat overflow-hidden">
            <div class="container">
                <div class="row justify-content-center align-items-center mb-4 text-center text-md-start">
                    <div class="col-xxl-8 col-md-7 sm-mb-10px">
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Últimos podcasts</h2>
                    </div>
                    <div class="col-xxl-4 col-md-5 text-center text-md-end"
                        data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <a href="#"
                            class="btn btn-link btn-hover-animation-switch btn-extra-large text-dark-gray fw-600">
                            <span>
                                <span class="btn-text">Explora todas los podcasts</span>
                                <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- start row -->
                <div class="row">
                    <div class="col-12">
                        <ul
                            class="blog-classic blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>

                            @foreach ($podcasts as $podcast)
                                <!-- start blog item -->
                                <li class="grid-item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="blog-image position-relative overflow-hidden border-radius-4px">
                                            <a href="{{ route('public.podcasts.episodios', $podcast) }}">
                                                <img src="{{ !empty($podcast->imagen->url) ? Storage::url($podcast->imagen->url) : asset('img/imagen_not_found_480x640.png') }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="card-body px-0 pt-30px pb-30px">
                                            <span class="fs-13 text-uppercase mb-5px d-block"><a href="#"
                                                    class="text-dark-gray text-dark-gray-hover fw-600 categories-text">{{ $podcast->comite->nombre }}</a>
                                                <br>
                                                <a href="#"
                                                    class="blog-date text-dark-gray-hover">{{ $podcast->created_at->format('Y-m-d h:i a') }}</a>
                                            </span>
                                            <a href="{{ route('public.podcasts.episodios', $podcast) }}"
                                                class="card-title mb-10px fw-600 fs-17 lh-26 text-dark-gray text-dark-gray-hover d-inline-block w-95">{{ $podcast->titulo }}</a>
                                            <p class="mb-10px w-95">{{ $podcast->descripcion }}</p>
                                            <a href="{{ route('public.podcasts.episodios', $podcast) }}"
                                                class="card-link alt-font fs-12 text-uppercase text-dark-gray text-dark-gray-hover fw-700">Ver
                                                más<i class="feather icon-feather-arrow-right icon-very-small"></i></a>
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
        </section>
    @endif
    <!-- end section show podcasts -->

    <!-- start section carpetas/archivos -->
    <section class="bg-solitude-blue">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-xl-8 col-lg-10 text-center">
                    <h2 class="text-dark-gray fw-600 ls-minus-1px"
                        data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        Descargable Comité <br> {{ $comite->nombre }}
                    </h2>
                </div>
            </div>
            <div class="row align-items-center"
                data-anime='{ "el": "childs", "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 150, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <div class="col-xl-3 col-lg-4 col-md-12 tab-style-05 md-mb-30px sm-mb-20px">
                    <!-- start tab navigation -->
                    <ul class="nav nav-tabs justify-content-center border-0 text-left fw-500 fs-18 alt-font">
                        @foreach ($carpetas as $index => $carpeta)
                            <li class="nav-item">
                                <a data-bs-toggle="tab" href="#tab_{{ $carpeta['slug'] }}"
                                    class="nav-link {{ $index === 0 ? 'active' : '' }}">
                                    <i class="feather icon-feather-briefcase icon-extra-medium text-dark-gray"></i>
                                    <span>{{ $carpeta['nombre'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- end tab navigation -->
                </div>
                <div class="col-xl-9 col-lg-8 col-md-12">
                    <div class="tab-content">
                        @foreach ($carpetas as $index => $carpeta)
                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="tab_{{ $carpeta['slug'] }}">
                                <div class="row align-items-center">
                                    @foreach ($carpeta['archivos'] as $archivo)
                                        <div class="col-12" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                            <div class="row border-top border-color-dark-gray position-relative g-0 sm-border-top-0 sm-pb-30px">
                                                <div class="col-lg-8 col-md-7 last-paragraph-no-margin ps-30px pe-30px pt-25px pb-25px sm-pt-15px sm-pb-15px border-start border-color-dark-gray sm-border-start-0 sm-px-0">
                                                    <p class="sm-w-85">
                                                        <span class="fw-600 text-dark-gray">{{ $archivo['nombre_original'] }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-lg-2 col-md-3 align-self-center text-md-end">
                                                    @if ($archivo['tipo'] === 'enlace')
                                                        <a href="{{ $archivo['url'] }}" target="_blank" rel="noopener noreferrer">Abrir enlace</a>
                                                    @else
                                                        <a href="{{ route('public.archivos.download', $archivo['id']) }}" target="_blank">Descarga ahora</a>
                                                    @endif
                                                </div>
                                                <div class="col-auto col-md-1 align-self-center text-end text-md-center sm-position-absolute right-5px">
                                                    <a href="#"><i class="bi bi-arrow-right-short text-dark-gray icon-medium"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section carpetas/archivos -->

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
    <script type="text/javascript" src="{{ asset('js/jquery.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/vendors.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }} "></script>
</body>

</html>
