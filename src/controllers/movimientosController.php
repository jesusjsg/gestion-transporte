<?php

namespace src\controllers;

use PDO;
use Exception;
use src\controllers\generalController;
use src\models\doubleModel;

class movimientosController extends doubleModel
{
    public function registerMovimientos()
    {
        $numeroViaje = $this->cleanString($_POST['nro-viaje']);
        $tasaCambio = $this->cleanString($_POST['tasa-cambio']);
        $numeroMovimientos = $_POST['nro-movimiento'];
        $codigoRutas = $_POST['codigo-ruta'];
        $origenes = $_POST['id-origen'];
        $destinos = $_POST['id-destino'];
        $kilometrosMovimientos = $_POST['kilometros-movimiento'];

        if (count($codigoRutas) !== count($kilometrosMovimientos)) {
            return $this->errorHandler('La cantidad de rutas y kilómetros no coincide.');
        }

        $totalKilometros = 0;

        foreach ($codigoRutas as $index => $codigoRuta) {
            $origen = $this->cleanString($origenes[$index]);
            $destino = $this->cleanString($destinos[$index]);
            $numeroMovimiento = $this->cleanString($numeroMovimientos[$index]);
            $kilometrosMovimiento = $this->cleanString($kilometrosMovimientos[$index]);

            $existsCondition = [
                [
                    'condition_field' => 'id_viaje',
                    'condition_marker' => 'id_viaje',
                    'condition_value' => $numeroViaje,
                ],
                [
                    'condition_field' => 'id_movimiento',
                    'condition_marker' => 'id_movimiento',
                    'condition_value' => $numeroMovimiento,
                ]
            ];
    
            $existsQuery = $this->checkExists('movimientos', $existsCondition);
    
            if ($existsQuery) {
                // Actualizar si ya existe
                $updateDataLog = [
                    [
                        'field_name_database' => 'id_ruta',
                        'field_name_form' => 'id_ruta',
                        'field_value' => $codigoRuta,
                    ],
                    [
                        'field_name_database' => 'movimientos_km',
                        'field_name_form' => 'km',
                        'field_value' => $kilometrosMovimiento,
                    ],
                    [
                        'field_name_database' => 'origen',
                        'field_name_form' => 'origen',
                        'field_value' => $origen,
                    ],
                    [
                        'field_name_database' => 'destino',
                        'field_name_form' => 'destino',
                        'field_value' => $destino,
                    ]
                ];
    
                $updateMovimientos = $this->updateData('movimientos', $updateDataLog, $existsCondition);
    
                if (!$updateMovimientos) {
                    return $this->errorHandler('Hubo un problema al actualizar los movimientos.');
                }
            } else {
                    // Insertar si no existe
                $insertDataLog = [
                    [
                        'field_name_database' => 'id_viaje',
                        'field_name_form' => ':id_viaje',
                        'field_value' => $numeroViaje,
                    ],
                    [
                        'field_name_database' => 'id_movimiento',
                        'field_name_form' => ':id_movimiento',
                        'field_value' => $numeroMovimiento,
                    ],
                    [
                        'field_name_database' => 'id_ruta',
                        'field_name_form' => ':id_ruta',
                        'field_value' => $codigoRuta,
                    ],
                    [
                        'field_name_database' => 'movimientos_km',
                        'field_name_form' => ':km',
                        'field_value' => $kilometrosMovimiento,
                    ],
                    [
                        'field_name_database' => 'origen',
                        'field_name_form' => ':origen',
                        'field_value' => $origen,
                    ],
                    [
                        'field_name_database' => 'destino',
                        'field_name_form' => ':destino',
                        'field_value' => $destino,
                    ]
                ];

                $insertMovimientos = $this->saveData('movimientos', $insertDataLog);

                if ($insertMovimientos->rowCount() !== 1) {
                    return $this->errorHandler('Hubo un problema al registrar los movimientos.');
                }
            }

            $totalKilometros += $kilometrosMovimiento;
        }
        // Actualizar datos del viaje
        $montoUsd = $this->getUsd($totalKilometros);
        $montoVes = $this->getVes($montoUsd, $tasaCambio);

        $viajeUpdateLog = [
            [
                'field_name_database' => 'total_kilometros',
                'field_name_form' => 'totalKm',
                'field_value' => $totalKilometros,
            ],
            [
                'field_name_database' => 'monto_usd',
                'field_name_form' => 'monto_usd',
                'field_value' => $montoUsd,
            ],
            [
                'field_name_database' => 'monto_ves',
                'field_name_form' => 'monto_ves',
                'field_value' => $montoVes,
            ]
        ];

        $condition = [
            [
                'condition_field' => 'id_viaje',
                'condition_marker' => 'id_viaje',
                'condition_value' => $numeroViaje,
            ]
        ];

        if ($this->updateData('viajes', $viajeUpdateLog, $condition)) {
            return $this->successHandler(
                'reload',
                'Los movimientos se registraron/actualizaron correctamente.'
            );
        } else {
            return $this->errorHandler('Hubo un problema al registrar los movimientos.');
        }
    }


