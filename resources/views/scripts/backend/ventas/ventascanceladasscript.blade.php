@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var tablaCanceladas = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_ventas').addClass('active open');
            $('#a_canceladas').addClass('active');
            $('#i_ventas').css('color', '#3BB77E');
            cargarTablaCanceladas();
            buttonClick();
        });

        

        function buttonClick() {


        }

        function cargarTablaCanceladas() {
            tablaCanceladas = $('#tablacanceladas').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/ventasCanceladas",
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
                            // Formatear la fecha aquí
                            var fecha = new Date(data);
                            var opciones = { year: 'numeric', month: 'long', day: 'numeric' };
                            return fecha.toLocaleDateString('es-ES', opciones);
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
        }


        

</script>
@endsection
