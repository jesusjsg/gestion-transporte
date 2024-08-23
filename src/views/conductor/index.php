<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="fw-light mb-4"><i class="bi bi-people-fill me-2"></i>Mantenimiento de los conductores</h1>
            <a class="btn btn-success" href="<?= URL; ?>conductor/form/">Agregar conductor</a>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door-fill fs-6"></i></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="<?= URL; ?>home">Inicio</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <h6 class="fw-bold mb-4">Listado de los conductores registrados</h6>
                </div>
                <div class="table-responsive">
                    <table class="datatable table table-striped table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Ficha</th>
                                <th>Conductor</th>
                                <th>Cédula</th>
                                <th>Teléfono</th>
                                <th>Vehículo</th>
                                <th>FV Cédula</th>
                                <th>FV Licencia</th>
                                <th>FV CM</th>
                                <th>FV MPPPS</th>
                                <th>FV Saberes</th>
                                <th>FV MS</th>
                                <th>FV Alimento</th>
                                <th>Nómina</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script type="module" src="<?= URL; ?>public/js/functions/conductor.js"></script>