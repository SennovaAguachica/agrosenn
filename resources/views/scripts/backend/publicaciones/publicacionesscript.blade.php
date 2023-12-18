@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')

    <script>
        var AJAX = "/publicaciones_peticiones";
        var GUARDAR_PUBLICACIONES = 1;
        var ACTUALIZAR_PUBLICACIONES = 2;
        var ELIMINAR_PUBLICACIONES = 3;
        var BUSCAR_PRECIOSVENDEDOR = 4;
        var BUSCAR_PRECIOSASOCIACION = 5;
        var parametro_seleccionado = "";
        var tablaPublicaciones = "";
        var fila = "";
        var vista = "";
        var id_precio_vendedor = "";
        $(document).ready(function() {
            $('#li_publicaciones').addClass('active');
            $('#i_publicaciones').css('color', '#3BB77E');
            cargarTablaPublicaciones();
            guardarPublicacion();
            cargarVariasImagen("#imagen");
            buttonClicks();
            selectChanges();
            $('#modalGuardarForm').on('show.bs.modal', function () {
                // Restablecer el formulario
                $("#formGuardar")[0].reset();
                $("#formGuardar").removeClass("was-validated");
        
                // Restablecer la visualización de validación de Bootstrap
                $("#idproductos_chosen, #idunidades_chosen, #precio, .file-input").removeClass("is-invalid is-valid");
            });
        });

        

        function buttonClicks() {
            $("#btnmodalguardar").on("click", function(e) {
                vista = 1;
                $('#idunidades').val("").trigger("chosen:updated");
                $('#idproductos').val("").trigger("chosen:updated");
                $('#listadoprecios').attr('placeholder', '');
                $("#formGuardar")[0].reset();
                
            });
        }

        

        function selectChanges() {
            $("#idproductos, #idunidades").change(function() {
                buscarPreciosAsociacion($("#idproductos").val(), $("#idunidades").val());
                buscarPreciosVendedor($("#idproductos").val(), $("#idunidades").val());
            })
        }

        function buscarId(data, modo) {
            vista = 2;
            if (fila != "") {
                $(fila).removeClass('selected');
            }
            fila = tablaPublicaciones.row("." + data).node();
            $(fila).addClass('selected');
            parametro_seleccionado = $("#tablapublicaciones").DataTable().row('.selected').data();

            if (modo == 1) {
                $("#idpreciovendedor").val(parametro_seleccionado.precios_id);
                $("#precio").val(parametro_seleccionado.precios.precio);
                $("#idproductos").val(parametro_seleccionado.producto_id);
                $("#idproductos").trigger("chosen:updated");
                $("#idunidades").val(parametro_seleccionado.unidades_id);
                $("#idunidades").trigger("chosen:updated");
                $("#listadoprecios").val(buscarPreciosAsociacion(parametro_seleccionado.producto_id, parametro_seleccionado.unidades_id));
                $("#descripcion+").val(parametro_seleccionado.descripcion);
                let rutasImagenes = parametro_seleccionado.imagenes.map(imagen => imagen.ruta);
                cargarVariasImg("#imagen", rutasImagenes);
            } else if (modo == 2) {
                eliminarPublicacion(parametro_seleccionado.id);

            }
        }

        function guardarPublicacion() {
            $("#enviar").on("click", function(e) {
                let datosFormulario = "";
                e.preventDefault(); // Previene el envío por defecto del formulario
                // Valida el formulario usando Bootstrap
                var form = document.getElementById("formGuardar");

                if (form.checkValidity() === false) {
                    form.classList.add("was-validated");
                    if ($("#idproductos").val() == "") {
                        $("#idproductos_chosen").removeClass("valid");
                        $("#idproductos_chosen").addClass("is-invalid");
                    } else {
                        $("#idproductos_chosen").removeClass("is-invalid");
                        $("#idproductos_chosen").addClass("valid");
                    }

                    if ($("#idunidades").val() == "") {
                        $("#idunidades_chosen").removeClass("valid");
                        $("#idunidades_chosen").addClass("is-invalid");
                    } else {
                        $("#idunidades_chosen").removeClass("is-invalid");
                        $("#idunidades_chosen").addClass("valid");
                    }
                    if ($("#precio").val() == "") {
                        $("#precio").removeClass("valid");
                        $("#precio").addClass("is-invalid");
                    } else {
                        $("#precio").removeClass("is-invalid");
                        $("#precio").addClass("valid");
                    }

                    if ($("#imagen")[0].files.length === 0) {
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
                // datosFormulario.append('precio', $("#precio").unmask());
                if (vista == 1) {
                    datosFormulario.append('accion', GUARDAR_PUBLICACIONES);
                } else if (vista == 2) {
                    datosFormulario.append('id', parametro_seleccionado.id);
                    datosFormulario.append('accion', ACTUALIZAR_PUBLICACIONES);
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
                            url: "/publicaciones_peticiones", // Reemplaza esto con la URL del servidor
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
                                            '- Se ha agregado la publicación con exito');
                                    } else if (vista == 2) {
                                        mensajeSuccessGeneral(
                                            '- Se ha actualizado la publicación con exito');
                                    }
                                    $("#formGuardar")[0].reset();
                                    tablaPublicaciones.ajax.reload();
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

        function cargarTablaPublicaciones() {
            tablaPublicaciones = $('#tablapublicaciones').DataTable({
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "select": true,
                "ajax": {
                    "url": "/publicaciones",
                    "type": "GET",
                },
                "columns": [{
                        data: 'productos.producto'
                    },
                    {
                        data: 'unidades.unidad'
                    },
                    {
                        data: 'precios.precio',
                        render: function(data, type, row) {
                            return '$' + number_format(data);
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (data.estado == 1) {
                                return '<span class="badge bg-success ">Disponible</span>';
                            } else {
                                return '<span class="badge bg-danger ">No disponible</span>';
                            }
                        }
                    },
                    {
                        data: 'descripcion'
                    },
                    {
                        data: 'imagenes',
                        render: function(data, type, row) {
                            let images = '';
                            row.imagenes.forEach(function(imagen) {
                                images += '<img loading="lazy" src="' + imagen.ruta + '" width="100px" />';
                            });
                            // return images;
                            return '<div class="slider" style="width: 100px;">' + images + '</div>';

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
                },

            }).on('draw.dt', function() {
                    $('.slider').slick({
                        autoplay: false,
                        arrows: true,
                        dots: false,
                        // Otras configuraciones
                    });
                });
        }

        function eliminarPublicacion(id) {
            Swal.fire({
                    title: '¿Esta seguro?',
                    text: "Recuerde que se eliminará la publicación!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/publicaciones_peticiones", // Reemplaza esto con la URL del servidor
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                accion: ELIMINAR_PUBLICACIONES,
                                id: parametro_seleccionado.id,

                            },
                            success: function(respuesta) {
                                // Maneja la respuesta del servidor aquí
                                if (respuesta.estado === 1) {
                                    mensajeSuccessGeneral(
                                        '- Se ha eliminado la publicación con exito');
                                    tablaPublicaciones.ajax.reload();
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


        function buscarPreciosAsociacion(idproductos, idunidades) {
            var idproductosSelect = $('#idproductos').val();
            var idunidadesSelect = $('#idunidades').val();

            if (idproductosSelect && idunidadesSelect) {
                $.ajax({
                    type: 'POST',
                    url: AJAX,
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        accion: BUSCAR_PRECIOSASOCIACION,
                        idproductos: idproductos,
                        idunidades: idunidades
                    },

                    beforeSend: function() {
                    },
                    success: function(respuesta) {
                        $(".carga").removeClass("show").addClass("hidden");
                        var precios_input ='';
                        if (respuesta) {
                            precios_input = '$'+ number_format(respuesta.precio);
                        }
                        // $("#listadoprecios").val(precios_input);
                        $("#listadoprecios").attr('placeholder', precios_input);
                    },
                    error: function(request, status, error) {
                        $("#listadoprecios").attr('placeholder', 'Tu asociación no ha definido un precio para este producto');
                        // $("#listadoprecios").val('Tu asociación no ha definido un precio para este producto');
                        $(".carga").removeClass("show").addClass("hidden");
                    }
                });
            }

        }

        function buscarPreciosVendedor(idproductos, idunidades) {
            var idproductosSelect = $('#idproductos').val();
            var idunidadesSelect = $('#idunidades').val();

            if (idproductosSelect && idunidadesSelect) {
                $.ajax({
                    type: 'POST',
                    url: AJAX,
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        accion: BUSCAR_PRECIOSVENDEDOR,
                        idproductos: idproductos,
                        idunidades: idunidades
                    },

                    beforeSend: function() {
                    },
                    success: function(respuesta) {
                        $(".carga").removeClass("show").addClass("hidden");
                        var precios_input ='';
                        $("#precio").val('');
                        if (respuesta) {
                            precios_input = number_format(respuesta.precio);
                            id_precio_vendedor = respuesta.id;
                        }
                        $("#precio").val(respuesta.precio);
                        $("#idpreciovendedor").val(respuesta.id);
                        // $("#precio").attr('placeholder', precios_input);
                    },
                    error: function(request, status, error) {
                        $("#idpreciovendedor").val('');
                        $("#precio").val('');
                        $("#precio").attr('placeholder', 'Define un precio');
                        $(".carga").removeClass("show").addClass("hidden");
                    }
                });
            }
        }

        // function cargarVariasImg(campo, rutas) {
        //     $(campo).fileinput('destroy');
        //     const initialPreview = [];
        //     const initialPreviewConfig = [];

        //     rutas.forEach((ruta, index) => {
        //         const imgId = 'imgcargada_' + index;
        //         const img =
        //             `<img src="${ruta}" class="kv-preview-data file-preview-image" loading="lazy" id="${imgId}">`;

        //         initialPreview.push(img);
        //         initialPreviewConfig.push({
        //             caption: `Imagen ${index + 1}`,
        //             width: '120px', // Ancho de la vista previa
        //             type: 'POST',
        //             url: '/eliminar_imagen',
        //             key: index, // Identificador único para la imagen
        //         });
        //     });

        //     $(campo).fileinput({
        //         initialPreview: initialPreview,
        //         initialPreviewConfig: initialPreviewConfig,
        //         theme: 'fa5',
        //         language: 'es',
        //         previewFileType: "image",
        //         allowedFileExtensions: ["png", "jpg", "jpeg", "svg", "webp"],
        //         showUpload: false,
        //         maxFilesNum: 5,
        //         required: true,
        //     }).on('filebeforedelete', function(event, key, data) {
        //         return new Promise(function(resolve, reject) {
        //             $.confirm({
        //                 title: '¡Atención!',
        //                 content: '¿Estás seguro de que quieres eliminar esta imagen?',
        //                 type: 'red',
        //                 buttons: {
        //                     ok: {
        //                         btnClass: 'btn-primary text-white',
        //                         keys: ['enter'],
        //                         action: function() {
        //                             $.ajaxSetup({
        //                                 headers: {
        //                                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                                 }
        //                             });
        //                             $.ajax({
        //                                 type: 'POST',
        //                                 url: '/eliminar_imagen',
        //                                 data: {
        //                                     // "_token": "{{ csrf_token() }}",
        //                                     "_token": $('meta[name="csrf-token"]').attr('content'),
        //                                     id: key
        //                                 },
        //                                 success: function(response) {
        //                                     resolve();
        //                                 },
        //                                 error: function(error) {
        //                                     reject();
        //                                 }
        //                             });
        //                         }
        //                     },
        //                     cancel: function() {
        //                         $.alert('Eliminación cancelada');
        //                     }
        //                 }
        //             });
        //         });
        //     }).on('filedeleted', function(event, key, data) {
        //         setTimeout(function() {
        //             $.alert('Imagen eliminada con éxito');
        //         }, 900);
        //     });
        // }


        
    </script>


@endsection