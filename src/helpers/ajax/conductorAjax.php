<?php

use src\controllers\conductorController;
use src\controllers\vehiculoController;

if (isset($_POST['model_conductor'])) {
    $conductor = new conductorController;

    if ($_POST['model_conductor'] == 'register') {
        echo $conductor->registerConductor();
    }

    if ($_POST['model_conductor'] == 'delete') {
        echo $conductor->deleteConductor();
    }

    if ($_POST['model_conductor'] == 'update') {
        echo $conductor->updateConductor();
    }

} elseif (isset($_GET['action']) && $_GET['action'] == 'load_conductores') {
    $conductor = new conductorController;
    echo $conductor->tableConductor();

} elseif (isset($_GET['action']) && $_GET['action'] == 'get_placa') {
    $placa = new vehiculoController();
    echo $placa->getPlaca($_GET['term']);

} else {
    session_destroy();
    header('Location: ' . URL);
}
