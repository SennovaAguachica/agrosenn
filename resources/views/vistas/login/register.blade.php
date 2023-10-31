@extends('../scripts.login.loginscript')
@section('titulo')
    <title>Login</title>
@endsection
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-10 col-md-12 m-auto">
                <div class="row">
                    <div class="col-lg-6 col-md-8 m-auto">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h1 class="mb-5">Crear cuenta</h1>
                                    <p class="mb-30">Ya tienes una cuenta? <a href="/login">Login</a></p>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="idtipodocumento">Tipo documento *</label>
                                            <select class="form-control form-control-chosen" name="idtipodocumento"
                                                id="idtipodocumento" data-placeholder="Seleccione una opción" required>
                                                <option value=""></option>
                                                @foreach ($tiposDocumentos as $item)
                                                    <option value="{{ $item->id }}">{{ $item->tipo_documento }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Selecciona un tipo de documento válido.
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="documento">Nº documento *</label>
                                            <input type="text" class="form-control" name="documento" id="documento"
                                                required>
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="nombres">Nombres *</label>
                                            <input type="text" class="form-control" name="nombres" id="nombres"
                                                required>
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="apellidos">Apellidos *</label>
                                            <input type="text" class="form-control" name="apellidos" id="apellidos"
                                                required>
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="celular">Nº celular *</label>
                                            <input type="tel" class="form-control" name="celular" id="celular"
                                                required>
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="email">Correo electronico</label>
                                            <input type="text" class="form-control" name="email" id="email">
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xs-12">
                                            <label for="direccion">Dirección</label>
                                            <input type="tel" class="form-control" name="direccion" id="direccion">
                                            <div class="invalid-feedback">
                                                Campo obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="iddepartamento">Departamento *</label>
                                            <select class="form-control form-control-chosen" name="iddepartamento"
                                                id="iddepartamento" data-placeholder="Seleccione una opción" required>
                                                <option value=""></option>
                                                @foreach ($departamentos as $item)
                                                    <option value="{{ $item->id }}">{{ $item->departamento }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Selecciona un departamento válido.
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="idmunicipio">Municipio *</label>
                                            <select class="form-control form-control-chosen" name="idmunicipio"
                                                id="idmunicipio" data-placeholder="Seleccione una opción" required>
                                            </select>
                                            <div class="invalid-feedback">
                                                Selecciona un municipio válido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="password">Contraseña *</label>
                                                <input required="" type="password" name="password" id="password"
                                                    placeholder="Contraseña" />
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-6">
                                            <label for="password_confirmation">Confirmar contraseña *</label>
                                                <input required="" type="password" name="password_confirmation"
                                                    id="password_confirmation" placeholder="Confirme contraseña" />
                                        </div>
                                    </div>
                                    <div class="payment_option mb-50">
                                        <div class="custome-radio">
                                            <input class="form-check-input" required="" type="radio"
                                                name="payment_option" id="radiocliente" />
                                            <label class="form-check-label" for="radiocliente"
                                                data-bs-toggle="collapse" data-target="#bankTranfer"
                                                aria-controls="bankTranfer">Soy un
                                                cliente</label>
                                        </div>
                                        <div class="custome-radio">
                                            <input class="form-check-input" required="" type="radio"
                                                name="payment_option" id="radiovendedor" />
                                            <label class="form-check-label" for="radiovendedor"
                                                data-bs-toggle="collapse" data-target="#checkPayment"
                                                aria-controls="checkPayment">Soy un
                                                vendedor</label>
                                        </div>
                                    </div>
                                    <div id="checkPayment" class="collapse">
                                        <div class="form-group">
                                            <label for="codigoasociacion">Código de Asociación</label>
                                            <input type="text" class="form-control" id="codigoasociacion" name="codigoasociacion">
                                        </div>
                                    </div>
                                    <div class="login_footer form-group mb-50">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox"
                                                    id="exampleCheckbox12" value="" />
                                                <label class="form-check-label" for="exampleCheckbox12"><span>Acepto los
                                                        terminos y condiciones.</span></label>
                                            </div>
                                        </div>
                                        <a href="page-privacy-policy.html"><i
                                                class="fi-rs-book-alt mr-5 text-muted"></i>Leer
                                            terminos y condiciones</a>
                                    </div>
                                    <div class="form-group mb-30">
                                        <button type="submit"
                                            class="btn btn-fill-out btn-block hover-up font-weight-bold"
                                            name="login">Enviar &amp; Registrarme</button>
                                    </div>
                                    <p class="font-xs text-muted"><strong>Nota:</strong>Sus datos personales se
                                        utilizarán
                                        para
                                        respaldar su experiencia en este sitio web, para administrar el acceso a su
                                        cuenta y
                                        para otros fines descritos en nuestra política de privacidad</p>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6 pr-30 d-none d-lg-block">
                    <div class="card-login mt-115">
                        <a href="#" class="social-login facebook-login">
                            <img src="assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                            <span>Continue with Facebook</span>
                        </a>
                        <a href="#" class="social-login google-login">
                            <img src="assets/imgs/theme/icons/logo-google.svg" alt="" />
                            <span>Continue with Google</span>
                        </a>
                        <a href="#" class="social-login apple-login">
                            <img src="assets/imgs/theme/icons/logo-apple.svg" alt="" />
                            <span>Continue with Apple</span>
                        </a>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
