@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/precios_peticiones";
        var tablaSugeridos = "";
        $(document).ready(function() {
            $('#li_precios').addClass('active');
            $('#i_precios').css('color', '#3BB77E');
            $('#a_sugeridos').addClass('active');
            cargarTablaSugeridos();
        });

        function cargarTablaSugeridos() {
            tablaSugeridos = $('#tablasugeridos').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/sugeridos",
                    "type": "GET",
                },
                "columns": [{
                        data: 'productos.producto'
                    },
                    {
                        data: 'unidades.unidad'
                    },
                    {
                        data: 'precio',
                        render: function(data, type, row) {
                            return '$' + number_format(data);
                        }
                    }
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