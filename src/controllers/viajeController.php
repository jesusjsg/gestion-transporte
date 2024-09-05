<?php
    namespace src\controllers;
    use PDO;
    use src\models\uniqueModel;

    class viajeController extends uniqueModel{

        public function registerViaje(){

            $fichaConductor = $this->cleanString($_POST['ficha-conductor']);
            $nombreConductor = $this->cleanString($_POST['nombre-conductor']);
            $placaVehiculo = $this->cleanString($_POST['placa-vehiculo']);
            $operacion = $this->cleanString($_POST['tipo-operacion']);
            $carga = $this->cleanString($_POST['tipo-carga']);
            $aviso = intval($this->cleanString($_POST['aviso']));
            $idCliente = intval($this->cleanString($_POST['id-cliente']));
            $codigoRuta = $this->cleanString($_POST['codigo-ruta']);
            $fechaInicio = $this->cleanString($_POST['fecha-inicio']);
            $fechaCierre = $this->cleanString($_POST['fecha-cierre']);
            $sabado = intval($this->cleanString($_POST['sabados']));
            $domingo = intval($this->cleanString($_POST['domingos']));
            $feriado = intval($this->cleanString($_POST['feriados']));
            $tasaCambio = floatval($this->cleanString($_POST['tasa-cambio']));
            $montoUsd = floatval($this->cleanString($_POST['monto-usd']));
            $montoVes = floatval($this->cleanString($_POST['monto-ves']));
            $kilometros = intval($this->cleanString($_POST['kilometros']));

            if(empty($nombreConductor) || empty($placaVehiculo) || empty($aviso) || empty($feriado)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Todos los campos son necesarios.'
                ];
                return json_encode($alert);
            }

            if($this->verifyData('[a-zA-Z ]{10,255}',$nombreConductor)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El nombre del conductor solo puede contener caracteres.'
                ];
                return json_encode($alert);
            }

            if($this->verifyData('[0-9]{10}',$aviso) || $aviso < 0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El aviso solo puede contener números enteros con un mínimo de 10 digitos.'
                ];
                return json_encode($alert);
            }

            if($this->verifyData('[0-9]',$feriado) || $feriado < 0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El feriado solo puede contener números enteros.'
                ];
                return json_encode($alert);
            }

            $dataViajeLog = [
                [
                    'field_name_database' => 'id_conductor',
                    'field_name_form' => ':fichaConductor',
                    'field_value' => $fichaConductor
                ],
                [
                    'field_name_database' => 'id_vehiculo',
                    'field_name_form' => ':placaVehiculo',
                    'field_value' => $placaVehiculo
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
                    'field_name_form' => ':idCliente',
                    'field_value' => $idCliente
                ],
                [
                    'field_name_database' => 'id_ruta',
                    'field_name_form' => ':idRuta',
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
                    'field_value' => $tasaCambio
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
                    'field_name_database' => 'kilometros',
                    'field_name_form' => ':totalKilometros',
                    'field_value' => $kilometros
                ]
            ];

            $saveViaje = $this->saveData('viajes', $dataViajeLog);

            if($saveViaje->rowCount()==1){
                $alert = [
                    'type' => 'reload',
                    'icon' => 'success',
                    'title' => 'Viaje registrado',
                    'text' => 'El viaje ha sido registrado correctamente.'
                ];
            }else{
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Hubo un problema al registrar el viaje.'
                ];
            }
            return json_encode($alert);
        }

        public function tableViaje(){

            $getTableViaje = $this->executeQuery(
                "SELECT viajes.*,
                    tipoOperacion.descripcion1 AS tipoOperacion,
                    tipoCarga.descripcion1 AS tipoCarga,
                    idCliente.descripcion1 AS idCliente
                FROM viajes
                LEFT JOIN
                    general AS tipoOperacion ON viajes.id_tipo_operacion = tipoOperacion.id_entidad AND tipoOperacion.id_registro = 3
                LEFT JOIN
                    general AS tipoCarga ON viajes.id_tipo_carga = tipoCarga.id_entidad AND tipoCarga.id_registro = 4
                LEFT JOIN
                    general AS idCliente ON viajes.id_cliente = idCliente.id_entidad AND idCliente.id_registro = 7
                "
            );
            $data = [];
            $dateColumns = [
                'fecha_inicio',
                'fecha_cierre'
            ];

            if($getTableViaje->rowCount()>0){
                while($row = $getTableViaje->fetch(PDO::FETCH_ASSOC)){
                    foreach($dateColumns as $column){
                        if(!empty($row[$column])){
                            $row[$column] = $this->formatDate($row[$column]);
                        }
                    }

                    foreach($row as $key => $value){
                        if(empty($value)){
                            $row[$key] = '<span class="badge text-bg-secondary">No definido</span>';
                        }
                    }
                    $row['opciones'] = '
                        <form class="form-ajax d-inline" action="'.URL.'ajax/viaje" method="post" autocomplete="off">
                            <input type="hidden" name="model_viaje" value="delete" />
                            <input type="hidden" name="id-viaje" value="'.$row['id_viaje'].'" />
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash3 m-0 p-0"></i>
                            </button>
                        </form>
                    ';
                    $data[] = $row;
                }
            }
            return json_encode($data);
        }

        public function updateViaje(){}

        public function deleteViaje(){}
    }