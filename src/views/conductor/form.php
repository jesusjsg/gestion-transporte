<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-people-fill"></i> Agregar conductor</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-people-fill"></i></li>
            <li class="breadcrumb-item"><a href="<?= URL; ?>conductor/form">Conductores</a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3" method="">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-success">Guardar</button>
                </div>
                <hr>
                <div class="col-md-2">
                    <label for="ficha-conductor" class="form-label">Ficha</label>
                    <input type="text" class="form-control" name="ficha-conductor" />
                </div>
                <div class="col-md-3">
                    <label for="name-conductor" class="form-label">Nombre y apellido</label>
                    <input type="text" class="form-control" id="name-conductor" />
                </div>
                <div class="col-md-2">
                    <label for="cedula-conductor" class="form-label">Cédula</label>
                    <input type="text" class="form-control" name="cedula-conductor" />
                </div>
                <div class="col-md-2">
                    <label for="phone-conductor" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="phone-conductor" />
                </div>
                <div class="col-md-2">
                    <label for="vehiculo-conductor" class="form-label">Placa</label>
                    <input type="text" class="form-control" name="vehiculo-conductor" />
                </div>
                <div class="col-md-2">
                    <label for="vencimiento-cedula" class="form-label">FV. Cédula</label>
                    <input type="date" class="form-control" name="vencimiento-cedula" />
                </div>
                <div class="col-md-2">
                    <label for="vencimiento-licencia" class="form-label">FV. Licencia</label>
                    <input type="date" class="form-control" name="vencimiento-licencia" />
                </div>
                <div class="col-md-2">
                    <label for="vencimiento-medico" class="form-label">FV. CM</label>
                    <input type="date" class="form-control" name="vencimiento-medico" />
                </div>
                <div class="col-md-2">
                    <label for="vencimiento-mppps" class="form-label">FV. MPPPS</label>
                    <input type="date" class="form-control" name="vencimiento-mppps" />
                </div>
                <div class="col-md-2">
                    <label for="vencimiento-saberes" class="form-label">FV. Saberes</label>
                    <input type="date" class="form-control" name="vencimiento-saberes" />
                </div>
                <div class="col-md-2">
                    <label for="vencimiento-seguro" class="form-label">FV. Manejo seguro</label>
                    <input type="date" class="form-control" name="vencimiento-seguro" />
                </div>
                <div class="col-md-2">
                    <label for="vencimiento-alimento" class="form-label">FV. Alimento</label>
                    <input type="date" class="form-control" name="vencimiento-alimento" />
                </div>
                <div class="col-md-2">
                    <label for="tipo-nomina" class="form-label">Nómina</label>
                    <select class="form-select" name="tipo-nomina">
                        <option selected disabled>Tipo de nómina</option>
                    </select>
                </div>
                <hr>
            </form>
        </div>
    </div>
</main>