<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-car-front-fill"></i> Agregar vehículo</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-car-fill"></i></li>
            <li class="breadcrumb-item"><a href="#">Vehículos</a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3" action="">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-secondary" href="javascript:window.history.back();">Regresar</a>
                    <button type="button" class="btn btn-success">Guardar</button>
                </div>
                <hr>
                <div class="col-md-2">
                    <label for="placa" class="form-label"></label>
                    <input type="text" class="form-control" name="placa" />
                </div>
                <div class="col-md-2">
                    <label for="tipo-vehiculo" class="form-label"></label>
                    <select class="form-select" name="tipo-vehiculo">
                        <option value=""></option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</main>