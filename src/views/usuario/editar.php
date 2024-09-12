<?php
    use src\controllers\usuarioController;
    $user = new usuarioController();
    $rol = $user->getRol();

    $idUser = $user->cleanString($url[2]);

    $dataUser = $user->selectData('Primary', 'usuarios', 'id_usuario', $id);
    if($dataUser->rowCount()==1){
        $dataUser = $dataUser->fetch();
    }
?>

<main class="app-content">
    <div class="app-title align-items-center">
        <h1 class="fw-light mb-4"><i class="bi bi-people-fill me-2"></i>Editar usuario</h1>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3 form-ajax" action="<?= URL; ?>ajax/usuarios" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="d-grid gap-2 d-md-flex justify-content-end">
                    <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                    <button type="submit" class="btn btn-success btn-sm">Actualizar<i class="bi bi-floppy ms-1"></i></button>
                </div>
                <div class="tile-footer"></div>
                <input type="hidden" name="model_user" value="update" />
                
            </form>
        </div>
    </div>
</main>