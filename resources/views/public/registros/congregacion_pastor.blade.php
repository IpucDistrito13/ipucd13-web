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

        @include('public.layouts.iconos')
    </head>
    <body data-mobile-nav-style="classic">
        <!-- start header -->
        @include('public.layouts.menu')
        <!-- end header -->
        
        <!-- start section -->
        <section>
            <div class="container">
                <div class="row g-0 justify-content-center">
                   
                    <div class="col-lg-6 col-md-10 offset-xl-2 offset-lg-1 p-6 box-shadow-extra-large border-radius-6px" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 600, "delay":150, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <span class="fs-26 xs-fs-24 alt-font fw-600 text-dark-gray mb-20px d-block">IPUC DISTRITO 13 <br> REGISTRO CONGREGACIÓN</span>
                        <form action="email-templates/contact-form.php" method="post">

                            <label class="text-dark-gray mb-10px fw-500">Municipio<span class="text-red">*</span></label>
                            <select class="mb-20px bg-very-light-gray form-control required" name="municipio">
                                @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id }}"
                                    {{ isset($congregacion) && $congregacion->municipio_id == $municipio->id ? 'selected' : '' }}>
                                    {{ $municipio->nombre . ' - ' . $municipio->departamento->nombre }}
                                </option>                                @endforeach
                            </select>

                            <label class="text-dark-gray mb-10px fw-500">Dirección congregación<span class="text-red">*</span></label> 
                            <input class="mb-20px bg-very-light-gray form-control required" type="text" name="direccion" placeholder="Ingresa dirección" />
                    
                            
                    
                            <label class="text-dark-gray mb-10px fw-500">Nombre Congregación<span class="text-red">*</span></label> 
                            <input class="mb-20px bg-very-light-gray form-control required" type="text" name="nombre_congregacion" placeholder="IPUC CENTRAL" />
                    
                            <span class="fs-13 lh-22 w-90 lg-w-100 md-w-90 sm-w-100 d-block mb-30px">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="#" class="text-dark-gray text-decoration-line-bottom fw-500">privacy policy.</a></span>
                            <input type="hidden" name="redirect" value="">
                            <button class="btn btn-medium btn-round-edge btn-base-color btn-box-shadow submit w-100 text-transform-none" type="submit">Register</button>
                            <div class="form-results mt-20px d-none"></div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- end section --> 
        <!-- start footer -->
        <footer class="footer-dark bg-dark-gray pb-0 pt-0 cover-background" style="background-image:url('images/demo-decor-store-footer-bg.jpg')">
            <div class="container pt-4 pb-4 md-pt-45px md-pb-45px">
                <div class="row justify-content-center">
                    <!-- start footer column -->
                    <div class="col-6 col-lg-3 last-paragraph-no-margin order-sm-1 md-mb-50px xs-mb-30px">
                        <a href="demo-decor-store.html" class="footer-logo mb-15px d-inline-block"><img src="images/demo-decor-store-logo-white.png" data-at2x="images/demo-decor-store-logo-white@2x.png" alt=""></a>
                        <p class="w-80 sm-w-100">Lorem ipsum amet adipiscing elit to eiusmod ad tempor.</p>
                        <div class="elements-social social-icon-style-02 mt-15px">
                            <ul class="small-icon light">
                                <li><a class="facebook" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a class="dribbble" href="http://www.dribbble.com" target="_blank"><i class="fa-brands fa-dribbble"></i></a></li> 
                                <li><a class="twitter" href="http://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a></li> 
                                <li><a class="instagram" href="http://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a></li> 
                            </ul>
                        </div>
                    </div>
                    <!-- end footer column -->
                    <!-- start footer column -->
                    <div class="col-6 col-lg-2 col-sm-4 xs-mb-30px order-sm-3 order-lg-2">
                        <span class="fs-16 alt-font fw-500 d-block text-white mb-5px">Categories</span>
                        <ul>
                            <li><a href="demo-decor-store-shop.html">Bed room</a></li>
                            <li><a href="demo-decor-store-shop.html">Living room</a></li>
                            <li><a href="demo-decor-store-shop.html">Lightning</a></li>
                            <li><a href="demo-decor-store-shop.html">Fabrics sofa</a></li>
                        </ul>
                    </div>
                    <!-- end footer column -->
                    <!-- start footer column -->
                    <div class="col-6 col-lg-2 col-sm-4 xs-mb-30px order-sm-3 order-lg-2">
                        <span class="fs-16 alt-font fw-500 d-block text-white mb-5px">Information</span>
                        <ul>
                            <li><a href="demo-decor-store-about.html">About us</a></li>
                            <li><a href="demo-decor-store-contact.html">Contact us</a></li>
                            <li><a href="demo-decor-store-faq.html">FAQs</a></li>
                            <li><a href="demo-decor-store-faq.html">Payment</a></li>
                        </ul>
                    </div>
                    <!-- end footer column -->
                    <!-- start footer column -->
                    <div class="col-6 col-lg-2 col-sm-4 xs-mb-30px order-sm-3 order-lg-2">
                        <span class="fs-16 alt-font fw-500 d-block text-white mb-5px">Account</span>
                        <ul>
                            <li><a href="demo-decor-store-account.html">My account</a></li>
                            <li><a href="demo-decor-store-cart.html">Orders</a></li>
                            <li><a href="demo-decor-store-checkout.html">Checkout</a></li>
                            <li><a href="#">My wishlists</a></li>
                        </ul>
                    </div>
                    <!-- end footer column -->  
                    <!-- start footer column -->
                    <div class="col-lg-3 col-sm-6 ps-20px sm-ps-15px md-mb-50px xs-mb-0 order-sm-2 order-lg-5">
                        <span class="fs-16 alt-font fw-500 d-block text-white mb-5px">Newsletter</span>
                        <div class="mb-20px">Get everything you need succeed!</div>
                        <div class="d-inline-block w-100 newsletter-style-02 position-relative mb-15px"> 
                            <form action="email-templates/subscribe-newsletter.php" method="post" class="position-relative w-100">
                                <input class="bg-blue-tangaroa border-color-transparent-white-light w-100 form-control pe-50px ps-20px lg-ps-15px required" type="email" name="email" placeholder="Enter your email" />
                                <input type="hidden" name="redirect" value="">
                                <button class="btn pe-20px submit" aria-label="submit"><i class="icon feather icon-feather-mail icon-small text-white"></i></button>
                                <div class="form-results border-radius-4px pt-5px pb-5px ps-15px pe-15px fs-14 lh-22 mt-10px w-100 text-center position-absolute d-none"></div>
                            </form>
                        </div>
                        <div class="footer-card">
                            <a href="#" class="d-inline-block me-5px align-middle"><img src="https://via.placeholder.com/55x20" alt=""></a>
                            <a href="#" class="d-inline-block me-5px align-middle"><img src="https://via.placeholder.com/55x20" alt=""></a>
                            <a href="#" class="d-inline-block me-5px align-middle"><img src="https://via.placeholder.com/55x20" alt=""></a>
                            <a href="#" class="d-inline-block me-5px align-middle"><img src="https://via.placeholder.com/55x20" alt=""></a>
                        </div>
                    </div>
                    <!-- end footer column -->                        
                </div>
            </div> 
            <div class="border-top border-color-transparent-white-light pt-30px pb-30px">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-8 last-paragraph-no-margin text-center text-xl-start lg-mt-20px order-3 order-xl-1">
                            <p class="fs-14 mb-0 w-90 xl-w-100">This site is protected by reCAPTCHA and the Google <a href="#" class="text-white text-decoration-line-bottom">privacy policy</a> and terms of service apply.</p>
                            <p class="fs-14 w-90 xl-w-100">&copy; 2024 Crafto is Proudly Powered by <a href="https://www.themezaa.com/" target="_blank" class="text-white text-decoration-line-bottom">ThemeZaa</a></p>
                        </div>
                        <div class="col-6 col-xl-2 col-md-3 col-sm-5 text-center text-xl-start order-1 order-xl-2">
                            <span class="lh-26 alt-font d-block">Need support?</span>
                            <a href="tel:12345678910" class="fs-16 text-white fw-500">+1 234 567 8910</a>
                        </div>
                        <div class="col-6 col-xl-2 col-md-3 col-sm-5 text-center text-xl-start order-2 order-xl-3">
                            <span class="lh-26 alt-font d-block">Customer care</span>
                            <a href="mailto:info@domain.com" class="fs-16 text-white fw-500">info@domain.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->
        <!-- start cookie message -->
        <div id="cookies-model" class="cookie-message bg-dark-gray border-radius-8px"> 
            <div class="cookie-description fs-14 text-white mb-20px lh-22">We use cookies to enhance your browsing experience, serve personalized ads or content, and analyze our traffic. By clicking "Allow cookies" you consent to our use of cookies. </div>   
            <div class="cookie-btn">
                <a href="#" class="btn btn-transparent-white border-1 border-color-transparent-white-light btn-very-small btn-switch-text btn-rounded w-100 mb-15px" aria-label="btn">
                    <span>
                        <span class="btn-double-text" data-text="Cookie policy">Cookie policy</span> 
                    </span>
                </a> 
                <a href="#" class="btn btn-white btn-very-small btn-switch-text btn-box-shadow accept_cookies_btn btn-rounded w-100" data-accept-btn aria-label="text">
                    <span>
                        <span class="btn-double-text" data-text="Allow cookies">Allow cookies</span> 
                    </span>
                </a>
            </div> 
        </div>
        <!-- end cookie message -->
        <!-- start scroll progress -->
        <div class="scroll-progress d-none d-xxl-block">
            <a href="#" class="scroll-top" aria-label="scroll">
                <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
            </a>
        </div>
        <!-- end scroll progress -->
        <!-- javascript libraries -->
        <script type="text/javascript" src="{{ asset('js/jquery.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/vendors.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }} "></script>
    </body>
</html>