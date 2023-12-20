@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/perfil_peticiones";
        var BUSCAR_MUNICIPIOS = 1;
        var ACTUALIZAR_PERFIL = 2;
        var ACTUALIZAR_CONTRASENA = 3;
        var ACTUALIZAR_DETALLES = 4;
        var ELIMINAR_IMAGEN = 5;
        var imagenes = @json($user);
        $(document).ready(function() {
            console.log(imagenes);
            $('#li_perfil').addClass('active');
            $('#i_perfil').css('color', '#3BB77E');
            selectChanges();
            buttonClick();
            {{-- cargarVariasImagen("#imagen"); --}}
            $('#divseccionperfil').show();
            var imagenesGuardadas = [];
            if (imagenes.imagenesperfil.length > 0) {
                $.each(imagenes.imagenesperfil, function(index, imagen) {
                    imagenesGuardadas.push({
                        id: imagen.id,
                        ruta: imagen.imagen
                        // Agrega más propiedades según sea necesario
                    });
                });
            }
            console.log(imagenesGuardadas);

            $("#imagen").fileinput({
                uploadUrl: '#',
                theme: 'fa5',
                allowedFileExtensions: ["jpg", "jpeg", "png"],
                showUpload: false,
                showRemove: false,
                browseLabel: "Seleccionar",
                browseClass: "btn btn-primary",
                previewFileType: "image",
                initialPreview: imagenesGuardadas.map(function(imagen) {
                    return '<img src="' + imagen.ruta + '" class="file-preview-image" data-id="' +
                        imagen.id + '">';
                }),
                fileActionSettings: {
                    showRemove: true,
                    showUpload: false, //This remove the upload button
                    showZoom: true,
                    showDrag: false,
                    showRotate: false,
                    removeIcon: '<i class="fa fa-trash"></i>', // Cambiar el icono de eliminación si es necesario
                    removeClass: 'btn btn-sm btn-danger', // Cambiar la clase de estilo del botón de eliminación si es necesario
                    indicatorNew: '<i class="fa fa-plus-circle text-warning"></i>',
                    indicatorSuccess: '<i class="fa fa-check-circle text-success"></i>',
                    indicatorError: '<i class="fa fa-times-circle text-danger"></i>'
                },
                initialPreviewConfig: imagenesGuardadas.map(function(imagen) {
                    return {
                        caption: "Imagen " + imagen.id,
                        size: "",
                        width: "120px",
                        url: AJAX,
                        key: imagen.id,
                        extra: {
                            "_token": "{{ csrf_token() }}",
                            accion: ELIMINAR_IMAGEN,
                            imagenId: imagen.id
                        }
                    };
                })
            }).on('filebeforedelete', function() {
                return new Promise(function(resolve, reject) {
                    $.confirm({
                        title: 'Estás seguro!',
                        content: 'La imagen será eliminada permanentemente?',
                        type: 'red',
                        buttons: {
                            ok: {
                                btnClass: 'btn-primary text-white',
                                keys: ['enter'],
                                action: function() {
                                    resolve();
                                }
                            }
                        }
                    });
                });
            }).on('filedeleted', function() {
                setTimeout(function() {
                    $.alert('Imagen eliminada correctamente!');
                }, 900);
            });
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
                var form = document.getElementById("formGuardarperfil");

                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    return;
                }
                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formGuardarperfil')[0]);
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
            $("#enviardetalles").on("click", function(e) {
                let datosFormulario = "";
                e.preventDefault();
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formGuardarDetalles");

                // Recopila los datos del formulario
                datosFormulario = new FormData($('#formGuardarDetalles')[0]);
                datosFormulario.append('accion', ACTUALIZAR_DETALLES);
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
                                    window.location.href = '/perfil';
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
                $('#btndetalles').removeClass('active');

                $('#divseccionperfil').show();
                $('#divcambiarcontrasena').hide();
                $('#divsecciondetalles').hide();
            });
            $("#btndetalles").on("click", function(e) {
                $('#btnseccionperfil').removeClass('active');
                $('#btncambiarcontrasena').removeClass('active');
                $('#btndetalles').addClass('active');

                $('#divseccionperfil').hide();
                $('#divcambiarcontrasena').hide();
                $('#divsecciondetalles').show();
            });
            $("#btncambiarcontrasena").on("click", function(e) {
                $('#btnseccionperfil').removeClass('active');
                $('#btncambiarcontrasena').addClass('active');
                $('#btndetalles').removeClass('active');

                $('#divseccionperfil').hide();
                $('#divcambiarcontrasena').show();
                $('#divsecciondetalles').hide();
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
