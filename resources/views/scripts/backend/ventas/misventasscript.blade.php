@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/ventas_peticiones";
        var FINALIZAR_VENTA = 1;
        var CANCELAR_VENTA = 2;
        var tablaActivas = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_ventas').addClass('active open');
            $('#a_ventas').addClass('active');
            $('#i_ventas').css('color', '#3BB77E');
            cargarTablaActivas();
            buttonClick();
        });


        function buttonClick() {


        }


        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaActivas.row("." + data).node();
            $(fila).addClass('selected');
            parametro_seleccionado = $("#tablaactivas").DataTable().row('.selected').data();
            if (modo == 1) {
                finalizarVenta(parametro_seleccionado.id);
            } else if (modo == 2) {
                cancelarVenta(parametro_seleccionado.id);
            }
        }

        function cargarTablaActivas() {
            tablaActivas = $('#tablaactivas').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/ventas",
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
                    },
                    {
                        data: 'action'
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

        function finalizarVenta(id) {
            Swal.fire({
                title: '¿Esta seguro?',
                text: "Recuerde hacer esto sólo cuando la venta con el cliente haya llegado a buen término",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/ventas_peticiones", // Reemplaza esto con la URL del servidor
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            accion: FINALIZAR_VENTA,
                            id: parametro_seleccionado.id,

                        },
                        beforeSend: function() {
                            $(".carga").removeClass("hidden").addClass("show");
                        },
                        success: function(respuesta) {
                            // Maneja la respuesta del servidor aquí
                            if (respuesta.estado === 1) {
                                mensajeSuccessGeneral(
                                    '- La venta finalizó con éxito');
                                tablaActivas.ajax.reload();
                            } else {
                                mensajeError(respuesta.mensaje);
                            }
                            $(".carga").removeClass("show").addClass("hidden");
                        },
                        error: function(request, status, error) {
                            mensajeErrorGeneral(
                                "Se produjo un error durante el proceso, vuelve a intentarlo"
                            );
                            $(".carga").removeClass("show").addClass("hidden");
                        }
                    });
                }
            });
        }

        function cancelarVenta(id) {
            Swal.fire({
                title: '¿Esta seguro?',
                text: "Esto cancelará la venta, recuerde hacerlo cuando no se haya concretado una venta",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/ventas_peticiones", // Reemplaza esto con la URL del servidor
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            accion: CANCELAR_VENTA,
                            id: parametro_seleccionado.id,

                        },
                        beforeSend: function() {
                            $(".carga").removeClass("hidden").addClass("show");
                        },
                        success: function(respuesta) {
                            // Maneja la respuesta del servidor aquí
                            if (respuesta.estado === 1) {
                                mensajeSuccessGeneral(
                                    '- Venta cancelada');
                                tablaActivas.ajax.reload();
                            } else {
                                mensajeError(respuesta.mensaje);

                            }
                            $(".carga").removeClass("show").addClass("hidden");
                        },
                        error: function(request, status, error) {
                            mensajeErrorGeneral(
                                "Se produjo un error durante el proceso, vuelve a intentarlo"
                            );
                            $(".carga").removeClass("show").addClass("hidden");
                        }
                    });
                }
            });
        }
    </script>
@endsection
