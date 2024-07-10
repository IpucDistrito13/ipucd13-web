@yield('navbar_principal')

<style>
    @font-face {
    font-family: 'MyriadProBold';
    src: url('fuentes/miriadpro_bold.otf') format('opentype');
}

.navbar-nav .nav-link {
    font-family: 'MyriadProBold', sans-serif;
}

</style>

<header>
    <!-- start navigation -->
    <nav class="navbar navbar-expand-lg header-light bg-white responsive-sticky">
        <div class="container-fluid">
            <div class="col-auto col-lg-2 me-lg-0 me-auto">
                <a class="navbar-brand" href="{{ route('inicio.index') }}">
                    <img src="{{ asset('img/logo-colors.png') }}" data-at2x="{{ asset('img/logo-colors@2x.png') }}"
                        alt="" class="default-logo">
                    <img src="{{ asset('img/logo-colors.png') }}" data-at2x="{{ asset('img/logo-colors@2x.png') }}"
                        alt="" class="alt-logo">
                    <img src="{{ asset('img/logo-colors.png') }}" data-at2x="{{ asset('img/logo-colors@2x.png') }}"
                        alt="" class="mobile-logo">
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
                                    <li class="dropdown"><a
                                            href="{{ route('comite.show', $comite) }}">{{ $comite->nombre }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown simple-dropdown">
                            <a href="#" class="nav-link">Zona D13</a>
                            <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink5"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink5">
                                <li class="dropdown">
                                    <a href="{{ route('public.publicaciones.index') }}">Publicaciones</a>
                                </li>
                                <li class="dropdown"><a href="{{ route('public.series.index') }}">Series</a></li>
                                <li class="dropdown"><a href="{{ route('public.podcasts.index') }}">Podcasts</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="{{ route('public.descargables.index') }}"
                                class="nav-link">Descargables</a></li>
                        <li class="nav-item"><a href="{{ route('public.contacto.index') }}"
                                class="nav-link">Contacto</a></li>
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-auto col-lg-2 text-end d-none d-sm-flex">
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>