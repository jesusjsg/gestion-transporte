<?php

    namespace src\controllers;
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
                    'title' => 'Ocurrió un error',
                    'text' => 'Todos los campos son obligatorios.',
                ];
                return json_encode($alert);
                exit();
            }

            if($this->verifyData("[a-zA-Z0-9]{3,40}", $username)){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'El usuario solo puede contener letras y números.',
                ];
                return json_encode($alert);
                exit();
            }

            if($this->verifyData("[a-zA-Z0-9$@.\-]{6,100}", $passwordOne) /* || $this->verifyData("[a-zA-Z0-9$@.\-]{6,100}", $passwordTwo) */){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'La contraseña debe tener entre 6 y 100 caracteres.',
                ];
                return json_encode($alert);
                exit();
            }

            if($passwordOne != $passwordTwo){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Las contraseñas no coinciden.',
                ];
                return json_encode($alert);
                exit();
            } else{
                $passwordHash = password_hash($passwordOne, PASSWORD_BCRYPT, ['cost' => 10]);
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
                exit();
            }

            $userDataLog = [

                [
                    'field_name_database' => 'nombre_apellido',
                    'field_name_form' => ':fullname',
                    'field_value' => $fullName,
                ],
                [
                    'field_name_database' => 'nombre_usuario',
                    'field_name_form' => ':username',
                    'field_value' => $username,
                ],
                [
                    'field_name_database' => 'contraseña',
                    'field_name_form' => ':password',
                    'field_value' => $passwordHash,
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
                    'text' => 'No se pudo registrar el usuario.',
                ];
            }
            return json_encode($alert);
        }
    }