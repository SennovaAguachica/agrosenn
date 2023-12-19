@extends('../scripts.frontend.paginas.paginasscript')
@section('titulo')
    <title>Index</title>
@endsection
@section('contenido')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/index" rel="nofollow"><i class="fi-rs-home mr-5"></i>Inicio</a>
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
                            <p>Encontramos <strong
                                    class="text-brand">{{ count($vendedor->usuario->publicaciones) }}</strong> productos
                                disponibles para ti!</p>
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
                                                data-bs-target="#quickViewModal" data-idpublicacion='{{ $publicacion->id }}'
                                                data-datos="{{ $vendedor->usuario->publicaciones }}">
                                                <img class="default-img" src="{{ $publicacion->imagenes[0]->ruta }}"
                                                    alt="" />
                                                <img class="hover-img" src="{{ $publicacion->imagenes[0]->ruta }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Ver detalles" class="action-btn btnverimagenes"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                data-idpublicacion='{{ $publicacion->id }}'
                                                data-datos="{{ $vendedor->usuario->publicaciones }}"><i
                                                    class="fi-rs-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
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
                                                <a class="add" href="/verpublicacion/{{ $publicacion->id }}"><i
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
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                    <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                        <div class="vendor-logo mb-30">
                            <img src="{{ $vendedor->usuario->fotoperfil }}" alt="" />
                        </div>
                        <div class="vendor-info">
                            <h4 class="mb-5"><a href="" class="text-heading">{{ $vendedor->nombres }}
                                    {{ $vendedor->apellidos }}</a>
                            </h4>
                            <div class="product-rate-cover mb-15">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="vendor-des mb-30">
                                <p class="font-sm text-heading">{{ $vendedor->descripcion }}</p>
                            </div>
                            {{-- <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider vendedorslider">
                                    @foreach ($vendedor->usuario->imagenesperfil as $imagen)
                                        <figure class='border-radius-10'
                                            style='height: 300px; display: flex; align-items:center;justify-content: center;'>
                                            <img src="{{ $imagen->imagen }}" alt="product image" />
                                        </figure>
                                    @endforeach
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails vendedorslidernav">
                                    @foreach ($vendedor->usuario->imagenesperfil as $imagen)
                                        <div
                                            style='height: 50px; display: flex; align-items:center;justify-content: center; '>
                                            <img src="{{ $imagen->imagen }}"
                                                style="max-width:50px;"alt="product image" />
                                        </div>
                                    @endforeach
                                </div>
                            </div> --}}
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a class="btnverimagenesvendedor" data-bs-toggle="modal"
                                            data-bs-target="#modalVerImagenes" data-idvendedor='{{ $vendedor->id }}'
                                            data-datos="{{ $vendedor->usuario->imagenes }}">
                                            <img class="default-img"
                                                src="{{ $vendedor->usuario->imagenesperfil[0]->imagen }}"
                                                alt="" />
                                            <img class="hover-img"
                                                src="{{ $vendedor->usuario->imagenesperfil[0]->imagen }}"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Ver detalles" class="action-btn btnverimagenesvendedor"
                                            data-bs-toggle="modal" data-bs-target="#modalVerImagenes"
                                            data-idvendedor='{{ $vendedor->id }}'
                                            data-datos="{{ $vendedor->usuario->imagenesperfil }}"><i
                                                class="fi-rs-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="follow-social mb-20">
                                <h6 class="mb-15">Contactos</h6>
                            </div>
                            <div class="vendor-info">
                                <ul class="font-sm mb-20">
                                    <li><i class="fa-solid fa-location-dot"></i><strong> Dirección: </strong>
                                        <span>{{ $vendedor->direccion }},
                                            {{ $vendedor->municipio->ciudad }} -
                                            {{ $vendedor->municipio->departamento->departamento }}</span>
                                    </li>
                                    <li><i class="fa-solid fa-square-phone"></i><strong> Contacto:</strong><span>(+57)
                                            {{ $vendedor->n_celular }}</span></li>
                                    <li><i class="fa-solid fa-envelope"></i><strong>
                                            E-mail:</strong><span>{{ $vendedor->email }}</span></li>
                                </ul>
                                <button type="submit"
                                    href="https://api.whatsapp.com/send?phone={{ $vendedor->n_celular }}&text=Hola, estoy interesado en sus productos publicados en Agrosenn."
                                    target="_blank" class="button button-add-to-cart"><i
                                        class="fa-brands fa-whatsapp fa-xl"></i> Contactar vendedor</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade custom-modal" id="modalVerImagenes" tabindex="-1" aria-labelledby="modalVerImagenesLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
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
                    </div>
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

