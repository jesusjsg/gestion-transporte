<?php

    use src\controllers\conductorController;
    use src\helpers\components\Autocomplete;

    if(isset($_POST['model_conductor'])){
        $conductor = new conductorController;

        if($_POST['model_conductor'] == 'register'){
            echo $conductor->registerConductor();
        }

    }elseif(isset($_GET['action']) && $_GET['action'] == 'load_conductores'){
        $conductor = new conductorController;
        echo $conductor->tableConductor();

    }elseif(isset($_GET['action']) && $_GET['action'] == 'get_placa' && isset($_GET['term'])){
        $placa = new Autocomplete;
        echo $placa->autocompletePlaca($_GET['term']);

    }else{
        session_destroy();
        header('Location: '. URL);
    }