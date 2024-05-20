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
    <link rel="stylesheet" href="{{ asset('demos/elearning/elearning.css') }}" />

</head>

<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#313e3b">

    @include('public.layouts.menu')
    <!-- start page title  -->
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
                    <h1 class="mb-20px alt-font text-yellow">Comité</h1>
                    <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">{{ $comite->nombre }}</h2>
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
                        src="{{ !empty($comite->imagen->url) ? Storage::url($comite->imagen->url) : 'https://i.ibb.co/YcvYfpx/640x480.png' }}"
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
    <!-- end section -->


    <!-- start section photo -->
    <section class="overflow-hidden position-relative overlap-height">
        <div class="container overlap-gap-section">

            <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2"
                data-anime='{ "el": "childs", "translateY": [0, 0], "perspective": [800,800], "scale": [1.1, 1], "rotateX": [30, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <!-- start team member item -->
                <div class="col text-center team-style-05 mb-45px">
                    <div class="position-relative mb-30px last-paragraph-no-margin border-radius-4px overflow-hidden">
                        <img src="https://via.placeholder.com/600x756" alt="" />
                        <div
                            class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-35px lg-p-20px team-content bg-gradient-dark-transparent">

                        </div>
                    </div>
                    <div class="fw-600 text-dark-gray lh-22 fs-18 ls-minus-05px">Jessica dover</div>
                    <span class="fs-16">Director</span>
                </div>
                <!-- end team member item -->
                <!-- start team member item -->
                <div class="col text-center team-style-05 mb-45px">
                    <div class="position-relative mb-30px last-paragraph-no-margin border-radius-4px overflow-hidden">
                        <img src="https://via.placeholder.com/600x756" alt="" />
                        <div
                            class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-35px lg-p-20px team-content bg-gradient-dark-transparent">

                        </div>
                    </div>
                    <div class="fw-600 text-dark-gray lh-22 fs-18 ls-minus-05px">Jeremy dupont</div>
                    <span class="fs-16">Researcher</span>
                </div>
                <!-- end team member item -->
                <!-- start team member item -->
                <div class="col text-center team-style-05 mb-45px">
                    <div class="position-relative mb-30px last-paragraph-no-margin border-radius-4px overflow-hidden">
                        <img src="https://via.placeholder.com/600x756" alt="" />
                        <div
                            class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-35px lg-p-20px team-content bg-gradient-dark-transparent">

                        </div>
                    </div>
                    <div class="fw-600 text-dark-gray lh-22 fs-18 ls-minus-05px">Johncy parker</div>
                    <span class="fs-16">English teacher</span>
                </div>
                <!-- end team member item -->
                <!-- start team member item -->
                <div class="col text-center team-style-05 md-mb-45px">
                    <div class="position-relative mb-30px last-paragraph-no-margin border-radius-4px overflow-hidden">
                        <img src="https://via.placeholder.com/600x756" alt="" />
                        <div
                            class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-35px lg-p-20px team-content bg-gradient-dark-transparent">

                        </div>
                    </div>
                    <div class="fw-600 text-dark-gray lh-22 fs-18 ls-minus-05px">Matthew taylor</div>
                    <span class="fs-16">Design teacher</span>
                </div>
                <!-- end team member item -->


            </div>
        </div>
    </section>
    <!-- end section photo -->

    <!-- start section show serie -->
    <section class="background-repeat overflow-hidden"
        style="background-image:url('{{ asset('images/demo-spa-salon-home-bg-01.jpg') }}');">
        <div class="container">
            <div class="row justify-content-center align-items-center mb-4 text-center text-md-start">
                <div class="col-xxl-8 col-md-7 sm-mb-10px">
                    <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Últimas series</h2>
                </div>
                <div class="col-xxl-4 col-md-5 text-center text-md-end"
                    data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <a href"#" class="btn btn-link btn-hover-animation-switch btn-extra-large text-dark-gray fw-600">
                        <span>
                            <span class="btn-text">Explora todas las series</span>
                            <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                            <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 position-relative">
                    <div class="outside-box-right-20 sm-outside-box-left-0 sm-outside-box-right-0"
                        data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <div class="swiper magic-cursor"
                            data-slider-options='{ "slidesPerView": 1, "spaceBetween": 30, "loop": true, "autoplay": { "delay": 4000, "disableOnInteraction": false },  "pagination": { "el": ".slider-four-slide-pagination", "clickable": true, "dynamicBullets": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "1400": { "slidesPerView": 4 }, "992": { "slidesPerView": 3 }, "768": { "slidesPerView": 2 }, "320": { "slidesPerView": 1 } }, "effect": "slide" }'>
                            <div class="swiper-wrapper pt-20px pb-20px">
                                <!-- start slider item -->
                                @foreach ($series as $serie)
                                    <div class="swiper-slide">
                                        <div
                                            class="box-shadow-extra-large services-box-style-01 hover-box last-paragraph-no-margin border-radius-4px overflow-hidden">
                                            <div class="position-relative box-image">
                                                <img src="{{ !empty($serie->imagen->url) ? Storage::url($serie->imagen->url) : 'https://i.ibb.co/YcvYfpx/640x480.png' }}"
                                                    alt="" />

                                            </div>
                                            <div class="bg-white">
                                                <div class="ps-50px pe-50px pt-35px sm-p-35px sm-pb-0">
                                                    <a href="{{ route('public.series.show', $serie) }}"
                                                        class="d-inline-block fs-19 primary-font fw-600 text-dark-gray mb-5px">{{ $serie->titulo }}</a>
                                                    <p>{{ $serie->descripcion }}</p>
                                                </div>
                                                <div
                                                    class="border-top border-color-extra-medium-gray pt-20px pb-20px ps-50px pe-50px mt-30px sm-ps-35px sm-pe-35px position-relative">
                                                    <a href="{{ route('public.series.show', $serie) }}"
                                                        class="d-flex justify-content-center align-items-center w-55px h-55px lh-55 rounded-circle bg-dark-gray position-absolute right-40px top-minus-30px"><i
                                                            class="bi bi-arrow-right-short text-white icon-very-medium"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- end slider item -->

                            </div>
                        </div>
                    </div>
                    <!-- start slider pagination -->
                    <!--<div class="swiper-pagination slider-four-slide-pagination swiper-pagination-style-2 swiper-pagination-clickable swiper-pagination-bullets"></div>-->
                    <!-- end slider pagination -->
                </div>
            </div>
        </div>
    </section>
    <!-- end section show serie-->

    <!-- start section publicaciones -->
    <section
        class="bg-gradient-tranquil-white overflow-hidden position-relative overlap-height pb-5 md-pb-7 xs-pb-50px">
        <div class="container overlap-gap-section">
            <div class="row justify-content-center align-items-center mb-4 text-center text-md-start">
                <div class="col-xxl-8 col-md-7 sm-mb-10px">
                    <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Últimas publicaciones</h2>
                </div>
                <div class="col-xxl-4 col-md-5 text-center text-md-end"
                    data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <a href"#" class="btn btn-link btn-hover-animation-switch btn-extra-large text-dark-gray fw-600">
                        <span>
                            <span class="btn-text">Explora todas las publicaciones</span>
                            <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                            <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-12">
                        <ul
                            class="blog-grid blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>
                            <!-- start blog item -->
                            @foreach ($publicaciones as $publicacion)
                                <li class="grid-item">
                                    <div
                                        class="card border-0 border-radius-4px box-shadow-extra-large box-shadow-extra-large-hover">
                                        <div class="blog-image">
                                            <a href="{{ route('public.publicaciones.show', $publicacion) }}"
                                                class="d-block">
                                                <img src="{{ !empty($publicacion->imagen->url) ? Storage::url($publicacion->imagen->url) : 'https://i.ibb.co/YcvYfpx/640x480.png' }}"
                                                    alt="" />
                                            </a>
                                            <div class="blog-categories">
                                                <a href="blog-classic.html"
                                                    class="categories-btn bg-white text-dark-gray text-dark-gray-hover text-uppercase alt-font fw-700">{{ $publicacion->comite->nombre }}</a>
                                            </div>
                                        </div>
                                        <div class="card-body p-12">
                                            <a href="{{ route('public.publicaciones.show', $publicacion) }}"
                                                class="card-title mb-15px fw-600 fs-17 lh-26 text-dark-gray text-dark-gray-hover d-inline-block">{{ $publicacion->titulo }}</a>
                                            <p>{{ $publicacion->descripcion }}</p>
                                            <div
                                                class="author d-flex justify-content-center align-items-center position-relative overflow-hidden fs-14 text-uppercase">
                                                <div class="me-auto">
                                                    <span class="blog-date fw-500 d-inline-block">
                                                        {{ $publicacion->created_at }}</span>
                                                    <div class="d-inline-block author-name">By <a
                                                            href="blog-classic.html"
                                                            class="text-dark-gray text-dark-gray-hover text-decoration-line-bottom fw-600">{{ $publicacion->user->name }}</a>
                                                    </div>
                                                </div>
                                                <div class="like-count">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <!-- end blog item -->

                        </ul>
                    </div>


                </div>

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

            
        </div>
    </section>
    <!-- end section publicaciones -->

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
