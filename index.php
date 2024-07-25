<?php
    error_reporting(E_ALL);
    ini_set('ignore_repeated_errors', true);
    ini_set('display_errors', false);
    ini_set('log_errors', true);
    ini_set('error_log', '/laragon/www/nomina/php-errors.log');
    error_log('Inicio del sistema de gestion de transporte');

    require_once 'config/app.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="" href="<?= URL; ?>public/img/clover-logo-tab.ico">
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= URL; ?>public/css/libs/bootstrap.min.css">
    <title><?= APP_NAME; ?></title>
</head>
<body>
    <header class="d-flex justify-content-between align-items-center py-2 px-4 bg-success-subtle"> 
        <nav>
            <a class="text-decoration-none" data-bs-toggle="sidebar" href="#sidebar" role="button" aria-controls="sidebar">
                <i class="bi bi-list fs-5"></i>
            </a>
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
                        <img src="<?= URL; ?>public/img/clover-logo-menu.png" alt="logo sidebar" style="width: 2rem; height: 2rem;">
                        <span class="text-black">Configuración</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="wrapper">
        <aside id="sidebar">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="#" class="text-decoration-none">
                        <i class="bi bi-people-fill"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="sidebar-link text-decoration-none">
                        <i class="bi bi-people-fill"></i>
                        <span>Hola</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="sidebar-link has-dropdown-collapse" data-bs-toggle="collapse" data-bs-target="#login" aria-expanded="false" aria-controls="login">
                        <i class="bi bi-people-fill"></i>
                        <span>Login</span>
                    </a>
                    <ul id="login" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item"></li>
                        <i class="bi bi-people-fill"></i>
                        <span>Mundo</span>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link has-dropdown-collapse" data-bs-toggle="collapse" data-bs-target="#config" aria-expanded="false" aria-controls="config">
                        <i class="bi bi-people-fill"></i>
                        <span>config</span>
                    </a>
                    <ul id="config" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item"></li>
                        <i class="bi bi-people-fill"></i>
                        <span>Mundo</span>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-people-fill"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    </div>
    <script src="<?= URL; ?>public/js/libs/bootstrap.bundle.min.js"></script>
</body>
</html>