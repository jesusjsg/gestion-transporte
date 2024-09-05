<?php

    namespace src\controllers;

    use PDO;
    use src\models\uniqueModel;

    class usuarioController extends uniqueModel{
        
        public function registerUser(){
            $fullName = trim($this->cleanString($_POST['fullname']));
            $username = trim($this->cleanString($_POST['user']));
            $passwordOne = trim($this->cleanString($_POST['password']));
            $passwordTwo = trim($this->cleanString($_POST['valid-password']));
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
                    'text' => 'La contraseña deben tener entre 6 y 100 caracteres.',
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

            $checkUser = $this->executeQuery("SELECT nombre_usuario FROM usuarios WHERE nombre_usuario = '$username'");

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

            $saveUser = $this->saveData('usuarios', $userDataLog);
            if($saveUser->rowCount() == 1){
                $alert = [
                    'type' => 'reload',
                    'icon' => 'success',
                    'title' => 'Registro exitoso',
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
                FROM usuarios u 
                INNER JOIN roles r 
                ON u.id_rol = r.id_rol
                "
            );
            $data = [];

            if($getTableUser->rowCount()>0){
                while($row = $getTableUser->fetch(PDO::FETCH_ASSOC)){
                    foreach($row as $key => $value){
                        if(empty($value)){
                            $row[$key] = '<span class="badge text-bg-secondary">No definido</span>';
                        }
                    }
                    $row['opciones'] = '
                        <a href="'.URL.'usuario/editar/'.$row['id_usuario'].'/" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square m-0 p-0"></i></a>
                        <form class="form-ajax d-inline" action="'.URL.'ajax/usuarios" method="post" autocomplete="off">
                            <input type="hidden" name="model_user" value="delete" />
                            <input type="hidden" name="id-usuario" value="'.$row['id_usuario'].'" />
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

        public function updateUser(){
            $userId = $this->cleanString($_POST['id_usuario']);

            $data = $this->executeQuery("SELECT * FROM usuarios WHERE id_usuario='$userId'");
            if($data->rowCount()<0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'No hemos encontrado el usuario en el sistema.'
                ];
                return json_encode($alert);
            }else{
                $data = $data->fetch();
            }

            $fullname = trim($this->cleanString($_POST['fullname']));
            $username = trim($this->cleanString($_POST['username']));
            $passwordOne = trim($this->cleanString($_POST['password']));
            $passwordTwo = trim($this->cleanString($_POST['valid-password']));
            $rolName = $this->cleanString($_POST['id-rol']);

            if(empty($fullname) || empty($username)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El nombre y el usuario son obligatorios.'
                ];
                return json_encode($alert);
            }

            if($this->verifyData('[a-zA-Z0-9{3,40}', $username)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El usuario solo puede contener letras y números.'
                ];
                return json_encode($alert);
            }

            if($this->verifyData('[a-ZA-Z0-9$.\-]{6,100}', $passwordOne) || $this->verifyData('[a-ZA-Z0-9$.\-]{6,100}', $passwordTwo)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Las contraseñas deben tener entre 6 y 100 caracteres.'
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

            

        }

        public function deleteUser(){

            $id = $this->cleanString($_POST['id-usuario']);

            if($id == 1){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'No se puede eliminar el usuario principal.',
                ];
                return json_encode($alert);
                exit();
            }

            $dataUser = $this->executeQuery("SELECT * FROM usuarios WHERE id_usuario='$id'");
            if($dataUser->rowCount()<=0){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El usuario no se encuentra registrado.',
                ];
                return json_encode($alert);
            } else {
                $dataUser = $dataUser->fetch();
            }

            $deleteUser = $this->deleteData('usuarios', 'id_usuario', $id);

            if($deleteUser->rowCount()==1){
                $alert = [
                    'type' => 'reload',
                    'icon' => 'success',
                    'title' => 'Usuario eliminado',
                    'text' => 'El usuario '.$dataUser['nombre_apellido'].' ha sido eliminado.'
                ];
            }else{
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'No se pudo eliminar el usuario '.$dataUser['nombre_apellido'].', intente nuevamente.'
                ];
            }
            return json_encode($alert);
        }

        public function getRol(){
            $getRol = $this->executeQuery('SELECT id_rol, nombre_rol FROM roles ORDER BY nombre_rol');
            $roles = [];

            if($getRol->rowCount()>0){
                while($row = $getRol->fetch(PDO::FETCH_ASSOC)){
                    $roles[] = $row;
                }
            }
            return $roles;

        }

    }