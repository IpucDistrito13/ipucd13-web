<!doctype html>
<html class="no-js" lang="en">

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

    <!-- start banner  -->
    <section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography"
        style="background-image: url({{ Storage::url($comite->imagen_banner) }} )">
        <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0"
            style="background-image: url('{{ asset('images/vertical-line-bg-small.svg') }}')"></div>
        <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true"
            data-particle-options='{"particles": {"number": {"value": 10,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#00338D", "#009FDA", "#F0AB00", "#00338D", "#009FDA"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'>
        </div>
        <div class="container">
            <div class="row align-items-center extra-small-screen">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small"
                    data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">{{ $comite->nombre }}</h2>
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
                                                <a href="#" class="blog-date text-dark-gray-hover">{{ $publicacion->created_at->format('Y-m-d h:i a') }}</a>
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
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Últimos videos</h2>
                    </div>
                    <div class="col-xxl-4 col-md-5 text-center text-md-end"
                        data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <a href"#"
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
                        <a href"#"
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
