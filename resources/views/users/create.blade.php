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
<div class="alert alert-warning alert-dismissible fade show" role="alert">
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
{!! Form::open(['route' => 'users.store', 'autocomplete' => 'off', 'files' => true]) !!}
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    {!! Form::label('email', 'Correo electrónico') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    @error('email')
                    <small class="text-danger">{{$message}}</small>
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
                    <label for="rol" class="form-label">Rol</label>
                    <div id="lista">
                        @foreach ($roles as $rol)
                            <label for="rol" class="form-label">
                                {!! Form::checkbox('roles[]', $rol->id, null, ['class' => 'mr-1 roles', 'id' => $rol->id]) !!}
                                {{$rol->name}}
                            </label> 
                            <br>   
                        @endforeach
                    </div>
                    @error('roles')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    {!! Form::label('estado', 'Estado') !!}
                    {!! Form::select('estado', ['Si' => 'Si', 'No' => 'No'], 'estado', ['class' => 'form-select']) !!}
                    @error('estado')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <label for="nota"><small><strong>Contraseña mínima de 8 caracteres</strong></small>
    </label>
    <div class="col">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    {!! Form::label('password', 'Contraseña') !!}
                    {{ Form::password('password', array('id' => 'password', "class" => "form-control")) }}
                    @error('password')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    {!! Form::label('password2', 'Confirmar contraseña') !!}
                    {{ Form::password('password2', array('id' => 'password2', "class" => "form-control")) }}
                    @error('password')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
{{-- /* Agregué esto para las paginas */ --}}
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    {{Form::label('paginas', 'Paginas que puede acceder')}}
                    <br> 
                    {!! Form::select('paginas[]', $paginas->pluck('titulo','id')->all(), null, ['id' => 'paginas', 'multiple' => 'multiple', 'class' => 'form-select']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::submit('Crear', ['class' => 'btn btn-primary btn-sm']) !!}
<a href="{{route('users.index')}}" class="btn btn-secondary btn-sm">Volver</a>
{!! Form::close() !!}

{{-- <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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
</form> --}}
@endsection

@push('css')
    {{-- inicio de cdns para select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

{{-- Fin de cdns para select2 --}}
<style>
        #paginas {
            /* width:auto; */
            word-wrap: break-word;
        }
</style>
@endpush

@push('js')
{{-- Este script es para select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Evento que me permite seleccionar solo un checkbox de un grupo de checkbox
        $('input:checkbox').on('click', function() {
        let checkbox = $(this);
            if (checkbox.is(':checked')) {
                // Se establecen todos los elementos que coincidan con el nombre que no estén checkeados
                $(this).closest('div').find('input:checkbox[name="roles[]"]').prop('checked', false)
                // Se establece el checkbox marcado       
                checkbox.prop('checked', true);
            } else {
                checkbox.prop('checked', false);
            }
        });
    </script>

    {{-- inicio de area-search para select2 --}}
<script>
    $(document).ready(function() {
        $('#paginas').select2();
    });


</script>
{{-- Fin de area-search para select2 --}}
@endpush