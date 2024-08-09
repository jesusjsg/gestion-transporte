<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-people-fill"></i> Agregar registro</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-people-fill"></i></li>
            <li class="breadcrumb-item"><a href="<?= URL; ?>general/form"></a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3" action="">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-success" name="save-usuario">Guardar</button>
                </div>
                <hr>
                <div class="col-md-3">
                    <label for="codigo-registro" class="form-label">Código registro</label>
                    <input type="text" class="form-control" name="codigo-registro" />
                </div>
                <div class="col-md-3">
                    <label for="codigo-entidad" class="form-label">Código entidad</label>
                    <input type="text" class="form-control" name="codigo-entidad" />
                </div>
                <div class="col-md-2">
                    <label for="primera-descripcion" class="form-label">Descripción 1</label>
                    <input type="text" class="form-control" name="primera-descripcion" />
                </div>
                <div class="col-md-2">
                    <label for="segunda-descripcion" class="form-label">Descripción 2</label>
                    <input type="text" class="form-control" name="segunda-descripcion" />
                </div>
                <div class="col-md-2">
                    <label for="tercera-descripcion" class="form-label">Descripción 3</label>
                    <input type="text" class="form-control" name="tercera-descripcion" />
                </div>
                <div class="col-md-2">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" class="form-control" name="valor">
                </div>
                <hr>
            </form>
        </div>
    </div>
</main>