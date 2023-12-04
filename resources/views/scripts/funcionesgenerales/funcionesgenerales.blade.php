<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css" rel="stylesheet" type="text/css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
    $(document).ready(function() {
        $('.form-control-chosen').chosen({
            no_results_text: "Oops, no se encontró a ",
        });
        $('table tr').mouseover(function() {
            $(this).addClass('row_selected');
        });
        $('table tr').mouseout(function() {
            $(this).removeClass('row_selected');
        });
    });

    function cargarImagen(campo) {
        $(campo).fileinput({
            theme: 'fa5',
            language: 'es',
            previewFileType: "png",
            allowedFileExtensions: ["png", "jpg", "jpeg", "svg", "webp",],
            showUpload: false,
            maxFilesNum: 1,
            required: true,
        });
    }

    function cargarVariasImagen(campo) {
        $(campo).fileinput({
            theme: 'fa5',
            language: 'es',
            previewFileType: "png",
            allowedFileExtensions: ["png", "jpg", "jpeg", "svg", "webp",],
            showUpload: false,
            maxFilesNum: 5,
            required: true,
        });
    }

    function inputMoneda(campo) {
        $(campo).priceFormat({
            prefix: '$',
            suffix: '',
            centsSeparator: ',',
            centsLimit: 0
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

    function mensajeError(valor) {
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
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'error',
            title: valor,
        })
    }

    function mensajeSuccess(valor) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: valor,
        })
    }

    function number_format(amount, decimals) {

        amount += ''; // por si pasan un numero en vez de un string
        amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

        decimals = decimals || 0; // por si la variable no fue fue pasada

        // si no es un numero o es igual a cero retorno el mismo cero
        if (isNaN(amount) || amount === 0)
            return parseFloat(0).toFixed(decimals);

        // si es mayor o menor que cero retorno el valor formateado como numero
        amount = '' + amount.toFixed(decimals);

        var amount_parts = amount.split('.'),
            regexp = /(\d+)(\d{3})/;

        while (regexp.test(amount_parts[0]))
            amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

        return amount_parts.join('.');
    }

    function cargarImg(campo, ruta) {
        $(campo).fileinput('destroy');
        $(campo).fileinput({
            initialPreview: '<img src=' + ruta + ' id="imgcargada" class="kv-preview-data file-preview-image" loading="lazy">',
            theme: 'fa5',
            language: 'es',
            previewFileType: "png",
            allowedFileExtensions: ["png", "jpg", "jpeg", "svg", "webp",],
            showUpload: false,
            maxFilesNum: 1,
            required: true,
        });
        $('#imgcargada').prop('src', ruta);
    }

    // function cargarVariasImg(campo, rutas) {
    //     $(campo).fileinput('destroy');
    //     const initialPreview = [];
    
    //     rutas.forEach((ruta, index) => {
    //         const imgId = 'imgcargada_' + index;
    //         const img = `<img src="${ruta}" class="kv-preview-data file-preview-image" loading="lazy" id="${imgId}">`;

    //         initialPreview.push(img);
    //     });

    //     $(campo).fileinput({
    //         initialPreview: initialPreview,
    //         initialPreviewConfig: [], 
    //         theme: 'fa5',
    //         language: 'es',
    //         previewFileType: "image",
    //         allowedFileExtensions: ["png", "jpg", "jpeg", "svg", "webp"],
    //         showUpload: false,
    //         maxFilesNum: 5, 
    //         required: true,
    //     });

    //     rutas.forEach((ruta, index) => {
    //         const imgId = 'imgcargada_' + index;
    //         $('#' + imgId).prop('src', ruta);
    //     });
    // }

    function cargarVariasImg(campo, rutas) {
    $(campo).fileinput('destroy');
    const initialPreview = [];
    const initialPreviewConfig = [];

    rutas.forEach((ruta, index) => {
        const imgId = 'imgcargada_' + index;
        const img = `<img src="${ruta}" class="kv-preview-data file-preview-image" loading="lazy" id="${imgId}">`;
        
        initialPreview.push(img);
        initialPreviewConfig.push({
            caption: `Imagen ${index + 1}`,
            width: '120px', // Ancho de la vista previa
            type: 'GET',
            url: '/eliminar_imagen',
            data: {
                "_token": "{{ csrf_token() }}",
                id: index
                // accion: ELIMINAR_PRODUCTOS,
            },
            key: index, // Identificador único para la imagen
        });
    });

    $(campo).fileinput({
        initialPreview: initialPreview,
        initialPreviewConfig: initialPreviewConfig,
        theme: 'fa5',
        language: 'es',
        previewFileType: "image",
        allowedFileExtensions: ["png", "jpg", "jpeg", "svg", "webp"],
        showUpload: false,
        maxFilesNum: 5,
        required: true,
    }).on('filebeforedelete', function(event, key, data) {
        return new Promise(function(resolve, reject) {
            $.confirm({
                title: '¡Atención!',
                content: '¿Estás seguro de que quieres eliminar esta imagen?',
                type: 'red',
                buttons: {
                    ok: {
                        btnClass: 'btn-primary text-white',
                        keys: ['enter'],
                        action: function () {
                            resolve();
                        }
                    },
                    cancel: function () {
                        $.alert('Eliminación cancelada');
                    }
                }
            });
        });
    }).on('filedeleted', function (event, key, data) {
        setTimeout(function () {
            $.alert('Imagen eliminada con éxito');
        }, 900);
    });
}
    
</script>
