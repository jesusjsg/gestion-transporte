<?php

    use src\controllers\viajeController;
    use src\helpers\components\Autocomplete;

    if(isset($_POST['model_viaje'])){

        $viaje = new viajeController();

        if($_POST['model_viaje'] == 'register'){
            echo $viaje->registerViaje();
        }

        if($_POST['model_viaje'] == 'delete'){
            echo $viaje->deleteViaje();
        }

    }elseif(isset($_GET['action']) && $_GET['action'] == 'load_viaje'){
        $viaje = new viajeController;
        echo $viaje->tableViaje();
        
    }elseif(isset($_GET['action']) && $_GET['action'] == 'get_cliente'){
        $cliente = new Autocomplete;
        echo $cliente->autocompleteCliente($_GET['term']);
    
    }elseif(isset($_GET['action']) && $_GET['action'] == 'get_conductor'){
        $conductor = new Autocomplete;
        echo $conductor->autocompleteConductor($_GET['term']);

    }elseif(isset($_GET['action']) && $_GET['action'] == 'get_placa'){
        $placa = new Autocomplete;
        echo $placa->autocompletePlaca($_GET['term']);

    }else{
        session_destroy();
        header('Location: '. URL);
    }
