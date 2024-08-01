<?php
    error_reporting(E_ALL);
    ini_set('ignore_repeated_errors', true);
    ini_set('display_errors', false);
    ini_set('log_errors', true);
    ini_set('error_log', '/laragon/www/nomina/php-errors.log');
    error_log('Inicio del sistema de gestion de transporte');

    require_once './autoload.php';
    require_once './config/app.php';
    require_once './src/helpers/session_start.php';

    use src\controllers\viewsController;

    if(isset($_GET['views'])){
        $url = explode("/", $_GET['views']);
    } else {
        $url = ['login'];
    }

    $viewsController = new viewsController();
    $view = $viewsController->getViewsController($url[0]);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "./src/helpers/includes/header.php"; ?>
</head>
<body class="app sidebar-mini">
    <?php

        if ($view == "./src/views/login/login.php" || $view == "./src/views/errors/404.php"){
            require_once $view;
        } else {
            require_once $view;
        }

        require_once "./src/helpers/includes/nav.php";
        require_once "./src/helpers/includes/script.php"; 
    
    ?>
</body>
</html>