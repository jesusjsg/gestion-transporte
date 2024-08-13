<?php

    require_once '../../../config/app.php';
    require_once '../session_start.php';
    require_once '../../../autoload.php';

    use src\controllers\rutaController;

    if(isset($_POST['model_ruta'])){

        $user = new rutaController();

        if($_POST['model_ruta'] == 'register'){
            echo $user->registerRuta();
        }
        
    }else{
        session_destroy();
        header('Location: '. URL);
    }