<?php

    use src\controllers\conductorController;

    if(isset($_POST['model_conductor'])){
        $conductor = new conductorController;

        if($_POST['model_conductor'] == 'register'){
            echo $conductor->registerConductor();
        }

    }elseif(isset($_GET['action']) && $_GET['action'] == 'load_conductores'){
        $conductor = new conductorController;
        echo $conductor->tableConductor();
        
    }else{
        session_destroy();
        header('Location: '. URL);
    }