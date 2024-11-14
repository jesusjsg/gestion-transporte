import { AJAX_TABLES } from "../apiAjax.js";
import { initializeNewRowAutocomplete } from "../main.js";

let table

export function rowsDatatable(fieldId){
    const idViaje = $('input[name="nro-viaje"]').val()

    table = $(fieldId).DataTable({
        "responsive": true,
        "paging": false,
        "searching": false,
        "ordering": false,
        "info": false,
        columnDefs: [
            {
                className: 'reorder',
                render: () => '≡',
                targets: 0
            },
            { orderable: false, targets: '_all' }
        ],
        order: [[0, 'asc']],
        rowReorder: {
            dataSrc: 1,
        },
    })

    $.ajax({
        url: AJAX_TABLES.movimientos,
        method: 'get',
        data: { 'id_viaje': idViaje },
        dataType: 'json',
        success: function(response) {
            if (response.data) {
                response.data.forEach(row => {
                    const count = table.rows().count() + 1
                    table.row.add($(row.input_html)).draw();
                    initializeNewRowAutocomplete(count)
                })
            }
        },
        error: function(error) {
            console.error('Error al cargar los datos: ', error)
        }
    })

    $(fieldId).on('click', '.remove-row', function() {
        deleteRow(this);
    });
}

export function addRow() {
    const count = table.rows().count() + 1;
    const newRow = `
        <tr>
            <td></td>
            <td>
                ${count}
                <input type="hidden" name="nro-movimiento[]" value="${count}" />
            </td>
            <td>
                <input type="text" class="form-control form-control-sm origen" name="origen[]" id="origen-${count}" />
                <input type="hidden" class="id-origen" name="id-origen[]" id="id-origen-${count}" />
            </td>
            <td>
                <input type="text" class="form-control form-control-sm destino" name="destino[]" id="destino-${count}" />
                <input type="hidden" class="id-destino" name="id-destino[]" id="id-destino-${count}" value="" />    
            </td>    
            <td><input type="text" class="form-control form-control-sm codigo-ruta block-input" name="codigo-ruta[]" id="id-ruta-${count}" readOnly /></td>
            <td><input type="text" class="form-control form-control-sm movimientos block-input" name="kilometros-movimiento[]" id="kilometros-movimiento-${count}" readOnly /></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="bi bi-x-lg m-0 p-0"></i></button></td>
        </tr>
    `;
    table.row.add($(newRow)).draw();
    initializeNewRowAutocomplete(count);
}

function deleteRow(button) {
    const row = $(button).closest('tr');
    table.row(row).remove().draw();
    updateRowCount();
}

function updateRowCount() {
    table.rows().every(function(index) {
        const rowNode = this.node();
        $(rowNode).find('td:nth-child(2)').text(index + 1);
        $(rowNode).find('input[name="nro-movimiento[]"]').val(index + 1);
    });
}
