@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/unidades_peticiones";
        var GUARDAR_UNIDADES = 1;
        var ACTUALIZAR_UNIDADES = 2;
        var ELIMINAR_UNIDADES = 3;
        var parametro_seleccionado = "";
        var tablaUnidades = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_gestion_unidades').addClass('active');
            $('#i_unidades').css('color', '#3BB77E');
            $('#a_unidades').addClass('active');
            cargarTablaUnidades();
            guardarUnidad();

            buttonClicks();
        });

        function buttonClicks() {
            $("#btnmodalguardar").on("click", function(e) {
                vista = 1;
                $('#idtipounidades').val("").trigger("chosen:updated");
                $("#formGuardar")[0].reset();
            });
        }

        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaUnidades.row("." + data).node();
            $(fila).addClass('selected');
            parametro_seleccionado = $("#tablaunidades").DataTable().row('.selected').data();

            if (modo == 1) {
                $("#unidad").val(parametro_seleccionado.unidad);
                $("#abreviatura").val(parametro_seleccionado.abreviatura);
                $("#idtipounidades").val(parametro_seleccionado.tipounidades_id);
                $("#idtipounidades").trigger("chosen:updated");
                $("#descripcion").val(parametro_seleccionado.descripcion);
            } else if (modo == 2) {
                eliminarUnidad(parametro_seleccionado.id);

            }
        }

        function guardarUnidad() {
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
                if (vista == 1) {
                    datosFormulario.append('accion', GUARDAR_UNIDADES);
                } else if (vista == 2) {
                    datosFormulario.append('id', parametro_seleccionado.id);
                    datosFormulario.append('accion', ACTUALIZAR_UNIDADES);
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
                            url: "/unidades_peticiones", // Reemplaza esto con la URL del servidor
                            method: "POST",
                            data: datosFormulario,
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                $(".carga").removeClass("hidden").addClass("show");
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                console.log(respuesta);
                                if (respuesta.estado === 1) {
                                    if (vista == 1) {
                                        mensajeSuccessGeneral(
                                            '- Se ha agregado la unidad con exito');
                                    } else if (vista == 2) {
                                        mensajeSuccessGeneral(
                                            '- Se ha actualizado la unidad con exito');
                                    }
                                    $("#formGuardar")[0].reset();
                                    tablaUnidades.ajax.reload();
                                    $('#modalGuardarForm').modal('hide');
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

        function cargarTablaUnidades() {
            tablaUnidades = $('#tablaunidades').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/unidades",
                    "type": "GET",
                },
                "columns": [{
                        data: 'unidad'
                    },
                    {
                        data: 'abreviatura'
                    },
                    {
                        data: 'tipounidades.tipo_unidad'
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

        function eliminarUnidad(id) {
            Swal.fire({
                title: '¿Esta seguro?',
                text: "Recuerde que se eliminara la unidad!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/unidades_peticiones", // Reemplaza esto con la URL del servidor
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            accion: ELIMINAR_UNIDADES,
                            id: parametro_seleccionado.id,

                        },
                        beforeSend: function() {
                            $(".carga").removeClass("hidden").addClass("show");
                        },
                        success: function(respuesta) {
                            // Maneja la respuesta del servidor aquí
                            if (respuesta.estado === 1) {
                                mensajeSuccessGeneral(
                                    '- Se ha eliminado la unidad con exito');
                                tablaUnidades.ajax.reload();
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
