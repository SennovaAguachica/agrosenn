@extends('../scripts.backend.vendedores.vendedoresscript')
@section('titulo')
    <title>Vendedores</title>
@endsection
@section('contenido')
    <div id="seccionlistar">
        <h2 class="text-center">Gestión Vendedores</h2>
        <br>
        <div class="card mb-4">
            @can('vendedores.guardar')
                <header class="card-header">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <button class="btn btn-primary" id="btnmodalguardar" data-bs-toggle="modal"
                                data-bs-target="#modalGuardarForm" style="color: white;"><i class="fas fa-plus"></i>
                                Vendedor</button>
                        </div>
                    </div>
                </header>
            @endcan
            <div class="card-body">
                <table id="tablavendedores" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Nº documento</th>
                            <th>Vendedor</th>
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
            <label for="idtipodocumento">Tipo documento *</label>
            <select class="form-control form-control-chosen" name="idtipodocumento" id="idtipodocumento"
                data-placeholder="Seleccione una opción" required>
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
            <input type="text" class="form-control" name="documento" id="documento" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="nombres">Nombres *</label>
            <input type="text" class="form-control" name="nombres" id="nombres" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="apellidos">Apellidos *</label>
            <input type="text" class="form-control" name="apellidos" id="apellidos" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="celular">Nº celular *</label>
            <input type="tel" class="form-control" name="celular" id="celular" required>
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
            <label for="idmunicipio">Municipio *</label>
            <select class="form-control form-control-chosen" name="idmunicipio" id="idmunicipio"
                data-placeholder="Seleccione una opción" required>
            </select>
            <div class="invalid-feedback">
                Selecciona un municipio válido.
            </div>
        </div>
    </div>
@endsection
