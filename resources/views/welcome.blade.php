<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    {{-- Descripcion del website --}}
    <meta name="description" content="Página institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas" />
    {{-- Palabras clave del website --}}
    <meta name="keywords" content="Página institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas" />
    {{-- Autor del website --}}
    <meta name="author" content="Gobierno del Estado de Chiapas">
    {{-- Titulo al comaprtie el enlace  --}}
    <meta property="og:title" content="Secretaría de Turismo">
    {{-- Imagen del website al momento de compartir un enlace ó el enlace general del sitio --}}
    <meta property="og:image" content="{{asset('assets/imgs/sectur/logo_sectur.png')}}">
    {{-- Short name of the website --}}
    <meta property="og:title" content="Secretaría de Turismo del Estado de Chiapas"/>
    {{-- Enlace completo al ompartir el website --}}
    <meta property="og:url" content="https://institucional.visitchiapas.com/" />
    {{-- Descripción que va a tener al compartir el website --}}
    <meta property="og:description" content="Página institucional de la Secretaría de Turismo del Gobierno del Estado de Chiapas">
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
    <link rel="stylesheet" href="{{asset('assets/css/estilos.css')}}">
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

    {{-- Estilos para las cards del carrousel mixto  --}}
    <style>
        .cards-wrapper {
        display: flex;
        justify-content: center;
        }
        .card img {
        max-width: 100%;
        max-height: 100%;
        }
        .card {
        margin: 0 0.5em;
        box-shadow: 2px 6px 8px 0 rgba(22, 22, 26, 0.18);
        border: none;
        border-radius: 0;
        }
        .carousel-inner {
        padding: 1em;
        }
        .btns{
        background-color: #e1e1e1;
        width: 5vh;
        height: 5vh;
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        }
    </style>

    <style>
        .fot{
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px; /* Set the fixed height of the footer here */
            line-height: 60px; /* Vertically center the text there */
        }
        footer {
            position: sticky;
            width: 100%;
        }
    </style>

    <style>
        .lis > a {
            text-decoration: none;
            color: white;
            
        }
        .lis > a:visited {
            text-decoration: none;
            color: white;
            
        }
        .separador{
            width: 600px;
        }
    </style>

    {{-- Link de estilos generales para el sistema--}}
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

                <style>
                    
                    .caja-boton-chiapas-mobile{
                        display: none;
                    }
                    
                    .boton-mobile-chiapas {
                        display: none;
                        color: white;
                    }

                    .contenido-mobile-chiapas{
                        display: none;
                    }

                    .boton-mobile-chiapas:active, .boton-mobile-chiapas:visited, .boton-mobile-chiapas:link{
                        color: white;
                    }

                    .boton-mobile-chiapas:hover{
                        color: rgb(148, 146, 146);
                    }

                    .links-mobile-chiapas > li {
                        text-decoration: none;
                        list-style: none;
                    }

                    #ocultar{
                        display: none;
                    }

                    @media screen and (min-width:770px) and (max-width:990px) {
                        

                        .separador{
                            display: none;
                        }
                        .caja-contenido-desktop{
                            display: none;
                        }

                        .caja-boton-chiapas-mobile{
                            display: block;
                            position: relative;
                            left: 500px;
                        }

                        .boton-mobile-chiapas {
                            display: block;
                        }

                    }

                    @media screen and (min-width:500px) and (max-width:770px) {

                        .boton-mobile-chiapas {
                            display: block;
                        }

                        .caja-boton-chiapas-mobile{
                            display: block;
                            position: relative;
                            left: 300px;
                        }
                    }

                    @media screen and (min-width:400px) and (max-width:500px) {
                        .boton-mobile-chiapas {
                            display: block;
                        }

                        .caja-boton-chiapas-mobile{
                            display: block;
                            position: relative;
                            left: 200px;
                        }
                    }
                    
                    @media screen and (min-width:300px) and (max-width:400px) {
                        .boton-mobile-chiapas {
                            display: block;
                        }

                        .caja-boton-chiapas-mobile{
                            display: block;
                            position: relative;
                            left: 170px;
                        }
                    }

                    @media screen and (min-width:200px) and (max-width:300px) {
                        .boton-mobile-chiapas {
                            display: block;
                        }

                        .caja-boton-chiapas-mobile{
                            display: block;
                            position: relative;
                            left: 50px;
                        }
                    }
                </style>
{{-- Termina links de chiapas.gob.mx --}}
</head>

