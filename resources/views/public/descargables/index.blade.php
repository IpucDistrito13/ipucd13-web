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

    <!-- start banner -->
    <section class="top-space-margin page-title-big-typography cover-background"
        style="background-image: url(https://via.placeholder.com/1920x500)">
        <div class="container">
            <div class="row extra-very-small-screen align-items-center">
                <div class="col-lg-5 col-sm-8 position-relative page-title-extra-small"
                    data-anime='{ "el": "childs", "opacity": [0, 1], "translateX": [-30, 0], "duration": 800, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                   
                    <h2 class="text-white text-shadow-medium fw-500 ls-minus-2px mb-0">Descargables</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner -->
    <br>

    <!-- start section seccion 1-->
    <section class="py-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6 md-mb-50px"
                    data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <span class="fs-15 text-uppercase text-base-color fw-600 mb-15px d-block ls-1px">BIBLIA - CANCIONES
                        - ANUNCIOS</span>
                    <h3 class="fw-700 text-dark-gray ls-minus-1px">PROGRAMAS PARA PROYECTAR.</h3>
                    <div class="row row-cols-1 mt-40px">
                        <!-- start process step item -->
                        <div class="col-12 process-step-style-05 position-relative hover-box">
                            <div class="process-step-item d-flex">
                                <div class="process-step-icon-wrap position-relative">
                                    <div
                                        class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px bg-light-red-grey fs-14 fw-600 position-relative">
                                        <span class="number position-relative z-index-1 text-dark-gray">01</span>
                                        <div class="box-overlay bg-base-color rounded-circle"></div>
                                    </div>
                                    <span class="progress-step-separator bg-extra-medium-gray"></span>
                                </div>
                                <div class="process-content ps-30px last-paragraph-no-margin mb-40px">
                                    <span
                                        class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px">PROYEKTOR</span>
                                    <p class="w-85 lg-w-100">Lorem ipsum simply dummy printing typesetting industry's
                                        standard.</p>
                                    <br>
                                    <a href="https://proyektor.labiblia.in/"
                                        class="btn btn-color btn-very-small btn-dark-gray btn-hover-animation-switch btn-round-edge btn-box-shadow me-30px sm-me-20px">
                                        <span>
                                            <span class="btn-text">Descargar</span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- end process step item -->
                        <!-- start process step item -->
                        <div class="col-12 process-step-style-05 position-relative hover-box">
                            <div class="process-step-item d-flex">
                                <div class="process-step-icon-wrap position-relative">
                                    <div
                                        class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px bg-light-red-grey fs-14 fw-600 fw-600 position-relative">
                                        <span class="number position-relative z-index-1 text-dark-gray">02</span>
                                        <div class="box-overlay bg-base-color rounded-circle"></div>
                                    </div>
                                </div>
                                <div class="process-content ps-30px last-paragraph-no-margin mb-40px">
                                    <span
                                        class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px">HOLYRICS</span>
                                    <p class="w-85 lg-w-100">Lorem ipsum simply dummy printing typesetting industry's
                                        standard.</p>
                                    <a href="https://drive.google.com/drive/folders/1RGKT-4g2M7CJqGY1gJQgLNTOu_O9JXxI"
                                        class="btn btn-color btn-very-small btn-dark-gray btn-hover-animation-switch btn-round-edge btn-box-shadow me-30px sm-me-20px">
                                        <span>
                                            <span class="btn-text">Descargar</span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                        </span>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!-- end process step item -->

                        <!-- start process step item -->
                        <div class="col-12 process-step-style-05 position-relative hover-box">
                            <div class="process-step-item d-flex">
                                <div class="process-step-icon-wrap position-relative">
                                    <div
                                        class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px bg-light-red-grey fs-14 fw-600 fw-600 position-relative">
                                        <span class="number position-relative z-index-1 text-dark-gray">03</span>
                                        <div class="box-overlay bg-base-color rounded-circle"></div>
                                    </div>
                                </div>
                                <div class="process-content ps-30px last-paragraph-no-margin mb-40px">
                                    <span
                                        class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px">VIDEOPSALM</span>
                                    <p class="w-85 lg-w-100">Lorem ipsum simply dummy printing typesetting industry's
                                        standard.</p>
                                    <a href="https://drive.google.com/drive/folders/1eYMPg5WW1Dgl7lFj4g2YVJw2sWQA1lj8"
                                        class="btn btn-color btn-very-small btn-dark-gray btn-hover-animation-switch btn-round-edge btn-box-shadow me-30px sm-me-20px">
                                        <span>
                                            <span class="btn-text">Descargar</span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                        </span>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!-- end process step item -->
                        <!-- start process step item -->
                        <div class="col-12 process-step-style-05 position-relative hover-box">
                            <div class="process-step-item d-flex">
                                <div class="process-step-icon-wrap position-relative">
                                    <div
                                        class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px bg-light-red-grey fs-14 fw-600 fw-600 position-relative">
                                        <span class="number position-relative z-index-1 text-dark-gray">04</span>
                                        <div class="box-overlay bg-base-color rounded-circle"></div>
                                    </div>
                                </div>
                                <div class="process-content ps-30px last-paragraph-no-margin mb-40px">
                                    <span
                                        class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px">EASYWORSHIP</span>
                                    <p class="w-85 lg-w-100">Lorem ipsum simply dummy printing typesetting industry's
                                        standard.</p>
                                    <a href="https://drive.google.com/drive/folders/1vr9KHKkFXahXuX3KmEBZT30jup53cTYA"
                                        class="btn btn-color btn-very-small btn-dark-gray btn-hover-animation-switch btn-round-edge btn-box-shadow me-30px sm-me-20px">
                                        <span>
                                            <span class="btn-text">Descargar</span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                        </span>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!-- end process step item -->

                    </div>



                </div>
                <div class="col-lg-6 col-md-11 position-relative offset-xl-1">
                    <figure class="position-relative m-0 text-center"
                        data-anime='{ "effect": "slide", "color": "#fff2ef", "direction":"rl", "easing": "easeOutQuad", "delay":50}'>
                        <img src="https://via.placeholder.com/525x741" alt="">
                    </figure>
                </div>
            </div>
            <div class="row justify-content-center mt-6"
                data-anime='{ "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <div class="col-auto text-center">
                    <div class="icon-with-text-style-06">
                        <div class="feature-box feature-box-left-icon-middle">
                            <div class="feature-box-icon me-10px">
                                <i class="bi bi-patch-check icon-very-medium text-base-color"></i>
                            </div>
                            <div class="feature-box-content last-paragraph-no-margin">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
    </section>
    <!-- end section seccion 1 -->

    <br>

    <!-- start section seccion 2 -->
    <section class="py-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6 md-mb-50px"
                    data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <span class="fs-15 text-uppercase text-base-color fw-600 mb-15px d-block ls-1px">BIBLIA - CANCIONES
                        - ANUNCIOS</span>
                    <h3 class="fw-700 text-dark-gray ls-minus-1px">PROGRAMAS PARA PROYECTAR.</h3>
                    <div class="row row-cols-1 mt-40px">
                        <!-- start process step item -->
                        <div class="col-12 process-step-style-05 position-relative hover-box">
                            <div class="process-step-item d-flex">
                                <div class="process-step-icon-wrap position-relative">
                                    <div
                                        class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px bg-light-red-grey fs-14 fw-600 position-relative">
                                        <span class="number position-relative z-index-1 text-dark-gray">01</span>
                                        <div class="box-overlay bg-base-color rounded-circle"></div>
                                    </div>
                                    <span class="progress-step-separator bg-extra-medium-gray"></span>
                                </div>
                                <div class="process-content ps-30px last-paragraph-no-margin mb-40px">
                                    <span
                                        class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px">PROYEKTOR</span>
                                    <p class="w-85 lg-w-100">Lorem ipsum simply dummy printing typesetting industry's
                                        standard.</p>
                                    <br>
                                    <a href="https://proyektor.labiblia.in/"
                                        class="btn btn-color btn-very-small btn-dark-gray btn-hover-animation-switch btn-round-edge btn-box-shadow me-30px sm-me-20px">
                                        <span>
                                            <span class="btn-text">Descargar</span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- end process step item -->
                        <!-- start process step item -->
                        <div class="col-12 process-step-style-05 position-relative hover-box">
                            <div class="process-step-item d-flex">
                                <div class="process-step-icon-wrap position-relative">
                                    <div
                                        class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px bg-light-red-grey fs-14 fw-600 fw-600 position-relative">
                                        <span class="number position-relative z-index-1 text-dark-gray">02</span>
                                        <div class="box-overlay bg-base-color rounded-circle"></div>
                                    </div>
                                </div>
                                <div class="process-content ps-30px last-paragraph-no-margin mb-40px">
                                    <span
                                        class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px">HOLYRICS</span>
                                    <p class="w-85 lg-w-100">Lorem ipsum simply dummy printing typesetting industry's
                                        standard.</p>
                                    <a href="https://drive.google.com/drive/folders/1RGKT-4g2M7CJqGY1gJQgLNTOu_O9JXxI"
                                        class="btn btn-color btn-very-small btn-dark-gray btn-hover-animation-switch btn-round-edge btn-box-shadow me-30px sm-me-20px">
                                        <span>
                                            <span class="btn-text">Descargar</span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                        </span>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!-- end process step item -->

                        <!-- start process step item -->
                        <div class="col-12 process-step-style-05 position-relative hover-box">
                            <div class="process-step-item d-flex">
                                <div class="process-step-icon-wrap position-relative">
                                    <div
                                        class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px bg-light-red-grey fs-14 fw-600 fw-600 position-relative">
                                        <span class="number position-relative z-index-1 text-dark-gray">03</span>
                                        <div class="box-overlay bg-base-color rounded-circle"></div>
                                    </div>
                                </div>
                                <div class="process-content ps-30px last-paragraph-no-margin mb-40px">
                                    <span
                                        class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px">VIDEOPSALM</span>
                                    <p class="w-85 lg-w-100">Lorem ipsum simply dummy printing typesetting industry's
                                        standard.</p>
                                    <a href="https://drive.google.com/drive/folders/1eYMPg5WW1Dgl7lFj4g2YVJw2sWQA1lj8"
                                        class="btn btn-color btn-very-small btn-dark-gray btn-hover-animation-switch btn-round-edge btn-box-shadow me-30px sm-me-20px">
                                        <span>
                                            <span class="btn-text">Descargar</span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                        </span>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!-- end process step item -->
                        <!-- start process step item -->
                        <div class="col-12 process-step-style-05 position-relative hover-box">
                            <div class="process-step-item d-flex">
                                <div class="process-step-icon-wrap position-relative">
                                    <div
                                        class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px bg-light-red-grey fs-14 fw-600 fw-600 position-relative">
                                        <span class="number position-relative z-index-1 text-dark-gray">04</span>
                                        <div class="box-overlay bg-base-color rounded-circle"></div>
                                    </div>
                                </div>
                                <div class="process-content ps-30px last-paragraph-no-margin mb-40px">
                                    <span
                                        class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px">EASYWORSHIP</span>
                                    <p class="w-85 lg-w-100">Lorem ipsum simply dummy printing typesetting industry's
                                        standard.</p>
                                    <a href="https://drive.google.com/drive/folders/1vr9KHKkFXahXuX3KmEBZT30jup53cTYA"
                                        class="btn btn-color btn-very-small btn-dark-gray btn-hover-animation-switch btn-round-edge btn-box-shadow me-30px sm-me-20px">
                                        <span>
                                            <span class="btn-text">Descargar</span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i
                                                    class="feather icon-feather-arrow-right"></i></span>
                                        </span>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!-- end process step item -->

                    </div>



                </div>
                <div class="col-lg-6 col-md-11 position-relative offset-xl-1">
                    <figure class="position-relative m-0 text-center"
                        data-anime='{ "effect": "slide", "color": "#fff2ef", "direction":"rl", "easing": "easeOutQuad", "delay":50}'>
                        <img src="https://via.placeholder.com/525x741" alt="">
                    </figure>
                </div>
            </div>
            <div class="row justify-content-center mt-6"
                data-anime='{ "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <div class="col-auto text-center">
                    <div class="icon-with-text-style-06">
                        <div class="feature-box feature-box-left-icon-middle">
                            <div class="feature-box-icon me-10px">
                                <i class="bi bi-patch-check icon-very-medium text-base-color"></i>
                            </div>
                            <div class="feature-box-content last-paragraph-no-margin">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
    </section>
    <!-- end section seccion 2 -->

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
                        <div class="pricing-table text-center pt-7 pb-7 bg-white box-shadow-quadruple-large border-radius-6px">
                            <div class="pricing-header ps-2 pe-2">
                                <h2 class="text-dark-gray fw-400 mb-3">{{ $comite->nombre }}</h2>
                                <p class="mb-3 lh-1.8">{{ $comite->descripcion }}</p>
                                <a href="{{ route('public.descargables.comite', $comite->id) }}" class="btn btn-medium btn-dark-gray btn-round-edge btn-switch-text btn-box-shadow">
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
    <!-- end section 3-->


    <br>


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
