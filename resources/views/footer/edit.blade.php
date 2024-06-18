@extends('layouts.general')

@section('title_page', 'Editar contenido footer')

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
        <form action="{{ route('footers.update', $contenidoFooter->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input  type="text" class="form-control" name="nombre" value="{{ old('nombre', $contenidoFooter->nombre) }}" autocomplete="off">
                                @error('nombre')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Tipo</label>
                                <input  type="text" class="form-control" name="tipo" value="{{ old('tipo', $contenidoFooter->tipo) }}" autocomplete="off">
                                @error('tipo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
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
                                <label for="valor" class="form-label">Valor</label>
                                <input  type="text" class="form-control" name="valor" value="{{ old('valor', $contenidoFooter->valor) }}" autocomplete="off">
                                @error('valor')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="enlace" class="form-label">Enlace</label>
                                <input  type="text" class="form-control" name="enlace" value="{{ old('enlace', $contenidoFooter->enlace) }}" autocomplete="off">
                                @error('enlace')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
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
                                <select class="form-select" name="estado">
                                    <option value="" selected>Seleccionar estado</option>
                                    <option {{ old('estado') == 'Si' ? 'selected' : ($contenidoFooter->estado == 'Si' ? 'selected' : '') }} value="Si">Si</option>
                                    <option {{ old('estado') == 'No' ? 'selected' : ($contenidoFooter->estado == 'No' ? 'selected' : '') }} value="No">No</option>
                                </select>
                                @error('estado')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
            <a href="{{ route('footers.index') }}" class="btn btn-sm btn-secondary">Volver</a>
        </form>
    </div>
</div>
@endsection

@push('css')
    
@endpush

@push('js')
    
@endpush