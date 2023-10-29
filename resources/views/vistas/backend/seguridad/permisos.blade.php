@extends('../scripts.backend.seguridad.permisosscript')
@section('titulo')
    <title>Permisos</title>
    <style>
        .is-invalid {
            border-color: #f00;
            /* Color rojo */
        }

        .valid {
            border-color: #198754 !important;
        }

        .selected {
            color: white !important;
            background-color: #ffffff !important;
        }

        .table-hover tbody tr:hover td,
        .table-hover tbody tr:hover th {
            background-color: #f00;
        }
    </style>
@endsection
@section('contenido')
    <div id="seccionlistar">
        <h2 class="text-center">Gestión permisos</h2>
        <br>
        <div class="card mb-4">
            @can('permisos.guardar')
                <header class="card-header">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <button class="btn btn-primary" id="btnmodalguardar" data-bs-toggle="modal"
                                data-bs-target="#modalGuardarForm" style="color: white;"><i class="fas fa-plus"></i>
                                Permiso</button>
                        </div>
                    </div>
                </header>
            @endcan
            <div class="card-body">
                <table id="tablapermisos" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Permiso</th>
                            <th>Descripción</th>
                            <th>Grupo</th>
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
        <div class="col-md-12 col-lg-12 col-xs-12">
            <strong for="permiso">Permiso</strong>
            <input type="text" class="form-control" name="permiso" id="permiso">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-6">
            <strong for="descripcion">Descripción</strong>
            <input type="text" class="form-control" name="descripcion" id="descripcion">
        </div>
        <div class="col-md-6 col-lg-6 col-xs-6">
            <strong for="grupo">Grupo</strong>
            <input type="text" class="form-control" name="grupo" id="grupo">
        </div>
    </div>
@endsection
