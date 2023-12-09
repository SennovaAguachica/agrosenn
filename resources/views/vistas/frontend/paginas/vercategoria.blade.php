@extends('../scripts.frontend.paginas.paginasscript')
@section('titulo')
    <title>Index</title>
@endsection
@section('contenido')
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">{{ $categoria->categoria }}</h1>
                        <div class="breadcrumb">
                            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Inicio</a>
                            <span></span> Categorias <span></span> {{ $categoria->categoria }}
                        </div>
                    </div>
                    <div class="col-xl-9 text-end d-none d-xl-block">
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
                        <p>Se encontraron <strong class="text-brand">{{ count($publicaciones) }}</strong> productos
                            disponibles!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Ver:</span>
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
                    @foreach ($publicaciones as $publicacion)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 animate__animated animate__fadeIn" data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a class="btnverimagenes" data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                            data-idpublicacion='{{ $publicacion->id }}' data-datos="{{$publicaciones}}">
                                            <img class="default-img" src="{{ $publicacion->imagenes[0]->ruta }}"
                                                alt="" />
                                            <img class="hover-img" src="{{ $publicacion->imagenes[0]->ruta }}"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Ver detalles" class="action-btn btnverimagenes"
                                            data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                            data-idpublicacion='{{ $publicacion->id }}' data-datos="{{$publicaciones}}"><i class="fi-rs-eye"></i></a>
                                    </div>
                                    {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Caliente</span>
                                                </div> --}}
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="#">{{ $publicacion->productos->subcategoria->subcategoria }}</a>
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
                                            <a class="add" href="#"><i class="fa-brands fa-whatsapp fa-xl"></i>
                                                Lo
                                                quiero! </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--product grid-->
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
                {{-- <section class="section-padding pb-5">
                    <div class="section-title">
                        <h3 class="">Deals Of The Day</h3>
                        <a class="show-all" href="shop-grid-right.html">
                            All Deals
                            <i class="fi-rs-angle-right"></i>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="assets/imgs/banner/banner-5.png" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="shop-product-right.html">Seeds of Change Organic Quinoa, Brown</a>
                                        </h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a
                                                    href="vendor-details-1.html">NestFood</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$32.85</span>
                                                <span class="old-price">$33.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="assets/imgs/banner/banner-6.png" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2026/04/25 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="shop-product-right.html">Perdue Simply Smart Organics Gluten</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Old
                                                    El Paso</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$24.85</span>
                                                <span class="old-price">$26.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 d-none d-lg-block">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="assets/imgs/banner/banner-7.png" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2027/03/25 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="shop-product-right.html">Signature Wood-Fired Mushroom</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (3.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a
                                                    href="vendor-details-1.html">Progresso</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$12.85</span>
                                                <span class="old-price">$13.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 d-none d-xl-block">
                            <div class="product-cart-wrap style-2">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="assets/imgs/banner/banner-8.png" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2025/02/25 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="shop-product-right.html">Simply Lemonade with Raspberry Juice</a>
                                        </h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (3.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a
                                                    href="vendor-details-1.html">Yoplait</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$15.85</span>
                                                <span class="old-price">$16.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
                <!--End Deals-->
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
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
                <!-- Fillter By Price -->
                <div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-30">Fill by price</h5>
                    <div class="price-filter">
                        <div class="price-filter-inner">
                            <div id="slider-range" class="mb-20"></div>
                            <div class="d-flex justify-content-between">
                                <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong>
                                </div>
                                <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="list-group">
                        <div class="list-group-item mb-10 mt-10">
                            <label class="fw-900">Color</label>
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1"
                                    value="" />
                                <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2"
                                    value="" />
                                <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3"
                                    value="" />
                                <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                            </div>
                            <label class="fw-900 mt-15">Item Condition</label>
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11"
                                    value="" />
                                <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21"
                                    value="" />
                                <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished
                                        (27)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31"
                                    value="" />
                                <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                            </div>
                        </div>
                    </div> --}}
                    <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>
                        Fillter</a>
                </div>
                <!-- Product sidebar Widget -->
                <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="assets/imgs/shop/thumbnail-3.jpg" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h5><a href="shop-product-detail.html">Chen Cardigan</a></h5>
                            <p class="price mb-0 mt-5">$99.50</p>
                            <div class="product-rate">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="assets/imgs/shop/thumbnail-4.jpg" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h6><a href="shop-product-detail.html">Chen Sweater</a></h6>
                            <p class="price mb-0 mt-5">$89.50</p>
                            <div class="product-rate">
                                <div class="product-rating" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="assets/imgs/shop/thumbnail-5.jpg" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h6><a href="shop-product-detail.html">Colorful Jacket</a></h6>
                            <p class="price mb-0 mt-5">$25</p>
                            <div class="product-rate">
                                <div class="product-rating" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                    <img src="assets/imgs/banner/banner-11.png" alt="" />
                    <div class="banner-text">
                        <span>Oganic</span>
                        <h4>
                            Save 17% <br />
                            on <span class="text-brand">Oganic</span><br />
                            Juice
                        </h4>
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
                                        <a href="/vercategoria/{{ $categoria->id }}">
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
