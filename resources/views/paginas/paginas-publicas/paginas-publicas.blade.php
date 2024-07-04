@extends('layouts.pagina.pagina-plantilla')

@section('title_page')
{{-- @foreach ($pagina as $page) --}}
{{$pagina->titulo}}
{{-- @endforeach --}}
@endsection

@section('menu-lateral')
<div class="card">
        @if ($sinMenuId == 1)
            <div class="card-header">
                {{$menuNombreSinMenuId}}
            </div>
            <div class="card-body">
                    <ul>
                        @forelse ($menusSinMenuId as $menu)
                            {{-- <li id="{{$menu->pagina_id}}">{{$menu->name}}</li> --}}
                            <li id="{{$menu->pagina_id}}">
                                <a style="text-decoration: none;" @if($menu->enlace) href="https://{{ $menu->enlace }}" @elseif($menu->nombre_pagina) href="{{ route('pagina', $menu->nombre_pagina) }}" @else href="#" @endif target="{{$menu->target}}">{{$menu->name}}</a>
                            </li>
                        @empty

                        @endforelse
                    </ul>
            </div>
        @else
        @endif
        @if ($conMenuId == 1)
            <div class="card-header">
                {{$menuNombre->name}}
            </div>
            <div class="card-body">
                    <ul>
                        @forelse ($menus as $menu)
                            {{-- <li id="{{$menu->pagina_id}}">{{$menu->name}}</li> --}}
                            <li id="{{$menu->pagina_id}}">
                                <a style="text-decoration: none;" @if($menu->enlace) href="https://{{ $menu->enlace }}" @elseif($menu->nombre_pagina) href="{{ route('pagina', $menu->nombre_pagina) }}" @else href="#" @endif target="{{$menu->target}}">{{$menu->name}}</a>
                            </li>
                                <ul>
                                    @foreach ($menu->children_menus as $children_menu)
                                        @include('menu.children-menus', ['children_menu' => $children_menu])
                                    @endforeach
                                </ul>
                        @empty

                        @endforelse
                    </ul>
            </div>
        @else
        @endif
</div>
<br>
@endsection

