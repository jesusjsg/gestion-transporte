<?php

use src\controllers\movimientosController;


if (isset($_POST['model_movimientos'])) {
    $movimientos = new movimientosController();

    if ($_POST['model_movimientos'] == 'register') {
        echo $movimientos->registerMovimientos();
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'load_movimientos') {
    $movimientos = new movimientosController();
    echo $movimientos->tableMovimientos();
    
} else {
    session_destroy();
    header('Location: ' . URL);
}