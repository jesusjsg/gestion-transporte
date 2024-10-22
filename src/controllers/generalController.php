<?php

namespace src\controllers;

use PDO;
use Exception;
use src\models\doubleModel;

class generalController extends doubleModel
{

    public function registerGeneral()
    {

        $codigoRegistro = intval($this->cleanString($_POST['codigo-registro']));
        $codigoEntidad = intval($this->cleanString($_POST['codigo-entidad']));
        $primeraDescripcion = trim($this->cleanString($_POST['primera-descripcion']));
        $segundaDescripcion = trim($this->cleanString($_POST['segunda-descripcion']));
        $terceraDescripcion = trim($this->cleanString($_POST['tercera-descripcion']));
        $valor = $this->cleanString($_POST['valor']);

        if ($codigoRegistro == '' || $codigoEntidad == '') {
            return $this->errorHandler('El código de registro y entidad son obligatorios.');
        }

        if (!is_int($codigoRegistro) || !is_int($codigoEntidad) || $codigoRegistro < 0 || $codigoEntidad < 0) {
            return $this->errorHandler('El código de registro y entidad deben ser números enteros.');
        }

        if ($this->verifyData('[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 /]{0,255}', $primeraDescripcion) || $this->verifyData('[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 /]{0,255}', $segundaDescripcion) || $this->verifyData('[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 /]{0,255}', $terceraDescripcion)) {
            return $this->errorHandler('Las descripciones no permiten caracteres especiales.');
        }

        if (!is_numeric($valor)) {
            return $this->errorHandler('El valor debe ser un valor numérico.');
        }

        $checkRegistroEntidad = $this->executeQuery("SELECT id_registro, id_entidad FROM general WHERE id_registro = $codigoRegistro AND id_entidad = $codigoEntidad");

        if ($checkRegistroEntidad->rowCount() > 0) {
            return $this->errorHandler('El registro y entidad ya se encuentran registrados.');
        }

        $registroDataLog = [
            [
                'field_name_database' => 'id_registro',
                'field_name_form' => ':registro',
                'field_value' => $codigoRegistro,
            ],
            [
                'field_name_database' => 'id_entidad',
                'field_name_form' => ':entidad',
                'field_value' => $codigoEntidad,
            ],
            [
                'field_name_database' => 'descripcion1',
                'field_name_form' => ':descripcion1',
                'field_value' => $primeraDescripcion,
            ],
            [
                'field_name_database' => 'descripcion2',
                'field_name_form' => ':descripcion2',
                'field_value' => $segundaDescripcion,
            ],
            [
                'field_name_database' => 'descripcion3',
                'field_name_form' => ':descripcion3',
                'field_value' => $terceraDescripcion,
            ],
            [
                'field_name_database' => 'valor',
                'field_name_form' => ':valor',
                'field_value' => $valor,
            ],
        ];

        $saveRegistro = $this->saveData('general', $registroDataLog);

        if ($saveRegistro->rowCount() == 1) {
            return $this->successHandler('reload', 'La entidad ha sido registrado correctamente.');
        } else {
            return $this->errorHandler('Hubo un problema al registrar la entidad.');
        }
    }

