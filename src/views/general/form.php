<main class="app-content">
    <div class="app-title align-items-center">
        <a class="text-decoration-none btn btn-secondary btn-sm" href="<?= URL; ?>general/"><i class="bi bi-box-arrow-left me-1"></i>Salir</a>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="<?= URL; ?>ajax/general" method="post" autocomplete="off">
                <div class="d-grid gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <div class="tile-footer"></div>
                <input type="hidden" name="model_general" value="register" />
                <div class="col-md-1">
                    <label for="codigo-registro" class="form-label">Registro</label>
                    <input type="text" class="form-control" name="codigo-registro" />
                </div>
                <div class="col-md-1">
                    <label for="codigo-entidad" class="form-label">Entidad</label>
                    <input type="text" class="form-control" name="codigo-entidad" />
                </div>
                <div class="col-md-3">
                    <label for="primera-descripcion" class="form-label">Descripción 1</label>
                    <input type="text" class="form-control" name="primera-descripcion" />
                </div>
                <div class="col-md-3">
                    <label for="segunda-descripcion" class="form-label">Descripción 2</label>
                    <input type="text" class="form-control" name="segunda-descripcion" />
                </div>
                <div class="col-md-3">
                    <label for="tercera-descripcion" class="form-label">Descripción 3</label>
                    <input type="text" class="form-control" name="tercera-descripcion" />
                </div>
                <div class="col-md-1">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" class="form-control" name="valor" pattern="[0-9]{1,255}">
                </div>
                <div class="tile-footer"></div>
            </form>
        </div>
    </div>
</main>