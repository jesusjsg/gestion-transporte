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

        protected function conection(){ //Funcion para la conexión a la base de datos
            $connection = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->user, $this->pass);
            $connection->exec("SET CHARACTER SET utf8");
            return $connection;
        }

        protected function executeQuery($query){ // Función para ejecutar las consultas preparadas
            $sql = $this->conection()->prepare($query); 
            $sql->execute();
            return $sql;
        }

        // Uso de funciones para evitar la inyección SQL y validar los datos
        public function cleanString($string){

            $words = [
                "<script>","</script>","<script src",
                "<script type=","SELECT * FROM","DELETE FROM",
                "INSERT INTO","DROP TABLE","DROP DATABASE",
                "TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES",
                "<?php","?>","--","^","<",">","==","=",";","::"
            ];
            
            $string = trim($string);
            $string = stripslashes($string);

            foreach($words as $word){
                $string = str_ireplace($word, "", $string);
            };

            $string = trim($string);
            $string = stripslashes($string);
            return $string;
        }

        protected function verifyData($filter, $string){
            if(preg_match("/^".$filter."$/", $string)){
                return false;
            }else {
                return true;
            }
        }
    }