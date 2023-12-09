@extends('../scripts.frontend.index.indexscript')
@section('titulo')
    <title>Index</title>
@endsection
@section('contenido')
    <section class="home-slider position-relative mb-30">
        <div class="container">
            <div class="home-slide-cover mt-30">
                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                    <div class="single-hero-slider single-animation-wrap"
                        style="background-image: url(assetsfront/imgs/slider/slider-1.png)">
                        <div class="slider-content">
                            <h1 class="display-2 mb-40">
                                No te pierdas increíbles<br />
                                ofertas de comestibles
                            </h1>
                            <p class="mb-65">Regístrate para el boletín diario</p>
                            <form class="form-subcriber d-flex">
                                <input type="email" placeholder="Tu dirección de correo electrónico" />
                                <button class="btn" type="submit">Suscribirse</button>
                            </form>
                        </div>
                    </div>
                    <div class="single-hero-slider single-animation-wrap"
                        style="background-image: url(assetsfront/imgs/slider/slider-2.png)">
                        <div class="slider-content">
                            <h1 class="display-2 mb-40">
                                Verduras frescas<br />
                                Gran descuento
                            </h1>
                            <p class="mb-65">Ahorra hasta un 50% en tu primer pedido</p>
                            <form class="form-subcriber d-flex">
                                <input type="email" placeholder="Tu dirección de correo electrónico" />
                                <button class="btn" type="submit">Suscribirse</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
            </div>
        </div>
    </section>

    <section class="popular-categories section-padding">
        <div class="container wow animate__animated animate__fadeIn">
            <div class="section-title">
                <div class="title">
                    <h3>Categorías ofertadas</h3>
                    <ul class="list-inline nav nav-tabs links">

                    </ul>
                </div>
                <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow"
                    id="carausel-10-columns-arrows"></div>
            </div>
            <div class="carausel-10-columns-cover position-relative">
                <div class="carausel-10-columns" id="carausel-10-columns">
                    @foreach ($categorias as $item)
                        @php
                            // Obtiene el índice actual del bucle + 9 para que esté en el rango de 9 a 15
                            $bgClass = 'bg-' . (($loop->index % 7) + 9);
                        @endphp
                        <div class="card-2 {{ $bgClass }} wow animate__animated animate__fadeInUp"
                            data-wow-delay=".1s">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img src="{{ $item->imagen }}" alt="" /></a>
                            </figure>
                            <h6><a href="shop-grid-right.html">{{ $item->categoria }}</a></h6>
                            <span>26 artículos</span>
                        </div>
                    @endforeach
                    {{-- <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="assetsfront/imgs/shop/cat-13.png" alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">Pastel & Leche</a></h6>
                        <span>26 artículos</span>
                    </div>
                    <div class="card-2 bg-10 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="assetsfront/imgs/shop/cat-12.png" alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">Kiwi Orgánico</a></h6>
                        <span>28 artículos</span>
                    </div>
                    <div class="card-2 bg-11 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="assetsfront/imgs/shop/cat-11.png" alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">Durazno</a></h6>
                        <span>14 artículos</span>
                    </div>
                    <div class="card-2 bg-12 wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="assetsfront/imgs/shop/cat-9.png" alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">Manzana Roja</a></h6>
                        <span>54 artículos</span>
                    </div>
                    <div class="card-2 bg-13 wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="assetsfront/imgs/shop/cat-3.png" alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">Snacks</a></h6>
                        <span>56 artículos</span>
                    </div>
                    <div class="card-2 bg-14 wow animate__animated animate__fadeInUp" data-wow-delay=".6s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="assetsfront/imgs/shop/cat-1.png" alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">Verduras</a></h6>
                        <span>72 artículos</span>
                    </div>
                    <div class="card-2 bg-15 wow animate__animated animate__fadeInUp" data-wow-delay=".7s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="assetsfront/imgs/shop/cat-2.png" alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">Fresas</a></h6>
                        <span>36 artículos</span>
                    </div>
                    <div class="card-2 bg-12 wow animate__animated animate__fadeInUp" data-wow-delay=".8s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="assetsfront/imgs/shop/cat-4.png" alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">Ciruela Negra</a></h6>
                        <span>123 artículos</span>
                    </div>
                    <div class="card-2 bg-10 wow animate__animated animate__fadeInUp" data-wow-delay=".9s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="assetsfront/imgs/shop/cat-5.png"
                                    alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">Chirimoya</a></h6>
                        <span>34 artículos</span>
                    </div>
                    <div class="card-2 bg-12 wow animate__animated animate__fadeInUp" data-wow-delay="1s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="assetsfront/imgs/shop/cat-14.png"
                                    alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">Café & Té</a></h6>
                        <span>89 artículos</span>
                    </div>
                    <div class="card-2 bg-11 wow animate__animated animate__fadeInUp" data-wow-delay="0s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="assetsfront/imgs/shop/cat-15.png"
                                    alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">Auriculares</a></h6>
                        <span>87 artículos</span>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!--End category slider-->
    <section class="banners mb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <img src="assetsfront/imgs/banner/banner-1.png" alt="" />
                        <div class="banner-text">
                            <h4>
                                Todos los Días Fresco y <br />Limpio con Nuestros<br />
                                Productos
                            </h4>
                            <a href="shop-grid-right.html" class="btn btn-xs">Comprar Ahora <i
                                    class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <img src="assetsfront/imgs/banner/banner-2.png" alt="" />
                        <div class="banner-text">
                            <h4>
                                Haz tu Desayuno<br />
                                Saludable y Fácil
                            </h4>
                            <a href="shop-grid-right.html" class="btn btn-xs">Comprar Ahora <i
                                    class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-md-none d-lg-flex">
                    <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <img src="assetsfront/imgs/banner/banner-3.png" alt="" />
                        <div class="banner-text">
                            <h4>Los Mejores Productos<br />Orgánicos en Línea</h4>
                            <a href="shop-grid-right.html" class="btn btn-xs">Comprar Ahora <i
                                    class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--End banners-->
    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 animate__animated animate__fadeIn">
                <h3>Productos Populares</h3>
                <ul class="nav nav-tabs links" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nav-tab-all" data-bs-toggle="tab" data-bs-target="#tab-all"
                            type="button" role="tab" aria-controls="tab-all" aria-selected="true">Todos</button>
                    </li>
                    @foreach ($subcategoriasAleatorias as $key => $subcategoria)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-{{ $subcategoria->id }}" data-bs-toggle="tab"
                                data-bs-target="#tab-{{ $subcategoria->id }}" type="button" role="tab"
                                aria-controls="tab-{{ $subcategoria->id }}"
                                aria-selected="true">{{ $subcategoria->subcategoria }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-all" role="tabpanel" arialabelledby="tab-all">
                    <div class="row product-grid-4">
                        @foreach ($publicaciones as $publicacion)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 animate__animated animate__fadeIn"
                                    data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a class="btnverimagenes" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal"
                                                data-idpublicacion='{{ $publicacion->id }}'>
                                                <img class="default-img" src="{{ $publicacion->imagenes[0]->ruta }}"
                                                    alt="" />
                                                <img class="hover-img" src="{{ $publicacion->imagenes[0]->ruta }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Ver detalles" class="action-btn btnverimagenes" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal" data-idpublicacion='{{ $publicacion->id }}'><i
                                                    class="fi-rs-eye"></i></a>
                                        </div>
                                        {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Caliente</span>
                                                </div> --}}
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a
                                                href="#">{{ $publicacion->productos->subcategoria->subcategoria }}</a>
                                        </div>
                                        <h2><a href="#">{{ $publicacion->productos->producto }}</a>
                                        </h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">Producto de <a
                                                     href="/verproductos/{{ $publicacion->usuario->vendedor->id }}">{{ $publicacion->usuario->vendedor->nombres }}
                                                    {{ $publicacion->usuario->vendedor->apellidos }}</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$ {{ $publicacion->precios->precio }}</span>
                                                <span class="" style="font-size:12px !important">X
                                                    {{ $publicacion->unidades->unidad }}</span>
                                            </div>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="add-cart">
                                                <a class="add" href="#"><i
                                                        class="fa-brands fa-whatsapp fa-xl"></i>
                                                    Lo
                                                    quiero! </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @foreach ($subcategoriasAleatorias as $subcategoria)
                    <div class="tab-pane fade" id="tab-{{ $subcategoria->id }}" role="tabpanel"
                        arialabelledby="tab-{{ $subcategoria->id }}">
                        <div class="row product-grid-4">
                            @foreach ($publicaciones as $publicacion)
                                @if ($publicacion->productos->subcategoria_id == $subcategoria->id)
                                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap mb-30 animate__animated animate__fadeIn"
                                            data-wow-delay=".1s">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img"
                                                            src="{{ $publicacion->imagenes[0]->ruta }}" alt="" />
                                                        <img class="hover-img"
                                                            src="{{ $publicacion->imagenes[0]->ruta }}" alt="" />
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Vista rápida" class="action-btn"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                            class="fi-rs-eye"></i></a>
                                                </div>
                                                {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Caliente</span>
                                                </div> --}}
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a
                                                        href="shop-grid-right.html">{{ $publicacion->productos->subcategoria->subcategoria }}</a>
                                                </div>
                                                <h2><a
                                                        href="shop-product-right.html">{{ $publicacion->productos->producto }}</a>
                                                </h2>
                                                <div class="product-rate-cover">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                </div>
                                                <div>
                                                    <span class="font-small text-muted">Producto de <a
                                                            href="vendor-details-1.html">{{ $publicacion->usuario->vendedor->nombres }}
                                                            {{ $publicacion->usuario->vendedor->apellidos }}</a></span>
                                                </div>
                                                <div class="product-card-bottom">
                                                    <div class="product-price">
                                                        <span>$ {{ $publicacion->precios->precio }}</span>
                                                        <span class="" style="font-size:12px !important">X
                                                            {{ $publicacion->unidades->unidad }}</span>
                                                    </div>
                                                </div>
                                                <div class="product-card-bottom">
                                                    <div class="add-cart">
                                                        <a class="add" href="#"><i
                                                                class="fa-brands fa-whatsapp fa-xl"></i>
                                                            Lo
                                                            quiero! </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
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
                                        <a href="/vercategoria/{{ $categoria->id }}">
                                            <img class="flex "src="{!! $categoria->icono !!}" />
                                            {{ $categoria->categoria }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>


                        {{-- <ul>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/category-1.svg" alt="" />Lácteos</a>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/category-2.svg" alt="" />Ropa y belleza</a>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/category-3.svg" alt="" />Alimentos para mascotas y juguetes</a>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/category-4.svg" alt="" />Material para hornear</a>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/category-5.svg" alt="" />Frutas frescas</a>
                        </li>
                    </ul>
                    <ul class="end">
                        <li>
                            <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/category-6.svg" alt="" />Vinos y bebidas</a>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/category-7.svg" alt="" />Mariscos frescos</a>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/category-8.svg" alt="" />Comida rápida</a>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/category-9.svg" alt="" />Vegetales</a>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/category-10.svg" alt="" />Pan y jugo</a>
                        </li>
                    </ul> 
                </div>
                <div class="more_slide_open" style="display: none">
                    <div class="d-flex categori-dropdown-inner">
                        <ul>
                            <li>
                                <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/icon-1.svg" alt="" />Lácteos</a>
                            </li>
                            <li>
                                <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/icon-2.svg" alt="" />Ropa y belleza</a>
                            </li>
                        </ul>
                        <ul class="end">
                            <li>
                                <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/icon-3.svg" alt="" />Vinos y bebidas</a>
                            </li>
                            <li>
                                <a href="shop-grid-right.html"> <img src="assetsfront/imgs/theme/icons/icon-4.svg" alt="" />Mariscos frescos</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Mostrar más...</span></div> --}}
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
