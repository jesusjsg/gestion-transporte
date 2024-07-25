<?php
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
    <section class="login-content">
        <div class="logo">
            <img class="mb-0" src="<?= URL; ?>public/img/logo-clover-signin.png" style="width: 150px; height: 70px;">
        </div>
        <div class="login-box mt-0">
            <form class="login-form" action="">
                <h3 class="login-head"><i class="bi bi-door-open me-2"></i>Iniciar sesion</h3>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control fw-light" id="username" name="username" placeholder="ingresa tu usuario"/>
                    <label for="username">Usuario</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="ingresa tu contraseña">
                    <label for="password">Contraseña</label>
                </div>
                <div class="d-grid">
                    <button class="btn btn-success rounded-3"></i>Ingresar</button>
                </div>
            </form>
        </div>
    </section>
</body>