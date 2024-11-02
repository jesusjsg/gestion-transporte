<?php
namespace src\controllers;

use Exception;
use PDO;
use PDOException;
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
            $idViaje = $this->conection()->lastInsertId();
            return $this->successHandler(
                'redirect',
                'El viaje se ha registrado correctamente.',
                'Registro exitoso',
                URL . 'viaje/editar/' . $idViaje
            );
        } else {
            return $this->errorHandler('Hubo un problema al registrar el viaje.');
        }
    }

    public function tableViaje()
    {
        $getTableViajes = $this->executeQuery(
            "SELECT
                v.id_viaje,
                d.nombre_conductor,
                v.id_vehiculo,
                a.descripcion1 AS tipo_operacion,
                b.descripcion1 AS tipo_carga,
                v.aviso,
                c.descripcion1 AS cliente,
                v.id_ruta,
                v.fecha_inicio,
                v.fecha_cierre,
                v.nro_nomina
            FROM 
                viajes AS v
            INNER JOIN
                general AS a ON a.id_registro = 3 AND a.id_entidad = v.id_tipo_operacion
            INNER JOIN
                general AS b ON b.id_registro = 4 AND b.id_entidad = v.id_tipo_carga
            INNER JOIN
                general AS c ON c.id_registro = 7 AND c.id_entidad = v.id_cliente
            INNER JOIN
                conductores AS d ON d.id_conductor = v.id_conductor
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
                        <a href="'.URL.'viaje/editar/'.$row['id_viaje'].'/" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square m-0 p-0"></i></a>
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
    {
        try {
            $id = $this->cleanString($_POST['id-viaje']);

            $data = $this->executeQuery("SELECT * FROM viajes WHERE id_viaje = '$id'");
            if ($data->rowCount() <= 0) {
                return $this->errorHandler('No hemos encontrado el viaje en el sistema.');
            } else {
                $data = $data->fetch();
            }

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

            $viajeDataUpdate = [
                [
                    'field_name_database' => 'id_conductor',
                    'field_name_form' => 'ficha',
                    'field_value' => $fichaConductor,
                ],
                [
                    'field_name_database' => 'id_vehiculo',
                    'field_name_form' => 'placa',
                    'field_value' => $placaVehiculo,
                ],
                [
                    'field_name_database' => 'id_tipo_operacion',
                    'field_name_form' => 'operacion',
                    'field_value' => $tipoOperacion,
                ],
                [
                    'field_name_database' => 'id_tipo_carga',
                    'field_name_form' => 'carga',
                    'field_value' => $tipoCarga,
                ],
                [
                    'field_name_database' => 'aviso',
                    'field_name_form' => 'aviso',
                    'field_value' => $aviso,
                ],
                [
                    'field_name_database' => 'id_cliente',
                    'field_name_form' => 'cliente',
                    'field_value' => $idCliente,
                ],
                [
                    'field_name_database' => 'nro_nomina',
                    'field_name_form' => 'nomina',
                    'field_value' => $numeroNomina,
                ],
                [
                    'field_name_database' => 'fecha_inicio',
                    'field_name_form' => 'fechaInicio',
                    'field_value' => $fechaInicio,
                ],
                [
                    'field_name_database' => 'fecha_cierre',
                    'field_name_form' => 'fechaCierre',
                    'field_value' => $fechaCierre,
                ],
                [
                    'field_name_database' => 'sabados',
                    'field_name_form' => 'sabados',
                    'field_value' => $sabados,
                ],
                [
                    'field_name_database' => 'domingos',
                    'field_name_form' => 'domingos',
                    'field_value' => $domingos,
                ],
                [
                    'field_name_database' => 'feriados',
                    'field_name_form' => 'feriados',
                    'field_value' => $feriados,
                ]
            ];

            $condition = [
                'condition_field' => 'id_viaje',
                'condition_marker' => 'id_viaje',
                'condition_value' => $id
            ];

            if ($this->updateData('viajes', $viajeDataUpdate, $condition)) {
                return $this->successHandler(
                    'reload',
                    'El viaje ha sido actualizado correctamente.',
                    'Viaje actualizado',
                );
            } else {
                return $this->errorHandler('No se pudo actualizar el viaje.');
            }

        } catch (Exception $error) {
            error_log('Error al actualizar el viaje: ' . $error);
        }
    }

    public function deleteViaje()
    {
        try {
            $id = $this->cleanString($_POST['id-viaje']);

            $dataViaje = $this->executeQuery("SELECT * FROM viajes WHERE id_viaje = '$id'");
            if ($dataViaje->rowCount() <= 0) {
                return $this->errorHandler('El viaje no se encuentra registrado.');
            } else {
                $dataViaje = $dataViaje->fetch();
            }

            $deleteViaje = $this->deleteData('viajes', 'id_viaje', $id);

            if ($deleteViaje->rowCount() == 1) {
                return $this->successHandler(
                    'reload',
                    'El viaje ha sido eliminado.',
                    'Viaje eliminado',
                );
            } else {
                return $this->errorHandler('No se pudo eliminar el viaje.');
            }

        } catch (Exception $error) {
            error_log('Error al eliminar el viaje: ' . $error);
        }
    }

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
