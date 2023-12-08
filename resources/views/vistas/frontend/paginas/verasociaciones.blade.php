@extends('../scripts.frontend.paginas.paginasscript')
@section('titulo')
    <title>Index</title>
@endsection
@section('contenido')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Asociaciones
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="archive-header-2 text-center">
                <h1 class="display-2 mb-50">Lista de asociaciones</h1>
                {{-- <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="sidebar-widget-2 widget_search mb-50">
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" placeholder="Search vendors (by name or ID)..." />
                                    <button type="submit"><i class="fi-rs-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            {{-- <div class="row mb-50">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>We have <strong class="text-brand">780</strong> vendors now</p>
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
                                        <li><a class="active" href="#">Mall</a></li>
                                        <li><a href="#">Featured</a></li>
                                        <li><a href="#">Preferred</a></li>
                                        <li><a href="#">Total items</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row vendor-grid">
                @foreach ($asociaciones as $asociacion)
                    <div class="col-lg-6 col-md-6 col-12 col-sm-6">
                        <div class="vendor-wrap style-2 mb-40">
                            {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                <span class="hot">Mall</span>
                            </div> --}}
                            <div class="vendor-img-action-wrap">
                                <div class="vendor-img" style="text-align: center !important">
                                    <a href="#">
                                        <img class="default-img" src="{{ $asociacion->usuario->fotoperfil }}"
                                            alt="" />
                                    </a>
                                </div>
                                <div class="mt-10">
                                    <span class="font-small total-product">{{ count($asociacion->vendedores) }} vendedores
                                        asociados</span>
                                </div>
                            </div>
                            <div class="vendor-content-wrap">
                                <div class="mb-30">
                                    <div class="product-category">
                                        <span class="text-muted">Desde 2013</span>
                                    </div>
                                    <h4 class="mb-5"><a href="vendor-details-1.html">{{ $asociacion->asociacion }}</a>
                                    </h4>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="vendor-info d-flex justify-content-between align-items-end mt-30">
                                        <ul class="contact-infor text-muted">
                                            <li><img src="assets/imgs/theme/icons/icon-location.svg"
                                                    alt="" /><strong>Dirección: </strong>
                                                <span>{{ $asociacion->direccion }}</span>
                                            </li>
                                            <li><img src="assets/imgs/theme/icons/icon-contact.svg"
                                                    alt="" /><strong>Contacto:</strong><span>(+57) -
                                                    {{ $asociacion->n_celular }} </span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mb-30">
                                    <a href='vervendedores/{{ $asociacion->id }}' class="btn btn-md">Ver
                                        vendedores <i class="fa-solid fa-eye fa-xl"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div> --}}
        </div>
    </div>
@endsection
@section('categoria')
    <div class="header-wrap header-space-between position-relative">
        <div class="logo logo-width-1 d-block d-lg-none">
            <a href="index.html"><img src="assets/images/senova.png" alt="logo" width="20%"
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
                        <li class="hot-deals"><img src="assetsfront/imgs/theme/icons/icon-hot.svg" alt="Ofertas" /><a
                                href="shop-grid-right.html">Ofertas</a></li>
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
                                                src="assetsfront/imgs/banner/banner-menu.png" alt="Nest" /></a>
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
            <img src="assetsfront/imgs/theme/icons/icon-headphone.svg" alt="línea directa" />
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
                        <img alt="Nest" src="assetsfront/imgs/theme/icons/icon-heart.svg" />
                        <span class="pro-count white">4</span>
                    </a>
                </div>
                <div class="header-action-icon-2">
                    <a class="mini-cart-icon" href="shop-cart.html">
                        <img alt="Nest" src="assetsfront/imgs/theme/icons/icon-cart.svg" />
                        <span class="pro-count white">2</span>
                    </a>
                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                        <ul>
                            <li>
                                <div class="shopping-cart-img">
                                    <a href="shop-product-right.html"><img alt="Nest"
                                            src="assetsfront/imgs/shop/thumbnail-3.jpg" /></a>
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
                                            src="assetsfront/imgs/shop/thumbnail-4.jpg" /></a>
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
