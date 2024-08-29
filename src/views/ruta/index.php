<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="fw-light mb-4"><i class="bi bi-geo-alt-fill me-2"></i>Mantenimiento de las rutas</h1>
            <a class="btn btn-success" href="<?= URL; ?>ruta/form/">Agregar ruta</a>
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
                    <h6 class="fw-bold mb-4">Listado de las rutas registradas</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="table-ruta" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Kilometros</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>