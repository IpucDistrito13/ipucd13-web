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

    <br><br><br>

    <!-- start section carpetas/archivos -->
    <section class="bg-solitude-blue">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-xl-8 col-lg-10 text-center">
                    <h2 class="text-dark-gray fw-600 ls-minus-1px"
                        data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        Descargable Comite <br> {{ $comite->nombre }}
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
