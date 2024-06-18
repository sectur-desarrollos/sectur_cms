@extends('layouts.general')

@section('title_page', 'Contenido de la sección')

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
<div class="card shadow p-3 mb-5 bg-body rounded">
    <div
        class="d-flex {{-- justify-content-end --}} justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div>
            <a href="{{ route('seccion-inicio.index') }}" class="btn btn-sm btn-secondary">Volver</a>
        </div>
        <div>
            <a href="{{ route('seccion-inicio.edit', $seccion->id) }}" class="btn btn-light btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil"
                    viewBox="0 0 16 16">
                    <path
                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                </svg>
                Editar
            </a>
            &nbsp;
            <form action="{{ route('seccion-inicio.destroy', $seccion->id) }}" method="POST"
                style="display: inline-block;"
                onsubmit="return confirm('¿Estas seguro de eliminar esta sección de la página?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" title="Eliminar" type="submit" rel="tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil" viewBox="0 0 16 16">
                        <path
                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                    </svg>
                    Eliminar
                </button>
            </form>
        </div>
    </div>
    <div class="container  shadow p-3 mb-5 bg-body rounded">
        <table class="table table-responsive">
            <tbody>
                <tr class="">
                    <th class="table-light" colspan="1"><span>Identificador de la sección</span></th>
                    {{-- <th class="table-light" colspan="1"><span>Color</span></th> --}}
                    <th class="table-light" colspan="1"><span></span></th>
                    <th class="table-light" colspan="1"><span>Imagen</span></th>
                    <th class="table-light" colspan="1"><span>Fecha de Creación</span></th>
                </tr>
                <tr class="">
                    <td colspan="1">{{$seccion->identificador}}</td>
                    {{-- <td colspan="1">
                        <div style="background-color: {{$seccion->color}}">&nbsp;</div>
                    </td> --}}
                    <td colspan="1"></td>
                    <td colspan="1">
                        @if (is_null($seccion->imagen))
                        Sin imagen
                        @else
                        <small class="text-success" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            style="cursor:pointer;">Click para ver imágen
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z" />
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
                    </td>
                    <td colspan="1">{{$seccion->created_at->isoFormat('LLLL')}}</td>
            </tbody>
        </table>
    </div>

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="display-6">Secciones</h3>
        <div>
            <a href="{{route('subseccion.create')}}" class="btn btn-primary btn-sm float-right" id="">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>
                Agregar
            </a>
        </div>
    </div>

    @forelse ($subSeccion as $seccion)
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div>
            <h4>Sección {{$loop->iteration}}</h4>
        </div>
        <div>
            <a href="{{ route('subseccion.edit', $seccion->id) }}" class="btn btn-light btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil"
                    viewBox="0 0 16 16">
                    <path
                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                </svg>
                Editar
            </a>
            &nbsp;
            <form action="{{ route('subseccion.destroy', $seccion->id) }}" method="POST"
                style="display: inline-block;"
                onsubmit="return confirm('¿Estas seguro de eliminar esta sección de inicio?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit" rel="tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil" viewBox="0 0 16 16">
                        <path
                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                    </svg>
                    Eliminar
                </button>
            </form>
        </div>
    </div>
    <div class="container  shadow p-3 mb-5 bg-body rounded">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr class="ancho">
                        <th class="table-light" colspan="1"><span>Título</span></th>
                    </tr>
                    <tr>
                        <td class="" colspan="2">{{$seccion->titulo}}</td>
                    </tr>
                    <tr class="">
                        <th class="table-light" colspan="1"><span>Imagen</span></th>
                    </tr>
                    <tr class="">
                        <td class="" colspan="1"><img src="{{asset('storage').'/'.$seccion->imagen}}" alt="imagen"
                                class="img-fluid rounded mx-auto d-block"></td>
                    </tr>
                    <tr class="">
                        <th class="table-light" colspan="1"><span>Descripcion</span></th>
                    </tr>
                    <tr>
                        <td class="-b-expander -b-text-undexpanded" colspan="1">{{$seccion->descripcion}}</td>
                    </tr>
                    <tr class="">
                        <th class="table-light" colspan="1"><span>Enlace</span></th>
                    </tr>
                    <tr>
                        <td class="-b-expander -b-text-undexpanded ancho" colspan="1">{{$seccion->enlace}}</td>
                    </tr>
                    <tr class="">
                        <th class="table-light" colspan="3"><span>Activo</span></th>
                    </tr>
                    <tr>
                        <td colspan="1">{{$seccion->activo}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @empty
    <div class="container  shadow p-3 mb-5 bg-body rounded">
        <table class="table table-responsive">
            <tbody>
                <tr class="">
                    <th class="table-light" colspan="1"><span>Título</span></th>
                </tr>
                <tr class="">
                    <td class="" colspan="1">Sin secciones</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endforelse
</div>
@endsection

@push('css')

@endpush

@push('js')

@endpush
