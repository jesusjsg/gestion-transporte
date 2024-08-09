<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-people-fill"></i> Agregar usuario</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-people-fill"></i></li>
            <li class="breadcrumb-item"><a href="<?= URL; ?>usuario/form.php"></a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3" action="">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-success" name="save-usuario">Guardar</button>
                </div>
                <hr>
                <div class="hidden-inputs">
                    <input type="hidden" class="form-control" name="id-usuario">
                </div>
                <div class="col-md-3">
                    <label for="fullname" class="form-label">Nombre y apellido</label>
                    <input type="text" class="form-control" name="fullname" />
                </div>
                <div class="col-md-3">
                    <label for="user" class="form-label">Usuario</label>
                    <input type="text" class="form-control" name="user" />
                </div>
                <div class="col-md-2">
                    <label for="username" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" />
                </div>
                <div class="col-md-2">
                    <label for="" class="form-label">Rol del usuario</label>
                    <select class="form-select" name="id-rol" id="id-rol">
                        <option selected disabled>Rol del usuario</option>
                    </select>
                </div>
                <hr>
            </form>
        </div>
    </div>
</main>