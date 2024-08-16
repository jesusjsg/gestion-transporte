<?php

    use src\models\uniqueModel;

    class viajeController extends uniqueModel{

        public function registerViaje(){

            //agregar el id del viaje,cliente
            $idViaje = '';
            $ficha = $this->cleanString($_POST['ficha']);
            $fullname = $this->cleanString($_POST['nombre-conductor']);
            $placa = $this->cleanString($_POST['placa-vehiculo']);
            $operacion = $this->cleanString($_POST['operacion']);
            $carga = $this->cleanString($_POST['carga']);
            $aviso = $this->cleanString($_POST['aviso']);
            $codigoRuta = $this->cleanString($_POST['codigo-ruta']);
            $fechaInicio = $this->cleanString($_POST['fecha-inicio']);
            $fechaCierre = $this->cleanString($_POST['fecha-cierre']);
            $sabado = $this->cleanString($_POST['cantidad-sabados']);
            $domingo = $this->cleanString($_POST['cantidad-domingos']);
            $feriado = $this->cleanString($_POST['cantidad-feriados']);
            $tasa = $this->cleanString($_POST['tasa-cambio']);
            $montoUsd = $this->cleanString($_POST['monto-usd']);
            $montoVes = $this->cleanString($_POST['monto-ves']);
            $kilometros = $this->cleanString($_POST['total-kilometros']);


            if(empty($placa) || empty($aviso) || empty($fullname)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Todos los campos son obligatorios.'
                ];
                return json_encode($alert);
            }

            if($this->verifyData('[0-9]{9,9}', $aviso)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El aviso solo puede contener números con un mínimo de 9 digitos.'
                ];
                return json_encode($alert);
            }

            /* $checkViaje = $this->executeQuery("SELECT id_viaje FROM viaje WHERE id_viaje = $idViaje");
            if($checkViaje->rowCount()>0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El viaje ya se encuentra registrado.'
                ];
                return json_encode($alert);
            } */

            $viajeDataLog = [
                [
                    'field_name_database' => 'id_viaje',
                    'field_name_form' => ':idViaje',
                    'field_value' => '' // agregar la variable del viaje 
                ],
                [
                    'field_name_database' => 'id_conductor',
                    'field_name_form' => ':fichaConductor',
                    'field_value' => $ficha // agregar la variable de la ficha del conductor
                ],
                [
                    'field_name_database' => 'id_vehiculo',
                    'field_name_form' => ':placaVehiculo',
                    'field_value' => $placa
                ],
                [
                    'field_name_database' => 'id_tipo_operacion',
                    'field_name_form' => ':tipoOperacion',
                    'field_value' => $operacion
                ],
                [
                    'field_name_database' => 'id_tipo_carga',
                    'field_name_form' => ':tipoCarga',
                    'field_value' => $carga
                ],
                [
                    'field_name_database' => 'aviso',
                    'field_name_form' => ':aviso',
                    'field_value' => $aviso
                ],
                [
                    'field_name_database' => 'id_cliente',
                    'field_name_form' => ':cliente',
                    'field_value' => '' // agregar la variable del id del ciente
                ],
                [
                    'field_name_database' => 'id_ruta',
                    'field_name_form' => ':codigoRuta',
                    'field_value' => $codigoRuta
                ],
                [
                    'field_name_database' => 'fecha_inicio',
                    'field_name_form' => ':fechaInicio',
                    'field_value' => $fechaInicio
                ],
                [
                    'field_name_database' => 'fecha_cierre',
                    'field_name_form' => ':fechaCierre',
                    'field_value' => $fechaCierre
                ],
                [
                    'field_name_database' => 'sabados',
                    'field_name_form' => ':sabados',
                    'field_value' => $sabado
                ],
                [
                    'field_name_database' => 'domingos',
                    'field_name_form' => ':domingos',
                    'field_value' => $domingo
                ],
                [
                    'field_name_database' => 'feriados',
                    'field_name_form' => ':feriados',
                    'field_value' => $feriado
                ],
                [
                    'field_name_database' => 'tasa_cambio',
                    'field_name_form' => ':tasaCambio',
                    'field_value' => $tasa
                ],
                [
                    'field_name_database' => 'monto_usd',
                    'field_name_form' => ':montoUsd',
                    'field_value' => $montoUsd
                ],
                [
                    'field_name_database' => 'monto_ves',
                    'field_name_form' => ':montoVes',
                    'field_value' => $montoVes
                ],
                [
                    'field_name_database' => 'origen',
                    'field_name_form' => ':origen',
                    'field_value' => '' // agregar el origen del viaje
                ],
                [
                    'field_name_database' => 'destino',
                    'field_name_form' => ':destino',
                    'field_value' => '' // agregar el destino del viaje
                ],
                [
                    'field_name_database' => 'total_kilometros',
                    'field_name_form' => ':totalKilometros',
                    'field_value' => $kilometros
                ]
            ];

            $saveViaje = $this->saveData('viaje', $viajeDataLog);
            if($saveViaje->rowCount() == 1){
                $alert = [
                    'type' => 'reload',
                    'icon' => 'success',
                    'title' => 'Registro exitoso',
                    'text' => 'El viaje se registró correctamente'
                ];
            }else{
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Hubo un problema al registrar el viaje.'
                ];
                return json_encode($alert);
            }
        }

        public function updateViaje(){}

        public function deleteViaje(){}

        public function tableViaje(){}
    }