@section('contenido')
<div class="card" style="border:none;">
    {{-- Contenido de la página --}}
    @if ($pagina->activo === 0)
        @include('paginas.pagina-inactiva')
    @else
            {{-- Información de la página --}}
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 class="display-6">{{$pagina->titulo}}</h1>
                        <input type="hidden" name="paginaId" id="paginaId" value="{{$pagina->id}}">
                    </div>
                    <div class="pt-3 d-flex">
                        <div>
                            <input type="text" id="buscador" class="form-control" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    @if($pagina->imagen_destacada)
                        <img src="{{ asset('storage/' . $pagina->imagen_destacada) }}" alt="{{ $pagina->titulo }}" class="img-fluid">
                    @endif
                    <p class="mt-3">{!! $pagina->contenido !!}</p>
                </div>
            </div>
                
            <!-- Archivos de la página -->
            @if(!($pagina->archivos->isEmpty()))
                @foreach($pagina->archivos as $archivo)
                    <p>
                        <a class="enlace-titulo" href="{{asset('storage').'/'.$archivo->path}}" title="Descargar"
                            download="{{trim(preg_replace('/[.\(\);]/', ' ', $archivo->nombre))}}" target="_blank">{{$archivo->nombre}}</a>
                        &nbsp;-&nbsp;
                        <a class="enlace" style="rgb(166, 75, 10);" href="{{asset('storage').'/'.$archivo->path}}"
                            title="Descargar" download="{{trim(preg_replace('/[.\(\);]/', ' ', $archivo->nombre))}}"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg>
                        </a>
                    </p>
                    <div>
                        <div class="d-flex">
                            <small class="text-black-50">Tamaño: {{$archivo->tamaño}}</small>&nbsp;&nbsp;&nbsp;&nbsp;
                            <small class="text-black-50">Formato: {{$archivo->tipo}}</small>
                        </div>
                    </div>
                    <hr>
                @endforeach
            @endif

            <!-- Enlaces de la página -->
            @if(!($pagina->enlaces->isEmpty()))
                @foreach($pagina->enlaces as $enlace)
                    <p>
                        <a class="enlace-titulo" href="{{ $enlace->url }}" title="Visitar {{$enlace->nombre}}" target="_blank">{{$enlace->nombre}}</a>
                        &nbsp;-&nbsp;
                        <a class="enlace" style="rgb(166, 75, 10);" href="{{ $enlace->url }}" title="Visitar {{$enlace->nombre}}" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5"/>
                                <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z"/>
                            </svg>
                        </a>
                    </p>
                    <hr>
                @endforeach
            @endif

            <!-- Secciones de la página -->
            @if($pagina->secciones->isEmpty())
                <p class="h6">No se encuentran secciones en esta página</p>
            @else
                @foreach($pagina->secciones as $seccion)
                    <div class="mb-4">
                        <div class="accordion accordion-flush" id="accordionFlush-{{$seccion->slug}}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne-{{$seccion->slug}}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-{{$seccion->slug}}" aria-expanded="false" aria-controls="flush-collapseOne-{{$seccion->slug}}">
                                    {{$seccion->titulo}}
                                </button>
                                </h2>
                                <div id="flush-collapseOne-{{$seccion->slug}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne-{{$seccion->slug}}" data-bs-parent="#accordionFlush-{{$seccion->id}}">
                                    <div class="accordion-body"> 
                                        <!-- Archivos de la sección -->
                                        @if($seccion->archivos->isEmpty())
                                            {{-- <p>No existen archivos que mostrar</p> --}}
                                        @else
                                            @foreach($seccion->archivos as $archivo)
                                                <div class="d-flex flex-column">
                                                    <p> •
                                                        <a class="enlace-titulo" href="{{asset('storage').'/'.$archivo->path}}" title="Descargar"
                                                            download="{{trim(preg_replace('/[.\(\);]/', ' ', $archivo->nombre))}}" target="_blank">{{$archivo->nombre}}</a>
                                                        &nbsp;-&nbsp;
                                                        <a class="enlace" style="rgb(166, 75, 10);" href="{{asset('storage').'/'.$archivo->path}}"
                                                            title="Descargar" download="{{trim(preg_replace('/[.\(\);]/', ' ', $archivo->nombre))}}"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                                <path
                                                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                            </svg>
                                                        </a>
                                                    </p>
                                                    <div>
                                                        <div class="d-flex ps-2">
                                                            <small class="text-black-50">Tamaño: {{$archivo->tamaño}}</small>&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <small class="text-black-50">Formato: {{$archivo->tipo}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        @endif

                                        <!-- Enlaces de la sección -->
                                        @if($seccion->enlaces->isEmpty())
                                            {{-- <p>No existen enlaces que mostrar</p> --}}
                                        @else
                                            @foreach($seccion->enlaces as $enlace)
                                                <div class="d-flex flex-column">
                                                    <p> •
                                                        <a class="enlace-titulo"  href="{{ $enlace->url }}" {{-- href="{{asset('storage').'/'.}}" --}} title="Redirigir"
                                                            target="_blank">{{$enlace->nombre}}</a>
                                                        &nbsp;-&nbsp;
                                                        <a class="enlace" style="rgb(166, 75, 10);" href="{{asset('storage').'/'.$enlace->url}}"
                                                            title="Redirigir" download="{{$enlace->nombre}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5"/>
                                                                <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z"/>
                                                            </svg>
                                                        </a>
                                                    </p>
                                                </div>
                                                <hr>
                                            @endforeach
                                        @endif

                                        <!-- Subsecciones de la sección -->
                                        @if($seccion->subsecciones->isEmpty())
                                            {{-- <p>No existen subsecciones en esta sección</p> --}}
                                        @else
                                            @foreach($seccion->subsecciones as $subseccion)
                                                <div class="accordion accordion-flush" id="accordionFlush-{{$seccion->slug}}-{{$subseccion->slug}}">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingOne-{{$seccion->slug}}-{{$subseccion->slug}}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-{{$seccion->slug}}-{{$subseccion->slug}}" aria-expanded="false" aria-controls="flush-collapseOne-{{$seccion->slug}}-{{$subseccion->slug}}">
                                                            {{$subseccion->titulo}}
                                                        </button>
                                                        </h2>
                                                        <div id="flush-collapseOne-{{$seccion->slug}}-{{$subseccion->slug}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne-{{$seccion->slug}}-{{$subseccion->slug}}" data-bs-parent="#accordionFlush-{{$subseccion->id}}">
                                                            <div class="accordion-body">
                                                                <!-- Archivos de la subsección -->
                                                                @foreach($subseccion->archivos as $archivo)
                                                                    <div class="d-flex flex-column">
                                                                        <p> •
                                                                            <a class="enlace-titulo" href="{{asset('storage').'/'.$archivo->path}}" title="Descargar"
                                                                                download="{{trim(preg_replace('/[.\(\);]/', ' ', $archivo->nombre))}}" target="_blank">{{$archivo->nombre}}</a>
                                                                            &nbsp;-&nbsp;
                                                                            <a class="enlace" style="rgb(166, 75, 10);" href="{{asset('storage').'/'.$archivo->path}}"
                                                                                title="Descargar" download="{{trim(preg_replace('/[.\(\);]/', ' ', $archivo->nombre))}}"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                                    height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                                    <path
                                                                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                                                    <path
                                                                                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                                                </svg>
                                                                            </a>
                                                                        </p>
                                                                        <div>
                                                                            <div class="d-flex ps-2">
                                                                                <small class="text-black-50">Tamaño: {{$archivo->tamaño}}</small>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <small class="text-black-50">Formato: {{$archivo->tipo}}</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                @endforeach

                                                                <!-- Enlaces de la subsección -->
                                                                @foreach($subseccion->enlaces as $enlace)
                                                                    <div class="d-flex flex-column">
                                                                        <p> •
                                                                            <a class="enlace-titulo"  href="{{ $enlace->url }}" title="Redirigir"
                                                                                target="_blank">{{$enlace->nombre}}</a>
                                                                            &nbsp;-&nbsp;
                                                                            <a class="enlace" style="rgb(166, 75, 10);" href="{{ $enlace->url }}"
                                                                                title="Redirigir" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                                                                    <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5"/>
                                                                                    <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z"/>
                                                                                </svg>
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <br>
            <table class="table">
                <tr>
                    <th class="table-active">Fuente</th>
                    <td>{{$pagina->fuente}}</td>
                </tr>
                <tr>
                    <th class="table-active">Actualización</th>
                    <td>{{$pagina->fecha_actualizacion->isoFormat('LL')}}</td>
                </tr>
            </table>
    @endif
</div>
@endsection

@push('css')
<style>
    /* 
    Para hacer que las imagenes sean responsivas en el ckeditor porque se desbordan 
    */
    .contenedor>figure {
        text-align: center;
    }

    figure>img {
        max-width: 100%;
        height: auto !important;
    }

    /*
    Esto de abajo es lara los colores de los enlaces de los archivos
    */

    .enlace {
        color: #7c653d;
    }

    .enlace:hover {

        color: #FA9F01;
    }

    .info-archivo {
        color:
    }

    .enlace-titulo {
        color: #575654;
        text-decoration: none;
    }

    .enlace-titulo:hover {
        color: #000000;
    }

    /* icono del buscador */
    #iconoBuscador {
        cursor: pointer;
    }

