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
                                            <input type="text" class="form-control" name="documento" id="documento">
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
                                                name="tiporegistro" id="radiocliente" value="4" />
                                            <label class="form-check-label" for="radiocliente" data-bs-toggle="collapse"
                                                data-target="#bankTranfer" aria-controls="bankTranfer">Soy un
                                                cliente</label>
                                        </div>
                                        <div class="custome-radio">
                                            <input class="form-check-input" required="" type="radio"
                                                name="tiporegistro" id="radiovendedor" value="3" />
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
                                                    id="terminos" value="" required />
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
