﻿@extends('../scripts.login.loginscript')
@section('titulo')
    <title>Login</title>
@endsection
@section('contenido')
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <img class="border-radius-15" src="assetsfront/imgs/page/login.png" alt="" />
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
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="usuario" class="fw-bold">Usuario</label>
                                            <input class="form-control" type="text" required="" id="usuario"
                                                name="usuario" placeholder="Nº de  documento o correo electronico *" />
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="fw-bold">Contraseña</label>
                                            <div class="input-group" id="show_hide_password_login">
                                                <input class="form-control" type="password" id="password" name="password"
                                                    placeholder="Tu contraseña *" required>
                                                <div class="input-group-text">
                                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }} />
                                                    <label class="form-check-label"
                                                        for="remember"><span>Recordarme</span></label>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="{{ route('password.request') }}">Olvidaste tu contraseña?</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up"
                                                name="login">Entrar</button>
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
