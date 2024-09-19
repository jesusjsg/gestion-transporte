<?php

namespace src\models;

use Exception;
use PDOException;
use \PDO;

if (file_exists(__DIR__ . "/../../config/server.php")) { // Validar si el archivo existe
    require_once __DIR__ . "/../../config/server.php";
}

class mainModel
{

    private $host = HOST;
    private $db = DB;
    private $user = USER;
    private $pass = PASSWORD;
    private $charset = CHARSET;

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
        if (preg_match("/^" . $filter . "$/", $string)) {
            return false;
        } else {
            return true;
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

    protected function successHandler($type, $text, $title = 'Registro exitoso')
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
