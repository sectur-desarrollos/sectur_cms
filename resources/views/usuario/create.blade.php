@extends('layouts.general')

@section('title_page', 'Crear usuario')

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
    <div class="carrd-header">
        <div class="d-flex justify-content-between">
            <div>
                Completa los siguientes campos
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input  type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input  type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off">
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
                                    <option {{ old('rol') == 'Administrador' ? 'selected' : '' }} value="Administrador">Administrador</option>
                                    <option {{ old('rol') == 'Prestador' ? 'selected' : '' }} value="Prestador">Prestador</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Activo</label>
                                <select class="form-select" name="estado">
                                    <option value="" selected>Seleccionar estado</option>
                                    <option {{ old('estado') == 'Si' ? 'selected' : '' }} value="Si">Si</option>
                                    <option {{ old('estado') == 'No' ? 'selected' : '' }} value="No">No</option>
                                </select>
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
                                <label for="password" class="form-label">Contraseña (<small>Minimo 8 caracteres</small>)</label>
                                <input  type="password" class="form-control" name="password" autocomplete="off">
                                
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="password2" class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" name="password2" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Crear</button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-secondary">Volver</a>
        </form>
    </div>
</div>
@endsection

@push('css')
    
@endpush

@push('js')
    
@endpush