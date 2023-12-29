@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/ventas_peticiones";
        var TOTAL_VENTAS_FINALIZADAS_SIN_FECHAS = 4;
        var TOTAL_VENTAS_FINALIZADAS = 5;
        var VENTA_ENTRE_FECHAS = 6;
        var tablaFinalizadas = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_ventas').addClass('active open');
            $('#a_finalizadas').addClass('active');
            $('#i_ventas').css('color', '#3BB77E');
            cargarTablaFinalizadas();
            buttonClick();

            $('#fecha_inicio, #fecha_fin').on('change', function () {
                obtenerTotalVentasFinalizadas($("#fecha_inicio").val(), $("#fecha_fin").val());
                // Llamada para cargar las ventas entre las fechas seleccionadas
                cargarVentasEntreFechas($("#fecha_inicio").val(), $("#fecha_fin").val());
                
            });

        });

        

        function buttonClick() {


        }

        function cargarTablaFinalizadas() {
            tablaFinalizadas = $('#tablafinalizadas').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/ventasFinalizadas",
                    "type": "GET",
                },
                "columns": [{
                        data: null,
                        render: function(data, type, row) {
                            return data.cliente.nombres + ' ' + data.cliente.apellidos +
                                '<br> contacto: ' + data.cliente.n_celular + '<br>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return data.publicaciones.productos.producto + '<br>' +
                                data.publicaciones.unidades.unidad;
                        }
                    },
                    {
                        data: 'cantidad'
                    },
                    {
                        data: 'publicaciones.precios.precio',
                    },
                    {
                        data: 'iva',
                    },
                    {
                        data: 'precio_subtotal',
                    },
                    {
                        data: 'fecha_venta',
                        render: function (data, type, row) {
                            return formatearFecha(data);
                        }
                    },
                    
                ],
                "columnDefs": [{
                    "className": "dt-center font-xxl",
                    "targets": "_all"
                }],
                "createdRow": function(row, data, dataIndex) {
                    // Set the data-status attribute, and add a class
                    $(row).addClass("" + data.id);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });
            obtenerTotalVentasSinFechas();
        }


        function obtenerTotalVentasSinFechas() {
            $.ajax({
                url: AJAX,
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    accion: TOTAL_VENTAS_FINALIZADAS_SIN_FECHAS
                },
                success: function(response) {
                    $('#totalVentas').text(response.totalVentas);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function obtenerTotalVentasFinalizadas(fecha_inicio, fecha_fin) {
        $.ajax({
        url: AJAX,
        type: 'GET',
        dataType: 'json',
        data: {
            "_token": "{{ csrf_token() }}",
            accion: TOTAL_VENTAS_FINALIZADAS,
            fecha_inicio: $('#fecha_inicio').val(),
            fecha_fin: $('#fecha_fin').val(),
        },
        success: function (respuesta) {
            $('#totalVentas').text(respuesta.totalVentas);
        },
        error: function (request, status, error) {
            console.error('Error al obtener el total de ventas finalizadas:', error);
        }
    });
}


function cargarVentasEntreFechas(fecha_inicio, fecha_fin) {
    var fechaInicio = $('#fecha_inicio').val();
    var fechaFin = $('#fecha_fin').val();

    $.ajax({
        url: AJAX,
        method: 'GET',
        data: {
            "_token": "{{ csrf_token() }}",
            accion: VENTA_ENTRE_FECHAS,
            fecha_inicio: fechaInicio,
            fecha_fin: fechaFin
        },
        success: function(response) {
            console.log('Respuesta completa:', response);

            var tablaTemporal = $('#tablafechas').DataTable();

            if ($.fn.DataTable.isDataTable('#tablafechas')) {
                tablaTemporal.destroy();
            }
            // Limpiar y actualizar la tabla oculta

            tablaTemporal = $('#tablafechas').DataTable(
                {
                "responsive": true,  // Hace la tabla responsive
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"  // Traducción al español
                },
                // Agrega otras configuraciones necesarias
            }
            );
            tablaTemporal.clear().draw();

            if (response.ventas && response.ventas.length > 0) {
                response.ventas.forEach(function(venta) {
                    tablaTemporal.row.add([
                        venta.cliente && venta.cliente.nombres ? venta.cliente.nombres : '',
                        venta.publicaciones.productos.producto,
                        venta.cantidad,
                        venta.publicaciones.precios.precio,
                        venta.iva,
                        venta.precio_subtotal,
                        formatearFecha(venta.fecha_venta),
                    ]).draw();
                });
            } else {
                console.error('La respuesta no contiene datos válidos:', response);
            }

            // Ocultar la tabla visible
            $('#tablafinalizadas').hide();
            $('#tablafinalizadas_wrapper').hide();

            // Mostrar la tabla oculta
            $('#tablafechas').show();
        },
        error: function(error) {
            console.error('Error al obtener las ventas:', error);
        },
    });
}

function buscarVentasEntreFechas() {
    var fechaInicio = $('#fecha_inicio').val();
    var fechaFin = $('#fecha_fin').val();

    // Realiza la búsqueda en la tabla basada en las fechas
    tablaFinalizadas.search('').columns().search('').draw(); // Reinicia la búsqueda

    if (fechaInicio && fechaFin) {
        // Establece los valores de búsqueda para las columnas específicas
        tablaFinalizadas.columns(6).search(fechaInicio + ' ' + fechaFin).draw(); // Ajusta la columna de fecha
    }
}

function formatearFecha(fecha) {
    var fechaObj = new Date(fecha);
    var opciones = { year: 'numeric', month: 'long', day: 'numeric' };
    return fechaObj.toLocaleDateString('es-ES', opciones);
}

</script>
@endsection
