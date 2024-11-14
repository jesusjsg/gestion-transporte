<?php
namespace src\models;

USE PDO;
// Clase para el modelo de las tablas que cuenten con una llave primaria compuesta
class doubleModel extends mainModel
{

    protected function saveData($table, $data)
    {

        $query = "INSERT INTO $table (";
        $count = 0;

        foreach ($data as $key) {
            if ($count >= 1) {
                $query .= ",";
            }
            $query .= $key["field_name_database"];
            $count++;
        }

        $query .= ") VALUES(";
        $count = 0;
        foreach ($data as $key) {
            if ($count >= 1) {
                $query .= ",";
            }
            $query .= $key["field_name_form"];
            $count++;
        }

        $query .= ")";
        $sql = $this->conection()->prepare($query);
        foreach ($data as $key) {
            $sql->bindParam($key["field_name_form"], $key["field_value"]);
        }

        $sql->execute();
        return $sql;
    }

    public function selectData($type, $table, $idRegistro, $idEntidad)
    {
        $type = $this->cleanString($type);
        $table = $this->cleanString($table);
        $idRegistro = $this->cleanString($idRegistro);
        $idEntidad = $this->cleanString($idEntidad);

        if ($type == 'Primary') {
            $sql = $this->conection()->prepare("SELECT * FROM $table WHERE id_registro = :id_registro AND id_entidad = :id_entidad");
            $sql->bindParam(':id_registro', $idRegistro, PDO::PARAM_STR);
            $sql->bindParam(':id_entidad', $idEntidad, PDO::PARAM_STR);
        
        } else if ($type == 'Normal') {
            $sql = $this->conection()->prepare("SELECT * FROM $table");
        }
        $sql->execute();
        return $sql;
    }

    protected function updateData($table, $data, $condition)
    {
        $query = "UPDATE $table SET ";
        $count = 0;

        foreach ($data as $key) {
            if ($count >= 1) {
                $query .= ", ";
            }
            $query .= $key['field_name_database'] . ' = :' . $key['field_name_form'];
            $count++;
        }

        $query .= " WHERE ";
        $conditionCount = 0;
        foreach ($condition as $cond) {
            if ($conditionCount >= 1) {
                $query .= " AND ";
            }
            $query .= $cond['condition_field'] . " = :" . $cond['condition_marker'];
            $conditionCount++;
        }

        $sql = $this->conection()->prepare($query);

        foreach ($data as $key) {
            $sql->bindParam(':' . $key['field_name_form'], $key['field_value']);
        }

        foreach ($condition as $cond) {
            $sql->bindParam(':' . $cond['condition_marker'], $cond['condition_value']);
        }

        $sql->execute();
        return $sql;
    }


    protected function deleteData($table, $idRegistro, $idEntidad)
    {

        $sql = $this->conection()->prepare("DELETE FROM $table WHERE id_registro=:idRegistro AND id_entidad=:idEntidad");
        $sql->bindParam(":idRegistro", $idRegistro);
        $sql->bindParam(":idEntidad", $idEntidad);
        $sql->execute();
        return $sql;
    }

    protected function checkExists($table, $conditions)
    {
        $query = "SELECT 1 FROM $table WHERE ";
        $count = 0;

        foreach ($conditions as $condition) {
            if ($count > 0) {
                $query .= " AND ";
            }
            $query .= $condition['condition_field'] . " = :" . $condition['condition_marker'];
            $count++;
        }

        $sql = $this->conection()->prepare($query);

        foreach ($conditions as $condition) {
            $sql->bindParam(':' . $condition['condition_marker'], $condition['condition_value']);
        }

        $sql->execute();

        return $sql->fetchColumn() ? true : false;
    }
}
