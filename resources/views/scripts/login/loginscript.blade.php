@extends('../vistas.plantilla.plantillafront')
@section('script')
    <script>
        var AJAX = "/login_peticiones";
        $(document).ready(function() {
            selectChange();
            onClick();
        });

        function selectChange() {
            $("#iddepartamento").change(function() {
                buscarMunicipios($(this).val());
            })
            var clienteRadio = document.getElementById("radiocliente");
            var vendedorRadio = document.getElementById("radiovendedor");
            var associationCodeField = document.getElementById("checkPayment");

            if (clienteRadio && vendedorRadio && associationCodeField) {
                clienteRadio.addEventListener("change", function() {
                    if (clienteRadio.checked) {
                        associationCodeField.style.display = "none";
                    }
                });

                vendedorRadio.addEventListener("change", function() {
                    if (vendedorRadio.checked) {
                        associationCodeField.style.display = "block";
                    }
                });
            }
        }

        function onClick() {
            $("#registrar").on("click", function(e) {
                let datosFormulario = "";
                e.preventDefault();
                var tipoRegistro = $("input[name='tiporegistro']:checked").val();
                console.log(tipoRegistro);
                if (tipoRegistro == 3) {
                    $("#codigoasociacion").prop("required", true);
                } else if (tipoRegistro == 4) {
                    $("#codigoasociacion").prop("required", false);
                }
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formRegistrar");

                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    return;
                }
                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formRegistrar')[0]);
                // datosFormulario.append('accion', GUARDAR_ASOCIACIONES);
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
                            url: "/register", // Reemplaza esto con la URL del servidor
                            method: "POST",
                            data: datosFormulario,
                            processData: false,
                            contentType: false,
                            success: function(respuesta) {
                                console.log(respuesta);
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se ha enviado la solicitud de registro con exito'
                                    );
                                    $("#formRegistrar")[0].reset();
                                    location.href = "/index";
                                } else {
                                    mensajeError(respuesta.mensaje);
                                }
                            },
                            error: function(request, status, error) {
                                console.log(request, status, error);
                                if (request.responseJSON.errors && request.responseJSON.errors
                                    .password) {
                                    mensajeErrorGeneral(request.responseJSON.errors.password[
                                        0]);
                                } else if (request.responseJSON.message) {
                                    mensajeErrorGeneral(request.responseJSON.message);
                                } else {
                                    mensajeErrorGeneral(
                                        "Se produjo un error durante el proceso, vuelve a intentarlo"
                                    );
                                }
                            }
                        });
                    }
                });
            });
            $("#show_hide_password a").on('click', function(event) {
                mostrarContrasenas("#show_hide_password")
            });
        }

        function mostrarContrasenas(campo) {
            event.preventDefault();
            if ($('' + campo + ' input').attr("type") == "text") {
                $('' + campo + ' input').attr('type', 'password');
                $('' + campo + ' i').addClass("fa-eye-slash");
                $('' + campo + ' i').removeClass("fa-eye");
            } else if ($('' + campo + ' input').attr("type") == "password") {
                $('' + campo + ' input').attr('type', 'text');
                $('' + campo + ' i').removeClass("fa-eye-slash");
                $('' + campo + ' i').addClass("fa-eye");
            }
        }

        function buscarMunicipios(iddepartamento) {
            $.ajax({
                type: 'GET',
                url: "/buscarmunicipios",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
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

        function mensajeSuccessGeneral(mensaje) {
            Swal.fire({
                icon: 'success',
                title: mensaje,
                allowOutsideClick: false,
            });
        }

        function mensajeErrorGeneral(mensaje) {
            Swal.fire({
                icon: 'error',
                title: mensaje,
                allowOutsideClick: false,
            });
        }
    </script>
@endsection
