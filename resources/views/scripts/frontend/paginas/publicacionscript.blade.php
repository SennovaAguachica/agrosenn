@extends('../vistas.plantilla.plantillafront')
@section('script')
    <script>
        $(document).ready(function() {
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