    public function tableGeneral()
    {

        $getTableGeneral = $this->executeQuery("SELECT * FROM general");
        $data = [];

        if ($getTableGeneral->rowCount() > 0) {
            while ($row = $getTableGeneral->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {
                    if ($value == '') {
                        $row[$key] = '
                                <span class="badge text-bg-secondary">No definido</span>
                            ';
                    }
                }
                $row['opciones'] = '
                        <a href="'.URL.'general/editar/'.$row['id_registro'].'/'.$row['id_entidad'].'/" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square m-0 p-0"></i></a>
                        <form class="form-ajax d-inline" action="' . URL . 'ajax/general" method="post" autocomplete="off">
                            <input type="hidden" name="model_general" value="delete" />
                            <input type="hidden" name="id-registro" value="' . $row['id_registro'] . '" />
                            <input type="hidden" name="id-entidad" value="' . $row['id_entidad'] . '" />
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

    public function updateGeneral()
    {
        $idRegistro = $this->cleanString($_POST['id-registro']);
        $idEntidad = $this->cleanString($_POST['id-entidad']);

        $data = $this->executeQuery("SELECT * FROM general WHERE id_registro = '$idRegistro' AND id_entidad = '$idEntidad'");

        if ($data->rowCount() <= 0) {
            return $this->errorHandler('No hemos encontrado el registro en el sistema.');
        } else {
            $data = $data->fetch();
        }

        $codigoRegistro = intval($this->cleanString($_POST['codigo-registro']));
        $codigoEntidad = intval($this->cleanString($_POST['codigo-entidad']));
        $primeraDescripcion = trim($this->cleanString($_POST['primera-descripcion']));
        $segundaDescripcion = trim($this->cleanString($_POST['segunda-descripcion']));
        $terceraDescripcion = trim($this->cleanString($_POST['tercera-descripcion']));
        $valor = $this->cleanString($_POST['valor']);

        if ($codigoRegistro == '' || $codigoEntidad == '') {
            return $this->errorHandler('El código de registro y entidad son obligatorios.');
        }

        if (!is_int($codigoRegistro) || !is_int($codigoEntidad) || $codigoRegistro < 0 || $codigoEntidad < 0) {
            return $this->errorHandler('El código de registro y entidad deben ser números enteros.');
        }

        if ($this->verifyData('^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 /]{0,255}$', $primeraDescripcion) || 
            $this->verifyData('^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 /]{0,255}$', $segundaDescripcion) ||
            $this->verifyData('^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 /]{0,255}$', $terceraDescripcion)) {
            return $this->errorHandler('Las descripciones no permiten caracteres especiales.');
        }

        if (!is_numeric($valor)) {
            return $this->errorHandler('El valor debe ser un valor numérico.');
        }

        if ($data['id_registro'] != $codigoRegistro || $data['id_entidad'] != $codigoEntidad) {
            $checkRegistro = $this->executeQuery("SELECT id_registro, id_entidad FROM general WHERE id_registro = '$codigoRegistro' AND id_entidad = '$codigoEntidad'");
            if ($checkRegistro->rowCount() > 0) {
                return $this->errorHandler('La entidad y el registro ya se encuentran registrados.');
            }
        }

        $generalDataUpdate = [
            [
                'field_name_database' => 'id_registro',
                'field_name_form' => 'id_registro',
                'field_value' => $codigoRegistro,
            ],
            [
                'field_name_database' => 'id_entidad',
                'field_name_form' => 'id_entidad',
                'field_value' => $codigoEntidad,
            ],
            [
                'field_name_database' => 'descripcion1',
                'field_name_form' => 'descripcion1',
                'field_value' => $primeraDescripcion,
            ],
            [
                'field_name_database' => 'descripcion2',
                'field_name_form' => 'descripcion2',
                'field_value' => $segundaDescripcion,
            ],
            [
                'field_name_database' => 'descripcion3',
                'field_name_form' => 'descripcion3',
                'field_value' => $terceraDescripcion,
            ]
        ];

        $condition = [
            [
                'condition_field' => 'id_registro',
                'condition_marker' => 'id_registro',
                'condition_value' => $codigoRegistro,
            ],
            [
                'condition_field' => 'id_entidad',
                'condition_marker' => 'id_entidad',
                'condition_value' => $codigoEntidad,
            ]
        ];

        if ($this->updateData('general', $generalDataUpdate, $condition)) {
            if ($codigoRegistro == isset($_SESSION['id_registro'])) {
                $_SESSION['id_entidad'] = $codigoEntidad;
            }

            return $this->successHandler(
                'reload',
                'La entidad ' . $codigoRegistro . '-' . $codigoEntidad . ' ha sido actualizada correctamente.',
                'Entidad actualizada', 
            );
        } else {
            return $this->errorHandler('No se pudo actualizar la entidad.');
        }
        
    }

    public function deleteGeneral()
    {

        $idRegistro = $this->cleanString($_POST['id-registro']);
        $idEntidad = $this->cleanString($_POST['id-entidad']);

        $dataRegistro = $this->executeQuery("SELECT * FROM general WHERE id_registro='$idRegistro' AND id_entidad='$idEntidad'");
        if ($dataRegistro->rowCount() <= 0) {
            return $this->errorHandler('No hemos encontrado el registro en el sistema');
        } else {
            $dataRegistro = $dataRegistro->fetch();
        }

        $deleteRegistro = $this->deleteData('general', $idRegistro, $idEntidad);
        if ($deleteRegistro->rowCount() == 1) {
            return $this->successHandler(
                'reload', 
                'El registro ' . $dataRegistro['id_registro'] . ' - ' . $dataRegistro['id_entidad'] . ' ha sido eliminado correctamente.',
                'Entidad eliminada',
            );
        } else {
            return $this->errorHandler('No se pudo eliminar el registro ' . $dataRegistro['id_registro'] . ' - ' . $dataRegistro['id_entidad'] . ', intente más tarde.');
        }
    }

    public function getMunicipios($term)
    {
        $term = '%' . $term . '%';
        $sql = "
            SELECT id_entidad,
            descripcion1,
            CONCAT(descripcion1, ' | ', descripcion2, ' - ', descripcion3) AS estado_nombre_municipio
            FROM general
            WHERE id_registro = 8
            AND id_entidad > 0
            AND CONCAT(descripcion1, ' | ', descripcion2, ' - ', descripcion3)
            LIKE :term
            ORDER BY estado_nombre_municipio ASC
            LIMIT 5
        ";

        $suggetions = $this->executeQuery($sql, [':term' => $term]);
        $data = [];
        if ($suggetions->rowCount() > 0) {
            while ($row = $suggetions->fetch(PDO::FETCH_ASSOC)) {
                $data[] = [
                    'id_entidad' => $row['id_entidad'],
                    'estado_nombre_municipio' => $row['estado_nombre_municipio'],
                    'descripcion1' => $row['descripcion1'],
                ];
            }
        }
        return json_encode($data);
    }

    public function getMunicipioById($id_entidad)
    {
        $sql = "
            SELECT CONCAT(descripcion1, ' | ', descripcion2, ' - ', descripcion3) AS estado_nombre_municipio
            FROM general
            WHERE id_entidad = :id_entidad
            AND id_registro = 8
            LIMIT 1
        ";

        $result = $this->executeQuery($sql, [':id_entidad' => $id_entidad]);
        
        if ($result->rowCount() > 0) {
            return $result->fetch(PDO::FETCH_ASSOC)['estado_nombre_municipio'];
        }
        
        return null;
    }

    public function getRuralById($id_entidad)
    {
        $sql = "
            SELECT descripcion1
            FROM general
            WHERE id_entidad = :id_entidad
            AND id_registro = 8
            LIMIT 1
        ";

        $result = $this->executeQuery($sql, [
            ':id_entidad' => $id_entidad,
        ]);

        if ($result->rowCount() > 0) {
            return $result->fetch(PDO::FETCH_ASSOC)['descripcion1'];
        }
        return null;
    }

    public function getEstadoById($id_entidad)
    {
        $sql = "
            SELECT descripcion3
            FROM general
            WHERE id_entidad = :id_entidad
            AND id_registro = 8
            LIMIT 1
        ";

        $result = $this->executeQuery($sql, [
            ':id_entidad' => $id_entidad,
        ]);

        if ($result->rowCount() > 0) {
            return $result->fetch(PDO::FETCH_ASSOC)['descripcion3'];
        }
        return null;
    }

    public function getRegistro($idRegistro)
    {
        $options = $this->executeQuery("
            SELECT id_entidad,
            descripcion1
            FROM general
            WHERE id_registro = $idRegistro
            AND id_entidad > 0
        ");

        $registros = [];

        if ($options->rowCount() > 0) {
            while ($row = $options->fetch(PDO::FETCH_ASSOC)) {
                $registros[] = $row;
            }
        }
        return $registros;
    }

    public function getCliente($term)
    {
        $term = '%' . $term . '%';
        $sql = "
            SELECT id_entidad,
            descripcion1
            FROM general
            WHERE id_registro = 7
            AND id_entidad > 0
            AND descripcion1 LIKE :term 
            ORDER BY descripcion1 ASC 
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

    public function getTasa()
    {
        $query = $this->executeQuery("
            SELECT valor
            FROM general
            WHERE id_registro = 2
            AND id_entidad > 0
        ");

        if ($query->rowCount() > 0) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['valor'];
        }
        return null;
    }
}
