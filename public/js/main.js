$('#table-usuario').DataTable()

let tableUser

document.addEventListener('DOMContentLoaded', function(){
    tableUser = $('#table-usuario').DataTable({
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
            'url': 'http://localhost/gestion-transporte/ajax/usuarios?action=load_users',
            'dataSrc': '',
        },
        'columns': [
            {'data': 'id_usuario'},
            {'data': 'nombre_apellido', 'className': 'text-center'},
            {'data': 'nombre_usuario', 'className': 'text-center'},
            {'data': 'contraseña', visible:false},
            {'data': 'id_rol', 'className': 'text-center'},
        ],
        'responsive': true,
        'bDestroy': true,
        'iDisplayLength': 10,
        'order': [[0, 'asc']],

    })
})

