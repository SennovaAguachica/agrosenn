@extends('../scripts.backend.ventas.ventascanceladasscript')
@section('titulo')
    <title>Ventas</title>
@endsection
@section('contenido')

<div id="seccionlistar">
    <h2 class="text-center">Ventas canceladas</h2>
    <br>
    <div class="card mb-4">
        <div class="card-body">
            <table id="tablacanceladas" class="table text-center table-hover" width="100%">
                <thead style="text-align: center;">
                    <tr class="font-xxl">
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>IVA</th>
                        <th>Precio total</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div> 
    </div>
</div>
@endsection
