<?php

use src\controllers\generalController;

if (isset($_POST['model_general'])) {
    $general = new generalController;

    if ($_POST['model_general'] == 'register') {
        echo $general->registerGeneral();
    }

    if ($_POST['model_general'] == 'delete') {
        echo $general->deleteGeneral();
    }

    if ($_POST['model_general'] == 'update') {
        echo $general->updateGeneral();
    }
    
} elseif (isset($_GET['action']) && $_GET['action'] == 'load_general') {
    $general = new generalController;
    echo $general->tableGeneral();
} else {
    session_destroy();
    header('Location: ' . URL);
}
