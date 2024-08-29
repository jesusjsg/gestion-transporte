<?php
    use src\controllers\rutaController;
    use src\helpers\components\Autocomplete;

    if(isset($_POST['model_ruta'])){

        $ruta = new rutaController();

        if($_POST['model_ruta'] == 'register'){
            echo $ruta->registerRuta();
        }

        if($_POST['model_ruta'] == 'delete'){
            echo $ruta->deleteRuta();
        }
        
    }elseif(isset($_GET['action']) && $_GET['action'] == 'load_ruta'){
        $ruta = new rutaController;
        echo $ruta->tableRuta();
        
    }elseif(isset($_GET['action']) && $_GET['action'] == 'get_municipio'){
        $estadoMunicipio = new Autocomplete;
        echo $estadoMunicipio->autocompleteMunicipio($_GET['term']);

    }else{
        session_destroy();
        header('Location: '. URL);
    }