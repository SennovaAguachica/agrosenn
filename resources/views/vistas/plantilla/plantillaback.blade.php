<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
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
    <link rel="stylesheet" href="assets/css/lineicons.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}">
    <!-- Template CSS -->
    <link href="assetsweb/css/main.css" rel="stylesheet" type="text/css" />
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
            <a href="index.html" class="brand-wrap">
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
                @can('precios.listar')
                    <li class="menu-item" id="li_precios">
                        <a class="menu-link" href="/precios">
                            <i class="fa-solid fa-money-bill fa-xl" id="i_precios"
                            style="color: #999898; margin-top: 12px; margin-bottom: 12px">&nbsp</i>
                            <span class="text">Precios</span>
                        </a>
                    </li>
                @endcan
                @can('publicaciones.listar')
                    <li class="menu-item" id="li_publicaciones">
                        <a class="menu-link" href="/publicaciones">
                            <i class="fa fa-upload fa-xl" id="i_publicaciones"
                            style="color: #999898; margin-top: 12px; margin-bottom: 12px">&nbsp</i>
                            <span class="text">Publicaciones</span>
                        </a>
                    </li>
                @endcan
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
                {{-- <li class="menu-item has-submenu">
                    <a class="menu-link" href="page-orders-1.html">
                        <i class="icon material-icons md-shopping_cart"></i>
                        <span class="text">Pedidos</span>
                    </a>
                    <div class="submenu">
                        <a href="page-orders-1.html">Lista de Pedidos 1</a>
                        <a href="page-orders-2.html">Lista de Pedidos 2</a>
                        <a href="page-orders-detail.html">Detalle del Pedido</a>
                    </div>
                </li>
                <li class="menu-item has-submenu">
                    <a class="menu-link" href="page-sellers-cards.html">
                        <i class="icon material-icons md-store"></i>
                        <span class="text">Vendedores</span>
                    </a>
                    <div class="submenu">
                        <a href="page-sellers-cards.html">Tarjetas de Vendedores</a>
                        <a href="page-sellers-list.html">Lista de Vendedores</a>
                        <a href="page-seller-detail.html">Perfil de Vendedor</a>
                    </div>
                </li>
                <li class="menu-item has-submenu">
                    <a class="menu-link" href="page-form-product-1.html">
                        <i class="icon material-icons md-add_box"></i>
                        <span class="text">Agregar Producto</span>
                    </a>
                    <div class="submenu">
                        <a href="page-form-product-1.html">Agregar Producto 1</a>
                        <a href="page-form-product-2.html">Agregar Producto 2</a>
                        <a href="page-form-product-3.html">Agregar Producto 3</a>
                        <a href="page-form-product-4.html">Agregar Producto 4</a>
                    </div>
                </li>
                <li class="menu-item has-submenu">
                    <a class="menu-link" href="page-transactions-1.html">
                        <i class="icon material-icons md-monetization_on"></i>
                        <span class="text">Transacciones</span>
                    </a>
                    <div class="submenu">
                        <a href="page-transactions-1.html">Transacción 1</a>
                        <a href="page-transactions-2.html">Transacción 2</a>
                    </div>
                </li>
                <li class="menu-item has-submenu">
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-person"></i>
                        <span class="text">Cuenta</span>
                    </a>
                    <div class="submenu">
                        <a href="page-account-login.html">Inicio de Sesión de Usuario</a>
                        <a href="page-account-register.html">Registro de Usuario</a>
                        <a href="page-error-404.html">Error 404</a>
                    </div>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="page-reviews.html">
                        <i class="icon material-icons md-comment"></i>
                        <span class="text">Reseñas</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="page-brands.html">
                        <i class="icon material-icons md-stars"></i>
                        <span class="text">Marcas</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" disabled href="#">
                        <i class="icon material-icons md-pie_chart"></i>
                        <span class="text">Estadísticas</span>
                    </a>
                </li>
            </ul>
            <hr />
            <ul class="menu-aside">
                <li class="menu-item has-submenu">
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-settings"></i>
                        <span class="text">Configuración</span>
                    </a>
                    <div class="submenu">
                        <a href="page-settings-1.html">Ejemplo de Configuración 1</a>
                        <a href="page-settings-2.html">Ejemplo de Configuración 2</a>
                    </div>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="page-blank.html">
                        <i class="icon material-icons md-local_offer"></i>
                        <span class="text">Página de Inicio</span>
                    </a>
                </li>
            </ul> --}}
            <br />
            <br />
        </nav>

    </aside>
    <main class="main-wrap">
        <header class="main-header navbar">
            <div class="col-search">
                <form class="searchform">
                    <div class="input-group">
                        <input list="search_terms" type="text" class="form-control" placeholder="Search term" />
                        <button class="btn btn-light bg" type="button"><i
                                class="material-icons md-search"></i></button>
                    </div>
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
                        <a class="nav-link btn-icon" href="#">
                            <i class="material-icons md-notifications animation-shake"></i>
                            <span class="badge rounded-pill">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-icon darkmode" href="#"> <i
                                class="material-icons md-nights_stay"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="requestfullscreen nav-link btn-icon"><i
                                class="material-icons md-cast"></i></a>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownLanguage"
                            aria-expanded="false"><i class="material-icons md-public"></i></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLanguage">
                            <a class="dropdown-item text-brand" href="#"><img
                                    src="assetsweb/imgs/theme/flag-us.png" alt="English" />English</a>
                            <a class="dropdown-item" href="#"><img src="assetsweb/imgs/theme/flag-fr.png"
                                    alt="Français" />Français</a>
                            <a class="dropdown-item" href="#"><img src="assetsweb/imgs/theme/flag-jp.png"
                                    alt="Français" />日本語</a>
                            <a class="dropdown-item" href="#"><img src="assetsweb/imgs/theme/flag-cn.png"
                                    alt="Français" />中国人</a>
                        </div>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount"
                            aria-expanded="false"> <img class="img-xs rounded-circle"
                                src="assetsweb/imgs/people/avatar-2.png" alt="User" /></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                            <a class="dropdown-item" href="#"><i
                                    class="material-icons md-perm_identity"></i>Edit Profile</a>
                            <a class="dropdown-item" href="#"><i class="material-icons md-settings"></i>Account
                                Settings</a>
                            <a class="dropdown-item" href="#"><i
                                    class="material-icons md-account_balance_wallet"></i>Wallet</a>
                            <a class="dropdown-item" href="#"><i
                                    class="material-icons md-receipt"></i>Billing</a>
                            <a class="dropdown-item" href="#"><i
                                    class="material-icons md-help_outline"></i>Help center</a>
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
            {{-- <div class="content-header">
                <div>
                    <h2 class="content-title card-title">Dashboard</h2>
                    <p>Whole data about your business here</p>
                </div>
                <div>
                    <a href="#" class="btn btn-primary"><i
                            class="text-muted material-icons md-post_add"></i>Create report</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-primary-light"><i
                                    class="text-primary material-icons md-monetization_on"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Revenue</h6>
                                <span>$13,456.5</span>
                                <span class="text-sm"> Shipping fees are not included </span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-success-light"><i
                                    class="text-success material-icons md-local_shipping"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Orders</h6>
                                <span>53.668</span>
                                <span class="text-sm"> Excluding orders in transit </span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-warning-light"><i
                                    class="text-warning material-icons md-qr_code"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Products</h6>
                                <span>9.856</span>
                                <span class="text-sm"> In 19 Categories </span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-info-light"><i
                                    class="text-info material-icons md-shopping_basket"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Monthly Earning</h6>
                                <span>$6,982</span>
                                <span class="text-sm"> Based in your local time. </span>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-12">
                    <div class="card mb-4">
                        <article class="card-body">
                            <h5 class="card-title">Sale statistics</h5>
                            <canvas id="myChart" height="120px"></canvas>
                        </article>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card mb-4">
                                <article class="card-body">
                                    <h5 class="card-title">New Members</h5>
                                    <div class="new-member-list">
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <div class="d-flex align-items-center">
                                                <img src="assetsweb/imgs/people/avatar-4.png" alt=""
                                                    class="avatar" />
                                                <div>
                                                    <h6>Patric Adams</h6>
                                                    <p class="text-muted font-xs">Sanfrancisco</p>
                                                </div>
                                            </div>
                                            <a href="#" class="btn btn-xs"><i
                                                    class="material-icons md-add"></i> Add</a>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <div class="d-flex align-items-center">
                                                <img src="assetsweb/imgs/people/avatar-2.png" alt=""
                                                    class="avatar" />
                                                <div>
                                                    <h6>Dilan Specter</h6>
                                                    <p class="text-muted font-xs">Sanfrancisco</p>
                                                </div>
                                            </div>
                                            <a href="#" class="btn btn-xs"><i
                                                    class="material-icons md-add"></i> Add</a>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <div class="d-flex align-items-center">
                                                <img src="assetsweb/imgs/people/avatar-3.png" alt=""
                                                    class="avatar" />
                                                <div>
                                                    <h6>Tomas Baker</h6>
                                                    <p class="text-muted font-xs">Sanfrancisco</p>
                                                </div>
                                            </div>
                                            <a href="#" class="btn btn-xs"><i
                                                    class="material-icons md-add"></i> Add</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card mb-4">
                                <article class="card-body">
                                    <h5 class="card-title">Recent activities</h5>
                                    <ul class="verti-timeline list-unstyled font-sm">
                                        <li class="event-list">
                                            <div class="event-timeline-dot">
                                                <i class="material-icons md-play_circle_outline font-xxl"></i>
                                            </div>
                                            <div class="media">
                                                <div class="me-3">
                                                    <h6><span>Today</span> <i
                                                            class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i>
                                                    </h6>
                                                </div>
                                                <div class="media-body">
                                                    <div>Lorem ipsum dolor sit amet consectetur</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="event-list active">
                                            <div class="event-timeline-dot">
                                                <i
                                                    class="material-icons md-play_circle_outline font-xxl animation-fade-right"></i>
                                            </div>
                                            <div class="media">
                                                <div class="me-3">
                                                    <h6><span>17 May</span> <i
                                                            class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i>
                                                    </h6>
                                                </div>
                                                <div class="media-body">
                                                    <div>Debitis nesciunt voluptatum dicta reprehenderit</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="event-list">
                                            <div class="event-timeline-dot">
                                                <i class="material-icons md-play_circle_outline font-xxl"></i>
                                            </div>
                                            <div class="media">
                                                <div class="me-3">
                                                    <h6><span>13 May</span> <i
                                                            class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i>
                                                    </h6>
                                                </div>
                                                <div class="media-body">
                                                    <div>Accusamus voluptatibus voluptas.</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="event-list">
                                            <div class="event-timeline-dot">
                                                <i class="material-icons md-play_circle_outline font-xxl"></i>
                                            </div>
                                            <div class="media">
                                                <div class="me-3">
                                                    <h6><span>05 April</span> <i
                                                            class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i>
                                                    </h6>
                                                </div>
                                                <div class="media-body">
                                                    <div>At vero eos et accusamus et iusto odio dignissi</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="event-list">
                                            <div class="event-timeline-dot">
                                                <i class="material-icons md-play_circle_outline font-xxl"></i>
                                            </div>
                                            <div class="media">
                                                <div class="me-3">
                                                    <h6><span>26 Mar</span> <i
                                                            class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i>
                                                    </h6>
                                                </div>
                                                <div class="media-body">
                                                    <div>Responded to need “Volunteer Activities</div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="card mb-4">
                        <article class="card-body">
                            <h5 class="card-title">Revenue Base on Area</h5>
                            <canvas id="myChart2" height="217"></canvas>
                        </article>
                    </div>
                    <div class="card mb-4">
                        <article class="card-body">
                            <h5 class="card-title">Marketing Chanel</h5>
                            <span class="text-muted font-xs">Facebook</span>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 15%">15%</div>
                            </div>
                            <span class="text-muted font-xs">Instagram</span>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 65%">65%</div>
                            </div>
                            <span class="text-muted font-xs">Google</span>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 51%">51%</div>
                            </div>
                            <span class="text-muted font-xs">Twitter</span>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 80%">80%</div>
                            </div>
                            <span class="text-muted font-xs">Other</span>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 80%">80%</div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <header class="card-header">
                    <h4 class="card-title">Latest orders</h4>
                    <div class="row align-items-center">
                        <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                            <div class="custom_select">
                                <select class="form-select select-nice">
                                    <option selected>All Categories</option>
                                    <option>Women's Clothing</option>
                                    <option>Men's Clothing</option>
                                    <option>Cellphones</option>
                                    <option>Computer & Office</option>
                                    <option>Consumer Electronics</option>
                                    <option>Jewelry & Accessories</option>
                                    <option>Home & Garden</option>
                                    <option>Luggage & Bags</option>
                                    <option>Shoes</option>
                                    <option>Mother & Kids</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <input type="date" value="02.05.2021" class="form-control" />
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="custom_select">
                                <select class="form-select select-nice">
                                    <option selected>Status</option>
                                    <option>All</option>
                                    <option>Paid</option>
                                    <option>Chargeback</option>
                                    <option>Refund</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-center">
                                            <div class="form-check align-middle">
                                                <input class="form-check-input" type="checkbox"
                                                    id="transactionCheck01" />
                                                <label class="form-check-label" for="transactionCheck01"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle" scope="col">Order ID</th>
                                        <th class="align-middle" scope="col">Billing Name</th>
                                        <th class="align-middle" scope="col">Date</th>
                                        <th class="align-middle" scope="col">Total</th>
                                        <th class="align-middle" scope="col">Payment Status</th>
                                        <th class="align-middle" scope="col">Payment Method</th>
                                        <th class="align-middle" scope="col">View Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="transactionCheck02" />
                                                <label class="form-check-label" for="transactionCheck02"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2540</a></td>
                                        <td>Neal Matthews</td>
                                        <td>07 Oct, 2021</td>
                                        <td>$400</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-success">Paid</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i>
                                            Mastercard</td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="transactionCheck03" />
                                                <label class="form-check-label" for="transactionCheck03"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2541</a></td>
                                        <td>Jamal Burnett</td>
                                        <td>07 Oct, 2021</td>
                                        <td>$380</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-danger">Chargeback</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i> Visa
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="transactionCheck04" />
                                                <label class="form-check-label" for="transactionCheck04"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2542</a></td>
                                        <td>Juan Mitchell</td>
                                        <td>06 Oct, 2021</td>
                                        <td>$384</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-success">Paid</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i> Paypal
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="transactionCheck05" />
                                                <label class="form-check-label" for="transactionCheck05"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2543</a></td>
                                        <td>Barry Dick</td>
                                        <td>05 Oct, 2021</td>
                                        <td>$412</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-success">Paid</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i>
                                            Mastercard</td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="transactionCheck06" />
                                                <label class="form-check-label" for="transactionCheck06"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2544</a></td>
                                        <td>Ronald Taylor</td>
                                        <td>04 Oct, 2021</td>
                                        <td>$404</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-warning">Refund</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i> Visa
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="transactionCheck07" />
                                                <label class="form-check-label" for="transactionCheck07"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2545</a></td>
                                        <td>Jacob Hunter</td>
                                        <td>04 Oct, 2021</td>
                                        <td>$392</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-success">Paid</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i> Paypal
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- table-responsive end// -->
                </div>
            </div>
            <div class="pagination-area mt-30 mb-50">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item active"><a class="page-link" href="#">01</a></li>
                        <li class="page-item"><a class="page-link" href="#">02</a></li>
                        <li class="page-item"><a class="page-link" href="#">03</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">16</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div> --}}
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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    {{-- <script src="assetsweb/js/vendors/bootstrap.bundle.min.js"></script> --}}
    <script src="assetsweb/js/vendors/select2.min.js"></script>
    <script src="assetsweb/js/vendors/perfect-scrollbar.js"></script>
    <script src="assetsweb/js/vendors/jquery.fullscreen.min.js"></script>
    {{-- <script src="assetsweb/js/vendors/chart.js"></script> --}}

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

    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/inputnumber.js') }}"></script>
    <!-- Main Script -->
    <script src="assetsweb/js/main.js?v=1.1" type="text/javascript"></script>
    <script src="assetsweb/js/custom-chart.js" type="text/javascript"></script>
    @yield('script')

    @extends('../scripts.funcionesgenerales.funcionesgenerales')
</body>

</html>
