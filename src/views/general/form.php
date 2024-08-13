<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="fw-light"><i class="bi bi-info-circle-fill me-2"></i>Agregar registro</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-info-circle-fill"></i></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="<?= URL; ?>general/">Registros</a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3" action="" method="post">
                <div class="d-grid gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <div class="tile-footer"></div>
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
                    <input type="text" class="form-control" name="valor">
                </div>
                <div class="tile-footer"></div>
            </form>
        </div>
    </div>
</main>