@extends('../vistas.plantilla.modales')
@extends('../vistas.plantilla.plantillaback')
@section('script')
    <script>
        var AJAX = "/perfil_peticiones";
        var BUSCAR_MUNICIPIOS = 1;
        $(document).ready(function() {
            $('#li_gestion_unidades').addClass('active');
            $('#i_unidades').css('color', '#3BB77E');
            $('#a_equivalencias').addClass('active');
            selectChanges();
        });
        function selectChanges() {
            $("#iddepartamento").change(function() {
                buscarMunicipios($(this).val());
            })
        }
        function buscarMunicipios(iddepartamento) {
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
    </script>
@endsection
