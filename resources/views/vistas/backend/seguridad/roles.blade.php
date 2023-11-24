@extends('../scripts.backend.seguridad.rolesscript')
@section('titulo')
    <title>Roles</title>
@endsection
@section('contenido')
    <div id="seccionlistar">
        <h2 class="text-center">Gestión roles</h2>
        <br>
        <div class="card mb-4">
            <div class="card-body">
                <table id="tablaroles" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
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
        <div class="col-md-12 col-lg-12 col-xs-12">
            <label for="rol">Rol</label>
            <label type="text" class="form-control" name="rol" id="rol"></label>
        </div>
    </div>
    <br>
    <div class="row">
        <h3 class="text-center">Permisos asociados</h3>
    </div>
    <div class="accordion" id="accordionPanelsStayOpenExample">
        @foreach ($permisos as $grupo => $permisosGrupo)
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading{{ $grupo }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapse{{ $grupo }}" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapse{{ $grupo }}">
                        {{ $grupo }}
                    </button>
                </h2>
                <div id="panelsStayOpen-collapse{{ $grupo }}" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-heading{{ $grupo }}">
                    <div class="accordion-body">
                        @foreach ($permisosGrupo as $permiso)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permisos[]"
                                    id="permiso{{ $permiso->id }}" value="{{ $permiso->name }}">
                                <label class="form-check-label" for="permiso{{ $permiso->id }}">
                                    {{ $permiso->description }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
