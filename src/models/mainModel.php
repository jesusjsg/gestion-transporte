<?php

namespace src\models;

use Exception;
use PDOException;
use \PDO;

class mainModel
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;


    public function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->db = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->pass = $_ENV['DB_PASSWORD'];
        $this->charset = $_ENV['DB_CHARSET'];
    }

    protected function conection(): PDO
    { //Funcion para la conexión a la base de datos
        try {
            $connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->pass);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, $this->charset);

            return $connection;
        } catch (PDOException $error) {
            error_log('Error en la conexión a la base de datos: ' . $error->getMessage());
            throw new Exception('Error en la conexión a la base de datos');
        }
    }

    protected function executeQuery($query, $params = [])
    { // Función para ejecutar las consultas preparadas
        $sql = $this->conection()->prepare($query);
        if (!empty($params)) {
            foreach ($params as $key => &$value) {
                $sql->bindParam($key, $value);
            }
        }
        $sql->execute();
        return $sql;
    }

    // Uso de funciones para evitar la inyección SQL y validar los datos
    public function cleanString($string)
    {

        $words = [
            "<script>", "</script>", "<script src",
            "<script type=", "SELECT * FROM", "DELETE FROM",
            "INSERT INTO", "DROP TABLE", "DROP DATABASE",
            "TRUNCATE TABLE", "SHOW TABLES", "SHOW DATABASES",
            "<?php", "?>", "--", "^", "<", ">", "==", "=", ";", "::",
        ];

        $string = trim($string);
        $string = stripslashes($string);

        foreach ($words as $word) {
            $string = str_ireplace($word, "", $string);
        };

        $string = trim($string);
        $string = stripslashes($string);
        return $string;
    }

    protected function verifyData($filter, $string)
    {
        if (preg_match("/^" . preg_quote($filter, '/') . "$/", $string)) {
            return true;
        } else {
            return false;
        }
    }

    protected function formatDate(string $date)
    {
        if (!empty($date)) {
            return date('d/m/Y', strtotime($date));
        }
        return '';
    }

    protected function errorHandler($text, $title = 'Ocurrió un error'): string
    {
        error_log('Error: ' . $text);
        return json_encode([
            'type' => 'simple',
            'icon' => 'error',
            'title' => $title,
            'text' => $text,
        ]);
        exit();
    }

    protected function successHandler($type, $text, $title = 'Registro exitoso'): string
    {
        return json_encode([
            'type' => $type,
            'icon' => 'success',
            'title' => $title,
            'text' => $text,
        ]);
        exit();
    }

}
