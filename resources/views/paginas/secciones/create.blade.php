@extends('layouts.general')

@section('title_page', 'Crear nueva sección')

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
        </div>
    </div>
<div class="card-body">
    <form action="{{ route('paginas.pagina-seccion-store', $pagina) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="">
            <div class="row">
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo <strong>(requerido)</strong></label>
                        <input type="text" id="titulo" class="form-control" name="titulo" value="{{ old('titulo') }}"
                            autocomplete="off">
                        @error('titulo')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" id="slug" class="form-control" name="slug" value="{{ old('slug') }}"
                            autocomplete="off" readonly>
                        @error('slug')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
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
            </div>
            <input type="hidden" name="pagina_id" value="{{$pagina->id}}">
        </div>
        <br>
        <button type="submit" class="btn btn-sm btn-primary">Crear</button>
        <a href="{{ route('paginas.pagina-seccion-index', $pagina) }}" class="btn btn-sm btn-secondary">Volver</a>
    </form>
</div>
</div>
@endsection

@push('css')

@endpush

@push('js')
<script src="{{asset('assets/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

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
@endpush
