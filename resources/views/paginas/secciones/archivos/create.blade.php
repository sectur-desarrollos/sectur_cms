@extends('layouts.general')

@section('title_page', 'Crear archivo de la sección')

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
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                Completa los siguientes campos
            </div>
            <div>
                {{$pagina->titulo}} / <strong>{{$paginaSeccion->titulo}}</strong>
            </div>
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('paginas.seccion-archivos-store', [$pagina, $paginaSeccion]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="">
            <div class="row">
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo <strong>(requerido)</strong></label>
                        <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}"
                            autocomplete="off">
                        @error('titulo')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="archivo" class="form-label">Archivo <small><strong>(jpg,jpeg,png,doc,docx,pdf,xlsx,webp)</strong></small></label>
                        <input type="file" class="form-control" name="archivo" value="{{ old('archivo') }}"
                            autocomplete="off" accept=".jpg, .jpeg, .png, .doc, .docx, .pdf, .xlsx, .webp">
                        @error('archivo')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="enlace" class="form-label">Enlace</label>
                        <input type="text" class="form-control" name="enlace" value="{{ old('enlace') }}"
                            autocomplete="off">
                        @error('enlace')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3 w-50">
                        <label for="estado" class="form-label">Activo <strong>(requerido)</strong></label>
                        <select class="form-select" name="estado" required>
                            <option value="" selected>Seleccionar estado</option>
                            <option {{ old('estado') == 'Si' ? 'selected' : '' }} value="Si">Si</option>
                            <option {{ old('estado') == 'No' ? 'selected' : '' }} value="No">No</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="seccion_id" value="{{$paginaSeccion->id}}">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-sm btn-primary">Crear</button>
        <a href="{{ route('paginas.seccion-archivos-index', [$pagina, $paginaSeccion]) }}" class="btn btn-sm btn-secondary">Volver</a>
    </form>
</div>
</div>
@endsection

@push('css')

@endpush

@push('js')

@endpush
