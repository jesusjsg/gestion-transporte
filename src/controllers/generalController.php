<?php

    namespace src\controllers;

    use src\models\mainModel;

    class generalController extends mainModel{

        protected function registerGeneral(){

            $codigoRegistro = intval($this->cleanString($_POST['codigo-registro']));
            $codigoEntidad = intval($this->cleanString($_POST['codigo-entidad']));
            $primeraDescripcion = $this->cleanString($_POST['primera-descripcion']);
            $segundaDescripcion = $this->cleanString($_POST['segunda-descripcion']);
            $terceraDescripcion = $this->cleanString($_POST['tercera-descripcion']);
            $valor = $this->cleanString($_POST['valor']);

            if(empty($codigoRegistro) || empty($codigoEntidad)){
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

            if($this->verifyData('[a-zA-Z ]{4,255}', $primeraDescripcion) || $this->verifyData('[a-zA-Z ]{4,255}', $segundaDescripcion) || $this->verifyData('[a-zA-Z ]{4,255}', $terceraDescripcion)){
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
        }
    }