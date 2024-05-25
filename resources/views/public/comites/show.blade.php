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

    <style>
        .podcast-row:hover {
    box-shadow: 0 0 10px #00338d; /* Color: #00338d */
}


    </style>

</head>

<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#313e3b">

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
            
        </div>
    </section>
    
        @endif
        <!-- end section publicaciones -->

    <!-- start section show serie -->
    @if ($series->isNotEmpty())
    <section class="background-repeat overflow-hidden"
    style="background-image:url('{{ asset('img/bg-azul.png') }}');">
    <div class="container">
        <div class="row justify-content-center align-items-center mb-4 text-center text-md-start">
            <div class="col-xxl-8 col-md-7 sm-mb-10px">
                <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Últimos videos</h2>
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
                         <div class="swiper-pagination slider-four-slide-pagination swiper-pagination-style-2 swiper-pagination-clickable swiper-pagination-bullets"></div>

                <!--<div class="swiper-pagination slider-four-slide-pagination swiper-pagination-style-2 swiper-pagination-clickable swiper-pagination-bullets"></div>-->
                <!-- end slider pagination -->
            </div>
        </div>
    </div>
</section>
    @endif
    <!-- end section show serie-->


    @if (!$podcasts->isEmpty())
    <section class="pt-2">
        <div class="container">
            <div class="row justify-content-center align-items-center mb-4 text-center text-md-start">
                <div class="col-xxl-8 col-md-7 sm-mb-10px">
                    <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Últimos podcasts</h2>
                </div>
                <div class="col-xxl-4 col-md-5 text-center text-md-end"
                    data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <a href="#" class="btn btn-link btn-hover-animation-switch btn-extra-large text-dark-gray fw-600">
                        <span>
                            <span class="btn-text">Explora todos los podcasts</span>
                            <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                            <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
    
            <div class="row">
                <div class="col-12" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
    
                    @foreach ($podcasts as $serie)
                    <a href="{{ route('public.podcasts.episodios', $serie) }}" class="row border-top border-color-dark-gray position-relative g-0 sm-border-top-0 sm-pb-30px podcast-row">
                        
                        <div class="col-lg-8 col-md-7 last-paragraph-no-margin ps-30px pe-30px pe-30px pt-25px pb-25px sm-pt-15px sm-pb-15px border-start border-color-dark-gray sm-border-start-0 sm-px-0"> 
                            <p class="sm-w-85"><span class="fw-600 text-dark-gray">{{ $serie->titulo }}</span></p>
                        </div>
                        <div class="col-lg-2 col-md-3 align-self-center text-md-end">
                            <span>{{ $serie->created_at }}</span>
                        </div>
                        <div class="col-auto col-md-1 align-self-center text-end text-md-center sm-position-absolute right-5px">
                            <i class="bi bi-arrow-right-short text-dark-gray icon-medium"></i>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

{{-- start section
<section class="big-section bg-dark-gray">
    <div class="container">
        <div class="row justify-content-center mb-2">
            <div class="col-xxl-5 col-xl-6 col-lg-8 col-md-10 text-center">
                <h3 class="fw-600 text-white ls-minus-1px md-ls-0px">Últimos podcasts</h3>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12 position-relative swiper-light-pagination">
                <div class="swiper" data-slider-options='{ "slidesPerView": 1, "spaceBetween": 30, "loop": true, "autoplay": { "delay": 1600, "disableOnInteraction": false }, "pagination": { "el": ".swiper-pagination-bullets-03", "clickable": true, "dynamicBullets": false }, "navigation": { "nextEl": ".slider-one-slide-next-02", "prevEl": ".slider-one-slide-prev-02" }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "992": { "slidesPerView": 3 }, "768": { "slidesPerView": 3 }, "480": { "slidesPerView": 2 }, "320": { "slidesPerView": 1 } }, "effect": "slide" }'>
                    <div class="swiper-wrapper align-items-center">

                        @foreach ($podcasts as $serie)
                        <div class="swiper-slide">
                            <a href="link-to-podcast1.html">
                                <img class="w-100" src="https://via.placeholder.com/420x500" alt="Podcast 1" />
                                <h4 class="text-center text-white mt-2 fs-5">{{ $serie->titulo }}</h4>
                            </a>
                        </div>
                        @endforeach
                        
                      
                        
                    </div>
                </div>
                <div class="slider-one-slide-prev-02 bg-transparent border border-2 border-color-transparent-white-very-light h-50px w-50px swiper-button-prev slider-navigation-style-03"><i class="fa-solid fa-arrow-left text-white"></i></div>
                <div class="slider-one-slide-next-02 bg-transparent border border-2 border-color-transparent-white-very-light h-50px w-50px swiper-button-next slider-navigation-style-03"><i class="fa-solid fa-arrow-right text-white"></i></div>
                <div class="swiper-pagination swiper-pagination-bullets-03 swiper-pagination-style-01 swiper-pagination-clickable swiper-pagination-bullets position-static mt-40px sm-mt-25px"></div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="todos-los-podcasts.html" class="btn btn-large btn-light text-uppercase">Explorar todos los podcasts</a>
            </div>
        </div>

    </div>
</section>
--}}
<!-- end section -->



    

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
