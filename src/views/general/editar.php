<?php
use src\controllers\generalController;

$generalController = new generalController();

$idRegistro = $generalController->cleanString($url[2]);
$idEntidad = $generalController->cleanString($url[3]);

$data = $generalController->selectData('Primary', 'general', $idRegistro, $idEntidad);

if ($data->rowCount() == 1) {
    $data = $data->fetch();
}
?>

<main class="app-content">
    <div class="app-title align-items-center">
        <h1 class="fw-light mb-3"><i class="bi bi-cursor-fill me-2"></i>Editar entidad</h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-file-text-fill"></i></li>
            <li class="breadcrumb-item"><a href="<?=URL;?>general/">Entidades registradas</a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="<?=URL;?>ajax/general" method="post" autocomplete="off">
                <div class="d-grid gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Actualizar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <div class="tile-footer"></div>
                <input type="hidden" name="model_general" value="update" />
                <input type="hidden" name="id-registro" value="<?=$data['id_registro']?>" />
                <input type="hidden" name="id-entidad" value="<?=$data['id_entidad']?>" />
                <div class="col-md-1">
                    <label for="codigo-registro" class="form-label">Registro</label>
                    <input type="text" class="form-control" name="codigo-registro" value="<?=$data['id_registro']?>" />
                </div>
                <div class="col-md-1">
                    <label for="codigo-entidad" class="form-label">Entidad</label>
                    <input type="text" class="form-control" name="codigo-entidad" value="<?=$data['id_entidad']?>" />
                </div>
                <div class="col-md-3">
                    <label for="primera-descripcion" class="form-label">Descripción 1</label>
                    <input type="text" class="form-control" name="primera-descripcion" value="<?=$data['descripcion1']?>" />
                </div>
                <div class="col-md-3">
                    <label for="segunda-descripcion" class="form-label">Descripción 2</label>
                    <input type="text" class="form-control" name="segunda-descripcion" value="<?=$data['descripcion2']?>" />
                </div>
                <div class="col-md-3">
                    <label for="tercera-descripcion" class="form-label">Descripción 3</label>
                    <input type="text" class="form-control" name="tercera-descripcion" value="<?=$data['descripcion3']?>" />
                </div>
                <div class="col-md-1">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" class="form-control" name="valor" value="<?=$data['valor']?>" pattern="^[0-9]+(\.[0-9]+)?$">
                </div>
            </form>
        </div>
    </div>
</main>