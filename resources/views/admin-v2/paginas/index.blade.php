@extends('layouts.general')

@section('content_page')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2 class="my-4 text-center">Contenido de la Página Inicial</h2>

    <div class="card shadow p-3 mb-5 bg-body rounded">
        <table class="table table-hover">
            {{-- <colgroup></colgroup> --}}
            <thead>
                <tr>
                    {{-- <th class="text-muted">Página de inicio</th> --}}
                    {{-- <th class="text-muted">Acción</th> --}}
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <td class="px-3 py-3">Inicio</td>
                    <td>
                        <a href="{{route('seccion-inicio.index')}}" title="Ver contenido" type="button" class="btn btn-light detalle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            Detalles
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2 class="my-4 text-center">Listado de Páginas Internas</h2>
    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('paginas.create') }}" class="btn btn-primary">Crear Página</a>
        <form action="{{ route('paginas.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Buscar..." value="{{ $search }}">
            <button type="submit" class="btn btn-outline-secondary">Buscar</button>
        </form>
    </div>
    <div class="card shadow rounded-3">
        <div class="card-body">
            <table class="table table-hover table-responsive-sm text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Slug</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paginas as $pagina)
                    <tr>
                        <td>{{ $pagina->titulo }}</td>
                        <td>{{ $pagina->slug }}</td>
                        <td class="d-flex justify-content-center flex-wrap">
                            <a href="{{ route('paginas.edit', $pagina) }}" class="btn btn-warning btn-sm me-1 mb-1">Editar</a>
                            <a href="{{ route('paginas.secciones.index', $pagina) }}" class="btn btn-info btn-sm me-1 mb-1">Secciones</a>
                            <button type="button" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#deletePageModal{{ $pagina->id }}">Eliminar</button>
                        </td>
                    </tr>

                    <!-- Modal para confirmar eliminación -->
                    <div class="modal fade" id="deletePageModal{{ $pagina->id }}" tabindex="-1" aria-labelledby="deletePageModalLabel{{ $pagina->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletePageModalLabel{{ $pagina->id }}">Confirmar Eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Está seguro de que desea eliminar la página "<strong>{{ $pagina->titulo }}</strong>"?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('paginas.destroy', $pagina) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="3">No se encontraron páginas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $paginas->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
