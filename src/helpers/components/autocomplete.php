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
    }
