@extends('../scripts.backend.seguridad.usuariosscript')
@section('titulo')
    <title>Usuarios</title>
@endsection
@section('contenido')
    <div id="seccionlistar">
        <h2 class="text-center">Gestión usuarios</h2>
        <br>
        <div class="card mb-4">
            <div class="card-body">
                <table id="tablausuarios" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Rol</th>
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
        <div class="col-md-12 col-lg-12 col-xs-12 ">
            <label for="idrol">Roles</label>
            <select class="form-control form-control-chosen" name="idrol" id="idrol"
                data-placeholder="Seleccione una opción" required>
                <option value=""></option>
                @foreach ($roles as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Selecciona un rol válido.
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control" name="usuario" id="usuario" disabled>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="identificacion">Nº identificación</label>
            <input type="text" class="form-control" name="identificacion" id="identificacion" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-6">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
    </div>
@endsection
