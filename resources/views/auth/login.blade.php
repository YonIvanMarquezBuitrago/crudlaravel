<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisGestArchivos | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    {{--<link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">--}}
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    {{--<link rel="stylesheet" href="../public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    {{--<link rel="stylesheet" href="../public/dist/css/adminlte.min.css">--}}
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    {{--Animate css--}}
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
</head>
<style>
    @font-face {
        font-family: 'Valenzka';
        src: url('{{asset('font/Valenzka.ttf')}}');
    }

    .titulo1 {
        font-family: 'Valenzka';
        font-size: 35pt;
        color: white;
        text-shadow: 0.1em 0.1em 0.5em black;
    }
</style>
<body class="hold-transition login-page"
      style="background: url('{{asset('imagenes/fondo.jpg')}}');
      background-repeat: no-repeat;
      background-size: 100vw 100vh;
      z-index: -3;
      background-attachment: fixed">
<div class="login-box">
    <div class="login-logo animated zoomInLeft delay-2s">
        <a href="{{url('/')}}"><b class="titulo1">Sistema Gestión de Archivos</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="animated slideInDown delay-1s">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ingrese sus Credenciales</p>
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-12">
                                <label for="email">{{ __('Email Address') }}</label>
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"
                                           autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-12">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <a href="{{url('/registro')}}">¿No tienes una cuenta?, Registrate</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>
