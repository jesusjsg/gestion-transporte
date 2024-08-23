<?php

    namespace src\controllers;

    use PDO;
    use src\models\uniqueModel;

    class usuarioController extends uniqueModel{
        
        public function registerUser(){
            $fullName = $this->cleanString($_POST['fullname']);
            $username = $this->cleanString($_POST['user']);
            $passwordOne = $this->cleanString($_POST['password']);
            $passwordTwo = $this->cleanString($_POST['valid-password']);
            $rolName = $this->cleanString($_POST['id-rol']);

            /* Validacion de los campos del formulario */

            if(empty($fullName) || empty($username) || empty($passwordOne) || empty($passwordTwo) || empty($rolName)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrio un error',
                    'text' => 'Todos los campos son obligatorios.',
                ];
                return json_encode($alert);
            }

            if($this->verifyData("[a-zA-Z0-9]{3,40}", $username)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El usuario solo puede contener letras y números.',
                ];
                return json_encode($alert);
            }

            if($this->verifyData("[a-zA-Z0-9$@.\-]{6,100}", $passwordOne) || $this->verifyData("[a-zA-Z0-9$@.\-]{6,100}", $passwordTwo)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'La contraseña debe tener entre 6 y 100 caracteres.',
                ];
                return json_encode($alert);
            }

            if($passwordOne != $passwordTwo){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Las contraseñas no coinciden.',
                ];
                return json_encode($alert);
            }

            $checkUser = $this->executeQuery("SELECT nombre_usuario FROM usuario WHERE nombre_usuario = '$username'");

            if($checkUser->rowCount()>0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El usuario ya se encuentra registrado.',
                ];
                return json_encode($alert);
            }

            $userDataLog = [

                [
                    'field_name_database' => 'nombre_apellido',
                    'field_name_form' => ':fullname',
                    'field_value' => ucwords($fullName),
                ],
                [
                    'field_name_database' => 'nombre_usuario',
                    'field_name_form' => ':username',
                    'field_value' => $username,
                ],
                [
                    'field_name_database' => 'contraseña',
                    'field_name_form' => ':password',
                    'field_value' => $passwordOne,
                ],
                [
                    'field_name_database' => 'id_rol',
                    'field_name_form' => ':rolName',
                    'field_value' => $rolName,
                ],

            ];

            $saveUser = $this->saveData('usuario', $userDataLog);
            if($saveUser->rowCount() == 1){
                $alert = [
                    'type' => 'clean',
                    'icon' => 'success',
                    'tile' => 'Registro exitoso',
                    'text' => 'El usuario '. ucwords($fullName) .' ha sido registrado correctamente.',
                    
                ];
            }else{
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Hubo un problema al registrar el usuario.',
                ];
            }
            return json_encode($alert);
        }

        public function tableUser(){

            $getTableUser = $this->executeQuery(
                "SELECT 
                    u.id_usuario,
                    u.nombre_apellido,
                    u.nombre_usuario,
                    u.contraseña,
                    r.nombre_rol
                FROM usuario u 
                INNER JOIN rol r 
                ON u.id_rol = r.id_rol
                "
            );
            $data = [];

            if($getTableUser->rowCount()>0){
                while($row = $getTableUser->fetch(PDO::FETCH_ASSOC)){
                    foreach($row as $key => $value){
                        if(empty($value)){
                            $row[$key] = '<span class="badge text-bg-danger">No definido</span>';
                        }
                    }

                    $row['opciones'] = '
                        <a href="edit/'.$row['id_usuario'].'/" class="btn btn-primary btn-sm">Editar</a>
                    ';
                    $row['opciones'] .= '
                        <form class="form-ajax d-inline" autocomplete="off">
                    ';
                    $row['opciones'] .= '
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    ';
                    $row['opciones'] .= '</form>';
                    $data[] = $row;
                }
            }

            return json_encode($data);
        }

        public function updateUser(){}

        public function deleteUser(){

            $id = $this->cleanString($_POST['user_id']);

            if($id == 1){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'No se puede eliminar el usuario principal.',
                ];
                return json_encode($alert);
            }

            $dataUser = $this->executeQuery("SELECT * FROM usuario WHERE id_usuario='$id'");
            if($dataUser->rowCount()<=0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrrió un error',
                    'text' => 'El usuario no se encuentra registrado',
                ];
                return json_encode($alert);
            } else {
                $dataUser = $dataUser->fetch();
            }

            $deleteUser = $this->deleteData('usuario', 'id_usuario', $id);

            if($deleteUser->rowCount()==1){
                $alert = [
                    'type' => 'reload',
                    'icon' => 'success',
                    'title' => 'Usuario eliminado',
                    'text' => 'El usuario '.$dataUser['nombre_apellido'].' ha sido eliminado.'
                ];
                return json_encode($alert);
            }else{
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrrió un error',
                    'text' => 'No se pudo eliminar el usuario '.$dataUser['nombre_apellido'].', intente nuevamente.'
                ];
                return json_encode($alert);
            }
        }

        public function getRol(){
            $getRol = $this->executeQuery('SELECT id_rol, nombre_rol FROM rol ORDER BY nombre_rol');
            $roles = [];

            if($getRol->rowCount()>0){
                while($row = $getRol->fetch(PDO::FETCH_ASSOC)){
                    $roles[] = $row;
                }

            }
            return $roles;

        }

    }