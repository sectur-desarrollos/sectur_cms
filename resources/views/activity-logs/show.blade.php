@extends('layouts.general')

@section('title_page', 'Detalles del log')

@section('content_page')
<div class="card shadow p-3 mb-5 bg-body rounded">
    <div class="carrd-header">
        <div class="d-flex justify-content-between">
            <div>
                Información del log
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del log</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('nombre', $log->log_name) }}" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ old('tipo', $log->description) }}" autocomplete="off" readonly>
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
                            <label for="valor" class="form-label">Modelo</label>
                            <input type="text" class="form-control" name="subject_type"
                                value="{{ old('subject_type', $log->subject_type) }}" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="enlace" class="form-label">Evento</label>
                            <input type="text" class="form-control" name="event" value="{{ old('event', $log->event) }}"
                                autocomplete="off" readonly>
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
                            <label for="valor" class="form-label">Quién fue</label>
                            <input type="text" class="form-control" name="causer_id"
                                value="{{ old('causer', $log->causer->name) }}" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="enlace" class="form-label">Fecha</label>
                            <input type="text" class="form-control" name="date"
                                value="{{ old('updated_at', $log->updated_at->isoFormat('LLLL')) }}" autocomplete="off" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr><br>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            {{-- @if($evento == 'created')
                                @foreach ($propiedades as $propiedad)
                                    <form class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">ID</label>
                                            <input type="email" class="form-control w-25" id="id" value="{{$propiedad['id']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword4" class="form-label">Titulo</label>
                                            <input type="text" class="form-control" id="titulo" value="{{$propiedad['titulo']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPassword4" class="form-label">Descripción</label>
                                            <input type="text" class="form-control" id="titulo" value="{{$propiedad['descripcion']}}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress" class="form-label">Imagen</label>
                                            <input type="text" class="form-control" id="imagen" value="{{$propiedad['imagen']}}" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputZip" class="form-label">Tamaño</label>
                                            <input type="text" class="form-control" id="tamaño-imagen" value="{{$propiedad['size_imagen']}}" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputZip" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="tipo-imagen" value="{{$propiedad['type_imagen']}}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2" class="form-label">Documento</label>
                                            <input type="text" class="form-control" id="documento" value="{{$propiedad['documento']}}" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputZip" class="form-label">Tamaño</label>
                                            <input type="text" class="form-control" id="tamaño-documento" value="{{$propiedad['size_documento']}}" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputZip" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="tipo-documento" value="{{$propiedad['type_documento']}}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2" class="form-label">Enlace</label>
                                            <input type="text" class="form-control" id="enlace" value="{{$propiedad['enlace']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Estado</label>
                                            <input type="text" class="form-control w-25" id="estado" value="{{$propiedad['estado']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Página que pertenece</label>
                                            <input type="text" class="form-control w-25" id="estado" value="{{$pagina}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Creación</label>
                                            <input type="text" class="form-control" id="estado" value="{{$propiedad['created_at']}}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">Actualizado</label>
                                            <input type="text" class="form-control" id="estado" value="{{$propiedad['updated_at']}}" readonly>
                                        </div>
                                    </form>
                                @endforeach
                            @endif --}}
                            @include('activity-logs.partials.activity-log-options')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-transparent">
        <a href="{{ route('activity-logs.index') }}" class="btn btn-sm btn-secondary">Volver</a>
    </div>
</div>
</div>
@endsection

@push('css')

@endpush

@push('js')
<script>
    let contenedorPaginas = [];

    $("#caja-paginas :input").each(function(e){	

        let str = $(this).val();
        contenedorPaginas.push(str.split('[{"titulo":"').pop().split('"}]')[0]);

    });
    console.log(contenedorPaginas);

    for (let i = 0; i < contenedorPaginas.length; i++) {
        $("#caja-paginas")
        .append('<input type="text" class="form-control paginas-antiguas" id="paginas-antiguas-'+i+'" value="'+contenedorPaginas[i]+'" readonly>');
    }
</script>
@endpush
