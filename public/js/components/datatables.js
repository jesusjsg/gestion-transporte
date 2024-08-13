/* 
Funcion para obtener las tablas de cada vista
*/

export function getDatatable(field ,url, columns){
    $(field).DataTable({
        "aProcessing": true,
        "aServerside": true,
        language: {
            'processing': 'Procesando...',
            'lengthMenu': 'Mostrar _MENU_ registros',
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
            'url': url,
            'dataSrc': '',
        },
        'columns': columns,
        dom: '1Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<span class="me-1">Excel<i class="bi bi-file-earmark-excel"></i></span>',
                className: 'btn btn-success btn-sm',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        'responsive': true,
        'bDestroy': true,
        'iDisplayLength': 15,
        'order': [[0, 'asc']]
    })
}