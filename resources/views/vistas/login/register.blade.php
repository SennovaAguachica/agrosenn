@extends('../scripts.login.loginscript')
@section('titulo')
    <title>Login</title>
@endsection
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-10 col-md-12 m-auto">
                <div class="row">
                    <div class="col-lg-6 col-md-8 m-auto">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h1 class="mb-5">Crear cuenta</h1>
                                    <p class="mb-30">Ya tienes una cuenta? <a href="/login">Login</a></p>
                                </div>
                                <form method="POST" id="formRegistrar">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="idtipodocumento">Tipo documento *</label>
                                            <select class="form-control form-control-chosen" name="idtipodocumento"
                                                id="idtipodocumento" data-placeholder="Seleccione una opción" required>
                                                <option value=""></option>
                                                @foreach ($tiposDocumentos as $item)
                                                    <option value="{{ $item->id }}">{{ $item->tipo_documento }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Selecciona un tipo de documento válido.
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="documento">Nº documento *</label>
                                            <input type="text" class="form-control" name="documento" id="documento"
                                                >
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="nombres">Nombres *</label>
                                            <input type="text" class="form-control" name="nombres" id="nombres"
                                                required>
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="apellidos">Apellidos *</label>
                                            <input type="text" class="form-control" name="apellidos" id="apellidos"
                                                required>
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="celular">Nº celular *</label>
                                            <input type="tel" class="form-control" name="celular" id="celular"
                                                required>
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="email">Correo electronico</label>
                                            <input type="text" class="form-control" name="email" id="email">
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xs-12">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control" name="direccion" id="direccion">
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="iddepartamento">Departamento *</label>
                                            <select class="form-control form-control-chosen" name="iddepartamento"
                                                id="iddepartamento" data-placeholder="Seleccione una opción" required>
                                                <option value=""></option>
                                                @foreach ($departamentos as $item)
                                                    <option value="{{ $item->id }}">{{ $item->departamento }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Selecciona un departamento válido.
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="idmunicipio">Municipio *</label>
                                            <select class="form-control form-control-chosen" name="idmunicipio"
                                                id="idmunicipio" data-placeholder="Seleccione una opción" required>
                                            </select>
                                            <div class="invalid-feedback">
                                                Selecciona un municipio válido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="password">Contraseña *</label>
                                            <input required type="password" name="password" id="password"
                                                placeholder="Contraseña" />
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="password_confirmation">Confirmar contraseña *</label>
                                            <input required type="password" name="password_confirmation"
                                                id="password_confirmation" placeholder="Confirme contraseña" />
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment_option mb-50">
                                        <div class="custome-radio">
                                            <input class="form-check-input" required="" type="radio"
                                                name="tiporegistro" id="radiocliente" value="4"/>
                                            <label class="form-check-label" for="radiocliente" data-bs-toggle="collapse"
                                                data-target="#bankTranfer" aria-controls="bankTranfer">Soy un
                                                cliente</label>
                                        </div>
                                        <div class="custome-radio">
                                            <input class="form-check-input" required="" type="radio"
                                                name="tiporegistro" id="radiovendedor"  value="3" />
                                            <label class="form-check-label" for="radiovendedor" data-bs-toggle="collapse"
                                                data-target="#checkPayment" aria-controls="checkPayment">Soy un
                                                vendedor</label>
                                        </div>
                                    </div>
                                    <div id="checkPayment" class="collapse">
                                        <div class="form-group">
                                            <label for="codigoasociacion">Código de Asociación</label>
                                            <input type="text" class="form-control" id="codigoasociacion"
                                                name="codigoasociacion">
                                        </div>
                                        <div class="invalid-feedback">
                                            Digite codigo asociación.
                                        </div>
                                    </div>
                                    <div class="login_footer form-group mb-50">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="terminos"
                                                    id="terminos" value="" required/>
                                                <label class="form-check-label" for="terminos"><span>Acepto los
                                                        terminos y condiciones.</span></label>
                                            </div>
                                        </div>
                                        <a href="page-privacy-policy.html"><i
                                                class="fi-rs-book-alt mr-5 text-muted"></i>Leer
                                            terminos y condiciones</a>
                                    </div>
                                    <div class="form-group mb-30">
                                        <button type="button"
                                            class="btn btn-fill-out btn-block hover-up font-weight-bold" name="registrar"
                                            id="registrar">Enviar &amp; Registrarme</button>
                                    </div>
                                    <p class="font-xs text-muted"><strong>Nota:</strong>Sus datos personales se
                                        utilizarán
                                        para
                                        respaldar su experiencia en este sitio web, para administrar el acceso a su
                                        cuenta y
                                        para otros fines descritos en nuestra política de privacidad</p>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6 pr-30 d-none d-lg-block">
                    <div class="card-login mt-115">
                        <a href="#" class="social-login facebook-login">
                            <img src="assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                            <span>Continue with Facebook</span>
                        </a>
                        <a href="#" class="social-login google-login">
                            <img src="assets/imgs/theme/icons/logo-google.svg" alt="" />
                            <span>Continue with Google</span>
                        </a>
                        <a href="#" class="social-login apple-login">
                            <img src="assets/imgs/theme/icons/logo-apple.svg" alt="" />
                            <span>Continue with Apple</span>
                        </a>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('categoria')
<div class="header-wrap header-space-between position-relative">
    <div class="logo logo-width-1 d-block d-lg-none">
        <a href="/"><img src="assets/images/senova.png" alt="logo" width="20%" style="padding: 0; margin: 0" /></a>
    </div>
    <div class="header-nav d-none d-lg-flex">
        <div class="main-categori-wrap d-none d-lg-block">
            <a class="categories-button-active" href="#">
                <span class="fi-rs-apps"></span> <span class="et">Todas</span> las categorias <i class="fi-rs-angle-down"></i>
            </a>
            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                <div class="d-flex categori-dropdown-inner">
                    <ul class="categorias-desplegable">
                        @foreach ($categorias as $categoria)
                            @if($categoria->estado === 1)
                                <li>
                                    <a href="#">
                                        <img class="flex "src="{!!$categoria->icono!!}"/>
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
                    <li class="hot-deals"><img src="assetsfront/imgs/theme/icons/icon-hot.svg" alt="Ofertas" /><a href="shop-grid-right.html">Ofertas</a></li>
                    <li>
                        <a href="/">Inicio</a>
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
                                    <a href="shop-product-right.html"><img src="assetsfront/imgs/banner/banner-menu.png" alt="Nest" /></a>
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
                        <a href="#">Campesinos <i class="fi-rs-angle-down"></i></a>
                        <ul class="sub-menu">
                            <li><a href="vendors-grid.html">Vendedores en cuadrícula</a></li>
                            <li><a href="vendors-list.html">Vendedores en lista</a></li>
                            <li><a href="vendor-details-1.html">Detalles del vendedor 01</a></li>
                            <li><a href="vendor-details-2.html">Detalles del vendedor 02</a></li>
                            <li><a href="vendor-dashboard.html">Panel de control del vendedor</a></li>
                            <li><a href="vendor-guide.html">Guía del vendedor</a></li>
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
                                <a href="shop-product-right.html"><img alt="Nest" src="assetsfront/imgs/shop/thumbnail-3.jpg" /></a>
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
                                <a href="shop-product-right.html"><img alt="Nest" src="assetsfront/imgs/shop/thumbnail-4.jpg" /></a>
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