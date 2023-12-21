@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/seguridad_peticiones";
        var GUARDAR_PERMISOS = 4;
        var ACTUALIZAR_PERMISOS = 5;
        var ELIMINAR_PERMISOS = 6;
        var datosPermiso = "";
        var tablaPermisos = "";
        var fila = "";
        var vista = 1;
        $(document).ready(function() {
            $('#li_gestion_seguridad').addClass('active open');
            $('#a_permisos').addClass('active');
            $('#i_seguridad').css('color', '#3BB77E');
            cargarTablaPermisos();
            buttonClicks();
        });

        function buttonClicks() {
            $("#btnmodalguardar").on("click", function(e) {
                vista = 1;
                $("#permiso").val("");
                $("#descripcion").val("");
                $("#grupo").val("");
                $("#formGuardar")[0].reset();
            });
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
                    datosFormulario.append('accion', GUARDAR_PERMISOS);
                } else if (vista == 2) {
                    datosFormulario.append('id', datosPermiso.id);
                    datosFormulario.append('accion', ACTUALIZAR_PERMISOS);
                }
                guardarPermiso(datosFormulario);
            });
        }

        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaPermisos.row("." + data).node();
            $(fila).addClass('selected');
            datosPermiso = $("#tablapermisos").DataTable().row('.selected').data();
            if (modo == 1) {
                $("#permiso").val(datosPermiso.name);
                $("#descripcion").val(datosPermiso.description);
                $("#grupo").val(datosPermiso.grupo);
            } else if (modo == 2) {
                eliminarPermiso(datosPermiso.id);
            }
        }

        function eliminarPermiso(id) {
            Swal.fire({
                title: '¿Esta seguro?',
                text: "Recuerde que se eliminara el permiso seleccionado!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/seguridad_peticiones", // Reemplaza esto con la URL del servidor
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            accion: ELIMINAR_PERMISOS,
                            id
                        },
                        beforeSend: function() {
                            $(".carga").removeClass("hidden").addClass("show");
                        },
                        success: function(respuesta) {
                            // Maneja la respuesta del servidor aquí
                            if (respuesta.estado === 1) {
                                mensajeSuccessGeneral(
                                    '- Se ha eliminado el permiso con exito');
                                tablaPermisos.ajax.reload();
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

        function guardarPermiso(datosFormulario) {
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
                        url: "/seguridad_peticiones", // Reemplaza esto con la URL del servidor
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
                                mensajeSuccessGeneral(
                                    '- Se ha actualizado la permiso con exito');
                                $("#formGuardar")[0].reset();
                                tablaPermisos.ajax.reload();
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
        }

        function cargarTablaPermisos() {
            tablaPermisos = $('#tablapermisos').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/permisos",
                    "type": "GET",
                },
                "columns": [{
                        data: 'name'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'grupo'
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
