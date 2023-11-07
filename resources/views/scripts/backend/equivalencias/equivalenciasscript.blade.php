@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/equivalencias_peticiones";
        var GUARDAR_EQUIVALENCIAS = 1;
        var ACTUALIZAR_EQUIVALENCIAS = 2;
        var ELIMINAR_EQUIVALENCIAS = 3;
        var parametro_seleccionado = "";
        var tablaEquivalencias = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_gestion_unidades').addClass('active');
            $('#i_unidades').css('color', '#3BB77E');
            $('#a_equivalencias').addClass('active');
            cargarTablaEquivalencias();
            guardarEquivalencia();
            
            buttonClicks();
        });

        function buttonClicks() {
            $("#btnmodalguardar").on("click", function(e) {
                vista = 1;
                $('#idunidades').val("").trigger("chosen:updated");
                $('#idequivalencias').val("").trigger("chosen:updated");
                $("#formGuardar")[0].reset();
            });
        }

        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaEquivalencias.row("." + data).node();
            $(fila).addClass('selected');
            parametro_seleccionado = $("#tablaequivalencias").DataTable().row('.selected').data();
            
            if (modo == 1) {
                $("#equivalencia").val(parametro_seleccionado.equivalencia);
                $("#idequivalencias").val(parametro_seleccionado.equivalencias_id);
                $("#idequivalencias").trigger("chosen:updated");
                $("#idunidades").val(parametro_seleccionado.unidades_id);
                $("#idunidades").trigger("chosen:updated");
            } else if (modo == 2) {
                eliminarEquivalencia(parametro_seleccionado.id);
                
            }
        }

        function guardarEquivalencia() {
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
                    datosFormulario.append('accion', GUARDAR_EQUIVALENCIAS);
                } else if (vista == 2) {
                    datosFormulario.append('id', parametro_seleccionado.id);
                    datosFormulario.append('accion', ACTUALIZAR_EQUIVALENCIAS);
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
                            url: "/equivalencias_peticiones", // Reemplaza esto con la URL del servidor
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
                                            '- Se ha agregado la equivalencia con exito');
                                    } else if (vista == 2) {
                                        mensajeSuccessGeneral(
                                            '- Se ha actualizado la equivalencia con exito');
                                    }
                                    $("#formGuardar")[0].reset();
                                    tablaEquivalencias.ajax.reload();
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

        function cargarTablaEquivalencias() {
            tablaEquivalencias = $('#tablaequivalencias').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/equivalencias",
                    "type": "GET",
                },
                "columns": [{
                        data: 'unidades.unidad'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return data.equivalencia + ' - ' + data.equivalencias.unidad;
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

        function eliminarEquivalencia(id) {
            Swal.fire({
                    title: '¿Esta seguro?',
                    text: "Recuerde que se eliminara la equivalencia!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/equivalencias_peticiones", // Reemplaza esto con la URL del servidor
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                accion: ELIMINAR_EQUIVALENCIAS,
                                id: parametro_seleccionado.id,
                                
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se ha eliminado la equivalencia con exito');
                                    tablaEquivalencias.ajax.reload();
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