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
            //editor: editor
        },
        select: true
    })

    table.on('row-reorder.dt', function(event, diff, edit){
        diff.forEach(function(change){
            let newIndex = change.newPosition
            let oldIndex = change.oldPosition
            let newData = table.row(newIndex).data()

            newData.order = newIndex + 1

            table.row(newIndex).data(newData)
        })
        updateRowsReorder()
    })
}

export function addRow(){
    const count = table.rows().count() + 1
    const newRow = `
        <tr>
            <td></td>
            <td>${count}</td>
            <td>
                <input type="text" class="form-control form-control-sm origen" name="origen[]" />
                <input type="hidden" class="id-origen" name="id-origen[]" />
            </td>
            <td>
                <input type="text" class="form-control form-control-sm destino" name="destino[]" />
                <input type="hidden" class="id-destino" name="id-destino[]" />    
            </td>    
            <td><input type="text" class="form-control form-control-sm codigo-ruta" name="codigo-ruta[]" /></td>
            <td><input type="text" class="form-control form-control-sm" name="kilometros-movimiento[]" /></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="bi bi-x-lg m-0 p-0"></i></button></td>
        </tr>
    `
    table.row.add($(newRow)).draw()
    updateRowsReorder()
}

export function deleteRow(button, table){
    const row = $(button).closest('tr')
    table.row(row).remove().draw()
}

function updateRowsReorder(){
    table.rows().every(function(rowIndex){
        const data = this.data()
        data.order = rowIndex + 1
        this.data(data)
    })
}