@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/banners_peticiones";
        var GUARDAR_BANNER = 1;
        var ELIMINAR_BANNER = 2;
        var tablaBanners = "";
        $(document).ready(function() {
            $('#li_banners').addClass('active');
            $('#i_banners').css('color', '#3BB77E');
            cargarTablaBanners();
            cargarImagen("#imagen");
            buttonClicks();
        });

        function buttonClicks() {
            $("#btnmodalguardar").on("click", function(e) {
                $('#tipobanner').val("").trigger("chosen:updated");
                $("#formGuardar")[0].reset();
            });
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
                datosFormulario.append('accion', GUARDAR_BANNER);
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
                            url: "/banners_peticiones", // Reemplaza esto con la URL del servidor
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
                                        '- Se ha agregado el banner con exito');
                                    $("#formGuardar")[0].reset();
                                    tablaBanners.ajax.reload();
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

        function eliminar(id) {
            Swal.fire({
                title: '¿Esta seguro?',
                text: "Recuerde que se eliminara el banner seleccionada!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/banners_peticiones", // Reemplaza esto con la URL del servidor
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            accion: ELIMINAR_BANNER,
                            id
                        },
                        beforeSend: function() {
                            $(".carga").removeClass("hidden").addClass("show");
                        },
                        success: function(respuesta) {
                            // Maneja la respuesta del servidor aquí
                            if (respuesta.estado === 1) {
                                mensajeSuccessGeneral(
                                    '- Se ha eliminado el banner con exito');
                                tablaBanners.ajax.reload();
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

        function cargarTablaBanners() {
            tablaBanners = $('#tablabanners').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/banners",
                    "type": "GET",
                },
                "columns": [{
                        data: 'tipobanner',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return "Banner principal";
                            } else if (data == 2) {
                                return "Banner secundario";
                            }
                        }
                    },
                    {
                        data: 'imagen',
                        render: function(data, type, row) {
                            return '<img loading="lazy" src="' + data + '" width="100px" height="100%"  />';
                        }
                    },
                    {
                        data: 'enlace'
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
