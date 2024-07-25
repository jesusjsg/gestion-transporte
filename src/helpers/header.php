<?php
    error_reporting(E_ALL);
    ini_set('ignore_repeated_errors', true);
    ini_set('display_errors', false);
    ini_set('log_errors', true);
    ini_set('error_log', '/laragon/www/nomina/php-errors.log');
    //error_log('Inicio del sistema de gestion de transporte');

    require_once 'config/app.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= URL; ?>public/img/clover-logo-tab.ico">
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= URL; ?>public/css/libs/bootstrap.min.css">
    <title><?= APP_NAME; ?></title>
</head>
<body>
    
</body>
</html>