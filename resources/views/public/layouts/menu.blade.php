@yield('navbar_principal')

<header>
    <!-- start navigation -->
    <nav class="navbar navbar-expand-lg header-light bg-white responsive-sticky">
        <div class="container-fluid">
            <div class="col-auto col-lg-2 me-lg-0 me-auto">
                <a class="navbar-brand" href="{{ route('inicio.index')}} ">
                    <img src="{{ asset('img/logo-black.png') }}" data-at2x="{{ asset('img/logo-black@2x.png')}}" alt="" class="default-logo">
                    <img src="{{ asset('img/logo-black.png') }}" data-at2x="{{ asset('img/logo-black@2x.png')}}" alt="" class="alt-logo">
                    <img src="{{ asset('img/logo-black.png') }}" data-at2x="{{ asset('img/logo-black@2x.png')}}" alt="" class="mobile-logo"> 
                </a>
            </div>
            <div class="col-auto menu-order position-static">
                <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    <ul class="navbar-nav alt-font">
                        <li class="nav-item"><a href="{{ route('inicio.index') }}" class="nav-link">Inicio</a></li>
                        <li class="nav-item dropdown dropdown-with-icon">
                            <a href="#" class="nav-link">Calendario</a>
                            <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a href="{{ route('public.eventos.index') }}"><i class="bi bi-laptop"></i>
                                        <div class="submenu-icon-content">
                                            <span>Eventos</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('public.cronogramas.index') }}"><i class="bi bi-briefcase"></i>
                                        <div class="submenu-icon-content">
                                            <span>Cronograma distrital</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown simple-dropdown">
                            <a href="#" class="nav-link">Comités</a>
                            <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink5"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink5">
                                @foreach ($comites as $comite)
                                <li class="dropdown"><a href="{{ route('comite.show', $comite ) }}">{{ $comite->nombre }}</a></li>

                                @endforeach
                                {{-- 
                                    <li class="dropdown"><a href="#">Misiones Extranjeras</a></li>
                                <li class="dropdown"><a href="#">Misión Juvenil</a></li>
                                <li class="dropdown"><a href="#">Instituto Biblico</a></li>
                                <li class="dropdown"><a href="#">Jovenes D13</a></li>
                                <li class="dropdown"><a href="#">Música D13</a></li>
                                <li class="dropdown"><a href="#">Refam</a></li>
                                <li class="dropdown"><a href="#">BIS</a></li>
                                <li class="dropdown"><a href="">Corpertunida</a></li>
                                <li class="dropdown"><a href="#">Esfom</a></li>
                                <li class="dropdown"><a href="#">Damas Dorcas D13</a></li>
                                <li class="dropdown"><a href="#">Red de Familia</a></li>
                                <li class="dropdown"><a href="#">Obra Social</a></li>
                                <li class="dropdown"><a href="#">Escuela Dominical D13</a></li>
                                <li class="dropdown"><a href="#">Obra Carcelaria D13</a></li>
                                <li class="dropdown"><a href="#">FECP</a></li>
                                <li class="dropdown"><a href="#">Artística</a></li>
                                --}}

                            </ul>
                        </li>


                        <li class="nav-item"><a href="{{ route('public.descargables.index') }}"
                                class="nav-link">Descargables</a></li>
                        <li class="nav-item"><a href="{{ route('public.publicaciones.index') }}"
                                class="nav-link">Publicaciones</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('public.contacto.index') }}" class="nav-link">Contacto</a>
                        </li>

                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-auto col-lg-2 text-end d-none d-sm-flex">

            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>
