<?php

namespace src\controllers;

use PDO;
use src\models\uniqueModel;

class vehiculoController extends uniqueModel
{

    public function registerVehiculo()
    {
        $placa = $this->cleanString($_POST['placa']);
        $tipoVehiculo = $this->cleanString($_POST['tipo-vehiculo']);
        $propiedad = $this->cleanString($_POST['propiedad']);
        $unidadNegocio = $this->cleanString($_POST['unidad-negocio']);
        $marca = $this->cleanString($_POST['marca-vehiculo']);
        $modelo = $this->cleanString($_POST['modelo-vehiculo']);
        $year = $this->cleanString($_POST['year-vehiculo']);
        $serialCarroceria = $this->cleanString($_POST['serial-carroceria']);
        $serialMotor = $this->cleanString($_POST['serial-motor']);
        $numeroEjes = $this->cleanString($_POST['numero-ejes']);
        $capacidadCarga = $this->cleanString($_POST['capacidad-carga']);
        $uso = $this->cleanString($_POST['uso-vehiculo']);
        $vencimientoPoliza = $this->cleanString($_POST['vencimiento-poliza']);
        $vencimientoRacda = $this->cleanString($_POST['vencimiento-racda']);
        $vencimientoSanitario = $this->cleanString($_POST['vencimiento-sanitario']);
        $vencimientoRotc = $this->cleanString($_POST['vencimiento-rotc']);
        $fechaFumigacion = $this->cleanString($_POST['fecha-fumigacion']);
        $fechaImpuestos = $this->cleanString($_POST['fecha-impuestos']);
        $bolipuertos = $this->cleanString($_POST['bolipuertos']);
        $gps = $this->cleanString($_POST['gps']);
        $linkGps = $this->cleanString($_POST['link-gps']);
        $estatus = $this->cleanString($_POST['estatus-vehiculo']);
        $municipio = $this->cleanString($_POST['id-municipio']);
        $activoSapUno = $this->cleanString($_POST['activo-uno']);
        $activoSapDos = $this->cleanString($_POST['activo-dos']);
        $activoSapTres = $this->cleanString($_POST['activo-tres']);

        // Validaciones de los campos de tipo texto
        if (empty($placa) || empty($tipoVehiculo) || empty($serialCarroceria) || empty($serialMotor) || empty($modelo)) {
            $alert = [
                'type' => 'simple',
                'icon' => 'error',
                'title' => 'Ocurrió un error',
                'text' => 'Todos los campos son obligatorios.',
            ];
            return json_encode($alert);
        }

        if ($this->verifyData('[A-Za-z0-9]{7,8}', $placa)) {
            $alert = [
                'type' => 'simple',
                'icon' => 'error',
                'title' => 'Ocurrió un error',
                'text' => 'La placa solo puede contener números con un rango de 7 a 8 digitos.',
            ];
            return json_encode($alert);
        }

        $checkPlaca = $this->executeQuery("SELECT id_vehiculo FROM vehiculos WHERE id_vehiculo = '$placa'");
        if ($checkPlaca->rowCount() > 0) {
            $alert = [
                'type' => 'simple',
                'icon' => 'error',
                'title' => 'Ocurrió un error',
                'text' => 'La placa del vehículo se encuentra registrada.',
            ];
            return json_encode($alert);
        };

        $vehiculoDataLog = [
            [
                'field_name_database' => 'id_vehiculo',
                'field_name_form' => ':placa',
                'field_value' => $placa,
            ],
            [
                'field_name_database' => 'tipo_vehiculo',
                'field_name_form' => ':tipoVehiculo',
                'field_value' => $tipoVehiculo,
            ],
            [
                'field_name_database' => 'propiedad',
                'field_name_form' => ':propiedad',
                'field_value' => $propiedad,
            ],
            [
                'field_name_database' => 'unidad_negocio',
                'field_name_form' => ':unidadNegocio',
                'field_value' => $unidadNegocio,
            ],
            [
                'field_name_database' => 'marca',
                'field_name_form' => ':marca',
                'field_value' => $marca,
            ],
            [
                'field_name_database' => 'modelo',
                'field_name_form' => ':modelo',
                'field_value' => $modelo,
            ],
            [
                'field_name_database' => 'year_vehiculo',
                'field_name_form' => ':year',
                'field_value' => $year,
            ],
            [
                'field_name_database' => 'serial_carroceria',
                'field_name_form' => ':serialCarroceria',
                'field_value' => $serialCarroceria,
            ],
            [
                'field_name_database' => 'serial_motor',
                'field_name_form' => ':serialMotor',
                'field_value' => $serialMotor,
            ],
            [
                'field_name_database' => 'numero_ejes',
                'field_name_form' => ':numeroEjes',
                'field_value' => $numeroEjes,
            ],
            [
                'field_name_database' => 'capacidad_carga',
                'field_name_form' => ':capacidadCarga',
                'field_value' => $capacidadCarga,
            ],
            [
                'field_name_database' => 'uso',
                'field_name_form' => ':uso',
                'field_value' => $uso,
            ],
            [
                'field_name_database' => 'vencimiento_poliza',
                'field_name_form' => ':vencimientoPoliza',
                'field_value' => $vencimientoPoliza,
            ],
            [
                'field_name_database' => 'vencimiento_racda',
                'field_name_form' => ':vencimientoRacda',
                'field_value' => $vencimientoRacda,
            ],
            [
                'field_name_database' => 'vencimiento_sanitario',
                'field_name_form' => ':vencimientoSanitario',
                'field_value' => $vencimientoSanitario,
            ],
            [
                'field_name_database' => 'vencimiento_rotc',
                'field_name_form' => ':vencimientoRotc',
                'field_value' => $vencimientoRotc,
            ],
            [
                'field_name_database' => 'fecha_fumigacion',
                'field_name_form' => ':fechaFumigacion',
                'field_value' => $fechaFumigacion,
            ],
            [
                'field_name_database' => 'fecha_impuesto',
                'field_name_form' => ':fechaImpuestos',
                'field_value' => $fechaImpuestos,
            ],
            [
                'field_name_database' => 'bolipuertos',
                'field_name_form' => ':bolipuertos',
                'field_value' => $bolipuertos,
            ],
            [
                'field_name_database' => 'gps',
                'field_name_form' => ':gps',
                'field_value' => $gps,
            ],
            [
                'field_name_database' => 'link_gps',
                'field_name_form' => ':linkGps',
                'field_value' => $linkGps,
            ],
            [
                'field_name_database' => 'estatus_vehiculo',
                'field_name_form' => ':estatus',
                'field_value' => $estatus,
            ],
            [
                'field_name_database' => 'id_municipio',
                'field_name_form' => ':municipio',
                'field_value' => $municipio,
            ],
            [
                'field_name_database' => 'activo_uno',
                'field_name_form' => ':sap1',
                'field_value' => $activoSapUno,
            ],
            [
                'field_name_database' => 'activo_dos',
                'field_name_form' => ':sap2',
                'field_value' => $activoSapDos,
            ],
            [
                'field_name_database' => 'activo_tres',
                'field_name_form' => ':sap3',
                'field_value' => $activoSapTres,
            ],
        ];

        $saveVehiculo = $this->saveData('vehiculos', $vehiculoDataLog);

        if ($saveVehiculo->rowCount() == 1) {
            $alert = [
                'type' => 'reload',
                'icon' => 'success',
                'title' => 'Registro exitoso',
                'text' => 'El vehículo (' . $placa . ') se registró correctamente.',
            ];
        } else {
            $alert = [
                'type' => 'simple',
                'icon' => 'error',
                'title' => 'Ocurrió un error',
                'text' => 'Hubo un problema al registrar el vehículo.',
            ];
        }
        return json_encode($alert);
    }

