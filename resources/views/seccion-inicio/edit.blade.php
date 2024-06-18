@extends('layouts.general')

@section('title_page', 'Editar sección')

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
        <form action="{{ route('seccion-inicio.update', $seccion->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="">
                <div class="row">
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Banner principal</label>
                            <br>
                            <input class="form-check-input" type="radio"  id="No" name="banner_principal" checked value="No" {{ ($seccion->banner_principal=="No")? "checked" : "" }}>&nbsp;No&nbsp;</label>
                            <input class="form-check-input" type="radio" id="Si" name="banner_principal" value="Si" {{ ($seccion->banner_principal=="Si")? "checked" : "" }}>&nbsp;Si</label>                       
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Titulo <small>(Opcional)</small></label>
                            <input type="text" class="form-control" name="titulo"
                                value="{{ old('titulo',$seccion->titulo) }}" autocomplete="off">
                            @error('titulo')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Descripción <small>(Opcional)</small></label>
                            <input type="text" class="form-control" name="descripcion"
                                value="{{ old('descripcion',$seccion->descripcion) }}" autocomplete="off">
                            @error('descripcion')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="color" class="form-label">Imagen <small>(1200x267 px)</small></label>
                            <input type="file" class="form-control" name="imagen" value="{{ old('imagen') }}"
                                autocomplete="off" accept="image/*">
                            @if (is_null($seccion->imagen))
                                <small>Sin imagen
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                    </svg>
                                </small>
                            @else
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Launch demo modal
                                </button> --}}
                                <small class="text-success" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor:pointer;">Click para ver imágen
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
                                    </svg>
                                </small>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Imagen</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{asset('storage').'/'.$seccion->imagen}}" alt="imagen"
                                                class="img-fluid rounded mx-auto d-block">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @error('imagen')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="color" class="form-label">Imagen teléfono <small>(600x180 px)</small></label>
                            <input type="file" class="form-control" name="imagen_telefono" value="{{ old('imagen_telefono') }}"
                                autocomplete="off" accept="image/*">
                            @if (is_null($seccion->imagen_telefono))
                                <small>Sin imagen
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                    </svg>
                                </small>
                            @else
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Launch demo modal
                                </button> --}}
                                <small class="text-success" data-bs-toggle="modal" data-bs-target="#exampleModal2" style="cursor:pointer;">Click para ver imágen
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
                                    </svg>
                                </small>
                                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel2">Imagen teléfono</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{asset('storage').'/'.$seccion->imagen_telefono}}" alt="imagen"
                                                class="img-fluid rounded mx-auto d-block">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
                                {{-- <option value="{{$key}}" @if($value == $seccion->tipo) "selected" @endif
                                >{{ $value}}</option> --}}
                                <option value="{{ $key }}" {{ old("tipo", $seccion->tipo) == $key ? "selected" : "" }}>
                                    {{ $value }}</option>
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
                            <input type="color" class="form-control w-50" name="color"
                                value="{{ old('color',$seccion->color) }}" autocomplete="off">
                            @error('enlace')
                            <span class="text-danger">{{$message}}</span>
                            @enderror --}}
                            <label for="orden" class="form-label">Orden</label>
                            <input type="number" class="form-control" name="orden"
                                value="{{ old('orden',$seccion->orden) }}" autocomplete="off" min="0"
                                oninput="this.value = Math.abs(this.value)">
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
                            <input type="text" class="form-control" name="enlace"
                                value="{{ old('enlace',$seccion->enlace) }}" autocomplete="off">
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
                                <option
                                    {{ old('estado') == 'Si' ? 'selected' : ($seccion->estado == 'Si' ? 'selected' : '') }}
                                    value="Si">Si</option>
                                <option
                                    {{ old('estado') == 'No' ? 'selected' : ($seccion->estado == 'No' ? 'selected' : '') }}
                                    value="No">No</option>
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
                            <input type="text" class="form-control" name="mapa" value="{{ old('mapa',$seccion->mapa) }}"
                                autocomplete="off">
                            @error('mapa')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label for="identificador" class="form-label">Identificador</label>
                            <input type="text" class="form-control" name="identificador" value="{{ old('identificador', $seccion->identificador) }}"
                                autocomplete="off">
                            @error('identificador')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
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
