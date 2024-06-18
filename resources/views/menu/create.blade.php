@extends('layouts.general')

@section('title_page', 'Crear menu')

@section('content_page')
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
@error('g-recaptcha-response')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>    
            <span class="text-danger error-text">{{$message}}</span>                
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror
<div class="card shadow p-3 mb-5 bg-body rounded">
    <div class="carrd-header">
        <div class="d-flex justify-content-between">
            <div>
                Completa los siguientes campos
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                    autocomplete="off" required>
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}"
                                    autocomplete="off" readonly required>
                                <span id="error_slug"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="url-interno">URL/Página</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="parent" id="radiobtnURL">
                                    <label class="form-check-label" for="radio-boton">
                                        URL
                                    </label>
                                    <input type="text" class="form-control" id="enlace" name="enlace" autocomplete="off">
                                    <span id="error_url"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pagInt" id="radiobtnPagIn" value="pagInt">
                                    <label class="form-check-label" for="radio-boton">
                                        Pagina Interna
                                    </label>
                                    <select class="form-select" id="selectMenuPaginaInterna" name="pagina_id" value="{{ old('pagina_id') }}">
                                        <option value="0" selected>Selecciona una página</option>
                                        @foreach ($paginas as $pagina)
                                            <option value="{{$pagina->id}}" {{ old('pagina_id') == $pagina->id ? 'selected' : '' }}>{{$pagina->titulo}}</option>
                                        @endforeach
                                    </select>
                                    <span id="error_url"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="rol" class="form-label">Tipo</label>
                                <select class="form-select" id="selectMenu" name="parent">
                                    <option value="0">Seleccionar menú</option>
                                    {{-- @foreach ($menus as $menu)
                                    @if ($menu->parent == 0)
                                    <option value="{{$menu->id}}" {{ old('parent') == $menu->id ? 'selected' : '' }}>
                                        {{$menu->name}}</option>
                                    @else
                                    <option value="{{$menu->id}}" {{ old('parent') == $menu->id ? 'selected' : '' }}>
                                        &nbsp;&nbsp;&nbsp;&nbsp;{{$menu->name}}</option>
                                    @endif
                                    @endforeach --}}
                                    {{-- @foreach ($menus as $key => $item)
                                        @if ($item['parent'] != 0)
                                            @break
                                        @endif
                                        @include('shared.menus.create', ['item' => $item])
                                    @endforeach --}}
                                    @foreach ($menus as $menu)
                                        @if ($menu['parent'] == 0)
                                            <option value="{{ $menu['id'] }}">
                                                {{ $menu['name'] }}
                                            </option>
                                            @foreach ($menu['submenu'] as $item)
                                                <option value="{{ $item['id'] }}">&nbsp;&nbsp;&nbsp;{{$item['name']}}</option>
                                                @foreach ($item['submenu'] as $items)
                                                    <option value="{{ $items['id'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$items['name']}}</option>
                                                @endforeach
                                            @endforeach
                                        @else
                                        
                                        @endif
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="target" class="form-label">Target</label>
                                <select class="form-select" name="target" required>
                                    <option value="" selected>Seleccionar estado</option>
                                    <option {{ old('target') == '_blank' ? 'selected' : '' }} value="_blank">_blank</option>
                                    <option {{ old('target') == '_parent' ? 'selected' : '' }} value="_parent">_parent</option>
                                    <option {{ old('target') == '_self' ? 'selected' : '' }} value="_self">_self</option>
                                    <option {{ old('target') == '_top' ? 'selected' : '' }} value="_top">_top</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Activo</label>
                                <select class="form-select" name="enabled" required>
                                    <option value="" selected>Seleccionar estado</option>
                                    <option {{ old('enabled') == '1' ? 'selected' : '' }} value="1">Si</option>
                                    <option {{ old('enabled') == '0' ? 'selected' : '' }} value="0">No</option>
                                </select>
                                    @error('enabled')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Orden</label>
                                <input type="number" class="form-control w-50" id="order" name="order" value="{{ old('order') }}"
                                    autocomplete="off" required>
                                    @error('order')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button id='btnSubmit' type="submit" class="btn btn-sm btn-primary">Crear</button>
            <a href="{{ route('menus.index') }}" class="btn btn-sm btn-secondary">Volver</a>
        </form>
    </div>
</div>
@endsection

@push('css')

@endpush

