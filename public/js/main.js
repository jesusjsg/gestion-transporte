/* import { getDatatable } from "./components/datatable.js";

    getDatatable('?action=load_users', [
        {'data': 'id_usuario', visible:false},
        {'data': 'nombre_apellido', 'className': 'text-center'},
        {'data': 'nombre_usuario', 'className': 'text-center'},
        {'data': 'contraseña', visible:false},
        {'data': 'id_rol', visible:false},
        {'data': 'opciones', 'className': 'text-center'}
    ]) */

document.addEventListener('DOMContentLoaded', function(){
    $('#table-usuario').DataTable({
        'aProcessing': true,
        'aServerSide': true,
        language: {
            'processing': 'Procesando...',
            'lengthMenu': 'Mostrar registros _MENU_',
            'zeroRecords': 'No se encontraron resultados',
            'info': 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
            'infoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
            'infoFiltered': '(filtrado de un total de _MAX_ registros)',
            'search': 'Buscar:',
            'loadingRecords': 'Cargando',
            'paginate': {
                'first': 'Primero',
                'last': 'Último',
                'next': 'Siguiente',
                'previous': 'Anterior'
            }
        },
        'ajax': {
            'url': 'ajax/usuario?action=load_users',
            'dataSrc': '',
        },
        'columns': [
            {'data': 'id_usuario'},
            {'data': 'nombre_apellido', 'className': 'text-center'},
            {'data': 'nombre_usuario', 'className': 'text-center'},
            {'data': 'contraseña'},
            {'data': 'id_rol', 'className': 'text-center'},
        ],
        dom: '1Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Excel<i class="bi bi-file-earmark-excel ms-1"></i>',
                className: 'btn btn-success btn-sm',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        'responsive': true,
        'bDestroy': true,
        'iDisplayLength': 10,
        'order': [[0, 'asc']],

    })
})

