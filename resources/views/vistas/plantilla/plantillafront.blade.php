<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sistema sennova</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assetsfront/imgs/theme/favicon.svg') }}" />
    <link rel="stylesheet" href="{{ asset('assetsfront/css/carga.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assetsfront/css/plugins/slider-range.css') }}" />
    <link rel="stylesheet" href="{{ asset('assetsfront/css/main.css?v=5.6') }}" />

    {{-- slick CSS --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/nouislider@10.0.0/distribute/nouislider.min.css">
    <style>
        .page-item.active .page-link {
            background: #3bb77e !important;
            border: 1px solid #3bb77e;
            color: #fff;
        }

        .pagination li a {
            color: #3bb77e
        }

        .colored-toast.swal2-icon-error {
            background-color: #f27474 !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-close {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }
    </style>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
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
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30 divinformacionproducto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaleditardatos" tabindex="-1" aria-labelledby="modaleditardatosLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modaleditardatosLabel">Actualizar mis perfil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <br>
                    @if (isset($perfil))
                        @if ($perfil->idrol == 4)
                            <div class="container">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row gx-5">
                                            <aside class="col-lg-3 border-end">
                                                <nav class="nav nav-pills flex-lg-column mb-4">
                                                    <a class="nav-link active" aria-current="page"
                                                        id="btnseccionperfil">General</a>
                                                    <a class="nav-link" id="btncambiarcontrasena">Cambio de
                                                        contraseña</a>
                                                </nav>
                                            </aside>
                                            <div class="col-lg-9" id="divseccionperfil">
                                                <section class="content-body p-xl-4">
                                                    <form id="formGuardarperfilcliente">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-8">
                                                                <div class="row gx-3">
                                                                    <input type="text" id="idrol" name="idrol"
                                                                        value="{{ $perfil->idrol }}" hidden>
                                                                    <input type="text" id="id" name="id"
                                                                        value="{{ $perfil->cliente->id }}" hidden>
                                                                    <div class="col-6 mb-3">
                                                                        <label for="idtipodocumento">Tipo documento
                                                                            *</label>
                                                                        <select
                                                                            class="form-control form-control-chosen"
                                                                            name="idtipodocumento"
                                                                            id="idtipodocumento"
                                                                            data-placeholder="Seleccione una opción"
                                                                            required>
                                                                            <option value=""></option>
                                                                            @foreach ($tiposDocumentos as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $perfil->cliente->id_tipodocumento == $item->id ? 'selected' : '' }}>
                                                                                    {{ $item->tipo_documento }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-6 mb-3">
                                                                        <label for="documentocliente">Nº documento
                                                                            *</label>
                                                                        <input type="text" class="form-control"
                                                                            name="documentocliente"
                                                                            id="documentocliente"
                                                                            placeholder="Nº documento"
                                                                            value="{{ $perfil->cliente->n_documento }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="col-6 mb-3">
                                                                        <label for="nombrecliente">Nombres</label>
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Nombres completos"
                                                                            value="{{ $perfil->cliente->nombres }}"
                                                                            name="nombrecliente" id="nombrecliente"
                                                                            required />
                                                                    </div>
                                                                    <!-- col .// -->
                                                                    <div class="col-6 mb-3">
                                                                        <label for="apellidocliente">Apellidos</label>
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Apellidos completos"
                                                                            value="{{ $perfil->cliente->apellidos }}"
                                                                            name="apellidocliente"
                                                                            id="apellidocliente" required />
                                                                    </div>
                                                                    <!-- col .// -->
                                                                    <div class="col-lg-6 mb-3">
                                                                        <label for="emailcliente">Email</label>
                                                                        <input class="form-control" type="email"
                                                                            placeholder="example@mail.com"
                                                                            value="{{ $perfil->cliente->email }}"
                                                                            name="emailcliente" id="emailcliente"
                                                                            required />
                                                                    </div>
                                                                    <!-- col .// -->
                                                                    <div class="col-lg-6 mb-3">
                                                                        <label for="telefonocliente">Telefono</label>
                                                                        <input class="form-control" type="tel"
                                                                            placeholder="+1234567890"
                                                                            value="{{ $perfil->cliente->n_celular }}"
                                                                            name="telefonocliente"
                                                                            id="telefonocliente" required />
                                                                    </div>
                                                                    <!-- col .// -->
                                                                    <div class="col-lg-6 mb-3">
                                                                        <label
                                                                            for="iddepartamentocliente">Departamento</label>
                                                                        <select
                                                                            class="form-control form-control-chosen"
                                                                            name="iddepartamentocliente"
                                                                            id="iddepartamentocliente"
                                                                            data-placeholder="Seleccione una opción"
                                                                            required>
                                                                            <option value=""></option>
                                                                            @foreach ($departamentos as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $perfil->cliente->municipio->iddepartamentos == $item->id ? 'selected' : '' }}>
                                                                                    {{ $item->departamento }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-3">
                                                                        <label
                                                                            for="idmunicipiocliente">Municipio</label>
                                                                        <select
                                                                            class="form-control form-control-chosen"
                                                                            name="idmunicipiocliente"
                                                                            id="idmunicipiocliente"
                                                                            data-placeholder="Seleccione una opción"
                                                                            required>
                                                                            @foreach ($perfil->cliente->municipio->departamento->ciudades as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $perfil->cliente->id_municipio == $item->id ? 'selected' : '' }}>
                                                                                    {{ $item->ciudad }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- col .// -->
                                                                    <div class="col-lg-12 mb-3">
                                                                        <label for="direccioncliente">Dirección</label>
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Dirección"
                                                                            value="{{ $perfil->cliente->direccion }}"
                                                                            name="direccioncliente"
                                                                            id="direccioncliente" required />
                                                                    </div>
                                                                </div>
                                                                <!-- row.// -->
                                                            </div>
                                                            <!-- col.// -->
                                                            <aside class="col-lg-4">
                                                                <figure class="text-lg-center">
                                                                    @if ($perfil->fotoperfil)
                                                                        <img class="img-lg mb-3 img-avatar"
                                                                            id="userPhoto" name="userPhoto"
                                                                            src="{{ $perfil->fotoperfil }}"
                                                                            alt="User Photo" />
                                                                    @else
                                                                        <img class="img-lg mb-3 img-avatar"
                                                                            id="userPhoto" name="userPhoto"
                                                                            src="{{ asset('assetsweb/imgs/people/avatar-2.png') }}"
                                                                            alt="User Photo" />
                                                                    @endif
                                                                    <figcaption>
                                                                        <label class="btn btn-light rounded font-md"
                                                                            for="fotoinput">
                                                                            <i
                                                                                class="icons material-icons md-backup font-md"></i>
                                                                            Cargar foto
                                                                        </label>
                                                                        <input type="file" id="fotoinput"
                                                                            name="fotoinput" style="display: none"
                                                                            onchange="loadPhoto(this)">
                                                                    </figcaption>
                                                                </figure>
                                                            </aside>
                                                            <!-- col.// -->
                                                        </div>
                                                        <!-- row.// -->
                                                        <br />
                                                        <button class="btn btn-primary" type="button"
                                                            id="btnguardarperfil">Guardar</button>
                                                    </form>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <!-- row.// -->
                                                </section>
                                                <!-- content-body .// -->
                                            </div>
                                            <div class="col-lg-9" id="divcambiarcontrasena" style="display: none;">
                                                <section class="content-body p-xl-4">
                                                    <form id="formcambiarpasswordcliente">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-8">
                                                                <div class="row gx-3">
                                                                    <input type="text" id="idrolpassword"
                                                                        name="idrolpassword"
                                                                        value="{{ $perfil->idrol }}" hidden>
                                                                    <input type="text" id="iduserpassword"
                                                                        name="iduserpassword"
                                                                        value="{{ $perfil->id }}" hidden>
                                                                    <div class="row">
                                                                        <label>Contraseña actual</label>
                                                                        <div class="input-group"
                                                                            id="show_hide_password_actual">
                                                                            <input class="form-control"
                                                                                type="password" id="passwordactual"
                                                                                name="passwordactual" required>
                                                                            <div class="input-group-text">
                                                                                <a href=""><i
                                                                                        class="fa fa-eye-slash"
                                                                                        aria-hidden="true"></i></a>
                                                                            </div>
                                                                            <div class="invalid-feedback">
                                                                                Campo obligatorio.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <label>Contraseña nueva</label>
                                                                        <div class="input-group"
                                                                            id="show_hide_password_nueva">
                                                                            <input class="form-control"
                                                                                type="password" id="passwordnuevo"
                                                                                name="passwordnuevo" required>
                                                                            <div class="input-group-text">
                                                                                <a href=""><i
                                                                                        class="fa fa-eye-slash"
                                                                                        aria-hidden="true"></i></a>
                                                                            </div>
                                                                            <div class="invalid-feedback">
                                                                                Campo obligatorio.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <label>Confirmar contraseña nueva</label>
                                                                        <div class="input-group"
                                                                            id="show_hide_password_confirmar">
                                                                            <input class="form-control"
                                                                                type="password" id="passwordconfirmar"
                                                                                name="passwordconfirmar" required>
                                                                            <div class="input-group-text">
                                                                                <a href=""><i
                                                                                        class="fa fa-eye-slash"
                                                                                        aria-hidden="true"></i></a>
                                                                            </div>
                                                                            <div class="invalid-feedback">
                                                                                Campo obligatorio.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- row.// -->
                                                        <br />
                                                        <button class="btn btn-primary" type="button"
                                                            id="enviarcambiarcontrasenacliente">Actualizar
                                                            contraseña</button>
                                                    </form>
                                                    <br>
                                                    <!-- row.// -->
                                                </section>
                                                <!-- content-body .// -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade custom-modal" id="modaliniciosesion" tabindex="-1"
        aria-labelledby="modaliniciosesionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Autenticate para contactar al vendedor!</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <img class="border-radius-15" src="{{ asset('assetsfront/imgs/page/login.png') }}"
                                alt="" />
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5">Inicio de sesión</h1>
                                        <p class="mb-30">No tienes una cuenta? <a href="/register">Crear una</a></p>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" id="formLogin">
                                        @csrf
                                        <div class="form-group">
                                            <label for="usuariomodal" class="fw-bold">Usuario</label>
                                            <input class="form-control" type="text" required id="usuariomodal"
                                                name="usuario"
                                                placeholder="Nº de  documento o correo electronico *" />
                                        </div>
                                        <div class="form-group">
                                            <label for="passwordmodal" class="fw-bold">Contraseña</label>
                                            <div class="input-group" id="show_hide_password_modal">
                                                <input class="form-control" type="password" id="passwordmodal"
                                                    name="password" placeholder="Tu contraseña *" required>
                                                <div class="input-group-text">
                                                    <a href="#"><i class="fa fa-eye-slash"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember_modal" {{ old('remember') ? 'checked' : '' }} />
                                                    <label class="form-check-label"
                                                        for="remember_modal"><span>Recordarme</span></label>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="#">Olvidaste tu contraseña?</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-heading btn-block hover-up"
                                                name="btnlogin" id="btnlogin">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="/index"><img src="{{ asset('assets/images/senova.png') }}" alt="logo"
                                width="20%" style="padding: 0; margin: 0" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form method="GET" action="/buscarproductos">
                                <input type="text" class="inputbuscar" name="inputbuscar"
                                    placeholder="Buscar productos..." />
                                <button type="submit" class="btnbuscarproductos"><i
                                        class="fi-rs-search"></i></button>
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    @if (isset($perfil))
                                        @if ($perfil->idrol == 1)
                                            <a href="/login" class="btn btn-success btn-sm"
                                                style="color:white; font-size:14px"><i class="fa-solid fa-user"></i>
                                                {{ $perfil->administrador->administrador }}
                                                <span style="color:white;font-size:12px">
                                                    <br> Administrador</span>
                                            </a>
                                        @elseif($perfil->idrol == 2)
                                            <a href="/login" class="btn btn-success btn-sm"
                                                style="color:white; font-size:14px"><i class="fa-solid fa-user"></i>
                                                {{ $perfil->asociacion->asociacion }}
                                                <br>
                                                <span style="color:white;font-size:12px">Asociación</span>
                                            </a>
                                        @elseif($perfil->idrol == 3)
                                            <a href="/login" class="btn btn-success btn-sm"
                                                style="color:white; font-size:14px"><i class="fa-solid fa-user"></i>
                                                {{ $perfil->vendedor->nombres }}
                                                {{ $perfil->vendedor->apellidos }}
                                                <br>
                                                <span style="color:white;font-size:12px">Vendedor</span>
                                            </a>
                                        @elseif($perfil->idrol == 4)
                                            <a href="/login" class="btn btn-success btn-sm"
                                                style="color:white; font-size:14px"><i class="fa-solid fa-user"></i>
                                                {{ $perfil->cliente->nombres }}
                                                {{ $perfil->cliente->apellidos }}
                                                <span style="color:white;font-size:12px">
                                                    <br> Cliente</span>
                                            </a>
                                        @endif
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <ul>
                                                @if ($perfil->idrol == 4)
                                                    <li><a class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#modaleditardatos"><i
                                                                class="fa-solid fa-pen-to-square"></i> Editar mis
                                                            datos</a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <a class="dropdown-item" href="route('logout')"
                                                            onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                                class="fa-solid fa-right-from-bracket"></i> Cerrar
                                                            sesión</a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        <a href="/login" class="btn btn-success btn-sm"
                                            style="color:white; font-size:18px"><i
                                                class="fa-solid fa-right-to-bracket "></i>
                                            Iniciar sesión
                                        </a>
                                        @if(!isset($perfil))
                                            &nbsp;
                                            <a href="/register" class="btn btn-success btn-sm"
                                                style="color:white; font-size:18px"><i class="fa-solid fa-user-shield"></i>
                                                Registrarse
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                @yield('categoria')
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="/index"><img src="{{ asset('assets/images/senova.png') }}" alt="logo"
                            width="10%" style="padding: 0; margin: 0" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form method="GET" action="/buscarproductos">
                        <input type="text" class="inputbuscar" name="inputbuscar"
                            placeholder="Buscar productos…" />
                        <button type="submit" class="btnbuscarproductos"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- Inicio del menú móvil -->
                    @yield('categoria_movil')
                    <!-- Fin del menú móvil -->
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        @if (isset($perfil->idrol))
                            @if ($perfil->idrol == 1)
                                <a href="/login" class="text-center"><i class="fa-solid fa-user"></i>
                                    <span>{{ $perfil->administrador->administrador }}
                                        <br> Administrador</span></a>
                            @elseif($perfil->idrol == 2)
                                <a href="/login" class="text-center"><i class="fa-solid fa-user"></i>
                                    <span>{{ $perfil->asociacion->asociacion }}
                                        <br>Asociación</span></a>
                            @elseif($perfil->idrol == 3)
                                <a href="/login" class="text-center"><i class="fa-solid fa-user"></i>
                                    <span>{{ $perfil->vendedor->nombres }}
                                        {{ $perfil->vendedor->apellidos }}
                                        <br> Vendedor</span></a>
                            @elseif($perfil->idrol == 4)
                                <a href="/login" class="text-center"><i class="fa-solid fa-user"></i>
                                    <span>{{ $perfil->cliente->nombres }}
                                        {{ $perfil->cliente->apellidos }}
                                        <br> Cliente</span></a>
                            @endif
                            <br>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="btn btn-danger" style="background:red; color:white" href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"><i
                                        class="material-icons md-exit_to_app"></i>Cerrar sesión</a>
                            </form>
                        @else
                            <a href="/login"><i class="fi-rs-user"></i>Iniciar Sesión / Registrarse </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--End header-->
    <main class="main">
        @yield('contenido')
    </main>
    <footer class="main">
        <section class="section-padding footer-mid">
        </section>
        <div class="container pb-30">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">&copy; 2023, <strong class="text-brand">Agrosenn</strong> - Plataforma
                        virtual <br />Todos los derechos reservados</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('assetsfront/imgs/theme/loading2.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <div
        class="carga bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="loadingio-spinner-ellipsis-lp7tu9sen9r">
            <div class="ldio-bd6imrfpejg">
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{ asset('assetsfront/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/slider-range.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/select2.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/chosen.jquery.min.js') }}') }}"></script> --}}
    <script src="{{ asset('assetsfront/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('assetsfront/js/plugins/jquery.elevatezoom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template  JS -->
    <script src="{{ asset('./assetsfront/js/main.js?v=5.6') }}"></script>
    <script src="{{ asset('./assetsfront/js/shop.js?v=5.6') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    {{-- slick script --}}
    @yield('script')
    <script>
        var perfil = @json($perfil ?? []);
        var direccion = "";
        var indicador = "";
        $(document).ready(function() {
            btnClick();
        });

        function btnClick() {
            
            
            $("#btnlogin").on("click", function(e) {
                let datosFormulario = "";
                e.preventDefault();
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formLogin");

                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    return;
                }
                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formLogin')[0]);
                console.log(datosFormulario);
                // Realiza la solicitud Ajax
                $.ajax({
                    url: "/login", // Reemplaza esto con la URL del servidor
                    method: "POST",
                    data: datosFormulario,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(".carga").removeClass("hidden").addClass("show");
                    },
                    success: function(respuesta) {
                        // Maneja la respuesta del servidor aquí
                        if (indicador == 1) {
                            location.reload(true);
                        } else {
                            window.location.href = direccion;
                        }
                        $(".carga").removeClass("show").addClass("hidden");
                    },
                    error: function(request, status, error) {
                        var errors = request.responseJSON.errors;

                        // Construye un mensaje de error concatenando todos los mensajes
                        var errorMessage = Object.values(errors).flat().join('<br>');

                        Swal.fire({
                            icon: 'error',
                            title: "Error de autenticación",
                            html: errorMessage,
                            allowOutsideClick: false,
                        });
                        $(".carga").removeClass("show").addClass("hidden");
                    }
                });
            });
            $("#btnguardarperfil").on("click", function(e) {
                let datosFormulario = "";
                e.preventDefault();
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formGuardarperfilcliente");

                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    return;
                }
                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formGuardarperfilcliente')[0]);
                datosFormulario.append('accion', 2);
                console.log(datosFormulario);
                // Realiza la solicitud Ajax
                Swal.fire({
                    title: 'Esta seguro?',
                    text: "Recuerde verificar los datos!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/perfil_peticiones", // Reemplaza esto con la URL del servidor
                            method: "POST",
                            data: datosFormulario,
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                $(".carga").removeClass("hidden").addClass("show");
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '- Se han actualizado sus datos con exito',
                                        allowOutsideClick: false,
                                    });
                                } else {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        iconColor: 'white',
                                        customClass: {
                                            popup: 'colored-toast'
                                        },
                                        showConfirmButton: false,
                                        timer: 3500,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal.stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal.resumeTimer)
                                        }
                                    })
                                    Toast.fire({
                                        icon: 'error',
                                        title: respuesta.mensaje,
                                    });
                                }
                                $(".carga").removeClass("show").addClass("hidden");
                            },
                            error: function(request, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: "Se produjo un error durante el proceso, vuelve a intentarlo",
                                    allowOutsideClick: false,
                                });
                                $(".carga").removeClass("show").addClass("hidden");
                            }
                        });
                    }
                });
            });
            $("#enviarcambiarcontrasenacliente").on("click", function(e) {
                let datosFormulario = "";
                e.preventDefault();
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formcambiarpasswordcliente");

                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    return;
                }
                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formcambiarpasswordcliente')[0]);
                datosFormulario.append('accion', 3);
                console.log(datosFormulario);
                // Realiza la solicitud Ajax
                Swal.fire({
                    title: 'Esta seguro?',
                    text: "Recuerde verificar los datos!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/perfil_peticiones", // Reemplaza esto con la URL del servidor
                            method: "POST",
                            data: datosFormulario,
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                $(".carga").removeClass("hidden").addClass("show");
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '- Se han actualizado su contraseña con exito',
                                        allowOutsideClick: false,
                                    });
                                    $("#passwordactual").val("");
                                    $("#passwordnuevo").val("");
                                    $("#passwordconfirmar").val("");
                                } else {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        iconColor: 'white',
                                        customClass: {
                                            popup: 'colored-toast'
                                        },
                                        showConfirmButton: false,
                                        timer: 3500,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal.stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal.resumeTimer)
                                        }
                                    })
                                    Toast.fire({
                                        icon: 'error',
                                        title: respuesta.mensaje,
                                    });
                                }
                                $(".carga").removeClass("show").addClass("hidden");
                            },
                            error: function(request, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: "Se produjo un error durante el proceso, vuelve a intentarlo",
                                    allowOutsideClick: false,
                                });
                                $(".carga").removeClass("show").addClass("hidden");
                            }
                        });
                    }
                });
            });
            $("#btnseccionperfil").on("click", function(e) {
                $('#btnseccionperfil').addClass('active');
                $('#btncambiarcontrasena').removeClass('active');

                $('#divseccionperfil').show();
                $('#divcambiarcontrasena').hide();
            });
            $("#btncambiarcontrasena").on("click", function(e) {
                $('#btnseccionperfil').removeClass('active');
                $('#btncambiarcontrasena').addClass('active');

                $('#divseccionperfil').hide();
                $('#divcambiarcontrasena').show();
            });
            $("#show_hide_password_actual a").on('click', function(event) {
                mostrarContrasenas("#show_hide_password_actual")
            });
            $("#show_hide_password_modal a").on('click', function(event) {
                mostrarContrasenas("#show_hide_password_modal")
            });
            $("#show_hide_password_nueva a").on('click', function(event) {
                mostrarContrasenas("#show_hide_password_nueva")
            });
            $("#show_hide_password_confirmar a").on('click', function(event) {
                mostrarContrasenas("#show_hide_password_confirmar")
            });
        }

        function loadPhoto(input) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('userPhoto').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }

        function mostrarContrasenas(campo) {
            event.preventDefault();
            if ($('' + campo + ' input').attr("type") == "text") {
                $('' + campo + ' input').attr('type', 'password');
                $('' + campo + ' i').addClass("fa-eye-slash");
                $('' + campo + ' i').removeClass("fa-eye");
            } else if ($('' + campo + ' input').attr("type") == "password") {
                $('' + campo + ' input').attr('type', 'text');
                $('' + campo + ' i').removeClass("fa-eye-slash");
                $('' + campo + ' i').addClass("fa-eye");
            }
        }
    </script>
</body>

</html>
