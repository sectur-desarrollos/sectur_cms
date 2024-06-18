<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    {{-- Descripcion del website --}}
    <meta name="description"
        content="Página institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas" />
    {{-- Palabras clave del website --}}
    <meta name="keywords"
        content="Página institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas" />
    {{-- Autor del website --}}
    <meta name="author" content="Gobierno del Estado de Chiapas">
    {{-- Titulo al comaprtie el enlace  --}}
    <meta property="og:title" content="Secretaría de Turismo">
    {{-- Imagen del website al momento de compartir un enlace ó el enlace general del sitio --}}
    <meta property="og:image" content="{{asset('assets/imgs/sectur/logo_sectur.png')}}">
    {{-- Short name of the website --}}
    <meta property="og:title" content="SECTUR Chiapas" />
    {{-- Enlace completo al ompartir el website --}}
    <meta property="og:url" content="https://institucional.visitchiapas.com/" />
    {{-- Descripción que va a tener al compartir el website --}}
    <meta property="og:description"
        content="Página institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> --}}
    {{-- Estilos de boostrap 5 --}}
    <link href="{{asset('assets/assets-bootstrap/bootstrap-general/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- Icono (favicon) para el website --}}
    <link rel="icon" type="image/x-icon" href="{{asset('assets/imgs/sectur/favicon_chiapas.png')}}">
    {{-- Estilo CSS para la animación del menú de navegación --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    {{-- En dado caso que el CDN del menu de navegación para animate.min.cs no pueda funcionar aquí está el archivo puro (se debe de descomentar) --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/navbar/animate.min.css')}}"> --}}
    <title>
        Secretaría de Turismo del Estado de Chiapas
    </title>
    {{-- Estilos CSS para el menú de navegación --}}
    <style>
        .dropdown-menu {
            margin-top: 0;
        }

        .dropdown-menu .dropdown-toggle::after {
            vertical-align: middle;
            border-left: 4px solid;
            border-bottom: 4px solid transparent;
            border-top: 4px solid transparent;
        }

        .dropdown-menu .dropdown .dropdown-menu {
            left: 100%;
            top: 0%;
            margin: 0 20px;
            border-width: 0;
        }

        .dropdown-menu .dropdown .dropdown-menu.left {
            right: 100%;
            left: auto;
        }

        @media (min-width: 768px) {
            .dropdown-menu .dropdown .dropdown-menu {
                margin: 0;
                border-width: 1px;
            }

            .dropdown-menu>li a:hover,
            .dropdown-menu>li.show {
                background: #007bff;
                color: white;
            }

            .dropdown-menu>li.show>a {
                color: white;
            }
        }

    </style>

    <style>
        .fot {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            /* Set the fixed height of the footer here */
            line-height: 60px;
            /* Vertically center the text there */
        }

        footer {
            position: sticky;
            width: 100%;
        }

    </style>
    <link rel="stylesheet" href="{{asset('assets/css/estilos.css')}}">

    {{-- Inicia links de chiapas.gob.mx --}}

                    <!-- Google Fonts -->
                    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">

                    <!-- CSS Global Compulsory -->
                    
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/bootstrap/bootstrap.min.css')}}"> --}}
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/bootstrap/offcanvas.css')}}"> --}}

                    <!-- CSS Implementing Plugins -->
                    <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/icon-awesome/css/font-awesome.min.css')}}">
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/icon-line-pro/style.css')}}"> --}}
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/icon-line/css/simple-line-icons.css')}}"> --}}
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/icon-hs/style.css')}}"> --}}
                    <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/dzsparallaxer/dzsparallaxer.css')}}">
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/dzsparallaxer/dzsscroller/scroller.css')}}"> --}}
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/dzsparallaxer/advancedscroller/plugin.css')}}"> --}}
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/animate.css')}}"> --}}
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets//vendor/typedjs/typed.css')}}"> --}}
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/hamburgers/hamburgers.min.css')}}"> --}}
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/fancybox/jquery.fancybox.css')}}"> --}}
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/vendor/slick-carousel/slick/slick.css')}}"> --}}

                    <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/css/unify-core.css')}}">
                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/css/unify-components.css')}}"> --}}
                    <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/css/unify-globals.css')}}">

                    {{-- <link rel="stylesheet" href="{{asset('assets/plantilla-chiapas-gob/assets/css/custom.css')}}"> --}}

                    {{-- Estilos para el banner institucional --}}
                    <style>
                        .probando-banner-institucional-normal{
                            height: 100%; 
                            /* background-image: url({{url('assets/plantilla-chiapas-gob/assets/img-temporal/1920x1080/banner-general-turismo.webp')}}); */
                        }
                        .probando-banner-institucional-movil{
                            display: none;
                        }

                        @media only screen and (max-width: 770px) {
                            .probando-banner-institucional-normal{
                                display: none;
                            }
                            
                            .probando-banner-institucional-movil{
                                display: block;
                                height: 100%; 
                                /* background-image: url({{url('assets/plantilla-chiapas-gob/assets/img-temporal/1920x1080/banner-general-turismo-movil.webp')}}); */
                            }
                        }
                    </style>

                    <style>
                        html{
                            overflow-x: hidden;
                        }
                    </style>
    {{-- Termina links de chiapas.gob.mx --}}
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="main_navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('inicio')}}"><img
                    src="{{asset('assets/imgs/sectur/logo_sectur.png')}}" alt="logo-sectur-chiapas"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @foreach ($menus as $key => $item)
                    @if ($item['parent'] != 0)
                    @break
                    @endif
                    @include('shared.navbar', ['item' => $item])
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <div class="contenedor-general">
        <main class="container mt-5 shadow p-3 mb-5 bg-body rounded">
            <div >
                <div class="card border-0">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h2 class="display-5">
                                Error 403
                            </h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="d-flex flex-column">
                                    {{-- <img class="img-thumbnail" src="{{asset('assets/imgs/sectur/logo_sectur.png')}}" alt="Imagen de error" height="70" width="154"> --}}
                                    <h2>Sin autorización</h2>
                                    <p>Lo sentimos, pero la acción que quieres realizar no está autorizada, si necesitas acceder a algún contenido específico del <a href="/" style="text-decoration: none;">Sitio Institucional de la Secretaría de Turismo</a> te pedimos contactarte con el administrador del sitio.</p>
                                    <div class="text-center">
                                        <a href="/" class="btn btn-primary btn-sm w-25">Volver al inicio</a>
                                        @auth
                                            <a href="{{route('dashboard')}}" class="btn btn-secondary btn-sm w-25">Ir al tablero</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    @include('layouts.footer')
    <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function bootnavbar(options) {
            const defaultOption = {
                selector: "main_navbar",
                animation: true,
                animateIn: "animate__fadeIn",
            };

            const bnOptions = {
                ...defaultOption,
                ...options
            };

            init = function () {
                var dropdowns = document
                    .getElementById(bnOptions.selector)
                    .getElementsByClassName("dropdown");

                Array.prototype.forEach.call(dropdowns, (item) => {
                    //add animation
                    if (bnOptions.animation) {
                        const element = item.querySelector(".dropdown-menu");
                        element.classList.add("animate__animated");
                        element.classList.add(bnOptions.animateIn);
                    }

                    //hover effects
                    item.addEventListener("mouseover", function () {
                        this.classList.add("show");
                        const element = this.querySelector(".dropdown-menu");
                        element.classList.add("show");
                    });

                    item.addEventListener("mouseout", function () {
                        this.classList.remove("show");
                        const element = this.querySelector(".dropdown-menu");
                        element.classList.remove("show");
                    });
                });
            };

            init();
        }

    </script>
    <script>
        new bootnavbar();

    </script>

    {{-- Scripts chiapas.gob.mx --}}

        <script src="{{asset('assets/plantilla-chiapas-gob/assets/vendor/jquery/jquery.min.js')}}"></script>
        {{-- <script src="{{asset('assets/plantilla-chiapas-gob/assets/vendor/jquery-migrate/jquery-migrate.min.js')}}"></script> --}}
        {{-- <script src="{{asset('assets/plantilla-chiapas-gob/assets/vendor/popper.js/popper.min.js')}}"></script> --}}
        {{-- <script src="{{asset('assets/plantilla-chiapas-gob/assets/vendor/bootstrap/bootstrap.min.js')}}"></script> --}}

        {{-- <script src="{{asset('assets/plantilla-chiapas-gob/assets/vendor/hs-megamenu/src/hs.megamenu.js')}}"></script> --}}
        <script src="{{asset('assets/plantilla-chiapas-gob/assets/vendor/dzsparallaxer/dzsparallaxer.js')}}"></script>
        {{-- <script src="{{asset('assets/plantilla-chiapas-gob/assets/vendor/dzsparallaxer/dzsscroller/scroller.js')}}"></script> --}}
        {{-- <script src="{{asset('assets/plantilla-chiapas-gob/assets/vendor/dzsparallaxer/advancedscroller/plugin.js')}}"></script> --}}
        {{-- <script src="{{asset('assets/plantilla-chiapas-gob/assets/vendor/fancybox/jquery.fancybox.min.js')}}"></script> --}}
        {{-- <script src="{{asset('assets/plantilla-chiapas-gob/assets/vendor/slick-carousel/slick/slick.js')}}"></script> --}}

        {{-- <script src="{{asset('assets/plantilla-chiapas-gob/assets/js/hs.core.js')}}"></script>
        <script src="{{asset('assets/plantilla-chiapas-gob/assets/vendor/typedjs/typed.min.js')}}"></script>
        <script src="{{asset('assets/plantilla-chiapas-gob/assets/js/components/hs.header.js')}}"></script>
        <script src="{{asset('assets/plantilla-chiapas-gob/assets/js/helpers/hs.hamburgers.js')}}"></script>
        <script src="{{asset('assets/plantilla-chiapas-gob/assets/js/components/hs.dropdown.js')}}"></script>
        <script src="{{asset('assets/plantilla-chiapas-gob/assets/js/components/hs.popup.js')}}"></script>
        <script src="{{asset('assets/plantilla-chiapas-gob/assets/js/components/hs.carousel.js')}}"></script>
        <script src="{{asset('assets/plantilla-chiapas-gob/assets/js/components/hs.go-to.js')}}"></script> --}}

        {{-- <script src="{{asset('assets/plantilla-chiapas-gob/assets/js/custom.js')}}"></script> --}}

        <script>
            $(document).on('ready', function () {

                $.HSCore.components.HSHeader.init($('#js-header'));
                $.HSCore.helpers.HSHamburgers.init('.hamburger');

                $('.js-mega-menu').HSMegaMenu({
                    event: 'hover',
                    pageContainer: $('.container'),
                    breakpoint: 991
                });

                $.HSCore.components.HSDropdown.init($('[data-dropdown-target]'), {
                    afterOpen: function () {
                        $(this).find('input[type="search"]').focus();
                    }
                });

                $.HSCore.components.HSPopup.init('.js-fancybox');

                $.HSCore.components.HSCarousel.init('.js-carousel');

                $.HSCore.components.HSGoTo.init('.js-go-to');
            });
        </script>

        <script>
            //    Ocultar un scroll extra
            // $('html').css('overflow', 'hidden');
        </script>

    {{-- Scripts chiapas.gob.mx --}}
</body>

</html>
