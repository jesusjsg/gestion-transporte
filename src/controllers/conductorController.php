<?php

namespace src\controllers;

use PDO;
use Exception;
use src\models\uniqueModel;

class conductorController extends uniqueModel
{

    public function registerConductor()
    {
        $ficha = $this->cleanString($_POST['ficha-conductor']);
        $fullname = $this->cleanString($_POST['name-conductor']);
        $cedula = $this->cleanString($_POST['cedula-conductor']);
        $telefono = $this->cleanString($_POST['phone-conductor']);
        $placa = $this->cleanString($_POST['vehiculo-conductor']);
        $vencimientoCedula = $this->cleanString($_POST['vencimiento-cedula']);
        $vencimientoLicencia = $this->cleanString($_POST['vencimiento-licencia']);
        $vencimientoCertificadoMedico = $this->cleanString($_POST['vencimiento-medico']);
        $vencimientoMppps = $this->cleanString($_POST['vencimiento-mppps']);
        $vencimientoSaberes = $this->cleanString($_POST['vencimiento-saberes']);
        $vencimientoManejoSeguro = $this->cleanString($_POST['vencimiento-seguro']);
        $vencimientoAlimento = $this->cleanString($_POST['vencimiento-alimento']);
        $tipoNomina = $this->cleanString($_POST['tipo-nomina']);

        if (empty($ficha) || empty($fullname) || empty($cedula) || empty($telefono) || empty($placa)) {
            return $this->errorHandler('Todos los campos son obligatorios.');
        }

        if ($this->verifyData('^[0-9]{8}$', $ficha)) {
            return $this->errorHandler('La ficha del conductor solo puede contener números.');
        }

        if ($this->verifyData('^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{10,255}$', $fullname)) {
            return $this->errorHandler('El nombre y apellido solo puede contener caracteres.');
        }

        if ($this->verifyData('^[0-9]{8}$', $cedula)) {
            return $this->errorHandler('La cédula del conductor solo puede contener números.');
        }

        if ($this->verifyData('^[0-9]{11}$', $telefono)) {
            return $this->errorHandler('El teléfono del conductor solo puede contener números.');
        }

        $checkConductor = $this->executeQuery("SELECT id_conductor FROM conductores WHERE id_conductor = '$ficha'");
        $checkCedula = $this->executeQuery("SELECT cedula_conductor FROM conductores WHERE cedula_conductor = '$cedula'");

        if ($checkConductor->rowCount() > 0) {
            return $this->errorHandler('El conductor ya se encuentra registrado.');
        }

        if ($checkCedula->rowCount() > 0) {
            return $this->errorHandler('La cédula ya se encuentra registrada.');
        }

        $conductorDataLog = [
            [
                'field_name_database' => 'id_conductor',
                'field_name_form' => ':ficha',
                'field_value' => $ficha,
            ],
            [
                'field_name_database' => 'nombre_conductor',
                'field_name_form' => ':fullname',
                'field_value' => ucwords($fullname),
            ],
            [
                'field_name_database' => 'cedula_conductor',
                'field_name_form' => ':cedula',
                'field_value' => $cedula,
            ],
            [
                'field_name_database' => 'telefono_conductor',
                'field_name_form' => ':telefono',
                'field_value' => $telefono,
            ],
            [
                'field_name_database' => 'id_vehiculo',
                'field_name_form' => ':placa',
                'field_value' => $placa,
            ],
            [
                'field_name_database' => 'vencimiento_cedula',
                'field_name_form' => ':vencimientoCedula',
                'field_value' => $vencimientoCedula,
            ],
            [
                'field_name_database' => 'vencimiento_licencia',
                'field_name_form' => ':vencimientoLicencia',
                'field_value' => $vencimientoLicencia,
            ],
            [
                'field_name_database' => 'vencimiento_certificado_medico',
                'field_name_form' => ':vencimientoCertificadoMedico',
                'field_value' => $vencimientoCertificadoMedico,
            ],
            [
                'field_name_database' => 'vencimiento_mppps',
                'field_name_form' => ':vencimientoMppps',
                'field_value' => $vencimientoMppps,
            ],
            [
                'field_name_database' => 'vencimiento_saberes',
                'field_name_form' => ':vencimientoSaberes',
                'field_value' => $vencimientoSaberes,
            ],
            [
                'field_name_database' => 'vencimiento_manejo_seguro',
                'field_name_form' => ':vencimientoManejoSeguro',
                'field_value' => $vencimientoManejoSeguro,
            ],
            [
                'field_name_database' => 'vencimiento_alimento',
                'field_name_form' => ':vencimientoAlimento',
                'field_value' => $vencimientoAlimento,
            ],
            [
                'field_name_database' => 'tipo_nomina',
                'field_name_form' => ':tipoNomina',
                'field_value' => $tipoNomina,
            ],
        ];

        $saveConductor = $this->saveData('conductores', $conductorDataLog);

        if ($saveConductor->rowCount() == 1) {
            return $this->successHandler('reload', 'El conductor ' . ucwords($fullname) . ' ha sido registrado correctamente.');
        } else {
            return $this->errorHandler('Hubo un problema al registrar el conductor.');
        }
    }

