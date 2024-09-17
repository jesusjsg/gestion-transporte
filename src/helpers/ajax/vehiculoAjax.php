<?php

use src\controllers\vehiculoController;

if (isset($_POST['model_vehiculo'])) {

    $vehiculo = new vehiculoController();

    if ($_POST['model_vehiculo'] == 'register') {
        echo $vehiculo->registerVehiculo();
    }

    if ($_POST['model_vehiculo'] == 'delete') {
        echo $vehiculo->deleteVehiculo();
    }

} elseif (isset($_GET['action']) && ($_GET['action'] == 'load_vehiculos')) {
    $vehiculo = new vehiculoController;
    echo $vehiculo->tableVehiculo();

} else {
    session_destroy();
    header('Location: ' . URL);
}
