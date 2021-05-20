<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>

    <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <!-- Los iconos tipo Solid de Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    <!-- Nuestro css-->
    <link rel="stylesheet" type="text/css" href="/css/login.css">

</head>
<body>
    <div class="modal-dialog text-center">
        <div class="col-sm-12 main-section">
            <div class="modal-content">

                <div class="col-12 user-img">
                    <img src="/img/user.png"/>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group" id="user-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email de usuario" name="email" autofocus>
                    </div>

                    <div class="form-group" id="contrasena-group">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contrasena" name="password" required autocomplete="current-password">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i>  {{ __('Login') }} </button>
                </form>

                @error('password')
                    <div class="alert alert-danger" role="alert">
                       {{ $message }}
                    </div>
		        @enderror
            </div>

        </div>
    </div>
</body>
</html>