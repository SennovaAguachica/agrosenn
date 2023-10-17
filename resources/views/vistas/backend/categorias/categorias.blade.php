@extends('../scripts.backend.categorias.categoriasscript')
@section('titulo')
    <title>Categorias</title>
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
        <h2 class="text-center">Gestión categorias de productos</h2>
        <br>
        <div class="card mb-4">
            <header class="card-header">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <button class="btn btn-success " id="btnguardar" data-bs-toggle="modal"
                            data-bs-target="#modalGuardarCategorias" style="color: white;"><i class="fas fa-plus"></i>
                            Categoria</button>
                    </div>
                </div>
            </header>
            <div class="card-body">
                <table id="tablacategorias" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Imagen</th>
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
@section('modalcategoria')
    <div class="row">
        <div class="col-md-23">
            <label for="categoria">Nombre de categoria</label>
            <input type="text" class="form-control" name="categoria" id="categoria" required>
            <div class="invalid-feedback">
                Campo obligatorio.
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
        <div class="col-md-12">
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
@endsection
