@extends('layouts.general')

@section('title_page', 'Crear subsección')

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
    <form action="{{ route('subseccion.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="">
            <div class="row">
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Titulo <small>(Opcional)</small></label>
                        <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}"
                            autocomplete="off">
                        @error('titulo')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Descripción <small>(Opcional)</small></label>
                        <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}"
                            autocomplete="off">
                        @error('descripcion')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="color" class="form-label">Imagen <small>(1200x267)</small></label>
                        <input type="file" class="form-control" name="imagen" value="{{ old('imagen') }}"
                            autocomplete="off" accept="image/*">
                        @error('imagen')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="imagen-telefono" class="form-label">Imagen teléfono <small>(600x180)</small></label>
                        <input type="file" class="form-control" name="imagen_telefono" value="{{ old('imagen_telefono') }}"
                            autocomplete="off" accept="image/*">
                        @error('imagen_telefono')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="valor" class="form-label">Enlace <small>(Opcional)</small></label>
                        <input type="text" class="form-control" name="enlace" value="{{ old('enlace') }}"
                            autocomplete="off">
                        @error('enlace')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select w-50" name="estado">
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
        </div>
        <br>
        <button type="submit" class="btn btn-sm btn-primary">Crear</button>
        <a href="{{ route('seccion-inicio.show', Session::get('seccion_id')) }}"
                class="btn btn-sm btn-secondary">Volver</a>
    </form>
</div>
</div>
@endsection

@push('css')

@endpush

@push('js')

@endpush
