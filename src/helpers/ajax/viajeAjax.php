<?php

use src\controllers\viajeController;
use src\controllers\vehiculoController;
use src\controllers\generalController;
use src\controllers\conductorController;

if (isset($_POST['model_viaje'])) {

    $viaje = new viajeController();

    if ($_POST['model_viaje'] == 'register') {
        echo $viaje->registerViaje();
    }

    if ($_POST['model_viaje'] == 'delete') {
        echo $viaje->deleteViaje();
    }

} elseif (isset($_GET['action']) && $_GET['action'] == 'load_viaje') {
    $viaje = new viajeController();
    echo $viaje->tableViaje();

} elseif (isset($_GET['action']) && $_GET['action'] == 'get_cliente') {
    $cliente = new generalController();
    echo $cliente->getCliente($_GET['term']);

} elseif (isset($_GET['action']) && $_GET['action'] == 'get_conductor') {
    $conductor = new conductorController();
    echo $conductor->getConductorInfo($_GET['term']);

} elseif (isset($_GET['action']) && $_GET['action'] == 'get_placa') {
    $placa = new vehiculoController();
    echo $placa->getPlaca($_GET['term']);

} else {
    session_destroy();
    header('Location: ' . URL);
}
