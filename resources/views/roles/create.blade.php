@extends('layouts.general')

@section('title_page', 'Crear roles y permisos')


@section('content_page')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success') }}</strong>
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
    <div class="container">
        {!! Form::open(['route' => 'roles.store', 'autocomplete' => 'off', 'files' => true]) !!}
        {{-- @include('roles.partials.form') --}}
        <div class="mb-3">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name', null, ['class' => 'form-control' ]) !!}
            @error('name')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <h4 class="h5">Lista de permisos</h4>
            @foreach ($permissions as $permission)
                <div>
                    <label for="">
                        {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                        {{$permission->description}}
                    </label>
                </div>
            @endforeach
        </div>
        {!! Form::submit('Crear', ['class' => 'btn btn-primary btn-sm']) !!}
        <a href="{{route('roles.index')}}" class="btn btn-secondary btn-sm">Volver</a>
        {!! Form::close() !!}
    </div>
</div>

@endsection


@push('css')
{{-- inicio de cdns para select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

{{-- Fin de cdns para select2 --}}
@endpush


@push('js')
{{-- CDN para utilizar select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- Este script sirve para poder usar el select2 multiple --}}
{{-- inicio de area-search para select2 --}}
<script>
    $(document).ready(function() {
        $('#paginas').select2();
    });
</script>
{{-- Fin de area-search para select2 --}}
@endpush