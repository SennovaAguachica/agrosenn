@extends('../scripts.frontend.paginas.paginasscript')
@section('titulo')
    <title>Index</title>
@endsection
@section('contenido')
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <h1 class="mb-15">{{ $categoria->categoria }}</h1>
                        <div class="breadcrumb">
                            <a href="/index" rel="nofollow"><i class="fi-rs-home mr-5"></i>Inicio</a>
                            <span></span> Categorias <span></span> {{ $categoria->categoria }}
                        </div>
                    </div>
                    <div class="col-xl-12 text-end d-none d-xl-block">
                        <ul class="tags-list">
                            @foreach ($categoria->subcategorias as $subcategoria)
                                <li class="hover-up">
                                    <a href="/versubcategoria/{{ $subcategoria->id }}"><i
                                            class="fi-rs-cross mr-10"></i>{{ $subcategoria->subcategoria }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>Se encontraron <strong class="text-brand">{{ $publicaciones->total() }}</strong> productos
                            disponibles!</p>
                    </div>
                </div>
                <div class="row product-grid">
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
                                    {{-- <div class="product-action-1">
                                        <a aria-label="Ver detalles" class="action-btn btnverimagenes"
                                            data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                            data-idpublicacion='{{ $publicacion->id }}'
                                            data-datos="{{ $publicaciones }}"><i class="fi-rs-eye"></i></a>
                                    </div> --}}
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
                                    {{-- <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div> --}}
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
                                            <a class="add btnverpublicacion" href="/verpublicacion/{{ $publicacion->id }}"><i
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
                {{ $publicaciones->links('pagination::bootstrap-5') }}
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Subcategorias</h5>
                    <ul>
                        @foreach ($subcategoriasConPublicaciones as $subcategoria)
                            <li>
                                <a href="/versubcategoria/{{ $subcategoria->id }}"> <img src="{{ $subcategoria->imagen }}"
                                        alt="" />{{ $subcategoria->subcategoria }}</a><span
                                    class="count">{{ $subcategoria->npublicaciones }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
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