<body>
    {{-- test 1 chiapas.gob.mx navbar --}}
            {{-- esto si funciona, lo estoy comentando para hacer pruebas --}}
                {{-- <header id="js-header" class="u-header u-header--sticky-top u-header--toggle-section fixed-top" data-header-fix-moment="300">	
                    <div class="u-header__section u-header__section--light  g-transition-0_3 d-flex justify-content-center" data-header-fix-moment-exclude="" data-header-fix-moment-classes="u-shadow-v18 g-py-0" style="background-color: #333">
                        <nav class="navbar navbar-expand-lg g-pa-0 g-pt-4 g-pb-4">
                            <div class="container">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <a href="https://www.chiapas.gob.mx/" class="navbar-brand g-text-underline--hover"><img src="{{asset('assets/plantilla-chiapas-gob/assets/logo/escudo-icono.png')}}" alt="logo-chiapas"></a>
                                        <a href="https://www.chiapas.gob.mx/" class="g-color-white-opacity-0_9 g-font-size-16 g-font-weight-300 g-font-secondary g-text-underline--hover" style="color: rgba(255, 255, 255, 0.9) !important; text-decoration: none;">chiapas<span class="g-color-white-opacity-0_6" style="color: rgba(255, 255, 255, 0.6) !important">.gob.mx</span></a>
                                    </div>
                                    <div class="separador">

                                    </div>
                                    <div class="">
                                        <div class="collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg" id="navBar">
                                            <ul class="navbar-nav ml-auto g-font-size-16 g-font-weight-100">
                                                <li class="nav-item g-mx-10--lg lis"><a href="https://www.chiapas.gob.mx/tramites" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Trámites</a></li>
                                                <li class="nav-item g-mx-10--lg lis"><a href="https://www.chiapas.gob.mx/gobierno" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Gobierno</a></li>
                                                <li class="nav-item g-mx-10--lg lis"><a href="https://www.chiapas.gob.mx/participa" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Participa</a></li>
                                                <li class="nav-item g-mx-10--lg lis"><a href="http://gubernatura.transparencia.chiapas.gob.mx/" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Transparencia</a></li>
                                                <li class="nav-item g-mx-10--lg lis"><a href="https://www.chiapas.gob.mx/busquedas" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                </svg></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </header> --}}
                <header id="js-header" class="u-header u-header--sticky-top u-header--toggle-section fixed-top" data-header-fix-moment="300">	
                    <div class="u-header__section u-header__section--light  g-transition-0_3 " data-header-fix-moment-exclude="" data-header-fix-moment-classes="u-shadow-v18 g-py-0" style="background-color: #333">
                        <nav class="navbar navbar-expand-lg g-pa-0 g-pt-4 g-pb-4">
                            <div class="container">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <a href="https://www.chiapas.gob.mx/" class="navbar-brand g-text-underline--hover"><img src="{{asset('assets/plantilla-chiapas-gob/assets/logo/escudo-icono.png')}}" alt="logo-chiapas"></a>
                                        <a href="https://www.chiapas.gob.mx/" class="g-color-white-opacity-0_9 g-font-size-16 g-font-weight-300 g-font-secondary g-text-underline--hover" style="color: rgba(255, 255, 255, 0.9) !important; text-decoration: none;">chiapas<span class="g-color-white-opacity-0_6" style="color: rgba(255, 255, 255, 0.6) !important">.gob.mx</span></a>
                                    </div>
                                    <div class="separador">

                                    </div>
                                    <div class="caja-contenido-desktop">
                                        <div class="collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg" id="navBar">
                                            <ul class="navbar-nav ml-auto g-font-size-16 g-font-weight-100">
                                                <li class="nav-item g-mx-10--lg lis"><a href="https://www.chiapas.gob.mx/tramites" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Trámites</a></li>
                                                <li class="nav-item g-mx-10--lg lis"><a href="https://www.chiapas.gob.mx/gobierno" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Gobierno</a></li>
                                                <li class="nav-item g-mx-10--lg lis"><a href="https://www.chiapas.gob.mx/participa" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Participa</a></li>
                                                <li class="nav-item g-mx-10--lg lis"><a href="http://gubernatura.transparencia.chiapas.gob.mx/" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Transparencia</a></li>
                                                <li class="nav-item g-mx-10--lg lis"><a href="https://www.chiapas.gob.mx/busquedas" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                </svg></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="caja-boton-chiapas-mobile">
                                        <a href="javascript:void(0);" class="boton-mobile-chiapas">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="contenido-mobile-chiapas">
                                <ul class="links-mobile-chiapas">
                                    <li class="links-chiapas-gob-mx"><a href="https://www.chiapas.gob.mx/tramites" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Trámites</a></li>
                                    <li class="links-chiapas-gob-mx"><a href="https://www.chiapas.gob.mx/gobierno" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Gobierno</a></li>
                                    <li class="links-chiapas-gob-mx"><a href="https://www.chiapas.gob.mx/participa" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Participa</a></li>
                                    <li class="links-chiapas-gob-mx"><a href="http://gubernatura.transparencia.chiapas.gob.mx/" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">Transparencia</a></li>
                                    <li class="links-chiapas-gob-mx"><a href="https://www.chiapas.gob.mx/busquedas" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg></a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </header>
            {{-- esto si funciona, lo estoy comentando para hacer pruebas --}}
        
            <!-- Banner institucion -->
            {{-- <section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll dzsprx-readyall"
                data-options='{direction: "normal", settings_mode_oneelement_max_offset: "150"}' style="height: 390px">
                    <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-img-hero g-bg-bluegray-opacity-0_1--after probando-banner-institucional-normal"
                    style=""></div>
                    <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-img-hero g-bg-bluegray-opacity-0_1--after probando-banner-institucional-movil"
                    style=""></div>
            </section> --}}
            @foreach ($seccionPrincipal as $seccion)
                <h4>{{$seccion->titulo}}</h4>
                @switch($seccion->tipo)
                    @case('simple')
                            <section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll dzsprx-readyall"
                                data-options='{direction: "normal", settings_mode_oneelement_max_offset: "150"}' style="height: 390px">
                                    <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-img-hero g-bg-bluegray-opacity-0_1--after probando-banner-institucional-normal"
                                    style="background-image: url({{asset('storage').'/'.$seccion->imagen}});"></div>
                                    <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-img-hero g-bg-bluegray-opacity-0_1--after probando-banner-institucional-movil"
                                    style="background-image: url({{asset('storage').'/'.$seccion->imagen_telefono}});"></div>
                            </section>
                        @break
                    @case('slider')
                            {{-- Para pantallas grandes --}}
                            <div class="row justify-content-md-center contenedor-simple">
                                <div id="carouselExampleIndicators-banner_principal-{{$seccion->id}}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner" style="padding-top: 33px;">
                                        @forelse ($seccion->subsecciones as $item)
                                        <div class="carousel-item @if($loop->index==0) active @endif">
                                            <a href="{{ $item->enlace }}" target="_blank">
                                                <img src="{{asset('storage').'/'.$item->imagen}}" alt="imagen"
                                                    class="img-fluid rounded mx-auto d-block">
                                            </a>
                                        </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators-banner_principal-{{$seccion->id}}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators-banner_principal-{{$seccion->id}}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            {{-- Para pantallas pequeñas --}}
                            <div class="row justify-content-md-center contenedor-simple-telefono">
                                <div id="carouselExampleIndicators-banner_principal-telefono-{{$seccion->id}}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner" style="padding-top: 33px;">
                                        @forelse ($seccion->subsecciones as $item)
                                        <div class="carousel-item @if($loop->index==0) active @endif">
                                            <a href="{{ $item->enlace }}" target="_blank">
                                                <img src="{{asset('storage').'/'.$item->imagen_telefono}}" alt="imagen"
                                                    class="img-fluid rounded mx-auto d-block">
                                            </a>
                                        </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators-banner_principal-telefono-{{$seccion->id}}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators-banner_principal-telefono-{{$seccion->id}}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        @break
                    @default
                            <div class="alert alert-danger">
                                <a href="#">
                                    Esta opción no es válida
                                </a>
                            </div> 
                    @endswitch
            @endforeach
            <!-- Banner Institucion -->
    {{-- test 2 --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="main_navbar">
        <div class="container-fluid caja">
            <a class="navbar-brand caja1" href="{{route('inicio')}}" style="color:#621733; font-weight: 600;">{{-- <img
                src="{{asset('assets/imgs/sectur/logo_sectur.png')}}" alt="logo-sectur-chiapas"> --}}Secretaría de Turismo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse caja2" id="navbarSupportedContent">
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

    {{-- Estilos para el menu de navegación nuevo acorde a la supervisión de chiapas.gob.mx --}}
    <style>
        /* @media screen and (min-width:1350px) and (max-width:1500px) { */
            .caja{
                /* position: relative; */
            }
            
            .caja1{
                position: relative;
                left: 250px; 
            }
            
            .caja2{
                position: relative;
                left: 600px; 
            }
        /* } */

        @media screen and (min-width:1300px) and (max-width:1500px) {

            .caja1{
                left: 150px; 
            }

            .caja2{
                left:400px;
            }
            
        }
        @media screen and (min-width:1200px) and (max-width:1300px) {
            .caja1{
                left: 100px; 
            }

            .caja2{
                left: 350px;
            }
        }
        
        @media screen and (min-width:1100px) and (max-width:1200px) {
            .caja1{
                left: 130px; 
            }

            .caja2{
                left: 300px;
            }
        }
        @media screen and (min-width:1000px) and (max-width:1100px) {
            .caja1{
                left: 100px; 
            }

            .caja2{
                left: 200px;
            }
        }
        @media screen and (min-width:200px) and (max-width:999px) {
            .caja1{
                left: 0; 
            }

            .caja2{
                left: 0;
            }
        }

    </style>

    <main class="contenedor-general">
        <div class="container mt-5">
            {{-- <div class="alert alert-info">
                <a href="#">
                    How to use bootNavbar
                </a>
            </div> --}}
            {{-- En este foreach se hace toda la lógica para mostrar todas las secciones de la página --}}
            @foreach ($secciones as $seccion)
                <div class="bd-callout border-0" style="border-left-color: {{$seccion->color}}">
                    <h4>{{$seccion->titulo}}</h4>
                    @switch($seccion->tipo)
                        @case('simple')
                                <div class="contenedor-simple">
                                    <div class="d-flex justify-content-center">
                                        @if (is_null($seccion->imagen))
                                        @else
                                        <a href="{{$seccion->enlace}}" target="_blank">
                                            <img src="{{asset('storage').'/'.$seccion->imagen}}" alt="imagen"
                                            class="img-fluid rounded mx-auto d-block">
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="contenedor-simple-telefono">
                                    <div class="d-flex">
                                        @if (is_null($seccion->imagen_telefono))
                                        @else
                                        <a href="{{$seccion->enlace}}" target="_blank">
                                            <img src="{{asset('storage').'/'.$seccion->imagen_telefono}}" alt="imagen"
                                            class="img-fluid rounded mx-auto d-block">
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            @break
                        @case('slider')
                                {{-- Para pantallas grandes --}}
                                <div class="row justify-content-md-center contenedor-simple">
                                    <div id="carouselExampleIndicators-{{$seccion->id}}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @forelse ($seccion->subsecciones as $item)
                                            <div class="carousel-item @if($loop->index==0) active @endif">
                                                <a href="{{ $item->enlace }}" target="_blank">
                                                    <img src="{{asset('storage').'/'.$item->imagen}}" alt="imagen"
                                                        class="img-fluid rounded mx-auto d-block">
                                                </a>
                                            </div>
                                            @empty
                                            @endforelse
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleIndicators-{{$seccion->id}}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleIndicators-{{$seccion->id}}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                {{-- Para pantallas pequeñas --}}
                                <div class="row justify-content-md-center contenedor-simple-telefono">
                                    <div id="carouselExampleIndicators-telefono-{{$seccion->id}}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @forelse ($seccion->subsecciones as $item)
                                            <div class="carousel-item @if($loop->index==0) active @endif">
                                                <a href="{{ $item->enlace }}" target="_blank">
                                                    <img src="{{asset('storage').'/'.$item->imagen_telefono}}" alt="imagen"
                                                        class="img-fluid rounded mx-auto d-block">
                                                </a>
                                            </div>
                                            @empty
                                            @endforelse
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleIndicators-telefono-{{$seccion->id}}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleIndicators-telefono-{{$seccion->id}}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            @break
                        @case('card')
                                <div class="container mt-3 pt-3 bg-light contenedor-simple">
                                    <div class="row g-3 pb-3 d-flex justify-content-center">
                                        @foreach ($seccion->subsecciones as $item)
                                        <div class="col-6 col-lg-3 tarjetas-inicio">
                                            <div class="text-center px-5 h-100 bg-white shadow rounded">
                                                <div class="py-2">
                                                    <strong>{{$item->titulo}}</strong>
                                                </div>
                                                <div class="d-flex justify-content-center custom-icon mx-auto rounded-circle">
                                                    <a href="{{ $item->enlace }}" target="_blank">
                                                        <img src="{{asset('storage').'/'.$item->imagen}}" alt="imagen"
                                                            class="img-fluid rounded mx-auto d-block">
                                                    </a>
                                                </div>
                                                <div class="pb-3">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <div class="row justify-content-md-center contenedor-simple">
                                    <div id="carouselExampleIndicators-cards" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @forelse ($seccion->subsecciones as $item)
                                                <div class="carousel-item @if($loop->index==0) active @endif">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ $item->enlace }}" target="_blank">
                                                            <img src="{{asset('storage').'/'.$item->imagen}}" alt="imagen"
                                                                class="img-fluid rounded mx-auto d-block">
                                                        </a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <h5>
                                                            {{$item->titulo}}
                                                        </h5>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleIndicators-cards" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleIndicators-cards" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div> --}}
                                <div class="row justify-content-md-center contenedor-simple-telefono">
                                    <div id="carouselExampleIndicators-seccion-cards-{{$seccion->id}}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @forelse ($seccion->subsecciones as $item)
                                                <div class="carousel-item @if($loop->index==0) active @endif">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ $item->enlace }}" target="_blank">
                                                            <img src="{{asset('storage').'/'.$item->imagen}}" alt="imagen"
                                                                class="img-fluid rounded mx-auto d-block">
                                                        </a>
                                                        {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <h5>
                                                            {{$item->titulo}}
                                                        </h5> --}}
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                        <button class="carousel-control-prev btns" type="button"
                                            data-bs-target="#carouselExampleIndicators-seccion-cards-{{$seccion->id}}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next btns" type="button"
                                            data-bs-target="#carouselExampleIndicators-seccion-cards-{{$seccion->id}}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            @break
                        @case('mixto')
                                {{-- Contenido de la sección  mixta --}}
                                <div class="contenedor-simple">
                                    <div class="d-flex justify-content-center">
                                        @if (is_null($seccion->imagen))
                                        @else
                                        <a href="{{$seccion->enlace}}" target="_blank">
                                            <img src="{{asset('storage').'/'.$seccion->imagen}}" alt="imagen"
                                            class="img-fluid rounded mx-auto d-block">
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="contenedor-simple-telefono">
                                    <div class="d-flex">
                                        @if (is_null($seccion->imagen_telefono))
                                        @else
                                        <a href="{{$seccion->enlace}}" target="_blank">
                                            <img src="{{asset('storage').'/'.$seccion->imagen_telefono}}" alt="imagen"
                                            class="img-fluid rounded mx-auto d-block">
                                        </a>
                                        @endif
                                    </div>
                                </div>

                                {{-- Inicia el contenido de la subsección mixta --}}
                                    <div class="container mt-3 pt-3 bg-light contenedor-simple">
                                        <div class="row g-3 pb-3 d-flex justify-content-center">
                                            @foreach ($seccion->subsecciones as $item)
                                            <div class="col-6 col-lg-2 tarjetas-inicio">
                                                <div class="text-center px-5 h-100 bg-white shadow rounded">
                                                    <div class="py-2">
                                                        <strong>{{$item->titulo}}</strong>
                                                    </div>
                                                    <div class="d-flex justify-content-center custom-icon mx-auto rounded-circle">
                                                        <a href="{{ $item->enlace }}" target="_blank">
                                                            <img src="{{asset('storage').'/'.$item->imagen}}" alt="imagen"
                                                                class="img-fluid rounded mx-auto d-block">
                                                        </a>
                                                    </div>
                                                    <div class="pb-3">
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <div class="row justify-content-md-center contenedor-simple-telefono">
                                        <div id="carouselExampleIndicators-cards" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @forelse ($seccion->subsecciones as $item)
                                                    <div class="carousel-item @if($loop->index==0) active @endif">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a href="{{ $item->enlace }}" target="_blank">
                                                                <img src="{{asset('storage').'/'.$item->imagen}}" alt="imagen"
                                                                    class="img-fluid rounded mx-auto d-block">
                                                            </a>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <h5>
                                                                {{$item->titulo}}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                            <button class="carousel-control-prev btns" type="button"
                                                data-bs-target="#carouselExampleIndicators-cards" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next btns" type="button"
                                                data-bs-target="#carouselExampleIndicators-cards" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                {{-- Termina el contenido de la subsección mixta --}}
                            @break
                        @case('mapa')
                                <div class="text-center">
                                    {!!$seccion->mapa!!}
                                </div>
                        @break
                        @default
                            <div class="alert alert-danger">
                                <a href="#">
                                    Esta opción no es válida
                                </a>
                            </div> 
                    @endswitch
                </div>
            @endforeach
        </div>
        {{-- <div class="container mt-5">
            <h3 class="display-6">Ubicación</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.442215140926!2d-93.08337298558745!3d16.754660525155153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1141cfc8565cf697%3A0xd55baf4cb4d656ed!2sSecretar%C3%ADa%20de%20Turismo%20del%20Gobierno%20de%20Chiapas!5e0!3m2!1ses!2smx!4v1662564573468!5m2!1ses!2smx" style="width: 100%;" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div> --}}
        <br>
        @include('layouts.footer')
        {{-- Testing footer chiapas.gob.mx --}}
        {{--      <footer class="g-bg-black-opacity-0_9 g-color-white-opacity-0_8 g-py-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 text-center text-md-left g-mb-15 g-mb-0--md">
                            <div class="d-lg-flex">
                                <small class="d-block g-font-size-default g-mr-10 g-mb-10 g-mb-0--md">Gobierno del Estado de Chiapas</small>
                            </div>
                        </div>
            
                        <div class="col-md-4 align-self-center">
                            <ul class="list-inline text-center text-md-right mb-0">
                                <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook"><a href="#!" class="g-color-white-opacity-0_5 g-color-white--hover"><i class="fa fa-facebook"></i></a></li>							
                                <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter"><a href="#!" class="g-color-white-opacity-0_5 g-color-white--hover"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="" data-original-title="Dribbble"><a href="#!" class="g-color-white-opacity-0_5 g-color-white--hover"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer> --}}
        {{-- Testing footer chiapas.gob.mx --}}
    </main>

        
    <script src="{{asset('assets/assets-bootstrap/bootstrap@5.1.3/bootstrap.bundle.min.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
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
    {{-- Script para poder bloquear el clic derecho y los atajos de teclado --}}
    {{-- <script>
        const app = document.getElementById('app');

        window.onload = function() {
        document.addEventListener("contextmenu", function(e){
            e.preventDefault();
        }, false);
        } 

        document.onkeydown = function(){return false;}
    </script> --}}

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

        {{-- Este script es para ver/ocultar el menu mobile de chiapas.gob.mx --}}
        <script>
            $(document).ready(function(){
                $(".caja-boton-chiapas-mobile").click(function(){
                    $(".contenido-mobile-chiapas").toggle();
                });
            });
        </script>

        {{-- Este script es para ver/ocultar el menu mobile de chiapas.gob.mx --}}
        <script>
            $(window).on('resize', function(){
                var win = $(this); //this = window
                if (win.width() <= 990 ) { 
                    if($('.contenido-mobile-chiapas').is(':visible')){
                        $(".contenido-mobile-chiapas").toggle();
                    } else if( $('.contenido-mobile-chiapas').is(':hidden') ){

                    }
                }
            });
        </script>
    {{-- Scripts chiapas.gob.mx --}}
        
</body>

</html>
