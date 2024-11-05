import { initializeNewRowAutocomplete } from "../main.js";

let table

export function rowsDatatable(fieldId){
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
    $(fieldId).on('click', '.remove-row', function() {
        deleteRow(this);
    });
}

export function addRow(){
    const count = table.rows().count() + 1
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
            <td><input type="text" class="form-control form-control-sm codigo-ruta" name="codigo-ruta[]" id="id-ruta-${count}" value="" /></td>
            <td><input type="text" class="form-control form-control-sm" name="kilometros-movimiento[]" id="kilometros-movimiento-${count}" /></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="bi bi-x-lg m-0 p-0"></i></button></td>
        </tr>
    `
    table.row.add($(newRow)).draw()
    initializeNewRowAutocomplete(count)
}

function deleteRow(button) {
    const row = $(button).closest('tr');
    table.row(row).remove().draw();
    updateRowCount();
}

function updateRowCount() {
    const rows = table.rows().data();
    rows.each((row, index) => {
        row[1] = index + 1;
    });
    table.clear().rows.add(rows).draw();
}