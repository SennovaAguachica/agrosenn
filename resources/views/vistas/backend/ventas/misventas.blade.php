@extends('../scripts.backend.ventas.misventasscript')
@section('titulo')
    <title>Ventas</title>
@endsection
@section('contenido')

<div id="seccionlistar">
    <h2 class="text-center">Mis ventas activas</h2>
    <br>
    <div class="card mb-4">
        <div class="card-body">
            <table id="tablaactivas" class="table text-center table-hover" width="100%">
                <thead style="text-align: center;">
                    <tr class="font-xxl">
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>IVA</th>
                        <th>Precio total</th>
                        <th>Fecha</th>
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
