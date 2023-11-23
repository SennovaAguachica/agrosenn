@extends('../scripts.backend.perfil.perfilscript')
@section('titulo')
    <title>Edición perfil</title>
@endsection
@section('contenido')
    <div class="content-header">
        <h2 class="content-title">Configuración de datos personales</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row gx-5">
                <aside class="col-lg-3 border-end">
                    <nav class="nav nav-pills flex-lg-column mb-4">
                        <a class="nav-link active" aria-current="page" href="#">General</a>
                        {{-- <a class="nav-link" href="#">Moderators</a> --}}
                        <a class="nav-link" href="#">Cambio de contraseña</a>
                        {{-- <a class="nav-link" href="#">SEO settings</a>
                        <a class="nav-link" href="#">Mail settings</a>
                        <a class="nav-link" href="#">Newsletter</a> --}}
                    </nav>
                </aside>
                <div class="col-lg-9">
                    <section class="content-body p-xl-4">
                        <form id="formGuardar">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row gx-3">
                                        <input type="text" id="idrol" name="idrol" value="{{ $user->idrol }}"
                                            hidden>
                                        @if ($user->idrol == 1)
                                            <input type="text" id="id" name="id"
                                                value="{{ $user->administrador->id }}" hidden>
                                            <div class="col-12 mb-3">
                                                <label for="codadministrador">Codigo administrador *</label>
                                                <input type="text" class="form-control" name="codadministrador"
                                                    id="codadministrador" placeholder="Cod. administrador"
                                                    value="{{ $user->administrador->codigo_administrador }}" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="administrador">Administrador</label>
                                                <input class="form-control" type="text" id="administrador"
                                                    name="administrador" placeholder="Nombres completos"
                                                    value="{{ $user->administrador->administrador }}" required />
                                            </div>
                                            <!-- col .// -->
                                            <div class="col-lg-6 mb-3">
                                                <label for="emailadmin">Email</label>
                                                <input class="form-control" type="email" id="emailadmin" name="emailadmin"
                                                    placeholder="example@mail.com" value="{{ $user->administrador->email }}"
                                                    required />
                                            </div>
                                            <!-- col .// -->
                                            <div class="col-lg-6 mb-3">
                                                <label for="telefonoadmin">Telefono</label>
                                                <input class="form-control" type="tel" placeholder="+1234567890"
                                                    value="{{ $user->administrador->n_celular }}" id="telefonoadmin"
                                                    name="telefonoadmin" required />
                                            </div>
                                            <!-- col .// -->
                                            <div class="col-lg-12 mb-3">
                                                <label for="direccionadmin">Dirección</label>
                                                <input class="form-control" type="text" id="direccionadmin"
                                                    name="direccionadmin" placeholder="Dirección"
                                                    value="{{ $user->administrador->direccion }}" required />
                                            </div>
                                        @elseif($user->idrol == 2)
                                            <input type="text" id="id" name="id"
                                                value="{{ $user->asociacion->id }}" hidden>
                                            <div class="col-12 mb-3">
                                                <label for="codasociacion">Codigo asociacion *</label>
                                                <input type="text" class="form-control" id="codasociacion"
                                                    name="codasociacion" id="codasociacion" placeholder="Cod. asociacion"
                                                    value="{{ $user->asociacion->codigo_asociacion }}" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="asociacion">Asociación</label>
                                                <input class="form-control" type="text" id="asociacion" name="asociacion"
                                                    placeholder="Nombres completos"
                                                    value="{{ $user->asociacion->asociacion }}" required />
                                            </div>
                                            <!-- col .// -->
                                            <div class="col-lg-6 mb-3">
                                                <label for="emailasociacion">Email</label>
                                                <input class="form-control" type="email" id="emailasociacion"
                                                    name="emailasociacion" placeholder="example@mail.com"
                                                    value="{{ $user->asociacion->email }}" required />
                                            </div>
                                            <!-- col .// -->
                                            <div class="col-lg-6 mb-3">
                                                <label for="telefonoasociacion">Telefono</label>
                                                <input class="form-control" type="tel" id="telefonoasociacion"
                                                    name="telefonoasociacion" placeholder="+1234567890"
                                                    value="{{ $user->asociacion->n_celular }}" required />
                                            </div>
                                            <!-- col .// -->
                                            <!-- col .// -->
                                            <div class="col-lg-6 mb-3">
                                                <label for="iddepartamentoasociacion">Departamento</label>
                                                <select class="form-control form-control-chosen"
                                                    name="iddepartamentoasociacion" id="iddepartamentoasociacion"
                                                    data-placeholder="Seleccione una opción" required>
                                                    <option value=""></option>
                                                    @foreach ($departamentos as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $user->asociacion->municipio->iddepartamentos == $item->id ? 'selected' : '' }}>
                                                            {{ $item->departamento }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label for="idmunicipioasociacion">Municipio</label>
                                                <select class="form-control form-control-chosen"
                                                    name="idmunicipioasociacion" id="idmunicipioasociacion"
                                                    data-placeholder="Seleccione una opción" required>
                                                    @foreach ($user->asociacion->municipio->departamento->ciudades as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $user->asociacion->id_municipio == $item->id ? 'selected' : '' }}>
                                                            {{ $item->ciudad }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <label for="direcionasociacion">Dirección</label>
                                                <input class="form-control" type="text" id="direcionasociacion"
                                                    name="direcionasociacion" placeholder="Dirección"
                                                    value="{{ $user->asociacion->direccion }}" required />
                                            </div>
                                        @elseif($user->idrol == 3)
                                            <input type="text" id="id" name="id"
                                                value="{{ $user->vendedor->id }}" hidden>
                                            <div class="col-6 mb-3">
                                                <label for="idtipodocumento">Tipo documento *</label>
                                                <select class="form-control form-control-chosen" name="idtipodocumento"
                                                    id="idtipodocumento" data-placeholder="Seleccione una opción"
                                                    required>
                                                    <option value=""></option>
                                                    @foreach ($tiposDocumentos as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $user->vendedor->id_tipodocumento == $item->id ? 'selected' : '' }}>
                                                            {{ $item->tipo_documento }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label for="documentovendedor">Nº documento *</label>
                                                <input type="text" class="form-control" name="documentovendedor"
                                                    id="documentovendedor" placeholder="Nº documento"
                                                    value="{{ $user->vendedor->n_documento }}" required>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label for="nombrevendedor">Nombres</label>
                                                <input class="form-control" type="text"
                                                    placeholder="Nombres completos"
                                                    value="{{ $user->vendedor->nombres }}" name="nombrevendedor"
                                                    id="nombrevendedor" required />
                                            </div>
                                            <!-- col .// -->
                                            <div class="col-6 mb-3">
                                                <label for="apellidovendedor">Apellidos</label>
                                                <input class="form-control" type="text"
                                                    placeholder="Apellidos completos"
                                                    value="{{ $user->vendedor->apellidos }}" name="apellidovendedor"
                                                    id="apellidovendedor" required />
                                            </div>
                                            <!-- col .// -->
                                            <div class="col-lg-6 mb-3">
                                                <label for="emailvendedor">Email</label>
                                                <input class="form-control" type="email" placeholder="example@mail.com"
                                                    value="{{ $user->vendedor->email }}" name="emailvendedor"
                                                    id="emailvendedor" required />
                                            </div>
                                            <!-- col .// -->
                                            <div class="col-lg-6 mb-3">
                                                <label for="telefonovendedor">Telefono</label>
                                                <input class="form-control" type="tel" placeholder="+1234567890"
                                                    value="{{ $user->vendedor->n_celular }}" name="telefonovendedor"
                                                    id="telefonovendedor" required />
                                            </div>
                                            <!-- col .// -->
                                            <div class="col-lg-6 mb-3">
                                                <label for="iddepartamentovendedor">Departamento</label>
                                                <select class="form-control form-control-chosen"
                                                    name="iddepartamentovendedor" id="iddepartamentovendedor"
                                                    data-placeholder="Seleccione una opción" required>
                                                    <option value=""></option>
                                                    @foreach ($departamentos as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $user->vendedor->municipio->iddepartamentos == $item->id ? 'selected' : '' }}>
                                                            {{ $item->departamento }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label for="idmunicipiovendedor">Municipio</label>
                                                <select class="form-control form-control-chosen"
                                                    name="idmunicipiovendedor" id="idmunicipiovendedor"
                                                    data-placeholder="Seleccione una opción" required>
                                                    @foreach ($user->vendedor->municipio->departamento->ciudades as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $user->vendedor->id_municipio == $item->id ? 'selected' : '' }}>
                                                            {{ $item->ciudad }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- col .// -->
                                            <div class="col-lg-12 mb-3">
                                                <label for="direccionvendedor">Dirección</label>
                                                <input class="form-control" type="text" placeholder="Dirección"
                                                    value="{{ $user->vendedor->direccion }}" name="direccionvendedor"
                                                    id="direccionvendedor" required />
                                            </div>
                                        @endif
                                    </div>
                                    <!-- row.// -->
                                </div>
                                <!-- col.// -->
                                <aside class="col-lg-4">
                                    <figure class="text-lg-center">
                                        <img class="img-lg mb-3 img-avatar" src="assetsweb/imgs/people/avatar-1.png"
                                            alt="User Photo" />
                                        <figcaption>
                                            <a class="btn btn-light rounded font-md" href="#"> <i
                                                    class="icons material-icons md-backup font-md"></i> Cargar foto </a>
                                        </figcaption>
                                    </figure>
                                </aside>
                                <!-- col.// -->
                            </div>
                            <!-- row.// -->
                            <br />
                            <button class="btn btn-primary" type="button" id="enviar">Guardar</button>
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
                <!-- col.// -->
            </div>
            <!-- row.// -->
        </div>
        <!-- card body end// -->
    </div>
@endsection
