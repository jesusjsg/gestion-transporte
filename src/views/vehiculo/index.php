<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="fw-light mb-4"><i class="bi bi-car-front-fill me-2"></i>Mantenimiento de los vehículos</h1>
            <a class="btn btn-success" href="<?= URL; ?>vehiculo/form">Agregar vehículo</a>
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
                    <h6 class="fw-bold mb-4">Listado de los vehículos registrados</h6>
                </div>
                <div class="table-responsive">
                    <table class="datatable table row-border display compact table-hover" id="table-vehiculo" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Placa</th>
                                <th>Tipo</th>
                                <th>Propiedad</th>
                                <th>Unidad</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Año</th>
                                <th>Serial C.</th>
                                <th>Serial M.</th>
                                <th>Ejes</th>
                                <th>Carga</th>
                                <th>Uso</th>
                                <th>FV. Poliza</th>
                                <th>FV. Racda</th>
                                <th>FV. Sanitario</th>
                                <th>FV. Rotc</th>
                                <th>Fumigación</th>
                                <th>Impuesto</th>
                                <th>Bolipuertos</th>
                                <th>GPS</th>
                                <th>Link GPS</th>
                                <th>Estatus</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>