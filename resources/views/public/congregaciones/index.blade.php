<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>{{ $metaData['title'] }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="author" content="{{ $metaData['autor'] }}">
    <meta name="description" content="{{ $metaData['description'] }}">
    <meta name="robots" content="noindex">

    <!-- favicon icon -->
    @include('public.layouts.iconos')

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

    <br>
    <!-- start page title -->
    <section class="ipad-top-space-margin md-pt-0">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-xl-6 col-lg-8 text-center position-relative page-title-double-large">
                    <div class="d-flex flex-column justify-content-center extra-very-small-screen">
                        <h1 class="text-dark-gray alt-font ls-minus-1px fw-700 mb-20px">Congregaciones</h1>
                        <h2 class="text-dark-gray d-inline-block fw-400 ls-0px mb-0">Lista de congregaciones IPUC Distrito 13</h2>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
    <!-- start section -->
        <section>
            <div class="container">
                
                <div class="row">
                    <div class="col-12"
                        data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 200, "easing": "easeOutQuad" }'>
                        @php
                            $counter = 1;
                        @endphp
    
                        @foreach ($congregaciones as $congregacion)
                            <div
                                class="row border-top border-color-dark-gray position-relative g-0 sm-border-top-0 sm-pb-30px">
                                <div class="col-12 col-md-1 text-md-center align-self-center">
                                    <span class="text-dark-gray fs-14 fw-600">{{ $counter }}</span>
                                </div>
                                <div
                                    class="col-lg-8 col-md-7 last-paragraph-no-margin ps-30px pe-30px pt-25px pb-25px sm-pt-15px sm-pb-15px border-start border-color-dark-gray sm-border-start-0 sm-px-0">
                                    <p class="sm-w-85">{{ $congregacion->municipio->departamento->nombre }} -
                                        {{ $congregacion->municipio->nombre }}</p>
                                    <p class="sm-w-85">{{ $congregacion->nombre }}<span class="fw-600 text-dark-gray"> -
                                            {{ $congregacion->direccion }}</span></p>
                                </div>
                                <div class="col-lg-2 col-md-3 align-self-center text-md-end">
                                    @if (!empty($congregacion->urlfacebook))
                                        <a href="{{ $congregacion->urlfacebook }}" target="_blank">Página Facebook</a><br>
                                    @endif
                                    @if (!empty($congregacion->googlemaps ))
                                        <a href="{{ $congregacion->googlemaps }}" target="_blank">Ver en mapa</a><br>
                                    @endif
                                </div>
                                <div
                                    class="col-auto col-md-1 align-self-center text-end text-md-center sm-position-absolute right-5px">
                                    <a href="#"><i class="bi bi-arrow-right-short text-dark-gray icon-medium"></i></a>
                                </div>
                            </div>
    
                            @php
                                $counter++;
                            @endphp
                        @endforeach
    
    
    
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->

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
