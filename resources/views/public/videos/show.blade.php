<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Crafto - The Multipurpose HTML5 Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="ThemeZaa">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description"
        content="Elevate your online presence with Crafto - a modern, versatile, multipurpose Bootstrap 5 responsive HTML5, SCSS template using highly creative 48+ ready demos.">
    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/apple-touch-icon-114x114.png') }}">
        <!-- google fonts preconnect -->
        <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- style sheets and font icons -->
        <link rel="stylesheet" href="{{ asset('css/vendors.min.css')}} "/>
        <link rel="stylesheet" href="{{ asset('css/icon.min.css')}}"/>
        <link rel="stylesheet" href="{{ asset('css/style.css')}}"/>
        <link rel="stylesheet" href="{{ asset('css/responsive.css')}}"/>
        <link rel="stylesheet" href="{{ asset('demos/elearning/elearning.css')}}" />
</head>

<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#313e3b">

    @include('public.layouts.menu')
    <!-- start page title -->
    <section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography"
        style="background-image: url(https://via.placeholder.com/1920x540)">
        <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0"
            style="background-image: url('images/vertical-line-bg-small.svg')"></div>
        <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true"
            data-particle-options='{"particles": {"number": {"value": 8,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'>
        </div>
        <div class="container">
            <div class="row align-items-center extra-small-screen">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small"
                    data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h1 class="mb-20px alt-font text-yellow">Serie</h1>
                    <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">{{ $serie->titulo }}</h2>
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
                    <img src="https://via.placeholder.com/600x505" alt="" class="w-100 border-radius-6px">
                </div>
                <div class="col-12 col-lg-5 col-md-6 offset-lg-1 dropcap-style-01 last-paragraph-no-margin">
                    <p><span class="first-letter text-dark-gray fw-700">{{ strtoupper(substr($serie->contenido, 0, 1)) }}</span>{{ substr($serie->contenido, 1) }}</p>
                </div>
            </div>
            <!-- end dropcaps item -->
        </div>
    </section>
    <!-- end section -->

    <!-- start section movies -->
    <section class="bg-gradient-very-light-gray ps-6 pe-6 lg-ps-2 lg-pe-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center mb-2">
                    <h3 class="alt-font fw-700 text-dark-gray ls-minus-1px">Videos</h3>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-3 row-cols-sm-2">
                @foreach ($videos as $video)
                    <div class="col text-center fit-videos md-mb-50px sm-mb-30px">
                        <iframe width="560" height="315"
                        src="https://www.youtube.com/embed/{{ $video->url }}?autoplay=0;&mute=0;rel=0&amp;showinfo=0"
                        allowfullscreen></iframe>
                        <div class="text-dark-gray fs-18 fw-600 mt-6">{{ $video->titulo }}</div>
                    </div>                    
                @endforeach
               
            </div>
        </div>
    </section>
    <!-- end section movies -->



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
