@extends('../scripts.frontend.paginas.paginasscript')
@section('titulo')
    <title>Index</title>
@endsection
@section('contenido')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Inicio</a>
                <span></span> Asociaciones
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="archive-header-2 text-center">
            <h2 class="mb-50">Vendedores asociados</h2>
        </div>
        <div class="row flex-row-reverse">
            {{-- <div class="col-lg-4-5">
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
                </div> --}}
                <div class="row product-grid">
                    @foreach ($vendedores as $vendedor)
                        <div class="col-lg-6 col-md-6 col-12 col-sm-6">
                            <div class="vendor-wrap style-2 mb-40">
                                <div class="vendor-img-action-wrap">
                                    <div class="vendor-img">
                                        {{-- <a href="#">
                                            <img class="default-img" src="{{ $vendedor->usuario->fotoperfil }}"
                                                alt="" />
                                        </a> --}}

                                        @if ($vendedor->usuario->fotoperfil)
                                        <img class="img-lg mb-3 img-avatar" id="userPhoto" name="userPhoto"
                                            src="{{ $vendedor->usuario->fotoperfil }}" alt="User Photo" />
                                        @else
                                        <img class="img-lg mb-3 img-avatar" id="userPhoto" name="userPhoto"
                                            src="{{ asset('assetsweb/imgs/people/avatar-2.png') }}"
                                            alt="User Photo" />
                                        @endif
                                    </div>
                                    
                                    <div class="mt-10">
                                        {{-- <span
                                            class="font-small total-product">{{ count($vendedor->usuario->publicaciones) }}
                                            productos ofertados</span> --}}
                                            <span class="font-small total-product">
                                                {{ $vendedor->usuario->publicaciones->filter(function ($publicacion) {
                                                    return $publicacion->estado == 1;
                                                })->count() }}
                                                productos ofertados
                                            </span>
                                    </div>
                                </div>
                                <div class="vendor-content-wrap">
                                    <div class="mb-30">
                                        <h4 class="mb-5"><a href="">{{ $vendedor->nombres }}
                                                {{ $vendedor->apellidos }}</a>
                                        </h4>
                                        {{-- <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div> --}}
                                        <div class="vendor-info d-flex justify-content-between align-items-end mt-30">
                                            <ul class="contact-infor text-muted">
                                                <li><img src="assets/imgs/theme/icons/icon-location.svg"
                                                        alt="" /><strong>Dirección: </strong>
                                                    <span>{{ $vendedor->direccion }}</span>
                                                </li>
                                                <li><img src="assets/imgs/theme/icons/icon-contact.svg"
                                                        alt="" /><strong>Contacto:</strong><span>(+57) -
                                                        {{ $vendedor->n_celular }} </span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-30">
                                        <a href='/verproductos/{{ $vendedor->id }}' class="btn btn-md">Ver
                                            productos <i class="fa-solid fa-right-long fa-xl"></i></a>
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
                        <img src="{{ $asociacion->usuario->fotoperfil }}" alt="" />
                    </div>
                    <div class="vendor-info">
                        <h4 class="mb-5"><a href="/vervendedores/{{ $asociacion->id }}"
                                class="text-heading">{{ $asociacion->asociacion }}</a>
                        </h4>
                        {{-- <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                        </div> --}}
                        <div class="vendor-des mb-30">
                            <p class="font-sm text-heading">
                                <pre style="white-space: pre-wrap;">{{ $asociacion->descripcion }}</pre>
                            </p>
                        </div>
                        <div class="vendor-info">
                            <ul class="font-sm mb-20">
                                <li><i class="fa-solid fa-location-dot"></i><strong> Dirección: </strong>
                                    <span>{{ $asociacion->direccion }},
                                        {{ $asociacion->municipio->ciudad }}
                                        -
                                        {{ $asociacion->municipio->departamento->departamento }}</span>
                                </li>
                                <li><i class="fa-solid fa-square-phone"></i><strong> Contacto:</strong><span>(+57)
                                        {{ $asociacion->n_celular }}</span>
                                </li>
                                <li><i class="fa-solid fa-envelope"></i><strong> E-mail:</strong><span>
                                        {{ $asociacion->email }}</span>
                                </li>
                            </ul>
                            {{-- <a href="#" class="btn btn-xs">Contact Seller <i
                                    class="fi-rs-arrow-small-right"></i></a> --}}
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
