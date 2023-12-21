@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/subcategorias_peticiones";
        var GUARDAR_SUBCATEGORIAS = 1;
        var ACTUALIZAR_SUBCATEGORIAS = 2;
        var ELIMINAR_SUBCATEGORIAS = 3;
        var parametro_seleccionado = "";
        var tablaSubcategorias = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_categorias').addClass('active'); //posible cambio
            $('#i_categoria').css('color', '#3BB77E'); //posible cambio
            cargarTablaSubcategorias();
            guardarSubcategoria();
            cargarImagen("#imagen");

            buttonClicks();
        });

        function buttonClicks() {
            $("#btnmodalguardar").on("click", function(e) {
                vista = 1;
                $('#tipoSubcategoria').val("").trigger("chosen:updated");
                $("#formGuardarSubcategoria")[0].reset();
            });
        }

        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaSubcategorias.row("." + data).node();
            $(fila).addClass('selected');
            parametro_seleccionado = $("#tablasubcategorias").DataTable().row('.selected').data();

            if (modo == 1) {
                $("#subcategoria").val(parametro_seleccionado.subcategoria);
                $("#tipoSubcategoria").val(parametro_seleccionado.categoria_id);
                $("#tipoSubcategoria").trigger("chosen:updated");
                $("#descripcion").val(parametro_seleccionado.descripcion);
                cargarImg("#imagen", parametro_seleccionado.imagen);
            } else if (modo == 2) {
                Swal.fire({
                    title: '¿Esta seguro?',
                    text: "Recuerde que se eliminara la subcategoria!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/subcategorias_peticiones", // Reemplaza esto con la URL del servidor
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                accion: ELIMINAR_SUBCATEGORIAS,
                                id: parametro_seleccionado.id,

                            },
                            beforeSend: function() {
                                $(".carga").removeClass("hidden").addClass("show");
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se ha eliminado la subcategoría con exito');
                                    tablaSubcategorias.ajax.reload();
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
        }


        function guardarSubcategoria() {
            $("#enviarSubcategoria").on("click", function(e) {
                let datosFormulario = "";
                if (vista == 1) {
                    $("#imagen").prop("required", true);
                } else if (vista == 2) {
                    $("#imagen").prop("required", false);
                }
                e.preventDefault(); // Previene el envío por defecto del formulario
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formGuardarSubcategoria");

                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    if ($("#tipoSubcategoria").val() == "") {
                        $("#tipoSubcategoria_chosen").removeClass("valid");
                        $("#tipoSubcategoria_chosen").addClass("is-invalid");
                    } else {
                        $("#tipoSubcategoria_chosen").removeClass("is-invalid");
                        $("#tipoSubcategoria_chosen").addClass("valid");
                    }
                    if ($("#imagen").val() == "") {
                        $(".file-input").removeClass("valid");
                        $(".file-input").addClass("is-invalid");
                    } else {
                        $(".file-input").removeClass("is-invalid");
                        $(".file-input").addClass("valid");
                    }
                    return;
                }

                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formGuardarSubcategoria')[0]);
                if (vista == 1) {
                    datosFormulario.append('accion', GUARDAR_SUBCATEGORIAS);
                } else if (vista == 2) {
                    datosFormulario.append('id', parametro_seleccionado.id);
                    datosFormulario.append('accion', ACTUALIZAR_SUBCATEGORIAS);
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
                            url: "/subcategorias_peticiones", // Reemplaza esto con la URL del servidor
                            method: "POST",
                            data: datosFormulario,
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                $(".carga").removeClass("hidden").addClass("show");
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    if (vista == 1) {
                                        mensajeSuccessGeneral(
                                            '- Se ha agregado la subcategoria con exito');
                                    } else if (vista == 2) {
                                        mensajeSuccessGeneral(
                                            '- Se ha actualizado la subcategoria con exito');
                                    }
                                    $("#formGuardarSubcategoria")[0].reset();
                                    tablaSubcategorias.ajax.reload();
                                    $('#modalGuardarFormSubcategoria').modal('hide');
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
            });
        }


        function cargarTablaSubcategorias() {
            tablaSubcategorias = $('#tablasubcategorias').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/subcategorias",
                    "type": "GET",
                },
                "columns": [{
                        data: 'imagen',
                        render: function(data, type, row) {
                            return '<img src="' + data + '" width="100px" />';
                        }
                    },
                    {
                        data: 'subcategoria'
                    },
                    {
                        data: 'categorias.categoria'
                    },
                    {
                        data: 'descripcion'
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
