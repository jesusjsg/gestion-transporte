<?php

use src\controllers\movimientosController;


if (isset($_POST['model_movimientos'])) {
    $movimientos = new movimientosController();

    if ($_POST['model_movimientos'] == 'register') {
        echo $movimientos->registerMovimientos();
    }
} else {
    session_destroy();
    header('Location: ' . URL);
}