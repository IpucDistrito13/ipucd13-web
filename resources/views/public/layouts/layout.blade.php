<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>Crafto - The Multipurpose HTML5 Template</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="ThemeZaa">
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <meta name="description" content="Elevate your online presence with Crafto - a modern, versatile, multipurpose Bootstrap 5 responsive HTML5, SCSS template using highly creative 48+ ready demos.">
        <!-- favicon icon -->
        <link rel="shortcut icon" href="images/favicon.png">
        <link rel="apple-touch-icon" href="images/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
        <!-- google fonts preconnect -->
        <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- style sheets and font icons -->
        <link rel="stylesheet" href="css/vendors.min.css"/>
        <link rel="stylesheet" href="css/icon.min.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/responsive.css"/>
        <link rel="stylesheet" href="demos/elearning/elearning.css" />
    </head>
    <body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#313e3b">
        <!-- start header -->
        <header> 
            <!-- start navigation -->
            <nav class="navbar navbar-expand-lg header-transparent bg-transparent header-reverse" data-header-hover="light">
                <div class="container-fluid">
                    <div class="col-auto col-lg-2 me-lg-0 me-auto">
                        <a class="navbar-brand" href="demo-elearning.html">
                            <img src="images/demo-elearning-logo-white.png" data-at2x="images/demo-elearning-logo-white@2x.png" alt="" class="default-logo">
                            <img src="images/demo-elearning-logo-black.png" data-at2x="images/demo-elearning-logo-black@2x.png" alt="" class="alt-logo">
                            <img src="images/demo-elearning-logo-black.png" data-at2x="images/demo-elearning-logo-black@2x.png" alt="" class="mobile-logo"> 
                        </a>
                    </div>
                    <div class="col-auto menu-order position-static">
                        <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav"> 
                            <ul class="navbar-nav alt-font"> 
                                <li class="nav-item"><a href="{{ route('inicio.index') }}" class="nav-link">Inicio</a></li>
                                <li class="nav-item dropdown dropdown-with-icon">
                                    <a href="demo-elearning-courses.html" class="nav-link">Calendario</a>
                                    <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li>
                                            <a href="demo-elearning-courses-details.html"><i class="bi bi-laptop"></i>
                                                <div class="submenu-icon-content">
                                                    <span>Eventos</span>
                                                    <p>Develop professional skills</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="demo-elearning-courses-details.html"><i class="bi bi-briefcase"></i>
                                                <div class="submenu-icon-content">
                                                    <span>Cronograma distrital</span>
                                                    <p>Advance your business</p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a href="demo-elearning-testimonial.html" class="nav-link">Descargables</a></li>
                                <li class="nav-item"><a href="{{route('publicaciones.index')}}" class="nav-link">Blog</a></li>
                                <li class="nav-item"><a href="{{route('contacto.index')}}" class="nav-link">Contacto</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto col-lg-2 text-end d-none d-sm-flex">
                          
                    </div>
                </div>
            </nav>
            <!-- end navigation -->
        </header>
        <!-- end header --> 
        <!-- start section -->
        <section class="p-0 overflow-hidden bg-dark-gray full-screen ipad-top-space-margin md-h-auto position-relative md-pb-70px sm-pb-40px cover-background" style="background-image: url('images/demo-elearning-hero-bg.jpg')">
            <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0" style="background-image: url('images/vertical-line-bg-small.svg')"></div>
            <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true" data-particle-options='{"particles": {"number": {"value": 6,"density": {"enable": true,"value_area": 2000}},"color": {"value": ["#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b", "#d5d52b"]},"shape": {"type": "circle","stroke":{"width":0,"color":"#000000"}},"opacity": {"value": 1,"random": false,"anim": {"enable": false,"speed": 1,"sync": false}},"size": {"value": 8,"random": true,"anim": {"enable": false,"sync": true}},"line_linked":{"enable":false,"distance":0,"color":"#ffffff","opacity":1,"width":1},"move": {"enable": true,"speed":1,"direction": "right","random": false,"straight": false}},"interactivity": {"detect_on": "canvas","events": {"onhover": {"enable": false,"mode": "repulse"},"onclick": {"enable": false,"mode": "push"},"resize": true}},"retina_detect": false}'></div> 
            <div class="position-absolute left-minus-80px top-25" data-bottom-top="transform: translateY(-80px)" data-top-bottom="transform: translateY(80px)">
                <img src="images/demo-elearning-01.png" alt="">
            </div>
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-xl-5 col-lg-6 col-md-12 text-white text-center text-lg-start position-relative z-index-1 d-flex flex-column justify-content-center h-100 md-mt-50px md-mb-20px xs-mb-10px" data-anime='{ "el": "childs", "opacity": [0, 1], "rotateY": [90, 0], "rotateZ": [-10, 0], "translateY": [80, 0], "translateZ": [50, 0], "staggervalue": 200, "duration": 600, "delay": 100, "easing": "easeOutCirc" }'>
                        <span class="alt-font fs-75 lh-65 sm-fs-60 fw-500 mb-25px ls-minus-2px">Iglesia Pentecostal Unida de Colombia</span>
                        <div class="mb-30px w-80 md-w-60 sm-w-100 d-block mx-auto mx-lg-0 overflow-hidden">
                            <span class="fs-75 lh-65 fw-500 opacity-5 d-inline-block">DISTRITO 13</span>
                        </div>
                        <div class="overflow-hidden">
                            <a href="demo-elearning-contact.html" class="btn btn-extra-large btn-base-color btn-rounded btn-switch-text fw-600 d-inline-block me-25px sm-me-10px align-middle left-icon">
                                <span>
                                    <span><i class="feather icon-feather-thumbs-up"></i></span>
                                    <span class="btn-double-text ls-minus-05px" data-text="Get started">Get started</span>
                                </span>
                            </a>
                            <a href="https://www.youtube.com/watch?v=cfXHhfNy7tU" class="btn btn-link btn-hover-animation-switch btn-extra-large text-white popup-youtube btn-icon-left">
                                <span>
                                    <span class="btn-text">How it works</span>
                                    <span class="btn-icon"><i class="feather icon-feather-youtube"></i></span>
                                    <span class="btn-icon"><i class="feather icon-feather-youtube"></i></span>
                                </span> 
                            </a>
                        </div>
                        <div class="row row-cols-3 justify-content-center counter-style-04 w-100 md-w-auto position-absolute lg-position-relative bottom-80px lg-bottom-0px lg-mt-50px">
                            <!-- start counter item -->
                            <div class="col text-center text-lg-start">
                                <h5 class="vertical-counter d-inline-flex alt-font text-white fw-600 mb-10px" data-text="+" data-to="260"></h5>
                                <div class="divider-style-03 divider-style-03-01 border-2 border-color-base-color mb-5px w-80 xs-w-90 md-mx-auto"></div>
                                <span class="fw-300 text-white opacity-5">Tutors</span>
                            </div>
                            <!-- end counter item -->
                            <!-- start counter item -->
                            <div class="col text-center text-lg-start">
                                <h5 class="vertical-counter d-inline-flex alt-font text-white fw-600 mb-10px" data-text="+" data-to="5340"></h5>
                                <div class="divider-style-03 divider-style-03-01 border-2 border-color-base-color mb-5px w-80 xs-w-90 md-mx-auto"></div>
                                <span class="fw-300 text-white opacity-5">Students</span>
                            </div>
                            <!-- end counter item -->
                            <!-- start counter item -->
                            <div class="col text-center text-lg-start">
                                <h5 class="vertical-counter d-inline-flex alt-font text-white fw-600 mb-10px" data-text="+" data-to="280"></h5>
                                <div class="divider-style-03 divider-style-03-01 border-2 border-color-base-color mb-5px w-80 xs-w-90 md-mx-auto"></div>
                                <span class="fw-300 text-white opacity-5">Courses</span>
                            </div>
                            <!-- end counter item -->
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 pt-30px lg-pt-0">
                        <div class="position-relative outside-box-right-10 md-outside-box-right-0 atropos" data-atropos>
                            <div class="atropos-scale">
                                <div class="atropos-rotate">
                                    <div class="atropos-inner text-center w-100">
                                        <div data-atropos-offset="-1" class="position-absolute left-0px right-0px">
                                            <img src="https://via.placeholder.com/975x990" alt="">
                                        </div>
                                        <img data-atropos-offset="1" class="position-relative z-index-9 animation-float" src="images/demo-elearning-hero-banner-02.png" alt="">
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </section>
        <!-- end section -->
        <!-- start section -->
        <section id="down-section" class="background-position-left-top background-no-repeat position-relative" style="background-image: url('images/demo-elearning-02.png')">
            <div class="position-absolute right-0px top-30px" data-bottom-top="transform: translateY(80px)" data-top-bottom="transform: translateY(-80px)">
                <img src="images/demo-elearning-04.png" alt="">
            </div>
            <div class="container">
                <div class="text-center position-absolute top-minus-40px left-0px right-0px z-index-1 d-none d-md-inline-block" data-anime='{ "opacity": [0, 1], "translate": [0, 0], "staggervalue": 100, "easing": "easeOutQuad" }'>
                    <a href="#down-section" class="d-block section-link">
                        <div class="d-flex justify-content-center align-items-center mx-auto box-shadow-medium-bottom rounded-circle h-70px w-70px text-dark-gray bg-white">
                            <i class="bi bi-mouse icon-very-medium lh-0px"></i>
                        </div>
                    </a>
                </div>
                <div class="row justify-content-center">                    
                    <div class="col-lg-5 col-md-10 position-relative md-mb-40px sm-mb-25px" data-anime='{ "opacity": [0,1], "duration": 600, "delay":100, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <div class="icon-with-text-style-08 mb-20px">
                            <div class="feature-box feature-box-left-icon-middle">
                                <div class="feature-box-icon feature-box-icon-rounded w-55px h-55px rounded-circle bg-yellow me-15px">
                                    <i class="bi bi-award d-inline-block icon-extra-medium text-dark-gray"></i> 
                                </div>
                                <div class="feature-box-content last-paragraph-no-margin">
                                    <span class="d-inline-block alt-font fs-19 fw-500 ls-minus-05px text-dark-gray">Guaranteed and certified</span>
                                </div>
                            </div>
                        </div>
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mx-auto">Online learning wherever and whenever.</h2>
                        <a href="demo-elearning-about.html" class="btn btn-large btn-dark-gray btn-box-shadow btn-rounded btn-switch-text">
                            <span>
                                <span class="btn-double-text" data-text="Learn more">Learn more</span>
                                <span><i class="fa-solid fa-arrow-right"></i></span>
                            </span>
                        </a>
                        <div class="d-flex align-items-center fw-500 text-dark-gray w-100 position-absolute md-position-relative bottom-0 left-minus-5px md-mt-15px"><img src="https://via.placeholder.com/156x113" alt=""><span class="d-inline-block position-relative lh-24">Online courses from <a href="demo-elearning-instructors.html" class="fw-600 text-decoration-line-bottom text-dark-gray ">experts.</a></span></div>
                    </div>
                    <div class="col-xl-6 col-lg-7 col-md-10 offset-xl-1 position-relative mt-minus-1">
                        <div class="row row-cols-auto row-cols-sm-2" data-anime='{ "el": "childs", "translateX": [30, 0], "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":100, "staggervalue": 300, "easing": "easeOutQuad" }'>
                            <!-- start features box item -->
                            <div class="col align-self-start">
                                <div class="feature-box text-start ps-30px pe-30px xl-pe-5px sm-pe-0">
                                    <div class="feature-box-icon position-absolute left-0px top-0px">
                                        <h2 class="alt-font fs-100 fw-700 ls-minus-1px opacity-1 mb-0">01</h2>
                                    </div>
                                    <div class="feature-box-content last-paragraph-no-margin pt-30 md-pt-21 sm-pt-40px">
                                        <span class="text-dark-gray fs-20 d-inline-block fw-600 mb-5px">Flexible schedule</span>
                                        <p>eLearning allows learners to quickly and more easily complete their training.</p>
                                        <span class="w-60px h-3px bg-yellow d-inline-block"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- end features box item -->
                            <!-- start features box item -->
                            <div class="col align-self-end mt-25 xs-mt-30px">
                                <div class="feature-box text-start ps-30px pe-30px xl-pe-5px sm-pe-0">
                                    <div class="feature-box-icon position-absolute left-0px top-0px">
                                        <h2 class="alt-font fs-100 fw-700 ls-minus-1px opacity-1 mb-0">02</h2>
                                    </div>
                                    <div class="feature-box-content last-paragraph-no-margin pt-30 md-pt-21 sm-pt-40px">
                                        <span class="text-dark-gray fs-20 d-inline-block fw-600 mb-5px">Pocket friendly</span>
                                        <p>eLearning allows learners to quickly and more easily complete their training.</p>
                                        <span class="w-60px h-3px bg-yellow d-inline-block"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- end features box item -->
                            <!-- start features box item -->
                            <div class="col align-self-start mt-minus-12 xs-mt-30px">
                                <div class="feature-box text-start ps-30px pe-30px xl-pe-5px sm-pe-0">
                                    <div class="feature-box-icon position-absolute left-0px top-0px">
                                        <h2 class="alt-font fs-100 fw-700 ls-minus-1px opacity-1 mb-0">03</h2>
                                    </div>
                                    <div class="feature-box-content last-paragraph-no-margin pt-30 md-pt-21 sm-pt-40px">
                                        <span class="text-dark-gray fs-20 d-inline-block fw-600 mb-5px">Expert Instructor</span>
                                        <p>eLearning allows learners to quickly and more easily complete their training.</p>
                                        <span class="w-60px h-3px bg-yellow d-inline-block"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- end features box item -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
        <!-- start section -->
        <section class="bg-tranquil position-relative">
            <div class="position-absolute left-minus-200px top-25" data-bottom-top="transform: translateY(-80px)" data-top-bottom="transform: translateY(80px)">
                <img src="images/demo-elearning-bg-04.png" alt="">
            </div>
            <div class="container">
                <div class="row align-items-center mb-4">
                    <div class="col-xl-5 lg-mb-30px text-center text-xl-start">
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Popular courses</h2>
                    </div>
                    <div class="col-xl-7 tab-style-04 text-center text-xl-end">
                        <!-- filter navigation -->
                        <ul class="portfolio-filter fw-500 nav nav-tabs justify-content-center justify-content-xl-end border-0">
                            <li class="nav active"><a data-filter="*" href="#">All</a></li>
                            <li class="nav"><a data-filter=".development" href="#">Development</a></li>
                            <li class="nav"><a data-filter=".business" href="#">Business</a></li>
                            <li class="nav"><a data-filter=".design" href="#">Design</a></li>
                            <li class="nav"><a data-filter=".marketing" href="#">Marketing</a></li>
                        </ul>
                        <!-- end filter navigation --> 
                    </div>
                </div> 
                <div class="row" data-anime='{ "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="col-12 filter-content p-md-0">
                        <ul class="portfolio-wrapper grid-loading grid grid-3col xxl-grid-3col xl-grid-3col lg-grid-2col md-grid-2col sm-grid-1col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>
                            <!-- start portfolio item -->
                            <li class="grid-item design transition-inner-all">
                                <div class="services-box-style-06 border-radius-6px hover-box overflow-hidden box-shadow-large">
                                    <div class="image">
                                        <a href="demo-elearning-courses-details.html">
                                            <img src="https://via.placeholder.com/600x385" alt="">
                                        </a>
                                    </div> 
                                    <div class="bg-white position-relative">
                                        <div class="bg-dark-gray w-80px h-80px md-w-75px md-h-75px rounded-circle d-flex justify-content-center align-items-center fw-500 text-white fs-20 position-absolute right-30px top-minus-40px">$55</div>
                                        <div class="ps-35px pe-35px pt-30px pb-30px xl-ps-25px xl-pe-25px border-bottom border-color-transparent-dark-very-light">
                                            <span class="d-block mb-10px"><a href="demo-elearning-courses.html" class="text-dark-gray text-uppercase fs-15 fw-600 services-text">Design</a><span class="fs-16">Matthew taylor</span></span>
                                            <div class="d-flex align-items-center mb-5px">
                                                <a href="demo-elearning-courses-details.html" class="text-dark-gray fw-600 fs-19 md-fs-18 lh-28 w-90">Business accounting and taxation fundamental</a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="d-inline-block me-auto">
                                                    <div class="review-star-icon float-start">
                                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                                    </div>
                                                    <div class="fs-15 float-start ms-5px position-relative top-2px">(20 Reviews)</div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="d-flex justify-content-center align-items-center ps-35px pe-35px xl-ps-20px xl-pe-20px pt-15px pb-20px">
                                            <div class="me-auto">
                                                <i class="feather icon-feather-clipboard text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">10 Lessons</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="feather icon-feather-users text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">18 Students</span>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end portfolio item -->
                            <!-- start portfolio item -->
                            <li class="grid-item business marketing transition-inner-all">
                                <div class="services-box-style-06 border-radius-6px hover-box overflow-hidden box-shadow-large">
                                    <div class="image">
                                        <a href="demo-elearning-courses-details.html">
                                            <img src="https://via.placeholder.com/600x385" alt="">
                                        </a>
                                    </div> 
                                    <div class="bg-white position-relative">
                                        <div class="bg-dark-gray w-80px h-80px md-w-75px md-h-75px rounded-circle d-flex justify-content-center align-items-center fw-500 text-white fs-20 position-absolute right-30px top-minus-40px">$65</div>
                                        <div class="ps-35px pe-35px pt-30px pb-30px xl-ps-25px xl-pe-25px border-bottom border-color-transparent-dark-very-light">
                                            <span class="d-block mb-10px"><a href="demo-elearning-courses.html" class="text-dark-gray text-uppercase fs-15 fw-600 services-text">Finance</a><span class="fs-16">Leonel mooney</span></span>
                                            <div class="d-flex align-items-center mb-5px">
                                                <a href="demo-elearning-courses-details.html" class="text-dark-gray fw-600 fs-19 md-fs-18 lh-28 w-90">Finance fundamentals of management and planning</a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="d-inline-block me-auto">
                                                    <div class="review-star-icon float-start">
                                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                                    </div>
                                                    <div class="fs-15 float-start ms-5px position-relative top-2px">(39 Reviews)</div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="d-flex justify-content-center align-items-center ps-35px pe-35px xl-ps-25px xl-pe-25px pt-15px pb-20px">
                                            <div class="me-auto">
                                                <i class="feather icon-feather-clipboard text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">22 Lessons</span>
                                            </div>
                                            <div>
                                                <i class="feather icon-feather-users text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">30 Students</span>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end portfolio item -->
                            <!-- start portfolio item -->
                            <li class="grid-item development marketing transition-inner-all">
                                <div class="services-box-style-06 border-radius-6px hover-box overflow-hidden box-shadow-large">
                                    <div class="image">
                                        <a href="demo-elearning-courses-details.html">
                                            <img src="https://via.placeholder.com/600x385" alt="">
                                        </a>
                                    </div> 
                                    <div class="bg-white position-relative">
                                        <div class="bg-dark-gray w-80px h-80px md-w-75px md-h-75px rounded-circle d-flex justify-content-center align-items-center fw-500 text-white fs-20 position-absolute right-30px top-minus-40px">$80</div>
                                        <div class="ps-35px pe-35px pt-30px pb-30px xl-ps-25px xl-pe-25px border-bottom border-color-transparent-dark-very-light">
                                            <span class="d-block mb-10px"><a href="demo-elearning-courses.html" class="text-dark-gray text-uppercase fs-15 fw-600 services-text">Design</a><span class="fs-16">Herman miller</span></span>
                                            <div class="d-flex align-items-center mb-5px">
                                                <a href="demo-elearning-courses-details.html" class="text-dark-gray fw-600 fs-19 md-fs-18 lh-28 w-90">Introduction to application design and development</a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="d-inline-block me-auto">
                                                    <div class="review-star-icon float-start">
                                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                                    </div>
                                                    <div class="fs-15 float-start ms-5px position-relative top-2px">(55 Reviews)</div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="d-flex justify-content-center align-items-center ps-35px pe-35px xl-ps-25px xl-pe-25px pt-15px pb-20px">
                                            <div class="me-auto">
                                                <i class="feather icon-feather-clipboard text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">15 Lessons</span>
                                            </div>
                                            <div>
                                                <i class="feather icon-feather-users text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">55 Students</span>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end portfolio item -->
                            <!-- start portfolio item -->
                            <li class="grid-item business design transition-inner-all">
                                <div class="services-box-style-06 border-radius-6px hover-box overflow-hidden box-shadow-large">
                                    <div class="image">
                                        <a href="demo-elearning-courses-details.html">
                                            <img src="https://via.placeholder.com/600x385" alt="">
                                        </a>
                                    </div> 
                                    <div class="bg-white position-relative">
                                        <div class="bg-dark-gray w-80px h-80px md-w-75px md-h-75px rounded-circle d-flex justify-content-center align-items-center fw-500 text-white fs-20 position-absolute right-30px top-minus-40px">$60</div>
                                        <div class="ps-35px pe-35px pt-30px pb-30px xl-ps-25px xl-pe-25px border-bottom border-color-transparent-dark-very-light">
                                            <span class="d-block mb-10px"><a href="demo-elearning-courses.html" class="text-dark-gray text-uppercase fs-15 fw-600 services-text">Medicine</a><span class="fs-16">Shoko mugikura</span></span>
                                            <div class="d-flex align-items-center mb-5px">
                                                <a href="demo-elearning-courses-details.html" class="text-dark-gray fw-600 fs-19 md-fs-18 lh-28 w-90">Genetic testing and sequencing technique</a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="d-inline-block me-auto">
                                                    <div class="review-star-icon float-start">
                                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                                    </div>
                                                    <div class="fs-15 float-start ms-5px position-relative top-2px">(42 Reviews)</div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="d-flex justify-content-center align-items-center ps-35px pe-35px xl-ps-25px xl-pe-25px pt-15px pb-20px">
                                            <div class="me-auto">
                                                <i class="feather icon-feather-clipboard text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">10 Lessons</span>
                                            </div>
                                            <div>
                                                <i class="feather icon-feather-users text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">34 Students</span>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end portfolio item -->
                            <!-- start portfolio item -->
                            <li class="grid-item development design transition-inner-all">
                                <div class="services-box-style-06 border-radius-6px hover-box overflow-hidden box-shadow-large">
                                    <div class="image">
                                        <a href="demo-elearning-courses-details.html">
                                            <img src="https://via.placeholder.com/600x385" alt="">
                                        </a>
                                    </div> 
                                    <div class="bg-white position-relative">
                                        <div class="bg-dark-gray w-80px h-80px md-w-75px md-h-75px rounded-circle d-flex justify-content-center align-items-center fw-500 text-white fs-20 position-absolute right-30px top-minus-40px">$70</div>
                                        <div class="ps-35px pe-35px pt-30px pb-30px xl-ps-25px xl-pe-25px border-bottom border-color-transparent-dark-very-light">
                                            <span class="d-block mb-10px"><a href="demo-elearning-courses.html" class="text-dark-gray text-uppercase fs-15 fw-600 services-text">Design</a><span class="fs-16">Alexa harvard</span></span>
                                            <div class="d-flex align-items-center mb-5px">
                                                <a href="demo-elearning-courses-details.html" class="text-dark-gray fw-600 fs-19 md-fs-18 lh-28 w-90">Introduction to web design and visualization</a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="d-inline-block me-auto">
                                                    <div class="review-star-icon float-start">
                                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                                    </div>
                                                    <div class="fs-15 float-start ms-5px position-relative top-2px">(56 Reviews)</div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="d-flex justify-content-center align-items-center ps-35px pe-35px xl-ps-25px xl-pe-25px pt-15px pb-20px">
                                            <div class="me-auto">
                                                <i class="feather icon-feather-clipboard text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">20 Lessons</span>
                                            </div>
                                            <div>
                                                <i class="feather icon-feather-users text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">59 Students</span>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end portfolio item -->
                            <!-- start portfolio item -->
                            <li class="grid-item development business marketing transition-inner-all">
                                <div class="services-box-style-06 border-radius-6px hover-box overflow-hidden box-shadow-large">
                                    <div class="image">
                                        <a href="demo-elearning-courses-details.html">
                                            <img src="https://via.placeholder.com/600x385" alt="">
                                        </a>
                                    </div> 
                                    <div class="bg-white position-relative">
                                        <div class="bg-dark-gray w-80px h-80px md-w-75px md-h-75px rounded-circle d-flex justify-content-center align-items-center fw-500 text-white fs-20 position-absolute right-30px top-minus-40px">$45</div>
                                        <div class="ps-35px pe-35px pt-30px pb-30px xl-ps-25px xl-pe-25px border-bottom border-color-transparent-dark-very-light">
                                            <span class="d-block mb-10px"><a href="demo-elearning-courses.html" class="text-dark-gray text-uppercase fs-15 fw-600 services-text">Business</a><span class="fs-16">Leonel mooney</span></span>
                                            <div class="d-flex align-items-center mb-5px">
                                                <a href="demo-elearning-courses-details.html" class="text-dark-gray fw-600 fs-19 md-fs-18 lh-28 w-90">Improve your english vocabulary and language</a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="d-inline-block me-auto">
                                                    <div class="review-star-icon float-start">
                                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                                    </div>
                                                    <div class="fs-15 float-start ms-5px position-relative top-2px">(76 Reviews)</div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="d-flex justify-content-center align-items-center ps-35px pe-35px xl-ps-25px xl-pe-25px pt-15px pb-20px">
                                            <div class="me-auto">
                                                <i class="feather icon-feather-clipboard text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">18 Lessons</span>
                                            </div>
                                            <div>
                                                <i class="feather icon-feather-users text-dark-gray d-inline-block me-5px"></i><span class="fs-16 text-dark-gray fw-500">80 Students</span>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end portfolio item --> 
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-center" data-anime='{ "opacity": [0, 1], "translate": [0, 0], "staggervalue": 100, "easing": "easeOutQuad" }'>
                    <div class="col-12 text-center mt-5"> 
                        <span class="fs-20 text-dark-gray fw-500 ls-minus-05px">We help you find the perfect tutor. It's completely free. <a href="demo-elearning-courses.html" class="fw-600 text-dark-gray">Explore all courses<i class="fa-solid fa-arrow-right ms-5px icon-very-small"></i></a></span>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
        <!-- start section -->
        <section class="overflow-hidden">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-7 col-lg-6 text-center md-mb-50px sm-mb-30px" data-anime='{ "el": "childs", "opacity": [0, 1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <div class="position-relative pe-50px lg-pe-0 outside-box-left-10 md-outside-box-left-0 atropos" data-atropos>
                            <div class="atropos-scale">
                                <div class="atropos-rotate">
                                    <div class="atropos-inner text-center w-100 overflow-visible">
                                        <div data-atropos-offset="-5" class="position-absolute left-0px">
                                            <img src="https://via.placeholder.com/835x710" alt="">
                                        </div>
                                        <img data-atropos-offset="5" class="position-relative z-index-9" src="images/demo-elearning-06.png" alt="">
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-11 position-relative" data-anime='{ "el": "childs", "translateX": [30, 0], "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <div class="icon-with-text-style-08 mb-20px">
                            <div class="feature-box feature-box-left-icon-middle">
                                <div class="feature-box-icon feature-box-icon-rounded w-55px h-55px rounded-circle bg-yellow me-15px">
                                    <i class="bi bi-briefcase d-inline-block icon-extra-medium text-dark-gray"></i> 
                                </div>
                                <div class="feature-box-content last-paragraph-no-margin">
                                    <span class="d-inline-block alt-font fs-19 fw-500 ls-minus-05px text-dark-gray">Premium learning experience</span>
                                </div>
                            </div>
                        </div>
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-40px sm-mb-25px mx-auto">Providing amazing online courses.</h2>
                        <div class="accordion accordion-style-06 text-start" id="accordion-style-07">
                            <!-- start accordion item -->
                            <div class="accordion-item active-accordion">
                                <div class="accordion-header">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-07-01" aria-expanded="true" data-bs-parent="#accordion-style-07">
                                        <div class="accordion-title fs-18 position-relative pe-0 xs-lh-28px text-dark-gray fw-600 mb-0">Master the skills that matter to you</div>
                                    </a>
                                </div>
                                <div id="accordion-style-07-01" class="accordion-collapse collapse show" data-bs-parent="#accordion-style-07">
                                    <div class="accordion-body last-paragraph-no-margin">
                                        <p>Web-based training you can consume at your own pace. Courses are interactive.</p>
                                        <i class="line-icon-Address-Book icon-extra-double-large opacity-2"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion item -->
                            <!-- start accordion item -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-07-02" aria-expanded="false" data-bs-parent="#accordion-style-07">
                                        <div class="accordion-title fs-18 position-relative pe-0 text-dark-gray fw-600 mb-0">Connect with effective methods</div>
                                    </a>
                                </div>
                                <div id="accordion-style-07-02" class="accordion-collapse collapse" data-bs-parent="#accordion-style-07">
                                    <div class="accordion-body last-paragraph-no-margin">
                                        <p>Web-based training you can consume at your own pace. Courses are interactive.</p>
                                        <i class="line-icon-Sand-watch icon-extra-double-large opacity-2"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion item -->
                            <!-- start accordion item -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-07-03" aria-expanded="false" data-bs-parent="#accordion-style-07">
                                        <div class="accordion-title fs-18 position-relative pe-0 text-dark-gray fw-600 mb-0">Increase your learning skills</div>
                                    </a>
                                </div>
                                <div id="accordion-style-07-03" class="accordion-collapse collapse" data-bs-parent="#accordion-style-07">
                                    <div class="accordion-body last-paragraph-no-margin">
                                        <p>Web-based training you can consume at your own pace. Courses are interactive.</p>
                                        <i class="line-icon-Gear-2 icon-extra-double-large opacity-2"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion item -->
                        </div>
                        <a href="demo-elearning-courses.html" class="btn btn-extra-large btn-dark-gray btn-box-shadow btn-rounded btn-switch-text mt-30px">
                            <span>
                                <span class="btn-double-text" data-text="Explore courses">Explore courses</span>
                                <span><i class="fa-solid fa-arrow-right"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row position-relative mt-40px xs-mt-20px">
                    <div class="col swiper swiper-width-auto feather-shadow text-center" data-slider-options='{ "slidesPerView": "auto", "spaceBetween":80, "centeredSlides": true, "speed": 30000, "loop": true, "pagination": { "el": ".slider-four-slide-pagination-2", "clickable": false }, "allowTouchMove": false, "autoplay": { "delay":1, "disableOnInteraction": false }, "navigation": { "nextEl": ".slider-four-slide-next-2", "prevEl": ".slider-four-slide-prev-2" }, "keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "slide" }'>
                        <div class="swiper-wrapper marquee-slide">
                            <!-- start slider item -->
                            <div class="swiper-slide">
                                <div class="fs-190 ls-minus-10px pt-10px pb-10px alt-font fw-600 opacity-1">providing amazing online</div>
                            </div>
                            <!-- end slider item -->
                            <!-- start slider item -->
                            <div class="swiper-slide">
                                <div class="fs-190 ls-minus-10px pt-10px pb-10px alt-font fw-600 opacity-1">courses bringing you</div>
                            </div>
                            <!-- end slider item -->
                            <!-- start slider item -->
                            <div class="swiper-slide">
                                <div class="fs-190 ls-minus-10px pt-10px pb-10px alt-font fw-600 opacity-1">outstanding online learning</div>
                            </div>
                            <!-- end slider item -->
                        </div> 
                    </div>  
                    <div class="col-12 position-absolute top-0 h-100 d-flex justify-content-center align-items-center left-0px z-index-1 text-center">
                        <h4 class="alt-font text-dark-gray fs-45 fw-600 ls-minus-2px xs-ls-minus-1px mb-0 mt-40px xs-mt-15px">Online learning wherever and whenever.</h4>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
        <!-- start section -->
        <section class="position-relative bg-gradient-aztec-green overflow-hidden">
            <div class="position-absolute left-minus-100px top-40px" data-bottom-top="transform: translateY(-80px)" data-top-bottom="transform: translateY(80px)">
                <img src="images/demo-elearning-bg-05.png" alt="">
            </div>
            <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0" style="background-image: url('images/vertical-line-bg-small.svg')"></div>
            <div class="background-position-center-top h-8px w-100 position-absolute left-0px bottom-0" style="background-image: url('images/demo-elearning-border.jpg')"></div>
            <div class="container">
                <div class="row justify-content-center align-items-center" data-anime='{ "el": "childs", "opacity": [0, 1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <div class="col-lg-5 position-relative md-mb-50px sm-mb-25px">
                        <div class="icon-with-text-style-08 mb-20px">
                            <div class="feature-box feature-box-left-icon-middle">
                                <div class="feature-box-icon feature-box-icon-rounded w-55px h-55px rounded-circle bg-yellow me-15px">
                                    <i class="bi bi-chat-quote d-inline-block icon-extra-medium text-dark-gray"></i>
                                </div>
                                <div class="feature-box-content last-paragraph-no-margin">
                                    <span class="d-inline-block alt-font fs-19 ls-minus-05px text-white">Students feedback</span>
                                </div>
                            </div>
                        </div>
                        <h2 class="alt-font text-white fw-600 ls-minus-3px w-85 lg-w-100">Trusted by genius people.</h2>
                        <p class="w-80 lg-w-100 text-white opacity-4">Lorem ipsum dolor sit amet consectetur adipiscing elit venenatis dictum nec.</p>
                        <div class="d-flex align-items-center">
                            <div class="col-auto text-center border-end border-color-transparent-white-very-light border-1 me-25px pe-25px"><h2 class="alt-font lh-44 fw-600 text-white mb-0">99%</h2></div>
                            <div class="col">
                                <span class="d-block w-55 lh-26 text-white xl-w-60 lg-w-100">Student's complete course successfully.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 position-relative testimonials-style-12"> 
                        <div class="swiper magic-cursor" data-slider-options='{ "slidesPerView": 1, "spaceBetween": 50, "loop": true, "autoplay": { "delay": 4000, "disableOnInteraction": false },  "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "1200": { "slidesPerView": 1 },  "768": { "slidesPerView": 1 }, "768": { "slidesPerView": 1 }, "320": { "slidesPerView": 1 }, "effect": "slide" }, "navigation": { "nextEl": ".swiper-button-next-nav", "prevEl": ".swiper-button-previous-nav", "effect": "fade" } }'>
                            <div class="swiper-wrapper pt-20px pb-20px">
                                <!-- start slider item --> 
                                <div class="swiper-slide">
                                    <div class="row g-0 border-radius-6px overflow-hidden"> 
                                        <div class="col-sm-5 services-box-img xs-h-350px">
                                            <div class="h-100 cover-background" style="background-image: url(https://via.placeholder.com/305x380)"></div>
                                        </div>
                                        <div class="col-sm-7 testimonials-box bg-white p-9 sm-p-7 box-shadow-extra-large">
                                            <div class="d-inline-block bg-orange text-white border-radius-50px ps-20px pe-20px fs-15 lh-34 sm-lh-30 ls-minus-1px mb-25px align-middle">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </div>
                                            <div class="testimonials-box-content">
                                                <p class="mb-20px">Course materials were good, the mentoring approach was good and working with other people via the internet was good.</p>
                                                <div class="fs-18 lh-20 fw-600 text-dark-gray">Charlotte smith</div>
                                                <span class="fs-16 lh-20">Business owner</span>
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                                <!-- end slider item -->
                                <!-- start slider item --> 
                                <div class="swiper-slide">
                                    <div class="row g-0 border-radius-6px overflow-hidden"> 
                                        <div class="col-sm-5 services-box-img xs-h-350px">
                                            <div class="h-100 cover-background" style="background-image: url(https://via.placeholder.com/305x380)"></div>
                                        </div>
                                        <div class="col-sm-7 testimonials-box bg-white p-9 sm-p-7 box-shadow-extra-large">
                                            <div class="d-inline-block bg-orange text-white border-radius-50px ps-20px pe-20px fs-15 lh-34 sm-lh-30 ls-minus-1px mb-25px align-middle">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </div>
                                            <div class="testimonials-box-content">
                                                <p class="mb-20px">Course materials were good, the mentoring approach was good and working with other people via the internet was good.</p>
                                                <div class="fs-18 lh-20 fw-600 text-dark-gray">Herman miller</div>
                                                <span class="fs-16 lh-20">Behavioral science</span>
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                                <!-- end slider item -->
                                <!-- start slider item --> 
                                <div class="swiper-slide">
                                    <div class="row g-0 border-radius-6px overflow-hidden"> 
                                        <div class="col-sm-5 services-box-img xs-h-350px">
                                            <div class="h-100 cover-background" style="background-image: url(https://via.placeholder.com/305x380)"></div>
                                        </div>
                                        <div class="col-sm-7 testimonials-box bg-white p-9 sm-p-7 box-shadow-extra-large">
                                            <div class="d-inline-block bg-orange text-white border-radius-50px ps-20px pe-20px fs-15 lh-34 sm-lh-30 ls-minus-1px mb-25px align-middle">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </div>
                                            <div class="testimonials-box-content">
                                                <p class="mb-20px">Course materials were good, the mentoring approach was good and working with other people via the internet was good.</p>
                                                <div class="fs-18 lh-20 fw-600 text-dark-gray">Matthew taylor</div>
                                                <span class="fs-16 lh-20">Network security</span>
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                                <!-- end slider item -->
                            </div>
                        </div>
                        <!-- start slider navigation -->
                        <div class="swiper-button-next-nav border-radius-100px swiper-button-next bg-white box-shadow-small"><i class="feather icon-feather-chevron-right icon-extra-medium"></i></div>
                        <div class="swiper-button-previous-nav border-radius-100px swiper-button-prev bg-white box-shadow-small"><i class="feather icon-feather-chevron-left icon-extra-medium"></i></div>
                        <!-- end slider pagination -->
                    </div> 
                </div>
                <div class="row row-cols-1 row-cols-lg-5 row-cols-md-3 row-cols-sm-3 text-center justify-content-center clients-style-05 mt-6" data-anime='{ "el": "childs", "opacity": [0, 1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <!-- start client item -->
                    <div class="col md-mb-40px">
                        <div class="client-box">
                            <a href="#"><img src="images/logo-walmart-white.svg" class="h-40px" alt="" /></a> 
                        </div>
                    </div>
                    <!-- end client item -->
                    <!-- start client item -->
                    <div class="col md-mb-40px">
                        <div class="client-box">
                            <a href="#"><img src="images/logo-logitech-white.svg" class="h-40px" alt="" /></a> 
                        </div>
                    </div>
                    <!-- end client item -->
                    <!-- start client item -->
                    <div class="col md-mb-40px">
                        <div class="client-box">
                            <a href="#"><img src="images/logo-invision-white.svg" class="h-40px" alt="" /></a> 
                        </div>
                    </div>
                    <!-- end client item -->
                    <!-- start client item -->
                    <div class="col xs-mb-40px">
                        <div class="client-box">
                            <a href="#"><img src="images/logo-yahoo-white.svg" class="h-40px" alt="" /></a> 
                        </div>
                    </div>
                    <!-- end client item -->
                    <!-- start client item -->
                    <div class="col">
                        <div class="client-box">
                            <a href="#"><img src="images/logo-monday-white.svg" class="h-40px" alt="" /></a> 
                        </div>
                    </div>
                    <!-- end client item -->
                </div>
            </div>
        </section>
        <!-- end section -->
        <!-- start section -->
        <section class="bg-gradient-tranquil-white overflow-hidden position-relative overlap-height pb-5 md-pb-7 xs-pb-50px">
            <div class="container overlap-gap-section">
                <div class="row justify-content-center align-items-center mb-4 text-center text-md-start">
                    <div class="col-xxl-8 col-md-7 sm-mb-10px">
                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Latest articles</h2>
                    </div>
                    <div class="col-xxl-4 col-md-5 text-center text-md-end" data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <a href="demo-elearning-blog.html" class="btn btn-link btn-hover-animation-switch btn-extra-large text-dark-gray fw-600">
                            <span>
                                <span class="btn-text">Explore all articles</span>
                                <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                                <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                            </span> 
                        </a>
                    </div>
                </div>
                <div class="row">  
                    <div class="col-12">
                        <ul class="blog-masonry blog-wrapper grid-loading grid grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-1col xs-grid-1col gutter-extra-large" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                            <li class="grid-sizer"></li>
                            <!-- start blog item -->
                            <li class="grid-item">
                                <div class="card border-0 border-radius-4px overflow-hidden box-shadow-large box-shadow-extra-large-hover">
                                    <div class="card-top d-flex align-items-center">
                                        <a href="demo-elearning-blog.html"><img src="https://via.placeholder.com/125x125" class="avtar" alt=""></a>
                                        <span class="fs-16">By <a href="demo-elearning-blog.html" class="text-dark-gray fw-600">Andy glamer</a></span>
                                        <div class="like-count ms-auto fs-14">
                                            <a href="#"><i class="fa-regular fa-heart text-red d-inline-block"></i><span class="text-dark-gray fw-600">65</span></a>
                                        </div>
                                    </div>
                                    <div class="blog-image position-relative overflow-hidden">
                                        <a href="demo-elearning-blog-single-simple.html"><img src="https://via.placeholder.com/600x425" alt="" /></a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="post-content p-11 md-p-9">
                                            <a href="demo-elearning-blog-single-simple.html" class="card-title mb-10px fw-600 fs-19 lh-28 text-dark-gray d-inline-block">How to evaluate the effective of training programs.</a>
                                            <p class="mb-0">Lorem ipsum has been industry standard dummy text ever...</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end blog item -->
                            <!-- start blog item -->
                            <li class="grid-item">
                                <div class="card border-0 border-radius-4px overflow-hidden box-shadow-large box-shadow-extra-large-hover">
                                    <div class="card-top d-flex align-items-center">
                                        <a href="demo-elearning-blog.html"><img src="https://via.placeholder.com/125x125" class="avtar" alt=""></a>
                                        <span class="fs-16">By <a href="demo-elearning-blog.html" class="text-dark-gray fw-600">Den viliamson</a></span>
                                        <div class="like-count ms-auto fs-14">
                                            <a href="#"><i class="fa-regular fa-heart text-red d-inline-block"></i><span class="text-dark-gray fw-600">35</span></a>
                                        </div>
                                    </div>
                                    <div class="blog-image position-relative overflow-hidden">
                                        <a href="demo-elearning-blog-single-simple.html"><img src="https://via.placeholder.com/600x425" alt="" /></a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="post-content p-11 md-p-9">
                                            <a href="demo-elearning-blog-single-simple.html" class="card-title mb-10px fw-600 fs-19 lh-28 text-dark-gray d-inline-block">Experience the breathtaking views and perspectives.</a>
                                            <p class="mb-0">Lorem ipsum has been industry standard dummy text ever...</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end blog item -->
                            <!-- start blog item -->
                            <li class="grid-item">
                                <div class="card border-0 border-radius-4px overflow-hidden box-shadow-large box-shadow-extra-large-hover">
                                    <div class="card-top d-flex align-items-center">
                                        <a href="demo-elearning-blog.html"><img src="https://via.placeholder.com/125x125" class="avtar" alt=""></a>
                                        <span class="fs-16">By <a href="demo-elearning-blog.html" class="text-dark-gray fw-600">Jones robbert</a></span>
                                        <div class="like-count ms-auto fs-14">
                                            <a href="#"><i class="fa-regular fa-heart text-red d-inline-block"></i><span class="text-dark-gray fw-600">58</span></a>
                                        </div>
                                    </div>
                                    <div class="blog-image position-relative overflow-hidden">
                                        <a href="demo-elearning-blog-single-simple.html"><img src="https://via.placeholder.com/600x425" alt="" /></a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="post-content p-11 md-p-9">
                                            <a href="demo-elearning-blog-single-simple.html" class="card-title mb-10px fw-600 fs-19 lh-28 text-dark-gray d-inline-block">Build up healthy habits and strong peaceful life.</a>
                                            <p class="mb-0">Lorem ipsum has been industry standard dummy text ever...</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- end blog item -->
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <!-- start features box item -->
                    <div class="col-auto icon-with-text-style-08 md-mb-10px xs-mb-15px pe-25px md-pe-15px" data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <div class="feature-box feature-box-left-icon-middle xs-lh-28">
                            <div class="feature-box-icon me-10px">
                                <i class="feather icon-feather-mail fs-20 text-dark-gray"></i>
                            </div>
                            <div class="feature-box-content">
                                <span class="text-dark-gray fw-500 fs-20 xs-fs-18 ls-minus-05px">Looking for help? <a href="demo-elearning-contact.html" class="text-decoration-line-bottom-medium text-dark-gray fw-600">Contact us today</a></span>
                            </div>
                        </div>
                    </div>
                    <!-- end features box item -->
                    <!-- start features box item -->
                    <div class="col-auto icon-with-text-style-08 ps-25px md-ps-15px md-pe-15px" data-anime='{ "translateX": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <div class="feature-box feature-box-left-icon-middle xs-lh-28">
                            <div class="feature-box-icon me-10px">
                                <i class="feather icon-feather-thumbs-up fs-20 text-dark-gray"></i>
                            </div>
                            <div class="feature-box-content">
                                <span class="text-dark-gray fw-500 fs-20 xs-fs-18 ls-minus-05px">Keep in Touch. <a href="#" class="text-decoration-line-bottom-medium text-dark-gray fw-600">Like us on Facebook</a></span>
                            </div>
                        </div>
                    </div>
                    <!-- end features box item -->
                </div>
            </div>
        </section>
        <!-- end section -->
        <!-- start footer -->
        <footer class="bg-gradient-aztec-green position-relative">
            <div class="position-absolute left-minus-100px top-25px">
                <img src="images/demo-elearning-bg-05.png" alt="" class="w-80">
            </div>
            <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0" style="background-image: url('images/vertical-line-bg-small.svg')"></div>
            <div class="container overlap-section">
                <div class="row g-0 justify-content-center align-items-center text-center bg-base-color border-radius-6px ps-5 pe-5 pt-3 pb-3 mb-8 sm-p-25px background-position-left-bottom background-no-repeat contain-background position-relative" style="background-image: url('images/demo-elearning-bg-06.png')">
                    <!-- start footer column -->
                    <div class="col-lg-auto lg-mb-20px">
                        <h6 class="alt-font fw-600 text-dark-gray m-0 ls-minus-1px d-inline-block me-30px lg-me-0">Admission is open for the next year batch</h6>
                    </div>
                    <!-- end footer column -->
                    <!-- start footer column -->
                    <div class="col-auto">
                        <a href="demo-elearning-contact.html" class="btn btn-extra-large btn-dark-gray btn-rounded btn-box-shadow btn-switch-text d-inline-block me-20px align-middle xs-m-0">
                            <span>
                                <span class="btn-double-text" data-text="Get started now">Get started now</span>
                                <span><i class="feather icon-feather-thumbs-up"></i></span>
                            </span>
                        </a>
                        <span class="d-block d-sm-inline-block text-dark-gray fs-19 fw-600 left-icon d-inline-block align-middle xs-mt-10px ls-minus-05px"><a href="tel:12345678910"><i class="feather icon-feather-phone-call"></i>+1 234 567 8910</a></span>
                    </div>
                    <!-- end footer column -->
                </div>
            </div>
            <div class="container footer-dark text-center text-sm-start position-relative"> 
                <div class="row mb-5 sm-mb-7 xs-mb-30px">
                    <!-- start footer column -->
                    <div class="col-lg-3 col-md-4 col-sm-6 d-flex flex-column last-paragraph-no-margin md-mb-40px xs-mb-30px">
                        <a href="demo-elearning.html" class="footer-logo mb-15px d-inline-block">
                            <img src="images/demo-elearning-footer-logo.png" data-at2x="images/demo-elearning-footer-logo@2x.png" alt="">
                        </a>
                        <p class="lh-28">We are providing high-quality courses for about ten years.</p>
                        <div class="elements-social social-text-style-01 mt-9 xs-mt-15px">
                            <ul class="small-icon light fw-500">
                                <li><a class="facebook" href="https://www.facebook.com/" target="_blank">Fb.</a></li>
                                <li><a class="instagram" href="http://www.instagram.com" target="_blank">Ig.</a></li> 
                                <li><a class="twitter" href="http://www.twitter.com" target="_blank">Tw.</a></li> 
                                <li><a class="behance" href="http://www.behance.com/" target="_blank">Be.</a></li> 
                            </ul>
                        </div>
                    </div>
                    <!-- end footer column -->  
                    <!-- start footer column -->
                    <div class="col-lg-3 col-md-4 col-sm-6 ps-4 last-paragraph-no-margin md-mb-40px xs-mb-30px"> 
                        <span class="fw-500 fs-18 d-block text-white mb-10px">Popular courses</span>
                        <ul>
                            <li><a href="demo-elearning-courses.html">Business finance</a></li>
                            <li><a href="demo-elearning-courses.html">Advanced design</a></li>
                            <li><a href="demo-elearning-courses.html">Web development</a></li>
                            <li><a href="demo-elearning-courses.html">Data visualization</a></li>
                        </ul> 
                    </div>
                    <!-- end footer column -->
                    <!-- start footer column -->
                    <div class="col-lg-3 col-md-4 col-sm-6 last-paragraph-no-margin xs-mb-30px"> 
                        <span class="fw-500 fs-18 d-block text-white mb-10px">Need help?</span>
                        <span class="lh-26 d-block">Call us directly?</span>
                        <span class="text-white d-block mb-10px"><a href="tel:12345678910">+1 234 567 8910 </a><span class="bg-base-color fw-700 text-dark-gray lh-22 text-uppercase border-radius-30px ps-10px pe-10px fs-11 ms-5px d-inline-block align-middle">Free</span></span>
                        <span class="lh-26 d-block">Need support?</span>
                        <a href="mailto:help@domain.com" class="text-white text-decoration-line-bottom">help@domain.com</a>
                    </div>
                    <!-- end footer column -->
                    <!-- start footer column -->
                    <div class="col-lg-3 col-md-12 col-sm-6 text-md-center text-lg-start">
                        <span class="fs-18 fw-500 d-block text-white mb-20px">Subscribe our newsletter</span> 
                        <div class="d-inline-block w-100 newsletter-style-02 position-relative mb-15px">
                            <form action="email-templates/subscribe-newsletter.php" method="post" class="position-relative w-100">
                                <input class="input-small bg-dark-gray border-color-transparent-white-light w-100 fs-14 form-control required" type="email" name="email" placeholder="Enter your email...">
                                <input type="hidden" name="redirect" value="">
                                <button type="submit" aria-label="submit" class="btn pe-20px text-white fs-13 fw-500 lg-ps-15px lg-pe-15px submit">Submit <i class="feather icon-feather-arrow-right submit"></i></button>
                                <div class="form-results border-radius-4px pt-5px pb-5px ps-15px pe-15px fs-14 lh-22 mt-10px w-100 text-center position-absolute d-none"></div>
                            </form>
                        </div>
                        <div class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-sm-start justify-content-lg-start fs-14">
                            <div class="d-inline-block"><i class="line-icon-Handshake me-10px align-middle icon-very-medium"></i>Protecting your privacy</div> 
                        </div>
                    </div>
                    <!-- end footer column -->
                </div> 
                <div class="row align-items-center footer-bottom border-top border-color-transparent-white-light pt-30px g-0">
                    <!-- start footer menu -->
                    <div class="col-xl-7 ps-0 text-center text-xl-start lg-mb-10px"> 
                        <ul class="footer-navbar fs-16 lh-normal"> 
                            <li class="nav-item active"><a href="{{ route('inicio.index')}}" class="nav-link ps-0">Inicio</a></li>
                            <li class="nav-item"><a href="demo-elearning-about.html" class="nav-link">About</a></li>
                            <li class="nav-item"><a href="demo-elearning-courses.html" class="nav-link">Courses</a></li>
                            <li class="nav-item"><a href="demo-elearning-instructors.html" class="nav-link">Instructors</a></li>
                            <li class="nav-item"><a href="demo-elearning-testimonial.html" class="nav-link">Testimonial</a></li>
                            <li class="nav-item"><a href="demo-elearning-blog.html" class="nav-link">Blog</a></li>
                            <li class="nav-item"><a href="demo-elearning-contact.html" class="nav-link">Contact</a></li>
                        </ul>
                    </div> 
                    <!-- end footer menu -->
                    <!-- start copyright -->
                    <div class="col-xl-5 last-paragraph-no-margin text-center text-xl-end">
                        <p class="fs-16">&copy; 2024 Crafto is Proudly Powered by <a href="https://www.themezaa.com/" target="_blank" class="text-white text-decoration-line-bottom">ThemeZaa</a></p>
                    </div>
                    <!-- start copyright -->
                </div>
            </div> 
        </footer>
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
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>