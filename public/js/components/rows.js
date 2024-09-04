export function Movement({numeroViaje, numeroMovimiento}){
    return `
        <input type="hidden" name="numero-viaje[]" id="numero-viaje${numeroViaje}" />
        <div class="col-md-3">
            <label for="origen${numeroMovimiento}" class="form-label">Origen ${numeroMovimiento}</label>
            <input type="text" class="form-control" id="origen${numeroMovimiento}" name="origen[]" />
        </div>
        <div class="col-md-3">
            <label for="destino${numeroMovimiento}" class="form-label">Destino ${numeroMovimiento}</label>
            <input type="text" class="form-control" id="destino${numeroMovimiento}" name="destino[]" />
        </div>
        <div class="col-md-1">
            <label for="codigo-ruta${numeroMovimiento}" class="form-label">Ruta ${numeroMovimiento}</label>
            <input type="text" class="form-control" id="codigo-ruta${numeroMovimiento}" name="codigo-ruta[]" />
        </div>
        <div class="col-md-1">
            <label for="kilometros-movimiento${numeroMovimiento}" class="form-label">KM ${numeroMovimiento}</label>
            <input type="text" class="form-control" id="kilometros-movimiento" name="kilometros-movimiento[]" />
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger" id="eliminar${numeroMovimiento}">Eliminar</button>
        </div>
    `
}