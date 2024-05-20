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
    <link rel="stylesheet" href="{{ asset('demos/accounting/accounting.css') }}" />

</head>

<body data-mobile-nav-style="classic" class="custom-cursor">
    <!-- start cursor -->
    <div class="cursor-page-inner">
        <div class="circle-cursor circle-cursor-inner"></div>
        <div class="circle-cursor circle-cursor-outer"></div>
    </div>
    <!-- end cursor -->
    <!-- start header -->
    @include('public.layouts.menu')
    <!-- end header -->
    <!-- start page title -->
    <section class="top-space-margin page-title-big-typography cover-background"
        style="background-image: url(https://via.placeholder.com/1920x500)">
        <div class="container">
            <div class="row extra-very-small-screen align-items-center">
                <div class="col-lg-5 col-sm-8 position-relative page-title-extra-small"
                    data-anime='{ "el": "childs", "opacity": [0, 1], "translateX": [-30, 0], "duration": 800, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h1 class="mb-20px xs-mb-20px text-white text-shadow-medium"><span
                            class="w-30px h-2px bg-yellow d-inline-block align-middle position-relative top-minus-2px me-10px"></span>#
                    </h1>
                    <h2 class="text-white text-shadow-medium fw-500 ls-minus-2px mb-0">Descargables</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
    <br>

    <!-- start section -->
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
                        <figcaption class="position-absolute bottom-90px right-0px"
                            data-anime='{ "translateY": [-50, 0], "opacity": [0,1], "duration": 800, "delay": 1000, "staggervalue": 300, "easing": "easeOutQuad" }'>
                            <img src="https://via.placeholder.com/235x244"
                                class="animation-float box-shadow-quadruple-large border-radius-6px" alt="">
                        </figcaption>
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
    <!-- end section -->




    <!-- start section -->
    <section class="py-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6 md-mb-50px"
                    data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <span class="fs-15 text-uppercase text-base-color fw-600 mb-15px d-block ls-1px">DISEÑO -
                        VIDEO</span>
                    <h3 class="fw-700 text-dark-gray ls-minus-1px">PROGRAMAS PARA DISEÑAR.</h3>
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
                                    <span class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px">CANVA</span>
                                    <p class="w-85 lg-w-100">Lorem ipsum simply dummy printing typesetting industry's
                                        standard.</p>
                                    <a href="https://www.canva.com/es_es/"
                                        class="btn btn-color btn-very-small btn-dark-gray btn-hover-animation-switch btn-round-edge btn-box-shadow me-30px sm-me-20px">
                                        <span>
                                            <span class="btn-text">Acceder</span>
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
                                    <span class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px">PIXLR</span>
                                    <p class="w-85 lg-w-100">Lorem ipsum simply dummy printing typesetting industry's
                                        standard.</p>
                                    <a href="https://pixlr.com/es/express/"
                                        class="btn btn-color btn-very-small btn-dark-gray btn-hover-animation-switch btn-round-edge btn-box-shadow me-30px sm-me-20px">
                                        <span>
                                            <span class="btn-text">Acceder</span>
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
                                        class="d-block fw-600 text-dark-gray mb-5px fs-18 ls-minus-05px">CAPCUT</span>
                                    <p class="w-85 lg-w-100">Lorem ipsum simply dummy printing typesetting industry's
                                        standard.</p>
                                    <a href="https://www.capcut.com/es-es/"
                                        class="btn btn-color btn-very-small btn-dark-gray btn-hover-animation-switch btn-round-edge btn-box-shadow me-30px sm-me-20px">
                                        <span>
                                            <span class="btn-text">Acceder</span>
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
                        <figcaption class="position-absolute bottom-90px right-0px"
                            data-anime='{ "translateY": [-50, 0], "opacity": [0,1], "duration": 800, "delay": 1000, "staggervalue": 300, "easing": "easeOutQuad" }'>
                            <img src="https://via.placeholder.com/235x244"
                                class="animation-float box-shadow-quadruple-large border-radius-6px" alt="">
                        </figcaption>
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
    <!-- end section -->

    <br>



    <!-- start footer -->
    <footer class="footer-dark bg-dark-gray pt-0 pb-2 lg-pb-35px">
        <div
            class="footer-top pt-50px pb-50px sm-pt-35px sm-pb-35px border-bottom border-1 border-color-transparent-white-light">
            <div class="container">

            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center fs-17 fw-300 mt-5 mb-4 md-mt-45px md-mb-45px xs-mt-35px xs-mb-35px">
                <!-- start footer column -->
                <div class="col-6 col-lg-3 order-sm-1 md-mb-40px xs-mb-30px last-paragraph-no-margin">
                    <a href="demo-accounting.html" class="footer-logo mb-15px d-inline-block"><img
                            src="images/demo-accounting-logo-white.png"
                            data-at2x="images/demo-accounting-logo-white@2x.png" alt=""></a>
                    <p class="w-85 xl-w-95 sm-w-100">Lorem ipsum amet adipiscing elit to eiusmod ad tempor.</p>
                    <div class="elements-social social-icon-style-02 mt-20px lg-mt-20px">
                        <ul class="small-icon light">
                            <li><a class="facebook" href="https://www.facebook.com/" target="_blank"><i
                                        class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a class="dribbble" href="http://www.dribbble.com" target="_blank"><i
                                        class="fa-brands fa-dribbble"></i></a></li>
                            <li><a class="twitter" href="http://www.twitter.com" target="_blank"><i
                                        class="fa-brands fa-twitter"></i></a></li>
                            <li><a class="instagram" href="http://www.instagram.com" target="_blank"><i
                                        class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- end footer column -->
                <!-- start footer column -->
                <div class="col-6 col-lg-2 col-sm-4 xs-mb-30px order-sm-3 order-lg-2">
                    <span class="fs-18 fw-400 d-block text-white mb-5px">About</span>
                    <ul>
                        <li><a href="demo-accounting-company.html">Company</a></li>
                        <li><a href="demo-accounting-services.html">Services</a></li>
                        <li><a href="demo-accounting-process.html">Process</a></li>
                        <li><a href="demo-accounting-contact.html">Contact</a></li>
                    </ul>
                </div>
                <!-- end footer column -->
                <!-- start footer column -->
                <div class="col-6 col-lg-2 col-sm-4 xs-mb-30px order-sm-4 order-lg-3">
                    <span class="fs-18 fw-400 d-block text-white mb-5px">Services</span>
                    <ul>
                        <li><a href="demo-accounting-services.html">Financial</a></li>
                        <li><a href="demo-accounting-services.html">Investment</a></li>
                        <li><a href="demo-accounting-services.html">Banking</a></li>
                        <li><a href="demo-accounting-services.html">Consulting</a></li>
                    </ul>
                </div>
                <!-- end footer column -->
                <!-- start footer column -->
                <div class="col-6 col-lg-2 col-sm-4 xs-mb-30px order-sm-5 order-lg-4">
                    <span class="fs-18 fw-400 d-block text-white mb-5px">Get in touch</span>
                    <p class="mb-5px">Need support?</p>
                    <a href="mailto:hi@domain.com" class="text-white lh-16 d-block mb-15px">hi@domain.com</a>
                    <p class="mb-5px">Customer care?</p>
                    <a href="tel:12345678910" class="text-white lh-16 d-block">+1 234 567 8910</a>
                </div>
                <!-- end footer column -->
                <!-- start footer column -->
                <div class="col-lg-3 col-sm-6 md-mb-40px xs-mb-0 order-sm-2 order-lg-5">
                    <span class="fs-18 fw-400 d-block text-white mb-5px">Subscribe to newsletter</span>
                    <p class="mb-20px">Enter your email and we contact you!</p>
                    <div class="d-inline-block w-100 newsletter-style-02 position-relative">
                        <form action="email-templates/subscribe-newsletter.php" method="post"
                            class="position-relative">
                            <input
                                class="border-color-transparent-white-light bg-transparent border-radius-4px w-100 form-control lg-ps-15px required fs-16"
                                type="email" name="email" placeholder="Enter your email" />
                            <input type="hidden" name="redirect" value="">
                            <button class="btn pe-20px submit" aria-label="submit"><i
                                    class="bi bi-envelope icon-small text-white"></i></button>
                            <div
                                class="form-results border-radius-4px pt-5px pb-5px ps-15px pe-15px fs-14 lh-22 mt-10px w-100 text-center position-absolute d-none">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end footer column -->
            </div>
            <div class="row align-items-center fs-16 fw-300">
                <!-- start copyright -->
                <div class="col-md-4 last-paragraph-no-margin order-2 order-md-1 text-center text-md-start">
                    <p>&COPY; Copyright 2024 <a href="#" target="_blank"
                            class="text-decoration-line-bottom text-white">Iglesia Pentecostal Unida de Colombia</a>
                    </p>
                </div>
                <!-- end copyright -->
                <!-- start footer menu -->
                <div class="col-md-8 text-md-end order-1 order-md-2 text-center text-md-end sm-mb-10px">
                    <ul class="footer-navbar sm-lh-normal">
                        <li><a href="#" class="nav-link">Privacy policy</a></li>
                        <li><a href="#" class="nav-link">Terms and conditions</a></li>
                        <li><a href="#" class="nav-link">Copyright</a></li>
                    </ul>
                </div>
                <!-- end footer menu -->
            </div>
        </div>
    </footer>
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
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/vendors.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>

</html>
