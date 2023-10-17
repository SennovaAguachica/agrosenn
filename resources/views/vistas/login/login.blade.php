@extends('../scripts.login.loginscript')
@section('titulo')
    <title>Login</title>
@endsection
@section('contenido')
    <div class="page-content pt-150 pb-150">

        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <img class="border-radius-15" src="assetsfront/imgs/page/login-1.png" alt="" />
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5">Inicio de sesión</h1>
                                        <p class="mb-30">No tienes una cuenta? <a href="/register">Crear una</a></p>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" required="" id="email" name="email"
                                                placeholder="Usuario o correo *" />
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" id="password" name="password"
                                                placeholder="Tu contraseña *" />
                                        </div>
                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="exampleCheckbox1" value="" />
                                                    <label class="form-check-label" for="exampleCheckbox1"><span>Recordar
                                                            me</span></label>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="#">Olvidaste tu contraseña?</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up"
                                                name="login">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
