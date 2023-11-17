@extends('../scripts.backend.publicaciones.publicacionesscript')
@section('titulo')
    <title>Publicaciones</title>
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
        <h2 class="text-center">Listado de publicaciones</h2>
        <br>
        <div class="card mb-4">
            @can('publicaciones.guardar')
            <header class="card-header">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <button class="btn btn-primary" id="btnmodalguardar" data-bs-toggle="modal"
                            data-bs-target="#modalGuardarForm" style="color: white;"><i class="fas fa-plus"></i>
                            Publicación</button>
                    </div>
                </div>
            </header>
            @endcan
            <div class="card-body">
                <table id="tablapublicaciones" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Producto</th>
                            <th>Stock</th>
                            <th>Precios</th>
                            <th>Imágenes</th>
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
    <label for="sectionunidades">¿Cuánto vas a vender?</label>
    <div class="col-md-6 col-lg-6 col-xs-6">
        <label for="oferta">Cantidad</label>
        <input type="number" class="form-control" name="oferta" id="oferta" required>
        <div class="invalid-feedback">
            Campo obligatorio.
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xs-6">
        <label for="idunidades">Unidad ofertada</label>
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
        <label for="listadoprecios">Precios</label>
        <select class="selectpicker form-control form-control-chosen" multiple name="listadoprecios" id="listadoprecios"
        data-placeholder="Selecciona los precios" required>
        {{-- <option value=""></option>
        @foreach ($listaPrecios as $item)
            <option value="{{ $item->id }}">{{ $item->id }} {{ $item->producto_id }} {{ $item->estado }}</option>
        @endforeach --}}
    </select>
        <div class="invalid-feedback">
            Campo obligatorio.
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12 ">
        <label for="imagen">Imágenes</label>
        <br>
        <input type="file" id="imagen" name="imagen" multiple accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff, .webp, |image/*"
            required>
        <div class="invalid-feedback">
            Campo obligatorio.
        </div>
    </div>
</div>
@endsection