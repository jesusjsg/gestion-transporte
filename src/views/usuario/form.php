<?php
    use src\controllers\usuarioController;
    $rolController = new usuarioController();
    $roles = $rolController->getRol()
?>

<main class="app-content">
    <div class="app-title align-items-center">
        <h1 class="fw-light mb-3"><i class="bi bi-people-fill me-2"></i>Agregar usuario</h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-people-fill"></i></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="<?=URL;?>usuario/">Usuarios registrados</a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="<?= URL; ?>ajax/usuarios" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="d-grid gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <div class="tile-footer"></div>
                <input type="hidden" name="model_user" value="register" />
                <div class="col-md-3">
                    <label for="fullname" class="form-label">Nombre y apellido</label>
                    <input type="text" class="form-control" name="fullname" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}" maxlength="255" autofocus />
                </div>
                <div class="col-md-3">
                    <label for="user" class="form-label">Usuario</label>
                    <input type="text" class="form-control" name="user" pattern="[a-zA-Z0-9]{3,40}" maxlength="40" />
                </div>
                <div class="col-md-2">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" pattern="[a-zA-Z0-9$@.\-]{6,100}" maxlength="100" />
                </div>
                <div class="col-md-2">
                    <label for="valid-password" class="form-label">Repetir contraseña</label>
                    <input type="password" class="form-control" name="valid-password" pattern="[a-zA-Z0-9$@.\-]{6,100}" maxlength="100" />
                </div>
                <div class="col-md-2">
                    <label for="id-rol" class="form-label">Rol del usuario</label>
                    <select class="form-select" name="id-rol">
                        <option selected disabled>Rol del usuario</option>
                        <?php
                            if(!empty($roles)){
                                foreach($roles as $rol){
                                    echo '<option value="'. $rol['id_rol'] . '">'. $rol['nombre_rol'] .'</option>';
                                }
                            } else{
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="tile-footer"></div>
            </form>
        </div>
    </div>
</main>