@extends('../scripts.backend.subcategorias.subcategoriasscript')
@section('titulo')
    <title>Subcategorias</title>
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
        <h2 class="text-center">Gestión subcategorias de productos</h2>
        <br>
        <div class="card mb-4">
            <header class="card-header">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <button class="btn btn-primary" id="btnmodalguardar" data-bs-toggle="modal"
                            data-bs-target="#modalGuardarFormSubcategoria" style="color: white;"><i class="fas fa-plus"></i>
                            Subcategoria</button>
                    </div>
                </div>
            </header>
            <div class="card-body">
                <table id="tablasubcategorias" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Imagen</th>
                            <th>Subcategoria</th>
                            <th>Categoria</th>
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
@section('subcategoriaModal')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12 ">
            <label for="subcategoria">Nombre de la subcategoría</label>
            <input type="text" class="form-control" name="subcategoria" id="subcategoria" required>
            <div class="invalid-feedback">
                Campo obligatorio.
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
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12 ">
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff, .webp, |image/*"
                required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12 ">
            <label for="tipoSubcategoria">Categoría asociada</label>
            <select class="form-control form-control-chosen" name="tipoSubcategoria" id="tipoSubcategoria"
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
@endsection