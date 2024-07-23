<?php
    error_reporting(E_ALL);
    ini_set('ignore_repeated_errors', true);
    ini_set('display_errors', false);
    ini_set('log_errors', true);
    ini_set('error_log', '/laragon/www/nomina/php-errors.log');
    error_log('Inicio de aplicacion web');

    require_once 'config/app.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/css/libs/bootstrap.min.css">
    <title><?= APP_NAME; ?></title>
</head>
<body>
    <header class="d-flex justify-content-between align-items-center py-2 px-4 bg-success-subtle"> 
        <nav>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarCanvas" aria-controls="sidebarCanvas" aria-label="toggle for the sidebar">
                <i class="bi bi-list fs-5"></i>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarCanvas" aria-labelledby="sidebarCanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarCanvasLabel">Menú principal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            </div>
        </nav>
        <nav>
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= URL; ?>" class="navbar-brand ">
                        <img src="<?= URL; ?>public/img/clover-logo-menu.png" alt="logo sidebar" style="width: 2rem; height: 2rem;">
                        <span class="text-black">Gestión de Transporte</span>
                    </a>
                </li>
            </ul>
        </nav>
        <nav>
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= URL; ?>" class="navbar-brand ">
                        <img src="<?= URL; ?>public/img/clover-logo-sidebar.png" alt="logo sidebar" style="width: 2rem; height: 2rem;">
                        <span class="text-black">Configuración</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <script src="<?= URL; ?>public/js/libs/bootstrap.bundle.min.js"></script>
</body>
</html>