@push('js')
<script src="{{asset('assets/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js"
    integrity="sha512-8Y8eGK92dzouwpROIppwr+0kPauu0qqtnzZZNEF8Pat5tuRNJxJXCkbQfJ0HlUG3y1HB3z18CSKmUo7i2zcPpg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {
        
        // Inicio Validación para los radiobutton e inputs/select de que tipo será el menú si URL ó pagina interna
        // $("#radiobtnPagIn").change(function () {	 
        //     console.log('Padre');
        //     $('#enlace').attr('readOnly', true);
        // });

        // $("#radiobtnURL").change(function () {	 
        //     console.log('Hijo');
        //     $('#enlace').attr('readOnly', false);
        // });

        $('#enlace').click(function () {
            $("#radiobtnURL").prop("checked", true);
            $("#radiobtnPagIn").prop("checked", false);
            if(($('#radiobtnURL').is(':checked'))){
                $("#radiobtnURL").prop("checked", true);
                $('#enlace').attr('readOnly', false);
                $('#selectMenuPaginaInterna').val('0');
            }
        });

        $('#selectMenuPaginaInterna').click(function () {
            $("#radiobtnPagIn").prop("checked", true);
            $("#radiobtnURL").prop("checked", false);
            $('#enlace').attr('readOnly', true);
            $('#enlace').val('');
        });

        /* Inicio - Estos son los radiobuttons si se seleccionan */
        $('#radiobtnURL').click(function () {
            $("#radiobtnURL").prop("checked", true);
            $("#radiobtnPagIn").prop("checked", false);
            if(($('#radiobtnURL').is(':checked'))){
                $("#radiobtnURL").prop("checked", true);
                $('#enlace').attr('readOnly', false);
                $('#selectMenuPaginaInterna').val('0');
            }
        });

        $('#radiobtnPagIn').click(function () {
            $("#radiobtnPagIn").prop("checked", true);
            $("#radiobtnURL").prop("checked", false);
            $('#enlace').attr('readOnly', true);
            $('#enlace').val('');
        });
        /* Inicio - Estos son los radiobuttons si se seleccionan */



        // Fin Validación para los radiobutton e inputs/select de que tipo será el menú si URL ó pagina interna


        $('#selectMenu').on('change', function () {
            if (this.value == 0) {
                console.log('no contiene nada');
            } else if (!this.value == '' && !this.value == 0) {
                console.log('contiene algo ' + this.value);
            }
        });

        // Inicio Conversión del nombre del menú a slug con el plugin de Jquery de stringToSlug
        $('#name').stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
        });
        // Fin Conversión del nombre del menú a slug con el plugin de Jquery de stringToSlug


        // Inicio Validación de si existe ó no un slug disponible para el menú
        $('#name').blur(function () {
            
            var error_slug = '';
            var slug = $('#slug').val();
            var _token = $('input[name="_token"]').val();
            var filter = /^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/;
            if ($.trim(slug).length > 0) {
                if (!filter.test(slug)) {
                    $('#error_slug').html(
                        '<label class="badge bg-warning text-dark">Slug Inválido</label>');
                    $('#slug').addClass('has-error');
                    $('#register').attr('disabled', 'disabled');
                } else {
                    $.ajax({
                        url: "{{ route('menu.register-check') }}",
                        method: "POST",
                        data: {
                            slug: slug,
                            _token: _token
                        },
                        success: function (result) {
                            if (result == 'unique') {
                                $('#error_slug').html(
                                    '<label class="badge bg-success text-white">Slug disponible </label>'
                                    );
                                $('#slug').removeClass('has-error');
                                $('#register').attr('disabled', false);
                            } else {
                                $('#error_slug').html(
                                    '<label class="badge bg-danger text-white">Slug no disponible</label>'
                                    );
                                $('#slug').addClass('has-error');
                                $('#register').attr('disabled', 'disabled');
                            }
                        }
                    })
                }
            } else {
                $('#error_slug').html(
                    '<label class="badge bg-info text-dark">Slug Requerido</label>');
                $('#slug').addClass('has-error');
                $('#register').attr('disabled', 'disabled');
            }
        });
        // Fin Validación de si existe ó no un slug disponible para el menú

        // inicio Validación con expresión regular para que no se permita introducir http/https en un enlace
        let regexEnlace = new RegExp("^(http|https)://", "i");
            
        $('#enlace').blur(function () {
            
            let enlace = $('#enlace').val();
            if ($.trim(enlace).length > 0) {
                if (regexEnlace.test(enlace)) {
                    // Si la expresión regular coincide con lo que hay dentro del input enlace agrega un label y desactiva el boton
                    $('#error_url').html('<label class="badge bg-warning text-dark">Elimina el "http://" ó "https://"</label>').show();
                    $('#btnSubmit').addClass('disabled','disabled');
                } else {
                    // Si la expresión regular NO coincide con lo que hay dentro del input enlace quita el label y activa
                    console.log('no coincidió');
                    $('#error_url').html('<label class="badge bg-warning text-dark">Elimina el "http://"" ó "https://"</label>').hide();
                    $('#btnSubmit').removeClass('disabled','disabled');
                }
            } else {
                console.log('está vacío, no pasa nada');
                $('#error_url').html('<label class="badge bg-warning text-dark">Elimina el "http://" ó "https://"</label>').hide();
            }
        });
        // Fin Validación con expresión regular para que no se permita introducir http/https en un enlace

    });

</script>

<script>
    (() => {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush
