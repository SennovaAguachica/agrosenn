@extends('../scripts.backend.precios.preciosscript')
@section('titulo')
    <title>Precios</title>
@endsection
@section('contenido')
    <div id="seccionlistar">
        <h2 class="text-center">Listado de precios</h2>
        <br>
        <div class="card mb-4">
            @can('precios.guardar')
            <header class="card-header">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <button class="btn btn-primary" id="btnmodalguardar" data-bs-toggle="modal"
                            data-bs-target="#modalGuardarForm" style="color: white;"><i class="fas fa-plus"></i>
                            Precio</button>
                    </div>
                </div>
            </header>
            @endcan
            <div class="card-body">
                <table id="tablaprecios" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Producto</th>
                            <th>Unidades</th>
                            <th>Precio</th>
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
        <label for="idproductos">Producto</label>
        <select class="form-control form-control-chosen" name="idproductos" id="idproductos"
            data-placeholder="Seleccione una opción" required>
            <option value=""></option>
            @foreach ($productos as $item)
                <option value="{{ $item->id }}">{{ $item->producto }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            Selecciona un producto válido.
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12">
        <label for="idunidades">Unidad</label>
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
<br>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12 ">
        <label for="precio">Precio</label>
        <input type="number" class="form-control" name="precio" id="precio" required>
        <div class="invalid-feedback">
            Campo obligatorio.
        </div>
    </div>
</div>
@endsection