<?php
    namespace src\controllers;
    use PDO;
    use src\models\uniqueModel;

    class rutaController extends uniqueModel{

        public function registerRuta(){
            $OriginCode = $this->cleanString($_POST['codigo-origen']);
            $DestinyCode = $this->cleanString($_POST['codigo-destino']);
            $rutaCode = trim($OriginCode . '-' . $DestinyCode);
            $origen = trim($this->cleanString($_POST['origen']));
            $destino = trim($this->cleanString($_POST['destino']));
            $rutaName = trim($origen . ' - ' . $destino);
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

            $kilometros = intval($kilometros);
            if(!is_int($kilometros) || $kilometros < 0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Los kilometros deben ser un número entero.',
                ];
                return json_encode($alert);
            }

            $checkRutaCode = $this->executeQuery("SELECT id_ruta FROM ruta WHERE id_ruta = '$rutaCode'");
            $checkRutaName = $this->executeQuery("SELECT nombre_ruta FROM ruta WHERE nombre_ruta = '$rutaName'");

            if($checkRutaCode->rowCount()>0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El código de la ruta '. $rutaCode . ' ya se encuentra registrado.'
                ];
                return json_encode($alert);
            }

            if($checkRutaName->rowCount()>0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El nombre de la ruta '. $rutaName . ' ya se encuentra registrado.'
                ];
                return json_encode($alert);
            }

            $rutaDataLog = [
                [
                    'field_name_database' => 'id_ruta',
                    'field_name_form' => ':codigoRuta',
                    'field_value' => $rutaCode
                ],
                [
                    'field_name_database' => 'nombre_ruta',
                    'field_name_form' => ':nombreRuta',
                    'field_value' => $rutaName,
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
            }
            return json_encode($alert);
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
                    $row['opciones'] = '
                        <form class="form-ajax d-inline" action="'.URL.'ajax/ruta" method="post" autocomplete="off">
                            <input type="hidden" name="model_ruta" value="delete" />
                            <input type="hidden" name="id-ruta" value="'.$row['id_ruta'].'" />
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    ';
                    $data[] = $row;
                }
            }
            return json_encode($data);
        }

        public function updateRuta(){}

        public function deleteRuta(){
            $idRuta = $this->cleanString($_POST['id-ruta']);

            $dataRuta = $this->executeQuery("SELECT * FROM ruta WHERE id_ruta='$idRuta'");
            if($dataRuta->rowCount()<=0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'No hemos encontrado la ruta en el sistema.'
                ];
                return json_encode($alert);
            }else{
                $dataRuta = $dataRuta->fetch();
            }

            $deleteRuta = $this->deleteData('ruta', 'id_ruta', $idRuta);
            if($deleteRuta->rowCount()==1){
                $alert = [
                    'type' => 'reload',
                    'icon' => 'success',
                    'title' => 'Ruta eliminada',
                    'text' => 'La ruta '. $dataRuta['id_ruta'] . ' ha sido eliminada correctamente.'
                ];
            }else{
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'No se pudo eliminar la ruta '. $dataRuta['id_ruta'] .', intente más tarde.'
                ];
            }
            return json_encode($alert);
        }
    }