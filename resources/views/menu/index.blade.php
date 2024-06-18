@extends('layouts.general')

@section('title_page', 'Menús')


@section('content_page')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card shadow p-3 mb-5 bg-body rounded">
    <div class="carrd-header">
        <div class="d-flex justify-content-between">
            <div>
                Menús registrados
            </div>
            @can('admin.menus.create')
                <a href="{{route('menus.create')}}" class="btn btn-primary btn-sm">Nuevo menú</a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <table class="table" id="menuTable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th>Target</th>
                    <th>Activo</th>
                    <th>Fecha de creación</th>
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
    $('#menuTable').DataTable({
        "serverSide": true,
        "ajax": "{{ url('menus-data') }}",
        "columns": [
            {data: 'name'},
            {data: 'slug'},
            {data: 'target'},
            {data: 'enabled'},
            {data: 'created_at'},
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