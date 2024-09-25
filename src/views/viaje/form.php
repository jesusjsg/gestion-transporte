<?php
use src\controllers\generalController;
$generalController = new generalController();

$registros = [
    'tipoOperacion' => 3,
    'tipoCarga' => 4,
];

$tipoOperacion = $generalController->getRegistro($registros['tipoOperacion']);
$tipocarga = $generalController->getRegistro($registros['tipoCarga']);
$tasaCambio = $generalController->getTasa()

?>

<main class="app-content">
    <div class="app-title align-items-center">
        <h1 class="fw-light mb-3"><i class="bi bi-cursor-fill me-2"></i>Agregar viaje</h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-cursor-fill"></i></li>
            <li class="breadcrumb-item"><a class="text-decoration-none " href="<?=URL;?>viaje/">Viajes registrados</a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="<?=URL;?>ajax/viaje" method="post" autocapitalize="off">
                <div class="d-grip gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <div class="tile-footer"></div>
                <input type="hidden" id="ficha-conductor" />
                <input type="hidden" id="codigo-cliente" />
                <input type="hidden" id="id-origen" />
                <input type="hidden" id="id-destino" />
                <input type="hidden" id="tasa-cambio" value=<?= $tasaCambio ?> />
                <div class="col-md-2">
                    <label for="nombre-conductor" class="form-label">Nombre y apellido</label>
                    <input type="text" class="form-control" id="nombre-conductor" />
                </div>
                <div class="col-md-1">
                    <label for="placa-vehiculo" class="form-label">Placa</label>
                    <input type="text" class="form-control" id="placa-vehiculo" />
                </div>
                <div class="col-md-2">
                    <label for="tipo-operacion" class="form-label">Operación</label>
                    <select name="tipo-operacion" id="tipo-operacion" class="form-select">
                        <option disabled selected>Tipo de operación</option>
                        <?php
                            if (!empty($tipoOperacion)) {
                                foreach ($tipoOperacion as $key) {
                                    echo '<option value="' . $key['id_entidad'] . '">' . $key['descripcion1'] . '</option>';
                                }
                            } else {
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="tipo-carga" class="form-label">Carga</label>
                    <select name="tipo-carga" id="tipo-carga" class="form-select">
                        <option disabled selected>Tipo de carga</option>
                        <?php
                            if (!empty($tipocarga)) {
                                foreach ($tipocarga as $key) {
                                    echo '<option value="' . $key['id_entidad'] . '">' . $key['descripcion1'] . '</option>';
                                }
                            } else {
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <label for="aviso" class="form-label">Aviso</label>
                    <input type="text" class="form-control" id="aviso" />
                </div>
                <div class="col-md-4">
                    <label for="cliente" class="form-label">Cliente</label>
                    <input type="text" class="form-control" id="cliente" />
                </div>
                <div class="col-md-2">
                    <label for="fecha-inicio" class="form-label">Fecha inicio</label>
                    <input type="date" class="form-control" id="fecha-inicio" />
                </div>
                <div class="col-md-2">
                    <label for="fecha-cierre" class="form-label">Fecha cierre</label>
                    <input type="date" class="form-control" id="fecha-cierre" />
                </div>
                <div class="col-md-1">
                    <label for="cantidad-feriados" class="form-label">Feriados</label>
                    <input type="text" class="form-control" id="cantidad-feriados" />
                </div>
                <div class="col-md-1">
                    <label for="cantidad-sabados" class="form-label">Sábados</label>
                    <input type="text" class="form-control block-input" id="cantidad-sabados" disabled/>
                </div>
                <div class="col-md-1">
                    <label for="cantidad-domingos" class="form-label">Domingos</label>
                    <input type="text" class="form-control block-input" id="cantidad-domingos" disabled/>
                </div>
                <div class="col-md-1">
                    <label for="total-kilometros" class="form-label">KM</label>
                    <input type="text" class="form-control block-input" id="total-kilometros" disabled/>
                </div>
                <div class="col-md-1">
                    <label for="monto-usd" class="form-label">USD</label>
                    <input type="text" class="form-control block-input" id="monto-usd" disabled/>
                </div>
                <div class="col-md-1">
                    <label for="monto-ves" class="form-label">VES</label>
                    <input type="text" class="form-control block-input" id="monto-ves" disabled/>
                </div>
                <div class="tile-footer"></div>
            </form>
        </div>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="" method="post" autocomplete="off">
                <div class="d-grip gap-2 d-md-flex justify-content-between">
                    <h3 class="fw-light">Agregar movimientos</h3>
                    <div>
                        <button type="button" class="btn btn-primary btn-sm" id="add-row">Agregar fila<i class="bi bi-plus-circle ms-1"></i></button>
                        <button type="reset" class="btn btn-secondary btn-sm" disabled>Limpiar<i class="bi bi-archive ms-1"></i></button>
                        <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                    </div>
                </div>
                <div id="add-movements">

                </div>
                <div class="tile-footer"></div>
            </form>
        </div>
    </div>
</main>
