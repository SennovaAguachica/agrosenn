@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/precios_peticiones";
        var GUARDAR_PRECIOS = 1;
        var ACTUALIZAR_PRECIOS = 2;
        var ELIMINAR_PRECIOS = 3;
        var parametro_seleccionado = "";
        var tablaPrecios = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_precios').addClass('active');
            $('#i_precios').css('color', '#3BB77E');
            cargarTablaPrecios();
            guardarPrecio();
            inputMoneda('#precio');
            buttonClicks();
        });

        function buttonClicks() {
            $("#btnmodalguardar").on("click", function(e) {
                vista = 1;
                $('#idunidades').val("").trigger("chosen:updated");
                $('#idproductos').val("").trigger("chosen:updated");
                $("#formGuardar")[0].reset();
            });
        }

        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaPrecios.row("." + data).node();
            $(fila).addClass('selected');
            parametro_seleccionado = $("#tablaprecios").DataTable().row('.selected').data();
            
            if (modo == 1) {
                // $("#precio").val(parametro_seleccionado.precio);
                $("#precio").val('$' + number_format(parametro_seleccionado.precio));
                $("#idproductos").val(parametro_seleccionado.producto_id);
                $("#idproductos").trigger("chosen:updated");
                $("#idunidades").val(parametro_seleccionado.unidades_id);
                $("#idunidades").trigger("chosen:updated");
            } else if (modo == 2) {
                eliminarPrecio(parametro_seleccionado.id);
                
            }
        }

        function guardarPrecio() {
            $("#enviar").on("click", function(e) {
                let datosFormulario = "";
                e.preventDefault(); // Previene el envío por defecto del formulario
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formGuardar");

                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    return;
                }

                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formGuardar')[0]);
                datosFormulario.append('precio', $("#precio").unmask());
                if (vista == 1) {
                    datosFormulario.append('accion', GUARDAR_PRECIOS);
                } else if (vista == 2) {
                    datosFormulario.append('id', parametro_seleccionado.id);
                    datosFormulario.append('accion', ACTUALIZAR_PRECIOS);
                }
                console.log(datosFormulario);
                // Realiza la solicitud Ajax
                Swal.fire({
                    title: 'Esta seguro?',
                    text: "Recuerde verificar los datos!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/precios_peticiones", // Reemplaza esto con la URL del servidor
                            method: "POST",
                            data: datosFormulario,
                            processData: false,
                            contentType: false,
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                console.log(respuesta);
                                if (respuesta.estado === 1) {
                                    if (vista == 1) {
                                        mensajeSuccessGeneral(
                                            '- Se ha agregado el precio con exito');
                                    } else if (vista == 2) {
                                        mensajeSuccessGeneral(
                                            '- Se ha actualizado el precio con exito');
                                    }
                                    $("#formGuardar")[0].reset();
                                    tablaPrecios.ajax.reload();
                                    $('#modalGuardarForm').modal('hide');
                                } else {
                                    mensajeError(respuesta.mensaje);
                                }
                            },
                            error: function(request, status, error) {
                                mensajeErrorGeneral(
                                    "Se produjo un error durante el proceso, vuelve a intentarlo"
                                );
                            }
                        });
                    }
                });
            });
        }

        function cargarTablaPrecios() {
            tablaPrecios = $('#tablaprecios').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/precios",
                    "type": "GET",
                },
                "columns": [{
                        data: 'productos.producto'
                    },
                    {
                        data: 'unidades.unidad'
                    },
                    // {
                    //     data: 'precio'
                    // },
                    {
                        data: 'precio',
                        render: function(data, type, row) {
                            return '$' + number_format(data);
                        }
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

        function eliminarPrecio(id) {
            Swal.fire({
                    title: '¿Esta seguro?',
                    text: "Recuerde que se eliminara el precio!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/precios_peticiones", // Reemplaza esto con la URL del servidor
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                accion: ELIMINAR_PRECIOS,
                                id: parametro_seleccionado.id,
                                
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se ha eliminado el precio con exito');
                                    tablaPrecios.ajax.reload();
                                } else {
                                    mensajeError(respuesta.mensaje);
                                    
                                }
                            },
                            error: function(request, status, error) {
                                mensajeErrorGeneral(
                                    "Se produjo un error durante el proceso, vuelve a intentarlo"
                                );
                               
                            }
                        });
                    }
                });
        }
    </script>
@endsection