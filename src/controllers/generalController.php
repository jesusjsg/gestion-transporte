<?php

    namespace src\controllers;

use PDO;
use src\models\doubleModel;

    class generalController extends doubleModel{

        public function registerGeneral(){

            $codigoRegistro = intval($this->cleanString($_POST['codigo-registro']));
            $codigoEntidad = intval($this->cleanString($_POST['codigo-entidad']));
            $primeraDescripcion = trim($this->cleanString($_POST['primera-descripcion']));
            $segundaDescripcion = trim($this->cleanString($_POST['segunda-descripcion']));
            $terceraDescripcion = trim($this->cleanString($_POST['tercera-descripcion']));
            $valor = $this->cleanString($_POST['valor']);

            if($codigoRegistro == '' || $codigoEntidad == ''){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El código de registro y entidad son obligatorios.'
                ];
                return json_encode($alert);
            }

            if(!is_int($codigoRegistro) || !is_int($codigoEntidad) || $codigoRegistro < 0 || $codigoEntidad < 0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El código de registro y entidad deben ser números enteros.'
                ];
                return json_encode($alert);
            }

            if($this->verifyData('[a-zA-Z ]{0,255}', $primeraDescripcion) || $this->verifyData('[a-zA-Z ]{0,255}', $segundaDescripcion) || $this->verifyData('[a-zA-Z ]{0,255}', $terceraDescripcion)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Las descripciones no permiten caracteres especiales.'
                ];
                return json_encode($alert);
            }

            if(!is_numeric($valor)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El valor debe ser un valor numérico.'
                ];
                return json_encode($alert);
            }

            $checkRegistroEntidad = $this->executeQuery("SELECT id_registro, id_entidad FROM general WHERE id_registro = $codigoRegistro AND id_entidad = $codigoEntidad");

            if($checkRegistroEntidad->rowCount()>0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El registro y entidad ya se encuentran registrados.'
                ];
                return json_encode($alert);
            }

            $registroDataLog = [
                [
                    'field_name_database' => 'id_registro',
                    'field_name_form' => ':registro',
                    'field_value' => $codigoRegistro
                ],
                [
                    'field_name_database' => 'id_entidad',
                    'field_name_form' => ':entidad',
                    'field_value' => $codigoEntidad
                ],
                [
                    'field_name_database' => 'descripcion1',
                    'field_name_form' => ':descripcion1',
                    'field_value' => $primeraDescripcion
                ],
                [
                    'field_name_database' => 'descripcion2',
                    'field_name_form' => ':descripcion2',
                    'field_value' => $segundaDescripcion
                ],
                [
                    'field_name_database' => 'descripcion3',
                    'field_name_form' => ':descripcion3',
                    'field_value' => $terceraDescripcion
                ]
            ];

            $saveRegistro = $this->saveData('general', $registroDataLog);

            if($saveRegistro->rowCount() == 1){
                $alert = [
                    'type' => 'reload',
                    'icon' => 'success',
                    'title' => 'Registro exitoso',
                    'text' => 'La entidad ha sido registrado correctamente.'
                ];
            }else{
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Hubo un problema al registrar la entidad.'
                ];
            }
            return json_encode($alert);
        }

        public function tableGeneral(){

            $getTableGeneral = $this->executeQuery("SELECT * FROM general");
            $data = [];

            if($getTableGeneral->rowCount()>0){
                while($row = $getTableGeneral->fetch(PDO::FETCH_ASSOC)){
                    foreach($row as $key => $value){
                        if($value == ''){
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

        public function updateGeneral(){}

        public function deleteGeneral(){}
    }