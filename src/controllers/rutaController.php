<?php
namespace src\controllers;

use PDO;
use Exception;
use src\models\uniqueModel;

class rutaController extends uniqueModel
{

    public function registerRuta()
    {
        $OriginCode = $this->cleanString($_POST['codigo-origen']);
        $DestinyCode = $this->cleanString($_POST['codigo-destino']);
        $rutaCode = trim($OriginCode . '-' . $DestinyCode);
        $origen = trim($this->cleanString($_POST['origen']));
        $destino = trim($this->cleanString($_POST['destino']));
        $rutaName = trim($origen . '-' . $destino);
        $kilometros = $this->cleanString($_POST['kilometros']);

        /* Validacion de los campos del formulario */

        if (empty($origen) || empty($destino) || empty($kilometros)) {
            return $this->errorHandler('Todos los campos son obligatorios.');
        }

        $kilometros = filter_var($kilometros, FILTER_VALIDATE_INT);
        if ($kilometros === false || $kilometros < 0) {
            return $this->errorHandler('Los kilometros deben ser un número entero.');
        }

        $checkRutaCode = $this->executeQuery("SELECT id_ruta FROM rutas WHERE id_ruta = '$rutaCode'");

        if ($checkRutaCode->rowCount() > 0) {
            return $this->errorHandler('El código de la ruta ' . $rutaCode . ' ya se encuentra registrado.');
        }

        $rutaDataLog = [
            [
                'field_name_database' => 'id_ruta',
                'field_name_form' => ':codigoRuta',
                'field_value' => $rutaCode,
            ],
            [
                'field_name_database' => 'nombre_ruta',
                'field_name_form' => ':nombreRuta',
                'field_value' => $rutaName,
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
            ],
            [
                'field_name_database' => 'kilometros',
                'field_name_form' => ':kilometros',
                'field_value' => $kilometros,
            ],
        ];

        $saveRuta = $this->saveData('rutas', $rutaDataLog);

        if ($saveRuta->rowCount() == 1) {
            return $this->successHandler(
                'reload', 
                'La ruta ha sido registrada correctamente.'
            );
        } else {
            return $this->errorHandler('Hubo un problema al registrar la ruta.');
        }
    }

    public function tableRuta()
    {
        $getTableRuta = $this->executeQuery("SELECT * FROM rutas");
        $data = [];

        if ($getTableRuta->rowCount() > 0) {
            while ($row = $getTableRuta->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {
                    if (empty($value)) {
                        $row[$key] = '
                                <span class="badge text-bg-secondary">No definido</span>
                            ';
                    }
                }
                $row['opciones'] = '
                        <form class="form-ajax d-inline" action="' . URL . 'ajax/ruta" method="post" autocomplete="off">
                            <input type="hidden" name="model_ruta" value="delete" />
                            <input type="hidden" name="id-ruta" value="' . $row['id_ruta'] . '" />
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

    public function updateRuta()
    {
        $idRuta = $this->cleanString($_POST['id-ruta']);

        $data = $this->executeQuery("SELECT * FROM vehiculos WHERE id_ruta='$idRuta'");

        if ($data->rowCount() <= 0) {
            return $this->errorHandler('No hemos encontrado la ruta en el sistema.');
        } else {
            $data = $data->fetch();
        }

        $OriginCode = $this->cleanString($_POST['codigo-origen']);
        $DestinyCode = $this->cleanString($_POST['codigo-destino']);
        $rutaCode = trim($OriginCode . '-' . $DestinyCode);
        $origen = trim($this->cleanString($_POST['origen']));
        $destino = trim($this->cleanString($_POST['destino']));
        $rutaName = trim($origen . '-' . $destino);
        $kilometros = $this->cleanString($_POST['kilometros']);

        if (empty($origen) || empty($destino) || empty($kilometros)) {
            return $this->errorHandler('Todos los campos son obligatorios.');
        }

        $kilometros = filter_var($kilometros, FILTER_VALIDATE_INT);
        if ($kilometros === false || $kilometros < 0) {
            return $this->errorHandler('Los kilometros deben ser un número entero.');
        }

        $checkRutaCode = $this->executeQuery("SELECT id_ruta FROM rutas WHERE id_ruta = '$rutaCode'");

        if ($checkRutaCode->rowCount() > 0) {
            return $this->errorHandler('El código de la ruta ' . $rutaCode . ' ya se encuentra registrado.');
        }

        $rutaDataUpdate = [
            [
                'field_name_database' => 'id_ruta',
                'field_name_form' => 'codigoRuta',
                'field_value' => $rutaCode,
            ],
            [
                'field_name_database' => 'nombre_ruta',
                'field_name_form' => 'nombreRuta',
                'field_value' => $rutaName,
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
            ],
            [
                'field_name_database' => 'kilometros',
                'field_name_form' => 'kilometros',
                'field_value' => $kilometros,
            ],
        ];

        $condition = [
            'condition_field' => 'id_ruta',
            'condition_marker' => 'id_ruta',
            'condition_value' => $rutaCode
        ];

        if ($this->updateData('rutas', $rutaDataUpdate, $condition)) {
            if ($rutaCode == isset($_SESSION['id_ruta'])) {
                $_SESSION['id_ruta'] = $rutaCode;
            }

            return $this->successHandler(
                'reload',
                'La ruta (' . ucwords($rutaCode) . ') ha sido actualizada correctamente.',
                'Ruta actualizada',
            );
        } else {
            return $this->errorHandler('No se pudo actualizar la ruta.');
        }

    }

    public function deleteRuta()
    {
        $idRuta = $this->cleanString($_POST['id-ruta']);

        $dataRuta = $this->executeQuery("SELECT * FROM rutas WHERE id_ruta='$idRuta'");
        if ($dataRuta->rowCount() <= 0) {
            return $this->errorHandler('No hemos encontrado la ruta en el sistema.');
        } else {
            $dataRuta = $dataRuta->fetch();
        }

        $deleteRuta = $this->deleteData('rutas', 'id_ruta', $idRuta);
        if ($deleteRuta->rowCount() == 1) {
            return $this->successHandler(
                'reload', 
                'La ruta ' . $dataRuta['id_ruta'] . ' ha sido eliminada correctamente.',
                'Ruta eliminada', 
        );
        } else {
            return $this->errorHandler('No se pudo eliminar la ruta ' . $dataRuta['id_ruta'] . ', intente más tarde.');
        }
    }

    public function getKilometers($rutaCode)
    {
        $rutaKilometers = $this->executeQuery("SELECT kilometros FROM rutas WHERE id_ruta = '$rutaCode");
        $values = [];

        if ($rutaKilometers->rowCount() > 0) {
            while ($row = $rutaKilometers->fetch(PDO::FETCH_ASSOC)) {
                $values[] = $row['kilometros'];
            }
        }
        return $values;
    }

    public function totalRutas()
    {
        try {
            $sql = $this->executeQuery("SELECT COUNT(*) AS total FROM rutas");
            $totalRutas = $sql->fetchColumn();
            return $totalRutas;

        } catch (Exception $error) {
            error_log('Error totales rutas: ' . $error->getMessage());
        }
    }

    public function getRutaCodes($idRuta)
    {
        $codes = explode('-', $idRuta);

        if (count($codes) == 2) {
            return [
                'codigo_origen' => trim($codes[0]),
                'codigo_destino' => trim($codes[1]), 
            ];
        }
    }
}