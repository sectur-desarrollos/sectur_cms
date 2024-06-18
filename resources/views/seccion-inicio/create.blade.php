@extends('layouts.general')

@section('title_page', 'Crear sección')

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
{{-- <div class="bd-callout bd-callout-warning">
    <h4>Warning Callout</h4>
    This is a warning callout.
</div> --}}
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
    <form action="{{ route('seccion-inicio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="">
            <div class="row">
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Banner principal</label>
                        <br>
                        <input class="form-check-input" type="radio"  id="No" name="banner_principal" checked value="No">&nbsp;No&nbsp;</label>
                        <input class="form-check-input" type="radio" id="Si" name="banner_principal" value="Si">&nbsp;Si</label>                       
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo <small>(Opcional)</small></label>
                        <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}"
                            autocomplete="off">
                        @error('titulo')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción <small>(Opcional)</small></label>
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
                        <label for="imagen" class="form-label">Imagen <small>(1200x267 px)</small></label>
                        <input type="file" class="form-control" name="imagen" value="{{ old('imagen') }}"
                            autocomplete="off" accept="image/*">
                        @error('imagen')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="imagen-telefono" class="form-label">Imagen teléfono <small>(600x180 px)</small></label>
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
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-select w-50" name="tipo">
                            <option value="" selected>Seleccionar tipo</option>
                            @foreach(App\Enums\SeccionTiposEnum::values() as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('tipo')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        {{-- <label for="color" class="form-label">Color</label>
                        <input type="color" class="form-control w-50" name="color" value="#ffffff"
                            autocomplete="off">
                        @error('enlace')
                        <span class="text-danger">{{$message}}</span>
                        @enderror --}}
                        <label for="orden" class="form-label">Orden</label>
                        <input type="number" class="form-control" name="orden" value="{{ old('orden') }}"
                            autocomplete="off" min="0" oninput="this.value = Math.abs(this.value)">
                        @error('orden')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="enlace" class="form-label">Enlace <small>(Opcional)</small></label>
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
                        <select class="form-select" name="estado">
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
            <div class="row">
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="mapa" class="form-label">Mapa <small>(CÓDIGO HTML)</small></label>
                        <input type="text" class="form-control" name="mapa" value="{{ old('mapa') }}"
                            autocomplete="off">
                        @error('mapa')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="identificador" class="form-label">Identificador</label>
                        <input type="text" class="form-control" name="identificador" value="{{ old('identificador') }}"
                            autocomplete="off">
                        @error('identificador')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-sm btn-primary">Crear</button>
        <a href="{{ route('seccion-inicio.index') }}" class="btn btn-sm btn-secondary">Volver</a>
    </form>
</div>
</div>
@endsection

@push('css')

@endpush

@push('js')

@endpush
