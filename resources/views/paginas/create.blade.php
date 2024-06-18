@extends('layouts.general')

@section('title_page', 'Crear página')

@section('content_page')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('error'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
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
    <div class="container">
        {{-- <form action="{{ route('paginas.store') }}" method="POST" enctype="multipart/form-data" id="myform">
            @csrf
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" autocomplete="off" value="{{ old('titulo') }}">
                @error('titulo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" readonly value="{{ old('slug') }}">
                @error('slug')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido</label>
                <textarea class="form-control" name="contenido" id="contenido" cols="30" rows="10">{{ old('titulo') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="imagen-principal" class="form-label">Imagen principal</label>
                <select class="form-select" name="imagen_principal_estado" id="imagen_principal_estado" aria-label="Default select example">
                    <option value="No" selected>Selecciona el estado de la imagen </option>
                    <option {{ old('imagen_principal_estado') == 'Si' ? 'selected' : '' }} value="Si">Si</option>
                    <option {{ old('imagen_principal_estado') == 'No' ? 'selected' : '' }} value="No">No</option>
                </select>
                @error('imagen_principal_estado')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input class="form-control" id="imagen_destacada" placeholder="" type="file" name="imagen_destacada" disabled="disabled">
                <small><strong>Dimensión recomendable: 700x393</strong></small>
                <br>
                @error('imagen_destacada')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tipo_pagina" class="form-label">Tipo de página</label>
                <select class="form-control" name="tipo_pagina" >
                    <option value="" selected>Selecciona el estado</option>
                    <option {{ old('tipo_pagina') == 'pagina' ? 'selected' : '' }} value="pagina">Página</option>
                    <option {{ old('tipo_pagina') == 'blog' ? 'selected' : '' }} value="blog">Blog</option>
                    <option {{ old('tipo_pagina') == 'galeria' ? 'selected' : '' }} value="galeria">Galería</option>
                </select>
                @error('tipo_pagina')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" name="estado" >
                    <option value="" selected>Selecciona el estado</option>
                    <option {{ old('estado') == 'Si' ? 'selected' : '' }} value="Si">Si</option>
                    <option {{ old('estado') == 'No' ? 'selected' : '' }} value="No">No</option>
                </select>
                @error('estado')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Crear página</button>
            <a href="{{route('paginas.index')}}" class="btn btn-light">Regresar</a>
        </form> --}}
        {!! Form::open(['route' => 'paginas.store', 'autocomplete' => 'off', 'files' => true]) !!}
        <div class="mb-3">
            {!! Form::label('titulo', 'Titulo') !!}
            {!! Form::text('titulo', null, ['class' => 'form-control' ]) !!}
            @error('titulo')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            {!! Form::label('slug', 'Slug') !!}
            {!! Form::text('slug', null, ['class' => 'form-control', 'readonly' => 'true' ]) !!}
            @error('slug')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <p class="font-weight-bold">Imagen principal</p>
            <label for="">
                {!! Form::radio('imagen_principal_estado', 'Si', true, ['id' => 'imagen_principal_estado_si']) !!}
                Si
            </label>
            <label for="">
                {!! Form::radio('imagen_principal_estado', 'No', false, ['id' => 'imagen_principal_estado_no']) !!}
                No
            </label>
            @error('imagen_principal_estado')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3" id="contenedor_imgs">
            <div class="row">
                <div class="col">
                    {!! Form::label('imagen_destacada', 'Imagen Destacada ') !!}
                    {!! Form::file('imagen_destacada', $atributes = ['id' => 'imagen_destacada','class' => 'form-control']) !!}
                </div>
                <div class="col">
                    <div class="image-wrapper">
                        <small>Vista prevía de la imagen destacada.</small>
                        <img id="image_preview" src="" alt="imagen">
                    </div>
                </div>
            </div>
            @error('imagen_destacada')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            {!! Form::label('tipo_pagina', 'Tipo de Pagina') !!}
            {!! Form::select('tipo_pagina', ['pagina' => 'Pagina', 'blog' => 'Blog', 'galeria' => 'Galeria'], 'pagina', ['class' => 'form-select']) !!}
            @error('tipo_pagina')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <p class="font-weight-bold">Página activa</p>
            <label for="">
                {!! Form::radio('estado', 'Si', true) !!}
                Si
            </label>
            <label for="">
                {!! Form::radio('estado', 'No') !!}
                No
            </label>
            @error('estado')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            {!! Form::label('contenido', 'Contenido') !!}
            {!! Form::textarea('contenido', null, ['class' => 'form-control']) !!}
            @error('contenido')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        {!! Form::submit('Crear', ['class' => 'btn btn-primary btn-sm']) !!}
        <a href="{{route('paginas.index')}}" class="btn btn-secondary btn-sm">Volver</a>
        {!! Form::close() !!}
    </div>
</div>


@endsection

@push('css')
<style>
    .image-wrapper img {
        width: 100%;
        height: 100%;
    }
</style>
@endpush

@push('js')
<script src="{{asset('assets/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
{{-- <script src="{{asset('vendor/ckeditor5-build-classic/build/ckeditor.js')}}"></script> --}}
<script src="{{asset('vendor/ckeditor-images-and-html-embebed/build/ckeditor.js')}}"></script>

{{-- Script para poder usar el slug --}}
<script>
    $(document).ready( function() {
        $('#titulo').stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
        });
    });
</script>


{{-- Script para poder usar el editor de CKEDITOR 5 --}}
<script>
    ClassicEditor
        .create(document.querySelector('#contenido'), {
            simpleUpload: {
                // The URL that the images are uploaded to.
                uploadUrl: "{{route('image.upload')}}",
            }
        })
        .catch(error => {
            console.error(error);
        });

</script>

{{-- Script para poder obtener el valor de un select y muestre ó no el input de la imagen --}}
<script>
    $("#imagen_principal_estado_si").change(function(){
    var estadoSi = $("#imagen_principal_estado_si").val();
    console.log(estadoSi);
        if(estadoSi === 'Si'){
            $('#imagen_destacada').removeAttr('disabled');
            $('#contenedor_imgs').show();
        } else if ((estado === 'No')) {
            $('#imagen_destacada').attr('disabled','disabled');
        }
    });

    $("#imagen_principal_estado_no").change(function(){
    var estadoNo = $("#imagen_principal_estado_no").val();
    console.log(estadoNo);
        if(estadoNo === 'No'){
            $('#imagen_destacada').removeAttr('disabled');
            $('#contenedor_imgs').hide();
        } else if ((estado === 'No')) {
            $('#imagen_destacada').attr('disabled','disabled');
            console.log('deberia poner el disabled')
        }
    });
</script>

{{-- Preview de la imagen --}}
<script>
    $(document).ready(function(){
            $('#imagen_destacada').change(function(e){
                let file= e.target.files[0];
                let reader= new FileReader();
                reader.onload= (event) => {
                $('#image_preview').attr('src', event.target.result)
            };
            reader.readAsDataURL(file);
        })
    });
</script>


@endpush