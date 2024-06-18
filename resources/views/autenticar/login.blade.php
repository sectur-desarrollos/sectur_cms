<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Descripcion del website --}}
    <meta name="description" content="Página institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas" />
    {{-- Palabras clave del website --}}
    <meta name="keywords" content="Página institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas" />
    {{-- Autor del website --}}
    <meta name="author" content="Gobierno del Estado de Chiapas">
    {{-- Titulo al comaprtie el enlace  --}}
    <meta property="og:title" content="Secretaría de Turismo">
    {{-- Short name of the website --}}
    <meta property="og:title" content="Secretaría de Turismo - Chiapas"/>
    {{-- Enlace completo al ompartir el website --}}
    <meta property="og:url" content="https://institucional.visitchiapas.com/"/>
    {{-- Descripción que va a tener al compartir el website --}}
    <meta property="og:description" content="Página Institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas">
    {{-- Icono (favicon) para el website --}}
    <link rel="icon" type="image/x-icon" href="{{asset('assets/imgs/sectur/favicon_chiapas.png')}}">
    
    <title>Secretaría de Turismo - Iniciar sesión</title>

    <link href="{{asset('assets/assets-bootstrap/bootstrap-general/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/assets-bootstrap/bootstrap-login/sign-in.css')}}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" href="{{asset('assets/imgs/sectur/favicon_chiapas.png')}}">
    <meta name="theme-color" content="#712cf9">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

    </style>

    <!-- Custom styles for this template -->
    {{-- <link href="https://getbootstrap.com/docs/5.2/examples/sign-in/signin.css" rel="stylesheet"> --}}
    
    {{-- Google Recaptcha inicia --}}
    <script src="https://www.google.com/recaptcha/api.js?render=6LezrxAjAAAAACrsBq12qCMw1SRdmWYfS61a-d_s"></script>
    <script>
        document.addEventListener('submit', function(e){
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('6LezrxAjAAAAACrsBq12qCMw1SRdmWYfS61a-d_s', {action: 'submit'}).then(function(token) {

                    let form = e.target;

                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'g-recaptcha-response';
                    input.value = token;

                    form.appendChild(input);

                    form.submit();
                });
            });
        })
    </script>
    {{-- Google recaptcha termina --}}
    <style>
        .error-text{
            font-size: 0.9em;
        }
    </style>
</head>

<body class="text-center">

    <main class="form-signin w-100 m-auto">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-header">
                <h1 class="fs-6">Inicia Sesión</h1>
                <img src="{{asset('assets/imgs/sectur/logo_sectur.png')}}" alt="logo-sectur-chiapas" >
            </div>
            <div class="card-body">
                <form id="demo-form" action="{{ route('validar') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email"
                            value="{{ old('email') }}">
                        <label for="floatingInput">Correo electrónico</label>
                        @error('email')
                            <span class="text-danger error-text">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" placeholder="Password"
                            name="password">
                        <label for="floatingPassword">Contraseña</label>
                        @error('password')
                            <span class="text-danger error-text">{{$message}}</span>
                        @enderror
                    </div>
                    @if (session('errors'))
                    <hr>
                        @error('g-recaptcha-response')
                            <span class="text-danger error-text">{{$message}}</span>
                        @enderror
                    @endif
                    <br>
                    <button class="w-100 btn btn-sm btn-primary" type="submit">Entrar</button>
                </form>
            </div>
            <div class="card-footer">
                <p class="text-muted">&copy; Secretaría de Turismo</p>
            </div>
        </div>
    </main>

</body>

</html>
