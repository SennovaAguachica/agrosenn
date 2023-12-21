@extends('../scripts.backend.productos.productosscript')
@section('titulo')
    <title>Productos</title>
@endsection
@section('contenido')
    <div id="seccionlistar">
        <h2 class="text-center">Gestión productos</h2>
        <br>
        <div class="card mb-4">
            @can('productos.guardar')
                <header class="card-header">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <button class="btn btn-primary" id="btnguardar" data-bs-toggle="modal"
                                data-bs-target="#modalGuardarProductos" style="color: white;"><i class="fas fa-plus"></i>
                                Producto</button>
                        </div>
                    </div>
                </header>
            @endcan
            <div class="card-body">
                <table id="tablaproductos" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Categoria</th>
                            <th>Subcategoria</th>
                            <th>Descripcion</th>
                            {{-- <th>Precio</th> --}}
                            {{-- <th>Estado</th> --}}
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
@section('modal')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xs-6">
                <label for="idcategoria">Categorías</label>
                <select class="form-control form-control-chosen" name="idcategoria" id="idcategoria"
                    data-placeholder="Seleccione una opción" required>
                    <option value=""></option>
                    @foreach ($categorias as $item)
                        <option value="{{ $item->id }}">{{ $item->categoria }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Selecciona una categoría válida.
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xs-6">
                <label for="tipoProducto">Subcategoría</label>
                <select class="form-control form-control-chosen" name="tipoProducto" id="tipoProducto"
                    data-placeholder="Seleccione una opción" required>
                </select>
                <div class="invalid-feedback">
                    Selecciona una subcategoría válida.
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <label for="nombreProducto" class="form-label">Producto</label>
                <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>
            {{-- <div class="col-md-6">
            <label for="precioProducto" class="form-label">Precio</label>
            <input type="text" class="form-control moneda" name="precioProducto" id="precioProducto" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div> --}}
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <label for="descripcionProducto">Descripción</label>
                <textarea type="text" class="form-control" name="descripcionProducto" id="descripcionProducto"></textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <label for="imagenproducto" class="form-label">Imagen</label>
                <input type="file" id="imagenproducto" name="imagenproducto"
                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff, .webp,|image/*" required>
                <div class="invalid-feedback">
                    Campo obligatorio.
                </div>
            </div>
        </div>
    </div>
@endsection
