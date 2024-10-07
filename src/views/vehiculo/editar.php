<?php
use src\controllers\generalController;
use src\controllers\vehiculoController;

$generalController = new generalController();
$vehiculoController = new vehiculoController();

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

$id = $vehiculoController->cleanString($url[2]);

$data = $vehiculoController->selectData('Primary', 'vehiculos', 'id_vehiculo', $id);

if ($data->rowCount() == 1) {
    $data = $data->fetch();
}
?>

<main class="app-content">
    
</main>