@extends('layouts.general')

@section('title_page', 'Secciones')

@section('content_page')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('error'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('error') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card shadow p-3 mb-5 bg-body rounded">
    <div class="carrd-header">
        <div class="d-flex justify-content-between">
            <div>
                Listado de secciones de la seccion "{{$pagina->titulo}} / <strong>{{$paginaSeccion->titulo}}</strong>"
            </div>
            <div>
                @role('Admin')
                    <a href="{{route('paginas.pagina-seccion-index', $pagina)}}" class="btn btn-secondary btn-sm">Volver</a>
                @endrole
                {{-- @unlessrole('Admin')
                    <a href="{{route('paginas.paginas-empleados')}}" class="btn btn-secondary btn-sm">Volver</a>
                @endunlessrole --}}
                {{-- @can('admin.paginas-archivos.create') --}}
                    <a href="{{route('paginas.seccion-archivos-create', [$pagina, $paginaSeccion])}}" class="btn btn-primary btn-sm">Nueva archivo</a>
                {{-- @endcan --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table" id="paginasSeccionArchivosTable">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Creación</th>
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
// $(document).ready(function () {
//     $('#paginasSeccionArchivosTable').DataTable({
//         "serverSide": true,
//         "ajax": "{{ url('paginas-secciones-archivos-data') }}",
//         "columns": [
//             {data: 'titulo'},
//             {data: 'tipo'},
//             {data: 'estado'},
//             {data: 'created_at'},
//             {data: 'btn'},
//         ],
//         responsive: true,
//         autoWidth: false,

//         "language": {
//         "lengthMenu": "Mostrar " +
//             `<select class="custom-select custom-select-sm form-control form-control-sm">
//                                     <option value='10'>10</option>
//                                     <option value='25'>25</option>
//                                     <option value='50'>50</option>
//                                     <option value='-1'>Todo</option>
//                                     </select>` +
//             " registros por página",
//         "zeroRecords": "Sin registros",
//         "info": "Mostrando la página _PAGE_ de _PAGES_",
//         "infoEmpty": "",
//         "infoFiltered": "(filtrado de _MAX_ registros totales)",
//         'search': 'Buscar:',
//         'paginate': {
//             'next': 'Siguiente',
//             'previous': 'Anterior'
//             }
//         },

//         // Estas lineas de abajo 
//         stateSave: true,
//         stateSaveCallback: function(settings,data) {
//             localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
//             },
//         stateLoadCallback: function(settings) {
//             return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
//             }
//     });
// });

$(function () {
    
    var table = $('#paginasSeccionArchivosTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: "{{ route('paginas.seccion-archivos-index', [$pagina, $paginaSeccion]) }}",
        columns: [
            {data: 'titulo'},
            {data: 'tipo'},
            {data: 'estado'},
            {data: 'created_at'},
            {data: 'btn'},
        ],
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

        // Mantener el estado de la paginación donde se dejó
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