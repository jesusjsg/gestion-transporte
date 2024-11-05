<?php

use src\controllers\conductorController;
use src\controllers\generalController;
use src\controllers\viajeController;

$generalController = new generalController();
$viajeController = new viajeController();
$conductorController = new conductorController();

$registros = [
    'tipoOperacion' => 3,
    'tipoCarga' => 4,
];

$tipoOperacion = $generalController->getRegistro($registros['tipoOperacion']);
$tipoCarga = $generalController->getRegistro($registros['tipoCarga']);

$id = $viajeController->cleanString($url[2]);

$data = $viajeController->selectData('Primary', 'viajes', 'id_viaje', $id);

if ($data->rowCount() == 1) {
    $data = $data->fetch();

    $idConductor = $data['id_conductor'];
    $idCliente = $data['id_cliente'];

    $nombreConductor = $conductorController->getNameConductor($idConductor);
    $nombreCliente = $generalController->getNameCliente($idCliente);
}
?>

<main class="app-content">
    <div class="app-title align-items-center">
        <h1 class="fw-light mb-3"><i class="bi bi-cursor-fill me-2"></i>Editar viaje</h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-cursor-fill"></i></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="<?=URL;?>viaje/">Viajes registrados</a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="<?=URL;?>ajax/viaje" method="post" autocomplete="off">
                <div class="d-grip gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <div class="tile-footer"></div>
                <input type="hidden" name="model_viaje" value="update" />
                <input type="hidden" name="nro-viaje" value="<?=$data['id_viaje']?>"  />
                <input type="hidden" name="ficha-conductor" id="ficha-conductor" value="<?=$data['id_conductor']?>" />
                <input type="hidden" name="codigo-cliente" id="codigo-cliente" value="<?=$data['id_cliente']?>" />
                <div class="col-md-2">
                    <label for="nombre-conductor" class="form-label">Nombre y apellido</label>
                    <input type="text" class="form-control" id="nombre-conductor" value="<?=$nombreConductor?>" />
                </div>
                <div class="col-md-1">
                    <label for="placa-vehiculo" class="form-label">Placa</label>
                    <input type="text" class="form-control" name="placa-vehiculo" id="placa-vehiculo" value="<?=$data['id_vehiculo']?>" />
                </div>
                <div class="col-md-2">
                    <label for="tipo-operacion" class="form-label">Operación</label>
                    <select name="tipo-operacion" id="tipo-operacion" class="form-select">
                        <option selected disabled>Tipo de operación</option>
                        <?php foreach ($tipoOperacion as $key): ?>
                            <option value="<?=$key['id_entidad']?>"<?=($key['id_entidad'] == $data['id_tipo_operacion']) ? 'selected' : '';?>><?=$key['descripcion1']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="tipo-carga" class="form-label">Carga</label>
                    <select name="tipo-carga" id="tipo-carga" class="form-select">
                        <option selected disabled>Tipo de carga</option>
                        <?php foreach ($tipoCarga as $key): ?>
                            <option value="<?=$key['id_entidad']?>"<?=($key['id_entidad'] == $data['id_tipo_carga']) ? 'selected' : '';?>><?=$key['descripcion1']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <label for="aviso" class="form-label">Aviso</label>
                    <input type="text" class="form-control" value="<?=$data['aviso']?>" />
                </div>
                <div class="col-md-4">
                    <label for="cliente" class="form-label">Cliente</label>
                    <input type="text" class="form-control" id="cliente" value="<?=$nombreCliente?>" />
                </div>
                <div class="col-md-2">
                    <label for="fecha-inicio" class="form-label">Fecha inicio</label>
                    <input type="date" class="form-control" name="fecha-inicio" id="fecha-inicio" value="<?=$data['fecha_inicio']?>" />
                </div>
                <div class="col-md-2">
                    <label for="fecha-cierre" class="form-label">Fecha cierre</label>
                    <input type="date" class="form-control" name="fecha-cierre" id="fecha-cierre" value="<?=$data['fecha_cierre']?>" />
                </div>
                <div class="col-md-1">
                    <label for="numero-nomina" class="form-label">Nómina</label>
                    <input type="text" class="form-control" name="numero-nomina" value="<?=$data['nro_nomina']?>" />
                </div>
                <div class="col-md-1">
                    <label for="cantidad-feriados" class="form-label">Feriados</label>
                    <input type="text" class="form-control" name="cantidad-feriados" id="cantidad-feriados" value="<?=$data['feriados']?>" />
                </div>
                <div class="col-md-1">
                    <label for="cantidad-sabados" class="form-label">Sábados</label>
                    <input type="text" class="form-control block-input" name="cantidad-sabados" id="cantidad-sabados" value="<?=$data['sabados']?>" disabled />
                </div>
                <div class="col-md-1">
                    <label for="cantidad-domingos" class="form-label">Domingos</label>
                    <input type="text" class="form-control block-input" name="cantidad-domingos" id="cantidad-domingos" value="<?=$data['domingos']?>" disabled />
                </div>
                <div class="col-md-1">
                    <label for="total-kilometros" class="form-label">KM</label>
                    <input type="text" class="form-control block-input" name="kilometros" value="<?=$data['total_kilometros']?>" disabled />
                </div>
                <div class="col-md-1">
                    <label for="total-usd" class="form-label">USD</label>
                    <input type="text" class="form-control block-input" name="monto-usd" value="<?=$data['monto_usd']?>" disabled />
                </div>
                <div class="col-md-1">
                    <label for="total-ves" class="form-label">VES</label>
                    <input type="text" class="form-control block-input" name="monto-ves" value="<?=$data['monto_ves']?>" disabled />
                </div>
            </form>
        </div>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="<?=URL?>ajax/movimientos" method="post" autocomplete="off">
                <div class="d-grip gap-2 d-md-flex justify-content-between">
                    <h3 class="fw-light">Movimientos del viaje</h3>
                    <div>
                        <button type="button" class="btn btn-primary btn-sm" id="add-row">Agregar fila<i class="bi bi-plus-circle ms-1"></i></button>
                        <button type="reset" class="btn btn-secondary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                        <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                    </div>
                </div>
                <div class="tile-footer"></div>
                <input type="hidden" name="model_movimientos" value="register" />
                <input type="hidden" name="nro-viaje" value="<?=$data['id_viaje']?>"  />
                <input type="hidden" name="tasa-cambio" value="<?=$data['tasa_cambio']?>" />
                <table class="table table-striped" id="table-movements" style="width: 100%;">
                    <thead>
                        <tr>
                            <td></td>
                            <td>Nº</td>
                            <td style="width: 40%;">Origen</td>
                            <td style="width: 40%;">Destino</td>
                            <td style="width: 10%;">Ruta</td>
                            <td style="width: 10%;">KM</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- rows dynamically added -->
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</main>