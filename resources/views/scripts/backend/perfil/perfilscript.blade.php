@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/perfil_peticiones";
        var BUSCAR_MUNICIPIOS = 1;
        var ACTUALIZAR_PERFIL = 2;
        var ACTUALIZAR_CONTRASENA = 3;
        $(document).ready(function() {
            $('#li_gestion_unidades').addClass('active');
            $('#i_unidades').css('color', '#3BB77E');
            $('#a_equivalencias').addClass('active');
            selectChanges();
            buttonClick();
            $('#divseccionperfil').show();
        });

        function selectChanges() {
            $("#iddepartamentovendedor").change(function() {
                buscarMunicipios($(this).val(), "#idmunicipiovendedor");
            })
            $("#iddepartamentoasociacion").change(function() {
                buscarMunicipios($(this).val(), "#idmunicipioasociacion");
            })
        }

        function loadPhoto(input) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('userPhoto').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }

        function buttonClick() {
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
                datosFormulario.append('accion', ACTUALIZAR_PERFIL);
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
                            url: "/perfil_peticiones", // Reemplaza esto con la URL del servidor
                            method: "POST",
                            data: datosFormulario,
                            processData: false,
                            contentType: false,
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se han actualizado sus datos con exito');
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
            $("#enviarcambiarcontrasena").on("click", function(e) {
                let datosFormulario = "";
                e.preventDefault();
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formcambiarpassword");

                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    return;
                }
                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formcambiarpassword')[0]);
                datosFormulario.append('accion', ACTUALIZAR_CONTRASENA);
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
                            url: "/perfil_peticiones", // Reemplaza esto con la URL del servidor
                            method: "POST",
                            data: datosFormulario,
                            processData: false,
                            contentType: false,
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se han actualizado sus datos con exito');
                                    $("#passwordactual").val("");
                                    $("#passwordnuevo").val("");
                                    $("#passwordconfirmar").val("");
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
            $("#btnseccionperfil").on("click", function(e) {
                $('#btnseccionperfil').addClass('active');
                $('#btncambiarcontrasena').removeClass('active');

                $('#divseccionperfil').show();
                $('#divcambiarcontrasena').hide();
            });
            $("#btncambiarcontrasena").on("click", function(e) {
                $('#btnseccionperfil').removeClass('active');
                $('#btncambiarcontrasena').addClass('active');

                $('#divseccionperfil').hide();
                $('#divcambiarcontrasena').show();
            });
            $("#show_hide_password_actual a").on('click', function(event) {
                mostrarContrasenas("#show_hide_password_actual")
            });
            $("#show_hide_password_nueva a").on('click', function(event) {
                mostrarContrasenas("#show_hide_password_nueva")
            });
            $("#show_hide_password_confirmar a").on('click', function(event) {
                mostrarContrasenas("#show_hide_password_confirmar")
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

        function buscarMunicipios(iddepartamento, campo) {
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
                        $(campo).html(municipios_select);
                        $(campo).trigger("chosen:updated");
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
