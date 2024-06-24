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

        <style>
            a {
                color: #00008B;
            }
        </style>
    </head>
    <body data-mobile-nav-style="full-screen-menu" data-mobile-nav-bg-color="#00338D"
    class="custom-cursor">

        @include('public.layouts.menu')

        <!-- start section -->
        <section class="top-space-margin right-side-bar">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8 blog-standard md-mb-50px sm-mb-40px">
                        <!-- start blog details  -->
                        <div class="col-12 blog-details mb-12"> 
                            <div class="entry-meta mb-20px fs-15">
                                <span><i class="text-dark-gray feather icon-feather-calendar"></i><a href="#">{{ $publicacion->created_at->format('Y-m-d h:i a') }}</a></span>
                                <span><i class="text-dark-gray feather icon-feather-user"></i><a href="#">{{ $publicacion->user->name }}</a></span>
                                <span><i class="text-dark-gray feather icon-feather-folder"></i><a href="#">{{ $publicacion->comite->nombre }}</a></span> 
                            </div>
                            <h5 class="text-dark-gray fw-600 w-80 sm-w-100 mb-6">{{ $publicacion->titulo }}</h5>
                            
                            <img src="{{ !empty($publicacion->imagen->url) ? Storage::url($publicacion->imagen->url) : asset('img/imagen_not_found_480x640.png') }}" alt="" class="w-100 border-radius-6px mb-7">
                            <p>                {!! $publicacion->contenido !!}                            </p>
                            
                        </div>
                        
                        <!-- end blog details -->
                    </div>
                    <!-- start sidebar -->
                    <aside class="col-12 col-xl-4 col-lg-4 col-md-7 ps-55px xl-ps-50px lg-ps-15px sidebar">

                        <!-- start redes sociale -->
                        <div class="mb-15 md-mb-50px xs-mb-35px elements-social social-icon-style-10">
                            <div class="fw-600 fs-19 lh-22 ls-minus-05px text-dark-gray border-bottom border-color-dark-gray border-2 d-block mb-30px pb-15px position-relative">Mantente conectad@</div>
                            <div class="row row-cols-2 row-cols-lg-2 justify-content-center align-items-center g-0">
                                
                                @foreach ($redes_sociales as $red)
                                    
                                <div class="col border-bottom border-color-extra-medium-gray ps-25px pe-25px xl-ps-15px xl-pe-15px lg-ps-10px lg-pe-10px pt-10px pb-10px">
                                    <a class="youtube text-dark-gray" href="{{ $red->url }}" target="_blank">
                                        <i class="{{ $red->icono }}"></i>
                                        <span class="fw-500">{{ $red->nombre }}</span>
                                    </a> 
                                </div>

                                @endforeach
                                
                            </div>
                        </div>
                        <!-- end redes sociale -->
                    
                        <!-- start comites -->
                        <div class="mb-15 md-mb-50px xs-mb-35px">
                            <div class="fw-600 fs-19 lh-22 ls-minus-05px text-dark-gray border-bottom border-color-dark-gray border-2 d-block mb-30px pb-15px position-relative">Comités</div>
                            <ul class="category-list-sidebar position-relative">

                                
                                @foreach ($comites as $comite)
                                <li class="d-flex align-items-center h-80px cover-background ps-35px pe-35px" style="background-image: url('https://via.placeholder.com/600x144')">
                                    <div class="opacity-medium bg-gradient-dark-transparent"></div>
                                    <a href="{{ route('comite.show', $comite ) }}" class="d-flex align-items-center position-relative w-100 h-100">
                                        <span class="text-white mb-0 fs-20 fw-500 fancy-text-style-4">{{ $comite->nombre }}</span>
                                        <span class="btn text-white position-absolute"><i class="bi bi-arrow-right ms-0 fs-24"></i></span>
                                    </a>
                                </li>
                                
                                @endforeach
                                
                            </ul>
                        </div>
                        <!-- end sidebar -->
                    
                        

                        
                    </aside>
                    <!-- end sidebar -->
                </div>
            </div>
        </section>
        <!-- end section -->
        <!-- start section -->
        <section class="bg-very-light-gray"> 
            <div class="container">
                <div class="row justify-content-center mb-2">
                    <div class="col-12 col-lg-7 text-center">
                        <span class="fs-15 fw-500 text-uppercase d-inline-block">También te puede interesar</span>
                        <h4 class="text-dark-gray fw-600">Artículos Relacionados</h4>
                    </div>
                </div>

                <!-- start row -->
                <div class="row">
                    <div class="col-12">
                        <ul class="blog-classic blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>

                            @foreach ($similares as $similar)

                            <!-- start blog item -->
                            <li class="grid-item">
                                <div class="card bg-transparent border-0 h-100">
                                    <div class="blog-image position-relative overflow-hidden border-radius-4px">
                                        <a href="{{ route('public.publicaciones.show', $similar) }}" >
                                            <img src="{{ !empty($similar->imagen->url) ? Storage::url($similar->imagen->url) : asset('img/imagen_not_found_480x640.png') }}"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="card-body px-0 pt-30px pb-30px">
                                        <span class="fs-13 text-uppercase mb-5px d-block"><a href="blog-grid.html" class="text-dark-gray text-dark-gray-hover fw-600 categories-text">{{ $similar->comite->nombre }}</a>
                                            <a href="blog-grid.html" class="blog-date text-dark-gray-hover">{{ $similar->created_at->format('Y-m-d h:i a') }}</a>
                                        </span>
                                        <a href="{{ route('public.publicaciones.show', $similar) }}" class="card-title mb-10px fw-600 fs-17 lh-26 text-dark-gray text-dark-gray-hover d-inline-block w-95">{{ $similar->titulo }}</a>
                                        <p class="mb-10px w-95">{{ $similar->descripcion }}</p>
                                        <a href="{{ route('public.publicaciones.show', $publicacion) }}" class="card-link alt-font fs-12 text-uppercase text-dark-gray text-dark-gray-hover fw-700">Ver más<i class="feather icon-feather-arrow-right icon-very-small"></i></a>
                                    </div>
                                </div>
                            </li>
                            <!-- end blog item -->
                            @endforeach


                        </ul>
                    </div>
                    
                </div>
                <!-- end row -->

            </div>
        </section>
        <!-- end section -->
        
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
        <script type="text/javascript" src="{{asset('js/jquery.js')}} "></script>
        <script type="text/javascript" src="{{asset('js/vendors.min.js')}} "></script>
        <script type="text/javascript" src="{{asset('js/main.js')}} "></script>
    </body>
</html>