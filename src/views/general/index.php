<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-person-fill"></i>Información general</h1>
            <br>
            <a class="btn btn-success" href="#">Agregar registro</a>
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
                    <strong>Listado de las entidades registradas</strong>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table row-border display compact table-hover" id="table-general" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Registro</th>
                                <th>Entidad</th>
                                <th>Descripción 1</th>
                                <th>Descripción 2</th>
                                <th>Descripción 3</th>
                                <th>Valor</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>