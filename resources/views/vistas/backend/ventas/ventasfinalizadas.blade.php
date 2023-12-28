@extends('../scripts.backend.ventas.ventasfinalizadasscript')
@section('titulo')
    <title>Ventas</title>
@endsection
@section('contenido')

<div id="seccionlistar">
    <h2 class="text-center">Ventas finalizadas con éxito</h2>
    <br>
    <div class="card mb-4">
        <header class="card-header">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Desde...</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha inicio" class="form-control">
                </div>
            
                <div class="col-md-4 mb-3">
                    <label>Hasta...</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" placeholder="Fecha fin" class="form-control">
                </div>
            
                <div class="col-md-4 mb-3">
                    <label>Total de ventas finalizadas: </label>
                    <br>
                    <label>$</label>
                    <span id="totalVentas"></span>
                </div>
            </div>
        </header>
        <div class="card-body">
            <table id="tablafinalizadas" class="table text-center table-hover" width="100%">
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
            <table id="tablafechas" class="table text-center table-hover" width="100%" style="display: none;">
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
