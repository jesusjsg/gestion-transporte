<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="fw-light mb-4"><i class="bi bi-file-earmark-text-fill me-2"></i>Mantenimiento de las nóminas</h1>
            <a class="btn btn-success" href="<?= URL; ?>nomina/form/">Agregar nómina</a>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-fill fs-6"></i></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="<?= URL; ?>home/">Inicio</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body mb-4">
                    <h6 class="fw-bold">Listado de las nóminas</h6>
                </div>
                <div class="table-responsive">
                    <table class="table row-border display compact table-hover" id="table-nomina" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Prueba</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>