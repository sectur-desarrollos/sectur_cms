@extends('layouts.general')

@section('title_page', 'Listado de actividades logs')

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
                    <th>Nombre del log</th>
                    <th>Descripción</th>
                    <th>Evento</th>
                    <th>Quién</th>
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
    $('#activityLogsTable').DataTable({
        "serverSide": true,
        "ajax": "{{ url('activity-logs-data') }}",
        "columns": [
            {data: 'log_name',    name: 'log_name'},
            {data: 'description', name: 'description'},
            {data: 'event',       
                // Cambiando el contenido de la data según su contenido
                render: function (data, type, row) {
                            if (data === "created") {
                                return '<td>Crear</td>';
                            }
                            if (data === 'updated') {
                                return '<td>Actualización</td>';
                            }
                            if (data === 'deleted') {
                                return '<td>Eliminado</td>';
                            }
                            return 'Evento';
                        }
            },
            {data: 'causer',  name: 'causer'},
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