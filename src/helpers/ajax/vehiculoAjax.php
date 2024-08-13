<?php

    require_once '../../../config/app.php';
    require_once '../session_start.php';
    require_once '../../../autoload.php';

    use src\controllers\vehiculoController;

    if(isset($_POST['model_vehiculo'])){

        $user = new vehiculoController();

        if($_POST['model_vehiculo'] == 'register'){
            echo $user->registerVehiculo();
        }
        
    }else{
        session_destroy();
        header('Location: '. URL);
    }