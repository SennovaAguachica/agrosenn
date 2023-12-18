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
                        <h1 class="mb-15">{{ $subcategoria->subcategoria }}</h1>
                        <div class="breadcrumb">
                            <a href="/index" rel="nofollow"><i class="fi-rs-home mr-5"></i>Inicio</a>
                            <span></span> Categorias <span></span> Subcategorias <span></span>
                            {{ $subcategoria->subcategoria }}
                        </div>
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
                        <p>Se encontraron <strong class="text-brand">{{ count($publicaciones) }}</strong> productos
                            disponibles!</p>
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
                <div class="product-list mb-50">
                    @foreach ($publicaciones as $publicacion)
                        <div class="product-cart-wrap">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <div class="product-img-inner">
                                        <a class="btnverimagenes" data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                            data-idpublicacion='{{ $publicacion->id }}' data-datos="{{ $publicaciones }}">
                                            <img class="default-img" src="{{ $publicacion->imagenes[0]->ruta }}"
                                                alt="" />
                                            <img class="hover-img" src="{{ $publicacion->imagenes[0]->ruta }}"
                                                alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Ver detalles" class="action-btn btnverimagenes" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal" data-idpublicacion='{{ $publicacion->id }}'
                                        data-datos="{{ $publicaciones }}"><i class="fi-rs-eye"></i></a>
                                </div>
                                {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Hot</span>
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
                                    {{-- <span class="ml-30">500g</span> --}}
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
                                <p class="mt-15 mb-15">{{ $publicacion->productos->descripcion }}</p>
                                <div class="product-price">
                                    <span>$ {{ $publicacion->precios->precio }}</span>
                                    <span class="" style="font-size:12px !important">X
                                        {{ $publicacion->unidades->unidad }}</span>
                                </div>
                                <div class="mt-30 d-flex align-items-center">
                                    <a aria-label="Buy now" class="btn"
                                        href="https://api.whatsapp.com/send?phone={{ $publicacion->usuario->vendedor->n_celular ?? $publicacion->usuario->asociacion->n_celular }}&text=Hola, estoy interesado en el producto {{ $publicacion->productos->producto }} publicado en Agrosenn."
                                        target="_blank"><i class="fa-brands fa-whatsapp fa-xl"></i> Lo
                                        quiero!</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
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
                </div>
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="banner-img mb-30">
                    <img src="assets/imgs/banner/banner-10.jpg" alt="" />
                </div>
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Subcategorias</h5>
                    <ul>
                        @foreach ($subcategoriasConPublicaciones as $subcategoria)
                            <li>
                                <a href="/versubcategorias/{{ $subcategoria->id }}"> <img
                                        src="{{ $subcategoria->imagen }}"
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
                            <a href="/index">Inicio</a>
                        </li>
                        <li class="position-static">
                        <li>
                            <a href="shop-grid-right.html">Mas productos <i class="fi-rs-angle-down"></i></a>
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
                <a href="blog-category-fullwidth.html">Asociaciones</a>
                <ul class="dropdown">
                    @foreach ($asociaciones as $asociacion)
                        <li><a href='/vervendedores/{{ $asociacion->id }}'>{{ $asociacion->asociacion }}</a></li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </nav>
@endsection
