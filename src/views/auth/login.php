<?php

use src\controllers\loginController;

$login = new loginController();

if (isset($_POST['username']) && isset($_POST['pass'])) {
    $login->loginSesion();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="<?= CHARSET; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= URL; ?>public/img/main/clover-logo-tab.ico">
    <title><?= APP_NAME; ?></title>
    <link rel="stylesheet" href="<?= URL; ?>public/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/css/style.css">
    <link rel="stylesheet" href="<?= URL; ?>public/bootstrap-icons/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= URL; ?>public/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL; ?>public/css/libs/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <main>
        <section class="login-content shadow-sm">
            <div class="logo mb-1" style="width: 15%;">
                <img src="<?= URL; ?>public/img/login/login-clover.webp" alt="login image">
            </div>
            <div class="login-box mt-0">
                <form class="login-form" action="" method="POST">
                    <h3 class="login-head"><i class="bi bi-person me-2"></i>Iniciar sesion</h3>
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="username" placeholder="Usuario" autofocus />
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="pass" placeholder="Contraseña" />
                    </div>
                    <div class="mb-2 btn-container d-grid">
                        <button type="submit" class="btn btn-success">INGRESAR</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="<?= URL; ?>public/js/libs/bootstrap.bundle.min.js"></script>
    <script src="<?= URL; ?>public/js/libs/sweetalert2@11.js"></script>
</body>