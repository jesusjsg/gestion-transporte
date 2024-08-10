<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="fw-light mb-4"><i class="bi bi-people-fill me-2"></i>Mantenimiento de los usuarios</h1>
            <a class="btn btn-success" href="#">Agregar usuario</a>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door-fill fs-6"></i></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="<?= URL; ?>home/">Inicio</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <h6 class="fw-bold mb-4">Listado de los usuarios registrados</h6>
                </div>
                <div class="table-responsive">
                    <table class="table row-border display compact table-hover" id="table-usuario" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID usuario</th>
                                <th>Nombre y apellido</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Rol</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>