    public function tableVehiculo()
    {
        $getTableVehiculo = $this->executeQuery(
            "SELECT
                    vehiculos.id_vehiculo,
                    vehiculos.tipo_vehiculo,
                    vehiculos.propiedad,
                    vehiculos.marca,
                    vehiculos.uso,
                    vehiculos.estatus_vehiculo,
                    tipoVehiculo.descripcion1 AS tipo_vehiculo,
                    propiedad.descripcion1 AS propiedad,
                    marca.descripcion1 AS marca,
                    usoVehiculo.descripcion1 AS uso
                FROM vehiculos
                LEFT JOIN
                    general AS tipoVehiculo ON vehiculos.tipo_vehiculo = tipoVehiculo.id_entidad AND tipoVehiculo.id_registro = 9
                LEFT JOIN
                    general AS propiedad ON vehiculos.propiedad = propiedad.id_entidad AND propiedad.id_registro = 10
                LEFT JOIN
                    general AS marca ON vehiculos.marca = marca.id_entidad AND marca.id_registro = 12
                LEFT JOIN
                    general AS usoVehiculo ON vehiculos.uso = usoVehiculo.id_entidad AND usoVehiculo.id_registro = 14
                "
        );
        $data = [];

        $dateColumns = [
            'vencimiento_poliza',
            'vencimiento_racda',
            'vencimiento_sanitario',
            'vencimiento_rotc',
            'fecha_fumigacion',
            'fecha_impuesto',
        ];

        if ($getTableVehiculo->rowCount() > 0) {
            while ($row = $getTableVehiculo->fetch(PDO::FETCH_ASSOC)) {
                foreach ($dateColumns as $column) {
                    if (!empty($row[$column])) {
                        $row[$column] = $this->formatDate($row[$column]);
                    }
                }

                foreach ($row as $key => $value) {
                    if (empty($value)) {
                        $row[$key] = '<span class="badge text-bg-secondary">No definido</span>';
                    }
                }

                if ($row['estatus_vehiculo'] == 1) {
                    $row['estatus_vehiculo'] = '<span class="badge bg-success text-bg-success">Activo</span>';

                } elseif ($row['estatus_vehiculo'] == 2) {
                    $row['estatus_vehiculo'] = '<span class="badge bg-danger text-bg-danger">Inactivo</span>';
                }

                $row['opciones'] = '
                        <form class="form-ajax d-inline" action="' . URL . 'ajax/vehiculo" method="post" autocomplete="off">
                            <input type="hidden" name="model_vehiculo" value="delete" />
                            <input type="hidden" name="id-vehiculo" value="' . $row['id_vehiculo'] . '" />
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

    public function updateVehiculo()
    {}

    public function deleteVehiculo()
    {
        $idVehiculo = $this->cleanString($_POST['id-vehiculo']);

        $dataVehiculo = $this->executeQuery("SELECT * FROM vehiculos WHERE id_vehiculo='$idVehiculo'");
        if ($dataVehiculo->rowCount() <= 0) {
            $alert = [
                'type' => 'simple',
                'icon' => 'error',
                'title' => 'Ocurrió un error',
                'text' => 'No hemos encontrado el vehículo en el sistema.',
            ];
            return json_encode($alert);
        } else {
            $dataVehiculo = $dataVehiculo->fetch();
        }

        $deteleVehiculo = $this->deleteData('vehiculos', 'id_vehiculo', $idVehiculo);
        if ($deteleVehiculo->rowCount() == 1) {
            $alert = [
                'type' => 'reload',
                'icon' => 'success',
                'title' => 'Vehículo eliminado',
                'text' => 'El vehículo ' . $dataVehiculo['id_vehiculo'] . ' ha sido eliminado.',
            ];
        } else {
            $alert = [
                'type' => 'simple',
                'icon' => 'error',
                'title' => 'Ocurrió un error',
                'text' => 'No se pudo eliminar el conductor ' . $dataVehiculo['id_vehiculo'] . ', intente más tarde.',
            ];
        }
        return json_encode($alert);
    }

    public function getPlaca($term) 
    {
        $term = '%' . $term . '%';
        $sql = "
            SELECT id_vehiculo
            FROM vehiculos
            WHERE estatus_vehiculo = 1
            AND id_vehiculo
            LIKE :term
            ORDER BY id_vehiculo ASC 
            LIMIT 5
        ";
        
        $suggetions = $this->executeQuery($sql, [':term' => $term]);
        $data = [];

        if ($suggetions->rowCount() > 0) {
            while ($row = $suggetions->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
        }
        return json_encode($data);
    }

    public function totalVehiculos()
    {
        $sql = $this->executeQuery("SELECT COUNT(*) AS total FROM vehiculos");
        $totalVehiculos = $sql->fetchColumn();
        return $totalVehiculos;
    }

}
