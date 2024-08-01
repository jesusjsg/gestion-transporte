<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset=<?= CHARSET; ?> >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= URL; ?>public/img/clover-logo-tab.ico">
    <title><?= APP_NAME; ?></title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/css/libs/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/css/login.css">
</head>
<body>
    <?= "Ruta: $view";?>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="" class="row gx-3 allign-items-center">
                <div class="col-auto">
                    <h1>Iniciar sesión</h1>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                        <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" required>
                    </div>
                </div>
                <br>
                <div class="col-auto">
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-key-fill"></i></div>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-success" id="log">Ingresar</button>
                </div>
            </form>
        </div>
        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <img src="<?= URL; ?>public/img/dashboard.webp" alt="imagen para el login">
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <script src="<?= URL; ?>public/js/libs/jquery-3.7.1.min.js"></script>
    <script src="<?= URL; ?>public/js/libs/bootstrap.bundle.min.js"></script>
</footer>
</html>