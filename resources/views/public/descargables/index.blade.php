<!doctype html>
<html class="no-js" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>{{ $metaData['titulo'] }}</title>
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

    <!-- start header -->
    @include('public.layouts.menu')
    <!-- end header -->

<!-- start banner -->
<section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography banner-section"
    style="background-image: url('https://ipucd13.nyc3.cdn.digitaloceanspaces.com/public/banners_internos/descargables.webp');" >
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

    <!-- start section  3 -->
    <section class="bg-very-light-gray">
        <div class="container">
            <div class="row justify-content-center mb-2">
                <div class="col-md-10 text-center">
                    <span class="text-base-color fw-600 text-uppercase">Descargables</span>
                    <h2 class="fw-700 mb-15px alt-font text-dark-gray ls-minus-2px">Comités</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($comites as $comite)
                    <div class="col-lg-6 col-md-6 col-12 mb-6">
                        <!-- start pricing table -->
                        <div
                            class="pricing-table text-center pt-7 pb-7 bg-white box-shadow-quadruple-large border-radius-6px">
                            <div class="pricing-header ps-2 pe-2">
                                <h2 class="text-dark-gray fw-400 mb-3">{{ $comite->nombre }}</h2>
                                <p class="mb-3 lh-1.8">{{ $comite->descripcion }}</p>
                                <a href="{{ route('public.descargables.comite', $comite) }}"
                                    class="btn btn-medium btn-dark-gray btn-round-edge btn-switch-text btn-box-shadow">
                                    <span>
                                        <span class="btn-double-text" data-text="Acceder">Acceder</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <!-- end pricing table -->
                    </div>
                @endforeach

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
                                <a href="{{ $youtube }}" target="_blank"
                                    class="text-decoration-line-bottom-medium text-dark-gray fw-600">Youtube</a>
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
    <!-- end section 3-->


    <br>


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
</body>

</html>
