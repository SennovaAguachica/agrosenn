@extends('../vistas.plantilla.plantillafront')
@section('script')
    <script>
        var AJAX = "/index_peticiones";
        var datosProductos = @json($vendedor);
        $(document).ready(function() {
            console.log(datosProductos);
            $(".btnverimagenes").on("click", function(e) {
                var valorData = $(this).data("idpublicacion");
                var divimgprincipal = $(".product-image-slider");
                var divImgSlider = $(".slider-nav-thumbnails");
                var divInformacion = $(".detail-info");

                var slickYaInicializado = divimgprincipal.hasClass('slick-initialized');

                // Si Slick ya se ha inicializado, desvincula la instancia actual
                if (slickYaInicializado) {
                    divimgprincipal.slick('unslick');
                    divImgSlider.slick('unslick');
                }

                divimgprincipal.empty();
                divImgSlider.empty();
                divInformacion.empty();
                $.each(datosProductos.usuario.publicaciones, function(index, publicacion) {
                    if (publicacion.id == valorData) {
                        $.each(publicacion.imagenes, function(index, imagen) {
                            var nuevoElemento = $(
                                "<figure class='border-radius-10'><img src='" +
                                imagen.ruta +
                                "' alt='product image' /></figure>");
                            divimgprincipal.append(nuevoElemento);
                            var nuevoElementoSlider = $(
                                "<div><img src='" +
                                imagen.ruta +
                                "' alt='product image' /></div>");
                            divImgSlider.append(nuevoElementoSlider);
                        });
                        var contenidoDespuesDeImagenes = `
                            <span class="stock-status in-stock"> Disponible </span>
                            <h3 class="title-detail"><a href="shop-product-right.html" class="text-heading">${publicacion.productos.producto}</a></h3>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (400 reviews)</span>
                                </div>
                            </div>
                            <br>
                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand">${'$' +publicacion.precios.precio}</span>
                                    <span>
                                        <span class="save-price font-md color4 ml-18">X ${publicacion.unidades.unidad}</span>
                                        {{-- <span class="old-price font-md ml-15">${publicacion.unidades.unidad}</span> --}}
                                    </span>
                                </div>
                            </div>
                            <div class="detail-extralink mb-30">
                                {{-- <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <span class="qty-val">1</span>
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div> --}}
                                <div class="product-extra-link2">
                                    <button type="submit" class="button button-add-to-cart"><i class="fa-brands fa-whatsapp fa-xl"></i>Lo quiero!</button>
                                </div>
                            </div>
                        `;

                        // Agrega el contenido después de las imágenes
                        divInformacion.append(contenidoDespuesDeImagenes);
                    }
                });
                inicializarSlick();
            });

        });

        function inicializarSlick() {
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
        }
    </script>
@endsection