    public function tableConductor()
    {

        $getTableConductor = $this->executeQuery(
            "SELECT
                    conductores.id_conductor,
                    conductores.nombre_conductor,
                    conductores.cedula_conductor,
                    conductores.telefono_conductor,
                    conductores.id_vehiculo,
                    conductores.tipo_nomina,
                    tipoNomina.descripcion1 AS tipo_nomina
                FROM conductores
                LEFT JOIN
                    general AS tipoNomina ON conductores.tipo_nomina = tipoNomina.id_entidad AND tipoNomina.id_registro = 6
                "
        );
        $data = [];

        $dateColumns = [
            'vencimiento_cedula',
            'vencimiento_licencia',
            'vencimiento_certificado_medico',
            'vencimiento_mppps',
            'vencimiento_saberes',
            'vencimiento_manejo_seguro',
            'vencimiento_alimento',
        ];

        if ($getTableConductor->rowCount() > 0) {
            while ($row = $getTableConductor->fetch(PDO::FETCH_ASSOC)) {
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
                $row['opciones'] = '
                        <a href="'.URL.'conductor/editar/'.$row['id_conductor'].'/" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square m-0 p-0"></i></a>
                        <form class="form-ajax d-inline" action="' . URL . 'ajax/conductor" method="post" autocomplete="off">
                            <input type="hidden" name="model_conductor" value="delete" />
                            <input type="hidden" name="id-conductor" value="' . $row['id_conductor'] . '" />
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

    public function updateConductor()
    {
        $conductorId = $this->cleanString($_POST['id-conductor']);

        $data = $this->executeQuery("SELECT * FROM conductores WHERE id_conductor='$conductorId'");

        if ($data->rowCount() <= 0) {
            return $this->errorHandler('No hemos encontrado el conductor en el sistema.');
        } else {
            $data = $data->fetch();
        }

        $ficha = $this->cleanString($_POST['ficha-conductor']);
        $fullname = $this->cleanString($_POST['name-conductor']);
        $cedula = $this->cleanString($_POST['cedula-conductor']);
        $telefono = $this->cleanString($_POST['phone-conductor']);
        $placa = $this->cleanString($_POST['vehiculo-conductor']);
        $tipoNomina = $this->cleanString($_POST['tipo-nomina']);
        
        $vencimientoCedula = !empty($_POST['vencimiento-cedula']) ? $this->cleanString($_POST['vencimiento-cedula']) : null;
        $vencimientoLicencia = !empty($_POST['vencimiento-licencia']) ? $this->cleanString($_POST['vencimiento-licencia']) : null;
        $vencimientoCertificadoMedico = !empty($_POST['vencimiento-medico']) ? $this->cleanString($_POST['vencimiento-medico']) : null;
        $vencimientoMppps = !empty($_POST['vencimiento-mppps']) ? $this->cleanString($_POST['vencimiento-mppps']) : null;
        $vencimientoSaberes = !empty($_POST['vencimiento-saberes']) ? $this->cleanString($_POST['vencimiento-saberes']) : null;
        $vencimientoManejoSeguro = !empty($_POST['vencimiento-seguro']) ? $this->cleanString($_POST['vencimiento-seguro']) : null;
        $vencimientoAlimento = !empty($_POST['vencimiento-alimento']) ? $this->cleanString($_POST['vencimiento-alimento']) : null;

        if (empty($ficha) || empty($fullname) || empty($cedula) || empty($telefono) || empty($placa)) {
            return $this->errorHandler('Todos los campos son obligatorios.');
        }

        if ($this->verifyData('^[0-9]{8}$', $ficha)) {
            return $this->errorHandler('La ficha del conductor solo puede contener números.');
        }

        if ($this->verifyData('[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{10,255}', $fullname)) {
            return $this->errorHandler('El nombre y apellido solo puede contener caracteres.');
        }

        if ($this->verifyData('^[0-9]{4,8}$', $cedula)) {
            return $this->errorHandler('La cédula del conductor solo puede contener números.');
        }

        if ($data['id_conductor'] != $ficha) {
            $checkFicha = $this->executeQuery("SELECT id_conductor FROM conductores WHERE id_conductor = '$ficha'");
            if ($checkFicha->rowCount() > 0) {
                return $this->errorHandler('El conductor ya se encuentra registrado.');
            }
        }

        $conductorDataUpdate = [

            [
                'field_name_database' => 'id_conductor',
                'field_name_form' => 'ficha',
                'field_value' => $ficha,
            ],
            [
                'field_name_database' => 'nombre_conductor',
                'field_name_form' => 'fullname',
                'field_value' => ucwords($fullname),
            ],
            [
                'field_name_database' => 'cedula_conductor',
                'field_name_form' => 'cedula',
                'field_value' => $cedula,
            ],
            [
                'field_name_database' => 'telefono_conductor',
                'field_name_form' => 'telefono',
                'field_value' => $telefono,
            ],
            [
                'field_name_database' => 'id_vehiculo',
                'field_name_form' => 'placa',
                'field_value' => $placa,
            ],
            [
                'field_name_database' => 'vencimiento_cedula',
                'field_name_form' => 'vencimientoCedula',
                'field_value' => $vencimientoCedula,
            ],
            [
                'field_name_database' => 'vencimiento_licencia',
                'field_name_form' => 'vencimientoLicencia',
                'field_value' => $vencimientoLicencia,
            ],
            [
                'field_name_database' => 'vencimiento_certificado_medico',
                'field_name_form' => 'vencimientoCertificadoMedico',
                'field_value' => $vencimientoCertificadoMedico,
            ],
            [
                'field_name_database' => 'vencimiento_mppps',
                'field_name_form' => 'vencimientoMppps',
                'field_value' => $vencimientoMppps,
            ],
            [
                'field_name_database' => 'vencimiento_saberes',
                'field_name_form' => 'vencimientoSaberes',
                'field_value' => $vencimientoSaberes,
            ],
            [
                'field_name_database' => 'vencimiento_manejo_seguro',
                'field_name_form' => 'vencimientoManejoSeguro',
                'field_value' => $vencimientoManejoSeguro,
            ],
            [
                'field_name_database' => 'vencimiento_alimento',
                'field_name_form' => 'vencimientoAlimento',
                'field_value' => $vencimientoAlimento,
            ],
            [
                'field_name_database' => 'tipo_nomina',
                'field_name_form' => 'tipoNomina',
                'field_value' => $tipoNomina,
            ],
        ];

        $condition = [
            "condition_field" => "id_conductor",
            "condition_marker" => "id_conductor",
            "condition_value" => $ficha,
        ];

        if ($this->updateData('conductores', $conductorDataUpdate, $condition)) {
            if ($ficha == isset($_SESSION['id_conductor'])) {
                $_SESSION['nombre_conductor'] = $fullname;
            }

            return $this->successHandler(
                'reload',
                'El conductor ' . ucwords($fullname) . ' ha sido actualizado correctamente.',
                'Conductor actualizado',
            );
        } else {
            return $this->errorHandler('No se pudo actualizar el conductor');
        }

    }

    public function deleteConductor()
    {
        $idConductor = $this->cleanString($_POST['id-conductor']);

        $dataConductor = $this->executeQuery("SELECT * FROM conductores WHERE id_conductor='$idConductor'");

        if ($dataConductor->rowCount() <= 0) {
            return $this->errorHandler('No hemos encontrado el conductor en el sistema.');

        } else {
            $dataConductor = $dataConductor->fetch();
        }

        $deleteConductor = $this->deleteData('conductores', 'id_conductor', $idConductor);

        if ($deleteConductor->rowCount() == 1) {
            return $this->successHandler(
                'reload', 
                'El conductor ' . $dataConductor['nombre_conductor'] . ' ha sido eliminado.',
                'Conductor eliminado',
            );

        } else {
            return $this->errorHandler('No se pudo eliminar el conductor ' . $dataConductor['nombre_conductor'] . ', intente más tarde.');
        }
    }

    public function getConductorInfo($term)
    {
        $term = '%' . $term . '%';
        $sql = "
            SELECT id_conductor,
            nombre_conductor,
            id_vehiculo
            FROM conductores
            WHERE nombre_conductor
            LIKE :term
            ORDER BY nombre_conductor ASC
            LIMIT 5
            
        ";
        $suggetions = $this->executeQuery($sql, [':term' => $term]);
        $data = [];

        if ($suggetions->rowCount() > 0) {
            while ($row = $suggetions->fetch(PDO::FETCH_ASSOC)) {
                $data[] = [
                    'id_conductor' => $row['id_conductor'],
                    'nombre_conductor' => $row['nombre_conductor'],
                    'id_vehiculo' => $row['id_vehiculo'],
                ];
            }
        }
        return json_encode($data);
    }

    public function totalConductores()
    {
        try {
            $sql = $this->executeQuery("SELECT COUNT(*) AS total FROM conductores");
            $totalConductores = $sql->fetchColumn();
            return $totalConductores;

        } catch (Exception $error) {
            error_log('Error totales conductores: ' . $error->getMessage());
        }
    }

    public function getNameConductor($id)
    {
        try {
            $sql = "SELECT nombre_conductor FROM conductores WHERE id_conductor = :id_conductor";
            $result = $this->executeQuery($sql, [':id_conductor' => $id]);

            if ($result->rowCount() > 0) {
                return $result->fetch(PDO::FETCH_ASSOC)['nombre_conductor'];
            }
            return null;

        } catch (Exception $error) {
            error_log('Ocurrio un error al obtener el nombre del conductor: ' . $error->getMessage());
        }
    }

}
