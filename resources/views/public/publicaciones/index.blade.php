<!doctype html>
<html class="no-js" lang="en">
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
        <link rel="stylesheet" href="{{ asset('demos/elearning/elearning.css')}}" />
    </head>
    <body class="bg-very-light-gray" data-mobile-nav-style="classic">
        <!-- start header -->
        @include('public.layouts.menu')
        <!-- end header -->

<!-- start page title -->
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
            <h1 class="mb-20px alt-font text-yellow">Text</h1>
            <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">Publicaciones</h2>
        </div>
    </div>
</div>
</section>
<!-- end page title -->
<br>


        <!-- start section -->
        <section class="pt-0 ps-11 pe-11 xl-ps-2 xl-pe-2"> 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <ul class="blog-grid blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>
                            <!-- start blog item -->
                           @foreach ($publicaciones as $publicacion)
                               
                           <li class="grid-item">
                            <div class="card border-0 border-radius-4px box-shadow-extra-large box-shadow-extra-large-hover">
                                <div class="blog-image">
                                    <a href="{{ route('public.publicaciones.show', $publicacion) }}" class="d-block">
                                        <img src="{{ !empty($publicacion->imagen->url) ? Storage::url($publicacion->imagen->url) : 'https://i.ibb.co/YcvYfpx/640x480.png' }}" alt="" />
                                    </a>
                                                                        <div class="blog-categories">
                                        <a href="#" class="categories-btn bg-white text-dark-gray text-dark-gray-hover text-uppercase alt-font fw-700">{{ $publicacion->comite->nombre }}</a>
                                    </div>
                                </div>
                                <div class="card-body p-12">
                                    <a href="{{ route('public.publicaciones.show', $publicacion) }}" class="card-title mb-15px fw-600 fs-17 lh-26 text-dark-gray text-dark-gray-hover d-inline-block">{{ $publicacion->titulo }}</a>
                                    <p>{{ $publicacion->descripcion }}</p>
                                    <div class="author d-flex justify-content-center align-items-center position-relative overflow-hidden fs-14 text-uppercase">
                                        <div class="me-auto">
                                            <span class="blog-date fw-500 d-inline-block"> {{ $publicacion->created_at }}</span>
                                            <div class="d-inline-block author-name">By <a href="#" class="text-dark-gray text-dark-gray-hover text-decoration-line-bottom fw-600">{{ $publicacion->user->name }}</a></div>
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
                    <div class="col-12 mt-4 d-flex justify-content-center">
                        <ul class="pagination pagination-style-01 fs-13 fw-500 mb-0">
                            <!-- Previous Page Link -->
                            <li class="page-item {{ $publicaciones->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $publicaciones->previousPageUrl() }}">
                                    <i class="feather icon-feather-arrow-left fs-18 d-xs-none"></i>
                                </a>
                            </li>
                    
                            <!-- Pagination Elements -->
                            @foreach ($publicaciones->getUrlRange(max(1, $publicaciones->currentPage() - 2), min($publicaciones->lastPage(), $publicaciones->currentPage() + 2)) as $page => $url)
                                <li class="page-item {{ $page == $publicaciones->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                    
                            <!-- Next Page Link -->
                            <li class="page-item {{ $publicaciones->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $publicaciones->nextPageUrl() }}">
                                    <i class="feather icon-feather-arrow-right fs-18 d-xs-none"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>  
            </div>
        </section>
        <!-- end section -->
        <!-- start footer -->
        <footer class="footer-demo bg-dark-slate-blue pb-4 sm-pb-50px" style="background-image: url(images/demo-footer-pattern.svg)">
            <div class="container">
                <div class="row mb-6 md-mb-30px">
                    <div class="col-xl-5 col-lg-6 md-mb-30px text-center text-lg-start">
                        <h3 class="text-white fw-600 alt-font mb-40px ls-minus-1px md-mb-30px md-w-60 sm-w-70 xs-w-100 md-mx-auto">Craft a standout website with crafto.</h3>
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 xs-mb-20px">
                                <span class="alt-font fs-14 fw-600 text-uppercase d-block text-white ls-1px lh-18">Presale questions</span>
                                <a href="mailto:info@themezaa.com">info@themezaa.com</a>
                            </div>
                            <div class="col-lg-5 col-sm-6">
                                <span class="alt-font fs-14 fw-600 text-uppercase d-block text-white ls-1px lh-18">Getting started</span>
                                <a href="https://themeforest.net/user/themezaa/portfolio" target="_blank">Purchase on Envato</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6 offset-xl-1 text-center text-lg-start">
                        <span class="alt-font fs-14 fw-600 text-uppercase text-white ls-1px d-block mb-5px">Useful links</span>
                        <ul>
                            <li><a href="https://craftohtml.themezaa.com/documentation/" target="_blank">Documentation</a></li>
                            <li><a href="https://www.themezaa.com/support/" target="_blank">Support center</a></li>
                            <li><a href="https://www.youtube.com/channel/UCxIgqIkSGVVqEsm-HE-tadQ/" target="_blank">Video tutorials</a></li>
                            <li><a href="https://themeforest.net/user/themezaa/portfolio" target="_blank">Envato portfolio</a></li>
                            <li><a href="https://www.themezaa.com/theme-customization/" target="_blank">Customization</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 text-center text-lg-start">
                        <span class="alt-font fs-14 fw-600 text-uppercase text-white ls-1px d-block mb-5px">Follow Us</span>
                        <ul>
                            <li><a href="https://www.facebook.com/themezaastudio/" target="_blank">Facebook</a></li>
                            <li><a href="https://www.twitter.com/themezaa" target="_blank">Twitter</a></li>
                            <li><a href="https://www.dribbble.com/linksture" target="_blank">Dribbble</a></li> 
                            <li><a href="https://www.youtube.com/channel/UCxIgqIkSGVVqEsm-HE-tadQ/" target="_blank">Youtube</a></li>
                            <li><a href="https://www.linkedin.com/company/themezaa/" target="_blank">Linkedin</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 order-first order-lg-4 text-center text-lg-start md-mb-20px">
                        <a href="index.html" class="footer-logo"><img src="images/logo-white-demo.png" data-at2x="images/logo-white-demo@2x.png" alt=""></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 last-paragraph-no-margin text-center text-lg-start">
                        <p class="fs-13 lh-22 w-90 md-w-100">ThemeZaa - The best WordPress, Shopify and Magento themes and plugins provider. We design and develop quality themes and plugins to create your awesome website.</p>
                    </div>
                    <div class="col-lg-5 text-center text-lg-end md-mt-15px last-paragraph-no-margin">
                        <p class="fs-13 lh-22">&copy; 2024 Crafto is Powered by <a href="https://www.themezaa.com/" target="_blank" class="text-decoration-line-bottom text-white">ThemeZaa</a></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->
        <!-- javascript libraries -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/vendors.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>