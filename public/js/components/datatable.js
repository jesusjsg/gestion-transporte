import { alertHandler } from "../alertMessages.js"

export function getDatatable(fieldId, url, title, columns){
    $(fieldId).DataTable({
        "aProcessing": true,
        "aServerside": true,
        "paging": true,
        "deferRender": true,
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
        createdRow: function(row, data, dataIndex){
            const form = row.querySelectorAll(".form-ajax")
            alertHandler(form)
        },
        'ajax': {
            'url': url,
            'dataSrc':'',
            'error': function(xhr, error, thrown) {
                console.error('Error to load data: ', error)
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: title, 
                text: 'Excel <i class="bi bi-file-earmark-excel"></i>',
                className: 'btn btn-success btn-sm',
                exportOptions: {
                    columns: ':visible:not(.noExport), :hidden'
                }
            }
        ],
        "columnDefs": [
            { 
                "targets": -1,
                "orderable": false
            }
        ],
        'columns': columns,
        'responsive': true,
        'bDestroy': true,
        'iDisplayLength': 10,
        'order': [[0, 'asc']],
    })
}