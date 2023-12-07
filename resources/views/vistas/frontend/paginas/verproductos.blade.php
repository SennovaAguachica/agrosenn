@extends('../scripts.frontend.paginas.paginasscript')
@section('titulo')
    <title>Index</title>
@endsection
@section('contenido')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Inicio</a>
                <span></span> Asociaciones
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container mb-30">
            <div class="archive-header-2 text-center">
                <h2 class="mb-50">Productos disponibles</h2>
            </div>
            <div class="row flex-row-reverse">
                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>We found <strong class="text-brand">29</strong> items for you!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid">
                        @foreach ($vendedor->usuario->publicaciones as $publicacion)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a class="btnverimagenes" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal"
                                                data-idpublicacion='{{ $publicacion->id }}'>
                                                <img class="default-img" src="{{ $publicacion->productos->imagen }}"
                                                    alt="" />
                                                <img class="hover-img" src="{{ $publicacion->productos->imagen }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Ver detalles" class="action-btn btnverimagenes"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                data-idpublicacion='{{ $publicacion->id }}'><i class="fi-rs-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <h2><a href="shop-product-right.html">{{ $publicacion->productos->producto }}</a>
                                        </h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">Producto de <a
                                                    href="/verproductos/{{ $vendedor->id }}">{{ $vendedor->nombres }}
                                                    {{ $vendedor->apellidos }}</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$ {{ $publicacion->precios->precio }}</span>
                                                <span class="" style="font-size:12px !important"> X
                                                    {{ $publicacion->unidades->unidad }}</span>
                                            </div>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="add-cart">
                                                <a class="add" href="#"><i class="fa-brands fa-whatsapp"></i> Lo
                                                    quiero! </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                    <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                        <div class="vendor-logo mb-30">
                            <img src="{{ $vendedor->usuario->fotoperfil }}" alt="" />
                        </div>
                        <div class="vendor-info">
                            <h4 class="mb-5"><a href="vendor-details-1.html"
                                    class="text-heading">{{ $vendedor->nombres }}
                                    {{ $vendedor->apellidos }}</a>
                            </h4>
                            <div class="product-rate-cover mb-15">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="vendor-des mb-30">
                                <p class="font-sm text-heading">Got a smooth, buttery spread in your fridge? Chances are
                                    good that it's Good Chef. This brand made Lionto's list of the most popular grocery
                                    brands across the country.</p>
                            </div>
                            <div class="follow-social mb-20">
                                <h6 class="mb-15">Follow Us</h6>
                                <ul class="social-network">
                                    <li class="hover-up">
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/social-tw.svg" alt="" />
                                        </a>
                                    </li>
                                    <li class="hover-up">
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/social-fb.svg" alt="" />
                                        </a>
                                    </li>
                                    <li class="hover-up">
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/social-insta.svg" alt="" />
                                        </a>
                                    </li>
                                    <li class="hover-up">
                                        <a href="#">
                                            <img src="assets/imgs/theme/icons/social-pin.svg" alt="" />
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="vendor-info">
                                <ul class="font-sm mb-20">
                                    <li><img class="mr-5" src="assets/imgs/theme/icons/icon-location.svg"
                                            alt="" /><strong>Address: </strong> <span>5171 W Campbell Ave
                                            undefined, Utah 53127 United States</span></li>
                                    <li><img class="mr-5" src="assets/imgs/theme/icons/icon-contact.svg"
                                            alt="" /><strong>Call Us:</strong><span>(+91) - 540-025-124553</span>
                                    </li>
                                </ul>
                                <a href="vendor-details-1.html" class="btn btn-xs">Contact Seller <i
                                        class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('categoria')
    <div class="header-wrap header-space-between position-relative">
        <div class="logo logo-width-1 d-block d-lg-none">
            <a href="index.html"><img src="{{ asset('assets/images/senova.png') }}" alt="logo" width="20%"
                    style="padding: 0; margin: 0" /></a>
        </div>
        <div class="header-nav d-none d-lg-flex">
            <div class="main-categori-wrap d-none d-lg-block">
                <a class="categories-button-active" href="#">
                    <span class="fi-rs-apps"></span> <span class="et">Todas</span> las categorias <i
                        class="fi-rs-angle-down"></i>
                </a>
                <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                    <div class="d-flex categori-dropdown-inner">
                        <ul class="categorias-desplegable">
                            @foreach ($categorias as $categoria)
                                @if ($categoria->estado === 1)
                                    <li>
                                        <a href="#">
                                            <img class="flex "src="{!! $categoria->icono !!}" />
                                            {{ $categoria->categoria }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                <nav>
                    <ul>
                        <li class="hot-deals"><img src="{{ asset('assetsfront/imgs/theme/icons/icon-hot.svg') }}"
                                alt="Ofertas" /><a href="shop-grid-right.html">Ofertas</a></li>
                        <li>
                            <a href="/index">Inicio</a>
                        </li>
                        <li class="position-static">
                            <a href="#">Mega menú <i class="fi-rs-angle-down"></i></a>
                            <ul class="mega-menu">
                                <li class="sub-mega-menu sub-mega-menu-width-22">
                                    <a class="menu-title" href="#">Frutas y verduras</a>
                                    <ul>
                                        <li><a href="shop-product-right.html">Carne y aves de corral</a></li>
                                        <li><a href="shop-product-right.html">Vegetales frescos</a></li>
                                        <li><a href="shop-product-right.html">Hierbas y condimentos</a></li>
                                        <li><a href="shop-product-right.html">Cortes y brotes</a></li>
                                        <li><a href="shop-product-right.html">Frutas y verduras exóticas</a></li>
                                        <li><a href="shop-product-right.html">Productos envasados</a></li>
                                    </ul>
                                </li>
                                <li class="sub-mega-menu sub-mega-menu-width-22">
                                    <a class="menu-title" href="#">Desayuno y lácteos</a>
                                    <ul>
                                        <li><a href="shop-product-right.html">Leche y leche saborizada</a></li>
                                        <li><a href="shop-product-right.html">Mantequilla y margarina</a></li>
                                        <li><a href="shop-product-right.html">Sustitutos de huevos</a></li>
                                        <li><a href="shop-product-right.html">Mermeladas</a></li>
                                        <li><a href="shop-product-right.html">Crema agria</a></li>
                                        <li><a href="shop-product-right.html">Queso</a></li>
                                    </ul>
                                </li>
                                <li class="sub-mega-menu sub-mega-menu-width-22">
                                    <a class="menu-title" href="#">Carne y mariscos</a>
                                    <ul>
                                        <li><a href="shop-product-right.html">Salchichas para el desayuno</a></li>
                                        <li><a href="shop-product-right.html">Salchichas para la cena</a></li>
                                        <li><a href="shop-product-right.html">Pollo</a></li>
                                        <li><a href="shop-product-right.html">Embutidos rebanados</a></li>
                                        <li><a href="shop-product-right.html">Filetes de captura silvestre</a></li>
                                        <li><a href="shop-product-right.html">Cangrejo y mariscos</a></li>
                                    </ul>
                                </li>
                                <li class="sub-mega-menu sub-mega-menu-width-34">
                                    <div class="menu-banner-wrap">
                                        <a href="shop-product-right.html"><img
                                                src="{{ asset('assetsfront/imgs/banner/banner-menu.png') }}"
                                                alt="Nest" /></a>
                                        <div class="menu-banner-content">
                                            <h4>Ofertas especiales</h4>
                                            <h3>
                                                ¡No te pierdas<br />
                                                las tendencias
                                            </h3>
                                            <div class="menu-banner-price">
                                                <span class="new-price text-success">Ahorra hasta un 50%</span>
                                            </div>
                                            <div class="menu-banner-btn">
                                                <a href="shop-product-right.html">Compra ahora</a>
                                            </div>
                                        </div>
                                        <div class="menu-banner-discount">
                                            <h3>
                                                <span>25%</span>
                                                de descuento
                                            </h3>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="/verasociaciones">Asociaciones <i class="fi-rs-angle-down"></i></a>
                            <ul class="sub-menu">
                                @foreach ($asociaciones as $asociacion)
                                    <li><a href='/vervendedores/{{ $asociacion->id }}'>{{ $asociacion->asociacion }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="page-contact.html">Contacto</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="hotline d-none d-lg-flex">
            <img src="{{ asset('assetsfront/imgs/theme/icons/icon-headphone.svg') }}" alt="línea directa" />
            <p>xxx - xxxxx <span>Soporte</span></p>
        </div>
        <div class="header-action-icon-2 d-block d-lg-none">
            <div class="burger-icon burger-icon-white">
                <span class="burger-icon-top"></span>
                <span class="burger-icon-mid"></span>
                <span class="burger-icon-bottom"></span>
            </div>
        </div>
        <div class="header-action-right d-block d-lg-none">
            <div class="header-action-2">
                <div class="header-action-icon-2">
                    <a href="shop-wishlist.html">
                        <img alt="Nest" src="{{ asset('assetsfront/imgs/theme/icons/icon-heart.svg') }}" />
                        <span class="pro-count white">4</span>
                    </a>
                </div>
                <div class="header-action-icon-2">
                    <a class="mini-cart-icon" href="shop-cart.html">
                        <img alt="Nest" src="{{ asset('assetsfront/imgs/theme/icons/icon-cart.svg') }}" />
                        <span class="pro-count white">2</span>
                    </a>
                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                        <ul>
                            <li>
                                <div class="shopping-cart-img">
                                    <a href="shop-product-right.html"><img alt="Nest"
                                            src="{{ asset('assetsfront/imgs/shop/thumbnail-3.jpg') }}" /></a>
                                </div>
                                <div class="shopping-cart-title">
                                    <h4><a href="shop-product-right.html">Camisas Plain Striola</a></h4>
                                    <h3><span>1 × </span>$800.00</h3>
                                </div>
                                <div class="shopping-cart-delete">
                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                </div>
                            </li>
                            <li>
                                <div class="shopping-cart-img">
                                    <a href="shop-product-right.html"><img alt="Nest"
                                            src="{{ asset('assetsfront/imgs/shop/thumbnail-4.jpg') }}" /></a>
                                </div>
                                <div class="shopping-cart-title">
                                    <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>
                                    <h3><span>1 × </span>$3500.00</h3>
                                </div>
                                <div class="shopping-cart-delete">
                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                </div>
                            </li>
                        </ul>
                        <div class="shopping-cart-footer">
                            <div class="shopping-cart-total">
                                <h4>Total <span>$383.00</span></h4>
                            </div>
                            <div class="shopping-cart-button">
                                <a href="shop-cart.html">Ver carrito</a>
                                <a href="shop-checkout.html">Pago</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
