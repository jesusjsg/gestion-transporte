<?php
use src\controllers\generalController;
use src\controllers\rutaController;

$generalController =  new generalController();
$rutaController =  new rutaController();

$id =  $rutaController->cleanString($url[2]);

$data = $rutaController->selectData('Primary', 'rutas', 'id_ruta', $id);

if ($data->rowCount() == 1) {
    $data = $data->fetch();

    /* $idRuta = $data['id_ruta'];

    $municipioCodes = $rutaController->getRutaCodes($idRuta);

    if ($municipioCodes) {
        $origenCode = $municipioCodes['codigo_origen'];
        $destinoCode = $municipioCodes['codigo_destino'];

        $municipioOrigen = $generalController->getMunicipioById($origenCode);
        $municipioDestino = $generalController->getMunicipioById($destinoCode);
    } else {

    } */
}
?>

<main class="app-content">
    <div class="app-title align-items-center">
        <h1 class="fw-light mb-3"><i class="bi bi-geo-alt-fill"></i>Editar ruta - <?=$data['id_ruta']?></h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-geo-alt-fill"></i></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="<?=URL;?>ruta/">Rutas registradas</a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="<?=URL;?>ajax/ruta" method="post" autocomplete="off">
                <div class="d-grid gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Actualizar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <div class="tile-footer"></div>
                <input type="hidden" name="model_ruta" value="update" />
                <input type="hidden" name="id-ruta" value="<?=$data['id_ruta']?>" />
                <input type="hidden" name="codigo-origen" />
                <input type="hidden" name="codigo-destino"  />
                <div class="col-md-4">
                    <label for="origen" class="form-lael">Origen</label>
                    <input type="text" class="form-control" name="origen" id="origen" value="<?=$data['origen']?>" />
                </div>
                <div class="col-md-4">
                    <label for="destino" class="form-label">Destino</label>
                    <input type="text" class="form-control" name="destino" id="destino" value="<?=$data['destino']?>" />
                </div>
                <div class="col-md-4">
                    <label for="kilometros" class="form-label">Kilometros</label>
                    <input type="text" class="form-control" name="kilometros" id="kilometos" value="<?=$data['kilometros']?>" pattern="[0-9]{2,2000}"/>
                </div>
                <div class="tile-footer"></div>
            </form>
        </div>
    </div>
</main>