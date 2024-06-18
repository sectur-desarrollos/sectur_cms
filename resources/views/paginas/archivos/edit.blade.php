@extends('layouts.general')

@section('title_page', 'Editar archivo')
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
        <form action="{{ route('paginas-archivos.update', $archivo->id) }}" method="POST" enctype="multipart/form-data" id="myform">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" autocomplete="off" value="{{ old('titulo', $archivo->titulo) }}">
                @error('titulo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" autocomplete="off" value="{{ old('descripcion', $archivo->descripcion) }}">
                @error('descripcion')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label for="imagen" class="form-label">Imagen</label>
                        <div class="d-flex justify-content-between">
                            <input type="file" class="form-control" name="imagen" id="imagen" accept=".jpg, .jpeg, .png">
                            <a id="btnRemoveImg" class="btn btn-danger btn-sm" style="height: 25px; width: 25px; display:none;">
                                <svg style="position: relative; bottom: 4px; right: 4px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @if (is_null($archivo->imagen))
                    <div class="image-wrapper" id="div_Img" style="display: none;">
                        <small>Vista prevía de la imagen.</small>
                        <img id="image_preview" src="" alt="imagen">
                    </div>
                    @else
                    <div class="image-wrapper">
                        <small>Vista prevía de la imagen.</small>
                        <img id="image_preview" src="{{asset('storage').'/'.$archivo->imagen}}" alt="imagen">
                    </div>
                    @endif
                    @error('imagen')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <br>
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label for="documento" class="form-label">Documento</label>
                        <div class="d-flex justify-content-between">
                                <input type="file" class="form-control" name="documento" id="documento" accept=".doc, .pdf, .docx, .xlsx">
                                <a id="btnRemoveDoc" class="btn btn-danger btn-sm" style="height: 25px; width: 25px; display:none;">
                                    <svg style="position: relative; bottom: 4px; right: 4px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </a>
                        </div>
                    </div>
                    @if (is_null($archivo->documento))
                    <div class="documento-wrapper">
                        <div class="row justify-content-center" id="div_Document" style="display: none;">
                            <iframe id="documento_preview" src="" width="50%" height="600">
                                    Este navegador no soporta PDF's
                            </iframe>
                        </div>
                    </div>
                    @else
                    <div class="documento-wrapper">
                        <div class="row justify-content-center">
                            <iframe id="documento_preview" src="{{asset('storage').'/'.$archivo->documento}}" width="50%" height="600">
                                    Este navegador no soporta PDF's
                            </iframe>
                        </div>
                    </div>
                    @endif
                    @error('documento')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="enlace" class="form-label">Enlace</label>
                <input type="text" class="form-control" value="{{old('enlace', $archivo->enlace)}}" name="enlace">
                @error('enlace')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" name="estado" >
                    <option value="" selected>Selecciona el estado</option>
                    <option {{ old('status') == 'Si' ? 'selected' : ($archivo->estado == 'Si' ? 'selected' : '') }} value="Si">Si</option>
                    <option {{ old('status') == 'No' ? 'selected' : ($archivo->estado == 'No' ? 'selected' : '') }} value="No">No</option>
                </select>
                @error('estado')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <input type="hidden" name="pagina_id" value="{{$pagina->id}}">
            <button type="submit" class="btn btn-primary">Actualizar archivo</button>
            <a href="{{ route('paginas.archivos', $pagina) }}" class="btn btn-light">Regresar</a>
        </form>
    </div>
</div>

@endsection

@push('css')
{{-- Estilo CSS para preview de la imagen --}}
<style>
    .image-wrapper img {
        width: 100%;
        height: 100%;
    }
</style>

@endpush

@push('js')
<script src="{{asset('assets/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
<script src="{{asset('vendor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

{{-- Preview de la imagen --}}
<script>
    $(document).ready(function(){
            $('#imagen').change(function(e){
                let file= e.target.files[0];
                let reader= new FileReader();
                reader.onload= (event) => {
                $('#image_preview').attr('src', event.target.result)
            };
            reader.readAsDataURL(file);
        })
    });
</script>

{{-- Script para preview del documento --}}
<script>
    $(document).ready(function(){
            $('#documento').change(function(e){
                let file= e.target.files[0];
                let reader= new FileReader();
                reader.onload= (event) => {
                $('#documento_preview').attr('src', event.target.result)
                console.log(file);
            };
            reader.readAsDataURL(file);
        })
    });
</script>

{{-- Documento preview --}}
<script>
    $('#documento').change(function() {
        if ($(this).get(0).files.length === 0) {
            console.log("Ningún archivo cargado.");
            $('#div_Document').hide();
            $('#btnRemoveDoc').hide();
        } else {
            $('#div_Document').show();
            $('#btnRemoveDoc').show();
        }
    });
    
    $('#btnRemoveDoc').click(function() {
        $('#documento_preview').attr('src', '');
        $('#documento').val('');
        $('#div_Document').hide();
        $('#btnRemoveDoc').hide();
    });

    // Obteniendo el valor del input de imagen y reseteando su valor
    $('#imagen').change(function() {
        if ($(this).get(0).files.length === 0) {
            console.log("Ninguna imagen cargada.");
            $('#div_Img').hide();
            $('#btnRemoveImg').hide();
        } else {
            $('#div_Img').show();
            $('#btnRemoveImg').show();
        }
    });

    $('#btnRemoveImg').click(function() {
        $('#imagen').val('');
        $('#div_Img').hide();
        $('#btnRemoveImg').hide();
    });


</script>


@endpush