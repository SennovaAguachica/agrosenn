@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/seguridad_peticiones";
        var ACTUALIZAR_USUARIOS = 1;
        var ELIMINAR_USUARIOS = 2;
        var HABILITAR_USUARIOS = 3;
        var datosUsuario = "";
        var tablaUsuarios = "";
        var fila = "";
        $(document).ready(function() {
            $('#li_gestion_seguridad').addClass('active open');
            $('#a_usuarios').addClass('active');
            $('#i_seguridad').css('color', '#3BB77E');
            cargarTablaUsuarios();
            buttonClicks();
        });

        function buttonClicks() {
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
                datosFormulario.append('id', datosUsuario.id);
                datosFormulario.append('accion', ACTUALIZAR_USUARIOS);
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
                                        '- Se ha actualizado la usuario con exito');
                                    $("#formGuardar")[0].reset();
                                    tablaUsuarios.ajax.reload();
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

        function buscarId(data, modo) {
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaUsuarios.row("." + data).node();
            $(fila).addClass('selected');
            datosUsuario = $("#tablausuarios").DataTable().row('.selected').data();
            if (modo == 1) {
                var usuario = "";
                var identificacion = "";
                if (datosUsuario.idrol == 1) {
                    usuario = datosUsuario.administrador.administrador;
                    identificacion = datosUsuario.administrador.identificacion;
                } else if (datosUsuario.idrol == 2) {
                    usuario = datosUsuario.asociacion.asociacion;
                    identificacion = datosUsuario.asociacion.codigo_asociacion;
                } else if (datosUsuario.idrol == 3) {
                    usuario = datosUsuario.vendedor.vendedor;
                    identificacion = datosUsuario.vendedor.n_documento;
                } else if (datosUsuario.idrol == 4) {
                    usuario = datosUsuario.cliente.cliente;
                    identificacion = datosUsuario.cliente.n_documento;
                }
                $("#idrol").val(datosUsuario.idrol).prop('disabled', true);
                $("#idrol").trigger("chosen:updated");
                $("#usuario").val(usuario);
                $("#identificacion").val(identificacion);
                $("#email").val(datosUsuario.email);
            } else if (modo == 2) {
                eliminarUsuario(datosUsuario.id);
            } else if (modo == 3) {
                habilitarUsuario(datosUsuario.id);
            }
        }

        function eliminarUsuario(id) {
            Swal.fire({
                title: '¿Esta seguro?',
                text: "Recuerde que se eliminara el usuario seleccionado!",
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
                            accion: ELIMINAR_USUARIOS,
                            id
                        },
                        beforeSend: function() {
                            $(".carga").removeClass("hidden").addClass("show");
                        },
                        success: function(respuesta) {
                            // Maneja la respuesta del servidor aquí
                            if (respuesta.estado === 1) {
                                mensajeSuccessGeneral(
                                    '- Se ha eliminado el usuario con exito');
                                tablaUsuarios.ajax.reload();
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

        function habilitarUsuario(id) {
            Swal.fire({
                title: '¿Esta seguro?',
                text: "Recuerde que se habilitara el usuario seleccionado!",
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
                            accion: HABILITAR_USUARIOS,
                            id
                        },
                        beforeSend: function() {
                            $(".carga").removeClass("hidden").addClass("show");
                        },
                        success: function(respuesta) {
                            // Maneja la respuesta del servidor aquí
                            if (respuesta.estado === 1) {
                                mensajeSuccessGeneral(
                                    '- Se ha habilitado el usuario con exito');
                                tablaUsuarios.ajax.reload();
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

        function cargarTablaUsuarios() {
            tablaUsuarios = $('#tablausuarios').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/usuarios",
                    "type": "GET",
                },
                "columns": [{
                        data: null,
                        render: function(data, type, row) {
                            if (data.idrol == 1) {
                                return data.administrador.administrador;
                            } else if (data.idrol == 2) {
                                return data.asociacion.asociacion;
                            }
                            if (data.idrol == 3) {
                                return data.vendedor.vendedor;
                            }
                            if (data.idrol == 4) {
                                return data.cliente.cliente;
                            }
                        }
                    },

                    {
                        data: 'email'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (data.idrol == 1) {
                                return '<span class="badge bg-success ">' + data.rol.name + '</span>';
                            } else if (data.idrol == 2) {
                                return '<span class="badge bg-primary ">' + data.rol.name + '</span>';
                            }
                            if (data.idrol == 3) {
                                return '<span class="badge bg-danger ">' + data.rol.name + '</span>';
                            }
                            if (data.idrol == 4) {
                                return '<span class="badge bg-secondary ">' + data.rol.name + '</span>';
                            }
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
