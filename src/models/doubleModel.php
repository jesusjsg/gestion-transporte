<?php
    namespace src\models;

    // Clase para el modelo de las tablas que cuenten con una llave primaria compuesta
    class doubleModel extends mainModel{
        
        protected function saveData($table, $data){

            $query = "INSERT INTO $table (";
            $count = 0;

            foreach($data as $key){
                if($count >= 1){
                    $query .= ",";
                }
                $query .= $key["field_name_database"];
                $count ++;
            }

            $query .= ") VALUES(";
            $count = 0;
            foreach($data as $key){
                if($count >= 1){
                    $query .= ",";
                }
                $query .= $key["field_name_form"];
                $count++;
            }

            $query .= ")";
            $sql = $this->conection()->prepare($query);
            foreach($data as $key){
                $sql->bindParam($key["field_name_form"], $key["field_value"]);
            }

            $sql->execute();
            return $sql;
        }

        public function selectData($type, $table, $idRegistro, $idEntidad){}

        protected function updateData($table, $data, $condition){}

        protected function deleteData($table, $idRegistro, $idEntidad){
            
            $sql = $this->conection()->prepare("DELETE FROM $table WHERE id_registro=:idRegistro AND id_entidad=:idEntidad");
            $sql->bindParam(":idRegistro", $idRegistro);
            $sql->bindParam(":idEntidad", $idEntidad);
            $sql->execute();
            return $sql;
        }
    }