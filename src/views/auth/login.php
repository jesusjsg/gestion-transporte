
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="<?= CHARSET; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= URL; ?>public/img/clover-logo-tab.ico">
    <title><?= APP_NAME; ?></title>
    <link rel="stylesheet" href="<?= URL; ?>public/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= URL; ?>public/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL; ?>public/css/libs/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <main>
        <section class="login-content">
          <!-- <div class="logo">
            <h1>Vali</h1>
          </div> -->
            <div class="login-box">
                <form class="login-form" action="" method="POST">
                    <h3 class="login-head"><i class="bi bi-person me-2"></i>Iniciar sesion</h3>
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="username" placeholder="Usuario" autofocus />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="text" class="form-control" name="pass" placeholder="Contraseña" />
                    </div>
                    <div class="mb-3 btn-container d-grid">
                        <button type="submit" class="btn btn-success">INGRESAR</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="<?= URL; ?>public/js/libs/bootstrap.bundle.min.js"></script>
    <script src="<?= URL; ?>public/js/libs/sweetalert2@11.js"></script>
    <script src="<?= URL; ?>public/js/libs/jquery-3.7.1.min.js"></script>
    <?php
        use src\controllers\loginController;
        $login = new loginController();
    
        if(isset($_POST['username']) && isset($_POST['pass'])){
            $login->loginSesion();
        }
    ?>
</body>
