export function Row(listLength, numberMovements){
    return `
        <div class="movements">
            <div class="row g-3 align-items-center">
                <div class="hidden">
                    <input type="hidden" name="numero-movimiento[]" />
                </div>
                <div class="col-md-1">
                    <span class="badge text-bg-secondary">N° ${listLength}</span>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="origen[]" placeholder="Ingrese el origen ${listLength}" />
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="destino[]" placeholder="Ingrese el destino ${listLength}" />
                </div>
                <div class="col-md-1">
                    <input type="text" class="form-control block-input" name="codigo-ruta[]" placeholder="Ruta" disabled />
                </div>
                <div class=col-md-1>
                    <input type="text" class="form-control block-input" name="kilometros-movimiento[]" placeholder="Km" disabled />
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger remove-row" id="delete-row-${numberMovements}">X</button>
                </div>        
            </div>
        </div>
    `
}