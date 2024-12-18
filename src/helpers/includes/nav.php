<?php 
    $actualDate = date('d/m/Y');
    $role = isset($_SESSION['rol_id']) ? $_SESSION['rol_id'] : null;
    $fullname = isset($_SESSION['name']) ? $_SESSION['name'] : null;
?>
<body class="app sidebar-mini">
    <header class="app-header">
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="hide sidebar"></a>
        <a href="<?= URL; ?>home/" class="app-header__logo">
            <img src="<?= URL;?>public/img/main/logo-header.webp" alt="logo header" class="logo-header" />
        </a>
        <ul class="app-nav">
            <div class="app-nav__item user-select-none align-items-center">
                <i class="bi bi-person-fill me-2"></i><span class="me-2 text-capitalize"><?= $fullname; ?></span>
                <i class="bi bi-calendar fs-6 me-2"></i><span class="me-2"><?= $actualDate; ?></span>
            </div>
        </ul>
    </header>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <ul class="app-menu"> 
            <li><a class="app-menu__item" href="<?= URL; ?>home/"><i class="app-menu__icon bi bi-house-fill"></i>
                <span class="app-menu__label">Inicio</span></a></li>
            <?php if($role === 1) : ?>
                <li><a class="app-menu__item" href="<?= URL; ?>viaje/"><i class="app-menu__icon bi bi-cursor-fill"></i>
                    <span class="app-menu__label">Viajes</span></a></li>
    
                <li><a class="app-menu__item" href="<?= URL; ?>conductor/"><i class="app-menu__icon bi bi-people-fill"></i>
                    <span class="app-menu__label">Conductores</span></a></li>
    
                <li><a class="app-menu__item" href="<?= URL; ?>ruta/"><i class="app-menu__icon bi bi-geo-alt-fill"></i>
                    <span class="app-menu__label">Rutas</span></a></li>
    
                <li><a class="app-menu__item" href="<?= URL; ?>vehiculo/"><i class="app-menu__icon bi bi-car-front-fill"></i>
                    <span class="app-menu__label">Vehículos</span></a></li>
    
                <li><a class="app-menu__item" href="<?= URL; ?>general/"><i class="app-menu__icon bi bi-info-circle-fill"></i>
                    <span class="app-menu__label">General</span></a></li>
    
                <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-card-text"></i>
                    <span class="app-menu__label">Reportes</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= URL; ?>"><i class="icon bi bi-laptop"></i>Reporte de viajes</a></li>
                    </ul>
                </li>
    
                <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-gear-fill"></i>
                    <span class="app-menu__label">Configuración</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= URL; ?>usuario/"><i class="icon bi bi-person-fill"></i>Usuarios</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if($role === 2) : ?>
                <li><a class="app-menu__item" href="<?= URL; ?>viaje/"><i class="app-menu__icon bi bi-cursor-fill"></i>
                    <span class="app-menu__label">Viajes</span></a></li>
    
                <li><a class="app-menu__item" href="<?= URL; ?>conductor/"><i class="app-menu__icon bi bi-people-fill"></i>
                    <span class="app-menu__label">Conductores</span></a></li>

                <li><a class="app-menu__item" href="<?= URL; ?>ruta/"><i class="app-menu__icon bi bi-geo-alt-fill"></i>
                    <span class="app-menu__label">Rutas</span></a></li>
            <?php endif; ?>

            <?php if($role === 3 || $role === 4) : ?>
                <li><a class="app-menu__item" href="<?= URL; ?>vehiculo/"><i class="app-menu__icon bi bi-car-front-fill"></i>
                    <span class="app-menu__label">Vehículos</span></a></li>
            <?php endif; ?>

            <li class="treeview"><a class="app-menu__item" href="<?= URL; ?>auth/logout"><i class="app-menu__icon bi bi-box-arrow-right"></i>
                <span class="app-menu__label">Cerrar sesión</span></a></li>
        </ul>
    </aside>