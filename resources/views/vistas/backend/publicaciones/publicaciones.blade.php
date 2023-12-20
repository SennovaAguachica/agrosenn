@extends('../scripts.backend.publicaciones.publicacionesscript')
@section('titulo')
    <title>Publicaciones</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css" rel="stylesheet" type="text/css" />


@endsection
@section('contenido')
    <div id="seccionlistar">
        <h2 class="text-center">Mis publicaciones</h2>
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
                            <th>Unidad</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Descripcion</th>
                            <th>IVA</th>
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
    <div class="col-md-12 col-lg-12 col-xs-12">
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
    <div class="col-md-6 col-lg-6 col-xs-6">
        {{-- <label for="listadoprecios">Precio sugerido</label>
        <select class="selectpicker form-control form-control-chosen" multiple name="listadoprecios" id="listadoprecios"
        data-placeholder="Selecciona los precios" required>
        {{-- <option value=""></option>
        @foreach ($listaPrecios as $item)
            <option value="{{ $item->id }}">{{ $item->id }} {{ $item->producto_id }} {{ $item->estado }}</option>
        @endforeach 
        </select>
        <div class="invalid-feedback">
            Campo obligatorio.
        </div> --}}
        <label for="listadoprecios">Precio sugerido</label>
        <input type="text" class="form-control" name="listadoprecios" id="listadoprecios" readonly>
    </div>
    <div class="col-md-6 col-lg-6 col-xs-6">
        <label for="precio">Mi precio</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">$</div>
            </div>
            <input id="idpreciovendedor" name="idpreciovendedor" type="hidden" value="" />
            <input type="number" class="form-control" name="precio" id="precio" required>
            <div class="invalid-feedback">
            Campo obligatorio.
            </div>
        </div>
    </div>
</div>
<br>
    <div class="row">
        <div class="col-md-12">
            <label for="descripcion">Descripción</label>
            <textarea type="text" class="form-control" name="descripcion" id="descripcion"></textarea>
        </div>
    </div>
<br>
<div class="row">
    <div class="col-md-6">
        <label for="iva" class="form-label">IVA</label>
        <input type="text" class="form-control" name="iva" id="iva" >
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12 ">
        <label for="imagen">Imágenes</label>
        <input type="file" id="imagen" name="imagen[]" multiple accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff, .webp, |image/*"
            required>
        <div class="invalid-feedback">
            Campo obligatorio.
        </div>
    </div>
</div>
@endsection