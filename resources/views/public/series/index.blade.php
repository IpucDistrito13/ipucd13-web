<!doctype html>
<html class="no-js" lang="es">
    
    <head>
        <title>{{ $metaData['title'] }}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="{{ $metaData['author']}}">
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <meta name="description" content="{{ $metaData['description']}}">
        <meta name="robots" content="noindex">
        <!-- favicon icon -->
        @include('public.layouts.iconos')
    </head>
    <body class="bg-very-light-gray" data-mobile-nav-style="classic">
        <!-- start header -->
        @include('public.layouts.menu')
        <!-- end header -->

<!-- start banner -->
<section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography"
style="background-image: url(https://via.placeholder.com/1920x560)">
<div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0"
    style="background-image: url('images/vertical-line-bg-small.svg')"></div>
<div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true"
    data-particle-options='{"particles": {"number": {"value": 8,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'>
</div>
<div class="container">
    <div class="row align-items-center extra-small-screen">
        <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small"
            data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">Series</h2>
        </div>
    </div>
</div>
</section>
<!-- end banner -->

        <!-- start section  ultimas series -->
        <section class="pt-0 ps-15 pe-15 xl-ps-2 xl-pe-2 lg-ps-2 lg-pe-2 sm-mx-0">
            <div class="container-fluid">                
                <div class="row">
                    <div class="col-12">
                        <ul class="blog-classic blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>

                            @foreach ($series as $serie)

                            <!-- start blog item -->
                            <li class="grid-item">
                                <div class="card bg-transparent border-0 h-100">
                                    <div class="blog-image position-relative overflow-hidden border-radius-4px">
                                        <a href="{{ route('public.series.show', $serie) }}">
                                            <img src="{{ !empty($serie->imagen->url) ? Storage::url($serie->imagen->url) : asset('img/imagen_not_found_480x640.png') }}"
                                                    alt="" />
                                        </a>
                                    </div>
                                    <div class="card-body px-0 pt-30px pb-30px">
                                        <span class="fs-13 text-uppercase mb-5px d-block"><a href="{{ route('public.series.show', $serie) }}" class="text-dark-gray text-dark-gray-hover fw-600 categories-text">{{ $serie->comite->nombre }}</a>
                                            <br>
                                            <a href="{{ route('public.series.show', $serie) }}" class="blog-date text-dark-gray-hover">{{ $serie->created_at->format('Y-m-d h:i a') }}</a>
                                        </span>
                                        <a href="{{ route('public.series.show', $serie) }}" class="card-title mb-10px fw-600 fs-17 lh-26 text-dark-gray text-dark-gray-hover d-inline-block w-95">{{ $serie->titulo }}</a>
                                        <p class="mb-10px w-95">{{ $serie->descripcion }}</p>
                                        <a href="{{ route('public.series.show', $serie) }}" class="card-link alt-font fs-12 text-uppercase text-dark-gray text-dark-gray-hover fw-700">Ver más<i class="feather icon-feather-arrow-right icon-very-small"></i></a>
                                    </div>
                                </div>
                            </li>
                            <!-- end blog item -->
                            @endforeach


                        </ul>
                    </div>
                    
                </div>
            </div>
            
            <!-- start pagination -->
            <div class="col-12 mt-4 d-flex justify-content-center">
                <ul class="pagination pagination-style-01 fs-13 fw-500 mb-0">
                    <!-- Previous Page Link -->
                    <li class="page-item {{ $series->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $series->previousPageUrl() }}">
                            <i class="feather icon-feather-arrow-left fs-18 d-xs-none"></i>
                        </a>
                    </li>
            
                    <!-- Pagination Elements -->
                    @foreach ($series->getUrlRange(max(1, $series->currentPage() - 2), min($series->lastPage(), $series->currentPage() + 2)) as $page => $url)
                        <li class="page-item {{ $page == $series->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
            
                    <!-- Next Page Link -->
                    <li class="page-item {{ $series->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $series->nextPageUrl() }}">
                            <i class="feather icon-feather-arrow-right fs-18 d-xs-none"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- end pagination -->


            <!-- seccion redes -->
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
        <!-- end section ultimas series -->




        


        <!-- start footer -->
    @include('public.layouts.footer')
    <!-- end footer -->

        <!-- javascript libraries -->
        <script type="text/javascript" src="{{ asset('js/jquery.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/vendors.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }} "></script>
    </body>
</html>