@extends('../scripts.backend.banners.bannersscript')
@section('titulo')
    <title>Banners</title>
@endsection
@section('contenido')
    <div id="seccionlistar">
        <h2 class="text-center">Gestión banners</h2>
        <br>
        <div class="card mb-4">
            @can('banners.guardar')
                <header class="card-header">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <button class="btn btn-primary" id="btnmodalguardar" data-bs-toggle="modal"
                                data-bs-target="#modalGuardarForm" style="color: white;"><i class="fas fa-plus"></i>
                                Banner</button>
                        </div>
                    </div>
                </header>
            @endcan
            <div class="card-body">
                <table id="tablabanners" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Tipo banner</th>
                            <th>Banner</th>
                            <th>Enlace</th>
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
            <label for="tipobanner">Tipo banner</label>
            <select class="form-control form-control-chosen" name="tipobanner" id="tipobanner"
                data-placeholder="Seleccione una opción" required>
                <option value="">Seleccione una opción</option>
                <option value="1">Banner principal</option>
                <option value="2">Banner secundario</option>

            </select>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12 ">
            <label for="enlace">Redireccion al dar click (Opcional)</label>
            <input type="text" id="enlace" name="enlace" class="form-control " placeholder="Ejemplo: /verduras">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12 ">
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen"
                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff, .webp, .gif /*" required>
            <div class="invalid-feedback">
                Campo obligatorio.
            </div>
        </div>
    </div>
    <br>
@endsection
