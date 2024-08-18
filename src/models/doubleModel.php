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

        public function selectData($type, $table, $field, $idRegistro, $idEntidad){

            $type = $this->cleanString($type);
            $table = $this->cleanString($table);
            $field = $this->cleanString($field);
            $idRegistro = $this->cleanString($idRegistro);
            $idEntidad = $this->cleanString($idEntidad);

            /* if($type == "") */
        }
    }