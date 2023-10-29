@extends('../scripts.backend.administradores.administradoresscript')
@section('titulo')
    <title>Administradores</title>
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
        <h2 class="text-center">Gestión Administradores</h2>
        <br>
        <div class="card mb-4">
            @can('administradores.guardar')
            <header class="card-header">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <button class="btn btn-primary" id="btnmodalguardar" data-bs-toggle="modal"
                            data-bs-target="#modalGuardarForm" style="color: white;"><i class="fas fa-plus"></i>
                            Administrador</button>
                    </div>
                </div>
            </header>
            @endcan
            <div class="card-body">
                <table id="tablaadministradores" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Administrador</th>
                            <th>Codigo</th>
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
            <label for="administrador">Nombre de Administrador</label>
            <input type="text" class="form-control" name="administrador" id="administrador" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="codigoadministrador">Codigo de Administrador</label>
            <input type="text" class="form-control" name="codigoadministrador" id="codigoadministrador" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="celular">Nº celular</label>
            <input type="tel" class="form-control" name="celular" id="celular" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="email">Correo electronico</label>
            <input type="text" class="form-control" name="email" id="email" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
@endsection
