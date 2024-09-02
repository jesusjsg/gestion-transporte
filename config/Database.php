<?php

class Database
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charsert;

    protected function __construct()
    {
        $this->host = constant('HOST');
        $this->db = constant('DB');
        $this->user = constant('USER');
        $this->pass = constant('PASSWORD');
        $this->charsert = constant('CHARSET');
    }

    protected function connection()
    {
        try{
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charsert=" . $this->charsert;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $pdo = new PDO($connection, $this->user, $this->pass, $options);
            return $pdo;
        }catch(PDOException $error){
            print_r('Error en la conexion a la DB: ' . $error->getMessage());
        }
    }
}