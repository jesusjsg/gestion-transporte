<?php

    namespace src\controllers;

use DateTime;
use PDO;
use src\models\uniqueModel;

    class vehiculoController extends uniqueModel{

        public function registerVehiculo(){
            $placa = $this->cleanString($_POST['placa']);
            $tipoVehiculo = $this->cleanString($_POST['tipo-vehiculo']);
            $propiedad = $this->cleanString($_POST['propiedad']);
            $unidadNegocio = $this->cleanString($_POST['unidad-negocio']);
            $marca = $this->cleanString($_POST['marca-vehiculo']);
            $modelo = $this->cleanString($_POST['modelo-vehiculo']);
            $year = $this->cleanString($_POST['year-vehiculo']);
            $serialCarroceria = $this->cleanString($_POST['serial-carroceria']);
            $serialMotor = $this->cleanString($_POST['serial-motor']);
            $numeroEjes = $this->cleanString($_POST['numero-ejes']);
            $capacidadCarga = $this->cleanString($_POST['capacidad-carga']);
            $uso = $this->cleanString($_POST['uso-vehiculo']);
            $vencimientoPoliza = $this->cleanString($_POST['vencimiento-poliza']);
            $vencimientoRacda = $this->cleanString($_POST['vencimiento-racda']);
            $vencimientoSanitario = $this->cleanString($_POST['vencimiento-sanitario']);
            $vencimientoRotc = $this->cleanString($_POST['vencimiento-rotc']);
            $fechaFumigacion = $this->cleanString($_POST['fecha-fumigacion']);
            $fechaImpuestos = $this->cleanString($_POST['fecha-impuestos']);
            $bolipuertos = $this->cleanString($_POST['bolipuertos']);
            $gps = $this->cleanString($_POST['gps']);
            $linkGps = $this->cleanString($_POST['link-gps']);
            $estatus = $this->cleanString($_POST['estatus-vehiculo']);

            // Validaciones de los campos de tipo texto
            if(empty($placa) || empty($tipoVehiculo) || empty($serialCarroceria) || empty($serialMotor) || empty($linkGps) || empty($modelo)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Todos los campos son obligatorios.',
                ];
                return json_encode($alert);
            }

            if($this->verifyData('[0-9]{8,8}', $placa)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'La placa solo puede contener números con un rango de 8 digitos.'
                ];
                return json_encode($alert);
            }

            $checkPlaca = $this->executeQuery("SELECT placa FROM vehiculo WHERE placa = '$placa'");
            if($checkPlaca->rowCount()>0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'La placa del vehículo se encuentra registrada.',
                ];
                return json_encode($alert);
            };

            $checkLink = filter_var($linkGps, FILTER_SANITIZE_URL);
            if(filter_var($checkLink, FILTER_VALIDATE_URL)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El link ingresado es inválido.'
                ];
                return json_encode($alert);
            }

            $vehiculoDataLog = [
                [
                    'field_name_database' => 'id_vehiculo',
                    'field_name_form' => ':placa',
                    'field_value' => $placa
                ],
                [
                    'field_name_database' => 'tipo_vehiculo',
                    'field_name_form' => ':tipoVehiculo',
                    'field_value' => $tipoVehiculo
                ],
                [
                    'field_name_database' => 'propiedad',
                    'field_name_form' => ':propiedad',
                    'field_value' => $propiedad
                ],
                [
                    'field_name_database' => 'unidad_negocio',
                    'field_name_form' => ':unidadNegocio',
                    'field_value' => $unidadNegocio
                ],
                [
                    'field_name_database' => 'marca',
                    'field_name_form' => ':marca',
                    'field_value' => $marca
                ],
                [
                    'field_name_database' => 'modelo',
                    'field_name_form' => ':modelo',
                    'field_value' => $modelo
                ],
                [
                    'field_name_database' => 'year_vehiculo',
                    'field_name_form' => ':year',
                    'field_value' => $year
                ],
                [
                    'field_name_database' => 'serial_carroceria',
                    'field_name_form' => ':serialCarroceria',
                    'field_value' => $serialCarroceria
                ],
                [
                    'field_name_database' => 'serial_motor',
                    'field_name_form' => ':serialMotor',
                    'field_value' => $serialMotor
                ],
                [
                    'field_name_database' => 'numero_ejes',
                    'field_name_form' => ':numeroEjes',
                    'field_value' => $numeroEjes
                ],
                [
                    'field_name_database' => 'capacidad_carga',
                    'field_name_form' => ':capacidadCarga',
                    'field_value' => $capacidadCarga
                ],
                [
                    'field_name_database' => 'uso',
                    'field_name_form' => ':uso',
                    'field_value' => $uso
                ],
                [
                    'field_name_database' => 'vencimiento_poliza',
                    'field_name_form' => ':vencimientoPoliza',
                    'field_value' => $vencimientoPoliza
                ],
                [
                    'field_name_database' => 'vencimiento_racda',
                    'field_name_form' => ':vencimientoRacda',
                    'field_value' => $vencimientoRacda
                ],
                [
                    'field_name_database' => 'vencimiento_sanitario',
                    'field_name_form' => ':vencimientoSanitario',
                    'field_value' => $vencimientoSanitario
                ],
                [
                    'field_name_database' => 'vencimiento_rotc',
                    'field_name_form' => ':vencimientoRotc',
                    'field_value' => $vencimientoRotc
                ],
                [
                    'field_name_database' => 'fecha_fumigacion',
                    'field_name_form' => ':fechaFumigacion',
                    'field_value' => $fechaFumigacion
                ],
                [
                    'field_name_database' => 'fecha_impuesto',
                    'field_name_form' => ':fechaImpuestos',
                    'field_value' => $fechaImpuestos
                ],
                [
                    'field_name_database' => 'bolipuertos',
                    'field_name_form' => ':bolipuertos',
                    'field_value' => $bolipuertos
                ],
                [
                    'field_name_database' => 'gps',
                    'field_name_form' => ':gps',
                    'field_value' => $gps
                ],
                [
                    'field_name_database' => 'link_gps',
                    'field_name_form' => ':linkGps',
                    'field_value' => $linkGps
                ],
                [
                    'field_name_database' => 'estatus',
                    'field_name_form' => ':estatus',
                    'field_value' => $estatus
                ]
            ];

            $saveVehiculo = $this->saveData('vehiculo', $vehiculoDataLog);

            if($saveVehiculo->rowCount() == 1){
                $alert = [
                    'type' => 'reload',
                    'icon' => 'success',
                    'title' => 'Registro exitoso',
                    'text' => 'El vehículo('.$placa.') se registró correctamente.',
                ];
            }else{
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Hubo un problema al registrar el vehículo.'
                ];
                return json_encode($alert);
            }
        }

        public function tableVehiculo(){
            $getTableVehiculo = $this->executeQuery(
                "SELECT vehiculo.*, 
                    tipoVehiculo.descripcion1 AS tipo_vehiculo,
                    propiedad.descripcion1 AS propiedad,
                    unidadNegocio.descripcion1 AS unidadNegocio,
                    marca.descripcion1 AS marca,
                    numeroEjes.descripcion1 AS ejes,
                    usoVehiculo.descripcion1 AS uso,
                    bolipuertos.descripcion1 AS bolipuertos,
                    gps.descripcion1 AS gps
                FROM vehiculo
                LEFT JOIN
                    general AS tipoVehiculo ON vehiculo.tipo_vehiculo = tipoVehiculo.id_entidad AND tipoVehiculo.id_registro = 9 AND tipoVehiculo.id_entidad > 0
                LEFT JOIN
                    general AS propiedad ON vehiculo.propiedad = propiedad.id_entidad AND propiedad.id_registro = 10 AND propiedad.id_entidad > 0
                LEFT JOIN
                    general AS unidadNegocio ON vehiculo.unidad_negocio = unidadNegocio.id_entidad AND unidadNegocio.id_registro = 11 AND unidadNegocio.id_entidad > 0
                LEFT JOIN
                    general AS marca ON vehiculo.marca = marca.id_entidad AND marca.id_registro = 12 AND marca.id_entidad > 0
                LEFT JOIN
                    general AS numeroEjes ON vehiculo.numero_ejes = numeroEjes.id_entidad AND numeroEjes.id_registro = 13 AND numeroEjes.id_entidad > 0
                LEFT JOIN
                    general AS usoVehiculo ON vehiculo.uso = usoVehiculo.id_entidad AND usoVehiculo.id_registro = 14 AND usoVehiculo.id_entidad > 0
                LEFT JOIN
                    general AS bolipuertos ON vehiculo.bolipuertos = bolipuertos.id_entidad AND bolipuertos.id_registro = 15 AND bolipuertos.id_entidad > 0
                LEFT JOIN
                    general AS gps ON vehiculo.gps = gps.id_entidad AND gps.id_registro = 16 AND gps.id_entidad > 0
                "
            );
            
            $data = [];

            if($getTableVehiculo->rowCount()>0){
                while($row = $getTableVehiculo->fetch(PDO::FETCH_ASSOC)){
                    foreach($row as $key => $value){
                        if(empty($value)){
                            $row[$key] = '<span class="badge text-bg-danger">No definido</span>';
                        }
                    }
                    $data[] = $row;
                }
            }
            return json_encode($data);
        }

        public function updateVehiculo(){}

        public function deleteVehiculo(){}

    }