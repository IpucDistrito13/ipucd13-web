<header class="header-with-topbar">

    <!-- start navigation -->
    <nav class="navbar navbar-expand-lg header-light bg-white responsive-sticky">
        <div class="container-fluid">
            <div class="col-auto col-lg-2 me-lg-0 me-auto">
                <a class="navbar-brand" href="demo-accounting.html">
                    <img src="{{ asset('img/logo-black.png') }}" data-at2x="{{ asset('img/logo-black@2x.png')}}" alt="" class="default-logo">
                    <img src="{{ asset('img/logo-black.png') }}" data-at2x="{{ asset('img/logo-black@2x.png')}}" alt="" class="alt-logo">
                    <img src="{{ asset('img/logo-black.png') }}" data-at2x="{{ asset('img/logo-black@2x.png')}}" alt="" class="mobile-logo"> 
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
                    
                    @include('public.layouts.menuitems')

                </div>
            </div>
            <div class="col-auto col-lg-2 text-end d-none d-sm-flex">
                
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>