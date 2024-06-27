@extends('layouts.general')

@section('title_page', 'Bitácora')

@section('content_page')
<div class="card shadow p-3 mb-5 bg-body rounded">
    <div class="carrd-header">
        <div class="d-flex justify-content-between">
            <div>
                Logs registrados
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table" id="activityLogsTable">
            <thead>
                <tr>
                    <th>Módulo</th>
                    <th>Acción</th>
                    <th>Quién</th>
                    <th>Información</th>
                    <th>Donde</th>
                    <th>Fecha</th>
                    {{-- <th>btn</th> --}}
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<script>
$(document).ready(function () {
    $('#activityLogsTable').DataTable({
        "serverSide": true,
        "ajax": "{{ url('activity-logs-data') }}",
        "columns": [
            {data: 'modulo',    name: 'modulo'},
            {data: 'accion', name: 'accion'},
            {data: 'usuario_nombre', name: 'usuario_nombre'},
            {data: 'informacion',  name: 'informacion'},
            {data: 'lugar', name:'lugar'},
            {
                data: 'fecha_accion',
                name: 'fecha_accion',
                render: function (data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        return moment(data).format('DD-MM-YYYY HH:mm:ss');
                    }
                    return data;
                }
            },
            // {data: 'btn'},
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