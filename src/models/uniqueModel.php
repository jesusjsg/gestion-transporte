<?php

    namespace src\models;

    // Clase para el modelo de las tablas que cuenten con solo una llave primaria
    class uniqueModel extends mainModel{

        protected function saveData($table, $data){

            //Se recorren los nombres de los campos de la tabla
            $query = "INSERT INTO $table (";
            $count = 0;

            foreach($data as $key){
                if($count >= 1){
                    $query.=",";
                }
                $query.=$key["field_name_database"];
                $count++;
            }

            //Se recorren los valores de los campos de la tabla
            $query.=") VALUES(";
            $count = 0;
            foreach($data as $key){
                if($count >= 1){
                    $query.=",";
                }
                $query.=$key["field_name_form"];
                $count++;
            }

            $query.=")";
            $sql = $this->conection()->prepare($query);
            foreach($data as $key){
                $sql->bindParam($key["field_name_form"], $key["field_value"]);
            }

            $sql->execute();
            return $sql;
        }

        public function selectData($type,$table,$field,$id){

            $type = $this->cleanString($type);
            $table = $this->cleanString($table);
            $field = $this->cleanString($field);
            $id = $this->cleanString($id);

            if($type == "Primary"){
                $sql = $this->conection()->prepare("SELECT * FROM $table WHERE $field=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($type == "Normal"){
                $sql = $this->conection()->prepare("SELECT $field FROM $table");
            }
            $sql->execute();
            return $sql;
        }

        protected function updateData($table,$data,$condition){
            
            $query = "UPDATE $table SET ";
            $count = 0;

            foreach ($data as $key){
                if($count >= 1){
                    $query.=",";
                }
                $query.=$key["field_name_database"]."=".$key["field_name_form"];
                $count++;
            }

            $query.=" WHERE ".$condition["condition_field"]."=".$condition["condition_marker"];
            $sql = $this->conection()->prepare($query);

            foreach($data as $key){
                $sql->bindParam($key["field_name_database"], $key["field_value"]);
            }

            $sql->bindParam($condition["condition_marker"], $condition["condition_value"]);
            $sql->execute();
            return $sql;
        }
        
        protected function deleteData($table,$field,$id){

            $sql = $this->conection()->prepare("DELETE FROM $table WHERE $field=:id");
            $sql->bindParam(":id",$id);
            $sql->execute();
            return $sql;
        }

    }