@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/vendedores_peticiones";
        var GUARDAR_VENDEDORES = 1;
        var ACTUALIZAR_VENDEDORES = 2;
        var ELIMINAR_VENDEDORES = 3;
        var BUSCAR_MUNICIPIOS = 4;
        var parametro_seleccionado = "";
        var tablaVendedores = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_vendedores').addClass('active');
            $('#i_vendedor').css('color', '#3BB77E');
            cargarTablaVendedores();
            guardarAdministrativo();
            buttonClicks();
            selectChange();
        });

        function buttonClicks() {
            $("#btnmodalguardar").on("click", function(e) {
                vista = 1;
                $("#formGuardar")[0].reset();
            });
        }

        function selectChange(){
            $("#iddepartamento").change(function() {
                buscarMunicipios($(this).val());
            })
        }

        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaVendedores.row("." + data).node();
            $(fila).addClass('selected');
            parametro_seleccionado = $("#tablavendedores").DataTable().row('.selected').data();
            if (modo == 1) {
                console.log(parametro_seleccionado);
                $("#vendedor").val(parametro_seleccionado.vendedor);
                $("#codigovendedor").val(parametro_seleccionado.codigo_vendedor);
                $("#celular").val(parametro_seleccionado.n_celular);
                $("#email").val(parametro_seleccionado.email);
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
                            url: "/vendedores_peticiones", // Reemplaza esto con la URL del servidor
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                accion: ELIMINAR_VENDEDORES,
                                id: parametro_seleccionado.id
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se ha eliminado el vendedor con exito');
                                    tablaVendedores.ajax.reload();
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

        function guardarAdministrativo() {
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
                    datosFormulario.append('accion', GUARDAR_VENDEDORES);
                } else if (vista == 2) {
                    datosFormulario.append('id', parametro_seleccionado.id);
                    datosFormulario.append('accion', ACTUALIZAR_VENDEDORES);
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
                            url: "/vendedores_peticiones", // Reemplaza esto con la URL del servidor
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
                                            '- Se ha agregado el vendedor con exito');
                                    } else if (vista == 2) {
                                        mensajeSuccessGeneral(
                                            '- Se ha actualizado el vendedor con exito');
                                    }
                                    $("#formGuardar")[0].reset();
                                    tablaVendedores.ajax.reload();
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

        function cargarTablaVendedores() {
            tablaVendedores = $('#tablavendedores').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/vendedores",
                    "type": "GET",
                },
                "columns": [
                    {
                        data: null,
                        render: function(data, type, row) {
                            return data.tipodocumento.Abreviatura + ' ' + data.n_documento;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return data.apellidos + ' ' + data.nombres;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return data.municipio.ciudad + ' - ' + data.municipio.departamento.departamento ;
                        }
                    },
                    {
                        data: 'n_celular'
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
