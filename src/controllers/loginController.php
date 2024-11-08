<?php

namespace src\controllers;

use PDO;
use PDOException;
use src\models\mainModel;

class loginController extends mainModel
{

    public function loginSesion()
    {

        $username = $this->cleanString($_POST['username']);
        $password = $this->cleanString($_POST['pass']);

        if ($username === '' || $password === '') {
            $this->errorAlert('Por favor, rellene todos los campos.');
        }

        try {
            $checkUser = $this->executeQuery("SELECT * FROM usuarios WHERE nombre_usuario = '$username'");
            if ($checkUser->rowCount() === 1) {
                $checkUser = $checkUser->fetch(PDO::FETCH_ASSOC);
                if ($checkUser['password'] == $password) {

                    $_SESSION['id'] = $checkUser['id_usuario'];
                    $_SESSION['name'] = $checkUser['nombre_apellido'];
                    $_SESSION['username'] = $checkUser['nombre_usuario'];
                    $_SESSION['rol_id'] = $checkUser['id_rol'];

                    header('Location: ' . URL . 'home/');
                } else {
                    $this->errorAlert('Usuario o clave incorrectos');
                }
            } else {
                $this->errorAlert('Usuario o clave incorrectos');
            }
        } catch (PDOException $error) {
            error_log('Login error: ' . $error->getMessage());
        }
    }

    public function closeSesion()
    {
        session_destroy();
        if(headers_sent()){
            echo "<script> window.location.href='".URL."'; </script>";
        }else{
            header("Location: " . URL);
        };
    }

    private function errorAlert($message)
    {
        error_log('Error: ' . $message);
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Ocurrió un error',
                    text: '$message',
                    confirmButtonText: 'Aceptar',
                })
            </script>
        ";
        exit();
    }
}
