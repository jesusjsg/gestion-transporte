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

            if($this->verifyData('[0-9]', $ficha)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'La ficha del conductor solo puede contener números.',
                ];
            }

            if($this->verifyData('[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,255}', $fullname)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El nombre y apellido solo puede contener caracteres.'
                ];
            }

            if($this->verifyData('[0-9]', $cedula)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'La cédula del conductor solo puede contener números.',
                ];
            }

            if($this->verifyData('[0-9]', $telefono)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El teléfono del conductor solo puede contener números.',
                ];
            }

            $checkConductor = $this->executeQuery("SELECT id_conductor FROM conductor WHERE id_conductor = '$ficha'");
            $checkCedula = $this->executeQuery("SELECT cedula FROM conductor WHERE cedula = '$cedula'");

            if($checkConductor->rowCount()>0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El conductor ya se encuentra registrado.',
                ];
                return json_encode($alert);
            }

            if($checkCedula->rowCount()>0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'La cédula del conductor ya se encuentra registrada.',
                ];
                return json_encode($alert);
            }

            $conductorDataLog = [
                [
                    'field_name_database' => 'id_conductor',
                    'field_name_form' => ':ficha',
                    'field_value' => $ficha
                ],
                [
                    'field_name_database' => 'nombre_conductor',
                    'field_name_form' => ':fullname',
                    'field_value' => ucwords($fullname)
                ],
                [
                    'field_name_database' => 'cedula_conductor',
                    'field_name_form' => ':cedula',
                    'field_value' => $cedula
                ],
                [
                    'field_name_database' => 'telefono_conductor',
                    'field_name_form' => ':telefono',
                    'field_value' => $telefono
                ],
                [
                    'field_name_database' => 'id_vehiculo',
                    'field_name_form' => ':placa',
                    'field_value' => $placa
                ],
                [
                    'field_name_database' => 'vencimiento_cedula',
                    'field_name_form' => ':vencimientoCedula',
                    'field_value' => $vencimientoCedula
                ],
                [
                    'field_name_database' => 'vencimiento_licencia',
                    'field_name_form' => ':vencimientoLicencia',
                    'field_value' => $vencimientoLicencia
                ],
                [
                    'field_name_database' => 'vencimiento_certificadoMedico',
                    'field_name_form' => ':vencimientoCertificadoMedico',
                    'field_value' => $vencimientoCertificadoMedico
                ],
                [
                    'field_name_database' => 'vencimiento_mppps',
                    'field_name_form' => ':vencimientoMppps',
                    'field_value' => $vencimientoMppps
                ],
                [
                    'field_name_database' => 'vencimiento_saberes',
                    'field_name_form' => ':vencimientoSaberes',
                    'field_value' => $vencimientoSaberes
                ],
                [
                    'field_name_database' => 'vencimiento_manejoSeguro',
                    'field_name_form' => ':vencimientoManejoSeguro',
                    'field_value' => $vencimientoManejoSeguro
                ],
                [
                    'field_name_database' => 'vencimiento_alimento',
                    'field_name_form' => ':vencimientoAlimento',
                    'field_value' => $vencimientoAlimento
                ],
                [
                    'field_name_database' => 'tipo_nomina',
                    'field_name_form' => ':tipoNomina',
                    'field_value' => $tipoNomina
                ]
            ];

            $saveConductor = $this->saveData('condutor', $conductorDataLog);

            if($saveConductor->rowCount() == 1){
                $alert = [
                    'type' => 'reload',
                    'icon' => 'success',
                    'title' => 'Registro exitoso',
                    'text' => 'El conductor '.ucwords($fullname).' ha sido registrado correctamente.',
                ];
            }else{
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Hubo un problema al registrar el conductor.',
                ];

                return json_encode($alert);
            }
        }

        public function updateConductor(){}
        
        public function deleteConductor(){}
        
        public function tableConductor(){}
    }