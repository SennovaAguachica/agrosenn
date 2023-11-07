@extends('../scripts.backend.equivalencias.equivalenciasscript')
@section('titulo')
    <title>Equivalencias</title>
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
        <h2 class="text-center">Gestión equivalencias de unidades</h2>
        <br>
        <div class="card mb-4">
            @can('equivalencias.guardar')
            <header class="card-header">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <button class="btn btn-primary" id="btnmodalguardar" data-bs-toggle="modal"
                            data-bs-target="#modalGuardarForm" style="color: white;"><i class="fas fa-plus"></i>
                            Equivalencia</button>
                    </div>
                </div>
            </header>
            @endcan
            <div class="card-body">
                <table id="tablaequivalencias" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Unidad</th>
                            <th>Equivalencia</th>
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
        <label for="idunidades">Unidad a convertir</label>
        <select class="form-control form-control-chosen" name="idunidades" id="idunidades"
            data-placeholder="Seleccione una opción" required>
            <option value=""></option>
            @foreach ($unidades as $item)
                <option value="{{ $item->id }}">{{ $item->unidad }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            Selecciona una unidad válida.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6 col-xs-6">
        <label for="idequivalencias">Unidad mínima equivalente</label>
        <select class="form-control form-control-chosen" name="idequivalencias" id="idequivalencias"
            data-placeholder="Seleccione una opción" required>
            <option value=""></option>
            @foreach ($equivalencias as $item)
                <option value="{{ $item->id }}">{{ $item->unidad }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            Selecciona una unidad válida.
        </div>
    </div>
    <br>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12 ">
        <label for="equivalencia">Equivalencia entre unidades</label>
        <input type="number" class="form-control" name="equivalencia" id="equivalencia" required>
        <div class="invalid-feedback">
            Campo obligatorio.
        </div>
    </div>
</div>
</div>
<br>
@endsection