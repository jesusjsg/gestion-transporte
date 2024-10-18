<?php
    use src\controllers\generalController;
    $generalController = new generalController();

    $registros = [
        'tipoVehiculo' => 9,
        'propiedad' => 10,
        'unidadNegocio' => 11,
        'marcaVehiculo' => 12,
        'numeroEjes' => 13,
        'uso' => 14,
        'bolipuertos' => 15,
        'gps' => 16,
    ];

    $tipoVehiculo = $generalController->getRegistro($registros['tipoVehiculo']);
    $propiedad = $generalController->getRegistro($registros['propiedad']);
    $unidadNegocio = $generalController->getRegistro($registros['unidadNegocio']);
    $marcaVehiculo = $generalController->getRegistro($registros['marcaVehiculo']);
    $numeroEjes = $generalController->getRegistro($registros['numeroEjes']);
    $uso = $generalController->getRegistro($registros['uso']);
    $bolipuertos = $generalController->getRegistro($registros['bolipuertos']);
    $gps = $generalController->getRegistro($registros['gps']);
?>

<main class="app-content">
    <div class="app-title align-items-center">
        <h1 class="fw-light mb-3"><i class="bi bi-car-front-fill me-2"></i>Agregar vehículo</h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-car-front-fill"></i></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="<?=URL;?>vehiculo/">Vehículos registrados</a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="<?= URL; ?>ajax/vehiculo" method="post" autocomplete="off">
                <div class="d-grid gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <div class="tile-footer"></div>
                <input type="hidden" name="id-municipio" id="id-municipio" />
                <input type="hidden" name="model_vehiculo" value="register">
                <div class="col-md-2">
                    <label for="placa" class="form-label">Placa</label>
                    <input type="text" class="form-control" name="placa" autofocus />
                </div>
                <div class="col-md-2">
                    <label for="tipo-vehiculo" class="form-label">Tipo</label>
                    <select class="form-select" name="tipo-vehiculo">
                        <option selected disabled>Tipo de vehículo</option>
                        <?php
                            if(!empty($tipoVehiculo)){
                                foreach($tipoVehiculo as $key){
                                    echo '<option value="'. $key['id_entidad'] . '">'. $key['descripcion1'] .'</option>';
                                }
                            } else{
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="propiedad" class="form-label">Propiedad</label>
                    <select class="form-select" name="propiedad">
                        <option selected disabled>Propiedad</option>
                        <?php
                            if(!empty($propiedad)){
                                foreach($propiedad as $key){
                                    echo '<option value="'. $key['id_entidad'] . '">'. $key['descripcion1'] .'</option>';
                                }
                            } else{
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="unidad-negocio" class="form-label">Unidad</label>
                    <select class="form-select" name="unidad-negocio">
                        <option selected disabled>Unidad Negocio</option>
                        <?php
                            if(!empty($unidadNegocio)){
                                foreach($unidadNegocio as $key){
                                    echo '<option value="'. $key['id_entidad'] . '">'. $key['descripcion1'] .'</option>';
                                }
                            } else{
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="marca-vehiculo" class="form-label">Marca</label>
                    <select class="form-select" name="marca-vehiculo">
                        <option selected disabled>Marca</option>
                        <?php
                            if(!empty($marcaVehiculo)){
                                foreach($marcaVehiculo as $key){
                                    echo '<option value="'. $key['id_entidad'] . '">'. $key['descripcion1'] .'</option>';
                                }
                            } else{
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
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
                        <?php
                            if(!empty($numeroEjes)){
                                foreach($numeroEjes as $key){
                                    echo '<option value="'. $key['id_entidad'] . '">'. $key['descripcion1'] .'</option>';
                                }
                            } else{
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
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
                        <?php
                            if(!empty($uso)){
                                foreach($uso as $key){
                                    echo '<option value="'. $key['id_entidad'] . '">'. $key['descripcion1'] .'</option>';
                                }
                            } else{
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
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
                        <?php
                            if(!empty($bolipuertos)){
                                foreach($bolipuertos as $key){
                                    echo '<option value="'. $key['id_entidad'] . '">'. $key['descripcion1'] .'</option>';
                                }
                            } else{
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="gps" class="form-label">GPS</label>
                    <select class="form-select" name="gps">
                        <option disabled selected>GPS</option>
                        <?php
                            if(!empty($gps)){
                                foreach($gps as $key){
                                    echo '<option value="'. $key['id_entidad'] . '">'. $key['descripcion1'] .'</option>';
                                }
                            } else{
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
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
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="origen" class="form-label">Municipio</label>
                    <input type="text" class="form-control" name="origen" id="origen" />
                </div>
                <div class="col-md-2">
                    <label for="activo-uno" class="form-label">Activo SAP 1</label>
                    <input type="text" class="form-control" name="activo-uno" />
                </div>
                <div class="col-md-2">
                    <label for="activo-dos" class="form-label">Activo SAP 2</label>
                    <input type="text" class="form-control" name="activo-dos" />
                </div>
                <div class="col-md-2">
                    <label for="activo-tres" class="form-label">Activo SAP 3</label>
                    <input type="text" class="form-control" name="activo-tres" />
                </div>
                <div class="tile-footer"></div>
            </form>
        </div>
    </div>
</main>