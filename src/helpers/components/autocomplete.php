<?php 
    
    namespace src\helpers\components;

    use PDO;
    use src\models\mainModel;

    
    class Autocomplete extends mainModel{

        public function autocompleteSelect($idRegistro){
            $fillOptions = $this->executeQuery("SELECT id_entidad, descripcion1 FROM general WHERE id_registro = $idRegistro AND id_entidad > 0");
            $options = [];
            
            if($fillOptions->rowCount()>0){
                while($row = $fillOptions->fetch(PDO::FETCH_ASSOC)){
                    $options[] = $row;
                }
            }
            return $options;
        }

        public function autocompletePlaca($term){
            $term = '%' . $term . '%';

            $fillOptions = $this->executeQuery(
                "SELECT id_vehiculo FROM vehiculo WHERE id_vehiculo LIKE :term ORDER BY id_vehiculo ASC"
            );
            $fillOptions->bindParam(':term', $term, PDO::PARAM_STR);
            
            $data = [];

            if($fillOptions->rowCount()>0){
                while($row = $fillOptions->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row['id_vehiculo'];
                }
            }
            return json_encode($data);
        }
    }
