@extends('layouts.general')

@section('title_page', 'Editar archivo de la subsección')

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
    <form action="{{ route('paginas.subseccion-archivos-update', [$pagina, $paginaSeccion, $pagina_subseccion, $pagina_subseccion_archivo]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="">
            <div class="row">
                <div class="col-sm">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo <strong>(requerido)</strong></label>
                        <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $pagina_subseccion_archivo->titulo) }}"
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
                            @if (is_null($pagina_subseccion_archivo->archivo))
                                <small>Sin archivo
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                    </svg>
                                </small>
                            @else
                                <small class="text-success" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor:pointer;">Click para ver archivo
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
                                    </svg>
                                </small>
                                @switch($pagina_subseccion_archivo->tipo)
                                    @case('pdf')
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Documento PDF</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>                                                                
                                                                <small><a href="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" target="_blank">{{$pagina_subseccion_archivo->titulo}}</a></small>
                                                            </p>
                                                            <iframe src="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" frameborder="0" width="100%"></iframe>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                    @case('doc')
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Documento DOC</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>                                                                
                                                                <p>Los archivos DOC no se pueden previsualizar, solo mostrar enlaces</p>                                                                
                                                                <small><a href="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" target="_blank">{{$pagina_subseccion_archivo->titulo}}</a></small>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                    @case('docx')
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Documento DOCX</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                <p>Los archivos DOCX no se pueden previsualizar, solo mostrar enlaces</p>                                                                
                                                                <small><a href="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" target="_blank">{{$pagina_subseccion_archivo->titulo}}</a></small>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                    @case('xlsx')
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Documento XLSX</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                <p>Los archivos XLSX no se pueden previsualizar, solo mostrar enlaces</p>                                                                
                                                                <small><a href="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" target="_blank">{{$pagina_subseccion_archivo->titulo}}</a></small>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                    @case('webp')
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Imagen WEBP</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>                                                                
                                                                <small><a href="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" target="_blank">{{$pagina_subseccion_archivo->titulo}}</a></small>
                                                            </p>
                                                            <img src="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" alt="archivo-{{$pagina_subseccion_archivo->titulo}}"
                                                            class="img-fluid rounded mx-auto d-block">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                    @case('png')
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Imagen PNG</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>                                                                
                                                                <small><a href="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" target="_blank">{{$pagina_subseccion_archivo->titulo}}</a></small>
                                                            </p>
                                                            <img src="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" alt="archivo-{{$pagina_subseccion_archivo->titulo}}"
                                                            class="img-fluid rounded mx-auto d-block">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                    @case('jpg')
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Imagen JPG</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>                                                                
                                                                <small><a href="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" target="_blank">{{$pagina_subseccion_archivo->titulo}}</a></small>
                                                            </p>
                                                            <img src="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" alt="archivo-{{$pagina_subseccion_archivo->titulo}}"
                                                            class="img-fluid rounded mx-auto d-block">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                    @case('jpeg')
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Imagen JPEG</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>                                                                
                                                                <small><a href="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" target="_blank">{{$pagina_subseccion_archivo->titulo}}</a></small>
                                                            </p>
                                                            <img src="{{asset('storage').'/'.$pagina_subseccion_archivo->archivo}}" alt="archivo-{{$pagina_subseccion_archivo->titulo}}"
                                                            class="img-fluid rounded mx-auto d-block">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                    @default
                                        <p>No cumple</p>
                                @endswitch
                            @endif
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
                        <input type="text" class="form-control" name="enlace" value="{{ old('enlace', $pagina_subseccion_archivo->enlace) }}"
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
                            <option {{ old('estado') == 'Si' ? 'selected' : ($pagina_subseccion_archivo->estado == 'Si' ? 'selected' : '') }} value="Si">Si</option>
                            <option {{ old('estado') == 'No' ? 'selected' : ($pagina_subseccion_archivo->estado == 'No' ? 'selected' : '') }} value="No">No</option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
        <a href="{{ route('paginas.subseccion-archivos-index', [$pagina, $paginaSeccion, $pagina_subseccion]) }}" class="btn btn-sm btn-secondary">Volver</a>
    </form>
</div>
</div>
@endsection

@push('css')

@endpush

@push('js')

@endpush
