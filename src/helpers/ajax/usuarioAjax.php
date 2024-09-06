<?php
    use src\controllers\usuarioController;

    if(isset($_POST['model_user'])){

        $user = new usuarioController();

        if($_POST['model_user'] == 'register'){
            echo $user->registerUser();
        }

        if($_POST['model_user'] == 'delete'){
            echo $user->deleteUser();
        }

        if($_POST['model_user'] == 'update'){
            echo $user->updateUser();
        }
        
    }elseif(isset($_GET['action']) && $_GET['action'] == 'load_users'){
        $user = new usuarioController;
        echo $user->tableUser();

    }else{
        session_destroy();
        header('Location: '. URL);
    }