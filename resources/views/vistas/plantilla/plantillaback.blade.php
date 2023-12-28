<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    @yield('titulo')
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assetsweb/imgs/theme/favicon.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.3.0/css/rowGroup.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.2.1/css/fixedColumns.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assetsfront/css/carga.css') }}">
    <link rel="stylesheet" href="assets/css/lineicons.css" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" /> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}">
    <!-- Template CSS -->
    <link href="assetsweb/css/main.css" rel="stylesheet" type="text/css" />

    {{-- slick CSS --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    {{-- delete file DataTable --}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css" rel="stylesheet"
        type="text/css" />

    {{-- fileinput --}}
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" /> --}}


    <link rel="stylesheet"
        href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.1/css/bootstrapValidator.min.css" />
    <style>
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
    <div class="screen-overlay"></div>
    <aside class="navbar-aside" id="offcanvas_aside">
        <div class="aside-top">
            <a href="/" class="brand-wrap">
                <img src="assets/images/senova.png" class="logo" alt="Nest Dashboard" />
            </a>
            <div>
                <button class="btn btn-icon btn-aside-minimize"><i
                        class="text-muted material-icons md-menu_open"></i></button>
            </div>
        </div>
        <nav>
            <ul class="menu-aside">
                <li class="menu-item" id="li_dashboard">
                    <a class="menu-link" href="/">
                        <i class="icon material-icons md-home"></i>
                        <span class="text">Inicio</span>
                    </a>
                </li>
                @canany(['categorias.listar', 'subcategorias.listar'])
                    <li class="menu-item has-submenu" id="li_categorias">
                        <a class="menu-link" href="/categorias">
                            <i class="fa-solid fa-list-check fa-xl" id="i_categoria"
                                style="color: #999898; margin-top: 12px; margin-bottom: 12px"> &nbsp</i>
                            <span class="text">Gestión de Categorías</span>
                        </a>
                        <div class="submenu">
                            @can('categorias.listar')
                                <a href="/categorias">Categorías</a>
                            @endcan
                            @can('subcategorias.listar')
                                <a href="/subcategorias">Subcategorías</a>
                            @endcan
                        </div>
                    </li>
                @endcanany
                @can('asociaciones.listar')
                    <li class="menu-item" id="li_asociaciones">
                        <a class="menu-link" href="/asociaciones">
                            <i class="fa-solid fa-people-roof fa-xl" id="i_asociacion"
                                style="color: #999898; margin-top: 12px; margin-bottom: 12px"> &nbsp</i>
                            <span class="text">Asociaciones</span>
                        </a>
                    </li>
                @endcan
                @can('productos.listar')
                    <li class="menu-item" id="li_productos">
                        <a class="menu-link" href="/productos">
                            <i class="icon material-icons md-shopping_bag" id="i_productos"></i>
                            <span class="text">Productos</span>
                        </a>
                    </li>
                @endcan
                @canany(['unidades.listar', 'equivalencias.listar'])
                    <li class="menu-item has-submenu" id="li_gestion_unidades">
                        <a class="menu-link">
                            <i class="fas fa-weight fa-xl" id="i_unidades"
                                style="color: #999898; margin-top: 12px; margin-bottom: 12px"> &nbsp</i>
                            <span class="text">Gestion de unidades</span>
                        </a>
                        <div class="submenu">
                            @can('unidades.listar')
                                <a href="/unidades" id="a_unidades">Unidades</a>
                            @endcan
                            @can('equivalencias.listar')
                                <a href="/equivalencias" id="a_equivalencias">Equivalencias</a>
                            @endcan
                        </div>
                    </li>
                @endcanany
                @canany(['precios.listar', 'sugeridos.listar'])
                    <li class="menu-item has-submenu" id="li_precios">
                        <a class="menu-link">
                            <i class="fa-solid fa-money-bill fa-xl" id="i_precios"
                                style="color: #999898; margin-top: 12px; margin-bottom: 12px">&nbsp</i>
                            <span class="text">Precios</span>
                        </a>
                        <div class="submenu">
                            @can('precios.listar')
                                <a href="/precios" id="a_precios">Mis precios</a>
                            @endcan
                            @can('sugeridos.listar')
                                <a href="/sugeridos" id="a_sugeridos">Precios sugeridos</a>
                            @endcan
                        </div>
                    </li>
                @endcanany
                @can('publicaciones.listar')
                    <li class="menu-item" id="li_publicaciones">
                        <a class="menu-link" href="/publicaciones">
                            <i class="fa fa-upload fa-xl" id="i_publicaciones"
                                style="color: #999898; margin-top: 12px; margin-bottom: 12px">&nbsp</i>
                            <span class="text">Publicaciones</span>
                        </a>
                    </li>
                @endcan
                @canany(['ventas.listar', 'ventas.listarFinalizadas', 'ventas.listarCanceladas'])
                    <li class="menu-item has-submenu" id="li_ventas">
                        <a class="menu-link">
                            <i class="fa-solid fa-square-poll-vertical fa-xl" id="i_ventas"
                                style="color: #999898; margin-top: 12px; margin-bottom: 12px">&nbsp</i>
                            <span class="text">Ventas</span>
                        </a>
                        <div class="submenu">
                            @can('ventas.listar')
                                <a href="/ventas" id="a_ventas">Mis ventas</a>
                            @endcan
                            @can('ventas.listarFinalizadas')
                                <a href="/ventasFinalizadas" id="a_finalizadas">Ventas finalizadas</a>
                            @endcan
                            {{-- @can('ventas.listarCanceladas')
                                <a href="/ventasCanceladas" id="a_canceladas">Ventas canceladas</a>
                            @endcan  --}}
                        </div>
                    </li>
                @endcanany
                @can('administradores.listar')
                    <li class="menu-item" id="li_administradores">
                        <a class="menu-link" href="/administradores">
                            <i class="fa-solid fa-people-arrows fa-xl" id="i_administrador"
                                style="color: #999898; margin-top: 12px; margin-bottom: 12px"> &nbsp</i>
                            <span class="text">Administradores</span>
                        </a>
                    </li>
                @endcan
                @can('vendedores.listar')
                    <li class="menu-item" id="li_vendedores">
                        <a class="menu-link" href="/vendedores">
                            <i class="fa-solid fa-users fa-xl" id="i_vendedor"
                                style="color: #999898; margin-top: 12px; margin-bottom: 12px"> &nbsp</i>
                            <span class="text">Vendedores</span>
                        </a>
                    </li>
                @endcan
                @can('banners.listar')
                    <li class="menu-item" id="li_banners">
                        <a class="menu-link" href="/banners">
                            <i class="fa-solid fa-palette fa-xl" id="i_banners"
                                style="color: #999898; margin-top: 12px; margin-bottom: 12px"> &nbsp</i>
                            <span class="text">Banners</span>
                        </a>
                    </li>
                @endcan
                @canany(['usuarios.listar', 'roles.listar', 'permisos.listar'])
                    <li class="menu-item has-submenu" id="li_gestion_seguridad">
                        <a class="menu-link">
                            <i class="fas fa-lock fa-xl" id="i_seguridad"
                                style="color: #999898; margin-top: 12px; margin-bottom: 12px"> &nbsp</i>
                            <span class="text">Gestion seguridad</span>
                        </a>
                        <div class="submenu">
                            @can('usuarios.listar')
                                <a href="/usuarios" id="a_usuarios">Usuarios</a>
                            @endcan
                            @can('roles.listar')
                                <a href="/roles" id="a_roles">Roles</a>
                            @endcan
                            @can('permisos.listar')
                                <a href="/permisos" id="a_permisos">Permisos</a>
                            @endcan
                        </div>
                    </li>
                @endcanany
                <li class="menu-item" id="li_perfil">
                    <a class="menu-link" href="/perfil">
                        <i class="fa-solid fa-id-card fa-xl" id="i_perfil"
                            style="color: #999898; margin-top: 12px; margin-bottom: 12px"> &nbsp</i>
                        <span class="text">Editar perfil</span>
                    </a>
                </li>
                <br />
                <br />
        </nav>

    </aside>
    <main class="main-wrap">
        <header class="main-header navbar">
            <div class="col-search">
                <form class="searchform">
                    {{-- <div class="input-group">
                        <input list="search_terms" type="text" class="form-control" placeholder="Search term" />
                        <button class="btn btn-light bg" type="button"><i
                                class="material-icons md-search"></i></button>
                    </div> --}}
                    <datalist id="search_terms">
                        <option value="Products"></option>
                        <option value="New orders"></option>
                        <option value="Apple iphone"></option>
                        <option value="Ahmed Hassan"></option>
                    </datalist>
                </form>
            </div>
            <div class="col-nav">
                <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i
                        class="material-icons md-apps"></i></button>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link btn-icon darkmode" href="#"> <i
                                class="material-icons md-nights_stay"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="requestfullscreen nav-link btn-icon"><i
                                class="material-icons md-cast"></i></a>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount"
                            aria-expanded="false">
                            @if ($perfil->fotoperfil)
                                <img class="img-xs rounded-circle" src="{{ $perfil->fotoperfil }}" alt="User"
                                    width="100%" />
                            @else
                                <!-- Ruta a tu imagen por defecto si no hay foto de perfil -->
                                <img class="img-xs rounded-circle"
                                    src="{{ asset('assetsweb/imgs/people/avatar-2.png') }}" alt="User"
                                    width="100%" />
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                            <a class="dropdown-item" href="/perfil"><i
                                    class="material-icons md-perm_identity"></i>Editar Perfil</a>
                            <a class="dropdown-item" href="#"><i
                                    class="material-icons md-help_outline"></i>Ayuda</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"><i
                                        class="material-icons md-exit_to_app"></i>Cerrar sesión</a>
                            </form>

                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <section class="content-main">
            @yield('contenido')

        </section>
        <!-- content-main end// -->
        <footer class="main-footer font-xs">
            <div class="row pb-30 pt-15">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    &copy; Sennova
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end">Todos los derechos reservados</div>
                </div>
            </div>
        </footer>
    </main>
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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
    {{-- <script src="assetsweb/js/vendors/bootstrap.bundle.min.js"></script> --}}
    <script src="assetsweb/js/vendors/select2.min.js"></script>
    <script src="assetsweb/js/vendors/perfect-scrollbar.js"></script>
    <script src="assetsweb/js/vendors/jquery.fullscreen.min.js"></script>
    {{-- <script src="assetsweb/js/vendors/chart.js"></script> --}}

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    {{-- slick script --}}

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    {{-- delete file DataTable --}}

    {{-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script> --}}
    {{-- fileinput --}}

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.1/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.3.0/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/buffer.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/filetype.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/piexif.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/sortable.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/fileinput.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/themes/fa5/theme.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/locales/es.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script src="{{ asset('assets/js/inputnumber.js') }}"></script>
    <!-- Main Script -->
    <script src="assetsweb/js/main.js?v=1.1" type="text/javascript"></script>
    <script src="assetsweb/js/custom-chart.js" type="text/javascript"></script>
    {{-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.1/js/bootstrapValidator.min.js"></script> --}}
    @yield('script')

    @extends('../scripts.funcionesgenerales.funcionesgenerales')
</body>

</html>
