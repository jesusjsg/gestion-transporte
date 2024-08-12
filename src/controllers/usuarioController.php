<?php

    namespace src\controllers;
    use src\models\uniqueModel;

    class usuarioController extends uniqueModel{
        
        public function registerUser(){
            $fullName = $this->cleanString('fullname');
            $username = $this->cleanString('user');
            $password = $this->cleanString('password');
            $validPassword = $this->cleanString('valid-password');
            $rolName = $this->cleanString('id-rol');

            /* Validacion de los campos del formulario */

            if($fullName == '' || $username == '' || $password == '' || $validPassword == '' || $rolName == ''){
                $alert = [
                    'type' => 'simple',
                    'icon' => 'error',
                    'title' => 'Ocurrió un error',
                    'text' => 'Todos los campos son obligatorios.',
                ];
                return json_encode($alert);
            }
        }
    }