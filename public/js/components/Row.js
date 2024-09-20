export function Row(){
    return `
        <div class="col-md-4">
            <label for="origen" class="form-label">Origen</label>
            <input type="text" class="form-control" name="origen[]" />
        </div>
        <div class="col-md-4">
            <label for="destino" class="form-label">Destino</label>
            <input type="text" class="form-control" name="destino[]" />
        </div>
        <div class="col-md-1">
            <label for="codigo-ruta" class="form-label">Ruta</label>
            <input type="text" class="form-control" name="codigo-ruta[]" />
        </div>
        <div class=col-md-1>
            <label for="kilometros" class="form-label">KM</label>
            <input type="text" class="form-control" name="kilometros-movimiento[]" />
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger" id="delete-row">Eliminar</button>
        </div>
    `
}