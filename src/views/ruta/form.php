<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="fw-light"><i class="bi bi-geo-alt-fill me-2"></i>Agregar ruta</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-people-fill"></i></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="<?= URL; ?>ruta/">Rutas</a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="<?= URL; ?>src/helpers/ajax/rutaAjax.php" method="POST" autocomplete="off">
                <div class="d-grid gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <div class="tile-footer"></div>
                <input type="hidden" name="model_ruta" value="register" hidden />
                <input type="hidden" name="codigo-ruta" hidden/>
                <input type="hidden" name="nombre-ruta" hidden/>
                <!-- <div class="col-md-2">
                    <label for="codigo-ruta" class="form-label">Código ruta</label>
                </div>
                <div class="col-md-3">
                    <label for="nombre-ruta" class="form-label">Nombre</label>
                </div> -->
                <div class="col-md-4">
                    <label for="origen" class="form-label">Origen</label>
                    <input type="text" class="form-control autocomplete" name="origen" pattern="[a-zA-Z ]{5,255}" maxlength="255" />
                </div>
                <div class="col-md-4">
                    <label for="destino" class="form-label">Destino</label>
                    <input type="text" class="form-control autocomplete" name="destino" pattern="[a-zA-Z ]{5,255}" maxlength="255"/>
                </div>
                <div class="col-md-4">
                    <label for="kilometros" class="form-label">Kilometros</label>
                    <input type="text" class="form-control" name="kilometros" pattern="[0-9.]{2,2000}" maxlength="255" />
                </div>
                <div class="tile-footer"></div>
            </form>
        </div>
    </div>
</main>