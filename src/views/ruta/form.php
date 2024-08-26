<main class="app-content">
    <div class="app-title align-items-center">
        <a class="text-decoration-none btn btn-secondary btn-sm" href="<?= URL; ?>ruta/"><i class="bi bi-box-arrow-left me-1"></i>Salir</a>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="<?= URL; ?>ajax/ruta" method="POST" autocomplete="off">
                <div class="d-grid gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <div class="tile-footer"></div>
                <input type="hidden" name="model_ruta" value="register" />
                <input type="hidden" id="codigo-origen" />
                <input type="hidden" id="codigo-destino" />
                <div class="col-md-4">
                    <label for="origen" class="form-label">Origen</label>
                    <input type="text" class="form-control" id="origen" pattern="[a-zA-Z ]{5,255}" maxlength="255" />
                </div>
                <div class="col-md-4">
                    <label for="destino" class="form-label">Destino</label>
                    <input type="text" class="form-control" id="destino" pattern="[a-zA-Z ]{5,255}" maxlength="255"/>
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