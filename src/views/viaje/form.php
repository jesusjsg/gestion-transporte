<?php
    use src\helpers\components\Autocomplete;
use Symfony\Component\Console\Helper\FormatterHelper;

    $autocomplete = new Autocomplete();

    $registros = [
        'tipoOperacion' => 3,
        'tipoCarga' => 4,
    ];

    $tipoOperacion = $autocomplete->autocompleteSelect($registros['tipoOperacion']);
    $tipocarga = $autocomplete->autocompleteSelect($registros['tipoCarga']);

?>
<main class="app-content">
    <div class="app-title align-items-center">
        <a class="text-decoration-none btn btn-secondary btn-sm" href="<?= URL; ?>viaje/"><i class="bi bi-box-arrow-left me-1"></i>Salir</a>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3" method="" autocomplete="off">
                <div class="d-grid gap-2 d-md-flex justify-content-between align-items-center">
                    <h3 class="fw-light">Agregar viaje</h3>
                    <div>
                        <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                        <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                    </div>
                </div>
                <div class="tile-footer"></div>
                <div class="col-md-2">
                    <label for="nombre-conductor">Nombre y apellido</label>
                    <input type="text" class="form-control" name="nombre-conductor" id="nombre-conductor" />
                </div>
                <div class="col-md-1">
                    <label for="placa-vehiculo">Placa</label>
                    <input type="text" class="form-control" name="placa-vehiculo" id="placa-vehiculo" />
                </div>
                <div class="col-md-2">
                    <label for="operacion">Operación</label>
                    <select class="form-select" name="operacion" id="operacion">
                        <option selected disabled>Operación</option>
                            <?php
                                if(!empty($tipoOperacion)){
                                    foreach($tipoOperacion as $key){
                                        echo '<option value="'. $key['id_entidad'] .'">'. $key['descripcion1'] .'</option>';
                                    }
                                } else {
                                    echo '<option disabled>No hay datos registrados</option>';
                                }
                            ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="carga">Carga</label>
                    <select class="form-select" name="carga" id="carga">
                        <option selected disabled>Carga</option>
                        <?php
                            if(!empty($tipocarga)){
                                foreach($tipocarga as $key){
                                    echo '<option value="'. $key['id_entidad'] .'">'. $key['descripcion1'] .'</option>';
                                }
                            } else {
                                echo '<option disabled>No hay datos registrados</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <label for="aviso">Aviso</label>
                    <input type="text" class="form-control" name="aviso" id="aviso" />
                </div>
                <div class="col-md-3">
                    <label for="cliente">Cliente</label>
                    <input type="text" class="form-control" name="cliente" id="cliente" />
                </div>
                <div class="col-md-1">
                    <label for="codigo-ruta">Ruta</label>
                    <input type="text" class="form-control" name="codigo-ruta" id="codigo-ruta" />
                </div>
                <div class="col-md-2">
                    <label for="fecha-inicio">Inicio</label>
                    <input type="date" class="form-control" name="fecha-inicio" id="fecha-inicio" />
                </div>
                <div class="col-md-2">
                    <label for="fecha-cierre">Cierre</label>
                    <input type="date" class="form-control" name="fecha-cierre" id="fecha-cierre" />
                </div>
                <div class="col-md-1">
                    <label for="cantidad-sabados">Sabados</label>
                    <input type="number" min="0" class="form-control" name="cantidad-sabados" id="cantidad-sabados" />
                </div>
                <div class="col-md-1">
                    <label for="cantidad-domingos">Domingos</label>
                    <input type="number" min="0" class="form-control" name="cantidad-domingos" id="cantidad-domingos">
                </div>
                <div class="col-md-1">
                    <label for="cantidad-feriados">Feriados</label>
                    <input type="number" min="0" class="form-control" name="cantidad-feriados" id="cantidad-feriados" />
                </div>
                <div class="col-md-1">
                    <label for="tasa-cambio">Tasa</label>
                    <input type="text" class="form-control" name="tasa-cambio" id="tasa-cambio" />
                </div>
                <div class="col-md-1">
                    <label for="monto-usd">USD</label>
                    <input type="text" class="form-control" name="monto-usd" id="monto-usd" />
                </div>
                <div class="col-md-1">
                    <label for="monto-ves">VES</label>
                    <input type="text" class="form-control" name="monto-ves" id="monto-ves" />
                </div>
                <div class="col-md-1">
                    <label for="total-kilometros">KM</label>
                    <input type="text" class="form-control" name="total-kilometros" id="total-kilometros" />
                </div>
                <div class="tile-footer"></div>
            </form>
        </div>
    </div>
    <div class="tile">
        <div class="tile-body">
            <form class="row g-3" method="" autocomplete="off">
                <div class="d-grid gap-2 d-md-flex justify-content-between align-items-center">
                    <h3 class="fw-light">Agregar detalle</h3>
                    <div>
                        <button type="reset" class="btn btn-primary btn-sm">Limpiar<i class="bi bi-archive ms-1"></i></button>
                        <button type="submit" class="btn btn-success btn-sm">Guardar<i class="bi bi-floppy ms-1"></i></button>
                    </div>
                </div>
                <div class="tile-footer"></div>
                <!-- <div class="tile-footer"></div>
                <div class="col-md-3">
                    <label for="origen">Origen</label>
                    <input type="text" class="form-control" name="origen" id="origen" />
                </div>
                <div class="col-md-3">
                    <label for="destino">Destino</label>
                    <input type="text" class="form-control" name="destino" id="destino" />
                </div>
                <div class="col-md-1">
                    <label for="ruta">Ruta</label>
                    <input type="text" class="form-control" name="ruta" id="ruta" />
                </div>
                <div class="col-md-1">
                    <label for="kilometros">KM</label>
                    <input type="text" class="form-control" name="kilometros" id="kilometros" />
                </div> -->
                <div class="tile-footer"></div>
            </form>
        </div>
    </div>
</main>
