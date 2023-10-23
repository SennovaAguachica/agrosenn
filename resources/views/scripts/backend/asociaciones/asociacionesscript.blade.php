@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/asociaciones_peticiones";
        var GUARDAR_ASOCIACIONES = 1;
        var ACTUALIZAR_ASOCIACIONES = 2;
        var ELIMINAR_ASOCIACIONES = 3;
        var BUSCAR_MUNICIPIOS = 4;
        var parametro_seleccionado = "";
        var tablaAsociaciones = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_asociaciones').addClass('active');
            $('#i_asociacion').css('color', '#3BB77E');
            cargarTablaAsociaciones();
            guardarAsociacion();
            cargarImagen("#imagen");
            buttonClicks();
            selectChanges();
        });

        function buttonClicks() {
            $("#btnmodalguardar").on("click", function(e) {
                vista = 1;
                $('#tipoAsociacion').val("").trigger("chosen:updated");
                $("#formGuardar")[0].reset();
            });
        }

        function selectChanges() {
            $("#iddepartamento").change(function() {
                buscarMunicipios($(this).val());
            })
        }


        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaAsociaciones.row("." + data).node();
            $(fila).addClass('selected');
            parametro_seleccionado = $("#tablaasociaciones").DataTable().row('.selected').data();
            if (modo == 1) {
                console.log(parametro_seleccionado);
                $("#asociacion").val(parametro_seleccionado.asociacion);
                $("#codigoasociacion").val(parametro_seleccionado.codigo_asociacion);
                $("#direccion").val(parametro_seleccionado.direccion);
                $("#celular").val(parametro_seleccionado.n_celular);
                $("#email").val(parametro_seleccionado.email);
                $("#iddepartamento").val(parametro_seleccionado.municipio.iddepartamentos);
                $('#iddepartamento').trigger("chosen:updated");
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
                            url: "/asociaciones_peticiones", // Reemplaza esto con la URL del servidor
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                accion: ELIMINAR_ASOCIACIONES,
                                id: parametro_seleccionado.id
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se ha eliminado el producto con exito');
                                    tablaAsociaciones.ajax.reload();
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

        function guardarAsociacion() {
            $("#enviar").on("click", function(e) {
                let datosFormulario = "";
                e.preventDefault();
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formGuardar");

                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    return;
                }
                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formGuardar')[0]);
                console.log(vista);
                if (vista == 1) {
                    datosFormulario.append('accion', GUARDAR_ASOCIACIONES);
                } else if (vista == 2) {
                    datosFormulario.append('id', parametro_seleccionado.id);
                    datosFormulario.append('accion', ACTUALIZAR_ASOCIACIONES);
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
                            url: "/asociaciones_peticiones", // Reemplaza esto con la URL del servidor
                            method: "POST",
                            data: datosFormulario,
                            processData: false,
                            contentType: false,
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    if (vista == 1) {
                                        mensajeSuccessGeneral(
                                            '- Se ha agregado la categoria con exito');
                                    } else if (vista == 2) {
                                        mensajeSuccessGeneral(
                                            '- Se ha actualizado la categoria con exito');
                                    }
                                    $("#formGuardar")[0].reset();
                                    tablaAsociaciones.ajax.reload();
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

        function cargarTablaAsociaciones() {
            tablaAsociaciones = $('#tablaasociaciones').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/asociaciones",
                    "type": "GET",
                },
                "columns": [{
                        data: 'asociacion'
                    },
                    {
                        data: 'codigo_asociacion'
                    },
                    {
                        data: 'n_celular'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'email'
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

        function buscarMunicipios(iddepartamento) {
            $.ajax({
                type: 'POST',
                url: AJAX,
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    accion: BUSCAR_MUNICIPIOS,
                    iddepartamento
                },
                beforeSend: function() {
                    // $(".carga").removeClass("hidden").addClass("show");
                },
                success: function(respuesta) {
                    $(".carga").removeClass("show").addClass("hidden");
                    var municipios_select = '<option value="">Seleccione una opción</option>'
                    for (var i = 0; i < respuesta.length; i++) {
                        municipios_select += '<option value="' + respuesta[i].id + '">' + respuesta[i].ciudad +
                            '</option>';
                        $("#idmunicipio").html(municipios_select);
                        $("#idmunicipio").trigger("chosen:updated");
                    }
                },
                error: function(request, status, error) {
                    mensajeError("Se produjo un error durante el proceso, vuelve a intentarlo");
                    $(".carga").removeClass("show").addClass("hidden");
                }
            });
        }
    </script>
@endsection
