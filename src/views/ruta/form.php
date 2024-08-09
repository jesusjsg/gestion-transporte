<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-people-fill"></i> Agregar ruta</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-people-fill"></i></li>
            <li class="breadcrumb-item"><a href="<?= URL; ?>ruta/form"></a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3" action="">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-success">Guardar</button>
                </div>
                <hr>
                <div class="col-md-2">
                    <label for="codigo-ruta" class="form-label">Código ruta</label>
                    <input type="text" class="form-control" name="codigo-ruta" />
                </div>
                <div class="col-md-3">
                    <label for="nombre-ruta" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre-ruta" />
                </div>
                <div class="col-md-2">
                    <label for="origen" class="form-label">Origen</label>
                    <input type="text" class="form-control" name="origen" />
                </div>
                <div class="col-md-2">
                    <label for="destino" class="form-label">Destino</label>
                    <input type="text" class="form-control" name="destino" />
                </div>
                <div class="col-md-2">
                    <label for="kilometros" class="form-label">Kilometros</label>
                    <input type="text" class="form-control" name="kilometros" />
                </div>
                <hr>
            </form>
        </div>
    </div>
</main>