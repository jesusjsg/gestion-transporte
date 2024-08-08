<?php
    namespace src\models;
    use \PDO;

    if(file_exists(__DIR__."/../../config/server.php")){ // Validar si el archivo existe
        require_once __DIR__."/../../config/server.php";
    }

    class mainModel{

        private $host = HOST;
        private $db = DB;
        private $user = USER;
        private $pass = PASSWORD;

        protected function conection(){
            $connection = new PDO('mysql:host='.$this->host.'dbname='.$this->db, $this->user, $this->pass);
            $connection->exec("SET CHARACTER SET utf8");
            return $connection;
        }
    }