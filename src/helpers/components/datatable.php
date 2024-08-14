<?php 
    
    namespace src\helpers\components;

    use PDO;
    use src\models\mainModel;

    class Datatable extends mainModel{

        public function getDatatable($table){
            $rowDatatable = $this->executeQuery("SELECT * FROM $table");
            return $rowDatatable->fetchAll(PDO::FETCH_ASSOC);
        }
    } 