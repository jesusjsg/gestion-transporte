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

            $sql = "SELECT id_vehiculo FROM vehiculo WHERE id_vehiculo LIKE :term ORDER BY id_vehiculo ASC";
            $suggetions = $this->executeQuery($sql, [':term' => $term]);

            $data = [];

            if($suggetions->rowCount()>0){
                while($row = $suggetions->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row['id_vehiculo'];
                }
            }
            return json_encode($data);
        }

        public function autocompleteMunicipio($term){
            $term = '%' . $term . '%';
            $sql = "
                SELECT id_entidad, 
                CONCAT(descripcion1, ' | ', descripcion2, ' - ', descripcion3) AS estado_nombre_municipio,
                descripcion1
                FROM general 
                WHERE id_registro = 8 
                AND id_entidad > 0 
                AND CONCAT(descripcion1, ' | ', descripcion2, ' - ', descripcion3)
                LIKE :term
                ORDER BY estado_nombre_municipio ASC
                LIMIT 10
            ";

            $suggetions = $this->executeQuery($sql, [':term' => $term]);
            $data = [];
            if($suggetions->rowCount()>0){
                while($row = $suggetions->fetch(PDO::FETCH_ASSOC)){
                    $data[] = [
                        'id_entidad' => $row['id_entidad'], 
                        'estado_nombre_municipio' => $row['estado_nombre_municipio'], 
                        'descripcion1' => $row['descripcion1']
                    ];
                }
            }
            return json_encode($data);
        }

        public function autocompleteConductor($term){
            $term = '%' . $term . '%';
            $sql = "
                SELECT id_conductor,
                nombre_conductor,
                id_vehiculo
                FROM conductor
                WHERE nombre_conductor
                LIKE :term
                ORDER BY nombre_conductor ASC
                LIMIT 10
            ";
            $suggetions = $this->executeQuery($sql, [':term' => $term]);
            $data = [];

            if($suggetions->rowCount()>0){
                while($row = $suggetions->fetch(PDO::FETCH_ASSOC)){
                    $data[] = [
                        'id_conductor' => $row['id_conductor'],
                        'nombre_conductor' => $row['nombre_conductor'],
                        'id_vehiculo' => $row['id_vehiculo']
                    ];
                }
            }
            return json_encode($data);
        }

        public function autocompleteCliente($term){
            $term = '%' . $term . '%';
            $sql = "
                SELECT id_entidad, 
                descripcion1
                FROM general
                WHERE id_registro = 7
                AND id_entidad > 0
                AND descripcion1 LIKE :term
                ORDER BY descripcion1 ASC
                LIMIT 10
            ";
            $suggetions = $this->executeQuery($sql, [':term' => $term]);
            $data = [];

            if($suggetions->rowCount()>0){
                while($row = $suggetions->fetch(PDO::FETCH_ASSOC)){
                    $data[] = [
                        'id_entidad' => $row['id_entidad'],
                        'descripcion1' => $row['descripcion1']
                    ];
                }
            }
            return json_encode($data);
        }
    }
