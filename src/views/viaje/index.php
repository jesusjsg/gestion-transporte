<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="fw-light mb-4"><i class="bi bi-cursor-fill me-2"></i>Mantenimiento de los viajes</h1>
            <a class="btn btn-success" href="<?= URL; ?>viaje/form/">Agregar viaje</a>
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
                    <h6 class="fw-bold mb-4">Listado de los viajes registrados</h6>
                </div>
                <div class="table-responsive">
                    <table class="datatable table row-border display compact table-hover" id="table-viaje" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Viaje</th>
                                <th>Ficha</th>
                                <th>Placa</th>
                                <th>Operación</th>
                                <th>Aviso</th>
                                <th>Cliente</th>
                                <th>Ruta</th>
                                <th>Inicio</th>
                                <th>Cierre</th>
                                <th>Sabados</th>
                                <th>Domingos</th>
                                <th>Feriados</th>
                                <th>Tasa</th>
                                <th>Monto USD</th>
                                <th>Monto VES</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Nómina</th>
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