<!-- Modal -->
<div class="modal fade" id="modalGuardarProductos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar productos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <br>
                <form class="row g-3 needs-validation" id="formProductos" novalidate>
                    @csrf
                    @yield('modal')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="enviarProducto"><i class="fas fa-save"></i>
                    Guardar</button>
            </div>

        </div>
    </div>
</div>
{{-- Registrar categorias --}}
<div class="modal fade" id="modalGuardarForm" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Registros</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <br>
                <form class="row g-3 needs-validation" id="formGuardar" novalidate>
                    @csrf
                    <div class="container">
                        @yield('informacionModal')
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="enviar"><i class="fas fa-save"></i>
                    Guardar</button>
            </div>

        </div>
    </div>
</div>
{{-- Registrar subcategorias --}}
<div class="modal fade" id="modalGuardarFormSubcategoria" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Registros</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <br>
                <form class="row g-3 needs-validation" id="formGuardarSubcategoria" novalidate>
                    @csrf
                    @yield('subcategoriaModal')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="enviarSubcategoria"><i class="fas fa-save"></i>
                    Guardar</button>
            </div>

        </div>
    </div>
</div>
