<!doctype html>
<html class="no-js" lang="es">
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
        <body data-mobile-nav-style="full-screen-menu" data-mobile-nav-bg-color="#00338D"
        class="custom-cursor">
            <!-- start cursor -->
            <div class="cursor-page-inner">
                <div class="circle-cursor circle-cursor-inner"></div>
                <div class="circle-cursor circle-cursor-outer"></div>
            </div>
         <!-- end cursor -->

        @include('public.layouts.menu')

        <!-- start page banner  -->
        <section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography" style="background-image: url(https://via.placeholder.com/1920x540)">
            <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0" style="background-image: url('images/vertical-line-bg-small.svg')"></div>
            <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true" data-particle-options='{"particles": {"number": {"value": 8,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'></div>
            <div class="container">
                <div class="row align-items-center extra-small-screen">
                    <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small" data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">Contacta con nosotros.</h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page banner -->
        
        <!-- start section -->
        <section class="position-relative overflow-hidden">
            <div class="container position-relative">
                <!--
                <div class="row mb-5 align-items-center overflow-hidden">
                    <div class="col-lg-6">
                        <h1 class="alt-font fw-700 text-dark-gray fancy-text-style-4 ls-minus-2px md-mb-20px">Mensaje  
                            <span data-fancy-text='{ "effect": "rotate", "string": ["texto 1", "texto 2", "texto 3"] }'></span>
                        </h1>
                    </div>
                    <div class="col-lg-6 last-paragraph-no-margin" data-anime='{ "el": "childs", "opacity": [0, 1], "translateX": [-50, 0], "staggervalue": 100, "easing": "easeOutQuad" }'>
                    <p>Estamos aquí para ayudar y responder cualquier pregunta que pueda tener. Esperamos con interés escuchar de usted.</p>
                    </div>
                </div>
                -->
                <div class="row">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.0911846878093!2d-72.51413512415537!3d7.8855284058371415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e664582feffd535%3A0x5776304a35f8b058!2sIglesia%20Pentecostal%20Unida%20de%20Colombia%20-%20C%C3%BAcuta%20Central!5e0!3m2!1ses-419!2sco!4v1713067838572!5m2!1ses-419!2sco" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                    </div> 

                </div>
                <div class="position-absolute bottom-130px z-index-minus-1 w-100 left-0px d-none d-lg-block">
                    <div class="row position-relative mt-50px">
                        <div class="col-12">
                            <!-- start marquees -->
                            <div class="marquees-text fs-200 ls-minus-2px alt-font fw-600 text-nowrap opacity-3">We'd love to hear from your side</div>
                            <!-- end marquees -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title -->
        <!-- start section -->
        <section class="overflow-hidden position-relative overlap-height pt-0">
            <div class="container overlap-gap-section" > 
                <div class="row justify-content-center mb-3">
                    <div class="col-12 text-center" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 500, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px">¿Cómo te podemos ayudar?</h2>
                    </div>
                </div> 
                <div class="row row-cols-md-1 justify-content-center mb-10 sm-mb-0">
                    <div class="col-xl-9 col-lg-10">
                        <form action="email-templates/contact-form.php" method="post" class="contact-form-style-03">
                            <div class="row" data-anime='{ "el": "childs", "translateY": [15, 0], "opacity": [0,1], "duration": 500, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="form-label fs-14 text-uppercase text-dark-gray fw-600 mb-0">Nombre*</label>
                                    <div class="position-relative form-group mb-30px">
                                        <span class="form-icon"><i class="bi bi-emoji-smile text-dark-gray"></i></span>
                                        <input class="ps-0 border-radius-0px border-color-extra-medium-gray bg-transparent form-control required" id="exampleInputEmail1" type="text" name="name" placeholder="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="form-label fs-14 text-uppercase text-dark-gray fw-600 mb-0">Su dirección de correo electrónico*</label>
                                    <div class="position-relative form-group mb-30px">
                                        <span class="form-icon"><i class="bi bi-envelope text-dark-gray"></i></span>
                                        <input class="ps-0 border-radius-0px border-color-extra-medium-gray bg-transparent form-control required" id="exampleInputEmail2" type="email" name="email" placeholder="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="form-label fs-14 text-uppercase text-dark-gray fw-600 mb-0">Teléfono*</label>
                                    <div class="position-relative form-group mb-30px">
                                        <span class="form-icon"><i class="bi bi-telephone text-dark-gray"></i></span>
                                        <input class="ps-0 border-radius-0px border-color-extra-medium-gray bg-transparent form-control required" id="exampleInputEmail3" type="tel" name="phone" placeholder="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="form-label fs-14 text-uppercase text-dark-gray fw-600 mb-0">Tu asunto</label>
                                    <div class="position-relative form-group mb-30px">
                                        <span class="form-icon"><i class="bi bi-journals text-dark-gray"></i></span>
                                        <input class="ps-0 border-radius-0px border-color-extra-medium-gray bg-transparent form-control" id="exampleInputEmail4" type="text" name="subject" placeholder="" />
                                    </div>
                                </div>
                                <div class="col-12 mb-35px">
                                    <label for="exampleInputEmail1" class="form-label fs-14 text-uppercase text-dark-gray fw-600 mb-0">Tu mensaje</label>
                                    <div class="position-relative form-group form-textarea mb-0"> 
                                        <textarea class="ps-0 border-radius-0px border-color-extra-medium-gray bg-transparent form-control" name="comment" placeholder="Describe about your message" rows="4"></textarea>
                                        <span class="form-icon"><i class="bi bi-chat-square-dots text-dark-gray"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-8 sm-mb-30px text-center text-md-start">
                                    <p class="mb-0 fs-15 lh-26 w-80 lg-w-100">Estamos comprometidos a proteger su privacidad. Nunca recopilaremos información sobre usted sin su consentimiento explícito.</p>
                                </div>
                                <div class="col-md-4 text-center text-md-end">
                                    <input id="exampleInputEmail5" type="hidden" name="redirect" value="">
                                    <button class="btn btn-large btn-dark-gray btn-rounded btn-box-shadow btn-switch-text left-icon submit" type="submit">
                                        <span>
                                            <span><i class="fa-regular fa-paper-plane"></i></span>
                                            <span class="btn-double-text" data-text="Enviar mensaje">Enviar mensaje</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="col-12 md-mb-20px">
                                    <div class="form-results mt-20px d-none"></div>
                                </div>
                            </div>
                        </form>
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
        <!-- end section -->

         <!-- start footer -->
         @include('public.layouts.footer')
         <!-- end footer -->

        <!-- end footer -->
        <!-- start scroll progress -->
        <div class="scroll-progress d-none d-xxl-block">
            <a href="#" class="scroll-top" aria-label="scroll">
                <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
            </a>
        </div>
        <!-- end scroll progress -->
        <!-- javascript libraries -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/vendors.min.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA56KqSJ11nQUw_tXgXyNMiPmQeM7EaSA&callback=initMap"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>