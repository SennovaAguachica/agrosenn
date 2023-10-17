@extends('../scripts.backend.productos.productosscript')
@section('titulo')
    <title>Productos</title>
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
        <h2 class="text-center">Gestión productos</h2>
        {{-- <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label>Acudientes</label>
                <select multiple name="idacudientes" id="idacudientes" class="form-control form-control-chosen"
                    data-placeholder="Buscar acudientes...">
                    <option value="">Seleccione una opción</option>
                </select>
            </div>
        </div> --}}
        <br>
        <div class="card mb-4">
            <header class="card-header">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <button class="btn btn-success " id="btnguardar" data-bs-toggle="modal"
                            data-bs-target="#modalGuardarProductos" style="color: white;"><i class="fas fa-plus"></i>
                            Producto</button>
                    </div>
                </div>
            </header>
            <div class="card-body">
                <table id="tablaproductos" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Estado</th>
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
    <div class="row">
        <div class="col-md-12">
            <label for="tipoProducto" class="form-label">Tipo producto</label>
            <select class="form-control form-control-chosen" name="tipoProducto" id="tipoProducto"
                data-placeholder="Seleccione una opción" required>
                <option value=""></option>
                @foreach ($categorias as $item)
                    <option value="{{ $item->id }}">{{ $item->categoria }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Selecciona un tipo de producto válido.
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <label for="nombreProducto" class="form-label">Producto</label>
            <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
        <div class="col-md-6">
            <label for="precioProducto" class="form-label">Precio</label>
            <input type="text" class="form-control moneda" name="precioProducto" id="precioProducto" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
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
                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
@endsection
