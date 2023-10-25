@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/categorias_peticiones";
        var GUARDAR_CATEGORIAS = 1;
        var ACTUALIZAR_CATEGORIAS = 2;
        var ELIMINAR_CATEGORIAS = 3;
        var parametro_seleccionado = "";
        var tablaCategorias = "";
        var fila = "";
        var vista = "";
        $(document).ready(function() {
            $('#li_categorias').addClass('active');
            $('#i_categoria').css('color', '#3BB77E');
            cargarTablaCategorias();
            guardarCategoria();
            cargarImagen("#icono");
            cargarImagen("#imagen");
            
            buttonClicks();
        });

        function buttonClicks() {
            $("#btnmodalguardar").on("click", function(e) {
                vista = 1;
                $('#tipoCategoria').val("").trigger("chosen:updated");
                $("#formGuardar")[0].reset();
            });
        }

        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaCategorias.row("." + data).node();
            $(fila).addClass('selected');
            parametro_seleccionado = $("#tablacategorias").DataTable().row('.selected').data();
            
            if (modo == 1) {
                $("#categoria").val(parametro_seleccionado.categoria);
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
                            url: "/categorias_peticiones", // Reemplaza esto con la URL del servidor
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                accion: ELIMINAR_CATEGORIAS,
                                id: parametro_seleccionado.id,
                                
                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se ha eliminado el producto con exito');
                                    tablaCategorias.ajax.reload();
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

        function guardarCategoria() {
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
                    datosFormulario.append('accion', GUARDAR_CATEGORIAS);
                } else if (vista == 2) {
                    datosFormulario.append('id', parametro_seleccionado.id);
                    datosFormulario.append('accion', ACTUALIZAR_CATEGORIAS);
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
                            url: "/categorias_peticiones", // Reemplaza esto con la URL del servidor
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
                                    tablaCategorias.ajax.reload();
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

        function cargarTablaCategorias() {
            tablaCategorias = $('#tablacategorias').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/categorias",
                    "type": "GET",
                },
                "columns": [{
                        data: 'icono',
                        render: function(data, type, row) {
                            return '<img src="' + data + '" width="50px" />';
                        }
                    },
                    {
                        data: 'imagen',
                        render: function(data, type, row) {
                            return '<img src="' + data + '" width="100px" />';
                        }
                    },
                    {
                        data: 'categoria'
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
