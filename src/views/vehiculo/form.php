<?php
    use src\controllers\vehiculoController;
    $autocompleteController = new vehiculoController();

    $registros = [
        'tipoVehiculo' => '',
        'propiedad' => '',
        'unidadNegocio' => '',
        'marcaVehiculo' => '',
        'numeroEjes' => '',
        'capacidadCarga' => '',
        'uso' => '',
        'bolipuertos' => '',
        'gps' => '',
    ];

    $tipoVehiculo = $autocompleteController->autocompleteSelect($registros['tipoVehiculo']);
    $propiedad = $autocompleteController->autocompleteSelect($registros['propiedad']);
    $unidadNegocio = $autocompleteController->autocompleteSelect($registros['unidadNegocio']);
    $marcaVehiculo = $autocompleteController->autocompleteSelect($registros['marcaVehiculo']);
    $numeroEjes = $autocompleteController->autocompleteSelect($registros['numeroEjes']);
    $capacidadCarga = $autocompleteController->autocompleteSelect($registros['capacidadCarga']);
    $uso = $autocompleteController->autocompleteSelect($registros['uso']);
    $bolipuertos = $autocompleteController->autocompleteSelect($registros['bolipuertos']);
    $gps = $autocompleteController->autocompleteSelect($registros['gps']);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="fw-light"><i class="bi bi-car-front-fill me-2"></i>Agregar vehículo</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-car-fill"></i></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="<? URL; ?>vehiculo/">Vehículos</a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3" action="" method="post" autocomplete="off">
                <div class="d-grid gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <hr>
                <div class="col-md-2">
                    <label for="placa" class="form-label">Placa</label>
                    <input type="text" class="form-control" name="placa" />
                </div>
                <div class="col-md-2">
                    <label for="tipo-vehiculo" class="form-label">Tipo</label>
                    <select class="form-select" name="tipo-vehiculo">
                        <option selected disabled>Tipo de vehículo</option>
                        <?php
                            if(!empty($tipoVehiculo)){
                                foreach($tipoVehiculo as $tipo){
                                    echo '<option value="'. $tipo['id_entidad'] . '">'. $tipo['descripcion1'] .'</option>';
                                }
                            } else{
                                echo '<option disabled>No hay roles registrados</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="propiedad" class="form-label">Propiedad</label>
                    <select class="form-select" name="propiedad">
                        <option selected disabled>Propiedad</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="unidad-negocio" class="form-label">Unidad</label>
                    <select class="form-select" name="unidad-negocio">
                        <option selected disabled>Unidad Negocio</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="marca-vehiculo" class="form-label">Marca</label>
                    <select class="form-select" name="marca-vehiculo">
                        <option selected disabled>Marca</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="modelo-vehiculo" class="form-label">Modelo</label>
                    <input type="text" class="form-control" name="modelo-vehiculo" />
                </div>
                <div class="col-md-2">
                    <label for="year-vehiculo" class="form-label">Año</label>
                    <select class="form-select" name="year-vehiculo">
                        <option selected disabled>Año</option>
                        <?php
                            $year = date('Y');
                            for($i = 2007; $i <= $year; $i++){
                                echo '<option value="'. $i. '">'. $i. '</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="serial-carroceria" class="form-label">Serial C.</label>
                    <input type="text" class="form-control" name="serial-carroceria" />
                </div>
                <div class="col-md-3">
                    <label for="serial-motor" class="form-label">Serial M.</label>
                    <input type="text" class="form-control" name="serial-motor" />
                </div>
                <div class="col-md-2">
                    <label for="numero-ejes" class="form-label">Ejes</label>
                    <select class="form-select" name="numero-ejes">
                        <option selected disabled>Número ejes</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="capacidad-carga" class="form-label">Carga</label>
                    <input type="text" class="form-control" name="capacidad-carga" />
                </div>
                <div class="col-md-2">
                    <label for="uso-vehiculo" class="form-label">Uso</label>
                    <select class="form-select" name="uso-vehiculo">
                        <option selected disabled>Uso vehículo</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="vencimiento-poliza" class="form-label">FV. Poliza</label>
                    <input type="date" class="form-control" name="vencimiento-poliza" />
                </div>
                <div class="col-md-2">
                    <label for="vencimiento-racda" class="form-label">FV. Racda</label>
                    <input type="date" class="form-control" name="vencimiento-racda" />
                </div>
                <div class="col-md-2">
                    <label for="vencimiento-sanitario" class="form-label">FV. Sanitario</label>
                    <input type="date" class="form-control" name="vencimiento-sanitario" />
                </div>
                <div class="col-md-2">
                    <label for="vencimiento-rotc" class="form-label">FV. Rotc</label>
                    <input type="date" class="form-control" name="vencimiento-rotc" />
                </div>
                <div class="col-md-2">
                    <label for="fecha-fumigacion" class="form-label">Fumigación</label>
                    <input type="date" class="form-control" name="fecha-fumigacion" />
                </div>
                <div class="col-md-2">
                    <label for="fecha-impuestos" class="form-label">Impuestos</label>
                    <input type="date" class="form-control" name="fecha-impuestos" />
                </div>
                <div class="col-md-2">
                    <label for="bolipuertos" class="form-label">Bolipuertos</label>
                    <select class="form-select" name="bolipuertos">
                        <option selected disabled>Bolipuertos</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="gps" class="form-label">GPS</label>
                    <select class="form-select" name="gps">
                        <option disabled selected>GPS</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="link-gps" class="form-label">Link GPS</label>
                    <input type="text" class="form-control" name="link-gps" />
                </div>
                <div class="col-md-2">
                    <label for="estatus-vehiculo" class="form-label">Estatus</label>
                    <select class="form-select" name="estatus-vehiculo">
                        <option selected disabled>Estatus</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</main>