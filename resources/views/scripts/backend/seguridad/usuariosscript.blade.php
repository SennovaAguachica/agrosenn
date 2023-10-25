@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/seguridad_peticiones";
        var GUARDAR_USUARIOS = 1;
        var ACTUALIZAR_USUARIOS = 2;
        var ELIMINAR_USUARIOS = 3;
        var parametro_seleccionado = "";
        var tablaUsuarios = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_usuarios').addClass('active');
            $('#i_usuario').css('color', '#3BB77E');
            cargarTablaUsuarios();
            guardarUsuario();
            cargarImagen("#icono");
            cargarImagen("#imagen");
            
            buttonClicks();
        });

        function buttonClicks() {
            $("#btnmodalguardar").on("click", function(e) {
                vista = 1;
                $('#tipoUsuario').val("").trigger("chosen:updated");
                $("#formGuardar")[0].reset();
            });
        }

        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaUsuarios.row("." + data).node();
            $(fila).addClass('selected');
            parametro_seleccionado = $("#tablausuarios").DataTable().row('.selected').data();
            if (modo == 1) {
                $("#usuario").val(parametro_seleccionado.usuario);
                $("#descripcion").val(parametro_seleccionado.descripcion);
                cargarImg("#imagen", parametro_seleccionado.imagen);
                cargarImg("#icono", parametro_seleccionado.icono);
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
                            url: "/usuarios_peticiones", // Reemplaza esto con la URL del servidor
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                accion: ELIMINAR_USUARIOS,
                                id: parametro_seleccionado.id
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se ha eliminado el producto con exito');
                                    tablaUsuarios.ajax.reload();
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

        function guardarUsuario() {
            $("#enviar").on("click", function(e) {
                let datosFormulario = "";
                if (vista == 1) {
                    $("#imagen").prop("required", true);
                    $("#icono").prop("required", true);
                } else if (vista == 2) {
                    $("#imagen").prop("required", false);
                    $("#icono").prop("required", false);
                }
                e.preventDefault(); // Previene el envío por defecto del formulario
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formGuardar");

                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    if ($("#imagen").val() == "" || $("#icono").val() == "") {
                        $(".file-input").removeClass("valid");
                        $(".file-input").addClass("is-invalid");
                    } else {
                        $(".file-input").removeClass("is-invalid");
                        $(".file-input").addClass("valid");
                    }
                    return;
                }

                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formGuardar')[0]);
                if (vista == 1) {
                    datosFormulario.append('accion', GUARDAR_USUARIOS);
                } else if (vista == 2) {
                    datosFormulario.append('id', parametro_seleccionado.id);
                    datosFormulario.append('accion', ACTUALIZAR_USUARIOS);
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
                            url: "/usuarios_peticiones", // Reemplaza esto con la URL del servidor
                            method: "POST",
                            data: datosFormulario,
                            processData: false,
                            contentType: false,
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    if (vista == 1) {
                                        mensajeSuccessGeneral(
                                            '- Se ha agregado la usuario con exito');
                                    } else if (vista == 2) {
                                        mensajeSuccessGeneral(
                                            '- Se ha actualizado la usuario con exito');
                                    }
                                    $("#formUsuario")[0].reset();
                                    tablaUsuarios.ajax.reload();
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
                "columns": [
                    {
                        data: null,
                        render: function(data, type, row) {
                            if(data.idrol==1){
                                return data.administrador.administrador;
                            }else if(data.idrol==2){
                                return data.asociacion.asociacion;
                            }if(data.idrol==3){
                                return data.vendedor.vendedor;
                            }if(data.idrol==4){
                                return data.cliente.cliente;
                            }
                        }
                    },
                    
                    {
                        data: 'email'
                    },
                    {
                        data: 'rol.name'
                    },
                    // {
                    //     data: 'imagen',
                    //     render: function(data, type, row) {
                    //         return '<img src="' + data + '" width="100px" />';
                    //     }
                    // },
                    
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
