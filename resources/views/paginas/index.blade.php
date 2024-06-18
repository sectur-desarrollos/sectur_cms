@extends('layouts.general')

@section('title_page', 'Listado de páginas')

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
    <table class="table table-hover">
        {{-- <colgroup></colgroup> --}}
        <thead>
            <tr>
                <th class="text-muted">Página de inicio</th>
                {{-- <th class="text-muted">Acción</th> --}}
            </tr>
        </thead>
        <tbody>
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

<div class="card shadow p-3 mb-5 bg-body rounded">
    <div class="carrd-header">
        <div class="d-flex justify-content-between">
            <div>
                Páginas registradas
            </div>
            @can('admin.paginas.create')
                <a href="{{route('paginas.create')}}" class="btn btn-primary btn-sm">Nueva página</a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <table class="table" id="paginasTable">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Slug</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection


@push('css')
{{-- Inicio CDM's css para datatables --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
{{-- Fin cDN's css para datatables --}}

{{-- Inicio para datatable responsive  --}}
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
{{-- Fin para datatable responsive  --}}

<style>
    /* Con este estilo se puede poner el efecto shadow al botón de detalles */
    .detalle:hover {
        cursor: pointer;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    }

</style>

@endpush


@push('js')
    {{-- inicio CDN de jquery para datatables --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
{{-- Fin CDN de Jquery para datatables --}}

{{-- Inicio para responsive de datatables --}}
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
{{-- Fin para responsive de datatables --}}

<script>
$(document).ready(function () {
    $('#paginasTable').DataTable({
        "serverSide": true,
        "ajax": "{{ url('paginas-data') }}",
        "columns": [
            {data: 'titulo'},
            {data: 'slug'},
            {data: 'tipo_pagina'},
            {data: 'btn'},
        ],
        responsive: true,
        autoWidth: false,

        "language": {
        "lengthMenu": "Mostrar " +
            `<select class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value='10'>10</option>
                                    <option value='25'>25</option>
                                    <option value='50'>50</option>
                                    <option value='-1'>Todo</option>
                                    </select>` +
            " registros por página",
        "zeroRecords": "Sin registros",
        "info": "Mostrando la página _PAGE_ de _PAGES_",
        "infoEmpty": "",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        'search': 'Buscar:',
        'paginate': {
            'next': 'Siguiente',
            'previous': 'Anterior'
            }
        },

        // Estas lineas de abajo son para mantener la paginación de DataTables
        stateSave: true,
        stateSaveCallback: function(settings,data) {
            localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
            },
        stateLoadCallback: function(settings) {
            return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
            }
    });
});
</script>
@endpush