</style>

<style>

    .bulletss{
        color: rgba(110, 110, 110, 0.932);
        font-size: 1em;
    }

</style>
@endpush

@push('js')

<script>
    // Se declaran variables en el scope global
    let iconoBuscador = $('#iconoBuscador');
    let buscador = $('#buscador');
    let paginaId = $('#paginaId').val();
    let _token =  $('meta[name="csrf-token"]').attr('content');

    // Esta funcion sirve para que al dar clic en el icono de la lupa para que salga el input del buscador
    // $(iconoBuscador).click(function() {
    //     // Este evento slideToggle permite hacer un cambio de estado (si es visible ó no) al input del buscador
    //     $(buscador).slideToggle('slow', function() {
    //         // Si el input está visible entra a la condición y con el evento keyup va evaluar el estado del valor del input
    //         // Donde si el valor es igual que 0 (el input está vacío) pues va a mostrar el contenedor original de los archivos
    //         // Caso contrario que no sea así (el input contiene algo) pues va a desaparecer el contenedor original de los archivos
    //         // Al igual que va a mostrar un nuevo contenedor con las coincidencias encontradas de la petición AJAX al servidor
    //         if($(buscador).is(':visible')){
    //             $(buscador).keyup(function(){
    //                 if($(this).val().length == 0){
    //                     // Si el valor del input es 0, o sea está vacío, se debe de mostrar el contenido de la página actual
    //                     // Y debe de desaparecer el resultado de la busqueda
    //                     $('#contenidoArchivos').css('display', 'block');
    //                     $('#contenidoArchivoBuscador').css('display','none');
    //                 }
    //                 else if($(this).val().length >= 0) {
    //                     // Si el valor del input buscador es mayor a 0
    //                     // Va a obtener el valor del input, después va a ocultar el contenido de archivos de la página
    //                     // Después va a mostrar el contenedor de archivos de busqueda asincrona
    //                     // Y por último va a realizar la petición ajax
    //                     let titulo = $('#buscador').val();
    //                     $('#contenidoArchivos').css('display', 'none');
    //                     $('#contenidoArchivoBuscador').css('display', 'block');
    //                     // Aquí va la lógica de AJAX para mandar a hacer la petición al servidor 
    //                     // Por medio del titulo y del id del archivo se hace la petición
    //                     $.ajax({
    //                         url: "",
    //                         type: 'GET',
    //                         data: {
    //                             titulo: titulo,
    //                             id:paginaId,
    //                         },
    //                         success: function(response){
    //                             $('#resultado').html(response.respuesta);
    //                             $('#contador').html(response.contador);
    //                         }
    //                     })
    //                 }
    //             });
    //         }
    //         // Esta condición es para que cuando se de clic al icono del buscador se contraiga el contenedor del buscador con lso resultados
    //         // obtenidos, al igual que muestra el contenedor original de los archivos de la página
    //         if($(buscador).is(':hidden')){
    //             $('#contenidoArchivoBuscador').css('display','none');
    //             $('#contenidoArchivos').show();
    //         }
    //     });
    // });
</script>

<script>
    // Obtener la URL completa
let urlCompleta = window.location.href;

// Obtener el parámetro de la URL después del dominio
let parametroURL = urlCompleta.substring(urlCompleta.lastIndexOf('/') + 1);

console.log(parametroURL);
</script>

@endpush
