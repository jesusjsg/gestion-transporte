<?php
    namespace src\models;

    class viewsModel {

        protected $whiteList = [];

        public function __construct() {
            $this->generateWhiteList("./src/views/");
        }

        protected function generateWhiteList($directory, $prefix = "") {
            $files = scandir($directory);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    $path = $directory . $file;
                    if (is_dir($path)) {
                        // Recursivamente procesar subdirectorios
                        $this->generateWhiteList($path . "/", $prefix . $file . "/");
                    } else if (is_file($path) && pathinfo($path, PATHINFO_EXTENSION) == "php") {
                        // Agregar archivos PHP a la lista blanca con su ruta relativa
                        $this->whiteList[] = $prefix . pathinfo($file, PATHINFO_FILENAME);
                    }
                }
            }
        }

        public function getViewsModel($view) {
            // Caso especial para "login" y "index"
            if ($view == "login" || $view == "index") {
                return "./src/views/login/login.php";
            }

            // Verificar si la vista está en la lista blanca
            if (in_array($view, $this->whiteList)) {
                $viewPath = "./src/views/" . $view . ".php";
                if (is_file($viewPath)) {
                    return $viewPath;
                } else {
                    return "./src/views/errors/404.php";
                }
            } else {
                return "./src/views/errors/404.php";
            }
        }
    }