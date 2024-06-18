@extends('layouts.general')

@section('title_page', 'Editar usuario')

@section('content_page')
@if (session('mensaje'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="material-icons">close</i>
    </button>
    <span>{{ session('mensaje')}}</span>
</div>
@endif
@if (session('error'))
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="material-icons">close</i>
    </button>
    <span>{{ session('error')}}</span>
</div>
@endif
<form action="{{ route('usuarios.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input  type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" autocomplete="off">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input  type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" autocomplete="off">
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
                        <label for="rol" class="form-label">Rol</label>
                        <select class="form-select" name="rol">
                            <option value="" selected>Seleccionar rol</option>
                            <option {{ old('rol') == 'Administrador' ? 'selected' : ($user->rol == 'Administrador' ? 'selected' : '') }} value="Administrador">Administrador</option>
                            <option {{ old('rol') == 'Prestador' ? 'selected' : ($user->rol == 'Prestador' ? 'selected' : '') }} value="Prestador">Prestador</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="estado" class="form-label">Activo</label>
                        <select class="form-select" name="estado">
                            <option value="" selected>Seleccionar estado</option>
                            <option {{ old('estado') == 'Si' ? 'selected' : ($user->estado == 'Si' ? 'selected' : '') }} value="Si">Si</option>
                            <option {{ old('estado') == 'No' ? 'selected' : ($user->estado == 'No' ? 'selected' : '') }} value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <label for="nota"><small><strong>En caso de no querer modificar la contraseña, dejar estos campos vacíos</strong></small>
        </label>
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input  type="password" class="form-control" name="password" autocomplete="off">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="password2" class="form-label">Confirmar contraseña</label>
                        <input  type="password" class="form-control" name="password2" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-secondary">Volver</a>
</form>
@endsection

@push('css')
    
@endpush

@push('js')
    
@endpush