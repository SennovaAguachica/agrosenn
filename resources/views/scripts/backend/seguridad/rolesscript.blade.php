@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/seguridad_peticiones";
        var ACTUALIZAR_ROL = 7;
        var datosRol = "";
        var tablaRoles = "";
        var fila = "";
        $(document).ready(function() {
            $('#li_gestion_seguridad').addClass('active open');
            $('#a_roles').addClass('active');
            $('#i_seguridad').css('color', '#3BB77E');
            cargarTablaRoles();
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
                datosFormulario.append('id', datosRol.id);
                datosFormulario.append('accion', ACTUALIZAR_ROL);
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
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se ha actualizado la rol y los permisos con exito'
                                    );
                                    $("#formGuardar")[0].reset();
                                    tablaRoles.ajax.reload();
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

        function buscarId(data, modo) {
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaRoles.row("." + data).node();
            $(fila).addClass('selected');
            datosRol = $("#tablaroles").DataTable().row('.selected').data();
            if (modo == 1) {
                $("#rol").html(datosRol.name);
                $('[name="permisos[]"]').prop("checked", false);
                console.log(datosRol);
                for (var i = 0; i < datosRol.permissions.length; i++) {
                    $('[name="permisos[]"][value="' + datosRol.permissions[i].name + '"]').prop("checked", true);
                }
            }
        }

        function cargarTablaRoles() {
            tablaRoles = $('#tablaroles').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/roles",
                    "type": "GET",
                },
                "columns": [{
                        data: 'name'
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
