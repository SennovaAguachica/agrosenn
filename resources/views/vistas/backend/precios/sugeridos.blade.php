@extends('../scripts.backend.precios.sugeridosscript')
@section('titulo')
    <title>Precios</title>
@endsection
@section('contenido')
    <div id="seccionlistar">
        <h2 class="text-center">Precios sugeridos por tu asociación</h2>
        <br>
        <div class="card mb-4">
            
            <div class="card-body">
                <table id="tablasugeridos" class="table text-center table-hover" width="100%">
                    <thead style="text-align: center;">
                        <tr class="font-xxl">
                            <th>Producto</th>
                            <th>Unidades</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection