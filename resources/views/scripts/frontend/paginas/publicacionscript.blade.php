@extends('../vistas.plantilla.plantillafront')
@section('script')
    <script>
        $(document).ready(function() {

            $(".btncomprarpublicacion").on("click", function(e) {
                e.preventDefault();

                var cantidad1 = $('#cantidad').val();
                var preciounitario = document.getElementById('precio_unitario_publicacion').innerText;
                // var preciounidad = preciounidad.textContent
                var cantParse = parseInt(cantidad1, 10);
                var precParse = parseInt(preciounitario, 10);
                var preciototal = cantParse * precParse;      
                // Actualiza la URL del enlace de WhatsApp con el valor de 'cantidad'
                var nuevaURL = "https://api.whatsapp.com/send?phone={{ $publicacion->usuario->vendedor->n_celular ?? $publicacion->usuario->asociacion->n_celular }}&text=Hola, estoy interesado en comprar  " +
                cantidad1 +
                " {{ $publicacion->unidades->unidad }} del  producto {{ $publicacion->productos->producto }}"+ 
                " con precio unitario de ${{ $publicacion->precios->precio }} "+
                "y precio total de $" + preciototal +
                " publicado en Agrosenn.";
                                            
                // Actualiza la propiedad 'href' del enlace
                // $(this).attr('href', nuevaURL);


                // direccion = $(this).attr("href");
                direccion = nuevaURL;
                indicador = $(this).data("indicador");
                var idpublicacion = $(this).data("idpublicacion");
                var cantidad = $("#cantidad").val();
                var idvendedor = $(this).data("idvendedor");
                if (perfil == "") {
                    $("#modaliniciosesion").modal("show");
                } else {
                    Swal.fire({
                        title: 'Esta seguro de contactar al vendedor?',
                        text: "Si acepta iniciara una solicitud de compra automaticamente!",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "/ventas_peticiones", // Reemplaza esto con la URL del servidor
                                method: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    accion: 3,
                                    idcliente: perfil.idcliente,
                                    idvendedor: idvendedor,
                                    cantidad: cantidad,
                                    idpublicacion: idpublicacion
                                },
                                beforeSend: function() {
                                    $(".carga").removeClass("hidden").addClass("show");
                                },
                                success: function(respuesta) {
                                    // Maneja la respuesta del servidor aquí
                                    if (respuesta.estado === 1) {
                                        window.location.href = direccion;
                                    } else {
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: 'top-end',
                                            iconColor: 'white',
                                            customClass: {
                                                popup: 'colored-toast'
                                            },
                                            showConfirmButton: false,
                                            timer: 3500,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.addEventListener('mouseenter',
                                                    Swal.stopTimer)
                                                toast.addEventListener('mouseleave',
                                                    Swal.resumeTimer)
                                            }
                                        })
                                        Toast.fire({
                                            icon: 'error',
                                            title: respuesta.mensaje,
                                        });
                                    }
                                    $(".carga").removeClass("show").addClass("hidden");
                                },
                                error: function(request, status, error) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: "Se produjo un error durante el proceso, vuelve a intentarlo",
                                        allowOutsideClick: false,
                                    });
                                    $(".carga").removeClass("show").addClass("hidden");
                                }
                            });
                        }
                    });
                }
            });

            $('.product-image-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: false,
                asNavFor: '.slider-nav-thumbnails',
            });

            $(".slider-nav-thumbnails").slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: ".product-image-slider",
                dots: false,
                focusOnSelect: true,

                prevArrow: '<button type="button" class="slick-prev"><i class="fi-rs-arrow-small-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fi-rs-arrow-small-right"></i></button>',
            });

            // Remove active class from all thumbnail slides
            $(".slider-nav-thumbnails .slick-slide").removeClass("slick-active");

            // Set active class to first thumbnail slides
            $(".slider-nav-thumbnails .slick-slide").eq(0).addClass("slick-active");

           // On before slide change match active thumbnail to current slide
            $(".product-image-slider").on(
                "beforeChange",
                function(event, slick, currentSlide, nextSlide) {
                    var mySlideNumber = nextSlide;
                    $(".slider-nav-thumbnails .slick-slide").removeClass(
                        "slick-active"
                    );
                    $(".slider-nav-thumbnails .slick-slide")
                        .eq(mySlideNumber)
                        .addClass("slick-active");
                }
            );

            $(".product-image-slider").on(
                "beforeChange",
                function(event, slick, currentSlide, nextSlide) {
                    var img = $(slick.$slides[nextSlide]).find("img");
                    $(".zoomWindowContainer,.zoomContainer").remove();
                    if ($(window).width() > 768) {
                        $(img).elevateZoom({
                            zoomType: "inner",
                            cursor: "crosshair",
                            zoomWindowFadeIn: 500,
                            zoomWindowFadeOut: 750,
                        });
                    }
                }
            );
            //Elevate Zoom
            if ($(".product-image-slider").length) {
                if ($(window).width() > 768) {
                    $(".product-image-slider .slick-active img").elevateZoom({
                        zoomType: "inner",
                        cursor: "crosshair",
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 750,
                    });
                }
            }
        });
    </script>
@endsection
