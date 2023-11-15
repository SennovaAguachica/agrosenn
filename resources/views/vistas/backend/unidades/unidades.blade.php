@extends('../scripts.backend.unidades.unidadesscript')
@section('titulo')
    <title>Unidades</title>
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
        <h2 class="text-center">Gestión unidades de medida</h2>
        <br>
        <div class="card mb-4">
            @can('unidades.guardar')
            <header class="card-header">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <button class="btn btn-primary" id="btnmodalguardar" data-bs-toggle="modal"
                            data-bs-target="#modalGuardarForm" style="color: white;"><i class="fas fa-plus"></i>
                            Unidad de medida</button>
                    </div>
                </div>
            </header>
            @endcan
            <div class="card-body">
                <table id="tablaunidades" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Unidad</th>
                            <th>Abreviatura</th>
                            <th>Tipo de unidad</th>
                            <th>Descripcion</th>
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
            <label for="unidad">Nombre de la unidad</label>
            <input type="text" class="form-control" name="unidad" id="unidad" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12 ">
            <label for="abreviatura">Abreviatura</label>
            <input type="text" class="form-control" name="abreviatura" id="abreviatura" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12">
            <label for="idtipounidades">Tipo de unidad</label>
            <select class="form-control form-control-chosen" name="idtipounidades" id="idtipounidades"
                data-placeholder="Seleccione una opción" required>
                <option value=""></option>
                @foreach ($tipounidades as $item)
                    <option value="{{ $item->id }}">{{ $item->tipo_unidad }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Selecciona una tipo de unidad válido.
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12 ">
            <label for="descripcion">Descripción</label>
            <textarea type="text" class="form-control" name="descripcion" id="descripcion"></textarea>
        </div>
    </div>
    <br>
@endsection
