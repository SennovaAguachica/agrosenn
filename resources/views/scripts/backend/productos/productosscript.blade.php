@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/productos_peticiones";
        var GUARDAR_PRODUCTOS = 1;
        var ACTUALIZAR_PRODUCTOS = 2;
        var ELIMINAR_PRODUCTOS = 3;
        var parametro_seleccionado = "";
        var tablaProductos = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_productos').addClass('active');
            cargarTablaProductos();
            guardarProducto();
            cargarImagen("#imagenproducto");
            inputMoneda('#precioProducto');
            buttonClicks();
        });

        function buttonClicks() {
            $("#btnguardar").on("click", function(e) {
                vista = 1;
                $('#tipoProducto').val("").trigger("chosen:updated");
                $("#formProductos")[0].reset();
            });
        }

        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaProductos.row("." + data).node();
            $(fila).addClass('selected');
            parametro_seleccionado = $("#tablaproductos").DataTable().row('.selected').data();
            if (modo == 1) {
                $("#tipoProducto").val(parametro_seleccionado.categoria_id);
                $("#tipoProducto").trigger("chosen:updated");
                $("#nombreProducto").val(parametro_seleccionado.producto);
                $("#precioProducto").val('$' + number_format(parametro_seleccionado.precio));
                $("#descripcionProducto").val(parametro_seleccionado.descripcion);
                cargarImg("#imagenproducto", parametro_seleccionado.imagen);
            } else if (modo == 2) {
                Swal.fire({
                    title: '¿Esta seguro?',
                    text: "Recuerde que se eliminara el producto!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/productos_peticiones", // Reemplaza esto con la URL del servidor
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                accion: ELIMINAR_PRODUCTOS,
                                id: parametro_seleccionado.id
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se ha eliminado el producto con exito');
                                    tablaProductos.ajax.reload();
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
        }

        function guardarProducto() {
            $("#enviarProducto").on("click", function(e) {
                let datosFormulario = "";
                if (vista == 1) {
                    $("#imagenproducto").prop("required", true);
                } else if (vista == 2) {
                    $("#imagenproducto").prop("required", false);
                }
                e.preventDefault(); // Previene el envío por defecto del formulario
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formProductos");


                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    if ($("#tipoProducto").val() == "") {
                        $("#tipoProducto_chosen").removeClass("valid");
                        $("#tipoProducto_chosen").addClass("is-invalid");
                    } else {
                        $("#tipoProducto_chosen").removeClass("is-invalid");
                        $("#tipoProducto_chosen").addClass("valid");
                    }

                    if ($("#imagenproducto").val() == "") {
                        $(".file-input").removeClass("valid");
                        $(".file-input").addClass("is-invalid");
                    } else {
                        $(".file-input").removeClass("is-invalid");
                        $(".file-input").addClass("valid");
                    }
                    return;
                }

                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formProductos')[0]);
                datosFormulario.append('precioProducto', $("#precioProducto").unmask());
                if (vista == 1) {
                    datosFormulario.append('accion', GUARDAR_PRODUCTOS);
                } else if (vista == 2) {
                    datosFormulario.append('id', parametro_seleccionado.id);
                    datosFormulario.append('accion', ACTUALIZAR_PRODUCTOS);
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
                            url: "/productos_peticiones", // Reemplaza esto con la URL del servidor
                            method: "POST",
                            data: datosFormulario,
                            processData: false,
                            contentType: false,
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    if (vista == 1) {
                                        mensajeSuccessGeneral(
                                            '- Se ha agregado el producto con exito');
                                    } else if (vista == 2) {
                                        mensajeSuccessGeneral(
                                            '- Se ha actualizado el producto con exito');
                                    }
                                    $("#formProductos")[0].reset();
                                    tablaProductos.ajax.reload();
                                    $('#modalGuardarProductos').modal('hide');
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

        function cargarTablaProductos() {
            tablaProductos = $('#tablaproductos').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/productos",
                    "type": "GET",
                },
                "columns": [{
                        data: 'imagen',
                        render: function(data, type, row) {
                            return '<img src="' + data + '" width="100px" />';
                        }
                    },
                    {
                        data: 'producto'
                    },
                    {
                        data: 'categoria.categoria'
                    },
                    {
                        data: 'precio',
                        render: function(data, type, row) {
                            return '$' + number_format(data);
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<span class="badge rounded-pill alert-success">Disponible</span>';
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
    </script>
@endsection
