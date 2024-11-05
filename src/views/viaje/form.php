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
                <input type="hidden" name="ficha-conductor" id="ficha-conductor" />
                <input type="hidden" name="model_viaje" value="register" />
                <input type="hidden" name="codigo-cliente" id="codigo-cliente" />
                <input type="hidden" name="tasa-cambio" id="tasa-cambio" value=<?= $tasaCambio ?> />
                <div class="col-md-2">
                    <label for="nombre-conductor" class="form-label">Nombre y apellido</label>
                    <input type="text" class="form-control" id="nombre-conductor" autofocus/>
                </div>
                <div class="col-md-1">
                    <label for="placa-vehiculo" class="form-label">Placa</label>
                    <input type="text" class="form-control" name="placa-vehiculo" id="placa-vehiculo" />
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
                    <input type="text" class="form-control" name="aviso" />
                </div>
                <div class="col-md-4">
                    <label for="cliente" class="form-label">Cliente</label>
                    <input type="text" class="form-control" id="cliente" />
                </div>
                <div class="col-md-2">
                    <label for="fecha-inicio" class="form-label">Fecha inicio</label>
                    <input type="date" class="form-control" name="fecha-inicio" id="fecha-inicio" />
                </div>
                <div class="col-md-2">
                    <label for="fecha-cierre" class="form-label">Fecha cierre</label>
                    <input type="date" class="form-control" name="fecha-cierre" id="fecha-cierre" />
                </div>
                <div class="col-md-1">
                    <label for="numero-nomina" class="form-label">Nómina</label>
                    <input type="text" class="form-control" name="numero-nomina" />
                </div>
                <div class="col-md-1">
                    <label for="cantidad-feriados" class="form-label">Feriados</label>
                    <input type="text" class="form-control" name="cantidad-feriados" id="cantidad-feriados" />
                </div>
                <div class="col-md-1">
                    <label for="cantidad-sabados" class="form-label">Sábados</label>
                    <input type="text" class="form-control block-input" name="cantidad-sabados" id="cantidad-sabados" />
                </div>
                <div class="col-md-1">
                    <label for="cantidad-domingos" class="form-label">Domingos</label>
                    <input type="text" class="form-control block-input" name="cantidad-domingos" id="cantidad-domingos" />
                </div>
                <div class="tile-footer"></div>
            </form>
        </div>
    </div>
</main>
