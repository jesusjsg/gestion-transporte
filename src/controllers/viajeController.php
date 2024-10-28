<?php
namespace src\controllers;

use Exception;
use PDO;
use src\models\uniqueModel;

class viajeController extends uniqueModel
{

    public function registerViaje()
    {
        $fichaConductor = trim($this->cleanString($_POST['ficha-conductor']));
        $idCliente = trim($this->cleanString($_POST['codigo-cliente']));
        $placaVehiculo = trim($this->cleanString($_POST['placa-vehiculo']));
        $tipoOperacion = $this->cleanString($_POST['tipo-operacion']);
        $tipoCarga = $this->cleanString($_POST['tipo-carga']);
        $aviso = $this->cleanString($_POST['aviso']);
        $fechaInicio = $this->cleanString($_POST['fecha-inicio']);
        $fechaCierre = $this->cleanString($_POST['fecha-cierre']);
        $numeroNomina = $this->cleanString($_POST['numero-nomina']);
        $feriados = trim($this->cleanString($_POST['cantidad-feriados']));
        $sabados = $this->cleanString($_POST['cantidad-sabados']);
        $domingos = $this->cleanString($_POST['cantidad-domingos']);
        $tasaCambio = $this->cleanString($_POST['tasa-cambio']);

        if (empty($fichaConductor)) {
            return $this->errorHandler('El nombre del conductor es obligatorio.');
        }

        if (empty($placaVehiculo)) {
            return $this->errorHandler('La placa del vehículo es obligatoria.');
        }

        if (empty($idCliente)) {
            return $this->errorHandler('El cliente es obligatorio.');
        }

        $viajeDataLog = [
            [
                'field_name_database' => 'id_conductor',
                'field_name_form' => ':ficha',
                'field_value' => $fichaConductor,
            ],
            [
                'field_name_database' => 'id_vehiculo',
                'field_name_form' => ':placa',
                'field_value' => $placaVehiculo,
            ],
            [
                'field_name_database' => 'id_tipo_operacion',
                'field_name_form' => ':operacion',
                'field_value' => $tipoOperacion,
            ],
            [
                'field_name_database' => 'id_tipo_carga',
                'field_name_form' => ':carga',
                'field_value' => $tipoCarga,
            ],
            [
                'field_name_database' => 'aviso',
                'field_name_form' => ':aviso',
                'field_value' => $aviso,
            ],
            [
                'field_name_database' => 'id_cliente',
                'field_name_form' => ':cliente',
                'field_value' => $idCliente,
            ],
            [
                'field_name_database' => 'nro_nomina',
                'field_name_form' => ':nomina',
                'field_value' => $numeroNomina,
            ],
            [
                'field_name_database' => 'fecha_inicio',
                'field_name_form' => ':fechaInicio',
                'field_value' => $fechaInicio,
            ],
            [
                'field_name_database' => 'fecha_cierre',
                'field_name_form' => ':fechaCierre',
                'field_value' => $fechaCierre,
            ],
            [
                'field_name_database' => 'sabados',
                'field_name_form' => ':sabados',
                'field_value' => $sabados,
            ],
            [
                'field_name_database' => 'domingos',
                'field_name_form' => ':domingos',
                'field_value' => $domingos,
            ],
            [
                'field_name_database' => 'feriados',
                'field_name_form' => ':feriados',
                'field_value' => $feriados,
            ]
        ];

        $saveViaje = $this->saveData('viajes', $viajeDataLog);

        if ($saveViaje->rowCount() == 1) {
            return $this->successHandler('simple', 'El viaje ha sido registrado correctamente.');
        } else {
            return $this->errorHandler('Hubo un problema al registrar el viaje.');
        }
    }

    public function tableViaje()
    {
        $getTableViajes = $this->executeQuery(
            "SELECT
                conductor.nombre_conductor,
                viajes.id_vehiculo,
                operacion.descripcion1 AS id_tipo_operacion,
                carga.descripcion1 AS id_tipo_carga,
                viajes.aviso,
                cliente.descripcion1 AS id_cliente,
                ruta.nombre_ruta,
                viajes.fecha_inicio,
                viajes.fecha_cierre,
                viajes.sabados,
                viajes.domingos,
                viajes.feriados,
                viajes.nro_nomina,
                viajes.tasa_cambio
            FROM viajes
            LEFT JOIN
                general AS operacion ON viajes.id_tipo_operacion = operacion.id_entidad AND operacion.id_registro = 3
            LEFT JOIN
                general AS carga ON viajes.id_tipo_carga = carga.id_entidad AND carga.id_registro = 4
            LEFT JOIN
                general AS cliente ON viajes.id_cliente = cliente.id_entidad AND cliente.id_registro = 7
            INNER JOIN
                rutas AS ruta ON viajes.id_ruta = ruta.id_ruta
            INNER JOIN
                conductores AS conductor ON viajes.id_conductor = conductor.id_conductor
            "
        );

        $data = [];
        $dateColumns = [
            'fecha_inicio',
            'fecha_cierre',
        ];

        if ($getTableViajes->rowCount() > 0) {
            while ($row = $getTableViajes->fetch(PDO::FETCH_ASSOC)) {
                foreach ($dateColumns as $date) {
                    if (!empty($row[$date])) {
                        $row[$date] = $this->formatDate($row[$date]);
                    }
                }

                foreach ($row as $key => $value) {
                    if (empty($value)) {
                        $row[$key] = '<span class="badge text-bg-secondary">No definido</span>'; 
                    }
                }

                $row['opciones'] = '
                        <a href="'.URL.'viajes/editar/'.$row['id_viaje'].'/" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square m-0 p-0"></i></a>
                        <form class="form-ajax d-inline" action="'.URL.'ajax/viaje" method="post" autocomplete="off">
                            <input type="hidden" name="model_viaje" value="delete" />
                            <input type="hidden" name="id-viaje" value="'.$row['id_viaje'].'" />
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash3 m-0 p-0"></i>
                            </button>
                        </form>
                    ';
                $data[] = $row;
            }
        }
        return json_encode($data);
    }

    public function updateViaje()
    {}

    public function deleteViaje()
    {}

    public function totalViajes()
    {
        try {
            $sql = $this->executeQuery("SELECT COUNT(*) AS total FROM viajes");
            $totalViajes = $sql->fetchColumn();
            return $totalViajes;

        } catch (Exception $error) {

        }
    }
}
