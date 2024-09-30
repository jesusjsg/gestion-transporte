<?php

    use src\controllers\conductorController;
    use src\controllers\viajeController;
    use src\controllers\rutaController;
    use src\controllers\vehiculoController;

    $conductorController = new conductorController;
    $viajeController = new viajeController;
    $rutaController = new rutaController;
    $vehiculoController = new vehiculoController;

    $totalConductores = $conductorController->totalConductores();
    $totalViajes = $viajeController->totalViajes();
    $totalRutas = $rutaController->totalRutas();
    $totalVehiculos = $vehiculoController->totalVehiculos()

?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="fw-light">
                <i class="bi bi-house-fill me-2"></i>
                Bienvenido, <?= $fullname; ?>
            </h1>
        </div>
    </div>
    <?php if($role === 1) : ?>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= URL; ?>viaje/" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <strong>Nro. de viajes</strong>
                                    </div>
                                    <div class="h5 mb-0 font-wight-bold text-gray-800">
                                        <?= $totalViajes; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-cursor-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= URL; ?>conductor/" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <strong>Nro. de conductores</strong>
                                    </div>
                                    <div class="h5 mb-0 font-wight-bold text-gray-800">
                                        <?= $totalConductores; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= URL; ?>vehiculo/" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <strong>Nro. de vehiculos</strong>
                                    </div>
                                    <div class="h5 mb-0 font-wight-bold text-gray-800">
                                        <?= $totalVehiculos; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-truck-front-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= URL; ?>ruta/" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <strong>Nro. de rutas</strong>
                                    </div>
                                    <div class="h5 mb-0 font-wight-bold text-gray-800">
                                        <?= $totalRutas; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <?php if($role === 2) : ?>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= URL; ?>viaje/" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <strong>Nro. de viajes</strong>
                                    </div>
                                    <div class="h5 mb-0 font-wight-bold text-gray-800">
                                        <?= $totalViajes; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-cursor-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= URL; ?>conductor/" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <strong>Nro. de conductores</strong>
                                    </div>
                                    <div class="h5 mb-0 font-wight-bold text-gray-800">
                                        <?= $totalConductores; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= URL; ?>ruta/" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <strong>Nro. de rutas</strong>
                                    </div>
                                    <div class="h5 mb-0 font-wight-bold text-gray-800">
                                        <?= $totalRutas; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <?php if($role === 3 || $role === 4) : ?>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= URL; ?>vehiculo/" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <strong>Nro. de vehiculos</strong>
                                    </div>
                                    <div class="h5 mb-0 font-wight-bold text-gray-800">
                                        <?= $totalVehiculos; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-truck-front-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <?php if($role === 1 || $role === 2) : ?>
        <div class="row">
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">Prueba 1</h3>
                    <div class="ratio ratio-16x9">
                        <div id="salesChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">Prueba 2</h3>
                    <div class="ratio ratio-16x9">
                        <div id="salesChart"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>