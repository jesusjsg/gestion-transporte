<body class="app sidebar-mini">
    <header class="app-header">
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="hide sidebar"></a>
    </header>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <ul class="app-menu"> 
            <li><a class="app-menu__item" href="<?= URL; ?>home/"><i class="app-menu__icon bi bi-house"></i>
                <span class="app-menu__label">Inicio</span></a></li>

            <li><a class="app-menu__item" href="<?= URL; ?>viaje/"><i class="app-menu__icon bi bi-cursor"></i>
                <span class="app-menu__label">Viajes</span></a></li>

            <li><a class="app-menu__item" href="<?= URL; ?>conductor/"><i class="app-menu__icon bi bi-people"></i>
                <span class="app-menu__label">Conductores</span></a></li>

            <li><a class="app-menu__item" href="<?= URL; ?>ruta/"><i class="app-menu__icon bi bi-truck"></i>
                <span class="app-menu__label">Rutas</span></a></li>

            <li><a class="app-menu__item" href="<?= URL; ?>vehiculo/"><i class="app-menu__icon bi bi-car-front"></i>
                <span class="app-menu__label">Vehículos</span></a></li>

            <li><a class="app-menu__item" href="<?= URL; ?>general/"><i class="app-menu__icon bi bi-info-circle"></i>
                <span class="app-menu__label">Información general</span></a></li>
            
            <li><a class="app-menu__item" href="<?= URL; ?>"><i class="app-menu__icon bi bi-file-text"></i>
                <span class="app-menu__label">Nóminas</span></a></li>

            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-card-text"></i>
                <span class="app-menu__label">Reportes</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= URL; ?>"><i class="icon bi bi-laptop"></i>Reporte de viajes</a></li>
                </ul>
            </li>

            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-gear"></i>
                <span class="app-menu__label">Configuración</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= URL; ?>usuario/"><i class="icon bi bi-person"></i>Usuarios</a></li>
                    <li><a class="treeview-item" href="<?= URL; ?>permisos/"><i class="icon bi bi-lock"></i>Permisos</a></li>
                </ul>
            </li>

            <li><a class="app-menu__item" href="<?= URL; ?>"><i class="app-menu__icon bi bi-box-arrow-right"></i>
                <span class="app-menu__label">Cerrar sesión</span></a></li>

        </ul>
    </aside>