@extends('../scripts.frontend.index.indexscript')
@section('titulo')
    <title>Index</title>
@endsection
@section('contenido')
    <section class="home-slider position-relative mb-30">
        <div class="container">
            <div class="home-slide-cover mt-30">
                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                    @foreach ($bannersprincipales as $banner)
                        <div
                            class="single-hero-slider single-animation-wrap d-lg-flex align-items-center justify-content-center">
                            <a href="{{ $banner->enlace }}"><img src="{{ $banner->imagen }}" width="100%" /></a>
                        </div>
                    @endforeach
                    {{-- <div class="single-hero-slider single-animation-wrap"
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
                    </div> --}}
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
                            $numSubcategorias = $item->subcategorias->count();
                        @endphp
                        <div class="card-2 {{ $bgClass }} wow animate__animated animate__fadeInUp"
                            data-wow-delay=".1s">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="/vercategoria/{{ $item->id }}"><img src="{{ $item->imagen }}"
                                        alt="" /></a>
                            </figure>
                            <h6><a href="/vercategoria/{{ $item->id }}">{{ $item->categoria }}</a></h6>
                            <span>{{ $numSubcategorias }} subcategorías</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!--End category slider-->
    <section class="banners mb-25">
        <div class="container">
            <div class="row d-lg-flex align-items-center justify-content-center">
                @foreach ($bannerssecundariosAleatorias as $banner)
                    <div class="col-lg-4 d-md-none d-lg-flex align-items-center justify-content-center">
                        <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp " data-wow-delay=".4s">
                            <a href="{{ $banner->enlace }}"><img src="{{ $banner->imagen }}" alt="" /></a>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <img src="assetsfront/imgs/banner/banner-1.png" alt="" />
                        <div class="banner-text">
                            <h4>
                                Todos los Días Fresco y <br />Limpio con Nuestros<br />
                                Productos
                            </h4>
                            <a href="#" class="btn btn-xs">Comprar Ahora <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div> --}}
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
                                <div class="product-cart-wrap mb-30 animate__animated animate__fadeIn" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="/verpublicacion/{{ $publicacion->id }}">
                                                <img class="default-img" src="{{ $publicacion->imagenes[0]->ruta }}"
                                                    alt="" />
                                                <img class="hover-img" src="{{ $publicacion->imagenes[0]->ruta }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Ver detalles" class="action-btn btnverimagenes"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                data-idpublicacion='{{ $publicacion->id }}'><i class="fi-rs-eye"></i></a>
                                        </div>
                                        {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Caliente</span>
                                                </div> --}}
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a
                                                href="/versubcategoria/{{ $publicacion->productos->subcategoria->id }}">{{ $publicacion->productos->subcategoria->subcategoria }}</a>
                                        </div>
                                        <h2><a
                                                href="/verpublicacion/{{ $publicacion->id }}">{{ $publicacion->productos->producto }}</a>
                                        </h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            @if (isset($publicacion->usuario->vendedor))
                                                <span class="font-small text-muted">Producto de <a
                                                        href="/verproductos/{{ $publicacion->usuario->vendedor->id }}">{{ $publicacion->usuario->vendedor->nombres }}
                                                        {{ $publicacion->usuario->vendedor->apellidos }}</a></span>
                                            @elseif(isset($publicacion->usuario->asociacion))
                                                <span class="font-small text-muted">Producto de <a
                                                        href="/verproductosasociacion/{{ $publicacion->usuario->asociacion->id }}">{{ $publicacion->usuario->asociacion->asociacion }}</a></span>
                                            @endif
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
                                                <a class="add btnverpublicacion"
                                                    href="/verpublicacion/{{ $publicacion->id }}"><i
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
                                                    <a href="/verpublicacion/{{ $publicacion->id }}">
                                                        <img class="default-img"
                                                            src="{{ $publicacion->imagenes[0]->ruta }}" alt="" />
                                                        <img class="hover-img"
                                                            src="{{ $publicacion->imagenes[0]->ruta }}" alt="" />
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Ver detalles" class="action-btn btnverimagenes"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                        data-idpublicacion='{{ $publicacion->id }}'><i
                                                            class="fi-rs-eye"></i></a>
                                                </div>
                                                {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Caliente</span>
                                                </div> --}}
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a
                                                        href="/versubcategoria/{{ $publicacion->productos->subcategoria->id }}">{{ $publicacion->productos->subcategoria->subcategoria }}</a>
                                                </div>
                                                <h2><a
                                                        href="/versubcategoria/{{ $publicacion->id }}">{{ $publicacion->productos->producto }}</a>
                                                </h2>
                                                <div class="product-rate-cover">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                </div>
                                                <div>
                                                    @if (isset($publicacion->usuario->vendedor))
                                                        <span class="font-small text-muted">Producto de <a
                                                                href="/verproductos/{{ $publicacion->usuario->vendedor->id }}">{{ $publicacion->usuario->vendedor->nombres }}
                                                                {{ $publicacion->usuario->vendedor->apellidos }}</a></span>
                                                    @elseif(isset($publicacion->usuario->asociacion))
                                                        <span class="font-small text-muted">Producto de <a
                                                                href="/verproductosasociacion/{{ $publicacion->usuario->asociacion->id }}">{{ $publicacion->usuario->asociacion->asociacion }}</a></span>
                                                    @endif
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
                                                        <a class="add btnverpublicacion"
                                                            href="/verpublicacion/{{ $publicacion->id }}"><i
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
            <a href="/"><img src="{{ asset('assets/images/senova.png') }}" alt="logo" width="20%"
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
                        <ul>
                            @foreach ($categorias->chunk(count($categorias) / 2)[0] as $categoria)
                                @if ($categoria->estado === 1)
                                    <li>
                                        <a href="/vercategoria/{{ $categoria->id }}">
                                            <img src="{!! $categoria->icono !!}" />
                                            {{ $categoria->categoria }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <ul class="end">
                            @foreach ($categorias->chunk(count($categorias) / 2)[1] as $categoria)
                                @if ($categoria->estado === 1)
                                    <li>
                                        <a href="/vercategoria/{{ $categoria->id }}">
                                            <img src="{!! $categoria->icono !!}" />
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
                        <li>
                            <a href="/">Inicio</a>
                        </li>
                        <li class="position-static">
                        <li>
                            <a href="#">Mas productos <i class="fi-rs-angle-down"></i></a>
                            <ul class="sub-menu">
                                @foreach ($categorias as $categoria)
                                    <li>
                                        <a href="/vercategoria/{{ $categoria->id }}">{{ $categoria->categoria }} <i
                                                class="fi-rs-angle-right"></i></a>
                                        <ul class="level-menu">
                                            @foreach ($categoria->subcategorias as $subcategoria)
                                                <li>
                                                    <a
                                                        href="/versubcategoria/{{ $subcategoria->id }}">{{ $subcategoria->subcategoria }}</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
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
                    </ul>
                </nav>
            </div>
        </div>
        <div class="header-action-icon-2 d-block d-lg-none">
            <div class="burger-icon burger-icon-white">
                <span class="burger-icon-top"></span>
                <span class="burger-icon-mid"></span>
                <span class="burger-icon-bottom"></span>
            </div>
        </div>
    </div>
@endsection
@section('categoria_movil')
    <nav>
        <ul class="mobile-menu font-heading">
            <li class="menu-item-has-children">
                <a href="/index">Inicio</a>
            </li>
            <li class="menu-item-has-children">
                <a href="#">Categorias</a>
                <ul class="dropdown">
                    @foreach ($categorias as $categoria)
                        <li class="menu-item-has-children">
                            <a href="/vercategoria/{{ $categoria->id }}">{{ $categoria->categoria }}</a>
                            <ul class="dropdown">
                                @foreach ($categoria->subcategorias as $subcategoria)
                                    <li><a
                                            href="/versubcategoria/{{ $subcategoria->id }}">{{ $subcategoria->subcategoria }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="menu-item-has-children">
                <a href="/verasociaciones">Asociaciones</a>
                <ul class="dropdown">
                    @foreach ($asociaciones as $asociacion)
                        <li><a href='/vervendedores/{{ $asociacion->id }}'>{{ $asociacion->asociacion }}</a></li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </nav>
@endsection
