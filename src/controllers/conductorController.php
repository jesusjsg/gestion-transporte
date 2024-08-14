<?php

    namespace src\controllers;
    use src\models\uniqueModel;

    class conductorController extends uniqueModel{

        public function registerConductor(){
            $ficha = $this->cleanString($_POST['ficha-conductor']);
            $fullname = $this->cleanString($_POST['name-conductor']);
            $cedula = $this->cleanString($_POST['cedula-conductor']);
            $telefono = $this->cleanString($_POST['phone-conductor']);
            $placa = $this->cleanString($_POST['vehiculo-conductor']);
            $vencimientoCedula = $this->cleanString($_POST['vencimiento-cedula']);
            $vencimientoLicencia = $this->cleanString($_POST['vencimiento-licencia']);
            $vencimientoCertificadoMedico = $this->cleanString($_POST['vencimiento-medico']);
            $vencimientoMppps = $this->cleanString($_POST['vencimiento-mppps']);
            $vencimientoSaberes = $this->cleanString($_POST['vencimiento-saberes']);
            $vencimientoManejoSeguro = $this->cleanString($_POST['vencimiento-seguro']);
            $vencimientoAlimento = $this->cleanString($_POST['vencimiento-alimento']);
            $tipoNomina = $this->cleanString($_POST['tipo-nomina']);

            if(empty($ficha) || empty($fullname) || empty($cedula) || empty($telefono) || empty($placa)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Todos los campos son necesarios.',
                ];
                return json_encode($alert);
            }

        }
    }