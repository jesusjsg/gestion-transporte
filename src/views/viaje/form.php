<main class="app-content">
    <div class="app-title">
        <div>
            <h1 id="#movements-details"><i class="bi bi-cursor-fill"></i> Agregar viaje</h1>
            <br>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-cursor-fill fs-6"></i></li>
            <li class="breadcrumb-item"><a href="<?= URL; ?>viaje/"> Viajes</a></li>
        </ul> 
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3" method="">
                <div class="main-form">
                    <div class="row g-3">
                        <div class="hidden-main">
                            <input type="hidden" class="form-control" name="id-viaje[]" id="id-viaje">
                            <input type="hidden" class="form-control" name="id-client" id="id-client">
                            <input type="hidden" class="form-control" name="id-origen" id="id-origen">
                            <input type="hidden" class="form-control" name="id-destino" id="id-destino">
                        </div>
                        <div class="modal-footer">
                            <div class="col-auto">
                                <button class="btn btn-secondary" id="close-header" type="button" onclick="window.location.href ='viajes.php'">Cancelar</button>
                                <button class="btn btn-success" id="save-mov" type="submit">Guardar</button>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-2">
                            <label for="name-emp" class="col-sm-2 col-form-label">Nombre</label>
                            <input type="text" class="form-control" name="name-emp" id="name-emp" placeholder="Nombre y apellido"> 
                        </div>
                        <div class="col-md-2">
                            <label for="carnet-emp" class="col-sm-2 col-form-label">Ficha</label>
                            <input type="text" class="form-control block-input" name="carnet-emp" id="carnet-emp" placeholder="Ficha" tabindex="-1" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="placa-veh" class="col-sm-2 col-form-label">Placa</label>
                            <input type="text" class="form-control" name="placa-veh" id="placa-veh" placeholder="Placa">
                        </div>
                        <div class="col-md-3">
                            <label for="id-operacion" class="col-sm-2 col-form-label">Operación</label>
                            <select class="form-select" name="id-operacion" id="id-operacion">
                                <option selected disabled>Operaciones</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="id-carga" class="col-sm-2 col-form-label">Carga</label>
                            <select class="form-select" name="id-carga" id="id-carga">
                                <option selected disabled>Tipos de carga</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="text-client" class="col-sm-2 col-form-label">Clientes</label>
                            <input type="text" class="form-control" name="text-client" id="text-client" placeholder="Ingrese el cliente">
                        </div>
                        <div class="col-md-2">
                            <label for="num-aviso" class="col-sm-2 col-form-label">Aviso</label>
                            <input type="text" class="form-control" name="num-aviso" id="num-aviso" placeholder="Ingrese el aviso" oninput="this.value = this.value.replace(/[ ]/g, '')">
                        </div>
                        <div class="col-md-2">
                            <label for="start-date" class="col-sm-2 col-form-label">Inicio</label>
                            <input type="date" class="form-control" name="start-date" id="start-date">
                        </div>
                        <div class="col-md-2">
                            <label for="end-date" class="col-sm-2 col-form-label">Cierre</label>
                            <input type="date" class="form-control" name="end-date" id="end-date">
                        </div>
                        <div class="col-md-1">
                            <label for="count-saturday" class="col-sm-2 col-form-label">Sabados</label>
                            <input type="text" class="form-control block-input" name="count-saturday" id="count-saturday" tabindex="-1" readonly>
                        </div>
                        <div class="col-md-1">
                            <label for="count-sunday" class="col-sm-2 col-form-label">Domingos</label>
                            <input type="text" class="form-control block-input" name="count-sunday" id="count-sunday" tabindex="-1" readonly>
                        </div>
                        <div class="col-md-1">
                            <label for="count-holidays" class="col-sm-2 col-form-label">Feriados</label>
                            <input type="text" class="form-control" name="count-holidays" id="count-holidays" oninput="this.value = this.value.replace(/[a-zA-Z]/g, '')">
                        </div>
                        <div class="col-md-1">
                            <label for="id-nomina" class="col-sm-2 col-form-label">Nómina</label>
                            <select class="form-select" name="id-nomina" id="id-nomina">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label for="id-ruta-edit" class="col-sm-2 col-form-label">Ruta</label>
                            <input type="text" class="form-control block-input" name="id-ruta" id="id-ruta" tabindex="-1" placeholder="Ori-Des" readonly>
                        </div>
                        <div class="col-md-1">
                            <label for="total-km" class="col-sm-2 col-form-label">KM</label>
                            <input type="text" class="form-control block-input" name="total-km" id="total-km" placeholder="KM" tabindex="-1" readonly>
                        </div>
                        <div class="col-md-1">
                            <label for="tasa-usd" class="col-sm-2 col-form-label">Tasa</label>
                            <input type="text" class="form-control block-input" name="tasa-usd" id="tasa-usd" tabindex="-1" readonly>
                        </div>
                        <div class="col-md-1">
                            <label for="total-usd" class="col-sm-2 col-form-label">USD</label>
                            <input type="text" class="form-control block-input" name="total-usd" id="total-usd" tabindex="-1" readonly>
                        </div>
                        <div class="col-md-1">
                            <label for="total-ves" class="col-sm-2 col-form-label">BSF</label>
                            <input type="text" class="form-control block-input" name="total-ves" id="total-ves" tabindex="-1" readonly>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="tile-body">
                    <div class="main-edit">
                        <h5>Agregar movimientos al viaje</h5>
                        <hr>
                    </div>
                    <div class="add-movements"></div>
                    <br>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" id="add-detail"> Agregar movimiento</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
