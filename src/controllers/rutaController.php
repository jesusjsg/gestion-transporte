<?php
    namespace src\controllers;
    use PDO;
    use src\models\uniqueModel;

    class rutaController extends uniqueModel{

        public function registerRuta(){
            $codigoRuta = $this->cleanString($_POST['codigo-ruta']);
            $nombreRuta = $this->cleanString($_POST['nombre-ruta']);
            $origen = $this->cleanString($_POST['origen']);
            $destino = $this->cleanString($_POST['destino']);
            $kilometros = $this->cleanString($_POST['kilometros']);

            /* Validacion de los campos del formulario */

            if(empty($origen) || empty($destino) || empty($kilometros)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Todos los campos son obligatorios.',
                ];
                return json_encode($alert);
            }

            if($this->verifyData("[a-zA-Z ]{5,255}", $origen)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El origen solo puede contener caracteres.',
                ];
                return json_encode($alert);
            }

            if($this->verifyData("[a-zA-Z ]{5,255}", $destino)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El destino solo puede contener caracteres.'
                ];
                return json_encode($alert);
            }

            if(!is_int($kilometros)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Los kilometros deben ser un número entero.',
                ];
                return json_encode($alert);
            }

            $checkCodigoRuta = $this->executeQuery("SELECT codigo_ruta FROM ruta WHERE codigo_ruta = '$codigoRuta'");

            if($checkCodigoRuta->rowCount()>0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El código de ruta '. $codigoRuta . ' ya se encuentra registrado.'
                ];
                return json_encode($alert);
            }

            $rutaDataLog = [
                [
                    'field_name_database' => 'id_ruta',
                    'field_name_form' => ':codigoRuta',
                    'field_value' => $codigoRuta
                ],
                [
                    'field_name_database' => 'nombre_ruta',
                    'field_name_form' => ':nombreRuta',
                    'field_value' => $origen .'-' . $destino,
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
                ]
            ];

            $saveRuta = $this->saveData('ruta', $rutaDataLog);

            if($saveRuta->rowCount() == 1){
                $alert = [
                    'type' => 'reload',
                    'icon' => 'success',
                    'title' => 'Registro exitoso',
                    'text' => 'La ruta ha sido registrada correctamente.'
                ];
            }else{
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Hubo un problema al registrar la ruta.'
                ];

                return json_encode($alert);
            }
        }

        
        public function tableRuta(){
            $getTableRuta = $this->executeQuery("SELECT * FROM ruta");
            $data = [];

            if($getTableRuta->rowCount()>0){
                while($row = $getTableRuta->fetch(PDO::FETCH_ASSOC)){
                    foreach($row as $key => $value){
                        if(empty($value)){
                            $row[$key] = '
                                <span class="badge text-bg-danger">No definido</span>
                            ';
                        }
                    }
                    $data[] = $row;
                }
            }
            return json_encode($data);
        }

        public function updateRuta(){}

        public function deleteRuta(){}


        public function getOrigenDestino(){
            $getMunicipios = $this->executeQuery(
                "SELECT id_entidad,
                    CONCAT(descripcion1, ' | ', descripcion2, ' - ', descripcion3) AS estado_nombre_municipio 
                FROM general
                WHERE id_registro = 8
                AND id_entidad > 0
                ORDER BY estado_nombre_municipio
                LIMIT 10"
            );
            $estadoRutalMunicipios = [];
            if($getMunicipios->rowCount()>0){
                while($row = $getMunicipios->fetch(PDO::FETCH_ASSOC)){
                    $estadoRutalMunicipios[] = $row;
                }
            }
            return json_encode($estadoRutalMunicipios);

        }
    }