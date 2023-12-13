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
    <link rel="stylesheet" href="{{ asset('assetsfront/css/main.css?v=5.6') }}" />

    {{-- slick CSS --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
</head>

<body>
    <!-- Modal -->

    {{-- <div class="modal fade custom-modal" id="onloadModal" tabindex="-1" aria-labelledby="onloadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="deal" style="background-image: url('{{ asset('assetsfront/imgs/banner/popup-1.png')">
                        <div class="deal-top">
                            <h6 class="mb-10 text-brand-2">Deal of the Day</h6>
                        </div>
                        <div class="deal-content detail-info">
                            <h4 class="product-title"><a href="shop-product-right.html" class="text-heading">Organic
                                    fruit for your family's health</a></h4>
                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand">$38</span>
                                    <span>
                                        <span class="save-price font-md color3 ml-15">26% Off</span>
                                        <span class="old-price font-md ml-15">$52</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="deal-bottom">
                            <p class="mb-20">Hurry Up! Offer End In:</p>
                            <div class="deals-countdown pl-5" data-countdown="2025/03/25 00:00:00">
                                <span class="countdown-section"><span class="countdown-amount hover-up">03</span><span
                                        class="countdown-period"> days </span></span><span
                                    class="countdown-section"><span class="countdown-amount hover-up">02</span><span
                                        class="countdown-period"> hours </span></span><span
                                    class="countdown-section"><span class="countdown-amount hover-up">43</span><span
                                        class="countdown-period"> mins </span></span><span
                                    class="countdown-section"><span class="countdown-amount hover-up">29</span><span
                                        class="countdown-period"> sec </span></span>
                            </div>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (32 rates)</span>
                                </div>
                            </div>
                            <a href="shop-grid-right.html" class="btn hover-up">Shop Now <i
                                    class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Quick view -->
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
                                    {{-- <figure class="border-radius-10">
                                        <img src="{{ asset('assetsfront/imgs/shop/product-16-2.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('assetsfront/imgs/shop/product-16-1.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('assetsfront/imgs/shop/product-16-3.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('assetsfront/imgs/shop/product-16-4.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('assetsfront/imgs/shop/product-16-5.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('assetsfront/imgs/shop/product-16-6.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('assetsfront/imgs/shop/product-16-7.jpg') }}"
                                            alt="product image" />
                                    </figure> --}}
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    {{-- <div><img src="{{ asset('assetsfront/imgs/shop/thumbnail-3.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('assetsfront/imgs/shop/thumbnail-4.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('assetsfront/imgs/shop/thumbnail-5.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('assetsfront/imgs/shop/thumbnail-6.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('assetsfront/imgs/shop/thumbnail-7.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('assetsfront/imgs/shop/thumbnail-8.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('assetsfront/imgs/shop/thumbnail-9.jpg') }}"
                                            alt="product image" /></div> --}}
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30 divinformacionproducto">
                                {{-- <span class="stock-status out-stock"> Sale Off </span> --}}
                                {{-- <h3 class="title-detail"><a href="shop-product-right.html" class="text-heading">Seeds
                                        of Change Organic Quinoa, Brown</a></h3>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">$38</span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15">26% Off</span>
                                            <span class="old-price font-md ml-15">$52</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="detail-extralink mb-30">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <span class="qty-val">1</span>
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart"><i
                                                class="fi-rs-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div> --}}
                                {{-- <div class="font-xs">
                                    <ul>
                                        <li class="mb-5">Vendor: <span class="text-brand">Nest</span></li>
                                        <li class="mb-5">MFG:<span class="text-brand"> Jun 4.2022</span></li>
                                    </ul>
                                </div> --}}
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="header-area header-style-1 header-height-2">
        {{-- <div class="mobile-promotion">
            <span>Gran inauguración, <strong>hasta un 15%</strong> de descuento en todos los artículos. Solo quedan
                <strong>3 días</strong></span>
        </div> --}}
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
                                {{-- <select class="select-active">
                                    <option>Todas las categorías</option>
                                    <option>Lácteos</option>
                                    <option>Vinos y Alcohol</option>
                                    <option>Ropa y Belleza</option>
                                    <option>Alimentos para Mascotas y Juguetes</option>
                                    <option>Comida Rápida</option>
                                    <option>Materiales para Hornear</option>
                                    <option>Verduras</option>
                                    <option>Mariscos Frescos</option>
                                    <option>Fideos y Arroz</option>
                                    <option>Helados</option>
                                </select> --}}
                                <input type="text" placeholder="Buscar productos..." />
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="search-location">
                                    <form action="#">
                                        <select class="select-active">
                                            <option>Tu localización</option>
                                            <option>Alabama</option>
                                            <option>Alaska</option>
                                            <option>Arizona</option>
                                            <option>Delaware</option>
                                            <option>Florida</option>
                                            <option>Georgia</option>
                                            <option>Hawaii</option>
                                            <option>Indiana</option>
                                            <option>Maryland</option>
                                            <option>Nevada</option>
                                            <option>New Jersey</option>
                                            <option>New Mexico</option>
                                            <option>New York</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="header-action-icon-2">
                                    <a href="shop-compare.html">
                                        <img class="svgInject" alt="Nest"
                                            src="{{ asset('assetsfront/imgs/theme/icons/icon-compare.svg') }}" />
                                        <span class="pro-count blue">3</span>
                                    </a>
                                    <a href="shop-compare.html"><span class="lable ml-0">Comparar</span></a>
                                </div>
                                <div class="header-action-icon-2">
                                    <a href="shop-wishlist.html">
                                        <img class="svgInject" alt="Nest"
                                            src="{{ asset('assetsfront/imgs/theme/icons/icon-heart.svg') }}" />
                                        <span class="pro-count blue">6</span>
                                    </a>
                                    <a href="shop-wishlist.html"><span class="lable">Favoritos</span></a>
                                </div>
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="shop-cart.html">
                                        <img alt="Nest"
                                            src="{{ asset('assetsfront/imgs/theme/icons/icon-cart.svg') }}" />
                                        <span class="pro-count blue">2</span>
                                    </a>
                                    <a href="shop-cart.html"><span class="lable">Carrito</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul>
                                            <li>
                                                <div class="shopping-cart-img">
                                                    <a href="shop-product-right.html"><img alt="Nest"
                                                            src="{{ asset('assetsfront/imgs/shop/thumbnail-3.jpg') }}" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="shop-product-right.html">Bolso Casual Daisy</a></h4>
                                                    <h4><span>1 × </span>$800.00</h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="shopping-cart-img">
                                                    <a href="shop-product-right.html"><img alt="Nest"
                                                            src="{{ asset('assetsfront/imgs/shop/thumbnail-2.jpg') }}" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="shop-product-right.html">Camisas de Corduroy</a></h4>
                                                    <h4><span>1 × </span>$3200.00</h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span>$4000.00</span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="shop-cart.html" class="outline">Ver carrito</a>
                                                <a href="shop-checkout.html">Pagar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                            <li><a href="#"><i
                                                        class="fi fi-rs-location-alt mr-10"></i>Seguimiento de
                                                    Pedidos</a></li>
                                            <li><a href="#"><i class="fi fi-rs-label mr-10"></i>Mis Cupones</a>
                                            </li>
                                            <li><a href="#"><i class="fi fi-rs-heart mr-10"></i>Mi Lista de
                                                    Deseos</a></li>
                                            <li><a href="#"><i
                                                        class="fi fi-rs-settings-sliders mr-10"></i>Configuración</a>
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
                    <a href="/"><img src="{{ asset('assets/images/senova.png') }}" alt="logo"
                            width="20%" style="padding: 0; margin: 0" /></a>
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
                        <input type="text" placeholder="Buscar productos…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- Inicio del menú móvil -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li class="menu-item-has-children">
                                <a href="/">Inicio</a>
                                <ul class="dropdown">
                                    <li><a href="index.html">Inicio 1</a></li>
                                    <li><a href="index-2.html">Inicio 2</a></li>
                                    <li><a href="index-3.html">Inicio 3</a></li>
                                    <li><a href="index-4.html">Inicio 4</a></li>
                                    <li><a href="index-5.html">Inicio 5</a></li>
                                    <li><a href="index-6.html">Inicio 6</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="shop-grid-right.html">Tienda</a>
                                <ul class="dropdown">
                                    <li><a href="shop-grid-right.html">Tienda - Barra lateral derecha</a></li>
                                    <li><a href="shop-grid-left.html">Tienda - Barra lateral izquierda</a></li>
                                    <li><a href="shop-list-right.html">Lista de tiendas - Barra lateral derecha</a>
                                    </li>
                                    <li><a href="shop-list-left.html">Lista de tiendas - Barra lateral izquierda</a>
                                    </li>
                                    <li><a href="shop-fullwidth.html">Tienda - Ancho completo</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Producto Individual</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Producto - Barra lateral derecha</a>
                                            </li>
                                            <li><a href="shop-product-left.html">Producto - Barra lateral izquierda</a>
                                            </li>
                                            <li><a href="shop-product-full.html">Producto - Sin barra lateral</a></li>
                                            <li><a href="shop-product-vendor.html">Producto - Información del
                                                    vendedor</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="shop-filter.html">Tienda - Filtro</a></li>
                                    <li><a href="shop-wishlist.html">Tienda - Lista de deseos</a></li>
                                    <li><a href="shop-cart.html">Tienda - Carrito</a></li>
                                    <li><a href="shop-checkout.html">Tienda - Pago</a></li>
                                    <li><a href="shop-compare.html">Tienda - Comparar</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Factura de la Tienda</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-invoice-1.html">Factura de la Tienda 1</a></li>
                                            <li><a href="shop-invoice-2.html">Factura de la Tienda 2</a></li>
                                            <li><a href="shop-invoice-3.html">Factura de la Tienda 3</a></li>
                                            <li><a href="shop-invoice-4.html">Factura de la Tienda 4</a></li>
                                            <li><a href="shop-invoice-5.html">Factura de la Tienda 5</a></li>
                                            <li><a href="shop-invoice-6.html">Factura de la Tienda 6</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Vendedores</a>
                                <ul class="dropdown">
                                    <li><a href="vendors-grid.html">Vendedores - Cuadrícula</a></li>
                                    <li><a href="vendors-list.html">Vendedores - Lista</a></li>
                                    <li><a href="vendor-details-1.html">Detalles del Vendedor 01</a></li>
                                    <li><a href="vendor-details-2.html">Detalles del Vendedor 02</a></li>
                                    <li><a href="vendor-dashboard.html">Tablero del Vendedor</a></li>
                                    <li><a href="vendor-guide.html">Guía del Vendedor</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Mega menú</a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children">
                                        <a href="#">Moda Femenina</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Vestidos</a></li>
                                            <li><a href="shop-product-right.html">Blusas y Camisas</a></li>
                                            <li><a href="shop-product-right.html">Sudaderas con Capucha y Sudaderas</a>
                                            </li>
                                            <li><a href="shop-product-right.html">Conjuntos de Mujer</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Moda Masculina</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Chaquetas</a></li>
                                            <li><a href="shop-product-right.html">Cuero Sintético Casual</a></li>
                                            <li><a href="shop-product-right.html">Cuero Genuino</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Tecnología</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Laptops para Juegos</a></li>
                                            <li><a href="shop-product-right.html">Laptops Ultraslim</a></li>
                                            <li><a href="shop-product-right.html">Tablets</a></li>
                                            <li><a href="shop-product-right.html">Accesorios para Laptops</a></li>
                                            <li><a href="shop-product-right.html">Accesorios para Tablets</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="blog-category-fullwidth.html">Blog</a>
                                <ul class="dropdown">
                                    <li><a href="blog-category-grid.html">Blog - Categoría en Cuadrícula</a></li>
                                    <li><a href="blog-category-list.html">Blog - Categoría en Lista</a></li>
                                    <li><a href="blog-category-big.html">Blog - Categoría Grande</a></li>
                                    <li><a href="blog-category-fullwidth.html">Blog - Categoría de Ancho Completo</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Diseño de Producto Individual</a>
                                        <ul class="dropdown">
                                            <li><a href="blog-post-left.html">Barra lateral izquierda</a></li>
                                            <li><a href="blog-post-right.html">Barra lateral derecha</a></li>
                                            <li><a href="blog-post-fullwidth.html">Sin barra lateral</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Páginas</a>
                                <ul class="dropdown">
                                    <li><a href="page-about.html">Acerca de Nosotros</a></li>
                                    <li><a href="page-contact.html">Contacto</a></li>
                                    <li><a href="page-account.html">Mi Cuenta</a></li>
                                    <li><a href="page-login.html">Iniciar Sesión</a></li>
                                    <li><a href="page-register.html">Registrarse</a></li>
                                    <li><a href="page-forgot-password.html">Olvidé mi contraseña</a></li>
                                    <li><a href="page-reset-password.html">Restablecer contraseña</a></li>
                                    <li><a href="page-purchase-guide.html">Guía de Compra</a></li>
                                    <li><a href="page-privacy-policy.html">Política de Privacidad</a></li>
                                    <li><a href="page-terms.html">Términos de Servicio</a></li>
                                    <li><a href="page-404.html">Página 404</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Idioma</a>
                                <ul class="dropdown">
                                    <li><a href="#">Inglés</a></li>
                                    <li><a href="#">Francés</a></li>
                                    <li><a href="#">Alemán</a></li>
                                    <li><a href="#">Español</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- Fin del menú móvil -->
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href="page-contact.html"><i class="fi-rs-marker"></i> Nuestra ubicación </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="/login"><i class="fi-rs-user"></i>Iniciar Sesión / Registrarse </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Síguenos</h6>
                    <a href="#"><img src="{{ asset('assetsfront/imgs/theme/icons/icon-facebook-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img src="{{ asset('assetsfront/imgs/theme/icons/icon-twitter-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img src="{{ asset('assetsfront/imgs/theme/icons/icon-instagram-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img src="{{ asset('assetsfront/imgs/theme/icons/icon-pinterest-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img src="{{ asset('assetsfront/imgs/theme/icons/icon-youtube-white.svg') }}"
                            alt="" /></a>
                </div>
                <div class="site-copyright">Derechos de autor 2022 © Nest. Todos los derechos reservados. Desarrollado
                    por AliThemes.</div>
            </div>
        </div>
    </div>

    <!--End header-->
    <main class="main">
        {{-- <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Inicio</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div> --}}
        {{-- <div class="page-content pt-150 pb-150"> --}}
        {{-- <div class="container"> --}}
        @yield('contenido')
        {{-- </div>
        </div> --}}
    </main>
    <footer class="main">
        {{-- <section class="newsletter mb-15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="position-relative newsletter-inner">
                            <div class="newsletter-content">
                                <h2 class="mb-20">
                                    Stay home & get your daily <br />
                                    needs from our shop
                                </h2>
                                <p class="mb-45">Start You'r Daily Shopping with <span class="text-brand">Nest
                                        Mart</span></p>
                                <form class="form-subcriber d-flex">
                                    <input type="email" placeholder="Your emaill address" />
                                    <button class="btn" type="submit">Subscribe</button>
                                </form>
                            </div>
                            <img src="{{ asset('assetsfront/imgs/banner/banner-13.png" alt="newsletter" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="featured section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                            <div class="banner-icon">
                                <img src="{{ asset('assetsfront/imgs/theme/icons/icon-1.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Best prices & offers</h3>
                                <p>Orders $50 or more</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                            <div class="banner-icon">
                                <img src="{{ asset('assetsfront/imgs/theme/icons/icon-2.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Free delivery</h3>
                                <p>24/7 amazing services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                            <div class="banner-icon">
                                <img src="{{ asset('assetsfront/imgs/theme/icons/icon-3.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Great daily deal</h3>
                                <p>When you sign up</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                            <div class="banner-icon">
                                <img src="{{ asset('assetsfront/imgs/theme/icons/icon-4.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Wide assortment</h3>
                                <p>Mega Discounts</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                            <div class="banner-icon">
                                <img src="{{ asset('assetsfront/imgs/theme/icons/icon-5.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Easy returns</h3>
                                <p>Within 30 days</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                        <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                            <div class="banner-icon">
                                <img src="{{ asset('assetsfront/imgs/theme/icons/icon-6.svg" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Safe delivery</h3>
                                <p>Within 30 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <section class="section-padding footer-mid">
            {{-- <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col">
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0">
                            <div class="logo mb-30">
                                <a href="index.html" class="mb-15"><img src="{{ asset('assetsfront/imgs/theme/logo.svg"
                                        alt="logo" /></a>
                                <p class="font-lg text-heading">Awesome grocery store website template</p>
                            </div>
                            <ul class="contact-infor">
                                <li><img src="{{ asset('assetsfront/imgs/theme/icons/icon-location.svg"
                                        alt="" /><strong>Address: </strong> <span>5171 W Campbell Ave undefined
                                        Kent, Utah 53127 United States</span></li>
                                <li><img src="{{ asset('assetsfront/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Call
                                        Us:</strong><span>(+91) - 540-025-124553</span></li>
                                <li><img src="{{ asset('assetsfront/imgs/theme/icons/icon-email-2.svg"
                                        alt="" /><strong>Email:</strong><span>sale@Nest.com</span></li>
                                <li><img src="{{ asset('assetsfront/imgs/theme/icons/icon-clock.svg"
                                        alt="" /><strong>Hours:</strong><span>10:00 - 18:00, Mon - Sat</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">Company</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Delivery Information</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Support Center</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">Account</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Sign In</a></li>
                            <li><a href="#">View Cart</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="#">Help Ticket</a></li>
                            <li><a href="#">Shipping Details</a></li>
                            <li><a href="#">Compare products</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">Corporate</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Become a Vendor</a></li>
                            <li><a href="#">Affiliate Program</a></li>
                            <li><a href="#">Farm Business</a></li>
                            <li><a href="#">Farm Careers</a></li>
                            <li><a href="#">Our Suppliers</a></li>
                            <li><a href="#">Accessibility</a></li>
                            <li><a href="#">Promotions</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">Popular</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Milk & Flavoured Milk</a></li>
                            <li><a href="#">Butter and Margarine</a></li>
                            <li><a href="#">Eggs Substitutes</a></li>
                            <li><a href="#">Marmalades</a></li>
                            <li><a href="#">Sour Cream and Dips</a></li>
                            <li><a href="#">Tea & Kombucha</a></li>
                            <li><a href="#">Cheese</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget widget-install-app col">
                        <h4 class="widget-title">Install App</h4>
                        <p class="wow fadeIn animated">From App Store or Google Play</p>
                        <div class="download-app">
                            <a href="#" class="hover-up mb-sm-2 mb-lg-0"><img class="active"
                                    src="{{ asset('assetsfront/imgs/theme/app-store.jpg" alt="" /></a>
                            <a href="#" class="hover-up mb-sm-2"><img src="{{ asset('assetsfront/imgs/theme/google-play.jpg"
                                    alt="" /></a>
                        </div>
                        <p class="mb-20">Secured Payment Gateways</p>
                        <img class="wow fadeIn animated" src="{{ asset('assetsfront/imgs/theme/payment-method.png" alt="" />
                    </div>
                </div>
            </div> --}}
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
                {{-- <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                    <div class="hotline d-lg-inline-flex mr-30">
                        <img src="{{ asset('assetsfront/imgs/theme/icons/phone-call.svg" alt="línea directa" />
                        <p>1900 - 6666<span>Horario de atención: 8:00 - 22:00</span></p>
                    </div>
                    <div class="hotline d-lg-inline-flex">
                        <img src="{{ asset('assetsfront/imgs/theme/icons/phone-call.svg" alt="línea directa" />
                        <p>1900 - 8888<span>Centro de Soporte 24/7</span></p>
                    </div>
                </div> --}}
                {{-- <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <div class="mobile-social-icon">
                        <h6>Síguenos</h6>
                        <a href="#"><img src="{{ asset('assetsfront/imgs/theme/icons/icon-facebook-white.svg"
                                alt="" /></a>
                        <a href="#"><img src="{{ asset('assetsfront/imgs/theme/icons/icon-twitter-white.svg"
                                alt="" /></a>
                        <a href="#"><img src="{{ asset('assetsfront/imgs/theme/icons/icon-instagram-white.svg"
                                alt="" /></a>
                        <a href="#"><img src="{{ asset('assetsfront/imgs/theme/icons/icon-pinterest-white.svg"
                                alt="" /></a>
                        <a href="#"><img src="{{ asset('assetsfront/imgs/theme/icons/icon-youtube-white.svg"
                                alt="" /></a>
                    </div>
                     <p class="font-sm">Hasta un 15% de descuento en tu primera suscripción</p> 
                </div> --}}
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