    public function tableMovimientos()
    {
        $municipio = new generalController();
        $idViaje = isset($_GET['id_viaje']) ? intval($_GET['id_viaje']) : null;

        if ($idViaje === null) {
            return json_encode(['error' => 'ID del viaje no especificado']);
        }

        $query = 
            "SELECT
                m.id_viaje,
                m.id_movimiento,
                m.id_ruta,
                m.movimientos_km,
                m.origen,
                m.destino
            FROM
                movimientos AS m
            WHERE
                m.id_viaje = :id_viaje";

        $getTableMovimientos = $this->executeQuery($query, ['id_viaje' => $idViaje]);

        $data = [];
        $count = 1;

        if ($getTableMovimientos->rowCount() > 0) {
            while ($row = $getTableMovimientos->fetch(PDO::FETCH_ASSOC)) {
                $row['input_html'] = '
                    <tr>
                        <td></td>
                        <td>'.$count.'
                            <input type="hidden" name="nro-movimiento[]" value="'.$count.'" />
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm origen" name="origen[]" id="origen-'.$count.'" value="'.$municipio->getMunicipioById($row['origen']).'"/>
                            <input type="hidden" class="id-origen" name="id-origen[]" id="id-origen-'.$count.'" value="'.$row['origen'].'" />
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm destino" name="destino[]" id="destino-'.$count.'" value="'.$municipio->getMunicipioById($row['destino']).'" />
                            <input type="hidden" class="id-destino" name="id-destino[]" id="id-destino-'.$count.'" value="'.$row['destino'].'" />
                        </td>
                        <td><input type="text" class="form-control form-control-sm codigo-ruta block-input" name="codigo-ruta[]" id="id-ruta-'.$count.'" readOnly /></td>
                        <td><input type="text" class="form-control form-control-sm block-input" name="kilometros-movimiento[]" id="kilometros-movimiento-'.$count.'" readOnly /></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="bi bi-x-lg m-0 p-0"></i></button></td>
                    </tr>';
                $count++;
                $data[] = $row;
            }
        }
        return json_encode(['data' => $data]);
    }

    public function updateMovimientos()
    {
        $numeroViaje = $this->cleanString($_POST['nro-viaje']);
        $tasaCambio = $this->cleanString($_POST['tasa-cambio']);
        $numeroMovimientos = $_POST['nro-movimiento'];
        $codigoRutas = $_POST['codigo-ruta'];
        $origenes = $_POST['id-origen'];
        $destinos = $_POST['id-destino'];
        $kilometrosMovimientos = $_POST['kilometros-movimiento'];

        if (count($codigoRutas) !== count($kilometrosMovimientos)) {
            return $this->errorHandler('La cantidad de rutas y kilómetros no coincide.');
        }
    }

    public function deleteMovimientos()
    {
        
    }

    public function getUsd($kilometros)
    {
        try {
            $query = "
            SELECT 
                CAST(descripcion1 AS UNSIGNED) AS inicial,
                CAST(descripcion2 AS UNSIGNED) AS limite,
                valor
            FROM general
            WHERE id_registro = 1
            AND id_entidad > 0
            AND :kilometros BETWEEN CAST(descripcion1 AS UNSIGNED) AND CAST(descripcion2 AS UNSIGNED)
            LIMIT 1
            ";

            $result = $this->executeQuery($query, [':kilometros' => $kilometros]);

            if ($result->rowCount() > 0) {
                return $result->fetch(PDO::FETCH_ASSOC)['valor'];
            }

        } catch (Exception $error) {
            error_log('Error al obtener los usd: ' . $error);
        }
    }

    public function getVes($montoUsd, $tasa)
    {
        return number_format($montoUsd * $tasa, 2);
    }

}
