@extends('../vistas.plantilla.plantillafront')
@section('script')
    <script>
        var AJAX = "/login_peticiones";
        $(document).ready(function() {
            selectChange();
        });

        function selectChange() {
            $("#iddepartamento").change(function() {
                buscarMunicipios($(this).val());
            })
            var clienteRadio = document.getElementById("radiocliente");
            var vendedorRadio = document.getElementById("radiovendedor");
            var associationCodeField = document.getElementById("checkPayment");
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
    </script>
@endsection
