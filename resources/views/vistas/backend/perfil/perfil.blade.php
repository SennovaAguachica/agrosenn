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
                        <form>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row gx-3">
                                        <div class="col-6 mb-3">
                                            <label for="idtipodocumento">Tipo documento *</label>
                                            <select class="form-control form-control-chosen" name="idtipodocumento"
                                                id="idtipodocumento" data-placeholder="Seleccione una opción" required>
                                                <option value=""></option>
                                                @foreach ($tiposDocumentos as $item)
                                                    <option value="{{ $item->id }}">{{ $item->tipo_documento }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- col .// -->
                                        <div class="col-6 mb-3">
                                            <label for="documento">Nº documento *</label>
                                            <input type="text" class="form-control" name="documento" id="documento" placeholder="Nº documento"
                                                required>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label">Nombres</label>
                                            <input class="form-control" type="text" placeholder="Nombres completos" />
                                        </div>
                                        <!-- col .// -->
                                        <div class="col-6 mb-3">
                                            <label class="form-label">Apellidos</label>
                                            <input class="form-control" type="text" placeholder="Apellidos completos" />
                                        </div>
                                        <!-- col .// -->
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" type="email" placeholder="example@mail.com" />
                                        </div>
                                        <!-- col .// -->
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Telefono</label>
                                            <input class="form-control" type="tel" placeholder="+1234567890" />
                                        </div>
                                        <!-- col .// -->
                                        <div class="col-lg-6 mb-3">
                                            <label for="iddepartamento">Departamento</label>
                                            <select class="form-control form-control-chosen" name="iddepartamento"
                                                id="iddepartamento" data-placeholder="Seleccione una opción" required>
                                                <option value=""></option>
                                                @foreach ($departamentos as $item)
                                                    <option value="{{ $item->id }}">{{ $item->departamento }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="idmunicipio">Municipio</label>
                                            <select class="form-control form-control-chosen" name="idmunicipio"
                                                id="idmunicipio" data-placeholder="Seleccione una opción" required>
                                            </select>
                                        </div>
                                        <!-- col .// -->
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Dirección</label>
                                            <input class="form-control" type="text" placeholder="Dirección" />
                                        </div>
                                        <!-- col .// -->
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
                            <button class="btn btn-primary" type="submit">Guardar</button>
                        </form>
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
