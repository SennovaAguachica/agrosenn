@extends('../scripts.frontend.paginas.publicacionscript')
@section('titulo')
    <title>Index</title>
@endsection
@section('contenido')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/index" rel="nofollow"><i class="fi-rs-home mr-5"></i>Inicio</a>
                <span></span> publicaciones <span></span> <a
                    href="/versubcategoria/{{ $publicacion->productos->subcategoria->id }}">{{ $publicacion->productos->subcategoria->subcategoria }}</a>
                <span></span>
                {{ $publicacion->productos->producto }}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30" style="display: flex; align-items:center;justify-content: center;">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    @foreach ($publicacion->imagenes as $imagen)
                                        <figure class='border-radius-10'
                                            style='height: 300px; display: flex; align-items:center;justify-content: center;'>
                                            <img src="{{ $imagen->ruta }}" alt="product image" />
                                        </figure>
                                    @endforeach
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    @foreach ($publicacion->imagenes as $imagen)
                                        <div
                                            style='height: 70px; display: flex; align-items:center;justify-content: center; '>
                                            <img src="{{ $imagen->ruta }}" style="max-width:70px;"alt="product image" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <span class="stock-status in-stock">Disponible</span>
                                <h2 class="title-detail">{{ $publicacion->productos->producto }}</h2>
                                {{-- <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div> --}}
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">$ {{ $publicacion->precios->precio }}</span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15">X
                                                {{ $publicacion->unidades->unidad }}</span>
                                            {{-- <span class="old-price font-md ml-15">$52</span> --}}
                                        </span>
                                    </div>
                                </div>
                                <div class="short-desc mb-30">
                                    @php
                                        // Obtener el contenido completo
                                        $textoCompleto = $publicacion->descripcion;

                                        // Dividir el texto en líneas y tomar la primera línea
                                        $textoHastaSalto = head(explode("\n", $textoCompleto));
                                    @endphp
                                    <p class="font-lg">
                                        <pre style="white-space: pre-wrap;"> {{ $textoHastaSalto }}</pre>
                                    <p>
                                </div>
                                <div class="detail-extralink mb-50">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="cantidad" id="cantidad" class="qty-val" value="1" min="1">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <br>
                                    <div class="">
                                        <a href="https://api.whatsapp.com/send?phone={{ $publicacion->usuario->vendedor->n_celular ?? $publicacion->usuario->asociacion->n_celular }}&text=Hola, estoy interesado en el producto {{ $publicacion->productos->producto }} publicado en Agrosenn."
                                            target="_blank" class="btn btnverpublicacion" data-idpublicacion="{{ $publicacion->id }}" data-idvendedor="{{$publicacion->usuario->id}}" data-indicador="1"><i class="fa-brands fa-whatsapp fa-xl"></i>
                                            Contactar vendedor</a>
                                    </div>
                                </div>
                                <div class="font-xs">
                                    <ul class="mr-50 float-start">
                                        <li class="mb-5">Categoria: <a
                                                href="/vercategoria/{{ $publicacion->productos->subcategoria->categoria_id }}">{{ $publicacion->productos->subcategoria->categorias->categoria }}</a>
                                        </li>
                                        <li class="mb-5">Subcategoria: <a
                                                href="/versubcategoria/{{ $publicacion->productos->subcategoria->id }}">{{ $publicacion->productos->subcategoria->subcategoria }}</a>
                                        </li>
                                        {{-- <li>LIFE: <span class="text-brand">70 days</span></li> --}}
                                    </ul>
                                    <ul class="float-start">
                                        @if (isset($publicacion->usuario->vendedor))
                                            <li class="mb-5">Vendedor: <a
                                                    href="/verproductos/{{ $publicacion->usuario->vendedor->id }}"
                                                    rel="tag">{{ $publicacion->usuario->vendedor->nombres }}
                                                    {{ $publicacion->usuario->vendedor->apellidos }}</a></li>
                                        @elseif(isset($publicacion->usuario->asociacion))
                                            <li class="mb-5">Vendedor: <a
                                                    href="/verproductosasociacion/{{ $publicacion->usuario->asociacion->id }}"
                                                    rel="tag">{{ $publicacion->usuario->asociacion->asociacion }}</a>
                                            </li>
                                        @endif
                                        <li class="mb-5">Fecha publicación:<span class="text-brand">
                                                {{ $publicacion->created_at }}</span></li>
                                        {{-- <li>Stock:<span class="in-stock text-brand ml-5">8 Items In Stock</span></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                        href="#Description">Detalles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab"
                                        href="#Vendor-info">Vendedor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Comentarios
                                        (3)</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p>
                                            <pre style="white-space: pre-wrap;"> {{ $publicacion->descripcion }} </pre>
                                        <p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Vendor-info">
                                    <div class="vendor-logo d-flex mb-30">
                                        <img src="{{ $publicacion->usuario->fotoperfil }}" alt="" />
                                        <div class="vendor-name ml-15">
                                            <h6>

                                                @if (isset($publicacion->usuario->vendedor))
                                                    <a href="/vervendedor/{{ $publicacion->usuario->vendedor->id }}">{{ $publicacion->usuario->vendedor->nombres }}
                                                        {{ $publicacion->usuario->vendedor->apellidos }}</a>
                                                @elseif(isset($publicacion->usuario->asociacion))
                                                    <a
                                                        href="/verproductosasociacion/{{ $publicacion->usuario->asociacion->id }}">{{ $publicacion->usuario->asociacion->asociacion }}</a>
                                                @endif
                                            </h6>
                                            {{-- <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <ul class="contact-infor mb-50">
                                        <li><i class="fa-solid fa-location-dot"></i><strong> Dirección: </strong>
                                            <span>{{ $publicacion->usuario->vendedor->direccion ?? $publicacion->usuario->asociacion->direccion }},
                                                {{ $publicacion->usuario->vendedor->municipio->ciudad ?? $publicacion->usuario->asociacion->municipio->ciudad }}
                                                -
                                                {{ $publicacion->usuario->vendedor->municipio->departamento->departamento ?? $publicacion->usuario->asociacion->municipio->departamento->departamento }}</span>
                                        </li>
                                        <li><i class="fa-solid fa-square-phone"></i><strong> Contacto:</strong><span>(+57)
                                                {{ $publicacion->usuario->vendedor->n_celular ?? $publicacion->usuario->asociacion->n_celular }}</span>
                                        </li>
                                        <li><i class="fa-solid fa-envelope"></i><strong> E-mail:</strong><span>
                                                {{ $publicacion->usuario->vendedor->email ?? $publicacion->usuario->asociacion->email }}</span>
                                        </li>
                                    </ul>
                                    <div class="d-flex mb-55">
                                        <div class="mr-30">
                                            <p class="text-brand font-xs">Rating</p>
                                            <h4 class="mb-0">92%</h4>
                                        </div>
                                        <div class="mr-30">
                                            <p class="text-brand font-xs">Ship on time</p>
                                            <h4 class="mb-0">100%</h4>
                                        </div>
                                        <div>
                                            <p class="text-brand font-xs">Chat response</p>
                                            <h4 class="mb-0">89%</h4>
                                        </div>
                                    </div>
                                    <p>{{ $publicacion->usuario->vendedor->descripcion ?? ($publicacion->usuario->asociacion->descripcion ?? '') }}
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                    <div class="single-comment justify-content-between d-flex mb-30">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="assets/imgs/blog/author-2.png" alt="" />
                                                                <a href="#"
                                                                    class="font-heading text-brand">Sienna</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4, 2022
                                                                            at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 100%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet, consectetur
                                                                    adipisicing elit. Delectus, suscipit exercitationem
                                                                    accusantium obcaecati quos voluptate nesciunt facilis
                                                                    itaque modi commodi dignissimos sequi repudiandae minus
                                                                    ab deleniti totam officia id incidunt? <a
                                                                        href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="assets/imgs/blog/author-3.png" alt="" />
                                                                <a href="#"
                                                                    class="font-heading text-brand">Brenna</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4, 2022
                                                                            at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 80%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet, consectetur
                                                                    adipisicing elit. Delectus, suscipit exercitationem
                                                                    accusantium obcaecati quos voluptate nesciunt facilis
                                                                    itaque modi commodi dignissimos sequi repudiandae minus
                                                                    ab deleniti totam officia id incidunt? <a
                                                                        href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="assets/imgs/blog/author-4.png" alt="" />
                                                                <a href="#"
                                                                    class="font-heading text-brand">Gemma</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4, 2022
                                                                            at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 80%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet, consectetur
                                                                    adipisicing elit. Delectus, suscipit exercitationem
                                                                    accusantium obcaecati quos voluptate nesciunt facilis
                                                                    itaque modi commodi dignissimos sequi repudiandae minus
                                                                    ab deleniti totam officia id incidunt? <a
                                                                        href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <h6>4.8 out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 50%"
                                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 45%"
                                                        aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 65%"
                                                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%
                                                    </div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 85%"
                                                        aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%
                                                    </div>
                                                </div>
                                                <a href="#" class="font-xs text-muted">How are ratings
                                                    calculated?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>
                                        <div class="product-rate d-inline-block mb-30"></div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form" action="#" id="commentForm">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                                                    placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="name" id="name"
                                                                    type="text" placeholder="Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="email" id="email"
                                                                    type="email" placeholder="Email" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="website" id="website"
                                                                    type="text" placeholder="Website" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit
                                                            Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-60">
                        <div class="col-12">
                            <h2 class="section-title style-1 mb-30">Productos relacionados</h2>
                        </div>
                        <div class="col-12">
                            <div class="row related-products">
                                @foreach ($relacionados as $relacionado)
                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap hover-up">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="/verpublicacion/{{ $relacionado->id }}" tabindex="0">
                                                        <img class="default-img"
                                                            src="{{ $relacionado->imagenes[0]->ruta }}" alt="" />
                                                        <img class="hover-img"
                                                            src="{{ $relacionado->imagenes[0]->ruta }}" alt="" />
                                                    </a>
                                                </div>
                                                {{-- <div class="product-action-1">
                                                    <a aria-label="Ver detalles" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                            class="fi-rs-search"></i></a>
                                                </div> --}}
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="new">Disponible</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="/verpublicacion/{{ $relacionado->id }}"
                                                        tabindex="0">{{ $relacionado->productos->producto }}</a>
                                                </h2>
                                                <div class="rating-result" title="90%">
                                                    <span> </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$ {{ $relacionado->precios->precio }}</span>
                                                    <span class="" style="font-size:12px !important"> X
                                                        {{ $relacionado->unidades->unidad }}</span>
                                                    {{-- <span class="old-price">$245.8</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

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

