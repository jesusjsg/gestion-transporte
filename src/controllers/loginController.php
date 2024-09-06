<?php

    namespace src\controllers;
    use src\models\mainModel;

    class loginController extends mainModel{

        public function loginSesion(){

            $username = $this->cleanString($_POST['username']);
            $password = $this->cleanString($_POST['pass']);

            if($username == '' || $password == ''){
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrió un error inesperado',
                            text: 'Todos los campos son obligatorios',
                            confirmButtonText: 'Aceptar',
                        })
                    </script>
                ";
            } else{
                $check_user = $this->executeQuery("SELECT * FROM usuarios WHERE nombre_usuario = '$username'");

                if($check_user->rowCount()==1){
                    $check_user = $check_user->fetch();
                    if($check_user['contraseña'] == $password){

                        $_SESSION['id'] = $check_user['id_usuario'];
                        $_SESSION['name'] = $check_user['nombre_apellido'];
                        $_SESSION['username'] = $check_user['nombre_usuario'];
                        
                        header('Location: ' . URL . "home/");
                        exit; // Asegurarse de que no se ejecute más código después de redirigir
                    }else{
                        echo "
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrió un error inesperado',
                                    text: 'Usuario o clave incorrectos',
                                    confirmButtonText: 'Aceptar',
                                })
                            </script>
                        ";
                    }
                }else{
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Ocurrió un error inesperado',
                                text: 'Usuario o clave incorrectos',
                                confirmButtonText: 'Aceptar',
                            })
                        </script>
                    ";
                }
            }
        }

        public function closeSesion(){
            session_destroy();
            header('Location: '. URL);
            exit;
        }
    }