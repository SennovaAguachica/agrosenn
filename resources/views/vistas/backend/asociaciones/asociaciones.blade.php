@extends('../scripts.backend.asociaciones.asociacionesscript')
@section('titulo')
    <title>Asociaciones</title>
@endsection
@section('contenido')
    <div id="seccionlistar">
        <h2 class="text-center">Gestión Asociaciones</h2>
        <br>
        <div class="card mb-4">
            @can('asociaciones.guardar')
            <header class="card-header">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <button class="btn btn-primary" id="btnmodalguardar" data-bs-toggle="modal"
                            data-bs-target="#modalGuardarForm" style="color: white;"><i class="fas fa-plus"></i>
                            Asociación</button>
                    </div>
                </div>
            </header>
            @endcan
            <div class="card-body">
                <table id="tablaasociaciones" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Asociación</th>
                            <th>Codigo</th>
                            <th>Municipio</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('informacionModal')
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="asociacion">Nombre de asociación</label>
            <input type="text" class="form-control" name="asociacion" id="asociacion" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="codigoasociacion">Codigo de asociación</label>
            <input type="text" class="form-control" name="codigoasociacion" id="codigoasociacion" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="celular">Nº celular</label>
            <input type="tel" class="form-control" name="celular" id="celular" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12">
            <label for="email">Correo electronico</label>
            <input type="text" class="form-control" name="email" id="email" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="iddepartamento">Departamento</label>
            <select class="form-control form-control-chosen" name="iddepartamento" id="iddepartamento"
                data-placeholder="Seleccione una opción" required>
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
            <label for="idmunicipio">Municipio</label>
            <select class="form-control form-control-chosen" name="idmunicipio" id="idmunicipio"
                data-placeholder="Seleccione una opción" required>
            </select>
            <div class="invalid-feedback">
                Selecciona un municipio válido.
            </div>
        </div>
    </div>
    <br>
@endsection
