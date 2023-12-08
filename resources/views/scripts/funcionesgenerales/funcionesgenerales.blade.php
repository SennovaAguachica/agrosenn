
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
            allowedFileExtensions: ["png", "jpg", "jpeg", "svg", "webp", ],
            showUpload: false,
            maxFilesNum: 1,
            required: true,
        });
    }


    
    function cargarVariasImagen(campo) {
        // var imagenesSeleccionadas = [];
        $(campo).fileinput({
            uploadUrl:'#',
            theme: 'fa5',
            language: 'es',
            previewFileType: "png",
            allowedFileExtensions: ["png", "jpg", "jpeg", "svg", "webp", ],
            showUpload: false,
            maxFilesNum: 5,
            required: true,
            overwriteInitial: false,
            fileActionSettings: {
                showRemove: true,
                showUpload: true, //This remove the upload button
                showZoom: true,
                showDrag: false,
                showRotate: false,
                removeIcon: '<i class="fa fa-trash"></i>', // Cambiar el icono de eliminación si es necesario
                removeClass: 'btn btn-sm btn-danger', // Cambiar la clase de estilo del botón de eliminación si es necesario
                indicatorNew: '<i class="fa fa-plus-circle text-warning"></i>',
                indicatorSuccess: '<i class="fa fa-check-circle text-success"></i>',
                indicatorError: '<i class="fa fa-times-circle text-danger"></i>',
            },
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
            initialPreview: '<img src=' + ruta +
                ' id="imgcargada" class="kv-preview-data file-preview-image" loading="lazy">',
            theme: 'fa5',
            language: 'es',
            previewFileType: "png",
            allowedFileExtensions: ["png", "jpg", "jpeg", "svg", "webp", ],
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

    function cargarVariasImagenes(campo) {
    // Obtener las rutas de las imágenes existentes
    var rutasImagenes = obtenerRutasImagenesExist();
    
    $(campo).fileinput({
        uploadUrl: '#',
        theme: 'fa5',
        language: 'es',
        previewFileType: "png",
        allowedFileExtensions: ["png", "jpg", "jpeg", "svg", "webp",],
        showUpload: false,
        maxFilesNum: 5,
        required: true,
        overwriteInitial: false,
        initialPreview: rutasImagenes,  // Rutas de las imágenes existentes
        initialPreviewConfig: obtenerConfiguracionImagenesExist(),
        fileActionSettings: {
            showRemove: true,
            showUpload: false,
            showZoom: true,
            showDrag: false,
            showRotate: false,
                removeIcon: '<i class="fa fa-trash"></i>', // Cambiar el icono de eliminación si es necesario
    removeClass: 'btn btn-sm btn-danger', // Cambiar la clase de estilo del botón de eliminación si es necesario
    indicatorNew: '<i class="fa fa-plus-circle text-warning"></i>',
    indicatorSuccess: '<i class="fa fa-check-circle text-success"></i>',
    indicatorError: '<i class="fa fa-times-circle text-danger"></i>',
        },
    });
}

function obtenerRutasImagenesExist() {
    // Obtén las imágenes seleccionadas por el usuario
    var imagenesSeleccionadas = $('#imagen').fileinput('getFileStack');

    // Verifica si imagenesSeleccionadas es un iterable antes de usar map
    if (Array.isArray(imagenesSeleccionadas)) {
        // Mapea las imágenes seleccionadas para obtener sus rutas
        var rutasImagenes = imagenesSeleccionadas.map(function(imagen) {
            return URL.createObjectURL(imagen);
        }).toArray();

        return rutasImagenes;
    } else {
        // Si no es un iterable, devuelve un array vacío o maneja el caso según sea necesario
        return [];
    }
}

function obtenerConfiguracionImagenesExist() {
    // Obtén las imágenes seleccionadas por el usuario
    var imagenesSeleccionadas = $('#imagen').fileinput('getFileStack');

    // Verifica si imagenesSeleccionadas es un array antes de usar map
    if (Array.isArray(imagenesSeleccionadas)) {
        // Mapea las imágenes seleccionadas para obtener su configuración
        var configuracionImagenes = imagenesSeleccionadas.map(function(imagen, index) {
            return {
                caption: "Imagen " + (index + 1),
                width: "120px",
                key: index
            };
        });

        return configuracionImagenes;
    } else {
        // Si no es un array, devuelve un array vacío o maneja el caso según sea necesario
        return [];
    }
}
</script>
