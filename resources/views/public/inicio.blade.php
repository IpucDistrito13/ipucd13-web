<!doctype html>
<html class="no-js" lang="es">

<head>
    <title>{{ $metaData['titulo'] }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="author" content="Distrito 13">
    <meta name="description" content="Iglesia Pentecostal Unida de Colombia - Distrito 13">

    <!-- favicon icon -->
    @include('public.layouts.iconos')

    <!-- slider revolution CSS files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/navigation.css') }}">
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" href="{{ asset('css/vendors.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('demos/corporate/corporate.css') }}" />

    <style>
        .btn.btn-dark-gray {
            background-color: #333333;
            color: var(--white);
        }
    
        .navbar .navbar-nav .dropdown .dropdown-menu {
            background-color: #00338D;
        }
    
        @font-face {
            font-family: 'Myriad Pro Bold';
            src: url('{{ asset('fonts/myriadpro_bold.otf') }}') format('opentype');
            font-weight: bold;
        }
    
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }
    
        .reproductor {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 250px;
            border: 1px solid #fff;
            padding: 20px;
            border-radius: 10px;
            background-color: #00338D;
            z-index: 999;
            color: #fff;
            text-align: center;
            font-family: 'Myriad Pro Bold', Arial, sans-serif;
        }
    
        .titulo {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    
        .controles {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    
        .btn {
            margin: 0 10px;
        }
    
        .icono {
            margin-right: 8px;
        }
    
        .bg-base-color {
            background-color: #f0ab00;
        }
    
        .liveText,
        .text_secccion1,
        .playText {
            font-family: 'Myriad Pro Bold', Arial, sans-serif;
        }
    
        #liveText {
            color: white;
            background-color: red;
            padding: 2px 5px;
            border-radius: 5px;
        }
    
        .btn.btn-base-color {
            background-color: #f00;
            color: var(--white);
            border: 2px solid #f00;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
    
        .btn.btn-base-color:hover {
            background-color: #f00;
            color: var(--white);
            border-color: #f00;
        }
    
        @media only screen and (max-width: 600px) {
            .reproductor {
                width: 70px; /* Ancho del círculo para móviles */
                height: 70px; /* Altura del círculo para móviles */
                padding: 0; /* Elimina el padding */
                border-radius: 50%; /* Forma circular */
                display: flex;
                justify-content: center;
                align-items: center;
            }
    
            .titulo, #liveText, .playText {
                display: none; /* Oculta el texto en móviles */
            }
    
            .icono {
                margin: 0;
                font-size: 24px; /* Tamaño del icono */
            }
        }
    </style>

    {{-- SECCION REPRODUCTOR --}}
    <div class="reproductor">
        <h2 class="titulo">Radio IPUC - <span id="liveText"> Live</span></h2>
        <div class="controles">
            <button class="btn btn-large btn-dark-gray btn-rounded btn-box-shadow btn-switch-text left-icon submit"
                type="button" id="toggle">
                <span>
                    <span id="playIcon" class="icono"><i class="fas fa-play"></i></span>
                    <span id="playText"></span>
                </span>
            </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        const audio = document.createElement("audio");
        audio.controls = false;
        audio.src = "https://play14.tikast.com:22038/stream?type=http&nocache=2126";

        const toggleButton = document.getElementById("toggle");
        const playIcon = document.getElementById("playIcon");
        const playText = document.getElementById("playText");

        toggleButton.addEventListener("click", () => {
            if (audio.paused) {
                audio.play();
                playIcon.innerHTML = '<i class="fas fa-pause"></i>';
                playText.textContent = '';
            } else {
                audio.pause();
                playIcon.innerHTML = '<i class="fas fa-play"></i>';
                playText.textContent = '';
            }
        });
    </script>

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

    <div class="box-layout">
        <!-- start header -->
        <header>
            <!-- start menu -->
            @include('public.layouts.menu')
            <!-- end menu -->

        </header>
        <!-- end header -->
        <!-- start slider -->
        <section id="slider" class="p-0 top-space-margin ">
            <div class="demo-corporate-slider_wrapper fullscreen-container" data-alias="portfolio-viewer"
                data-source="gallery" style="background-color:transparent;padding:0px;">
                <div id="demo-corporate-slider" class="rev_slider bg-regal-blue fullscreenbanner" style="display:none;"
                    data-version="5.3.1.6">
                    <!-- begin slides list -->
                    <ul>
                        <!-- minimum slide structure -->
                        <!-- slider 1 -->
                        <li data-index="rs-01" data-transition="parallaxleft" data-slotamount="default"
                            data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default"
                            data-easeout="default" data-masterspeed="1500" data-rotate="0" data-saveperformance="off"
                            data-title="Crossfit" data-param1="" data-param2="" data-param3="" data-param4=""
                            data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10=""
                            data-description="">
                            <!-- slide's main background image -->
                            <img src="https://ipucd13.nyc3.cdn.digitaloceanspaces.com/public/sliders/pagina/pastores.jpg" alt="Image"
                                data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                class="rev-slidebg" data-no-retina>
                            <!-- start overlay layer -->
                            <div class="tp-caption tp-shape tp-shapewrapper " id="slide-1-layer-01"
                                data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape"
                                data-basealign="slide" data-responsive_offset="off" data-responsive="off"
                                data-frames='[{"delay":0,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                     {"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power4.easeInOut"}]'
                                style="background:rgba(22,35,63,0.1); z-index: 0;">
                            </div>
                            <!-- end overlay layer -->
                            <!-- start shape layer -->
                            <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme bg-regal-blue border-radius-50"
                                id="slide-1-layer-02" data-x="['center','center','center','center']"
                                data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                                data-voffset="['0','0','0','0']" data-width="['900','700','700','600']"
                                data-height="['900','700','700','600']" data-whitespace="nowrap" data-type="shape"
                                data-responsive_offset="on"
                                data-frames='[{"delay":1000,"speed":1000,"frame":"0","from":"x:0px;y:50px;rX:0deg;rY:0deg;rZ:0deg;sX:0.5;sY:0.5;opacity:0;","to":"o:0.5;","ease":"Back.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]" style="z-index: 0;">
                            </div>
                            <!-- end shape layer -->
                            <!-- start shape layer -->
                            <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme bg-regal-blue border-radius-50"
                                id="slide-1-layer-03" data-x="['center','center','center','center']"
                                data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                                data-voffset="['0','0','0','0']" data-width="['1200','1000','900','800']"
                                data-height="['1200','1000','900','800']" data-whitespace="nowrap" data-type="shape"
                                data-responsive_offset="on"
                                data-frames='[{"delay":1300,"speed":1000,"frame":"0","from":"x:0px;y:50px;rX:0deg;rY:0deg;rZ:0deg;sX:0.5;sY:0.5;opacity:0;","to":"o:0.3;","ease":"Back.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]" style="z-index: 0;">
                            </div>
                            <!-- end shape layer -->
                            <!-- start row zone layer -->
                            <div id="rrzm_638" class="rev_row_zone rev_row_zone_middle">
                                <!-- start row layer -->
                                <div class="tp-caption  " id="slide-1-layer-04"
                                    data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']"
                                    data-y="['middle','middle','middle','middle']"
                                    data-voffset="['-426','-426','-426','-426']" data-width="none" data-height="none"
                                    data-whitespace="nowrap" data-type="row" data-columnbreak="3"
                                    data-responsive_offset="on" data-responsive="off"
                                    data-frames='[{"delay":10,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[0,0,0,0]" data-paddingright="[100,75,50,30]"
                                    data-paddingbottom="[0,0,0,0]" data-paddingleft="[100,75,50,30]">
                                    <!-- start column layer -->
                                    <div class="tp-caption" id="slide-1-layer-05"
                                        data-x="['left','left','left','left']"
                                        data-hoffset="['100','100','100','100']" data-y="['top','top','top','top']"
                                        data-voffset="['100','100','100','100']" data-width="none" data-height="none"
                                        data-whitespace="nowrap" data-type="column" data-responsive_offset="on"
                                        data-responsive="off"
                                        data-frames='[{"delay":"+0","speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                        data-columnwidth="100%" data-verticalalign="top"
                                        data-textAlign="['center','center','center','center']">


                                        <!-- end button layer -->
                                    </div>
                                    <!-- end column layer -->
                                </div>
                                <!-- end row layer -->
                            </div>
                            <!-- end row zone layer -->

                        </li>
                        <!-- end slider 1 -->

                        <!-- slider 2 -->
                        <li data-index="rs-02" data-transition="parallaxleft" data-slotamount="default"
                            data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default"
                            data-easeout="default" data-masterspeed="1500" data-rotate="0"
                            data-saveperformance="off" data-title="Crossfit" data-param1="" data-param2=""
                            data-param3="" data-param4="" data-param5="" data-param6="" data-param7=""
                            data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- slide's main background image -->
                            <img src="https://ipucd13.nyc3.cdn.digitaloceanspaces.com/public/sliders/pagina/traslados%20agosto.jpg" alt="Image"
                                data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                class="rev-slidebg" data-no-retina>
                            <!-- start overlay layer -->
                            <div class="tp-caption tp-shape tp-shapewrapper " id="slide-2-layer-01"
                                data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape"
                                data-basealign="slide" data-responsive_offset="off" data-responsive="off"
                                data-frames='[{"delay":0,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                     {"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power4.easeInOut"}]'
                                style="background:rgba(22,35,63,0.1); z-index: 0;">
                            </div>
                            <!-- end overlay layer -->
                            <!-- start shape layer -->
                            <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme bg-regal-blue border-radius-50"
                                id="slide-2-layer-02" data-x="['center','center','center','center']"
                                data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                                data-voffset="['0','0','0','0']" data-width="['900','700','700','600']"
                                data-height="['900','700','700','600']" data-whitespace="nowrap" data-type="shape"
                                data-responsive_offset="on"
                                data-frames='[{"delay":1000,"speed":1000,"frame":"0","from":"x:0px;y:50px;rX:0deg;rY:0deg;rZ:0deg;sX:0.5;sY:0.5;opacity:0;","to":"o:0.5;","ease":"Back.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]" style="z-index: 0;">
                            </div>
                            <!-- end shape layer -->
                            <!-- start shape layer -->
                            <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme bg-regal-blue border-radius-50"
                                id="slide-2-layer-03" data-x="['center','center','center','center']"
                                data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                                data-voffset="['0','0','0','0']" data-width="['1200','1000','900','800']"
                                data-height="['1200','1000','900','800']" data-whitespace="nowrap" data-type="shape"
                                data-responsive_offset="on"
                                data-frames='[{"delay":1300,"speed":1000,"frame":"0","from":"x:0px;y:50px;rX:0deg;rY:0deg;rZ:0deg;sX:0.5;sY:0.5;opacity:0;","to":"o:0.3;","ease":"Back.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]" style="z-index: 0;">
                            </div>
                            <!-- end shape layer -->
                            <!-- start row zone layer -->
                            <div id="rrzm_639" class="rev_row_zone rev_row_zone_middle">
                                <!-- start row layer -->
                                <div class="tp-caption  " id="slide-2-layer-04"
                                    data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']"
                                    data-y="['middle','middle','middle','middle']"
                                    data-voffset="['-426','-426','-426','-426']" data-width="none" data-height="none"
                                    data-whitespace="nowrap" data-type="row" data-columnbreak="3"
                                    data-responsive_offset="on" data-responsive="off"
                                    data-frames='[{"delay":10,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[0,0,0,0]" data-paddingright="[100,75,50,30]"
                                    data-paddingbottom="[0,0,0,0]" data-paddingleft="[100,75,50,30]">
                                    <!-- start column layer -->
                                    <div class="tp-caption" id="slide-2-layer-05"
                                        data-x="['left','left','left','left']"
                                        data-hoffset="['100','100','100','100']" data-y="['top','top','top','top']"
                                        data-voffset="['100','100','100','100']" data-width="none" data-height="none"
                                        data-whitespace="nowrap" data-type="column" data-responsive_offset="on"
                                        data-responsive="off"
                                        data-frames='[{"delay":"+0","speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                        data-columnwidth="100%" data-verticalalign="top"
                                        data-textAlign="['center','center','center','center']">

                                        <!-- end subtitle layer -->

                                    </div>
                                    <!-- end column layer -->
                                </div>
                                <!-- end row layer -->
                            </div>
                            <!-- end row zone layer -->
                            <!-- start beige background layer -->
                            <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme bg-base-color border-radius-50"
                                id="slide-2-layer-10" data-x="['center','center','center','center']"
                                data-hoffset="['510','410','310','0']" data-y="['middle','middle','middle','middle']"
                                data-voffset="['-320','-250','-250','0']" data-width="['122','122','120','120']"
                                data-height="['122','122','120','120']" data-visibility="['on','on','off','off']"
                                data-whitespace="nowrap" data-basealign="grid" data-type="shape"
                                data-responsive_offset="on"
                                data-frames='[{"delay":3500,"speed":1000,"frame":"0","from":"x:0px;y:50px;rX:0deg;rY:0deg;rZ:0deg;sX:0.5;sY:0.5;opacity:0;","to":"o:1;","ease":"Back.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]" style="z-index: 0;">
                            </div>
                            <!-- end beige background layer -->


                        </li>
                        <!-- end slider 2 -->

                        <!-- slider 3 -->
                        <li data-index="rs-03" data-transition="parallaxleft" data-slotamount="default"
                            data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default"
                            data-easeout="default" data-masterspeed="1500" data-rotate="0"
                            data-saveperformance="off" data-title="Crossfit" data-param1="" data-param2=""
                            data-param3="" data-param4="" data-param5="" data-param6="" data-param7=""
                            data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- slide's main background image -->
                            <img src="https://ipucd13.nyc3.cdn.digitaloceanspaces.com/public/sliders/pagina/hasta%20lo%20ultimo.jpg" alt="Image"
                                data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                class="rev-slidebg" data-no-retina>
                            <!-- start overlay layer -->
                            <div class="tp-caption tp-shape tp-shapewrapper " id="slide-3-layer-01"
                                data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape"
                                data-basealign="slide" data-responsive_offset="off" data-responsive="off"
                                data-frames='[{"delay":0,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                     {"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power4.easeInOut"}]'
                                style="background:rgba(22,35,63,0.1); z-index: 0;">
                            </div>
                            <!-- end overlay layer -->
                            <!-- start shape layer -->
                            <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme bg-regal-blue border-radius-50"
                                id="slide-3-layer-02" data-x="['center','center','center','center']"
                                data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                                data-voffset="['0','0','0','0']" data-width="['900','700','700','600']"
                                data-height="['900','700','700','600']" data-whitespace="nowrap" data-type="shape"
                                data-responsive_offset="on"
                                data-frames='[{"delay":1000,"speed":1000,"frame":"0","from":"x:0px;y:50px;rX:0deg;rY:0deg;rZ:0deg;sX:0.5;sY:0.5;opacity:0;","to":"o:0.5;","ease":"Back.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]" style="z-index: 0;">
                            </div>
                            <!-- end shape layer -->
                            <!-- start shape layer -->
                            <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme bg-regal-blue border-radius-50"
                                id="slide-3-layer-03" data-x="['center','center','center','center']"
                                data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                                data-voffset="['0','0','0','0']" data-width="['1200','1000','900','800']"
                                data-height="['1200','1000','900','800']" data-whitespace="nowrap" data-type="shape"
                                data-responsive_offset="on"
                                data-frames='[{"delay":1300,"speed":1000,"frame":"0","from":"x:0px;y:50px;rX:0deg;rY:0deg;rZ:0deg;sX:0.5;sY:0.5;opacity:0;","to":"o:0.3;","ease":"Back.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]" style="z-index: 0;">
                            </div>
                            <!-- end shape layer -->
                            <!-- start row zone layer -->
                            <div id="rrzm_640" class="rev_row_zone rev_row_zone_middle">
                                <!-- start row layer -->
                                <div class="tp-caption  " id="slide-3-layer-04"
                                    data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']"
                                    data-y="['middle','middle','middle','middle']"
                                    data-voffset="['-426','-426','-426','-426']" data-width="none" data-height="none"
                                    data-whitespace="nowrap" data-type="row" data-columnbreak="3"
                                    data-responsive_offset="on" data-responsive="off"
                                    data-frames='[{"delay":10,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[0,0,0,0]" data-paddingright="[100,75,50,30]"
                                    data-paddingbottom="[0,0,0,0]" data-paddingleft="[100,75,50,30]">
                                    <!-- start column layer -->
                                    <div class="tp-caption" id="slide-3-layer-05"
                                        data-x="['left','left','left','left']"
                                        data-hoffset="['100','100','100','100']" data-y="['top','top','top','top']"
                                        data-voffset="['100','100','100','100']" data-width="none" data-height="none"
                                        data-whitespace="nowrap" data-type="column" data-responsive_offset="on"
                                        data-responsive="off"
                                        data-frames='[{"delay":"+0","speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                        data-columnwidth="100%" data-verticalalign="top"
                                        data-textAlign="['center','center','center','center']">


                                    </div>
                                    <!-- end column layer -->
                                </div>
                                <!-- end row layer -->
                            </div>
                            <!-- end row zone layer -->


                        </li>
                    </ul>
                    <div class="tp-bannertimer"
                        style="height: 10px; background-color: rgba(0, 0, 0, 0.10); z-index: 98"></div>
                </div>
            </div>
        </section>
        <!-- end slider -->


        <!-- start section  applicacion -->
        <section class="overflow-hidden">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-7 col-lg-6 text-center md-mb-50px sm-mb-30px"
                        data-anime='{ "el": "childs", "opacity": [0, 1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <div class="position-relative pe-50px lg-pe-0 outside-box-left-10 md-outside-box-left-0 atropos"
                            data-atropos>
                            <div class="atropos-scale">
                                <div class="atropos-rotate">
                                    <div class="atropos-inner text-center w-100 overflow-visible">
                                        <img src="https://via.placeholder.com/835x710" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-11 position-relative"
                        data-anime='{ "el": "childs", "translateX": [30, 0], "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 300, "easing": "easeOutQuad" }'>

                        <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-40px sm-mb-25px mx-auto">Descarga
                            nuestra
                            app</h2>
                        <div class="accordion accordion-style-06 text-start" id="accordion-style-07">
                            <!-- start accordion item -->
                            <div class="accordion-item active-accordion">
                                <div class="accordion-header">
                                    <a href="#" data-bs-toggle="collapse"
                                        data-bs-target="#accordion-style-07-01" aria-expanded="true"
                                        data-bs-parent="#accordion-style-07">
                                        <div
                                            class="accordion-title fs-18 position-relative pe-0 xs-lh-28px text-dark-gray fw-600 mb-0">
                                            Publico general</div>
                                    </a>
                                </div>
                                <div id="accordion-style-07-01" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordion-style-07">
                                    <div class="accordion-body last-paragraph-no-margin">
                                        <p>Visualice tranmisiones en vivo, videos, escucha musica, podcast, eventos por
                                            venir, y mucho mas...</p>
                                        <i class="line-icon-Address-Book icon-extra-double-large opacity-2"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion item -->
                            <!-- start accordion item -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="#" data-bs-toggle="collapse"
                                        data-bs-target="#accordion-style-07-02" aria-expanded="false"
                                        data-bs-parent="#accordion-style-07">
                                        <div
                                            class="accordion-title fs-18 position-relative pe-0 text-dark-gray fw-600 mb-0">
                                            Pastores</div>
                                    </a>
                                </div>
                                <div id="accordion-style-07-02" class="accordion-collapse collapse"
                                    data-bs-parent="#accordion-style-07">
                                    <div class="accordion-body last-paragraph-no-margin">
                                        <p>Informate de primera mano con información privilegiada.</p>
                                        <i class="line-icon-Sand-watch icon-extra-double-large opacity-2"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion item -->
                            <!-- start accordion item -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="#" data-bs-toggle="collapse"
                                        data-bs-target="#accordion-style-07-03" aria-expanded="false"
                                        data-bs-parent="#accordion-style-07">
                                        <div
                                            class="accordion-title fs-18 position-relative pe-0 text-dark-gray fw-600 mb-0">
                                            Lideres</div>
                                    </a>
                                </div>
                                <div id="accordion-style-07-03" class="accordion-collapse collapse"
                                    data-bs-parent="#accordion-style-07">
                                    <div class="accordion-body last-paragraph-no-margin">
                                        <p>Visualice información informacion requerida</p>
                                        <i class="line-icon-Gear-2 icon-extra-double-large opacity-2"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion item -->
                        </div>
                        <a href="#"
                            class="btn btn-extra-large btn-dark-gray btn-box-shadow btn-rounded btn-switch-text mt-30px">
                            <span>
                                <span class="btn-double-text" data-text="Descargar">Play Store</span>
                                <span><i class="fa-solid fa-arrow-right"></i></span>
                            </span>

                        </a>

                        <a href="#"
                            class="btn btn-extra-large btn-dark-gray btn-box-shadow btn-rounded btn-switch-text mt-30px">
                            <span>
                                <span class="btn-double-text" data-text="Descargar">App Store</span>
                                <span><i class="fa-solid fa-arrow-right"></i></span>
                            </span>

                        </a>
                    </div>
                </div>
            </div>

        </section>
        <!-- end section aplicacion -->


        <!-- start section  ultimas publicaciones -->
        <section class="pt-0 ps-15 pe-15 xl-ps-2 xl-pe-2 lg-ps-2 lg-pe-2 sm-mx-0">
            <div class="row justify-content-center align-items-center mb-4 text-center text-md-start">
                <div class="col-xxl-8 col-md-7 sm-mb-10px">
                    <h2 class="alt-font text-dark-gray fw-600 ls-minus-3px mb-0">Últimas publicaciones</h2>
                </div>
                <div class="col-xxl-4 col-md-5 text-center text-md-end"
                    data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <a href="{{ route('public.publicaciones.index') }}"
                        class="btn btn-link btn-hover-animation-switch btn-extra-large text-dark-gray fw-600">
                        <span>
                            <span class="btn-text">Explora todas las publicaciones</span>
                            <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                            <span class="btn-icon"><i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="container-fluid">

                <!-- start row -->
                <div class="row">
                    <div class="col-12">
                        <ul
                            class="blog-classic blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>

                            @foreach ($publicaciones as $publicacion)
                                <!-- start blog item -->
                                <li class="grid-item">
                                    <div class="card bg-transparent border-0 h-100">
                                        <div class="blog-image position-relative overflow-hidden border-radius-4px">
                                            <a href="{{ route('public.publicaciones.show', $publicacion) }}">
                                                <img src="{{ !empty($publicacion->imagen->url) ? Storage::url($publicacion->imagen->url) : asset('img/imagen_not_found_480x640.png') }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="card-body px-0 pt-30px pb-30px">
                                            <span class="fs-13 text-uppercase mb-5px d-block"><a href="blog-grid.html"
                                                    class="text-dark-gray text-dark-gray-hover fw-600 categories-text">{{ $publicacion->comite->nombre }}</a><a
                                                    href="blog-grid.html" class="blog-date text-dark-gray-hover">26
                                                    August 2023</a></span>
                                            <a href="{{ route('public.publicaciones.show', $publicacion) }}"
                                                class="card-title mb-10px fw-600 fs-17 lh-26 text-dark-gray text-dark-gray-hover d-inline-block w-95">{{ $publicacion->titulo }}</a>
                                            <p class="mb-10px w-95">{{ $publicacion->descripcion }}</p>
                                            <a href="{{ route('public.publicaciones.show', $publicacion) }}"
                                                class="card-link alt-font fs-12 text-uppercase text-dark-gray text-dark-gray-hover fw-700">Ver
                                                más<i class="feather icon-feather-arrow-right icon-very-small"></i></a>
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
                                <a href="{{ $youtube }}" target="_blank"
                                    class="text-decoration-line-bottom-medium text-dark-gray fw-600">Youtube</a>
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

        </section>
        <!-- end section ultimas publicaciones -->



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
    </div>
    <!-- javascript libraries -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vendors.min.js') }}"></script>
    <!-- slider revolution core javaScript files -->
    <script type="text/javascript" src="{{ asset('revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <!-- slider revolution extension scripts. ONLY NEEDED FOR LOCAL TESTING -->
    <!-- <script type="text/javascript" src="revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script type="text/javascript" src="revolution/js/extensions/revolution.extension.carousel.min.js"></script>
        <script type="text/javascript" src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
        <script type="text/javascript" src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script type="text/javascript" src="revolution/js/extensions/revolution.extension.migration.min.js"></script>
        <script type="text/javascript" src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <script type="text/javascript" src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>
        <script type="text/javascript" src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script type="text/javascript" src="revolution/js/extensions/revolution.extension.video.min.js"></script> -->

    <!-- Slider's main "init" script -->
    <script>
        var tpj = jQuery;
        var revapi7;
        var $ = jQuery.noConflict();
        tpj(document).ready(function() {
            if (tpj("#demo-corporate-slider").revolution == undefined) {
                revslider_showDoubleJqueryError("#demo-corporate-slider");
            } else {
                revapi7 = tpj("#demo-corporate-slider").show().revolution({
                    sliderType: "standard",
                    /* sets the Slider's default timeline */
                    delay: 9000,
                    /* options are 'auto', 'fullwidth' or 'fullscreen' */
                    sliderLayout: 'fullscreen',
                    /* RESPECT ASPECT RATIO */
                    autoHeight: 'off',
                    /* options that disable autoplay */
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    navigation: {
                        keyboardNavigation: 'on',
                        keyboard_direction: 'horizontal',
                        mouseScrollNavigation: 'off',
                        mouseScrollReverse: 'reverse',
                        onHoverStop: 'off',
                        arrows: {
                            enable: true,
                            style: 'hesperiden',
                            rtl: false,
                            hide_onleave: false,
                            hide_onmobile: true,
                            hide_under: 500,
                            hide_over: 9999,
                            hide_delay: 200,
                            hide_delay_mobile: 1200,
                            left: {
                                container: 'slider',
                                h_align: 'left',
                                v_align: 'center',
                                h_offset: 50,
                                v_offset: 0
                            },
                            right: {
                                container: 'slider',
                                h_align: 'right',
                                v_align: 'center',
                                h_offset: 50,
                                v_offset: 0
                            }
                        },
                        bullets: {

                            enable: true,
                            style: 'hermes',
                            tmp: '',
                            direction: 'horizontal',
                            rtl: false,

                            container: 'layergrid',
                            h_align: 'center',
                            v_align: 'bottom',
                            h_offset: 0,
                            v_offset: 30,
                            space: 12,

                            hide_onleave: false,
                            hide_onmobile: true,
                            hide_under: 0,
                            hide_over: 500,
                            hide_delay: true,
                            hide_delay_mobile: 500

                        },
                        touch: {
                            touchenabled: 'on',
                            touchOnDesktop: "on",
                            swipe_threshold: 75,
                            swipe_min_touches: 1,
                            swipe_direction: 'horizontal',
                            drag_block_vertical: true
                        }
                    },
                    responsiveLevels: [1240, 1024, 768, 480],
                    visibilityLevels: [1240, 1024, 768, 480],
                    gridwidth: [1240, 1024, 768, 480],
                    gridheight: [930, 850, 900, 850],
                    /* Lazy Load options are "all", "smart", "single" and "none" */
                    lazyType: "smart",
                    spinner: "spinner0",
                    parallax: {
                        type: "scroll",
                        origo: "slidercenter",
                        speed: 400,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 5],
                    },
                    shadow: 0,
                    shuffle: "off",
                    fullScreenAutoWidth: "on",
                    fullScreenAlignForce: "on",
                    fullScreenOffsetContainer: "nav",
                    fullScreenOffset: "",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }
        }); /*ready*/
    </script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>

</html>
