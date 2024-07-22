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
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/css/libs/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/css/libs/bootstrap.min.css">
    <title><?= APP_NAME; ?></title>
</head>
<body>
    <main class="d-flex flex-nowrap">
        <div class="flex-shrink-0" style="width: 20%;">
            <a href="<?= URL; ?>" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom text-bg-dark" style="height: 3rem;">
                <img class="bi pe-none me-3 ms-3 pt-1 logo-sidebar" src="<?= URL; ?>public/img/clover-logo-sidebar.png" alt="">
                <span class="fs-5 fw-semibold text-white pt-1">Clover Internacional</span>
            </a>
        </div>
    </main>
<!--<div class="sidebar">
        <div class="logo-sidebar">
            <img class="logo-image" src="public/img/clover-logo-sidebar.png" alt="">
            <span class="logo-name">Clover Internacional</span>
        </div>
    </div>-->
</body>
</html>