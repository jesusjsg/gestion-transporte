<?php

    require_once '../../../config/app.php';
    require_once '../session_start.php';
    require_once '../../../autoload.php';

    use src\controllers\usuarioController;

    if(isset($_POST['model_user'])){

        $user = new usuarioController();

        if($_POST['model_user'] == 'register'){
            echo $user->registerUser();
        }
        
    }else{
        session_destroy();
        header('Location: '. URL);
    }