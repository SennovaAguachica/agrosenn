<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sistema sennova</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assetsfront/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assetsfront/css/plugins/slider-range.css') }}" />
    <link rel="stylesheet" href="{{ asset('assetsfront/css/main.css?v=5.6') }}" />

    {{-- slick CSS --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/nouislider@10.0.0/distribute/nouislider.min.css">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30 divinformacionproducto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="/"><img src="{{ asset('assets/images/senova.png') }}" alt="logo"
                                width="20%" style="padding: 0; margin: 0" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="#">
                                <input type="text" class="inputbuscar" placeholder="Buscar productos..." />
                                <button type="submit" class="btnbuscar"><i class="fi-rs-search"></i></button>
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a href="/login">
                                        <img class="svgInject" alt="Nest"
                                            src="{{ asset('assetsfront/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
                                    <a href="/login"><span class="lable ml-0">Cuenta</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li><a href="/login"><i class="fi fi-rs-user mr-10"></i>Mi Cuenta</a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a class="dropdown-item" href="route('logout')"
                                                        onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                            class="material-icons md-exit_to_app"></i>Cerrar sesión</a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                @yield('categoria')
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="{{ asset('assets/images/senova.png') }}" alt="logo"
                            width="10%" style="padding: 0; margin: 0" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" class="inputbuscar" placeholder="Buscar productos…" />
                        <button type="submit" class="btnbuscar"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- Inicio del menú móvil -->

                    @yield('categoria_movil')
                    <!-- Fin del menú móvil -->
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href="/login"><i class="fi-rs-user"></i>Iniciar Sesión / Registrarse </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--End header-->
    <main class="main">
        @yield('contenido')
    </main>
    <footer class="main">
        <section class="section-padding footer-mid">
        </section>
        <div class="container pb-30">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">&copy; 2023, <strong class="text-brand">Sennova</strong> - Plataforma
                        virtual <br />Todos los derechos reservados</p>
                </div>
            </div>
        </div>

    </footer>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('assetsfront/imgs/theme/loading2.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{ asset('assetsfront/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/slider-range.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/select2.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/chosen.jquery.min.js') }}') }}"></script> --}}
    <script src="{{ asset('assetsfront/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/jquery.elevatezoom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template  JS -->
    <script src="{{ asset('./assetsfront/js/main.js?v=5.6') }}"></script>
    <script src="{{ asset('./assetsfront/js/shop.js?v=5.6') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    {{-- slick script --}}
    @yield('script')
</body>

</html>
