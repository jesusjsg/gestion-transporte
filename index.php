<?php

error_reporting(E_ALL);
ini_set('ignore_repeated_errors', false);
ini_set('display_errors', true); // Cambiar a false en producción
ini_set('log_errors', true);
ini_set('error_log', '/laragon/www/gestion-transporte/php-errors.log');
error_log('Inicio del sistema de gestión de transporte');

require_once 'autoload.php';
require_once 'config/app.php';
require_once 'src/helpers/session_start.php';

use src\controllers\viewsController;
use src\controllers\loginController;

$login = new loginController();
$viewsController = new viewsController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($login->loginSesion($username, $password)) {
        header("Location: " . URL . 'home/');
        exit();
    } else {
        echo "Credenciales incorrectas";
    }
}

if (isset($_GET['views'])) {
    $url = explode("/", $_GET['views']);
    $folder = $url[0] ?? 'home';
    $view = $url[1] ?? 'index';
} else {
    $folder = 'auth';
    $view = 'login'; 
}

$viewPath = $viewsController->getViewsController($folder, $view);

// Verificar si el usuario está autenticado para las vistas protegidas
if ($viewPath != "./src/views/auth/login.php" && !isset($_SESSION['user'])) {
    header("Location: " . URL);
    exit();
}

if ($viewPath != "./src/views/auth/login.php" && $viewPath != "./src/views/errors/404.php") {
    require_once "./src/helpers/includes/header.php";
    require_once "./src/helpers/includes/nav.php";
}

require_once $viewPath;

if ($viewPath != "./src/views/auth/login.php" && $viewPath != "./src/views/errors/404.php") {
    require_once "./src/helpers/includes/script.php";
}
?>
