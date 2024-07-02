<!doctype html>
<html class="no-js" lang="es">

<head>
    <title>{{ $metaData['title'] }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="{{ $metaData['author'] }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="{{ $metaData['description'] }}">
    <meta name="robots" content="noindex">
    <!-- favicon icon -->
    @include('public.layouts.iconos')

    <style>
        .podcast-row:hover {
            box-shadow: 0 0 10px #00338d;
            /* Color: #00338d */
        }
    </style>

</head>

<body data-mobile-nav-style="full-screen-menu" data-mobile-nav-bg-color="#00338D" class="custom-cursor">
    <!-- start cursor -->
    <div class="cursor-page-inner">
        <div class="circle-cursor circle-cursor-inner"></div>
        <div class="circle-cursor circle-cursor-outer"></div>
    </div>
    <!-- end cursor -->

    @include('public.layouts.menu')

    

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
